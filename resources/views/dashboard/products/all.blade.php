@extends('layouts.app')
@section('headJS')
<script src="{{ asset('js/Sortable.min.js') }}"></script>
@stop
@section('title', 'All Product')
@section('content')
<div class="nk-block-head mt-8">

  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('All Products') }} <span class="badge badge-dim badge-primary badge-pill">{{ count($products) }}</span></h2>
        <a href="{{ route('user-add-product') }}" class="btn scale btn_primary bg-blue c-white effect-letter rounded-8">{{ __('Add new product') }}</a>
      </div>
    </div>
  </div>
</div>
<div class="mt-3">
  <div class="row sortable-div" data-handle=".item-handle" data-route="{{ route('user-products-sortable') }}">
    @foreach ($products as $item)
    <div class="col-md-4 col-lg-3 sortable-item" data-id="{{$item->id}}">
       <div class="card card-shadow radius-5 border-0 product-card mb-5">
          <div class="card-body">
             <div class="d-flex flex-column align-items-center">
                <div class="product-img w-100">
                   <img class="w-100 radius-5 h-200px ob-cover" src="{{ getfirstproductimg($item->id) }}" alt=" ">
                </div>
                <div class="d-flex flex-column mr-auto mt-3">
                   <div class="d-flex flex-column mr-auto">
                      <span class="text-muted font-weight-bold text-sticker m-0 w-100">{{ __('Price - ') }} {{ number_format(!empty($item->salePrice) ? $item->salePrice : $item->price) }} {{ __('Stock') }} - {{ number_format($item->stock) }}</span>
                      <a href="#" class="text-dark text-hover-primary font-size-h4 font-weight-bolder mt-2">{{ $item->title }}</a>
                   </div>
                </div>
             </div>
             <div class="mb-10 mt-2 fs-13px font-weight-bold">{{ Str::limit(clean($item->description, 'clean_all'), $limit = 100, $end = '...') }}</div>
          </div>
          <div class="p-3 bdrs-20 bg-white d-flex align-items-center between-center">
           <div class="d-flex">
              <a href="{{ route('user-edit-product', $item->id) }}" class="text-muted d-flex ml-2"><em class="icon ni ni-edit lead mr-1"></em> {{ __('Edit') }}</a>
           </div>
           <div class="d-flex">
            <form action="{{ route('user-post-product', 'delete') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button data-confirm="{{ __('Are you sure you want to delete this?') }}" class="text-danger ml-2 d-flex bg-transparent align-items-center border-0"><em class="icon ni ni-edit lead mr-1"></em>{{ __('Delete') }}</button>
            </form>
           </div>
           <div class="d-flex">
              <a href="#" class="text-muted item-handle ml-2 d-flex"><em class="icon tio move_page lead mr-1"></em></a>
           </div>
          </div>
       </div>
    </div>
    @endforeach
  </div>
</div>
@stop

