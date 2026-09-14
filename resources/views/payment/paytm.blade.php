@extends('layouts.app')
@section('title', __('Paytm'))
@section('content')

  <div class="container mt-8">
    <div class="col-sm-8 mx-auto">
      <div class="card card-shadow card-inner border-0 p-4 radius-5">
      <form action="{{ route('paytm-create', ['plan' => $plan, 'duration' => $duration]) }}" method="get">
      	<input type="hidden" value="true" name="proceed">
         <h4 class="bold">{{ __('Enter phone number') }}</h4>
         <p class="m-0">{!! __('Please enter your phone number to proceed') !!}</p>
         <div class="form-group mt-5">
             <input type="text" class="form-control form-control-lg"  name="phone">
         </div>
        <div class="form-group mt-5">
         <button type="submit" class="btn bg-blue effect-letter btn_sm_primary">{{ __('Submit') }}</button>
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection
