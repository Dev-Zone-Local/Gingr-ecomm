@extends('layouts.app')
@section('headJS')
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Paytone+One&display=swap" rel="stylesheet"> 
  @if (config('app.captcha_status') && config('app.captcha_type') == 'recaptcha')
  {!! htmlScriptTagJsApi() !!}
  @endif
    <style>
      .container-lg{
        max-width: initial !important;
        padding: 0 !important;
      }
      .section_state.animetext .bb_qgency_state .blur_item {
        top: 60%;
      }
      .link_state{
        z-index: 999;
        position: relative;
      }
    </style>
@stop
@section('footerJS-down')

  <script src="{{ url('assets/js/pages/agency.js') }}" type="text/javascript"></script>
@stop

  @section('title', __('Complete Storefront Solution'))
    @section('content')

      <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start Banner Section -->
        <section class="demo_1 banner_section banner_demo8 demo__charity">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-5 order-2 order-lg-1 my-auto">
                <div class="banner_title">
                  <h1>
                    {{ __('Create Your Online Store in Minutes!') }}
                  </h1>
                  <p>
                    {{ __('Ecom is a powerful e-Commerce software that allows you to create and manage your own virtual store with ease.') }}
                  </p>
                  <a href="{{ route('register') }}" class="btn scale btn_md_primary btn_video btn_vdo_default rounded-pill mr-3">
                    {{ __('Start Now!') }}
                  </a>
                  @if (!empty($demo_user))
                   <a href="{{ profile($demo_user->id) }}" target="_blank" class="btn btn_md_primary effect-letter rounded-pill bg-blue c-white">{{ __('View Demo') }}</a>
                  @endif
                </div>
              </div>
              <div class="col-lg-6 ml-auto order-1 order-lg-1">
                <div class="illustration__ch">
                  <img class="img-fluid" src="{{ url('media/misc/Ecom Store Owner Landing Assets 1.png') }}">
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Banner -->


        <!-- Start About -->
        <section class="abo_company mt-5" id="how-it-work">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 emo mb-4 mb-lg-0">
                <div class="gq_item bg-blue h-100">
                  <span class="d-block c-white font-s-16">{{ __('Getting Started') }}</span>
                  <div class="title_sections">
                    <img class="mb-3" src="{{ url('media/misc/waving_hand.gif') }}" width="60" />
                    <h2 class="c-white">{{ __('Create An Account') }}</h2>
                    <p class="c-white">
                      {{ __('Sign up easily with your email, social media account like Facebook or your Google account.') }}
                    </p>

                    <a href="{{ route('register') }}" class="btn btn_sm_primary bg-white mt-4">{{ __('Sign Up Now') }}</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 emo mb-4 mb-lg-0">
                <div class="gq_item ill_item h-100">
                  <span class="d-block c-dark font-s-16">{{ __('What Next?') }}</span>
                  <img class="img-fluid ill_sec" src="{{ url('media/misc/Ecom Store Owner Landing Assets 2.png') }}" />
                  <div class="title_sections">
                    <h2 class="c-dark">{{ __('Setup Your Account') }}</h2>
                    <p class="c-gray">
                     {{ __('Give your newly created store a name, upload your logo and select your preferred payment channel to enable you receive payments.') }}
                    </p>

                    <a href="{{ route('register') }}" class="btn btn_sm_primary bg-white mt-4">{{ __('Start Now') }}</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 emo">
                <div class="gq_item ill_item h-100">
                  <span class="d-block c-dark font-s-16">{{ __('The Finishing Touch') }}</span>
                  <img class="img-fluid ill_sec" src="{{ url('media/misc/Ecom Store Owner Landing Assets 3.png') }}" />
                  <div class="title_sections">
                    <h2 class="c-dark">{{ __('Add Your Products') }}</h2>
                    <p class="c-gray">
                      {{ __('Create new products and edit existing ones with ease. Set downloadable products and post variations as preferred.') }}
                    </p>

                    <a href="{{ route('register') }}" class="btn btn_sm_primary bg-white mt-4">{{ __('Get Started Now') }}</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. About -->

        <!-- Start section__priorities -->
        <section class="section__priorities padding-t-12" id="Priorities">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 order-lg-3">
                <div class="point__item">
                  <div class="row">
                    <div class="col-12 d-flex item__ico align-items-center p-3 radius-100 card-shadow" data-aos="fade-up" data-aos-delay="0">
                      <div class="icon__ch p-4 h-55px w-55px radius-100 border-0 d-flex align-items-center mb-0 mr-3 bg-blue">
                        <img src="{{ url('media/icons/Ecom Icon 2.png') }}" class="w-30px h-30px" alt="">
                      </div>
                      <h3 class="align-items-center d-flex">
                        {{ __('Multiple Payment Options') }}
                      </h3>
                    </div>

                    <div class="col-12 d-flex item__ico align-items-center p-3 radius-100 card-shadow" data-aos="fade-up" data-aos-delay="0">
                      <div class="icon__ch p-4 h-55px w-55px radius-100 border-0 d-flex align-items-center mb-0 mr-3 bg-blue">
                        <img src="{{ url('media/icons/Ecom Icon 4.png') }}" class="w-30px h-30px" alt="">
                      </div>
                      <h3 class="align-items-center d-flex">
                        {{ __('CRM') }}
                      </h3>
                    </div>

                    <div class="col-12 d-flex item__ico align-items-center p-3 radius-100 card-shadow" data-aos="fade-up" data-aos-delay="0">
                      <div class="icon__ch p-4 h-55px w-55px radius-100 border-0 d-flex align-items-center mb-0 mr-3 bg-blue">
                        <img src="{{ url('media/icons/Ecom Icon 6.png') }}" class="w-30px h-30px" alt="">
                      </div>
                      <h3 class="align-items-center d-flex">
                        {{ __('Chat System') }}
                      </h3>
                    </div>

                    <div class="col-12 d-flex item__ico align-items-center p-3 radius-100 card-shadow" data-aos="fade-up" data-aos-delay="0">
                      <div class="icon__ch p-4 h-55px w-55px radius-100 border-0 d-flex align-items-center mb-0 mr-3 bg-blue">
                        <img src="{{ url('media/icons/Ecom Icon 8.png') }}" class="w-30px h-30px" alt="">
                      </div>
                      <h3 class="align-items-center d-flex">
                        {{ __('Rich Analytics') }}
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 order-lg-2">
                <div class="illustration_pro d-flex align-items-center h-100" data-aos="fade-up" data-aos-delay="0">
                  <img class="img-fluid" src="{{ url('media/misc/Ecom Store Owner Landing Assets 6.png') }}">
                </div>
              </div>
              <div class="col-lg-3 order-lg-1">
                <div class="point__item">
                  <div class="row">
                    <div class="col-12 d-flex item__ico align-items-center p-3 radius-100 card-shadow" data-aos="fade-up" data-aos-delay="0">
                      <h3 class="align-items-center d-flex ml-auto">
                        {{ __('Page Blocks') }}
                      </h3>

                      <div class="icon__ch p-4 h-55px w-55px radius-100 border-0 d-flex align-items-center mb-0 ml-3 bg-blue">
                        <img src="{{ url('media/icons/Ecom Icon 1.png') }}" class="w-30px h-30px" alt="">
                      </div>
                    </div>

                    <div class="col-12 d-flex item__ico align-items-center p-3 radius-100 card-shadow" data-aos="fade-up" data-aos-delay="0">
                      <h3 class="align-items-center d-flex ml-auto text-right">
                        {{ __('Advanced Product Management') }}
                      </h3>

                      <div class="icon__ch p-4 h-55px w-55px radius-100 border-0 d-flex align-items-center mb-0 ml-3 bg-blue">
                        <img src="{{ url('media/icons/Ecom Icon 3.png') }}" class="w-30px h-30px" alt="">
                      </div>
                    </div>

                    <div class="col-12 d-flex item__ico align-items-center p-3 radius-100 card-shadow" data-aos="fade-up" data-aos-delay="0">
                      <h3 class="align-items-center d-flex ml-auto">
                        {{ __('Store QR Code') }}
                      </h3>

                      <div class="icon__ch p-4 h-55px w-55px radius-100 border-0 d-flex align-items-center mb-0 ml-3 bg-blue">
                        <img src="{{ url('media/icons/Ecom Icon 5.png') }}" class="w-30px h-30px" alt="">
                      </div>
                    </div>

                    <div class="col-12 d-flex item__ico align-items-center p-3 radius-100 card-shadow" data-aos="fade-up" data-aos-delay="0">
                      <h3 class="align-items-center d-flex ml-auto text-right">
                        {{ __('User Support System') }}
                      </h3>
                      <div class="icon__ch p-4 h-55px w-55px radius-100 border-0 d-flex align-items-center mb-0 ml-3 bg-blue">
                        <img src="{{ url('media/icons/Ecom Icon 7.png') }}" class="w-30px h-30px" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. section__priorities -->

        <!-- Start Pricing -->
        <section class="pricing_section padding-t-10" id="Pricing">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-8 col-lg-6 text-center">
                <div class="title_sections">
                  <div class="before_title">
                      <h3 class="title-heading mt-4">{!! __('Pricing Plan') !!}</h3>
                  </div>
                  <h2>{{ __('Check out our simple subscription') }}</h2>
                </div>
              </div>
            </div>

                @include('includes.pricing', ['packages' => $packages, 'class' => 'm-0'])
          </div>
        </section>
        <!-- End Start Pricing -->
        @if (settings('site.show_pages'))
        @if (!empty($pages))
        <!-- Start section__stories -->
        <section class="section__stories padding-t-12" id="Stories">
          <div class="container">
            <div class="swip__stories">
              <!-- Swiper -->
              <div class="swiper-container feature_strories">
                <div class="title_sections">
                  <h2>{{ __('Pages') }}</h2>
                </div>
                <div class="swiper-wrapper">
                  @foreach ($pages as $item)
                  <div class="swiper-slide">
                    <a href="{{$item->type == 'internal' ? url('page/' . $item->url) : $item->url}}" target="{{ $item->type == 'internal' ? '_self' : '_blank' }}" class="item">
                      <div class="img__nature">
                        <img src="{{ getStorage('media/pages', $item->image) }}" alt=" ">
                      </div>
                      <div class="inf__txt">
                        <span>{{ $item->pages_categories_name }}</span>
                        <h3>{{$item->title}}</h3>
                        <time>{{ Carbon\Carbon::parse($item->edited_on)->toFormattedDateString() }}</time>
                      </div>
                    </a>
                  </div>
                  @endforeach

                </div>

                <!-- Add Arrows -->
                <div class="swiper-button-next">
                  <i class="tio chevron_right"></i>
                </div>
                <div class="swiper-button-prev">
                  <i class="tio chevron_left"></i>
                </div>

              </div>

            </div>
          </div>
        </section>
        <!-- End. section__stories -->
        @endif
        @endif

      @if(settings('package_trial.status') == 1)
        <!-- Start help__ch -->
        <section class="help__ch margin-t-5 padding-py-12 mb-5">
          <div class="container">
            <div class="row justify-content-center text-center">
              <div class="col-md-8 col-lg-5">
                <div class="title_sections">
                  <div class="before_title">
                    <span class="c-lightgreen">{{ __('Get Started Today') }}</span>
                  </div>
                  <h2>{{ __('Start A Free Trial') }}</h2>
                  <p>{{ __('Try Ecom for 7 days FREE and explore the powerful tools that makes managing your online store a breeze!') }}</p>
                </div>
                <div class="back__img">
                  <img class="part__1 h-25em" src="{{ url('media/misc/Ecom Store Owner Landing Assets 4.png') }}" alt="">
                  <img class="part__2 h-25em d-lg-block d-none" src="{{ url('media/misc/Ecom Store Owner Landing Assets 5.png') }}" alt="">
                </div>

                <div class="button__super">
                  <a href="{{ route('register') }}" class="btn btn_md_primary sweep_top sweep_letter rounded-pill bg-lightgreen c-white w-100">
                    <div class="inside_item">
                      <span data-hover="{{ __("Let's go 👋") }}">{{ __('Get Started for free') }}</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>
        @endif


        @if (settings('site.store_count'))
        <!-- Start Statistic -->
        <section class="padding-t-12 section_state state_demo2" id="Statistic">
          <!-- particle background -->
          <div id="particles-js"></div>
          <div class="container">
            <div id="triggerBlur"></div>
            <div class="row justify-content-center text-center">
              <div class="col-md-8 col-lg-6">
                <div class="title_sections mb-1">
                  <div class="before_title">
                    <span>{{ __('Start') }}</span>
                    <span class="c-gold">{{ __('Now') }}</span>
                  </div>
                  <h2>{{ __('Join others already using our platform') }}</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="bb_qgency_state">
                  <div class="number_state">
                    <div class="txt">
                      {{ store_count_stats('count') }}
                    </div>
                  </div>
                  <div class="blur_item"></div>
                  <div class="users_profile">
                    {!! store_count_stats('getActiveUsersAvatar') !!}
                  </div>
                  <div class="link_state">
                    <a href="{{ route('register') }}" class="btn btn_xl_primary btn_join bg-blue effect-letter rounded-8 mb-3 mb-sm-0">{{ __('Join us') }}</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      @endif

        <!-- Edm. help__ch -->
  @if (settings('contact'))
    <section class="default_footer dark mt-8 padding-t-12 padding-b-10 bg-light" id="contact">
      <div class="container">
        <img class="shape_overlay" src="{{ url('media/shape-lines.svg') }}">
        <div class="row">
          <div class="col-lg-5 margin-b-3 d-flex justify-content-center flex-column">
            <div class="title_sections margin-b-2">
              <h2 class="c-black">{{ __('Contact us') }}</h2>
              <p>
                {{ __('If you have any issue regarding our platform or you have questions regarding our packages or anything, kindly contact us, our team would be glad to help.') }}
              </p>
            </div>
            <div class="dashed-line margin-b-2"></div>
            <!-- Start Testimonial -->
            <div class="block_testimonial">
              <h3>{{ __('Faq') }}</h3>
              <p>{{ __('Here are some of our faq to get started') }}</p>
               <div id="faq-gq" class="accordion border-0">
                  @foreach (\App\Model\Faq::limit(4)->get() as $faq)
                   <div class="accordion-item card card-shadow mt-3">
                        <div class="card-header bg-white card-shadow active" id="headingOne">
                          <h3 class="mb-0">
                            <a href="#" class="btn btn-link accordion-head border-0 collapsed px-0" data-toggle="collapse" data-target="#faq-{{ $faq->id }}">
                              <span>{{ $faq->name }}</span>
                              <span class="accordion-icon"></span>
                             </a>
                          </h3>
                        </div>
                       <div class="accordion-body collapse" id="faq-{{ $faq->id }}" data-parent="#faq-gq">
                           <div class="accordion-inner card-body card-shadow border-0">
                               {!! clean($faq->note) !!}
                           </div>
                       </div>
                   </div><!-- .accordion-item -->
                  @endforeach
               </div><!-- .accordion -->
            </div>
          </div>
          <div class="col-lg-5 mx-auto">
            <form method="post" action="{{ route('contact-us') }}" class="form_register">
                <h3 class="title--forms">{{ __('Fill out the Form') }}</h3>
                 @csrf
                 <div class="row">
                     <div class="col-lg-6">
                         <div class="form-group custom">
                             <label>{{__('First Name')}}</label>
                             <input name="firstname" id="name" class="form-control" type="text">
                         </div>
                     </div>

                     <div class="col-lg-6">
                         <div class="form-group custom">
                             <label>{{__('Last Name')}}</label>
                             <input name="name" id="lastname" class="form-control" type="text">
                         </div>
                     </div>
                 </div>

                 <div class="row">
                     <div class="col-lg-12">
                         <div class="form-group custom">
                             <label>{{__('Email Address')}}</label>
                             <input name="email" id="email" class="form-control" required="" type="email">
                         </div>
                     </div>
                 </div>

                 <div class="row">
                     <div class="col-lg-12">
                         <div class="form-group custom">
                             <label>{{__('Subject')}}</label>
                             <input name="subject" id="subject" class="form-control" type="text">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="form-group custom">
                             <label> {{__('Your Message')}} </label>
                             <textarea name="message" id="message" rows="5" class="form-control"></textarea>
                         </div>
                     </div>
                 </div>
                    <div class="col-12">
                     @if (config('app.captcha_status') && config('app.captcha_type') == 'recaptcha')
                     {!! htmlFormSnippet() !!}
                     @endif
                     @if (config('app.captcha_status') && config('app.captcha_type') == 'default')
                     <div class="row mt-3">
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
                    </div>
                    <div class="col-12">
                      <button class="btn mt-3 btn_sm_primary effect-letter bg-blue">{{ __('Send Message') }}</button>
                    </div>
                </form>
              </div>
            </div>
            <!-- Forms -->
          </div>
        </section>
        @endif
      </main>
@stop