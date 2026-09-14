@extends('layouts.app')

@section('title', __('Transactions History'))
@section('content')
<div class="nk-block-head mt-8">

  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Transactions History') }} <span class="badge badge-dim badge-primary badge-pill">{{ nf($payments->total(), 0) }}</span></h2>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card p-4 card-shadow border-0 radius-5">
      <div class="nk-ck mt-5 h-250px">
          <canvas class="line-chart" id="paymentsvisitschart"></canvas>
      </div>
    </div>
  </div>
</div>
@if (count($payments) > 0)

 <div class="flex-table mt-4">

     <!--Table header-->
     <div class="flex-table-header">
         <span>{{ __('Name') }}</span>
         <span>{{ __('Email') }}</span>
         <span>{{ __('Price') }}</span>
         <span>{{ __('Package | Duration') }}</span>
         <span>{{ __('Date') }}</span>
         @if (settings('business.enabled'))
          <span class="cell-end">{{ __('Actions') }}</span>
         @endif
     </div>
      @foreach ($payments as $item)
       <div class="flex-table-item">
           <div class="flex-table-cell is-media" data-th="">
              <span class="light-text">{{ $item->name }}</span>
           </div>
           <div class="flex-table-cell" data-th="{{ __('Email') }}">
               <span class="light-text">{{$item->email}}</span>
           </div>
           <div class="flex-table-cell" data-th="{{ __('Price') }}">
               <span class="dark-inverted is-weight-600">{{ $item->price }}</span>
           </div>
           <div class="flex-table-cell" data-th="{{ __('Package | Duration') }}">
               <span class="tag is-green is-rounded">{{ucfirst($item->package_name)}} | {{ucfirst($item->duration)}}</span>
           </div>
           <div class="flex-table-cell" data-th="{{ __('Date') }}">
               <a class="action-link is-pushed-mobile">{{ Carbon\Carbon::parse($item->date)->toFormattedDateString() }}</a>
           </div>
           @if (settings('business.enabled'))
           <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
               <a class="btn bg-blue btn_sm_primary effect-letter c-white" href="{{ route('user-transactions', ['invoice_id' => $item->id]) }}">{{ __('View invoice') }}</a>
           </div>
           @endif
       </div>
     @endforeach

   </div>

   <div class="card">
      <div class="card-inner">
         <div class="nk-block-between-md g-3">
            <div class="g">
               {{$payments->withQueryString()->links()}}
            </div>
         </div>
      </div>
   </div>
@else
<div class="nk-block-head">
   <div class="nk-block-head-content text-center">
       <h5 class="nk-block-title fw-normal">{{ __('Nothing found') }}</h5>
   </div>
</div>
@endif
@section('footerJS')
<script>
   var paymentsvisitschart = {
         labels: {!! !empty($paymentschart['labels']) ? $paymentschart['labels'] : '[0]' !!},
         dataUnit: "",
         lineTension: .4,
         legend: !0,
       datasets:[{
        label: "{{ __('Total payments') }}",
        color:"#000000",
        dash:[5],
        background:"transparent",
        data:{!! !empty($paymentschart['count']) ? $paymentschart['count'] : '[]' !!}},{
        label: "{{ __('Paid') }}",
        color:"#a0aec0",
        dash:0,
        background:NioApp.hexRGB("#798bff",.15),
        data:{!! !empty($paymentschart['amount']) ? $paymentschart['amount'] : '[]' !!}}]
   };
</script>
@stop
@endsection
