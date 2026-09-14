@extends('layouts.app')
@section('title', __('Statistics'))
@section('content')
  <div class="row justify-content-center text-center mt-8">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Statistics') }}</h2>
      </div>
    </div>
  </div>

<div class="row mb-6">
	<div class="col-md-4">
		<div class="card p-4 card-shadow border-0 radius-5 mt-5 mt-md-0 text-center">
			<h4>{{ count($options->getAll->get()) }}</h4>
			<p>{{ __('Total Links') }}</p>
		</div>
	</div>
	<div class="col-md-4">
    @php
      $countviews = 0;
      foreach ($options->getAll2->get() as $value) {
        $countviews = ($countviews + $value->views);
      }
    @endphp
		<div class="card p-4 card-shadow border-0 radius-5 mt-5 mt-md-0 text-center">
			<h4>{{$countviews}}</h4>
			<p>{{ __('Total Views') }}</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card p-4 card-shadow border-0 radius-5 mt-5 mt-md-0 text-center">
			<h4>{{ count($options->getAll2->get()) }}</h4>
			<p>{{ __('Unique views') }}</p>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="card p-4 card-shadow border-0 radius-5 mt-5 mt-md-0">
       <div class="nk-ck mt-4 h-250px">
          <canvas class="line-chart" id="Visitors_chart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card p-4 card-shadow border-0 radius-5 mt-5 mt-md-0">
        <div class="card-inner">
            <div class="nk-wg7">
                <div class="nk-wg7-stats">
                    <h4>{{ __('Operating system') }}</h4>
                    <div class="nk-wg7-title">{{ __('Operating systems your visitors are using') }}</div>
                     <div class="chart-container mt-4 h-250px">
                         <canvas class="doughnut-chart" id="OSTraffic"></canvas>
                     </div>
                </div>
            </div><!-- .nk-wg7 -->
        </div><!-- .card-inner -->
    </div><!-- .card -->
  </div>
</div>
<div class="row">
  
<div class="col-md-6">
  <div class="p-3">
    <div class="form-group">
      <form method="get">
         @if (!empty(request()->get('page')))
         <input type="hidden" value="1" name="page">
         @endif
         @if (!empty(request()->get('type')))
         <input type="hidden" value="{{request()->get('type')}}" name="type">
         @endif
         @if (!empty(request()->get('url')))
         <input type="hidden" value="{{request()->get('url')}}" name="url">
         @endif
         <input class="form-control form-control-lg" value="{{request()->get('url_slug')}}" type="text" name="url_slug" placeholder="{{ __('Search for slug') }}"/>
         <button class="btn bg-blue effect-letter c-white mt-3">{{ __('Submit') }}</button>
      </form>
    </div>
  </div>
</div>
<div class="col-md-6 ml-auto">
  <div class="p-3">
    <div class="form-group">
      <form method="get">
         @if (!empty(request()->get('page')))
         <input type="hidden" value="1" name="page">
         @endif
         @if (!empty(request()->get('type')))
         <input type="hidden" value="{{request()->get('type')}}" name="type">
         @endif
         @if (!empty(request()->get('url_slug')))
         <input type="hidden" value="{{request()->get('url_slug')}}" name="url_slug">
         @endif
         <input class="form-control form-control-lg" value="{{request()->get('url')}}" type="text" name="url" placeholder="{{ __('Search for url') }}"/>
         <button class="btn bg-blue effect-letter c-white mt-3">{{ __('Submit') }}</button>
      </form>
    </div>
  </div>
</div>
</div>
<div class="tranx-list tranx-list-stretch mt-4">
  @foreach ($options->getAll->paginate(5) as $value)
   <div class="d-flex card card-shadow border-0 justify-content-around p-3 flex-lg-row mb-3 radius-5">
               <div class="text-sticker mb-3 mb-lg-0">{{$value->slug}}</div>
               <div class="text-sticker mb-3 mb-lg-0">{{$value->link_url}}</div>
               <div class="text-sticker mb-3 mb-lg-0">{{$options->logs[$value->slug]['impression'] ?? ''}} {{ __('Views') }} | {{$options->logs[$value->slug]['unique'] ?? ''}} {{ __('Unique views') }}</div>
              <form id="form-submit">
                @if (!empty(request()->get('page')))
                <input type="hidden" value="{{request()->get('page')}}" name="page">
                @endif
                @if (!empty(request()->get('type')))
                <input type="hidden" value="{{request()->get('type')}}" name="type">
                @endif
                <input type="hidden" value="{{$value->slug}}" name="link">
                  <a href="{{$value->link_url ?? '#'}}" target="_blank" class="btn btn-link btn-sm" data-toggle="tooltip" data-placement="bottom" title="">{{ __('Visit') }}</a>
                  <button class="btn bg-blue effect-letter c-white">{{ __('Statistics') }}</button>
              </form>
   </div>
  @endforeach
  {{$options->getAll->paginate(5)->withQueryString()->links()}}
</div>
@section('footerJS')
 <script>
   var Visitors_chart = {
         labels: {!! $options->logs_chart['labels'] !!},
         dataUnit: "{{ __('Visitors') }}",
         lineTension: .4,
         legend: !0,
       datasets:[{
        label: "{{ __('Impression') }}",
        color:"#c4cefe",
        dash:[5],
        background:"transparent",
        data:{!! $options->logs_chart['impression'] ?? '[]' !!}},{
        label: "{{ __('Unique') }}",
        color:"#798bff",
        dash:0,
        background:NioApp.hexRGB("#798bff",.15),
        data:{!! $options->logs_chart['unique'] ?? '[]' !!}}]
     };
    var OSTraffic = {
        labels: {!! clean(json_encode(array_keys($options->data['os'])), 'titles') !!},
        legend: !1,
        dataUnit: "{{ __('Visits') }}",
        datasets: [{
            borderColor: "#fff",
            background: ["#9cabff", "#f4aaa4", "#8feac5"],
            data: {{ json_encode(array_values($options->data['os'])) ?? '[]' }},
        }]
    };
 </script>
@stop
@endsection
