<!doctype html>
<!-- theme: megamart -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{'@'.$user->username}}{{ !package('settings.custom_branding', $uid) ? ' - ' . env('APP_NAME') : '' }}</title>
      @if(!empty(settings('favicon')))
      <link href="{!! package('settings.custom_branding', $uid) ? user_favicon($uid) : favicon() !!}" rel="shortcut icon" type="image/png" />
      @endif
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link href="https://fonts.googleapis.com/css2?family=Hind:wght@400;500;600;700&display=swap" rel="stylesheet">
      <link href="{{ asset('css/bootstrap.css?v=' . env('APP_VERSION')) }}" rel="stylesheet">
      @foreach(['animate.css', 'swiper.min.css', 'icons.css', 'aos.css', 'main.css', 'normalize.css', 'ecom.css'] as $file)
      <link href="{{ asset('assets/css/' . $file . '?v=' . env('APP_VERSION')) }}" rel="stylesheet">
      @endforeach
      <!-- Styles -->
      @foreach(['plugins/magnific-popup/magnific-popup.min', 'plugins/owl-carousel/owl.carousel.min', 'plugins/owl-carousel/owl.theme.default.min', 'plugins/justified-gallery/justified-gallery.min', 'plugins/sal/sal.min', 'css/main', 'css/custom', 'plugins/themify/themify-icons.min', 'plugins/simple-line-icons/css/simple-line-icons', 'css/megamart'] as $file)
      <link href="{{ themes($file . '.css?v=') . env('APP_VERSION') }}" rel="stylesheet">
      @endforeach

      <link href="{{ asset('font/css/all.css?v=' . env('APP_VERSION')) }}" rel="stylesheet">

      @foreach(['bundle'] as $file)
      <script src="{{ asset('js/' . $file . '.js?v=' . env('APP_VERSION')) }}" type="text/javascript"></script>
      @endforeach

      @yield('customCSS')

      {!! profile_analytics($user->id) !!}

      @if (package('settings.add_to_head', $uid))
       {!! clean(user('extra.headScript', $uid), 'allowonlyscript') !!}
      @endif

   </head>
   {!! custom_code() !!}
   <body data-preloader="4" class="mm-body {{ profile_body_classes($user->id) }}">
      {!! ($user->background_type == "color") ? "
      <style> $background_color </style>
      " : "" !!}
      <div class="if-is-mobile"></div>
      @php
      $cart = new \App\Cart;
      $cart = $cart->getAll($uid);
      $mmStoreName = ucfirst($user->username);
      $mmHasLogo = !empty(user('media.avatar', $uid));
      $mmActiveCategory = request()->get('category');
      $mmCustomer = auth_user($uid, 'check') ? auth_user($uid, 'get') : null;
      @endphp

      {{-- Advanced search overlay (used by the "Search" buttons in product blocks) --}}
      <div class="search-form-wrapper header-search-form" id="search-product">
         <div class="container">
            <div class="search-results-wrapper">
               <div class="btn-search-close data-box" data-target="#search-product">
                  <i class="ni ni-cross fs-20px"></i>
               </div>
            </div>
            <form method="get" action="{{ route('user-profile-products', ['profile' => $user->username]) }}" role="search" class="mt-8">
               <div class="col-md-12 mb-0">
                  <div class="form-group">
                     <input type="text" class="search-input" name="query" value="{{ request()->get('query') }}" placeholder="{{ __('Search') }}">
                  </div>
               </div>
               <div class="col-md-12 row">
                  <div class="form-group col-6">
                     <label class="m-3">{{ __('Min Price') }}</label>
                     <input type="text" class="search-input" name="min-price" value="{{ $min_price }}" placeholder="{{ __('Min Price') }}">
                  </div>
                  <div class="form-group col-6">
                     <label class="m-3">{{ __('Max Price') }}</label>
                     <input type="text" class="search-input" name="max-price" value="{{ $max_price }}" placeholder="{{ __('Max Price') }}">
                  </div>
               </div>
               <div class="col-md-12">
                  <label class="m-3">{{ __('Category') }}</label>
                  <select class="custom-select w-100" name="category">
                     <option value="">{{ __('None') }}</option>
                     @foreach($categories as $category)
                     <option value="{{$category->slug}}" {{ $mmActiveCategory == $category->slug ? 'selected' : '' }}>{{$category->title}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="col-12">
                  <button class="button smoothscroll justify-center button-lg mt-0 align-items-center theme-btn d-flex w-100">{{ __('Search') }}</button>
               </div>
            </form>
         </div>
      </div>

      {{-- Side drawer: store pages --}}
      <div class="mm-drawer-overlay" data-mm-drawer-close></div>
      <aside class="mm-drawer" id="mm-drawer" aria-hidden="true">
         <div class="mm-drawer__head">
            <span class="mm-logo-text">{{ $mmStoreName }}</span>
            <button type="button" class="mm-icon-btn" data-mm-drawer-close aria-label="{{ __('Close') }}">
               <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
         </div>
         <nav class="mm-drawer__nav">
            <a href="{{ route('user-profile', ['profile' => $user->username]) }}">{{ __('Home') }}</a>
            <a href="{{ route('user-profile-products', ['profile' => $user->username]) }}">{{ __('All Products') }}</a>
            <a href="{{ route('user-profile-categories', ['profile' => $user->username]) }}">{{ __('Categories') }}</a>
            <a href="{{ route('user-profile-orders', ['profile' => $user->username]) }}">{{ __('Track your order') }}</a>
            {!! store_menu($uid, 10, 'html', ['ul' => 'mm-drawer__pages', 'li' => '', 'a' => '']) !!}
         </nav>
      </aside>

      <div class="mm-wrapper">
         {{-- Top bar --}}
         <div class="mm-topbar">
            <div class="mm-container mm-topbar__inner">
               <span>{{ __('Welcome to') }} {{ $mmStoreName }}!</span>
               <div class="mm-topbar__links">
                  <a href="{{ route('user-profile-orders', ['profile' => $user->username]) }}">
                     <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M1 4h14v11H1zM15 8h4l3 3v4h-7"/><circle cx="5.5" cy="17.5" r="2"/><circle cx="18.5" cy="17.5" r="2"/></svg>
                     {{ __('Track your order') }}
                  </a>
                  <a href="{{ route('user-profile-products', ['profile' => $user->username]) }}">
                     <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.4 2.1 3.2-.3.7 3.1 2.8 1.6-1.3 2.9 1.3 2.9-2.8 1.6-.7 3.1-3.2-.3L12 22l-2.4-2.1-3.2.3-.7-3.1-2.8-1.6 1.3-2.9-1.3-2.9 2.8-1.6.7-3.1 3.2.3z"/><path d="M9 15l6-6M9.5 9.5h.01M14.5 14.5h.01"/></svg>
                     {{ __('All Offers') }}
                  </a>
               </div>
            </div>
         </div>

         {{-- Header --}}
         <header class="mm-header">
            <div class="mm-container mm-header__inner">
               <button type="button" class="mm-menu-btn" data-mm-drawer-open aria-label="{{ __('Menu') }}" aria-controls="mm-drawer">
                  <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M3 6h18M3 12h12M3 18h18"/></svg>
               </button>
               <a class="mm-logo" href="{{ route('user-profile', ['profile' => $user->username]) }}">
                  @if ($mmHasLogo)
                  <img src="{{ avatar($uid) }}" alt="{{ $mmStoreName }}">
                  @else
                  <span class="mm-logo-text">{{ $mmStoreName }}</span>
                  @endif
               </a>
               <form class="mm-search" method="get" action="{{ route('user-profile-products', ['profile' => $user->username]) }}" role="search">
                  <svg class="mm-search__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
                  <input type="text" name="query" value="{{ request()->get('query') }}" placeholder="{{ __('Search essentials, groceries and more...') }}" aria-label="{{ __('Search') }}">
                  <a href="#" class="mm-search__filter data-box" data-target="#search-product" aria-label="{{ __('Filters') }}">
                     <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                  </a>
               </form>
               <div class="mm-actions">
                  @if ($mmCustomer)
                  <a class="mm-action" href="{{ route('user-profile-dashboard', ['profile' => $user->username]) }}">
                     <img class="mm-action__avatar" src="{{ c_avatar($mmCustomer->id) }}" alt="">
                     <span>{{ __('My Account') }}</span>
                  </a>
                  @else
                  <a class="mm-action" href="{{ route('user-profile-login', ['profile' => $user->username]) }}">
                     <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 4.5-6 8-6s6.5 2 8 6"/></svg>
                     <span>{{ __('Sign Up/Sign In') }}</span>
                  </a>
                  @endif
                  <span class="mm-actions__sep"></span>
                  <a class="mm-action mm-action--cart" href="{{ route('user-profile-checkout', ['profile' => $user->username]) }}">
                     <span class="mm-cart-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M2 3h3l2.7 12.2a2 2 0 0 0 2 1.6h8.1a2 2 0 0 0 2-1.5L22 7H6.2"/></svg>
                        <span class="mm-cart-count cart-total">{{ count($cart) }}</span>
                     </span>
                     <span>{{ __('Cart') }}</span>
                  </a>
               </div>
            </div>
         </header>

         {{-- Category pills --}}
         @if (count($categories))
         <nav class="mm-catbar" aria-label="{{ __('Categories') }}">
            <div class="mm-container mm-catbar__inner">
               @foreach ($categories as $category)
               <a class="mm-pill {{ $mmActiveCategory == $category->slug ? 'is-active' : '' }}" href="{{ route('user-profile-products', ['profile' => $user->username, 'category' => $category->slug]) }}">
                  {{ $category->title }}
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
               </a>
               @endforeach
            </div>
         </nav>
         @endif

         @if (!package('settings.ads', $uid) && settings('ads.enabled'))
         {!! settings('ads.store_header') !!}
         @endif

         <main class="mm-main">
            @yield('content')
         </main>

         @if (!package('settings.ads', $uid) && settings('ads.enabled'))
         {!! settings('ads.store_footer') !!}
         @endif

         {{-- Footer --}}
         <footer class="mm-footer">
            <div class="mm-container">
               <div class="mm-footer__grid">
                  <div class="mm-footer__brand">
                     <a class="mm-footer__logo" href="{{ route('user-profile', ['profile' => $user->username]) }}">{{ $mmStoreName }}</a>
                     @if (!empty($user->email) || !empty($user->address))
                     <h4 class="mm-footer__sub">{{ __('Contact Us') }}</h4>
                     <ul class="mm-footer__contact">
                        @if (!empty($user->email))
                        <li>
                           <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                           <span>{{ __('Email Us') }}<br><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                        </li>
                        @endif
                        @if (!empty($user->address))
                        <li>
                           <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></svg>
                           <span>{{ __('Visit Us') }}<br>{{ $user->address }}</span>
                        </li>
                        @endif
                     </ul>
                     @endif
                     @if (package('settings.social', $uid))
                     <div class="mm-footer__social">
                        @foreach ($options->socials as $key => $items)
                        @if (!empty($user->socials[$key]))
                        <a href="{{ Linker::url(sprintf($items['address'], $user->socials[$key]), ['ref' => $user->username]) }}" target="_blank" rel="noopener">
                           <i class="ni ni-{{ $items['icon'] }}"></i>
                        </a>
                        @endif
                        @endforeach
                     </div>
                     @endif
                  </div>
                  @if (count($categories))
                  <div>
                     <h4 class="mm-footer__title">{{ __('Most Popular Categories') }}</h4>
                     <ul class="mm-footer__list">
                        @foreach ($categories->take(8) as $category)
                        <li><a href="{{ route('user-profile-products', ['profile' => $user->username, 'category' => $category->slug]) }}">{{ $category->title }}</a></li>
                        @endforeach
                     </ul>
                  </div>
                  @endif
                  <div>
                     <h4 class="mm-footer__title">{{ __('Customer Services') }}</h4>
                     <ul class="mm-footer__list">
                        <li><a href="{{ route('user-profile-orders', ['profile' => $user->username]) }}">{{ __('Track your order') }}</a></li>
                        <li><a href="{{ route('user-profile-login', ['profile' => $user->username]) }}">{{ __('My Account') }}</a></li>
                        <li><a href="{{ route('user-profile-checkout', ['profile' => $user->username]) }}">{{ __('Cart') }}</a></li>
                     </ul>
                     {!! store_menu($uid, 6, 'html', ['ul' => 'mm-footer__list', 'li' => '', 'a' => '']) !!}
                  </div>
               </div>
               <div class="mm-footer__copy">
                  @if (!package('settings.custom_branding', $uid))
                  {{ '© ' . date('Y') }} <a href="{{ url('/') }}" target="_blank">{{ ucfirst(config('app.name')) }}</a>. {{ __('All rights reserved.') }}
                  @elseif (!empty(user('extra.custom_branding', $uid)))
                  {{ '© ' . date('Y') . ' ' . user('extra.custom_branding', $uid) }}
                  @else
                  {{ '© ' . date('Y') . ' ' . $mmStoreName }}. {{ __('All rights reserved.') }}
                  @endif
               </div>
            </div>
         </footer>
      </div>
      <!-- end wrapper -->
      @if (!empty(Session::get('error')))
      <script>
         Swal.fire({ title: 'Error!', text: @json(Session::get('error')), icon: 'error', confirmButtonText: 'OK' });
      </script>
      @endif
      @if (!empty(Session::get('success')))
      <script>
         Swal.fire({ title: @json(Session::get('success')), icon: 'success', confirmButtonText: 'OK' });
      </script>
      @endif
      @if (!empty(Session::get('info')))
      <script>
         Swal.fire({ title: @json(Session::get('info')), icon: 'info', confirmButtonText: 'OK' });
      </script>
      @endif
      @if(!$errors->isEmpty())
      @foreach ($errors->all() as $error)
      <script>
         Swal.fire({ title: @json($error), icon: 'error', confirmButtonText: 'OK' });
      </script>
      @endforeach
      @endif
      @yield('footerJS')
      <script src="{{ asset('slick/slick.min.js') }}"></script>
      @foreach(['plugins/plugins', 'js/functions.min', 'js/script', 'js/megamart'] as $file)
      <script src="{{ themes($file . '.js?v=' . env('APP_VERSION')) }}" type="text/javascript"></script>
      @endforeach
      <script src="{{ asset('js/scripts.js') }}"></script>
   </body>
</html>
