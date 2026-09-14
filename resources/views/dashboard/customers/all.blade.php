@extends('layouts.app')
@section('title', __('Customers'))
@section('content')
<div class="nk-block-head mt-8">

  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Customers') }} <span class="badge badge-dim badge-primary badge-pill">{{ count($customers) }}</span></h2>
        <a href="{{ route('user-add-customer') }}" class="btn mt-0 scale btn_primary bg-blue effect-letter rounded-8">{{ __('Add customer') }}</a>
      </div>
    </div>
  </div>
</div>

 <div class="flex-table mt-4">

     <!--Table header-->
     <div class="flex-table-header">
         <span class="is-grow">{{ __('Customer') }}</span>
         <span>{{ __('Registered on') }}</span>
         <span>{{ __('Orders') }}</span>
         <span class="cell-end">{{ __('Actions') }}</span>
     </div>
     @foreach ($customers as $item)
     <div class="flex-table-item">
         <div class="flex-table-cell is-media is-grow" data-th="">
             <div class="h-avatar is-medium">
                 <img class="avatar is-squared ob-cover h-50px w-50px mr-3" src="{{ c_avatar($item->id) }}" alt="">
             </div>
             <div>
                 <span class="item-name dark-inverted is-font-alt is-weight-600">{{ $item->name }}</span>
                 <span class="item-meta">
                         <span>{{ $item->email }}</span>
                 </span>
             </div>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Registered on') }}">
             <span class="light-text">{{ \Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Orders') }}">
             <a class="action-link is-pushed-mobile">{{ nf(\App\Model\Product_Orders::where('customer', $item->id)->count(), 0) }}</a>
         </div>
         <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
             <a href="{{ route('user-customer', $item->id) }}" class="btn bg-blue btn_sm_primary effect-letter ml-auto">{{ __('View') }}</a>
         </div>
     </div>
     @endforeach
</div>
@endsection
