@extends('layouts.app')

@section('title', __('Add New Shipping'))
@section('content')
<form action="{{ route('user-shipping-post', 'new') }}" method="post">
  @csrf

  <div class="row justify-content-center text-center mt-8">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Shipping Locations') }}</h2>
      </div>
    </div>
  </div>
<div class="mt-4 card card-body border-0 card-shadow radius-5">
     <div class="form-group custom mb-1 mb-lg-4">
       <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
         <span>{{ __('Select country') }}</span>
         <small class="d-block mt-2">{{ __('Select a shipping country and add the state(s) or province below') }}</small>
       </label>
      <div class="form-control-wrap">
         <select class="form-select custom-select" data-search="on" data-ui="lg" name="country">
          @foreach ($countries as $item => $value)
            <option value="{{$value}}">{{$value}}</option>
          @endforeach
        </select>
      </div>
     </div>
     <div class="dy-wrap"></div>
     <div>
        <a class="btn btn_sm_primary c-white effect-letter bg-blue dy-add-field-button">{{ __('Add State or Province') }}</a>
     </div>

     <div class="mt-5">
       
        <button class="btn btn_sm_primary c-white effect-letter bg-blue" type="submit">{{ __('Save') }}</button>
     </div>
  </div>
</form>

    <div class="dy-field-add d-none">
     <div class="dy-item p-4 mb-3 card-bordered bdrs-20" data-dy-name="shipping">
       <div class="row align-center">
         <div class="col-md-4">
           <div class="form-group custom mb-1">
              <label class="muted-deep fw-normal m-2">{{ __('State or Province') }}</label>
              <input type="text" class="form-control" placeholder="{{ __('Specify state or province') }}" data-dy-item-name="province" name="">
           </div>
         </div>
         <div class="col-md-3">
           <div class="form-group custom mb-1">
              <label class="muted-deep fw-normal m-2">{{ __('Type') }}</label>
            <div class="form-control-wrap">
               <select name="type" class="custom-select" data-dy-item-name="type">
                  <option value="free">{{ __('Flat rate') }}</option>
                  <option value="free">{{ __('Pickup') }}</option>
                  <option value="free">{{ __('Free shipping') }}</option>
              </select>
            </div>
           </div>
         </div>
         <div class="col-md-3">
           <div class="form-group custom mb-1">
              <label class="muted-deep fw-normal m-2">{{ __('Costs') }}</label>
              <input type="text" class="form-control" placeholder="{{ __('Shipping cost') }}" data-dy-item-name="cost" name="">
           </div>
         </div>
         <div class="col-md-2 d-flex align-center">
            <button class="rouned-pill btn-danger btn remove" type="button">X</button>
         </div>
       </div>
       <hr class="d-block d-lg-none">
     </div>
   </div>
@endsection