@extends('layouts.app')
@section('title', __('Refund'))
@section('content')


  <div class="order-details-header mt-8">
    <div class="left">
      <span id="order-details-id">{{ __('Refund request') }}</span>
      <span id="order-details-date">{{ __('Requested on') }} <var>{{ \Carbon\Carbon::parse($refund->created_at)->toFormattedDateString() }}</var></span>

      <a href="{{ route('user-single-order', $order->id) }}">{{ __('View order') }}</a>
    </div>


    @if (!empty($customer))
    <div class="right">
      <img id="order-details-avatar" src="{{c_avatar($customer->id)}}" alt=" ">
      <div class="inner-meta">
        <span>{{ __('Requested by') }}</span>
        <span id="order-details-contact"><a href="{{ route('user-customer', ['id' => $customer->id]) }}">{{ $customer->name }}</a></span>
      </div>
    </div>
   @endif
  </div>


<div class="row">
  <div class="col-md-7">
        <div class="mt-5">
          <p class="m-0 fs-20px">{{ __('Products') }}</p>
        </div>
         <div class="flex-table mt-4">
             <!--Table header-->
             <div class="flex-table-header">
                 <span>{{ __('Product') }}</span>
                 <span>{{ __('Quantity') }}</span>
                 <span>{{ __('Price') }}</span>
                 <span>{{ __('Options') }}</span>
                 <span>{{ __('Total') }}</span>
             </div>
              @foreach ($products as $key => $items)
                 <div class="flex-table-item">
                     <div class="flex-table-cell is-media" data-th="">
                         <div class="h-avatar is-medium">
                             <img class="avatar is-squared h-40px object-cover" src="{{ getfirstproductimg($key) }}" alt=" ">
                         </div>
                         <div>
                             <span class="item-name dark-inverted fs-11px">{{$items['name']}}</span>
                         </div>
                     </div>
                     <div class="flex-table-cell" data-th="{{ __('Quantity') }}">
                         <span class="light-text fs-11px">{{$items['qty']}}</span>
                     </div>
                     <div class="flex-table-cell" data-th="{{ __('Price') }}">
                         <span class="tag fs-11px">{{nf($items['price'])}}</span>
                     </div>
                     <div class="flex-table-cell" data-th="{{ __('Options') }}">
                         <span class="tag fs-11px">{{$items['options']}}</span>
                     </div>
                     <div class="flex-table-cell" data-th="{{ __('Total') }}">
                         <span class="tag fs-11px">{{ nf(($items['price'] * $items['qty'])) }}</span>
                     </div>
                 </div>
          @endforeach
      </div>
  </div>

  <div class="col-md-5">
    <div class="card p-3 card-shadow border-0 mt-5">
      <form action="{{ route('user-post-refunds', 'refund-status') }}" method="post" class="mb-4">
        @csrf
        <div class="card-header border-0">
          {{ __('Change refund status') }}
        </div>
        <input type="hidden" value="{{ $refund->id }}" name="refund_id">
        <div class="form-group mt-3">
          <select name="refund_status" class="custom-select">
            <option value="1" {{ $refund->status == 1 ? 'selected' : '' }}>{{ __('Given refund') }}</option>
            <option value="0" {{ $refund->status == 0 ? 'selected' : '' }}>{{ __('Refund pending') }}</option>
            <option value="2" {{ $refund->status == 2 ? 'selected' : '' }}>{{ __('Refund canceled') }}</option>
          </select>
        </div>

        <button class="btn btn-block bg-blue mt-2 c-white">{{ __('Save') }}</button>
      </form>


      <form method="post" action="{{ route('user-post-refunds', 'send-refund') }}" class="">
        @csrf
        <input type="hidden" value="{{ $refund->id }}" name="refund_id">

        <input type="hidden" name="email" value="{{ $customer->email }}">

        <div class="card-header border-0">
          {{ __('Send Refund Email or Questions') }}
        </div>

        <div class="mt-3 form-group">
          <input type="text" name="mail_subject" class="form-control" placeholder="{{ __('Mail Subject') }}">
        </div>
        <div class="form-group">
          <textarea name="mail_message" placeholder="{{ __('Mail Message') }}" class="form-control mt-3" id="" cols="30" rows="10"></textarea>
        </div>

        <button class="btn btn-block bg-blue mt-2 c-white">{{ __('Send') }}</button>
      </form>
    </div>
  </div>
</div>
  @stop