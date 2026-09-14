@extends('layouts.app')
@section('headJS')
  @if (config('app.captcha_status') && config('app.captcha_type') == 'recaptcha')
  {!! htmlScriptTagJsApi() !!}
  @endif
@stop
@section('title', __('Resend activation'))
@section('content')
<div class="col-md-8 mx-auto mt-8 mb-5">
   <div class="card border-0 card-shadow p-4 radius-5">
      <div class="card-inner card-inner-lg">
         <div class="card-header border-0 radius-5 mb-4">
            <div class="nk-block-head-content">
               <h4 class="m-0 fs-15px">{{ __('Resend activation') }}</h4>
               <div class="nk-block-des">
                  <p class="m-0 fs-15px">{{ __('Use the form below to request an activation code') }}</p>
               </div>
            </div>
         </div>
         <form method="POST" action="{{ route('resend-token') }}">
            @csrf
              <div class="form-group custom">
                 <div class="form-label-group"><label class="form-label">{{ __('Email') }}</label></div>
                 <input type="text" class="form-control form-control-lg" placeholder="{{ __('Email address') }}" name="email">
              </div>
              @if (config('app.captcha_status') && config('app.captcha_type') == 'recaptcha')
               {!! htmlFormSnippet() !!}
               @endif
               @if (config('app.captcha_status') && config('app.captcha_type') == 'default')
               <div class="row mt-3 mb-4">
                 <div class="col-md-6 mb-4 mb-md-0">
                   <div class="bdrs-20 p-2 text-center card-shadow">
                       {!! captcha_img() !!}
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                       <input type="text" class="form-control form-control-lg @error('captcha') is-invalid @enderror" placeholder="{{ __('Captcha') }}" name="captcha">
                   </div>
                 </div>
               </div>
               @endif
              <div class="form-group">
                <button type="submit" class="btn w-100 margin-t-3 btn_sm_primary bg-orange-red c-white rounded-8">{{ __('Send') }}</button>
              </div>
           </form>
         </div>
      </div>
   </div>
@endsection
