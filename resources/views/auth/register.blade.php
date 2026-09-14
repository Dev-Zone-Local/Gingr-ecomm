@extends('layouts.app')
@section('title', __('Register'))
@section('bodyAttr', 'data-bg-src="'. media('misc/Ecom-Store-Owner-Sign-up-Background.png') .'"')
@section('bodyClass', 'signup_full bg_dark')
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
            <h2 class="c-white mb-1">{{ __('Sign up') }}</h2>
            <p class="c-white">{{ __('Have an account?') }} <a href="{{ route('login') }}" class="c-blue">{{ __('Login') }}</a></p>
          </div>

          <div class="list__point">
            <div class="item media">
              <div class="icob">
                <i class="tio account_circle"></i>
              </div>
              <div class="media-body my-auto">
                <p>{{ __('Create an account for free') }}</p>
              </div>
            </div>
            <div class="item media">
              <div class="icob">
                <i class="tio explore_outlined"></i>
              </div>
              <div class="media-body my-auto">
                <p>{{ __('Set up your store and start sharing') }}</p>
              </div>
            </div>
            <div class="item media">
              <div class="icob">
                <i class="tio call_talking"></i>
              </div>
              <div class="media-body my-auto">
                <p>{{ __('Get 24/7 support') }}</p>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-7 col-lg-5 ml-lg-auto">
          <div class="item_group">

         <form method="POST" action="{{ route('register') }}">
            @csrf
              <div class="row">
                <div class="col">
                  <div class="form-group custom">
                       <input class="form-control form-control-lg @error('first_name') is-invalid @enderror" type="text" placeholder="{{ __('First Name') }}" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus/>
                     @error('first_name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group custom">
                       <input class="form-control form-control-lg @error('last_name') is-invalid @enderror" type="text" placeholder="{{ __('Last Name') }}" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus/>
                     @error('last_name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group custom">
                       <input id="username_email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" placeholder="{{ __('Email') }}" name="email" value="{{ !empty(old('email')) ? old('email') : request()->get('email') }}" autocomplete="email"/>
                     @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                  </div>
                </div>
              </div>
              <div class="form-group custom">
                   <input id="username" class="form-control form-control-lg @error('username') is-invalid @enderror" type="text" placeholder="{{ __('Username') }}" name="username" value="{{ old('username') }}" autocomplete="username"/>
                 @error('username')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group custom">
                      <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" placeholder="{{ __('Password') }}" name="password" value="{{ old('password') }}" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>

                            <small class="d-block mt-3">{{ __('Note') }} : {{ __('Password must contain at least one lowercase letter, one uppercase letter and a special character') }}</small>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group custom">
                      <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" autocomplete="new-password" class="form-control form-control-lg" />
                  </div>

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
              @if (!empty($website->privacy) || !empty($website->terms))
              <div class="col-12 p-0 mb-2 mt-3">
                <div class="form-group">
                  <div class="custom-control custom-control-xs custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkbox" required="">
                      <label class="custom-control-label" for="checkbox">{{ __('I agree to ') }}<b>{{env("APP_HOME") }}</b> {!! clean((!empty($website->privacy) ? '<a href="' . url($website->privacy) . '">'.__('Privacy Policy').'</a>' : "") . (!empty($website->privacy) && !empty($website->terms) ? ' &amp; ' : "") .(!empty($website->terms) ? '<a href="' . url($website->terms) . '">'.__('Terms').'</a>' : ""), 'titles') . ' ' . __('of this site') !!}
                    </label>
                  </div>
                </div>
              </div>
              @endif
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
                  {{ __('Register') }}
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