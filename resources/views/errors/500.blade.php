@if($exception)
@extends('layouts.app')
  @section('title', __('Server Error'))
    @section('content')
    <link rel="stylesheet" href="{{ asset('css/smallPages.css?=1') }}">
    <div class="middle-center">
        <div class="w-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 margin-top">
                         <h2 class="bold text-darker mt-lg-9 mt-5 fs-55px">{{ __('500 | Server error') }}</h2>
                         <p class="nk-error-text">{{ __("You've encountered an error while processing your request. Please try again or send us an email with specifying this error.") }}</p>

                        <div class="card p-3 mb-4">
                            <div class="card-header border-0 p-3"></div>
                            <pre>{!! $exception->getMessage() !!}</pre>
                        </div>

                        <a href="mailto:{{ settings('email') }}" class="btn btn_sm_primary bg-blue mt-2">{{ __('Send an email') }}</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5 d-flex justify-content-center">
                             <img src="{{ url('media/kingdom-fatal-error.png') }}" alt="{{ env('APP_HOME') }}" class="error-404-img">
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