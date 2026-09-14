@extends('layouts.app')
@section('title', __('New Customer'))
@section('content')

<div class="nk-block-head mt-8">

  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('New Customer') }}</h2>
      </div>
    </div>
  </div>
</div>
<div class="nk-block col-md-8 mx-auto">
    <form method="post" action="{{ route('user-add-customer-post') }}" class="card card-shadow radius-10 p-4 border-0 row flex-row">
    	@csrf
    	<div class="form-group col-md-6">
    		<label class="muted-deep fw-normal m-2">{{ __('Email') }}</label>
    		<input type="text" class="form-control" name="customer_email" value="{{ old('customer_email') }}">
    	</div>
    	<div class="form-group col-md-6">
    		<label for="" class="muted-deep fw-normal m-2">{{ __('Name') }}</label>
    		<input type="text" class="form-control" name="customer_name" value="{{ old('customer_name') }}">
    	</div>
      <div class="col-12">
         <button class="btn bg-blue btn_sm_primary effect-letter">{{ __('Create') }}</button>
      </div>
    </form>
</div><!-- .nk-block -->
@endsection
