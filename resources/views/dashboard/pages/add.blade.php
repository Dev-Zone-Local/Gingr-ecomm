@extends('layouts.app')
@section('title', __('Create Page'))
@section('content')

<div class="nk-block-head mt-8">

  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Create Page') }}</h2>
      </div>
    </div>
  </div>
</div>


<form action="{{ route('user-add-pages-post') }}" method="post">
	@csrf
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
		        <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
		          <span>{{ __('Name') }}</span>
		          <small class="d-block mt-2">{{ __('Please enter name of page. Ex: HomePage') }}</small>
		        </label>
				<input type="text" name="name" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
		        <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
		          <span>{{ __('Page slug') }}</span>
		          <small class="d-block mt-2">{{ __('Ex:homepage') }}</small>
		        </label>
				<input type="text" name="slug" class="form-control">
			</div>
		</div>
	</div>


	<button class="btn btn_sm_primary bg-blue effect-letter c-white">{{ __('Save') }}</button>


</form>

@endsection
