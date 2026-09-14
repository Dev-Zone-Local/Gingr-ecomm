@extends('layouts.app')
@section('title', __('Login'))
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
  #content{
    height: initial;
  }
</style>
  <!-- Start form_signup_onek -->
  <section class="form_signup_one signup_two mt-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-1 my-auto">

          <div class="item_brand margin-b-3">
            <a href="{{ url('/') }}">
              <img class="mr-2 w-70px" src="{{ logo() }}" alt="">
              <span hidden>{{ config('app.name') }}.</span>
            </a>
          </div>

          <div class="title_sections margin-b-5">
            <h2 class="c-white mb-1">{{ __('Sign in') }}</h2>
            <p class="c-white">{{ __('New user?') }} <a href="{{ route('register') }}" class="c-blue">{{ __('Create an account') }}</a></p>
          </div>

          <div class="list__point">
            <div class="item media">
              <div class="icob">
                <i class="tio account_circle"></i>
              </div>
              <div class="media-body my-auto">
                <p>{{ __('Sign in to your account') }}</p>
              </div>
            </div>
            <div class="item media">
              <div class="icob">
                <i class="tio explore_outlined"></i>
              </div>
              <div class="media-body my-auto">
                <p>{{ __('Manage your store and products') }}</p>
              </div>
            </div>
            <div class="item media">
              <div class="icob">
                <i class="tio call_talking"></i>
              </div>
              <div class="media-body my-auto">
                <p>{{ __('Provide support to your customers') }}</p>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-7 col-lg-5 ml-lg-auto">
          <div class="item_group">
            <form action="{{ route('login') }}" method="post" class="row">
              @csrf
              <div class="col-12">
                <div class="form-group">
                  <label>{{ __('Username or Email') }}</label>
                  <input type="text" class="form-control @error('user') is-invalid @enderror" placeholder="{{ __('Enter your email address or username') }}" name="user" value="{{ old('username') }}" autocomplete="user" autofocus>
                </div>
                @error('user')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="col-md-12">
                <div class="form-group --password" id="show_hide_password">
                  <label>{{ __('Password') }}</label>
                  <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{ __('Enter your password') }}" name="password" autocomplete="current-password" data-toggle="password"/>
                    <div class="input-group-prepend hide_show">
                      <a href=""><span class="input-group-text tio hidden_outlined"></span></a>
                    </div>
                  </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="row">
                  <div class="col-6">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                       <label class="custom-control-label" for="remember"><span class="text-muted">{{ __('Remember me') }}</span></label>
                    </div>
                  </div>
                  <div class="col-6">
                    <a href="{{ route('resetpassword') }}" class="d-flex justify-content-end font-s-13 c-blue">{{ __('Forgot Password?') }}</a>
                  </div>
                </div>
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
              <div class="col-12">
                <button class="btn w-100 margin-t-3 btn_account bg-orange-red c-white rounded-8">
                  {{ __('Sign in') }}
                </button>
              </div>
              <div class="col-12">
                <div class="google_sign margin-t-3">
                  @if (config('app.facebook_status') == 1 || config('app.google_status') == 1)
                  <p class="text-center font-s-13 c-gray margin-b-3">{{ __('Or Sign in with socials') }}</p>
                  @endif
                    @if (config('app.google_status') == 1)
                  <a href="{{ route('user-auth-google') }}" class="btn btn_social rounded-8 mb-3 d-flex align-items-center justify-content-center">
                    <i class="tio google"></i>
                    {{ __('Continue with Google') }}
                  </a>
                  @endif

                    @if (config('app.facebook_status') == 1)
                    <a href="{{ route('user-auth-facebook') }}" class="btn btn_social rounded-8 bg-blue c-white d-flex align-items-center justify-content-center">
                      <i class="tio facebook_square"></i>
                      {{ __('Continue with Facebook') }}
                    </a>
                    @endif
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>

    </div>
  </section>
  <!-- End.form_signup_one -->

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
