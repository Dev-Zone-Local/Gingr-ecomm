@extends('layouts.app')
@section('title', __('Statistics'))
@section('content')
  <div class="row justify-content-center text-center mt-8">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Statistics') }}</h2>
        <a href="{{ route('stats', ['type' => 'links']) }}" class="btn bg-blue effect-letter c-white">{{ __('View single links statistics') }}</a>
      </div>
    </div>
  </div>
     <div class="row mt-5">
     	<div class="col-md-6">
     		<div class="card p-4 card-shadow border-0 radius-5">
          <div class="line-stats mb-4">
               <div class="line-stat">
                   <span>{{ __('Total Visitors') }}</span>
                   <span class="current">{{ number_format($total_visits['total_visits_count']->count) }}</span>
               </div>
           </div>
			     <div class="nk-ck mt-2 h-250px">
			        <canvas class="line-chart" id="Visitors_monthly_chart"></canvas>
			    </div>
     		</div>
     	</div>
     	<div class="col-md-6">
           <div class="nk-cov-wg4 card radius-5 border-0 card-shadow mt-5 mt-md-0">
              <div class="nk-cov-wg4-aside p-4 border-0 w-100">
                 <div class="nk-cov-wg4-aside-body" data-simplebar>
                    <ul class="nk-cov-wg4-list">
                      @foreach ($options->countryPercent as $key => $item)
                        <div class="nk-cov-wg7-data">
                           <div class="nk-cov-wg7-data-title">
                              <div class="lead-text">{{ucfirst($key)}}</div>
                           </div>
                           <div class="nk-cov-wg7-data-progress">
                              <div class="progress progress-alt bg-transparent">
                                 <div class="progress-bar" data-bg="#6576ff" data-progress="{{$item[1]}}"></div>
                                 <div class="progress-amount">{{$item[1]}}%</div>
                              </div>
                           </div>
                           <div class="nk-cov-wg7-data-count text-right">
                              <div class="sub-text">{{$item[0]}}</div>
                           </div>
                        </div>
                      @endforeach
                    </ul>
                 </div>
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
                                  <canvas class="doughnut-chart" id="doughnutChartData"></canvas>
                              </div>
                         </div>
                     </div><!-- .nk-wg7 -->
                 </div><!-- .card-inner -->
             </div><!-- .card -->
         </div>
         <div class="col-md-7 mt-5">
           <div class="nk-cov-wg4 card p-4 card-shadow border-0 radius-5">
              <div class="nk-cov-wg4-aside border-0 w-100">
                 <div class="card-header border-0 radius-7 d-flex justify-content-between mb-3">
                   <h4 class="m-0 fs-18px">{{ __('Traffic') }}</h4>
                   <div class="fs-13px">{{ __('Where your traffic is coming from') }}</div>
                 </div>
                 <div class="nk-cov-wg4-aside-body" data-simplebar>
                    <ul class="nk-cov-wg4-list">
                        @foreach($logs_data['country'] as $key => $value)
                        <li class="card-bordered mb-2 bdrs-20">
                          <a class="nk-cov-wg4-list-item"><img src="https://www.countryflags.io/{!! clean($key, 'titles') !!}/flat/16.png" class="img-fluid mr-1" alt=" "/>
                          <span class="title">{!! clean(General::countries($key), 'titles') !!}</span><span class="count">{{$value}}</span></a>
                        </li>
                       @endforeach
                    </ul>
                 </div>
              </div>
           </div>
         </div>
     </div>
     <div class="row mt-5">
     	<div class="col-md-7">
     		<div class="card p-4 card-shadow border-0 radius-5">
			     <div class="nk-ck mt-5 h-250px">
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
                             <div class="nk-wg7-title">{{ __('Where your traffic is coming from') }}</div>
                              <div class="chart-container mt-4 h-250px">
                                  <canvas class="doughnut-chart" id="OSTraffic"></canvas>
                              </div>
                         </div>
                     </div><!-- .nk-wg7 -->
                 </div><!-- .card-inner -->
             </div><!-- .card -->
         </div>
     </div>
 </div><!-- .nk-block -->

 <script>
   var Visitors_monthly_chart = {
         labels: {!! clean(json_encode(array_values($total_visits['visit_chart_date'])), 'titles') !!},
         dataUnit: "{{ __('Visitors') }}",
         lineTension: .4,
         legend: !0,
         datasets: [{
             label: "{{ __('Visits') }}",
             color: "#5ce0aa",
             background: "transparent",
             data: {{ json_encode($total_visits['total_visits']) }}
         }]
     };
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
    var doughnutChartData = {
        labels: {!! clean(json_encode(array_keys($logs_data['browser'])), 'titles') !!},
        legend: !1,
        datasets: [{
            borderColor: "#fff",
            background: ["#117a65", "#581845", "#FFC300", "#154360", "#150275"],
            data: {{ json_encode(array_values($logs_data['browser'])) ?? '[]' }},
        }]
    };

    var OSTraffic = {
        labels: {!! clean(json_encode(array_keys($logs_data['os'])), 'titles') !!},
        legend: !1,
        datasets: [{
            borderColor: "#fff",
            background: ["#9cabff", "#f4aaa4", "#8feac5"],
            data: {{ json_encode(array_values($logs_data['os'])) ?? '[]' }},
        }]
    };
 </script>
@endsection
