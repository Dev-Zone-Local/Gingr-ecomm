@extends('layouts.app')

@section('title', __('Shipping'))
@section('content')
  <div class="row justify-content-center text-center mt-8">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Shipping') }}</h2>
            <a href="{{ route('user-add-shipping') }}" class="btn btn_sm_primary c-white effect-letter bg-blue"><em class="icon ni ni-plus"></em> {{ __('Add new location') }}</a>
      </div>
    </div>
  </div>

@if (!empty($user->shipping))
         <div class="flex-table mt-4">
             <div class="flex-table-header">
                 <span>{{ __('Country') }}</span>
                 <span>{{ __('State') }}</span>
                 <span class="cell-end">{{ __('Actions') }}</span>
             </div>
              @foreach ($user->shipping as $key => $value)
                 <div class="flex-table-item">
                     <div class="flex-table-cell" data-th="{{ __('Country') }}">
                         <span class="light-text fs-11px">{{ $key }}</span>
                     </div>
                     <div class="flex-table-cell" data-th="{{ __('States') }}">
                         <span class="light-text fs-11px">{{ count(user('shipping.'.$key)) }}</span>
                     </div>
                     <div class="flex-table-cell cell-end" data-th="">
                      <div class="d-flex">
                        <a class="text-sticker" href="{{ route('user-edit-shipping', $key) }}">{{ __('Edit') }} <i class="tio edit"></i></a>
                        <a class="text-sticker bg-danger c-white" data-confirm="{{ __('Are you sure you want to delete this?') }}" href="{{ route('user-delete-shipping', $key) }}">{{ __('Delete') }} <i class="tio edit"></i></a>
                      </div>
                     </div>
                 </div>
                  @endforeach
               </div>
@else
<div class="nk-block-head">
   <div class="nk-block-head-content text-center">
       <h5 class="nk-block-title fw-normal">{{ __('Nothing found') }}</h5>
   </div>
</div>
@endif
@endsection