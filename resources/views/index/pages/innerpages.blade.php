@extends('layouts.app')
  @section('title', $category->title)
    @section('content')
    <link href="{{ url('font/css/all.css') }}" rel="stylesheet">

        <!-- Start banner_about -->
        <section class="pt_banner_inner no-before banner_px_image blog-banner_without_image">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-6">
                <div class="banner_title_inner margin-b-3">
                  <h1 data-aos="fade-up" data-aos-delay="0">
                    {{ $category->title }}
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100">
                    {!! clean($category->description, 'titles') !!}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End banner_about -->

        <!-- Start blog_masonry -->
        <section class="blog_masonry three_column blog-banner_without_image">
          <div class="container">
            <div class="row">
              <div class="col-12">

                <div class="card-columns">
                  @foreach ($pages as $item)
                  @php
                    $item->settings = json_decode($item->settings);
                  @endphp
                  <div class="card">
                    @if (mediaExists('media/pages', $item->image))
                    <a href="{{$item->type == 'internal' ? url('page/' . $item->url) : $item->url}}" target="{{ $item->type == 'internal' ? '_self' : '_blank' }}" class="link_poet">
                      <div class="cover_link">
                        <img class="main_img" src="{{ getStorage('media/pages', $item->image) }}" class="card-img-top" alt="...">
                        <div class="auther_post">
                          <div class="media">
                            <div class="media-body my-auto">
                              <div class="txt">
                                <h4>{{ config('app.name') }}</h4>
                                <p>{{ Carbon\Carbon::parse($item->edited_on)->toFormattedDateString() }}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    @endif
                    <div class="card-body">
                      <div class="about_post">
                        <span class="c_ategory">
                          <a href="#Design">{{ $item->pages_categories_name }}</a>
                        </span>
                      </div>
                      <a href="{{$item->type == 'internal' ? url('page/' . $item->url) : $item->url}}" target="{{ $item->type == 'internal' ? '_self' : '_blank' }}" class="d-block">
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text">{!! clean((!empty($item->settings->sh_description) ? $item->settings->sh_description : ""), 'titles') !!}
                        </p>


                        <span class="mt-4">{{$item->total_views}} {{ __('views') }}</span>
                      </a>
                    </div>
                  </div>
                  @endforeach

                </div>

              </div>
            </div>
          </div>
        </section>
        <!-- End. blog_masonry -->
@stop