@extends('layouts.app')
@section('title', __('Customer'))
@section('footerJS')
<script>
var totalSales = {
    labels: {!! $sales['sales_chart']['labels'] ?? '[]' !!},
    dataUnit: "{{__('Sold')}}",
    lineTension: .3,
    datasets: [{
         label: "Sales",
         color: "#9d72ff",
         background: NioApp.hexRGB("#9d72ff", .25),
         data: {!! $sales['sales_chart']['sales'] ?? '[]' !!}
     }]
};
</script>

@stop
@section('content')
<div class="row mt-7">
  <div class="col-md-4">
    <div class="dashboard-card is-welcome h-305px mb-3 mb-md-0 d-flex flex-column justify-content-center">
       <div class="welcome-title">
           <span class="text-muted-2">{{ __('Email') }}</span>
           <h3 class="dark-inverted fs-20px">{{ $customer->email }}</h3>
           <span class="text-muted-2">{{ __('Name') }}</span>
           <h3 class="dark-inverted fs-20px">{{ $customer->name }}</h3>
       </div>
       <div class="button-wrap">
           <form method="post" action="{{ route('user-chat-start') }}" class="form-group">
               @csrf
               <input type="hidden" name="customer" value="{{ $customer->id }}">
               <button class="btn bg-blue c-white btn-block">{{ __('Chat with customer') }} <em class="icon tio"></em></button>
           </form>
       </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="dashboard-card bg-white radius-5 p-5 h-100">
        <span class="text-muted-2">{{ __('Customer since') }}</span>
        <div class="p-relative">
           <h3 class="dark-inverted fs-20px">{{ Carbon\Carbon::parse($customer->created_at)->toFormattedDateString() }}</h3>
           <a href="" class="d-none btn bg-danger c-white btn_sm_primary btn_right_right p-2 fs-13px">{{ __('Remove User') }}</a>
        </div>

          <div class="quick-stats mt-4">
            <div class="quick-stats-inner">
                <div class="row">
                  <div class="col-md-12">
                    <!--Stat-->
                    <div class="quick-stat bg-blue p-3 radius-5 text-white mb-4 mb-md-0">
                        <div class="media-flex-center">
                            <div class="flex-meta">
                                <div class="title">
                                  <p class="m-0 fs-12px">{{ __('Total Orders') }}</p>
                                </div>
                                <span class="fs-40px">{{ number_format($count_orders) }}</span>
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
    <div class="card p-4 card-shadow border-0 radius-5 mt-5">
       <div class="title mb-3">
         <p class="m-0 fs-15px">{{ __('Amount spent') }}</p>
       </div>
      <div class="line-stats mb-4">
           <div class="line-stat">
               <span>{{ __('This Month') }}</span>
               <span class="current">{!! number_format($sales['this_month'] ?? '0') !!}</span>
           </div>
           <div class="line-stat">
               <span>{{ __('Last Month') }}</span>
               <span class="dark-inverted">{!! number_format($sales['last_month'] ?? '0') !!}</span>
           </div>
           <div class="line-stat">
               <span>{{ __('Total') }}</span>
               <span class="dark-inverted">{!! number_format($sales['overall_sale'] ?? '0') !!}</span>
           </div>
       </div>
      <div class="h-250px">
         <canvas class="line-chart" id="totalSales"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div id="account-billing-address" class="p-3 border-0 card-shadow card mt-5">
                <!-- Title -->
                <div class="card-header border-0">
                    <h3 class="fs-20px m-0">{{ __('Billing address') }}</h3>
                </div>
                <!-- Billing Address -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-block mb-4">
                                <span class="label-text d-block text-muted">{{ __('Street Number') }}</span>
                                <span class="label-value d-block">{{ $customer->details->billing_number ?? '' }}</span>
                            </div>

                            <div class="info-block mb-4">
                                <span class="label-text d-block text-muted">{{ __('City') }}</span>
                                <span class="label-value d-block">{{ $customer->details->city ?? '' }}</span>
                            </div>

                            <div class="info-block mb-4">
                                <span class="label-text d-block text-muted">{{ __('State') }}</span>
                                <span class="label-value d-block">{{ $customer->details->state ?? '' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="info-block mb-4">
                                <span class="label-text d-block text-muted">{{ __('Street') }}</span>
                                <span class="label-value d-block">{{ $customer->details->street ?? ''}}</span>
                            </div>

                            <div class="info-block mb-4">
                                <span class="label-text d-block text-muted">{{ __('Postal Code') }}</span>
                                <span class="label-value d-block">{{ $customer->details->postal_code ?? '' }}</span>
                            </div>

                            <div class="info-block mb-4">
                                <span class="label-text d-block text-muted">{{ __('Country') }}</span>
                                <span class="label-value d-block">{{ $customer->details->country ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Address Form -->
            </div>
  </div>
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

   @foreach($all_orders as $order)
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

     {{ $all_orders->links() }}
 </div>
@endsection
