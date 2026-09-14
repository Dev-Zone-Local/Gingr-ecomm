@if($exception)
@extends('layouts.app')
  @section('title', __('Not Found'))
    @section('content')
    <link rel="stylesheet" href="{{ asset('css/smallPages.css') }}">
    <div class="middle-center">
        <div class="w-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mt-lg-5">
                         <h2 class="bold text-darker mt-5 fs-55px">{{ __('Oops! Why are you here?') }}</h2>
                         <p class="nk-error-text mt-4">{{ __('The page you were looking for has either been deleted or never existed.') }}</p>
                        <a href="{{ url('/') }}" class="btn btn_sm_primary bg-blue mt-2">{{ __('Back To Home') }}</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5 d-flex justify-content-center">
                             <img src="{{ url('media/misc/donut_PNG63.png') }}" class="error-404-img" alt="{{ env('APP_HOME') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@else
    @section('message', __('Not Found'))
@endif