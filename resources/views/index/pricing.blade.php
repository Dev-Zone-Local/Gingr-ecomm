@extends('layouts.app')
  @section('title', __('Pricing'))
    @section('content')
      <section class="pt_banner_inner banner_bg_pricing">
          <div class="container">
            <div class="row justify-content-center text-center">
              <div class="col-md-10 col-lg-6">
                <div class="banner_title_inner margin-b-3">
                  <h1 data-aos="fade-up" data-aos-delay="0" class="aos-init aos-animate">
                    {{ __('Choose the best plan for your business') }}
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate">
                    {{ __('Check out our simple subscription') }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        @include('includes.pricing', ['packages' => $packages])
@stop