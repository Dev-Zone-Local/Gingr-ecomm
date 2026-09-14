@extends('layouts.app')
@section('title', __('Bank Transfer'))
@section('footerJS')
	<script src="{{ url('js/others.js') }}"></script>
@stop

@section('content')
<div class="container mt-7">
	<div class="radius-7 border-0 card card-shadow p-3">
	    <div class="card-header border-0 mb-2">
	        <h5 class="m-0">{{ __("Bank Transfer") }}</h5>
	    </div>
	    <p class="ml-2 mt-4">{{ config('app.bank_details') }}</p>
	    <hr>
	    <p>{{ __("If paid please fill out this form") }}</p>
	    <form action="{{ route('bank-post', ['duration' => $duration, 'plan' => $plan->slug]) }}" method="post" enctype="multipart/form-data">
	    @csrf
	    <div class="px-3 pt-0">
	        <div class="row">
	            <div class="col-md-6">
	              <div class="form-group mt-5 mt-lg-5">
	                <label class="form-label"><span>{{ __('Email') }}</span></label>
	                <div class="form-control-wrap">
	                    <input type="text" value="{{ $user->email }}" class="form-control form-control-lg c-input" placeholder="{{ __('Your email') }}" name="email">
	                </div>
	              </div>
	              <div class="form-group mt-5 mt-lg-5">
	                <label class="form-label"><span>{{ __('Name') }}</span></label>
	                <div class="form-control-wrap">
	                    <input type="text" value="{{ user('name.first_name') }}" class="form-control form-control-lg c-input" placeholder="Your name" name="name">
	                </div>
	              </div>
	              <div class="form-group mt-5 mt-lg-5">
	                <label class="form-label"><span>{{ __('Bank name') }}</span></label>
	                <div class="form-control-wrap">
	                    <input type="text" class="form-control form-control-lg c-input" placeholder="{{ __('enter bank name used to transfer') }}" name="bank_name">
	                </div>
	              </div>
	            </div>
	            <div class="col-md-6">
	            <div class="form-group mt-5">
                           <div class="card border-0 shadow-none custom-input-uploader">
                               <div class="card-body p-0">
                                   <div class="file-upload">
                                       <input class="file-input uploader_input" name="proof" type="file">
                                       <img src="{{ url('media/misc/upload-image-placeholder.svg') }}" class="mb-3 h-73px" alt="">
                                       <div class="card-subtitle">{{ __('Drag n Drop your payment proof') }}</div>     

                                        <div class="list-files w-100 mt-4">
                                        </div>
                                   </div>
                               </div>
                           </div>
	              </div>
	            </div>

	            <button class="btn bg-blue btn_sm_primary c-white mt-5">{{ __('Submit') }}</button>
	        </div>
	    </div>
	 </form>
	</div>
  @if (count($pending) > 0)
 <div class="flex-table mt-6">
   <!--Table header-->
   <div class="flex-table-header">
     <span>{{ __('Proof') }}</span>
     <span>{{ __('Status') }}</span>
     <span>{{ __('Date') }}</span>
     <span class="cell-end">{{ __('Actions') }}</span>
   </div>
   @foreach ($pending as $item)
     <div class="flex-table-item">
         <div class="flex-table-cell is-media" data-th="">
             <div class="h-avatar is-medium">
                 <a href="{{ url('media/user/bankProof/'.$item->proof) }}">{{Str::limit($start = $item->proof,  $limit = 10, $end = '...')}}</a>
             </div>
             <div>
                 <span class="item-name dark-inverted fs-11px">{{ucfirst($item->name)}} | {{ucfirst($item->bankName)}}</span>
             </div>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Status') }}">
             <span class="text-sticker c-white {{$item->status == 0 ? ' bg-warning' : NULL }} {{$item->status == 1 ? ' bg-success' : NULL }} {{$item->status == 2 ? ' bg-danger' : NULL }}">{{$item->status == 0 ? 'Pending' : NULL}} {{$item->status == 1 ? 'Activated' : NULL }} {{$item->status == 2 ? 'Declined' : NULL }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Date') }}">
             <span class="light-text fs-11px">{{ Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }}</span>
         </div>
         <div class="flex-table-cell cell-end" data-th="">
          <div class="d-flex">
            <form action="{{ route('bank-delete', ['id' => $item->id]) }}" method="post">
              @csrf
              <button class="text-sticker border-0 bg-danger c-white fs-15px" title="" data-confirm="{{ __('Are you sure you want to delete this?') }}"><em class="icon tio add_to_trash"></em></button>
            </form>
          </div>
         </div>
     </div>
      @endforeach
   </div>
  @endif
@endsection
