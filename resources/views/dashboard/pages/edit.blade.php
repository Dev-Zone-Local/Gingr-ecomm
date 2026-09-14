@extends('layouts.app')
@section('title', __('Edit Page'))
@section('headJS')
<script src="{{ asset('js/Sortable.min.js') }}"></script>
@stop
@section('footerJS')
  <script src="{{ url('tinymce/tinymce.min.js') }}"></script>
  <script src="{{ url('tinymce/sr.js') }}"></script>
	<script src="{{ url('js/others.js') }}"></script>
@stop
@section('content')

<div class="nk-block-head mt-8">

  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Edit Page') }}</h2>
        <p>{{ __('Manage page layouts and sections') }}</p>
      </div>
    </div>
  </div>
</div>


<form action="{{ route('user-edit-pages-post') }}" method="post">
	@csrf
	<input type="hidden" value="{{ $page->id }}" name="id">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
		        <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
		          <span>{{ __('Name') }}</span>
		          <small class="d-block mt-2">{{ __('Please enter name of page. Ex: HomePage') }}</small>
		        </label>
				<input type="text" name="name" value="{{ $page->name }}" class="form-control">
			</div>
             <div class="form-group">
             <label class="muted-deep fw-normal form-label muted-deep fw-normal ml-2"><span>{{ __('Set page as Home') }}</span></label>
               <select class="form-control custom-select" name="set_as_home">
			        <option value="1" {{ $page->is_home == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
			        <option value="0" {{ $page->is_home == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
               </select>
             </div>
             @if (count($page->childs) > 0)
             	<div class="card card-shadow border-0 p-3 mb-4">
             		<div class="card-header mb-3 border-0">
             			<h5 class="m-0">{{ __('Children pages') }}</h5>
             		</div>
             		<div class="d-flex flex-wrap">
	             		@foreach ($page->childs as $item)
	             			<a class="text-sticker mb-3" href="{{ route('user-edit-pages', $item->id) }}">{{ $item->name }} </a>
	             		@endforeach
             		</div>
             	</div>
             @endif
		</div>
		<div class="col-md-6">
			<div class="form-group">
		        <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
		          <span>{{ __('Page slug') }}</span>
		          <small class="d-block mt-2">{{ __('Ex:homepage') }}</small>
		        </label>
				<input type="text" name="slug" value="{{ $page->slug }}" class="form-control">
			</div>
		    <div class="form-group">
             <label class="muted-deep fw-normal form-label muted-deep fw-normal ml-2"><span>{{ __('Parent') }}</span></label>
               <select class="form-control custom-select" name="parent">
			        <option value="none">{{ __('None') }}</option>
			        @foreach ($pages as $item)
			       	 <option value="{{ $item->id }}" {{ $item->id == $page->parent ? 'selected' : '' }}>{{ $item->name }}</option>
			        @endforeach
               </select>
             </div>
		</div>
	</div>
	<button class="btn btn_sm_primary bg-blue effect-letter c-white">{{ __('Save') }}</button>
</form>


    <div class="flex-table mt-5 sortable-div" data-handle=".item-handle" data-route="{{ route('user-sort-pages-sections') }}">
        <!--Table header-->
        <div class="flex-table-header">
            <span>{{ __('Name') }}</span>
            <span>{{ __('Theme') }}</span>
            <span class="cell-end">Actions</span>
        </div>
       @foreach ($sections as $items)
        <!--Table item-->
        <div class="flex-table-item sortable-item" data-id="{{ $items->id }}">
            <div class="flex-table-cell" data-th="Amount">
                <span class="dark-inverted is-weight-600">
                	<a href="#" class="item-handle"><i class="tio drag"></i></a> 
                	<span class="light-text ml-4">{{ get_single_theme_blocks($items->block_slug, $user->id)['name'] ?? '' }}</span>
                </span>
            </div>
            <div class="flex-table-cell" data-th="Amount">
                <span class="dark-inverted is-weight-600">{{ Theme::get($items->theme)['title'] ?? '' }}</span>
            </div>


            <div class="flex-table-cell cell-end">
	            <button class="btn" data-toggle="modal" data-target="#section_edit_{{$items->id}}"><span class="fs-12px text-muted mr-1">{{ __('Edit') }}</span> <i class="tio edit text-muted"></i></button>

				<form action="{{ route('user-post-pages-sections', 'delete') }}" method="post" enctype="multipart/form-data">
				 @csrf
				 <input type="hidden" name="section_id" value="{{ $items->id }}">
	           	 <button class="btn"><span class="fs-12px text-muted">{{ __('Delete') }}</span> <i class="tio add_to_trash text-muted"></i></button>
	        	</form>

	        	<form action="{{ route('user-post-pages-sections', 'set-status') }}" method="post" class="on-change-ajax-send" data-route="{{ route('user-post-pages-sections', 'set-status') }}">
	        		<input type="hidden" value="{{ $items->id }}" name="section_id">
		            <div class="toggle_switch">
		              <div class="toggle">
		                <input type="hidden" name="status" value="0" />
		                <input type="checkbox" name="status" value="1" {{ $items->status == 1 ? 'checked' : '' }} class="check" />
		                <b class="b switch"></b>
		              </div>
		            </div>
	        	</form>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="section_edit_{{$items->id}}" aria-hidden="true">
			      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			          <div class="modal-content">
			              <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
			              <div class="modal-body modal-body-lg">
			                  <form action="{{ route('user-post-pages-sections', 'edit') }}" method="post" enctype="multipart/form-data">
			                      @csrf
			                      @if (!empty($dynamic_sections[$items->block_slug]))

				                      <input type="hidden" name="section_id" value="{{ $items->id }}">
				                      <input type="hidden" name="page_id" value="{{ $page->id }}">


				                      <h5 class="text-muted">{{ $dynamic_sections[$items->block_slug]['name'] }}</h5>

				                      @if (!empty($dynamic_sections[$items->block_slug]))
				                      	  {!! get_blocks_inputs_html($dynamic_sections[$items->block_slug]['inputs'], 'edit', $items->data) !!}
				                      @endif

				                      <div class="form-group mt-5">
				                       <button type="submit" class="btn bg-blue effect-letter btn_sm_primary text-center">{{ __('Submit') }}</button>
				                      </div>
				                      @else

				                      <h4>{{ __('Invalid Or Removed Block') }}</h4>
			                      @endif

			                  </form>
			              </div><!-- .modal-body -->
			          </div><!-- .modal-content -->
			      </div><!-- .modal-dialog -->
		</div>
        @endforeach
    </div>


<div class="bg-white p-3 mt-4">
	<div class="card-header border-0 mb-4">
		<h4 class="m-0">{{ __('Sections') }}</h4>
	</div>
		<div class="row">
			@foreach ($dynamic_sections as $key => $value)
				@if ($value['type'] == 'divider')
					<div class="col-12 p-3">
						<div class="card card-header border-0">
							<h3 class="m-0 fs-20px text-muted">{{ $value['name'] ?? '' }}</h3>
						</div>
					</div>
				@endif
				@if ($value['type'] == 'normal')

                 <div class="col-md-3 my-2">
                  <label class="awe-block-item blocks border-0">
                  	<img src="{{ url('media/block-icons/' . $value['icon'] ?? '') }}" alt="" class="icon">

                    <a href="#" data-toggle="modal" data-target="#section__{{$key}}" class="play-button">
                      <i class="tio add_circle_outlined fs-18px"></i>
                    </a>

                     <div class="overlay-layer">
                            <div class="overlay-content">
                                <div class="inner-content">
                                    <h3 class="media-title">{{ $value['name'] }}</h3>
                                    <div class="media-meta">
                                        <img src=" " class="d-none" alt="">
                                        <a class="meta-item is-hoverable text-muted">{{ $value['subtitle'] ?? '' }}  </a>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </label>
                  </div>

			  <div class="modal fade" tabindex="-1" role="dialog" id="section__{{$key}}" aria-hidden="true">
			      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			          <div class="modal-content">
			              <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
			              <div class="modal-body modal-body-lg">
			                  <form action="{{ route('user-post-pages-sections', 'new') }}" method="post" enctype="multipart/form-data">
			                      @csrf

			                      <input type="hidden" name="section_slug" value="{{ $key }}">
			                      <input type="hidden" name="page_id" value="{{ $page->id }}">


			                      <h5 class="text-muted">{{ $value['name'] }}</h5>

			                      @if (!empty($value['inputs']))
			                      	  {!! get_blocks_inputs_html($value['inputs'], 'new') !!}
			                      @endif

			                      <div class="form-group mt-5">
			                       <button type="submit" class="btn bg-blue effect-letter btn_sm_primary text-center">{{ __('Submit') }}</button>
			                      </div>
			                  </form>
			              </div><!-- .modal-body -->
			          </div><!-- .modal-content -->
			      </div><!-- .modal-dialog -->
			  </div>
			 @endif
			@endforeach
		</div>
</div>

@endsection
