@extends('layouts.app')

@section('title', __('Domains'))
@section('content')
  <div class="row justify-content-center text-center mt-8">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Domains') }}</h2>
        <a href="{{ route('user-domains-post') }}" class="btn scale btn_primary bg-blue c-white effect-letter rounded-8">{{ __('Add new domain') }}</a>
      </div>
    </div>
  </div>

@if (count($domains) > 0)
<div class="nk-block">
 <div class="flex-table mt-4">

     <!--Table header-->
     <div class="flex-table-header">
         <span>{{ __('Host') }}</span>
         <span>{{ __('Created on') }}</span>
         <span>{{ __('Status') }}</span>
         <span class="cell-end">{{ __('Actions') }}</span>
     </div>
      @foreach ($domains as $item)
     <div class="flex-table-item">
         <div class="flex-table-cell" data-th="">
            <span>{{ ($item->host) }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Created on') }}">
             <span class="light-text">{{ Carbon\Carbon::parse($item->updated_at)->toFormattedDateString() }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Status') }}">
             <span class="text-sticker c-white {{$item->status == 0 ? ' bg-warning' : NULL }} {{$item->status == 1 ? ' bg-success' : NULL }}">{{$item->status == 0 ? __('Inactive') : NULL}} {{$item->status == 1 ? __('Active') : NULL }}</span>
         </div>
         <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
            @if ($item->id == user('domain') && $item->status == 1)
             <span class="text-sticker radius-2 bg-success c-white">{{ __('Active Domain') }}</span>
             @else
             @if ($item->status == 1)
             <a href="{{ route('user-domains-post', ['id' => $item->id, 'type' => 'setDomain']) }}" class="text-sticker ml-auto"><i class="tio checkmark_circle_outlined fs-17px"></i></a>
             @endif
            @endif

             <a href="{{ route('user-domains-post', ['id' => $item->id]) }}" class="text-sticker ml-auto">{{ __('Edit') }}</a>

             <a href="{{ route('user-domains-post', ['id' => $item->id, 'delete' => true]) }}" data-confirm="{{ __('Are you sure you want to delete this?') }}" class="btn bg-danger fs-13px c-white"><i class="tio add_to_trash"></i></a>
         </div>
     </div>
    @endforeach
   </div>
</div>
@else
<div class="nk-block-head">
   <div class="nk-block-head-content text-center">
       <h5 class="nk-block-title fw-normal">{{ __('Nothing found') }}</h5>
   </div>
</div>
@endif
@endsection