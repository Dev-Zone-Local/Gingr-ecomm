@extends('layouts.app')
@section('title', __('Refunds'))
@section('content')
<div class="nk-block-head mt-8">

  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Refunds') }} <span class="badge badge-dim badge-primary badge-pill">{{ count($refunds) }}</span></h2>
      </div>
    </div>
  </div>
</div>

 <div class="flex-table mt-4">

     <!--Table header-->
     <div class="flex-table-header">
         <span class="is-grow">{{ __('Customer') }}</span>
         <span>{{ __('Requested on') }}</span>
         <span>{{ __('Status') }}</span>
         <span class="cell-end">{{ __('Actions') }}</span>
     </div>
     @foreach ($refunds as $item)
     <div class="flex-table-item">
         <div class="flex-table-cell is-media is-grow" data-th="">
             <div class="h-avatar is-medium">
                 <img class="avatar is-squared ob-cover h-50px w-50px mr-3" src="{{ c_avatar($item->customer) }}" alt="">
             </div>
             <div>
                 <span class="item-name dark-inverted is-font-alt is-weight-600">{{ customer('name', $item->customer) }}</span>
                 <span class="item-meta">
                         <span>{{ customer('email', $item->customer) }}</span>
                 </span>
             </div>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Requested on') }}">
             <span class="light-text">{{ \Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Status') }}">
             <a class="action-link is-pushed-mobile text-sticker {{ $item->status == 1 ? 'bg-success c-white' : '' }}">{{ $item->status == 0 ? __('Not Refunded') : '' }} {{ $item->status == 1 ? __('Refunded') : '' }} {{ $item->status == 2 ? __('Canceled') : '' }}</a>
         </div>
         <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
             <a href="{{ route('user-single-refund', $item->id) }}" class="btn bg-blue btn_sm_primary effect-letter ml-auto">{{ __('View') }}</a>
         </div>
     </div>
     @endforeach
</div>
@endsection
