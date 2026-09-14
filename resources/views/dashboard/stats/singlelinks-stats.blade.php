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
<div class="row">
        <div class="col-md-6">
          <div class="card p-4 card-shadow border-0 radius-5 mt-5 mt-md-0">
            <h2>{{ $options->logs[request()->get('link')]['impression'] ?? '0' }}</h2>
            <h5>{{ __('Impressions') }}</h5>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card p-4 card-shadow border-0 radius-5 mt-5 mt-md-0">
            <h2>{{ $options->logs[request()->get('link')]['unique'] ?? '0' }}</h2>
            <h5>{{ __('Unique Views') }}</h5>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card p-4 card-shadow border-0 radius-5 mt-5">
             <div class="nk-ck mt-4 h-250px">
                <canvas class="line-chart" id="Visitors_chart"></canvas>
            </div>
          </div>
        </div>
         <div class="col-md-5 mt-5">
             <div class="card p-4 card-shadow border-0 radius-5">
                 <div class="card-inner">
                     <div class="nk-wg7">
                         <div class="nk-wg7-stats">
                             <h4>{{ __('Browsers') }}</h4>
                             <div class="nk-wg7-title">{{ __('Browsers your visitors are using') }}</div>
                              <div class="chart-container mt-4 h-250px">
                                  <canvas class="analytics-doughnut" id="doughnutChartData"></canvas>
                              </div>
                         </div>
                     </div><!-- .nk-wg7 -->
                 </div><!-- .card-inner -->
             </div><!-- .card -->
         </div>
         <div class="col-md-5 mt-5">
             <div class="card p-4 card-shadow border-0 radius-5">
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

   <div class="col-md-7">
      <div class="mt-5">
         <div class="nk-cov-wg4 card p-4 card-shadow border-0 radius-5">
            <div class="nk-cov-wg4-aside border-0 w-100">
                 <div class="card-header border-0 radius-7 d-flex justify-content-between mb-3">
                   <h4 class="m-0 fs-18px">{{ __('Visits by Country') }}</h4>
                 </div>
               <div class="nk-cov-wg4-aside-body" data-simplebar>
                  <ul class="nk-cov-wg4-list">
                     @php
                       $countContry = 0;
                       foreach ($options->data['country'] as $key => $value) {
                         $countContry = ($countContry + $value);
                       }
                     @endphp
                     <li class="card-bordered mb-2"><a class="nk-cov-wg4-list-item"><span class="title">{{ __('Worldwide') }}</span>
                       <span class="count">{{ $countContry }}</span>
                     </a></li>
                     @foreach ($options->data['country'] as $key => $value)
                     <li class="card-bordered mb-2"><a class="nk-cov-wg4-list-item"><span class="title">{!! clean(General::countries($key), 'titles') !!}</span><span class="count">{{$value}}</span></a></li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

 <script>
   var Visitors_chart = {
         labels: {!! $options->logsFD['labels'] !!},
         dataUnit: "Visitors",
         lineTension: .4,
         legend: !0,
       datasets:[{
        label: "{{ __('Impression') }}",
        color:"#c4cefe",
        dash:[5],
        background:"transparent",
        data:{!! $options->logsFD['impression'] ?? '[]' !!}},{
        label: "{{ __('Unique') }}",
        color:"#798bff",
        dash:0,
        background:NioApp.hexRGB("#798bff",.15),
        data:{!! $options->logsFD['unique'] ?? '[]' !!}}]
     };
    var doughnutChartData = {
        labels: {!! clean(json_encode(array_keys($options->data['browser'])), 'titles') !!},
        dataUnit: "{{ __('Visits') }}",
        legend: !1,
        datasets: [{
            borderColor: "#fff",
            background: ["#117a65", "#581845", "#FFC300", "#154360", "#150275"],
            data: {{ json_encode(array_values($options->data['browser'])) ?? '[]' }},
        }]
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
@endsection
