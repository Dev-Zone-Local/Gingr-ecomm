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
    </style>
@stop
  @section('title', __('Complete Storefront Solution'))
    @section('content')

      <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start Banner Section -->
        <section class="demo_1 banner_section banner_demo7">
          <div class="container">
            <div class="row">
              <div class="col-md-5 my-auto">
                <div class="banner_title mt-7">
                  <h1>{{ __('The Complete e-Commerce Solution') }}</h1>
                  <p>
                    {{ __('Ecom gives you the ease of running an e-commerce store. Wait, it goes beyond that! Whether you’re a store owner, an entrepreneur or a developer, Ecom is built to make the journey easy. How big is Ecom?') }}
                  </p>
                  @if (!empty($demo_user))
                   <a href="{{ profile($demo_user->id) }}" target="_blank" class="btn btn_md_primary effect-letter rounded-8 bg-blue c-white">{{ __('View Demo') }}</a>
                  @endif
                </div>
              </div>
              <div class="col-md-7">
                <img class="ill_05" src="../../assets/img/agency/girl.svg" />
              </div>
            </div>
          </div>
        </section>
        <!-- End Banner -->

        <!-- Start About -->
        <section class="abo_company">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 emo mb-4 mb-lg-0">
                <div class="gq_item bg-blue">
                  <span class="d-block c-white font-s-16">{{ __('Hey there Developer!') }}</span>
                  <div class="title_sections">
                    <img class="mb-3" src="../../assets/img/gif/waving_hand.gif" width="60" />
                    <h2 class="c-white">{{ __('The All-in-one Solution For You') }}</h2>
                    <p class="c-white">
                      {{ __('Ecom is built with everyone in mind. Who doesn’t love fancy dashboards? One, two, in fact, we have 3 dashboards for you - The ADMIN Dashboard - STORE OWNER Dashboard and USER Dashboard. Do you need to code? NO! Simply install and boooom!') }}
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 emo mb-4 mb-lg-0">
                <div class="gq_item ill_item">
                  <span class="d-block c-dark font-s-16">AMC Networks</span>
                  <img class="img-fluid ill_sec" src="../../assets/img/agency/Security.png" />
                  <div class="title_sections">
                    <h2 class="c-dark">Elevating An Iconic Network</h2>
                    <p class="c-gray">
                      Blandit libero volutpat sed cras ornare arcu dui vivamus
                      arcu.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 emo">
                <div class="gq_item ill_item">
                  <span class="d-block c-dark font-s-16">Musicfolio</span>
                  <img class="img-fluid ill_sec" src="../../assets/img/agency/Update.png" />
                  <div class="title_sections">
                    <h2 class="c-dark">Digital Music Composition</h2>
                    <p class="c-gray">
                      Blandit libero volutpat sed cras ornare arcu dui vivamus
                      arcu.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. About -->

        <!-- Start logos -->
        <section class="logos_section logos_demo2 padding-t-10">
          <div class="container">
            <div class="row">
              <div class="col-lg-5">
                <div class="title_sections mb-0">
                  <h2>
                    Using Our Experience To Make Your Digital Experience
                    Brighter
                  </h2>
                  <p>
                    Eu ultrices vitae auctor eu augue ut lectus arcu. Quis
                    hendrerit dolor magna eget est lorem ipsum dolor.
                  </p>
                </div>
              </div>
              <div class="col-lg-6 ml-auto">
                <div class="row">
                  <div class="col-md-5">
                    <div class="item_logo" data-aos="fade-up" data-aos-delay="0">
                      <img src="../../assets/img/logos/xperience.png" />
                      <p class="c-gray">
                        Trusted Rakon Design Agency.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-5 ml-auto">
                    <div class="item_logo" data-aos="fade-up" data-aos-delay="100">
                      <img src="../../assets/img/logos/aust.png" />
                      <p class="c-gray">
                        Trusted Rakon Fashion Agency.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="item_logo" data-aos="fade-up" data-aos-delay="200">
                      <img src="../../assets/img/logos/sitecore.png" />
                      <p class="c-gray">
                        Trusted Rakon digital agency.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End logos -->

        <!-- Start Services -->
        <section class="products_section product_demo2 features_hosting service_demo3 margin-t-8 padding-t-10"
          id="Services">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 margin-b-3">
                <div class="title_sections mb-0">
                  <div class="before_title">
                    <span>Who We</span>
                    <span class="c-blue">Help</span>
                  </div>
                  <h2>Specific challenges require specific solutions</h2>
                  <p>
                    Some of the industries our digital agency specialises in
                  </p>
                </div>
              </div>
              <div class="col-lg-7 ml-sm-auto">
                <div class="row">
                  <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="0">
                      <div class="icon_t">
                        <img src="../../assets/img/icons/Employee.svg" />
                      </div>
                      <h3>Employee Owned</h3>
                      <p>
                        Being employee-owned keeps us focused on the unique
                        needs of our users, and we wouldn't have it any other
                        way.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="100">
                      <div class="icon_t">
                        <img src="../../assets/img/icons/Binocular.svg" />
                      </div>
                      <h3>Passion for Privacy</h3>
                      <p>
                        We believe in everyone's right to privacy, and we back
                        that with a strong anti-spam policy and free WHOIS
                        privacy.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="200">
                      <div class="icon_t">
                        <img src="../../assets/img/icons/Shield-check.svg" />
                      </div>
                      <h3>Commitment to Security</h3>
                      <p>
                        Our many security features include Multi Factor
                        Authentication, auto-enabled sFTP .
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 item pr-sm-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="300">
                      <div class="icon_t">
                        <img src="../../assets/img/icons/Door-open.svg" />
                      </div>
                      <h3>Embrace Open Source</h3>
                      <p>
                        We strongly believe in providing open source solutions
                        to our customers whenever possible.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- .container -->
        </section>
        <!-- End. Services -->

        <!-- Start Works -->
        <section class="works_demo2 gng_serv_about padding-t-10" id="Works">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="title_sections">
                  <div class="before_title">
                    <span>Clients We</span>
                    <span class="c-blue">Work For</span>
                  </div>
                  <h2>Our Recent Projects.</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8">
                <a href="#" class="item_ig item_mywork">
                  <div class="mg_img">
                    <img class="item_pic" src="../../assets/img/agency/0321.png" />
                  </div>
                  <div class="info_work">
                    <h4>
                      Spring Labs — Disrupting How Financial Info Is Shared.
                    </h4>
                    <p>
                      Websites & Digital Platforms
                    </p>
                    <div class="link_view">Show Project</div>
                  </div>
                </a>
              </div>
              <div class="col-lg-4">
                <div class="item_ig item_mywork">
                  <div class="icon_played">
                    <button type="button" class="btn" data-toggle="modal"
                      data-src="https://www.youtube.com/embed/VvHoHw5AWTk" data-target="#mdllVideo">
                      <div class="scale rounded-circle play_video">
                        <i class="tio play_outlined"></i>
                      </div>
                    </button>
                  </div>
                  <a href="#" class="d-block">
                    <div class="mg_img">
                      <img class="item_pic" src="../../assets/img/agency/097.png" />
                    </div>
                    <div class="info_work">
                      <h4>Healto — Evolving Healthcare Systems.</h4>
                      <p>
                        Websites & Digital Platforms
                      </p>
                      <div class="link_view">Show Project</div>
                    </div>
                  </a>

                </div>
              </div>
              <div class="col-lg-4">
                <a href="#" class="item_ig item_mywork">
                  <div class="mg_img">
                    <video class="item_pic" playsinline muted autoplay loop
                      src="../../assets/img/agency/rezz-jamming_2.mp4"></video>
                  </div>
                  <div class="info_work">
                    <h4>Healto — Evolving Healthcare Systems.</h4>
                    <p>
                      Websites & Digital Platforms
                    </p>
                    <div class="link_view">Show Project</div>
                  </div>
                </a>
              </div>
              <div class="col-lg-8">
                <a href="#" class="item_ig item_mywork">
                  <div class="mg_img">
                    <img class="item_pic" src="../../assets/img/agency/78970654.png" />
                  </div>
                  <div class="info_work">
                    <h4>
                      Spring Labs — Disrupting How Financial Info Is Shared.
                    </h4>
                    <p>
                      Websites & Digital Platforms
                    </p>
                    <div class="link_view">Show Project</div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </section>
        <!-- End. works -->

        <!-- Start Testimonial -->
        <section class="testimonial_demo2 padding-t-12">
          <div class="container">
            <div class="row justify-content-between">
              <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="item_mmon">
                  <div class="profile_user">
                    <img src="../../assets/img/persons/14.png" />
                    <div class="categ">
                      <span>Project Manager</span>
                    </div>
                  </div>
                  <div class="info_persons">
                    <p>
                      "Mobiteam created our full Visual Brand Identity and our
                      online store. We worked together on this project for 4
                      months and I have exclusively positive feedback. We were
                      far from IT and development."
                    </p>
                    <h5>Tommy Reaves</h5>
                    <span>Rexona</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="item_mmon">
                  <div class="profile_user">
                    <img src="../../assets/img/persons/13.png" />
                    <div class="categ">
                      <span>CEO Founder</span>
                    </div>
                  </div>
                  <div class="info_persons">
                    <p>
                      "We looked for an ambitious team to join us for this
                      realization journey. Right from the beginning, we were
                      impressed how Marcel and his team carefully and
                      proactively read and commented on our proposal."
                    </p>
                    <h5>Lydia James</h5>
                    <span>orino Stu.</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. Testimonial -->

        <!-- hide Header -->
        <!-- <div id="triggerForm"></div> -->
        <!-- End. -->

        <!-- Start Services -->
        <!-- <section class="service_demo4 content_item" id="pinContainer">
          <div class="Slide_horizontal_scroll">
            <div class="container">
              <div id="slideContainer">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item_slide panel">
                      <div class="block_img">
                        <div class="block_item" data-fx="22">
                          <a class="block__title c-dark" data-img="../../assets/img/agency/xore___solar_system.gif">Branding &
                            Identity</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="item_slide panel">
                      <div class="block_img">
                        <div class="block_item" data-fx="22">
                          <a class="block__title c-dark" data-img="../../assets/img/agency/notsohotdogdribbble.gif">Websites &
                            Digital
                            Platforms</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="item_slide panel">
                      <div class="block_img">
                        <div class="block_item" data-fx="22">
                          <a class="block__title c-dark" data-img="../../assets/img/agency/098401.gif">eCommerce
                            Experiences</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="item_slide panel">
                      <div class="block_img">
                        <div class="block_item" data-fx="22">
                          <a class="block__title c-dark" data-img="../../assets/img/agency/turtle-power.gif">Performance
                            Marketing</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="item_slide panel">
                      <div class="block_img">
                        <div class="block_item" data-fx="22">
                          <a class="block__title c-dark" data-img="../../assets/img/agency/5_b.gif">eCommerce
                            Experiences</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> -->
        <!-- End Services -->

        <!-- Show Header -->
        <!-- <div id="triggerTo"></div> -->
        <!-- End. -->


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
        <!-- Start Agency About -->
        <section class="about_agency padding-t-15" id="About">
          <div class="container">
            <div class="row">
              <div class="col-lg-5">
                <div class="title_sections mb-0">
                  <div class="before_title">
                    <span>Digital Agency</span>
                    <span class="c-blue">People</span>
                  </div>
                  <h2>The brightest minds in digital, at your service 👋</h2>
                  <p>
                    Coinbase has a variety of features that make it the best
                    place to start trading
                  </p>
                  <p>
                    You’re unique. A one-off. A fascinating work in progress.
                    Your life isn’t off-the-shelf. So should your home be?
                  </p>
                  <p>
                    We say no. It’s why you can change the size, colours and
                    materials of nearly every design. And we’re here to help
                    you style your home, your way. And although styling advice
                    is always free in our stores, this month, you can enjoy
                    the full in-home experience at no cost.
                  </p>
                  <p>
                    Live a life as individual as you are. Live ekstraordinær.
                  </p>
                  <img class="inside_pic" src="../../assets/img/agency/98701.jpg" />
                </div>
              </div>
              <div class="col-lg-5 ml-auto">
                <div class="pro_agency">
                  <img src="../../assets/img/agency/0976401.jpg" />
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Edn. Agency About -->

        <!-- strat Blog -->
        <section class="blog_agency margin-t-5 padding-t-12" id="Blog">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-lg-3">
                <div class="title_sections">
                  <h2>We Write Insightful Stuff</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 mb-3 mb-lg-0 items">
                <a href="#" class="item_art">
                  <div class="item_top">
                    <div class="date_mo">
                      <h5>31</h5>
                      <span>Mar</span>
                    </div>
                    <div class="item_cai">
                      <span class="c-red">Popular Posts</span>
                      <div class="name_pub">By John Smith</div>
                    </div>
                  </div>
                  <img src="../../assets/img/agency/097422.png" />
                  <div class="ga_info">
                    <h4>
                      Should Your Brand ride the Coronavirus Wave to drive
                      gains?
                    </h4>
                    <div class="tags__bottom">
                      <span>#Google </span>
                      <span>#Amazon</span>
                      <span>#Design</span>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0 items">
                <a href="#" class="item_art">
                  <div class="item_top">
                    <div class="date_mo">
                      <h5>4</h5>
                      <span>Jun</span>
                    </div>
                    <div class="item_cai">
                      <span>Design</span>
                      <div class="name_pub">By John Smith</div>
                    </div>
                  </div>
                  <img src="../../assets/img/agency/654.png" />
                  <div class="ga_info">
                    <h4>
                      Should Your Brand ride the Coronavirus Wave to drive
                      gains?
                    </h4>
                    <div class="tags__bottom">
                      <span>#Google </span>
                      <span>#Amazon</span>
                      <span>#Design</span>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0 items">
                <a href="#" class="item_art is_image">
                  <img src="../../assets/img/agency/09874.png" />
                </a>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0 items">
                <a href="#" class="item_art is_image">
                  <img src="../../assets/img/agency/06541.png" />
                </a>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0 items">
                <a href="#" class="item_art">
                  <div class="item_top">
                    <div class="date_mo">
                      <h5>9</h5>
                      <span>Jun</span>
                    </div>
                    <div class="item_cai">
                      <span>Developer</span>
                      <div class="name_pub">By John Smith</div>
                    </div>
                  </div>
                  <img src="../../assets/img/agency/0654.png" />
                  <div class="ga_info">
                    <h4>
                      Should Your Brand ride the Coronavirus Wave to drive
                      gains?
                    </h4>
                    <div class="tags__bottom">
                      <span>#Google </span>
                      <span>#Amazon</span>
                      <span>#Design</span>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0 items">
                <a href="#" class="item_art">
                  <div class="item_top">
                    <div class="date_mo">
                      <h5>13</h5>
                      <span>Jun</span>
                    </div>
                    <div class="item_cai">
                      <span>Illustration</span>
                      <div class="name_pub">By John Smith</div>
                    </div>
                  </div>
                  <img src="../../assets/img/agency/11654.png" />
                  <div class="ga_info">
                    <h4>
                      Should Your Brand ride the Coronavirus Wave to drive
                      gains?
                    </h4>
                    <div class="tags__bottom">
                      <span>#Google </span>
                      <span>#Amazon</span>
                      <span>#Design</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </section>
        <!-- End. Blog -->

        <!-- Start Statistic -->
        <section class="margin-t-12 section_state" id="Statistic">
          <!-- particle background -->
          <div id="particles-js"></div>
          <div class="container">
            <div id="triggerBlur"></div>
            <div class="row justify-content-center text-center">
              <div class="col-md-5">
                <div class="title_sections">
                  <div class="before_title">
                    <span>Agency</span>
                    <span class="c-blue">Stats</span>
                  </div>
                  <h2>Be up to date with agency stats</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="bb_qgency_state">
                  <div class="number_state">
                    <div class="txt">
                      350 000
                    </div>
                  </div>
                  <div class="blur_item"></div>
                  <div class="content_state">
                    <div class="row justify-content-md-center">
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="../../assets/img/icons/1f469.png" />
                          </div>
                          <div class="info_txt">
                            <h4>25 000</h4>
                            <p>
                              Followers from all countries of the world
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="../../assets/img/icons/2665.png" />
                          </div>
                          <div class="info_txt">
                            <h4>130 000</h4>
                            <p>
                              Likes and encouragement
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="../../assets/img/icons/1f58c.png" />
                          </div>
                          <div class="info_txt">
                            <h4>7 200</h4>
                            <p>
                              Agency designs from 2012
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="../../assets/img/icons/1f647-2640.png" />
                          </div>
                          <div class="info_txt">
                            <h4>15 320</h4>
                            <p>
                              Discussions and business requests
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="users_profile">
                    <img src="../../assets/img/persons/02.png" />
                    <img src="../../assets/img/persons/01.png" />
                    <img src="../../assets/img/persons/15.png" />
                    <img src="../../assets/img/persons/04.png" />
                    <img src="../../assets/img/persons/03.png" />
                    <img src="../../assets/img/persons/05.png" />
                    <img src="../../assets/img/persons/16.png" />
                  </div>
                  <div class="link_state">
                    <a href="#" class="btn btn_xl_primary btn_join effect-letter rounded-8 mb-3 mb-sm-0">
                      Join The Agency</a>
                    <a href="#" class="btn btn_xl_primary btn_touch rounded-8">
                      <img src="../../assets/img/icons/1f607.png" />
                      Get a touch
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. Statistic -->

      </main>
      <!-- end main -->

  <div id="wrapper" class="d-none" hidden>
    <div id="content">
      <!-- Stat main -->
      <main>
        <section class="demo_2 demo_3 banner_section">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-6 z-index-3">
                <div class="banner_title mb-0">
                  <div class="fs-20px mb-0">
                    <span class="c-dark">{{ __('Welcome to') }}</span> 
                    <span class="c-green">{{ env('APP_NAME') }}</span>
                  </div>
                  <h1 class="text-dark mt-0">{{ __('Create Your Own e-Commerce Store!') }}</h1>
                  <p class="text-dark">
                    {{ __('Start your e-commerce store with a few easy steps. Create products, set categories, connect a payment gateway and publish your sparkling new e-commerce site in a few minutes!') }}
                  </p>
                  <div class="form-row">
                    <div class="col-md-12 col-12 form-group input_subscribe dark mb-0 d-lg-flex">
                      <form class="item_input" method="get" action="{{ route('register') }}">
                        <input type="email" class="form-control rounded-8" placeholder="{{ __('Enter email address') }}" aria-describedby="emailHelp" name="email">
                        <button class="btn scale c-white btn_md_primary rounded-8 btn_subscribe">
                          {{ __('Sign Up') }}
                        </button>
                      </form>
                        @if (!empty($demo_user))
                          <a href="{{ profile($demo_user->id) }}" target="_blank" class="btn demo-store ml-lg-3 btn-outline-primary rounded-pill">{{ __('Demo Store') }}</a>
                        @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-lg-6 z-index-2">
                <!-- Do nothing -->
              </div>
                <div class="img--elements">
                  <img src="{{ url('media/Ecom-UI-Assets-1.png') }}">
                </div>
                <img src="{{ url('media/Ecom-UI-Assets-2.png') }}" class="overlay_yellow d-none z-index-1 d-md-block">
            </div>
          </div>
        </section>
        <section class="products_section product_demo3 padding-t-12 mt-md-5" id="Services">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-5 margin-b-3">
                <div class="title_sections margin-b-2">
                  <div class="before_title">
                    <span>{{ __('What You') }}</span>
                    <span class="c-green">{{ __('Get') }}</span>
                  </div>
                  <h2 class="c-dark">
                    {{ __('All you will ever need to create your own online store!') }}
                  </h2>
                </div>
                <a href="{{ route('login') }}" class="btn btn_md_primary z-index-2 c-white scale bg-orange-red effect-letter rounded-8">{{ __('Get started') }}</a>
                <img class="mt-4 d-sm-none d-lg-block" src="{{ url('media/Ecom-UI-Assets-4.png') }}" width="460">
              </div>
              <div class="col-lg-6 ml-sm-auto">
                <div class="row">
                  <div class="col-md-6 margin-b-5">
                    <div class="item_pro">
                      <i class="icon ni ni-setting"></i>
                      <h4 class="c-black mt-2">{{ __('Easy Setup & Management') }}</h4>
                      <p class="c-black">
                        {{ __('Simply create an account, setup your store and publish in minutes. Manage sales conveniently!') }}
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 margin-b-5">
                    <div class="item_pro">
                      <i class="icon ni ni-template"></i>
                      <h4 class="c-black mt-2">{{ __('Rich Analytics System') }}</h4>
                      <p class="c-black">
                        {{ __('Measure your growth, track sales, manage views and other detailed analytics right from your dashboard.') }}
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 margin-b-5">
                    <div class="item_pro">
                      <i class="icon ni ni-grid-fill"></i>
                      <h4 class="c-black mt-2">{{ __('Multiple Payment Gateway Options') }}</h4>
                      <p class="c-black">
                        {{ __('Choose from a variety of available payment option that suites you and receive payments easily.') }}
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 margin-b-5">
                    <div class="item_pro">
                      <i class="icon ni ni-link"></i>
                      <h4 class="c-black mt-2">{{ __('Add Your Social Media Links') }}</h4>
                      <p class="c-black">
                        {{ __('Let your visitors link directly to your social media pages by simply adding your preferred links to your store!') }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- .container -->
        </section>

        <section class="services_section py-9 support_item mt-8" id="how-it-work">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-10 col-lg-6 text-center">
                <div class="title_sections">
                  <div class="before_title">
                    <span>{{ __("How It") }}</span>
                    <span class="c-green">{{ __('Works') }}</span>
                  </div>
                  <h2>{{ __('Let’s Get You Started') }}</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-4 mb-3 mb-lg-0 padding-r-5">
                <div class="items_serv sevice_block">
                  <div class="icon--top">
                    <i class="icon ni ni-setting-alt"></i>
                  </div>
                  <div class="txt">
                    <h4 class="c-black">{{ __('Create An Account') }}</h4>
                    <p>
                     {{ __('Simply create an account, setup your store and publish in minutes. Manage sales conveniently!') }}
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3 mb-lg-0">
                <div class="items_serv sevice_block">
                  <div class="icon--top">
                    <i class="icon ni ni-plus"></i>
                  </div>
                  <div class="txt">
                    <h4 class="c-black">{{ __('Post Your Products') }}</h4>
                    <p>
                      {{ __('Create items you want to showcase on your products and set your all-important products as much as you need.') }}
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="items_serv sevice_block">
                  <div class="icon--top">
                    <i class="icon ni ni-share"></i>
                  </div>
                  <div class="txt">
                    <h4 class="c-black">{{ __('Start Sharing') }}</h4>
                    <p>
                      {{ __('Share your store link on Instagram, Facebook, Tik Tok, LinkedIn, anywhere and boom, that’s it!') }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      @if(settings('package_trial.status') == 1)
        <!-- Try it -->
        <section class="simplecontact_section tryit_now add-background-img padding-py-6">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-7">
                <div class="title_sections mb-1 mb-lg-auto">
                  <h2 class="c-white">{{ __('Start Now for FREE!') }}</h2>
                  <p>
                    {{ __('We offer a FREE trial to get you started with the PRO features of our platform.') }}
                  </p>
                </div>
              </div>
              <div class="col-md-3 col-lg-5 my-auto ml-auto text-sm-right">
                <a href="{{ route('register') }}" 
                  class="btn mt-3 rounded-8 btn_md_primary c-white effect-letter scale bg-orange-red">
                  {{ __('Try it Now') }}
                </a>
              </div>
            </div>
          </div>
        </section>
        @endif

        <!-- Start Pricing -->
        <section class="pricing_section padding-t-12" id="Pricing">
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
            <div class="mb-5 d-none justify-content-center pricing-selector" hidden>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                 <label class="btn btn-outline-primary" data-payment-pricing="monthly">
                  <input type="radio" name="payment_frequency" data-payment-pricing="month" checked="">{{ __('Monthly') }}</label>
                 <label class="btn btn-outline-primary">
                  <input type="radio" name="payment_frequency" data-payment-pricing="quarter">{{ __('Quarterly') }}</label>
                 <label class="btn btn-outline-primary">
                  <input type="radio" name="payment_frequency" data-payment-pricing="annual">{{ __('Annually') }}</label>
                </div>
            </div>
            <div class="blocks_pricing" id="monthly">
              <div class="row justify-content-center">
                  @if(settings('package_free.status') == 1)
                    <div class="col-md-6 col-lg-4">
                      @include('includes.pricing', ['key' => settings('package_free')])
                    </div>
                  @endif
                  @if(settings('package_trial.status') == 1)
                    <div class="col-md-6 col-lg-4">
                      @include('includes.pricing', ['key' => settings('package_trial')])
                    </div>
                  @endif
                  @foreach ($packages as $key)
                    <div class="col-md-6 col-lg-4">
                      @include('includes.pricing', ['key' => $key])
                    </div>
                  @endforeach
              </div>
            </div>
          </div>
        </section>
        <!-- End Start Pricing -->

        <!-- Start Simple Contact -->
        <section class="simplecontact_section padding-py-12 mt-5">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-6 text-center">
                <div class="title_sections mb-0">
                  <h2>{{ __('Need help?') }}</h2>
                  <p>
                    {{ __('Fill the form at the bottom right corner
                    of this page to speak with us or you can use the email below') }}
                    <a class="c-blue" href="mailto:{{settings('email')}}">{{settings('email')}}</a>.
                  </p>
                  <a href="#contact" type="button" class="btn rounded-pill btn_md_primary c-white scale ripple bg-blue">
                    {{ __('Contact Us') }}
                  </a>
                </div>
              </div>
            </div>
            <!-- <div class="circle-ripple"></div> -->
            <div class="circle-ripple">
              <div class="ripple ripple-1"></div>
              <div class="ripple ripple-2"></div>
              <div class="ripple ripple-3"></div>
            </div>
          </div>
        </section>
        <!-- End Simple Contact -->
      </main>
      <!-- end main -->
    </div>
    <!-- [id] content -->
  @if (settings('contact'))
    <div class="default_footer dark padding-t-12 padding-b-10" id="contact">
      <div class="container">
        <img class="shape_overlay" src="{{ url('media/shape-lines.svg') }}">
        <div class="row">
          <div class="col-lg-5 margin-b-3">
            <div class="title_sections margin-b-2">
              <h2>{{ __('Contact us') }}</h2>
              <p class="c-white">
                {{ __('If you have any issue regarding our platform or you have questions regarding our packages or anything, kindly contact us, our team would be glad to help.') }}
              </p>
            </div>
            <div class="dashed-line margin-b-2"></div>
            <!-- Start Testimonial -->
            <div class="block_testimonial">
              <h3 class="c-white">{{ __('Faq') }}</h3>
              <p class="c-white">{{ __('Here are some of our faq to get started') }}</p>
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
                         <div class="form-group custom mt-3">
                             <label class="mb-3 ml-3">{{__('First Name')}}</label>
                             <input name="firstname" id="name" class="form-control" type="text">
                         </div>
                     </div>

                     <div class="col-lg-6">
                         <div class="form-group custom mt-3">
                             <label class="ml-3 mb-3">{{__('Last Name')}}</label>
                             <input name="name" id="lastname" class="form-control" type="text">
                         </div>
                     </div>
                 </div>

                 <div class="row">
                     <div class="col-lg-12">
                         <div class="form-group custom mt-3">
                             <label class="ml-3 mb-3">{{__('Email Address')}}</label>
                             <input name="email" id="email" class="form-control" required="" type="email">
                         </div>
                     </div>
                 </div>

                 <div class="row">
                     <div class="col-lg-12">
                         <div class="form-group custom mt-3">
                             <label class="ml-3 mb-3">{{__('Subject')}}</label>
                             <input name="subject" id="subject" class="form-control" type="text">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="form-group custom mt-3">
                             <label class="ml-3 mb-3"> {{__('Your Message')}} </label>
                             <textarea name="message" id="message" rows="5" class="form-control"></textarea>
                         </div>
                     </div>
                 </div>
                    <div class="col-12">
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
                    </div>
                    <div class="col-12">
                      <button class="btn mt-3 btn-primary btn-round btn-block">{{ __('Send Message') }}</button>
                    </div>
                </form>
              </div>
            </div>
            <!-- Forms -->
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
  <!-- End. wrapper -->
@stop