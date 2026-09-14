@extends('layouts.app')
@section('title', __('Welcome'))
@section('content')

<style>
    footer, #overallHeader, .clov-sidebar{
        display: none;
    }
    #wrapper{
        padding: 0 !important;
    }
</style>


<div class="standard-onboarding mt-8">
   <div class="title-wrap">
      <p>{{ __("Looks like you're new here") }}</p>
      <h2>{{ __('Let’s help you get started') }}</h2>
   </div>
   <div class="onboarding-wrap">
      <div class="onboarding-wrap-inner">
         <!--Card-->
         <div class="onboarding-card border-0 card-shadow">
            <img class="light-image mb-4" src="{{ url('media/misc/pixeltrue-icons-seo-business-location-3.png') }}" alt="">
            <div class="card-header border-0 bg-light mb-3">
                <h3 class="m-0">{{ __('Store Setup') }}</h3>
            </div>
            <p>{{ __('Give your new store a name and upload your logo for your customers to recognize you.') }}</p>
            <div class="button-wrap">
               <a href="{{ route('user-settings') }}" class="btn effect-letter bg-blue btn_sm_primary c-white">{{ __('Start Setup') }}</a>
            </div>
         </div>
         <div class="onboarding-card border-0 card-shadow">
            <img class="light-image mb-4" src="{{ url('media/misc/pixeltrue-icons-receipt.png') }}" alt="">
            <div class="card-header border-0 bg-light mb-3">
                <h3 class="m-0">{{ __('Create Product') }}</h3>
            </div>
            <p>{{ __('Create your first product, add your pricing and post it to your store and start selling!') }}</p>
            <div class="button-wrap">
               <a href="{{ route('user-add-product') }}" class="btn effect-letter bg-blue btn_sm_primary c-white">{{ __('Add Product') }}</a>
            </div>
         </div>
         <div class="onboarding-card border-0 card-shadow">
            <img class="light-image mb-4" src="{{ url('media/misc/pixeltrue-icons-seo-optimize-3.png') }}" alt="">
            <div class="card-header border-0 bg-light mb-3">
                <h3 class="m-0">{{ __('Create Pages') }}</h3>
            </div>
            <p>{{ __("With our platform you can create multiple pages with varieties of blocks.") }}</p>
            <div class="button-wrap">
               <a href="{{ route('user-pages') }}" class="btn effect-letter bg-blue btn_sm_primary c-white">{{ __('Create Pages') }}</a>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection
