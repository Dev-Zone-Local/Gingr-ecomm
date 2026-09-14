@extends('admin.layouts.app')

@section('title', __('Packages'))
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title fw-normal">{{ __('Packages') }}</h2>
        </div>
    </div>
    <div class="col-md-6 d-flex align-center justify-content-md-end">
        <div class="nk-block-head-content">
        <a class="btn btn-primary mt-3 mt-md-0" href="{{ route('admin-add-package') }}">{{ __('Create package') }}</a></div>
        </div>
    </div>
</div>
<div class="nk-block-head-content mt-4">
    <div class="nk-block-head-sub"><span>{{ __('All packages') }}</span></div>
</div>


 <div class="flex-table mt-4">

     <!--Table header-->
     <div class="flex-table-header">
         <span>{{ __('Name') }}</span>
         <span>{{ __('Price') }}</span>
         <span>{{ __('Users on Plan') }}</span>
         <span>{{ __('Status') }}</span>
         <span>{{ __('Features on Plan') }}</span>
         <span class="cell-end">{{ __('Actions') }}</span>
     </div>

    @php 
        $free = settings('package_free');
        $planArray = settings('package_free.settings');
        $planActives = count(array_filter($planArray));
    @endphp
     <div class="flex-table-item">
         <div class="flex-table-cell is-media" data-th="">
             <div>
                 <span class="item-name dark-inverted is-font-alt is-weight-600">{{ settings('package_free.name') }}</span>
                 <span class="item-meta">
                         <span>{{ __('FREE') }}</span>
                 </span>
             </div>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Price') }}">
             <span class="light-text">{{ settings('package_free.price.annual') }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Users on Plan') }}">
             <span class="dark-inverted is-weight-600">{{$free_count ?? '0'}}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Status') }}">
             <span class="tag is-green is-rounded">{{ (settings('package_free.status') == 1) ? __('active') : __('Inactive') }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Features on Plan') }}">
             <a class="action-link is-pushed-mobile">{{$planActives}}</a>
         </div>
         <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
             <a class="bg-blue text-sticker c-white ml-auto" href="{{ route('admin-packages') .'/edit/'. settings('package_free.id') }}">{{ __('Edit') }}</a>
         </div>
     </div>

    @php
        $trial = settings('package_trial');
        $planArray = settings('package_trial.settings');
        $planActives = count(array_filter($planArray));
    @endphp
     <div class="flex-table-item">
         <div class="flex-table-cell is-media" data-th="">
             <div>
                 <span class="item-name dark-inverted is-font-alt is-weight-600">{{ settings('package_trial.name') }}</span>
                 <span class="item-meta">
                         <span>{{ settings('package_trial.expiry') }} {{ __('Days') }}</span>
                 </span>
             </div>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Price') }}">
             <span class="light-text">{{ settings('package_trial.price.annual') }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Users on Plan') }}">
             <span class="dark-inverted is-weight-600">{{$trial_count ?? '0'}}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Status') }}">
             <span class="tag is-green is-rounded">{{ (settings('package_trial.status') == 1) ? __('active') : __('Inactive') }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Features on Plan') }}">
             <a class="action-link is-pushed-mobile">{{$planActives}}</a>
         </div>
         <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
             <a class="bg-blue text-sticker c-white ml-auto" href="{{ route('admin-packages') .'/edit/'. settings('package_trial.id') }}">{{ __('Edit') }}</a>
         </div>
     </div>
     

    @foreach ($packages as $package)
        @php
            $planArray = (array) $package->settings;
            $planActives = count(array_filter($planArray));
        @endphp
     <div class="flex-table-item">
         <div class="flex-table-cell is-media" data-th="">
             <div>
                 <span class="item-name dark-inverted is-font-alt is-weight-600">{{ $package->name }}</span>
                 <span class="item-meta">
                         <span>{{ Carbon\Carbon::parse($package->created_at)->toFormattedDateString()}}</span>
                 </span>
             </div>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Price') }}">
             <span class="light-text">{{ $package->price->annual ?? '' }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Users on Plan') }}">
             <span class="dark-inverted is-weight-600">{{$package->total_package ?? '0'}}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Status') }}">
             <span class="tag is-green is-rounded">{{ ($package->status == 1) ? __('active') : __('Inactive') }}</span>
         </div>
         <div class="flex-table-cell" data-th="{{ __('Features on Plan') }}">
             <a class="action-link is-pushed-mobile">{{$planActives}}</a>
         </div>
         <div class="flex-table-cell cell-end" data-th="{{ __('Actions') }}">
             <a class="bg-blue text-sticker c-white ml-auto" href="{{ route('admin-packages') .'/edit/'. $package->id }}">{{ __('Edit') }}</a>
             <a class="bg-danger text-sticker c-white" href="#" data-toggle="modal" data-target="#delete-{{$package->id}}">{{ __('Delete') }}</a>
         </div>
     </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="delete-{{$package->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-lg">
                        <form action="{{ route('admin-delete-package') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{$package->id}}" name="package_id">
                             <h4 class="bold text-danger">{{ __('TYPE DELETE') }}</h4>
                             <p class="text-danger">{{ __('Note that all users under this plan will be moved to free plan') }}</p>
                             <div class="form-group mt-5">
                                 <input type="text" class="form-control form-control-lg" name="delete" placeholder="{{ __('DELETE') }}" autocomplete="off">
                             </div>
                            <div class="form-group mt-5">
                             <button type="submit" class="btn btn-dark btn-block">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
    @endforeach
</div>
@endsection
