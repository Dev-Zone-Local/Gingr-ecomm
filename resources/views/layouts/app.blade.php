<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    @if(!empty(settings('favicon')))
        <link href="{{ favicon() }}" rel="shortcut icon" type="image/png" />
    @endif
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Styles --> 
    @foreach(['bootstrap.min.css', 'animate.css', 'swiper.min.css', 'icons.css', 'aos.css', 'main.css', 'normalize.css', 'ecom.css', 'classic.min.css'] as $file)
    <link href="{{ asset('assets/css/' . $file . '?v=' . env('APP_VERSION')) }}" rel="stylesheet">
    @endforeach
    
    <!-- Scripts -->
    <script src="{{ asset('js/bundle.js') }}"></script>
    <script src="{{ asset('js/pickr.es5.min.js') }}"></script>
    @yield('headJS')
    @if (settings('custom_code.enabled'))
      {!! settings('custom_code.head') !!}
    @endif
</head>
<body class="{{ request()->path() !== '/' && request()->path() !== 'pricing' ? 'dashboard-body' : 'index-body bg-white' }} @yield('bodyClass')" id="body" @yield('bodyAttr')>
   @if (session()->get('admin_overhead') && user('role') == 0)
    <div class="topbar admin-bar">
            <div class="d-flex align-items-center w-50">
              <h6 class="mr-4 text-white mb-0">{{ __('Admin') }}</h6>
              <form action="{{ route('admin-login-user') }}" method="post" class="d-flex w-100">
                @csrf
                <input type="hidden" name="id" value="{{ user('id') }}">
                <select name="loginasuser" class="form-select" data-search="off" data-ui="sm">
                  @foreach (\App\User::get() as $item)
                    <option value="{{$item->id}}" {{ user('id') == $item->id ? 'selected' : '' }}>{{ $item->username }}</option>
                  @endforeach
                </select>
                <button class="text-white bg-transparent border-0 ml-3">{{ __('Login') }}</button>
              </form>
            </div>
            <div class="">
               <form method="post" action="{{ url('logout') }}">
                 @csrf
                 <input type="hidden" name="returnAdmin" value="nothing here">
                  <button class="btn text-white"><em class="icon ni ni-signout"></em></button>
              </form>
            </div>
    </div>
    @endif
    <!-- Static navbar -->


  @if (Auth::check() && request()->path() !== '/' && request()->path() !== 'pricing')
      <div class="sidebar-show overlay-sidebar toggle-sidebar"></div>
        <div class="clov-sidebar">
            <div class="clov-sidebar-inner">
              <div class="item_nav_side sidebar-show {{ request()->path() !== '/' && request()->path() !== 'pricing' ? '' : 'd-lg-none' }}" id="sidebarMenu" data-simplebar>
                <div class="brand_top">
                <a href="{{ url('/') }}">
                  <img class="w-80px" src="{{ logo() }}" alt="logo" />
                </a>
              </div>
              <div class="nav flex-column nav-pills">
                <a class="nav-link" href="{{ route('user-dashboard') }}">
                  <i class="tio dashboard_vs_outlined"></i>
                  {{ __('Dashbord') }}
                </a>
                  @if ($user->role == 1)
                  <a class="nav-link" href="{{ route('admin-home') }}">
                    <i class="tio protection"></i>
                    {{ __('Admin') }}
                  </a>
                  @endif
                <li class="navtitle">
                  {{ __('Products') }}
                </li>
                  <a class="nav-link" href="{{ route('user-products') }}">
                    <i class="tio inbox"></i>
                    {{ __('Products') }}
                  </a>
                  @if (user('extra.refund_request') == 1)
                  <a class="nav-link" href="{{ route('user-refunds') }}">
                    <i class="tio rotate"></i>
                    {{ __('Refunds') }}
                  </a>
                  @endif
                  <a class="nav-link" href="{{ route('user-product-category') }}">
                    <i class="tio block"></i>
                    {{ __('Categories') }}
                  </a>
                  <a class="nav-link" href="{{ route('user-orders') }}">
                    <i class="tio briefcase_outlined"></i>
                    {{ __('Orders') }}
                  </a>
                  <a class="nav-link" href="{{ route('user-shipping') }}">
                    <i class="tio globe"></i>
                    {{ __('Shipping') }}
                  </a>
                <li class="navtitle">
                  {{ __('Stats') }}
                </li>
                  <a class="nav-link" href="{{ route('stats') }}">
                    <i class="tio chart_line_up"></i>
                    {{ __('Store Statistics') }}
                  </a>
                <li class="navtitle">
                  {{ __('Others') }}
                </li>
                  <a class="nav-link" href="{{ route('user-settings') }}">
                    <i class="tio settings_vs_outlined"></i>
                    {{ __('Settings') }}
                  </a>
                  <a class="nav-link" href="{{ route('user-customers') }}">
                    <i class="tio user_outlined"></i>
                    {{ __('Customers') }}
                  </a>
                  <a class="nav-link" href="{{ route('user-chats') }}">
                    <i class="tio chat_outlined"></i>
                    {{ __('Chat') }}
                  </a>
                  <a class="nav-link" href="{{ route('user-pages') }}">
                    <i class="tio gym"></i>
                    {{ __('Pages') }}
                  </a>
                  <a class="nav-link" href="{{ route('user-blog') }}">
                    <i class="tio camera_enhance"></i>
                    {{ __('Blogs') }}
                  </a>
                  <a class="nav-link" href="{{ route('user-domains') }}">
                    <i class="tio globe"></i>
                    {{ __('Domains') }}
                  </a>
                  <a class="nav-link" target="_blank" href="{{ route('user-profile', ['profile' => $user->username]) }}">
                    <i class="tio shop_outlined"></i>
                    {{ __('View Store') }}
                  </a>
              </div>
              <div class="item__number mb-4 radius-10 p-4 mt-3 mb-lg-0 bg-blue">
                  <div class="icon">
                    <i class="tio premium_outlined fs-30px c-white"></i>
                  </div>
                  <div class="body__content">
                    <h5 class="mt-3 c-white fs-15px">{{ package('name') }}</h5>
                    <p class="mb-3 c-white fs-12px">{{ __('Choose your desired plan') }}</p>
                    <a href="{{ route('pricing') }}" class="fs-16px btn scale c-white btn-secondary rounded-8">
                      {{ __('Change Plan') }}
                    </a>
                  </div>
                </div>
            </div>
            </div>
        </div>
    @endif


  <div id="wrapper" class="{{ request()->path() !== '/' && request()->path() !== 'pricing' ? '' : 'p-lg-0' }}">
    <div id="content">
      <!-- Start header -->
      <header class="header-nav-center active-blue" id="OverallHeader">
        <div class="container">
          <!-- navbar -->
          <nav class="navbar navbar-expand-lg navbar-light px-sm-0">
            <a class="navbar-brand" href="{{ url('/') }}">
              <img class="w-80px" src="{{ logo() }}" alt="logo" />
            </a>
            <div>

              <button class="navbar-toggler menu ripplemenu d-lg-none" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="tio menu_left_right mt-2"></i>
              </button>

              @auth
              <button class="navbar-toggler menu ripplemenu toggle-sidebar" type="button">
                <svg viewBox="0 0 64 48">
                  <path d="M19,15 L45,15 C70,15 58,-2 49.0177126,7 L19,37"></path>
                  <path d="M19,24 L45,24 C61.2371586,24 57,49 41,33 L32,24"></path>
                  <path d="M45,33 L19,33 C-8,33 6,-2 22,14 L45,37"></path>
                </svg>
              </button>
              <a href="button" data-toggle="modal" data-target="#mdllauth" class="p-0 opacity-1 sweep_letter scale sweep_top user-avatar-text bg-blue d-lg-none ml-3">
                <div class="inside_item">
                  <span data-hover="😊">{{ mb_substr(full_name($user->id), 0, 2) }}</span>
                </div>
              </a>

              @else
                <a href="#" class="btn btn-default sign-in-modal mt-2 fs-12px bg-blue c-white d-lg-none">{{ __('Sign in') }}</a>
              @endauth
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mx-auto nav-pills">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/#how-it-work') }}">{{ __('How it works') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('pricing') }}">{{ __('Pricing') }}</a>
                </li>

                <li class="nav-item dropdown dropdown-hover">
                  <a class="nav-link dropdown-toggle dropdown_menu" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('Pages') }}

                    <div class="icon_arrow">
                      <i class="tio chevron_right"></i>
                    </div>
                  </a>

                  <div class="dropdown-menu single-drop sm_dropdown" aria-labelledby="navbarDropdown">
                    <ul class="dropdown_menu_nav">
                      <li><a class="dropdown-item" href="{{ route('all-pages') }}">{{ __('All pages') }}</a></li>
                      @foreach ($allPages as $item)
                      <li><a class="dropdown-item" href="{{$item->type == 'internal' ? url('page/' . $item->url) : $item->url}}" target="{{ $item->type == 'internal' ? '_self' : '_blank' }}">{{ ucfirst($item->title) }}</a></li>
                      @endforeach

                    </ul>

                  </div>
                </li>

              </ul>
              
              <div class="nav_account btn_demo3">
                @auth
                <div>
                  <button type="button" data-toggle="modal" data-target="#mdllauth" class="btn btn_sm_primary opacity-1 sweep_letter scale sweep_top rounded-8">
                    <div class="inside_item">
                      <span data-hover="Hello !">{{ __('My account') }}</span>
                    </div>
                  </button>
                </div>
                @else
                <a href="Javascript::void" class="btn btn-default sign-in-modal">{{ __('Sign in') }}</a>
                <a href="{{ route('register') }}" class="btn scale btn_sm_primary bg-blue c-white effect-letter rounded-8">
                  {{ __('Sign up') }}
                </a>
                @endauth
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
        <!-- end container -->
      </header>
      <!-- End header -->

     @if (Auth::check() && !package('settings.ads') && settings('ads.enabled'))
       <div class="mt-8">{!! settings('ads.site_header') !!}</div>
     @endif
      @yield('content')
     @if (Auth::check() && !package('settings.ads') && settings('ads.enabled'))
       {!! settings('ads.site_footer') !!}
     @endif

    </div>
    <!-- [id] content -->

    @auth
    <!-- Auth Modal  -->
    <div class="modal mdllaccount fade" id="mdllauth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="tio clear"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="form_account">
              <div class="head_account">
                <div class="img_profile">
                  <img src="{{ avatar() }}" />
                </div>
                <div class="title">
                  <h4>{{ __('Hey') }}, {{user('name.first_name')}}</h4>
                  <div class="user-balance">{{ __('You are on') }} <b>{{$package->name}}</b> {{ __('Plan') }}</div>
                  <div class="row justify-content-center text-center">
                    <div class="Countdown-timer">
                      <div countdown data-date="{{ Carbon\Carbon::parse($user->package_due)->toFormattedDateString() }}">
                        <div class="item">
                          <span class="fs-20px" data-days>{{ (strtolower($package->name) == 'free' ? __('Forever') : __('Forever')) }}</span>
                          <p class="fs-9px">{{ __('days to expiry') }}</p>
                        </div>
                       </div>
                    </div>
                  </div>
                  <a href="{{ route('pricing') }}"><span>{{ __('Change Plan') }}</span></a>
                </div>
              </div>
              <div class="form-row">
                <div class="col-12">

                                            <ul class="link-list p-0">
                                                @if ($user->role == 1)
                                                <li><a href="{{ route('admin-home') }}" target="_blank"><em class="icon tio protection"></em><span>{{ __('Admin') }}</span></a></li>
                                                @endif
                                                <li><a href="{{ url($profile_url) }}" target="_blank"><em class="icon tio shop_outlined"></em><span>{{ __('View Store') }}</span></a></li>

                                                <li><a href="{{ route('user-settings') }}"><em class="icon tio settings_vs_outlined"></em><span>{{ __('Settings') }}</span></a></li>

                                                <li><a href="{{ route('user-transactions') }}"><em class="icon tio money_vs"></em><span>{{ __('Transactions') }}</span></a></li>

                                                <li><a href="{{ route('user-faq') }}"><em class="icon tio new_message"></em><span>{{ __('Faq') }}</span></a></li>

                                                <li><a href="{{ route('user-activities') }}"><em class="icon tio chat_outlined"></em><span>{{ __('Login activity') }}</span></a></li>

                                               <form method="post" action="{{ url('logout') }}">
                                                 @csrf
                                                 <input type="hidden" name="returnAdmin" value="nothing here">
                                                 <li><button class="btn btn_sm_primary btn-secondary btn-block" href="{{ route('user-activities') }}"><em class="icon tio sign_out"></em><span>{{ __('Logout') }}</span></button></li>
                                              </form>
                                            </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End. Modal -->
  @endauth

    <!-- Form Create account -->
  <div class="boxup-auth">
    <div class="overlay hide"></div>
    <div class="box--signup translat" id="animate1">
      <div class="cotainer">
        <div class="links--account">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="pills-login-tab" data-toggle="pill" href="{{ route('login') }}" role="tab"
                aria-controls="pills-login" aria-selected="true">{{ __('Sign in') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('register') }}">{{ __('Get Started') }}</a>
            </li>
          </ul>
        </div>
        <div class="title">
          {{ __('Sign in to') }} {{ config('app.name') }}.
        </div>
        <div class="other_login">

          @if (config('app.google_status') == 1)
          <a href="{{ route('user-auth-google') }}" class="btn scale btn-loin-google">
            <i class="tio google"></i>
            {{ __('Sign up with Google') }}
          </a>
          @endif

          @if (config('app.facebook_status') == 1)
            <a href="{{ route('user-auth-facebook') }}" class="btn scale btn_facebook bg-blue c-white">
              <i class="tio facebook_square"></i>
            </a>
          @endif

          @if (config('app.facebook_status') == 1 || config('app.google_status') == 1)
          <div class="line-or">
            <span class="or">{{ __('or') }}</span>
          </div>
          @endif
        </div>
            <div class="form-row">
              <div class="col-12">

                     <form method="POST" action="{{ route('login') }}">
                        @csrf
                          <div class="form-group custom">
                             <label>{{ __('Email / Username') }}</label>
                             <input type="text" class="form-control form-control-lg @error('user') is-invalid @enderror" id="default-01" placeholder="{{ __('Enter your email address or username') }}" name="user" value="{{ old('username') }}" autocomplete="user">
                          </div>
                          @error('user')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                          <div class="form-group custom">
                            <div class="row">
                              <div class="col-6">
                                <label>{{ __('Password') }}</label>
                              </div>
                              <div class="col-6">
                               <div class="form-label-group d-flex justify-content-end">
                                <a class="link link-primary link-sm ml-auto fs-14px" href="{{ route('resetpassword') }}">{{ __('Forgot Password?') }}</a>
                               </div>
                              </div>
                            </div>
                             <div class="form-control-wrap">
                              <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                             </a>
                              <input type="password" class="form-control form-control-lg pl-4 @error('password') is-invalid @enderror" id="password" placeholder="{{ __('Enter your password') }}" name="password" autocomplete="current-password">
                            </div>
                          </div>

                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                          <div class="custom-control custom-control-alternative custom-checkbox">
                              <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                             <label class="custom-control-label" for="remember"><span class="text-muted">{{ __('Remember me') }}</span></label>
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
                            <button type="submit" class="btn mt-3 rounded-8 c-white btn_md_primary effect-letter bg-blue">{{ __('Login') }}</button>
                          </div>
                       </form>
              </div>
            </div>
      </div>
    </div>
    </div>

    <!-- footr -->
    <footer class="defalut-footer foot_demo3 light margin-t-12 padding-py-8">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="item_about">
              <a class="logo" href="{{ url('/') }}">
                <img class="w-80px" src="{{ logo() }}" alt="" />
              </a>
              <p>
                {{ __('Own a simple and elegant storefront with us today.') }}
              </p>
              <div class="address">
                <span>{{settings('location')}}</span>
                <span>{{ __('Email us:') }} <a href="mailto:{{settings('email')}}">{{settings('email')}}</a></span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-6 col-lg-2 parent-link">
            <div class="item_links social">
              <h4>{{ __('Social') }}</h4>
              @if (!empty(settings('social.facebook')))
              <a class="nav-link" href="{{(!empty(settings('social.facebook')) ? url('https://facebook.com/' . settings('social.facebook')) : "")}}">{{ __('Facebook') }}</a>
              @endif
              @if (!empty(settings('social.whatsapp')))
              <a class="nav-link" href="{{(!empty(settings('social.whatsapp')) ? url('https://wa.me/' . settings('social.whatsapp')) : "")}}">{{ __('Whatsapp') }}</a>
              @endif
              @if (!empty(settings('social.twitter')))
              <a class="nav-link" href="{{(!empty(settings('social.twitter')) ? url('https://twitter.com/' . settings('social.twitter')) : "")}}">{{ __('Twitter') }}</a>
              @endif
              @if (!empty(settings('social.instagram')))
              <a class="nav-link" href="{{(!empty(settings('social.instagram')) ? url('https://instagram.com/' . settings('social.instagram')) : "")}}">{{ __('Instagram') }}</a>
              @endif
              @if (!empty(settings('social.youtube')))
              <a class="nav-link" href="{{(!empty(settings('social.youtube')) ? url('https://youtube.com/channel/' . settings('social.youtube')) : "")}}">{{ __('Youtube') }}</a>
              @endif
            </div>
          </div>
          <div class="col-6 col-md-6 col-lg-2 parent-link">
            <div class="item_links social">
              <h4>{{ __('Pages') }}</h4>
               @foreach ($allPages as $item)
                <a class="nav-link" href="{{$item->type == 'internal' ? url('page/' . $item->url) : $item->url}}" target="{{ $item->type == 'internal' ? '_self' : '_blank' }}">{{ ($item->title) }}</a>
              @endforeach
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mt-4 mt-lg-0">
            <div class="item_subscribe">
              <h4>{{ __('Get started') }}</h4>
              <p>{{ __('Check out our simple pricing') }}</p>
              <a href="{{ route('pricing') }}" class="btn btn_sm_primary bg-blue mt-3">{{ __('Pricing') }}</a>
            </div>
          </div>
        </div>
        <div class="row" hidden>
          <div class="col-md-6 margin-t-1">
            <select data-menu>
              <option>French</option>
              <option selected>English</option>
              <option>Arabic</option>
              <option>Russian</option>
            </select>
          </div>
        </div>
        <div class="col-12 text-center padding-t-4">
          <div class="copyright">
              <span>© {{ date('Y') }} <a href="{{ url('/') }}" target="_blank">{{ config('app.name') }}</a> {{ __('All Right Reseved') }} </span>
          </div>
        </div>
      </div>
    </footer>
    <!-- End. -->

    <!-- Back to top with progress indicator-->
    <div class="prgoress_indicator">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>



    <!-- Start Section Loader -->
    <section class="loading_overlay" hidden>
      <div class="loader_logo">
        <img class="logo" src="{{ logo() }}" />
      </div>
    </section>
    <!-- End. Loader -->
  </div>
  <!-- End. wrapper -->

    <!-- Tosts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div class="toast" id="cookie-toast" role="alert" aria-live="assertive" aria-atomic="true"
        data-animation="true" data-autohide="false">
        <div class="toast-body">
          <button type="button" id="cookie-deny-button" class="ml-2 mb-1 close">
            <i class="tio clear"></i>
          </button>
          <h5>{{ __('Do you like cookies? 🍪') }}</h5>
          <p>{{ __('We use cookies to ensure you get the best experience on our website') }}</p>
          <button id="cookie-accept-button" class="btn effect-letter c-white bg-blue">{{ __('I agree') }}</button>
        </div>
      </div>
    </div>
    <!-- End. Toasts -->

    <!-- End. Toasts -->
    @include('includes.toast')
      <!-- END FOOTER -->
      @yield('footerJS')
      <!-- jquery-migrate -->
      <script src="{{ url('assets/js/jquery-migrate.min.js') }}" type="text/javascript"></script>
      <!-- popper -->
      <!--
      ============
      vendor file
      ============
       -->
      <!-- particles -->
      <script src="{{ url('assets/js/vendor/particles.min.js') }}" type="text/javascript"></script>
      <!-- TweenMax -->
      <script src="{{ url('assets/js/vendor/TweenMax.min.js') }}" type="text/javascript"></script>
      <!-- ScrollMagic -->
      <script src="{{ url('assets/js/vendor/ScrollMagic.js') }}" type="text/javascript"></script>
      <!-- animation.gsap -->
      <script src="{{ url('assets/js/vendor/animation.gsap.js') }}" type="text/javascript"></script>
      <!-- addIndicators -->
      <script src="{{ url('assets/js/vendor/debug.addIndicators.min.js') }}" type="text/javascript"></script>
      <!-- Swiper js -->
      <script src="{{ url('assets/js/vendor/swiper.min.js') }}" type="text/javascript"></script>
      <!-- countdown -->
      <script src="{{ url('assets/js/vendor/countdown.js') }}" type="text/javascript"></script>
      <!-- simpleParallax -->
      <script src="{{ url('assets/js/vendor/simpleParallax.min.js') }}" type="text/javascript"></script>
      <!-- waypoints -->
      <script src="{{ url('assets/js/vendor/waypoints.min.js') }}" type="text/javascript"></script>
      <!-- counterup -->
      <script src="{{ url('assets/js/vendor/jquery.counterup.min.js') }}" type="text/javascript"></script>
      <!-- charming -->
      <script src="{{ url('assets/js/vendor/charming.min.js') }}" type="text/javascript"></script>
      <!-- imagesloaded -->
      <script src="{{ url('assets/js/vendor/imagesloaded.pkgd.min.js') }}" type="text/javascript"></script>
      <!-- BX-Slider -->
      <script src="{{ url('assets/js/vendor/jquery.bxslider.min.js') }}" type="text/javascript"></script>
      <!-- Sharer -->
      <script src="{{ url('assets/js/vendor/sharer.js') }}" type="text/javascript"></script>
      <!-- sticky -->
      <script src="{{ url('assets/js/vendor/sticky.min.js') }}" type="text/javascript"></script>
      <!-- Aos -->
      <script src="{{ url('assets/js/vendor/aos.js') }}" type="text/javascript"></script>
      <!-- main file -->
      <script src="{{ url('assets/js/main.js') }}" type="text/javascript"></script>
      <script src="{{ url('assets/js/html2canvas.min.js') }}" type="text/javascript"></script>

      @foreach(['custom.js'] as $file)
      <script src="{{ asset('js/' .$file. '?v=' . env('APP_VERSION')) }}"></script>
      @endforeach
      @yield('footerJS-down')
</body>
</html>
