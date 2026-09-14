@extends('layouts.app')
@section('title', 'Settings')
@section('footerJS')
  <script src="{{ url('tinymce/tinymce.min.js') }}"></script>
  <script src="{{ url('tinymce/sr.js') }}"></script>
@stop
@section('content')
<div class="card-content container section__showcase mt-8">
<form action="{{ route('user-settings') }}" method="post" enctype="multipart/form-data">
      @csrf
  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Settings') }}</h2>
      </div>
    </div>
  </div>

  <div class="block__tab">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab"
          aria-controls="pills-general" aria-selected="true">
          <div class="icon">
            <i class="tio home_vs_1_outlined c-black"></i>
          </div>
          <h3>{{ __('Main') }}</h3>
          <div class="prog"></div>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-social-tab" data-toggle="pill" href="#pills-social" role="tab"
          aria-controls="pills-social" aria-selected="true">
          <div class="icon">
            <i class="tio instagram c-black"></i>
          </div>
          <h3>{{ __('Social') }}</h3>
          <div class="prog"></div>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-template-tab" data-toggle="pill" href="#pills-template" role="tab"
          aria-controls="pills-template" aria-selected="true">
          <div class="icon">
            <i class="tio paint_outlined c-black"></i>
          </div>
          <h3>{{ __('Template') }}</h3>
          <div class="prog"></div>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-payments-tab" data-toggle="pill" href="#pills-payments" role="tab"
          aria-controls="pills-payments" aria-selected="true">
          <div class="icon">
            <i class="tio credit_card_outlined c-black"></i>
          </div>
          <h3>{{ __('Payments') }}</h3>
          <div class="prog"></div>
        </a>
      </li>
      <li class="nav-item" hidden role="presentation">
        <a class="nav-link" id="pills-extra-tab" data-toggle="pill" href="#pills-extra" role="tab"
          aria-controls="pills-extra" aria-selected="true">
          <div class="icon">
            <i class="tio settings_outlined c-black"></i>
          </div>
          <h3>{{ __('Extra') }}</h3>
          <div class="prog"></div>
        </a>
      </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-general" role="tabpanel"
        aria-labelledby="pills-general-tab">
        <div class="row">
          <div class="col-md-6 d-flex justify-content-around">
            @if (package('settings.custom_branding'))
            <div class="avatar-upload mx-0">
                <div class="avatar-edit">
                    <input type="file" id="faviconUpload" name="favicon" class="file-image-upload" accept=".png, .jpg, .jpeg, .gif, .svg" />
                    <label for="faviconUpload"><i class="tio edit"></i></label>
                </div>
                <div class="avatar-preview card-shadow radius-5 h-130px w-130px">
                    <div class="image-preview radius-5" data-bg-src="{{ user_favicon() }}"></div>
                </div>
                <p class="text-center mt-3">{{ __('Favicon') }}</p>
            </div>
            @endif

            <div class="avatar-upload mx-0">
                <div class="avatar-edit">
                    <input type="file" id="logoUpload" name="avatar" class="file-image-upload" accept=".png, .jpg, .jpeg, .gif, .svg" />
                    <label for="logoUpload"><i class="tio edit"></i></label>
                </div>
                <div class="avatar-preview card-shadow h-130px w-130px">
                    <div class="image-preview" data-bg-src="{{ avatar() }}"></div>
                </div>
                <p class="text-center mt-3">{{ __('Logo') }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group custom mb-1 mb-lg-4">
                   <label class="muted-deep fw-normal m-2">{{ __('Store Name') }}</label>
                   <input type="text" class="form-control" placeholder="{{ __('John') }}" name="name_first_name" value="{{user('name.first_name')}}">
                </div>
              </div>
              <div class="col-md-6 d-none">
                <div class="form-group custom mb-1 mb-lg-4">
                   <label class="muted-deep fw-normal m-2">{{ __('Last Name') }}</label>
                   <input type="text" class="form-control" placeholder="{{ __('Doe') }}" name="name_last_name" value="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group custom mb-1 mb-lg-4">
                   <label class="muted-deep fw-normal m-2">{{ __('Email') }}</label>
                   <input type="text" class="form-control" placeholder="{{ __('johndoe@example.com') }}" name="email" value="{{user('email')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group custom mb-1 mb-lg-4">
                   <label class="muted-deep fw-normal m-2">{{ __('Username') }}</label>
                   <input type="text" class="form-control" placeholder="{{ __('johnnydoe') }}" name="username" value="{{user('username')}}">
                </div>
              </div>
            </div>
          </div>
      @if (session()->get('admin_overhead') && user('role') == 0)
       <div class="row w-100 bg-white mb-5 p-4">
        <div class="col-12">
          <div class="card-header border-0">
            <h4>{{ __('Admin Settings') }}</h4>
          </div>
        </div>
         <div class="col-md-6 mb-3">
           <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Status') }}</span>
                <small class="d-block mt-2">{{ __('Set this user as active or ban') }}</small>
              </label>
              <div class="form-control-wrap">
                 <select class="form-select custom-select" data-search="off" data-ui="lg" name="active">
                    <option value="1" {{ ($user->active == 1) ? "selected" : "" }}> {{ __('Active') }}</option>
                    <option value="0" {{ ($user->active == 0) ? "selected" : "" }}> {{ __('Banned') }}</option>
                </select>
           </div>
         </div>
       </div>
         <div class="col-md-6 mb-3 d-none">
           <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Verified') }}</span>
                <small class="d-block mt-2">{{ __('Verify this user') }}</small>
              </label>
              <div class="form-control-wrap">
                 <select class="form-select custom-select" data-search="off" data-ui="lg" name="verified">
                    <option value="1" {{ ($user->verified == 1) ? "selected" : "" }}> {{ __('Verified') }}</option>
                    <option value="0" {{ ($user->verified == 0) ? "selected" : "" }}> {{ __('Not verified') }}</option>
                </select>
           </div>
         </div>
       </div>
         <div class="col-md-6">
           <div class="form-group mt-5 custom">

              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Change package') }}</span>
                <small class="d-block mt-2">{{ __('Change user package') }}</small>
              </label>
             <div class="form-control-wrap">
                <select class="form-select custom-select" data-search="on" data-ui="lg" name="package">
                <option value="{{settings('package_free.id')}}" {{($user->package == 'free') ? "selected" : ""}}>{{settings('package_free.name')}}</option>
                 @foreach (\App\Model\Packages::where('status', 1)->orWhere('status', 2)->get() as $item)
                   <option value="{{$item->id}}" {{($user->package !== 'free') ? ($user->package == $item->id) ? "selected" : "" : ""}}>{{$item->name}}</option>
                 @endforeach
               </select>
             </div>
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group mt-5 custom">
            <label class="form-label"><span>{{ __('Change Due (yyyy-mm-dd hh:mm)') }}</span></label>
             <div class="form-control-wrap">
               <input type="text" value="{{ $user->package_due }}" class="form-control" id="datepicker" name="package_due">
             </div>
             <p>{{ __('Leave for unchanged') }}</p>
           </div>
         </div>
       </div>
      @endif

        <div class="col-md-6">
            <div class="card card-shadow border-0 p-3 radius-10">
              
              <div class="card-header radius-5 border-0 mb-3">
                <h5 class="m-0 fs-15px">
                  {{ __('Store Color') }}
                </h5>
              </div>
              <div class="form-group mt-5 mt-lg-2">
                <label class="muted-deep fw-normal form-label muted-deep fw-normal ml-2"><span>{{ __('Background Color') }}</span></label>

                <div class="form-control-wrap" pickr>

                    <input pickr-input type="hidden" class="form-control form-control-lg c-input" name="extra_background_color" value="{{user('extra.background_color') ?? '#000'}}">

                   <div id="background-color" pickr-div></div>
                </div>
              </div>

              <div class="form-group mt-5 mt-lg-2">

                <label class="muted-deep fw-normal form-label muted-deep fw-normal ml-2"><span>{{ __('Background Text color') }}</span></label>
                <div class="form-control-wrap" pickr>

                    <input pickr-input type="hidden" value="{{user('extra.background_text_color') ?? '#fff'}}" class="form-control form-control-lg c-input" name="extra_background_text_color">

                   <div id="background-text-color" pickr-div></div>
                </div>
                
              </div>
            </div>

             @if (package('settings.domains'))
             <div class="form-group mt-5">
                <label class="muted-deep fw-normal form-label muted-deep fw-normal ml-2"><span>{{ __('Domains') }}</span></label>
                <div class="form-control-wrap">
                   <select class="form-select custom-select" data-search="on" data-ui="lg" name="domain">
                      <option value="main" {{ user('domain') == 'main' ? 'selected' : '' }}>{{ '@' . parse_url(env('APP_URL'))['host'] }}</option>
                      @foreach ($domains as $key => $item)
                        <option value="{{$key}}" {{ $key == user('domain') ? 'selected' : '' }}>{{ '@' . $item->domain }}</option>
                      @endforeach
                  </select>
                </div>
             </div>
             @endif
            <div class="form-group custom mb-1 mb-lg-4">
               <label class="muted-deep fw-normal m-2">{{ __('Address') }}</label>
               <input type="text" class="form-control" placeholder="{{ __('Alabama, USA') }}" name="address" value="{{user('address')}}">
            </div>

           <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Guest checkout') }}</span>
                <small class="d-block mt-2">{{ __('Order can be placed without being a customer') }}</small>
              </label>
              <div class="form-control-wrap">
                 <select class="form-select custom-select" data-search="off" data-ui="lg" name="extra_guest_checkout">
                  @foreach (['1' => 'Enable guest checkout', '0' => 'Disable guest checkout'] as $key => $value)
                  <option value="{{$key}}" {{ user('extra.guest_checkout') == $key ? 'selected' : '' }}> {{ __($value) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="form-group mt-5 mt-lg-2" hidden>
              <div class="d-flex">
              <label class="form-label mr-2">{!! __('Choose cover image (Remove banner to disable)') !!}</label>
              </div>
               <div class="image-upload pages {{!empty(user('media.banner')) && file_exists(media_path('user/banner/' . user('media.banner'))) ? "active" : ""}}">
                    <label for="upload">{!! __('Click here or drop an image to upload 1048MB max') !!}</label>
                    <input type="file" id="upload" name="banner" class="upload">
                    <img src="{{url('media/user/banner/' . user('media.banner'))}}" alt=" ">
               </div>
              </div>
              @if(!empty(user('media.banner')) && file_exists(media_path('user/banner/' . user('media.banner')))) 
              <a data-confirm="Are you sure you want to delete this banner?" href="{{ route('delete-banner') }}" class="btn btn-link">{{ __('Remove image') }}</a>
             @endif
              <div class="col-12 mb-3 p-0" hidden="">
                 <div class="form-group custom">
                    <label class="form-label">{{ __('Media Url') }}</label>
                    <input type="text" name="extra_banner_url" class="form-control form-control-lg" value="{{ user('extra.banner_url') }}" placeholder="{{ __('Banner Url *optional') }}">
                 </div>
              </div>
        </div>

          <div class="col-md-6">
            @if (package('settings.custom_branding'))
            <div class="form-group custom mt-4">
              <label class="muted-deep fw-normal form-label fw-normal ml-2">
                <span>{{ __('Custom footer branding') }}</span>
              </label>
               <input type="text" placeholder="{{ __('input footer text') }}" name="extra_custom_branding" class="form-control" value="{{user('extra.custom_branding')}}">
            </div>
            @endif
           <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Customer refund') }}</span>
                <small class="d-block mt-2">{{ __('Customers are able to request for refunds with this option enabled') }}</small>
              </label>
              <div class="form-control-wrap">
                 <select class="form-select custom-select" data-search="off" data-ui="lg" name="extra_refund_request">
                  @foreach (['1' => 'Enable refund requests', '0' => 'Disable refund requests'] as $key => $value)
                  <option value="{{$key}}" {{ user('extra.refund_request') == $key ? 'selected' : '' }}> {{ __($value) }}</option>
                  @endforeach
                </select>
              </div>
            </div>

           <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Enable customer invoice') }}</span>
                <small class="d-block mt-2">{{ __('A customer gets an invoice before and after purchase') }}</small>
              </label>
              <div class="form-control-wrap">
                 <select class="form-select custom-select" data-search="off" data-ui="lg" name="extra_invoicing">
                  @foreach (['1' => 'Enable invoice', '0' => 'Disable invoice'] as $key => $value)
                  <option value="{{$key}}" {{ user('extra.invoicing') == $key ? 'selected' : '' }}> {{ __($value) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
           <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Shipping') }}</span>
                <small class="d-block mt-2">{{ __('Select checkout shipping types') }}</small>
              </label>
              <div class="form-control-wrap">
                 <select class="form-select custom-select" data-search="off" data-ui="lg" name="extra_shipping_types">
                  @foreach (['enable' => 'Enable shipping - (Buyer can still buy without selecting your shipping locations)', 'my_shipping' => 'My shipping - (Buyer cannot buy unless they select one of your shipping locations)', 'disable' => 'Disable shipping - (Shipping option will be disabled on checkout)'] as $key => $value)
                  <option value="{{$key}}" {{ user('extra.shipping_types') == $key ? 'selected' : '' }}> {{ __($value) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>



        @if (package('settings.google_analytics') || package('settings.facebook_pixel'))
        <div class="data-head d-flex w-100 align-items-center justify-content-between mb-5 mt-5">
           <div>
              <h6 class="overline-title"><span>{{ __('Analytics') }}</span></h6>
           </div>
           <div>
              <button class="btn btn_sm_primary bg-blue c-save ml-auto d-none d-md-block"><span>{{ __('Save') }}</span> <em class="icon ni ni-edit"></em></button>
           </div>
        </div>
        @endif
        <div class="row">
          @if (package('settings.google_analytics'))
          <div class="col-md-6">
           <div class="form-group mt-5 mt-lg-2 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Google Analytics ID') }}</span>
                <small class="d-block mt-2">{{ __('Enable tracking with Google Analytics by adding your analytics ID. ex: UA-22222222-33') }}</small>
              </label>
              <div class="form-control-wrap">
                  <input type="text" class="form-control form-control-lg" placeholder="{{ __('Enter google analytics id') }}" name="extra_google_analytics" value="{{ user('extra.google_analytics') }}">
               </div>
           </div>
          </div>
          @endif
          @if (package('settings.facebook_pixel'))
          <div class="col-md-6">
           <div class="form-group mt-5 mt-lg-2 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Facebook Pixel') }}</span>
                <small class="d-block mt-2">{{ __('Enable Facebook Pixel by adding only your Facebook Pixel ID') }}</small>
              </label>
              <div class="form-control-wrap">
                  <input type="text" class="form-control form-control-lg" placeholder="{{ __('Enter facebook pixel id') }}" name="extra_facebook_pixel" value="{{ user('extra.facebook_pixel') }}">
               </div>
           </div>
          </div>
          @endif
        </div>
        <div class="data-head d-flex align-items-center justify-content-between mb-5 mt-5">
           <div>
              <h6 class="overline-title"><span>{{ __('Security') }}</span></h6>
           </div>
           <div>
              <button class="btn btn_sm_primary bg-blue c-save ml-auto d-none d-md-block"><span>{{ __('Save') }}</span> <em class="icon ni ni-edit"></em></button>
           </div>
        </div>
        <div class="col-md-4 p-0">
          <div class="form-group mt-5 mt-lg-2 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2">
                <span>{{ __(' Change Password') }}</span>
                <small class="d-block mb-3">{{ __('The password must be at least 8 characters.') }}</small>
                <small class="d-block">{{ __('Password must contain at least one lowercase letter, one uppercase letter and a special character') }}</small>
              </label>
              <div class="form-control-wrap">
                  <input type="text" class="form-control form-control-lg" placeholder="***********" name="password">
               </div>
          </div>
        </div>
        <div class="data-head d-flex align-items-center justify-content-between mb-5 mt-5">
           <div>
              <h6 class="overline-title"><span>{{ __('Extra') }}</span></h6>
           </div>
           <div>
              <button class="btn btn_sm_primary bg-blue c-save ml-auto d-none d-md-block"><span>{{ __('Save') }}</span> <em class="icon ni ni-edit"></em></button>
           </div>
        </div>
        @if (package('settings.add_to_head'))
        <div class="col-md-6 p-0">
          <div class="form-group mt-5 mt-lg-2 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2">
                <span class="d-block">{{ __('Add to Head') }}</span>
                <small>{{ __('Add script to head of store') }}</small>
              </label>
              <div class="form-control-wrap">
                <textarea name="settings[headScript]" class="form-control form-control-lg" cols="30" rows="10">{{ user('extra.headScript') }}</textarea>
               </div>
          </div>
        </div>
        @endif
      </div>
      <div class="tab-pane fade" id="pills-template" role="tabpanel"
        aria-labelledby="pills-template-tab">
            <div class="row">
                @foreach ($templates as $key => $items)
                  <div class="col-md-4 my-2">
                  <label class="awe-block-item" style="background-image: url({{ url('media/misc/' . $items['banner'] ?? '')}});">

                    <input type="radio" {{(!empty(user('extra.template')) && $items['name'] == user('extra.template')) ? "checked" : ""}} name="extra_template" value="{{ $items['name'] ?? '' }}" class="custom-control-input template {{(!empty(user('extra.template')) && $items['name'] == user('extra.template')) ? "active" : ""}}">

                    <span class="hide item-duration">{{ __('Selected') }}</span>

                    @if ((!empty(user('extra.template')) && $items['name'] == user('extra.template')))
                    <span class="tag item-duration">{{ __('Active') }}</span>
                    @endif

                    <div class="play-button">
                      <i class="tio checkmark_circle_outlined fs-18px"></i>
                    </div>

                    <div class="item-overlay"></div>
                     <div class="overlay-layer">
                            <div class="overlay-content">
                                <div class="inner-content">
                                    <h3 class="media-title">{{ $items['title'] ?? '' }}</h3>
                                    <p>{{ $items['description'] ?? '' }}</p>
                                    <div class="media-meta">
                                        <img src=" " alt="" hidden>
                                        <a class="meta-item is-hoverable">{{ __('By') }} {{ $items['author'] ?? '' }}</a>
                                        <span class="separator">|</span>
                                        <a class="meta-item is-hoverable">{{ count(get_theme_blocks($user->id, $key) ?? []) }} {{ __('Blocks') }}</a>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </label>
                  </div>
                @endforeach
                </div>
      </div>
      <div class="tab-pane fade" id="pills-social" role="tabpanel"
        aria-labelledby="pills-social-tab">
        <div class="row">
          @if ($package->settings->social)
            @foreach ($socials as $key => $items)
              <div class="col-md-4">
                <div class="form-group custom mb-1 mb-lg-4">
                   <label class="muted-deep fw-normal m-2"><em class="icon ni ni-{{$items['icon']}}"></em> <span>{{ ucfirst($key) }}</span></label>
                   <input type="text" class="form-control" value="{{ user('socials.'.$key) ?? '' }}" name="socials[{{$key}}]">
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
      <div class="tab-pane fade" id="pills-payments" role="tabpanel"
        aria-labelledby="pills-payments-tab">
        @include('includes.gateways')
      </div>
      <div class="tab-pane fade" id="pills-extra" hidden role="tabpanel"
        aria-labelledby="pills-extra-tab">
        @if (Theme::has(user('extra.template')) && file_exists(public_path('Themes/'.Theme::get(user('extra.template'))['name'].'/views/settings/extra-settings.blade.php')))
          <?php require(public_path('Themes/'.Theme::get(user('extra.template'))['name'].'/views/settings/extra-settings.blade.php')) ?>
        @endif
      </div>
      <div class="tab-pane fade" id="pills-ss" role="tabpanel"
        aria-labelledby="pills-ss-tab">
      </div>
    </div>
  </div>

  <button class="btn btn_sm_primary radius-8 effect-letter bg-blue c-white">{{ __('Save') }}</button>
</form>
  </div>
@stop