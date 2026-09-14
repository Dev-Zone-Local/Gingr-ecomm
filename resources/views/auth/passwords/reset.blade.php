@extends('layouts.app')
@section('title', __('Reset password'))
@section('bodyClass', 'signup_full bg_dark')
@section('bodyAttr', 'data-bg-src="'. media('misc/Ecom-Store-Owner-Sign-in-Background.png') .'"')
@section('headJS')
  @if (config('app.captcha_status') && config('app.captcha_type') == 'recaptcha')
  {!! htmlScriptTagJsApi() !!}
  @endif
@stop
@section('content')
<style>
  header,footer{
    display: none !important;
  }
  html{
    height: 100%;
  }
  #content{
    height: initial;
  }
</style>
<div class="item_brand">
    <div class="container">
      <a href="{{ url('/') }}">
        <img src="{{ logo() }}" alt="{{ config('app.name') }}">
      </a>
    </div>
  </div>
  <section class="form_signup_one mt-8">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-lg-5 ml-auto">
          <div class="item_group">

       <form method="POST" action="{{ route('resetpassword') }}">
              <div class="col-12">
                <div class="title_sign">
                  <h2>{{ __('Reset password') }}</h2>
                  <p>{{ __('Use the form below to request for a password reset') }}</p>
                </div>
          @csrf
            <div class="form-group">
               <input type="text" class="form-control form-control-lg" placeholder="{{ __('Your email address') }}" name="email" autofocus>
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
              <button type="submit" class="btn w-100 margin-t-3 btn_account bg-orange-red c-white rounded-8">{{ __('Reset') }}</button>
            </div>
         </form>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- Start item_footer -->
  <div class="item_footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-lg-1">
          <p>© {{ date('Y') }} <a href="{{ url('/') }}" target="_blank">{{ config('app.name') }}</a> {{ __('All Right Reseved') }}
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- End. item_footer -->

@endsection
