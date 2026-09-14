@extends('layouts.app')
@section('title', __('Pages'))
@section('headJS')
<script src="{{ asset('js/Sortable.min.js') }}"></script>
@stop
@section('content')

<div class="nk-block-head mt-8">

  <div class="row justify-content-center text-center">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('All Pages') }} <span class="badge badge-dim badge-primary badge-pill">{{ count($pages) }}</span></h2>
        <a href="{{ route('user-add-pages') }}" class="btn scale btn_primary bg-blue c-white effect-letter rounded-8">{{ __('Create Page') }}</a>
      </div>
    </div>
  </div>
</div>


 <div class="flex-table mt-4 sortable-div" data-handle=".item-handle" data-route="{{ route('user-sort-pages') }}">

     <!--Table header-->
     <div class="flex-table-header">
         <span>{{ __('Customer') }}</span>
         <span>{{ __('Created On') }}</span>
         <span>{{ __('Sections') }}</span>
         <span>{{ __('Childs') }}</span>
         <span class="cell-end">{{ __('Actions') }}</span>
     </div>
    @foreach ($pages as $items)
     <div class="flex-table-item sortable-item" data-id="{{ $items->id }}">
         <div class="flex-table-cell is-media" data-th="">
             <a href="#" class="m-0 p-0 item-handle"><i class="tio drag"></i></a>
             <div class="ml-3">
                 <span class="item-name dark-inverted is-font-alt is-weight-600">{{ $items->name }}</span>
                 <span class="item-meta">
                    @if (!empty($items->slug))
                     <span><a href="{{ route('user-store-page', ['profile' => $user->username, 'page' => $items->slug]) }}" target="_blank">{{ $items->slug }}</a></span>
                     @else
                     <span>{{ __('Please add slug to this page') }}</span>
                    @endif
                 </span>
             </div>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Date') }}">
             <span class="light-text">{{ Carbon\Carbon::parse($items->created_at)->toFormattedDateString() }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Sections') }}">
             <span class="dark-inverted is-weight-600">{{ \App\Model\PagesSections::where('page_id', $items->id)->count() }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Childs') }}">
             <span class="dark-inverted is-weight-600">{{ count($items->childs) }}</span>
         </div>
         <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
             <a href="{{ route('user-edit-pages', $items->id) }}" class="btn bg-blue btn_sm_primary effect-letter c-white ml-auto mr-3">{{ __('Edit') }}</a>

             <form action="{{ route('user-delete-page') }}" method="post">
                 @csrf
                 <input type="hidden" value="{{ $items->id }}" name="page_id">
                 <button class="btn bg-danger btn_sm_primary effect-letter c-white ml-auto">{{ __('Delete') }}</button>
             </form>
         </div>
     </div>
    @endforeach
</div>

@endsection
