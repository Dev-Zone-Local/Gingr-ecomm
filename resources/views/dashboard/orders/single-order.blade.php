@extends('layouts.app')
@section('title', __('Order'))
@section('content')


  <div class="order-details-header mt-8">
    <div class="left">
      <span id="order-details-id">{{ __('ORDER') }} <var>{{ $order->ref }}</var></span>
      <span id="order-details-date">{{ __('Issued on') }} <var>{{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}</var></span>
    </div>
    @if (!empty($customer))
    <div class="right">
      <img id="order-details-avatar" src="{{c_avatar($customer->id)}}" alt=" ">
      <div class="inner-meta">
        <span>{{ __('Ordered By') }}</span>
        <span id="order-details-contact"><a href="{{ route('user-customer', ['id' => $customer->id]) }}">{{ $customer->name }}</a></span>
      </div>
    </div>
   @endif
  </div>


<div class="row">
  <div class="col-md-4">
    <div class="quick-stat bg-white card-shadow p-3 radius-10 text-white mb-4 mb-lg-0">
      <div class="media-flex-center">
            <div class="flex-meta">
                <div class="title">
                  <i class="tio dollar_outlined text-muted-2 fs-45px"></i>
                  <span class="text-muted-2 fs-18px">{{ __('Payment') }}</span>
                  <span class="d-block c-black">{{ $order->gateway }}</span>
                </div>
            </div>

            <div class="flex-end">
              <a href="{{ route('user-single-order', ['id' => $order->id, 'type' => 'invoice']) }}" class="fs-13px text-muted-2">{{ __('View invoice') }}</a>
            </div>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="quick-stat bg-white card-shadow p-3 radius-10 text-white mb-4 mb-lg-0">
      <div class="media-flex-center">
            <div class="flex-meta">
                <div class="title">
                  <i class="tio premium_outlined text-muted-2 fs-45px"></i>
                  <span class="text-muted-2 fs-18px">{{ __('Shipping') }}</span>
                  <span class="d-block c-black">{{ $order->details->{'country'} ?? '' }}</span>
                </div>
                <span class="fs-40px"></span>
            </div>

            <div class="flex-end">
              <a href="{{ route('user-single-order', ['id' => $order->id, 'type' => 'invoice']) }}" class="fs-13px text-muted-2">{{ __('View invoice') }}</a>
            </div>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="quick-stat bg-white card-shadow p-3 radius-10 text-white mb-4 mb-lg-0">
      <div class="media-flex-center">
            <div class="flex-meta">
                <div class="title">
                  <i class="tio top_security_outlined text-muted-2 fs-45px"></i>
                  <span class="text-muted-2 fs-18px">{{ __('Status') }}</span>
                  <span class="d-block c-black">{{ $order->order_status == 1 ? __('Delivered') : '' }} {{ $order->order_status == 2 ? __('Pending') : '' }} {{ $order->order_status == 3 ? __('Canceled') : '' }}</span>
                </div>
                <span class="fs-40px"></span>
            </div>

            <div class="flex-end">
              <a href="{{ route('user-single-order', ['id' => $order->id, 'type' => 'invoice']) }}" class="fs-13px text-muted-2">{{ __('View invoice') }}</a>
            </div>
        </div>
    </div>
  </div>

  <div class="col-md-8">
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

  <div class="col-md-4">
    <form method="post" action="{{ route('user-order-status') }}" class="card p-3 card-shadow border-0 mt-5 mt-md-8">
      @csrf

      <input type="hidden" name="action" value="update_order">

      <input type="hidden" name="id" value="{{ $order->id }}">
      <div class="card-header border-0">
        {{ __('Update Order') }}
      </div>

      <div class="form-group mt-3">
        <select name="order_status" class="custom-select">
          <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }}>{{ __('Set as delivered') }}</option>
          <option value="2" {{ $order->order_status == 2 ? 'selected' : '' }}>{{ __('Set as pending') }}</option>
          <option value="3" {{ $order->order_status == 3 ? 'selected' : '' }}>{{ __('Set as canceled') }}</option>
        </select>
      </div>
      <div class="form-group mt-3">
        <select name="send_email" class="custom-select">
          <option value="1" {{ $order->send_email == 1 ? 'selected' : '' }}>{{ __('Send email on order update') }}</option>
          <option value="0" {{ $order->send_email == 0 ? 'selected' : '' }}>{{ __('Do not send email') }}</option>
        </select>
      </div>  
      <button class="btn btn-block bg-blue mt-2 c-white">{{ __('Save') }}</button>
    </form>
  </div>

  <div class="col-md-7">
    <div class="p-3 border-0 card-shadow card mt-5">
                <!-- Title -->
                <div class="card-header border-0">
                    <h3 class="fs-20px m-0">{{ __('Billing address') }}</h3>
                </div>
                <!-- Billing Address -->
                <div class="card-body">
                        <div class="row">
                         @foreach ($order->details as $key => $value)
                            <div class="info-block col-6 mb-4">
                                <span class="label-text d-block text-muted">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                                <span class="label-value d-block">{{ $value ?? '' }}</span>
                            </div>
                          @endforeach
                        </div>
                </div>
                <!-- /Address Form -->
            </div>
  </div>
  <div class="col-md-5">
    
    <form method="post" action="{{ route('user-order-status') }}" class="card p-3 card-shadow border-0 mt-5">
      @csrf

      <input type="hidden" name="action" value="send_custom_order_mail">

      <input type="hidden" name="id" value="{{ $order->id }}">
      <div class="card-header border-0">
        {{ __('Send Email') }}
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
  @stop