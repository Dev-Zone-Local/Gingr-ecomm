@extends('layouts.app')
@section('title', __('Orders'))
@section('content')
@section('footerJS')
<script src="{{ url('js/others.js') }}"></script>
@stop
  <div class="row justify-content-center text-center mt-8">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Orders') }}</h2>

        <a href="{{ route('user-export-orders') }}">{{ __('Export') }}</a>
      </div>
    </div>
  </div>
<div class="container-fluid">
  <div class="flex-table">
    <!--Table header-->
    <div class="flex-table-header">
        <span>
          <div class="nk-tb-col nk-tb-col-check">
             <div class="custom-control custom-control-sm custom-checkbox notext select_all">
              <input type="checkbox" class="custom-control-input" id="select_all">
              <label class="custom-control-label" for="select_all"></label>
            </div>
          </div>
        </span>
        <span>{{ __('Ref') }}</span>
        <span>{{ __('Gateway') }}</span>
        <span>{{ __('Date') }}</span>
        <span>{{ __('Status') }}</span>
        <span>{{ __('Name') }}</span>
        <span>{{ __('Purchased') }}</span>
        <span class="cell-end">
         <div class="dropdown">
            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger mr-n1" data-toggle="dropdown"><em class="icon tio more_vertical"></em></a>
            <div class="dropdown-menu dropdown-menu-right">
               <ul class="link-list-opt no-bdr m-0">
                  <li>
                    <a class="update_all d-flex text-muted" data-route="{{ route('user-order-status') }}" data-type="mark_as_delivered"><em class="icon tio truck"></em><span class="mb-3 ml-2">{{ __('Mark as Delivered') }}</span></a>
                  </li>

                  <li><a class="update_all text-muted d-flex" data-route="{{ route('user-order-status') }}" data-type="remove"><em class="icon tio add_to_trash"></em><span class="mb-0 ml-2">{{ __('Remove Orders') }}</span></a></li>
               </ul>
            </div>
         </div>
        </span>
    </div>

    @foreach($orders as $order)
    <!--Table item-->
    <div class="flex-table-item">
        <div class="flex-table-cell">
           <div class="custom-control custom-control-sm custom-checkbox notext">
            <input type="checkbox" name="action_select[]" value="{{ $order->id }}" class="custom-control-input" id="{{ 'select_'.$order->id }}">
            <label class="custom-control-label" for="{{ 'select_'.$order->id }}"></label>
          </div>
        </div>
        <div class="flex-table-cell" data-th="{{ __('Reference') }}">
            <span class="light-text">{{ $order->ref }}</span>
        </div>
        <div class="flex-table-cell" data-th="{{ __('Gateway') }}">
            <span class="light-text">{{ $order->gateway }}</span>
        </div>
        <div class="flex-table-cell" data-th="{{ __('Date') }}">
            <span class="dark-inverted is-weight-600">{{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}</span>
        </div>
        <div class="flex-table-cell" data-th="{{ __('Status') }}">
            <span class="tag is-green is-rounded">{{ $order->order_status == 1 ? __('Delivered') : '' }} {{ $order->order_status == 2 ? __('Pending') : '' }} {{ $order->order_status == 3 ? __('Canceled') : '' }}</span>
        </div>
        <div class="flex-table-cell" data-th="{{ __('Name') }}">
            <a class="action-link is-pushed-mobile">{{ $order->details->first_name . ' ' . $order->details->last_name ?? ''  }}</a>
        </div>
        <div class="flex-table-cell" data-th="{{ __('Purchased') }}">
            <a class="action-link is-pushed-mobile">{{ count($order->products) .' @ '. clean(Currency::symbol(user('gateway.currency')), 'titles') .' '. number_format($order->price) }}</a>
        </div>
        <div class="flex-table-cell cell-end" data-th="Actions">

            <a href="{{ route('user-single-order', $order->id) }}" class="text-sticker">{{ __('Order Details') }}</a>
                 <div class="dropdown mr-n1">
                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon tio more_vertical"></em></a>
                    <div class="dropdown-menu dropdown-menu-right">
                       <ul class="link-list-opt no-bdr p-0 m-0">
                          <li>
                            <form action="{{ route('user-order-status') }}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $order->id }}">
                              <input type="hidden" name="action" value="mark_as_delivered">
                              <button class="btn" title="{{ __('Remove Order') }}" data-confirm="{{ __('Are you sure?') }}">
                                <em class="icon tio truck"></em>
                                <span>{{ __('Mark as Delivered') }}</span>
                              </button>
                            </form>
                          </li>
                          <li>
                            <form action="{{ route('user-order-status') }}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $order->id }}">
                              <input type="hidden" name="action" value="remove">
                              <button class="btn" title="{{ __('Remove Order') }}" data-confirm="{{ __('Are you sure you want to remove this order?') }}">
                                <em class="icon tio add_to_trash"></em>
                                <span class="ml-1">{{ __('Remove Order') }}</span>
                              </button>
                            </form>
                          </li>
                       </ul>
                    </div>
                 </div>
        </div>
    </div>
    @endforeach
</div>
</div>
  <div class="card">
    <div class="card-inner">
      <div class="nk-block-between-md g-3">
        <div class="g">
          {{ $orders->links() }}
        </div>
        </div>
      </div>
  </div>
@stop