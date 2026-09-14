@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
@section('footerJS')
  <script>
        var totalSales = {
            labels: {!! $options->sales_chart['labels'] ?? '[]' !!},
            dataUnit: "{{__('Sold')}}",
            lineTension: .3,
            datasets: [{
                label: "{{__('Sales')}}",
                color: "#9d72ff",
                background: NioApp.hexRGB("#9d72ff", .25),
                data: {!! $options->sales_chart['sales'] ?? '[]' !!}
            }]
        };
    var totalCustomers = {
          labels: {!! $options->customers_chart['labels'] ?? '[]' !!},
          dataUnit: "{{__('Customers')}}",
          lineTension: .4,
          datasets: [{
               label: "{{__('Customers')}}",
               color: "#000",
               background: NioApp.hexRGB("#000", .25),
               data: {!! $options->customers_chart['count'] ?? '[]' !!}
          }]
    };

    var doughnutChartData = {
        labels: ["Firefox", "Unique"],
        legend: !1,
        datasets: [{
            borderColor: "#fff",
            background: ["#117a65", "#581845", "#FFC300", "#154360", "#150275"],
            data: [3, 50],
        }]
    };

   var storeVisitors = {
         labels: {!! $options->this_month_chart['labels'] ?? '[]' !!},
         dataUnit: "{{ __('Visitors') }}",
         lineTension: .4,
         legend: !0,
       datasets:[{
        label: "{{ __('Impression') }}",
        color:"#c4cefe",
        dash:[5],
        background:"transparent",
        data:{!! $options->this_month_chart['impression'] ?? '[]' !!}},{
        label: "{{ __('Unique') }}",
        color:"#798bff",
        dash:0,
        background:NioApp.hexRGB("#798bff",.15),
        data:{!! $options->this_month_chart['unique'] ?? '[]' !!}}]
     };
  </script>
  <script src="{{ url('js/jqvmap.js') }}"></script>
@stop
<div class="mt-7"></div>
  @if ($user->role == 1)
  <div class="order-details-header d-block d-md-flex">
    <div class="left">
      <span id="order-details-id">{{ __('Hey Admin') }}</span>
      <span id="order-details-date">{{ __('You are currently logged in as admin. Use the right button to access your admin dashboard.') }}</span>
    </div>
    <div class="right">
      <div class="inner-meta ml-0 mt-3 mt-md-0">
        <a href="{{ route('admin-home') }}" class="btn btn_sm_primary bg-blue">{{ __('Go to Admin dashboard') }}</a>
      </div>
    </div>
  </div>
  @endif
<div class="row">
  <div class="col-xl-3 col-md-6">
    <div class="dashboard-card is-welcome h-400px mb-4 mb-xl-0 d-flex flex-column justify-content-center">
       <div class="welcome-title">
           <span class="text-muted-2">{{ __('Store Name:') }}</span>
           <h3 class="dark-inverted fs-16px">{{ full_name() }}</h3>
           <span class="text-muted-2">{{ __('Sales This Month:') }}</span>
           <h3 class="dark-inverted">{!! number_format($options->sales['this_month']) !!}</h3>
           <span class="text-muted-2">{{ __('Store Logo:') }}</span>
           <h3 class="dark-inverted"> </h3>
       </div>
       <div class="dashboard-logo-wrap">
          <div class="card border-0 shadow-none custom-input-uploader">
              <div class="card-body p-0">
                  <div class="file-upload m-0 py-3">
                      <img src="{{ avatar() }}" class="w-100 h-80px ob-contain" alt="">
                  </div>
              </div>
          </div>
       </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="dashboard-card is-welcome mb-4 mb-xl-0 h-400px d-flex flex-column justify-content-center">
       <div class="welcome-progress">
          <img src="{{ url('media/user/qrcode/'.$user->username.'.png') }}" class="dash-qr-img" alt="">
       </div>
       <div class="button-wrap text-center">
           <a download="Qrcode.png-{{full_name()}}" href="{{ url('media/user/qrcode/'.$user->username.'.png') }}" class="fs-11px"><i class="tio download_from_cloud"></i> {{ __('Download Store Code') }}</a>


             <input type="text" class="form-control h-38px fs-11px" id="refUrl" readonly="" value="{{ route('user-profile', ['profile' => $user->username]) }}">

           <a data-clipboard="{{ route('user-profile', ['profile' => $user->username]) }}" data-clipboard-after-text="{{ __('Copied') }}" class="btn bg-blue c-white btn-block mt-3">{{ __('Copy link') }}</a>

       </div>
    </div>
  </div>
  <div class="col-xl-6">
    <div class="dashboard-card bg-white mb-4 mb-xl-0 radius-5 p-5 h-400px d-flex flex-column justify-content-center">
        <span class="text-muted-2">{{ __('Your Current Package:') }}</span>
        <div class="p-relative">
           <h3 class="dark-inverted">{{ package('name') }}</h3>
           <a href="{{ route('pricing') }}" class="btn bg-blue c-white btn_sm_primary btn_right_right p-2 fs-13px">{{ __('Upgrade') }}</a>
        </div>

          <div class="quick-stats mt-4">
            <div class="quick-stats-inner">
                <div class="row">
                  <div class="col-md-6">
                    <!--Stat-->
                    <div class="quick-stat bg-blue p-3 radius-5 text-white mb-4 mb-xl-0">
                        <div class="media-flex-center">
                            <div class="flex-meta">
                                <div class="title">
                                  <p class="m-0 fs-12px">{{ __('Recent Orders') }}</p>
                                </div>
                                <span class="fs-40px">{{ number_format($options->sales['total_orders']) }}</span>
                            </div>

                            <div class="flex-end">
                              <a href="" class="fs-13px text-white">{{ __('Manage Orders') }}</a>
                            </div>
                        </div>
                    </div>
              </div>
                  <div class="col-md-6">
                    <!--Stat-->
                    <div class="quick-stat bg-blue p-3 radius-5 text-white">
                        <div class="media-flex-center">
                            <div class="flex-meta">
                                <div class="title">
                                  <p class="m-0 fs-12px">{{ __('Total Products') }}</p>
                                </div>
                                <span class="fs-40px">{{ App\Model\Products::where('user', user('id'))->count() ?? '' }}</span>
                            </div>

                            <div class="flex-end">
                              <a href="{{ route('user-products') }}" class="fs-13px text-white">{{ __('Manage Products') }}</a>
                            </div>
                        </div>
                    </div>
              </div>
          </div>
        </div>
      </div>
   </div>
  </div>
</div>



<div class="row">
  <div class="col-md-6">
    <div class="card p-4 card-shadow border-0 radius-5 mt-6">
       <div class="title mb-3">
         <p class="m-0 fs-15px">{{ __('Revenue') }}</p>
       </div>
      <div class="line-stats mb-4">
           <div class="line-stat">
               <span>{{ __('This Month') }}</span>
               <span class="current">{!! number_format($options->sales['this_month']) !!}</span>
           </div>
           <div class="line-stat">
               <span>{{ __('Last Month') }}</span>
               <span class="dark-inverted">{!! number_format($options->sales['last_month']) !!}</span>
           </div>
       </div>
      <div class="h-250px">
         <canvas class="line-chart" id="totalSales"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card p-4 card-shadow border-0 radius-5 mt-6">
       <div class="title mb-3">
         <p class="m-0 fs-15px">{{ __('Customers') }}</p>
       </div>
      <div class="line-stats mb-4">
           <div class="line-stat">
               <span>{{ __('Total') }}</span>
               <span class="dark-inverted">{!! number_format($options->customers_this_month) !!}</span>
           </div>
       </div>
      <div class="h-250px">
         <canvas class="line-chart" id="totalCustomers"></canvas>
      </div>
    </div>
  </div>
</div>



<div class="row">
  <div class="col-md-6">
    <div class="p-4 border-0 radius-5 mt-5">
       <div class="card-header border-0 mb-3">
         <p class="m-0 fs-15px">{{ __('Top Products') }}</p>
       </div>
      
     <div class="flex-table">

        @foreach ($options->topproducts as $key => $items)
         <!--Table item-->
         <div class="flex-table-item">
             <div class="flex-table-cell is-media is-grow grow-4" data-th="">
                 <div class="h-avatar is-medium">
                     <img class="avatar is-squared h-40px object-cover" src="{{ getfirstproductimg($key) }}" alt=" ">
                 </div>
                 <div>
                     <span class="item-name dark-inverted is-font-alt is-weight-600">{{$items['name']}}</span>
                     <span class="item-meta">
                             <span>{!! Currency::symbol(user('gateway.currency')) . number_format($items['price']) !!}</span>
                     </span>
                 </div>
             </div>
             <div class="flex-table-cell" data-th="{{ __('Earned') }}">
                 <span class="tag is-green is-rounded">{!! Currency::symbol(user('gateway.currency')) .  number_format($items['earned']) !!}</span>
             </div>
             <div class="flex-table-cell" data-th="{{ __('Sold') }}">
                 <a class="action-link is-pushed-mobile">{!! number_format($items['sold']) !!} {{ __('Sold') }}</a>
             </div>
         </div>
         @endforeach
     </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card p-4 card-shadow border-0 radius-5 mt-5">
       <div class="title mb-3">
         <p class="m-0 fs-15px">{{ __('Visitors') }}</p>
       </div>
      <div class="line-stats mb-4">
           <div class="line-stat">
               <span>{{ __('This Month') }}</span>
               <span class="current">{{ __('Visits') }} - {{ nr($options->month['impression'] ?? '0') }} <span class="fs-15px">{{ __('Unique') }} - {{ nr($options->month['unique'] ?? '0') }}</span></span>
           </div>
           <div class="line-stat">
               <span>{{ __('This Year') }}</span>
               <span class="dark-inverted">{{ __('Visits') }} - {{ nr($options->year['impression'] ?? '0') }} <span class="fs-15px">{{ __('Unique') }} - {{ nr($options->year['unique'] ?? '0') }}</span></span>
           </div>
       </div>
      <div class="h-250px">
         <canvas class="line-chart" id="storeVisitors"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="mt-5">
  <p class="m-0 fs-20px">{{ __('Recent Orders') }}</p>
</div>
 <div class="flex-table mt-4">

     <!--Table header-->
     <div class="flex-table-header">
         <span class="is-grow">{{ __('Customer') }}</span>
         <span>{{ __('Date') }}</span>
         <span>{{ __('Amount') }}</span>
         <span>{{ __('Status') }}</span>
         <span>{{ __('Products') }}</span>
         <span class="cell-end">{{ __('Actions') }}</span>
     </div>

   @foreach($options->sales['recent_orders'] as $order)
     <!--Table item-->
     <div class="flex-table-item">
         <div class="flex-table-cell is-media is-grow" data-th="">
             <div>
                 <span class="item-name dark-inverted is-font-alt is-weight-600">{{ $order->details->first_name . ' ' . $order->details->last_name ?? ''  }}</span>
                 <span class="item-meta">
                         <span>#{{ $order->ref }}</span>
                 </span>
             </div>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Date') }}">
             <span class="light-text">{{ Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Amount') }}">
             <span class="dark-inverted is-weight-600">{!! clean(Currency::symbol(user('gateway.currency')), 'titles') .' '. number_format($order->price) !!}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Status') }}">
             <span class="tag is-green is-rounded">{{ $order->order_status == 1 ? __('Delivered') : '' }} {{ $order->order_status == 2 ? __('Pending') : '' }} {{ $order->order_status == 3 ? __('Canceled') : '' }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Products') }}">
             <a class="action-link is-pushed-mobile">{{ count($order->products) }}</a>
         </div>
         <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
             <a href="{{ route('user-single-order', $order->id) }}" class="btn bg-blue btn_sm_primary effect-letter c-white ml-auto">{{ __('View Order') }}</a>
         </div>
     </div>
     @endforeach
 </div>
@endsection