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

       <form method="POST" action="{{ route('reset.password') }}">
              <div class="col-12">
                <div class="title_sign">
                  <h2>{{ __('Reset password') }}</h2>
                  <p>{{ __('Use the form below to reset your password') }}</p>
                </div>
          @csrf
          <input type="hidden" value="{{$token}}" name="token">
            <div class="form-group">
               <input type="text" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('enter your new password') }}" name="password" value="{{ old('username') }}" autocomplete="user" autofocus>
               @error('password')
               <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
               @enderror
            </div>
            <div class="form-group">
               <input type="text" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('confirm your password') }}" name="password_confirmation">
            </div>
            <div class="form-group">
              <button type="submit" class="btn w-100 margin-t-3 btn_account bg-orange-red c-white rounded-8">{{ __('Change password') }}</button>
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
