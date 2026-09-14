@extends('layouts.app')
  @section('title', ucfirst($page->title))
    @section('content')

        <!-- Start Banner Section -->
        <section class="pt_banner_inner banner_Sblog_default bg-white">
          <div class="container">
            <div class="row justify-content-center text-center">
              <div class="col-md-8 col-lg-7 my-auto">
                <div class="banner_title_inner margin-b-8">
                  <h1>
                    {{($page->title)}}
                  </h1>
                </div>
                <p>{!! clean((!empty($page->settings->sh_description) ? $page->settings->sh_description : ""), 'titles') !!}</p>

              </div>
            </div>

          @if (mediaExists('media/pages', $page->image))
            <div class="row">
              <div class="col-lg-12">
                <div class="cover_Sblog">
                  <img class="cover-parallax" src="{{ getStorage('media/pages', $page->image) }}" alt="">
                </div>
              </div>
            </div>
            @endif


          </div>
        </section>
        <!-- End Banner -->

        <section class="content-Sblog mt-0 pt-5 bg-white pb-5" data-sticky-container>
          <div class="container">
            <div class="row">
              <div class="col-lg-3">
                <div class="fixSide_scroll" data-sticky-for="1023" data-margin-top="100">
                  <div class="item">
                    <div class="profile_user">
                      <div class="txt">
                        <h4>
                          {{ config('app.name') }}
                        </h4>
                        <time>{{ Carbon\Carbon::parse($page->edited_on)->toFormattedDateString() }}</time>
                      </div>
                      <a href="#" class="btn btn_profile c-white sweep_top sweep_letter rounded-pill bg-lightgreen">
                        <div class="inside_item">
                          <span data-hover="{{ __('Home') }}">{{ __('Home') }}</span>
                          <span></span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="body_content">
                  {!! clean((!empty($page->settings->content) ? $page->settings->content : ""), 'titles') !!}
                </div>
              </div>
            </div>
          </div>
        </section>
@stop