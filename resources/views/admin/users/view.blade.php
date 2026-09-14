@extends('admin.layouts.app')
@section('footerJS')
  <script>
        var totalSales = {
            labels: {!! $options->sales_chart['labels'] ?? '[]' !!},
            dataUnit: "{{__('Sold')}}",
            lineTension: .3,
            datasets: [{
                label: "{{__('Sales')}}",
                color: "#9d72ff",
                background: NioApp.hexRGB("#9d72ff", .25),
                data: {!! $options->sales_chart['sales'] ?? '[]' !!}
            }]
        };


   var storeVisitors = {
         labels: {!! $options->this_month_chart['labels'] ?? '[]' !!},
         dataUnit: "{{ __('Visitors') }}",
         lineTension: .4,
         legend: !0,
       datasets:[{
        label: "{{ __('Impression') }}",
        color:"#c4cefe",
        dash:[5],
        background:"transparent",
        data:{!! $options->this_month_chart['impression'] ?? '[]' !!}},{
        label: "{{ __('Unique') }}",
        color:"#798bff",
        dash:0,
        background:NioApp.hexRGB("#798bff",.15),
        data:{!! $options->this_month_chart['unique'] ?? '[]' !!}}]
     };
 </script>
 <script src="{{ url('js/support-messages.js') }}"></script>
 <script src="{{ url('tinymce/tinymce.min.js') }}"></script>
 <script src="{{ url('tinymce/sr.js') }}"></script>
@stop
@section('title', __('User'))
@section('content')
<div class="row">
  <div class="col-md-5">
       <div class="bg-white mb-5 p-4">
        <div class="col-12">
          <div class="card-header mb-3 border-0 d-flex align-items-center bg-light">
           <img class="avatar is-squared h-40px ob-cover mr-3" src="{{ avatar($user->id) }}" alt="">
           <h4 class="fs-15px">{{ full_name($user->id) }}</h4>
          </div>
          @if ($user->id !== auth()->user()->id)
            <form action="{{ route('admin-login-user') }}" method="post">
              @csrf
              <input type="hidden" value="{{ $user->id }}" name="id">
              <button class="text-sticker mb-3 btn card-shadow">
                  <span>{{ __('Login as this user') }}</span>
              </button>
            </form>
          @endif
            <a href="{{ route('user-profile', ['profile' => $user->username]) }}" target="_blank" class="text-sticker p-2">{{ __('View store') }}</a>
        </div>
    <form action="{{ route('admin-view-user-post', $user->id) }}" method="post" class="row">
      @csrf
         <div class="col-md-6 mb-3">
           <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Status') }}</span>
                <small class="d-block mt-2">{{ __('Set this user as active or ban') }}</small>
              </label>
              <div class="form-control-wrap">
                 <select class="form-select custom-select" data-search="off" data-ui="lg" name="active">
                    <option value="1" {{ ($user->active == 1) ? "selected" : "" }}> {{ __('Active') }}</option>
                    <option value="0" {{ ($user->active == 0) ? "selected" : "" }}> {{ __('Banned') }}</option>
                </select>
           </div>
         </div>
       </div>
         <div class="col-md-6">
           <div class="form-group mt-5 custom">

              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Change package') }}</span>
                <small class="d-block mt-2">{{ __('Change user package') }}</small>
              </label>
             <div class="form-control-wrap">
                <select class="form-select custom-select" data-search="on" data-ui="lg" name="package">
                <option value="{{settings('package_free.id')}}" {{($user->package == 'free') ? "selected" : ""}}>{{settings('package_free.name')}}</option>
                 @foreach (\App\Model\Packages::where('status', 1)->orWhere('status', 2)->get() as $item)
                   <option value="{{$item->id}}" {{($user->package !== 'free') ? ($user->package == $item->id) ? "selected" : "" : ""}}>{{$item->name}}</option>
                 @endforeach
               </select>
             </div>
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group mt-1">
            <label class="form-label"><span>{{ __('Change Due (yyyy-mm-dd hh:mm)') }}</span></label>
             <div class="form-control-wrap">
               <input type="text" value="{{ $user->package_due }}" class="form-control form-control-lg" id="datepicker" name="package_due">
             </div>
             <p>{{ __('Leave for unchanged') }}</p>
           </div>
         </div>
         <div class="col-12 mt-5">
          <button class="btn bg-blue">{{ __('Save') }}</button>
        </div>
    </form>
       </div>
  </div>

  <div class="col-md-7">
    <div class="bg-white">
      <div class="card p-4 card-shadow border-0 radius-5">
         <div class="title mb-3">
           <p class="m-0 fs-15px">{{ __('Revenue') }}</p>
         </div>
        <div class="h-250px">
           <canvas class="line-chart" id="totalSales"></canvas>
        </div>
      </div>
    </div>

    <div class="bg-white mt-3">
     <div class="card p-4 border-0 radius-5 mt-5">
         <div class="title mb-3">
           <p class="m-0 fs-15px">{{ __('Visitors') }}</p>
         </div>
        <div class="line-stats mb-4">
             <div class="line-stat">
                 <span>{{ __('This Month') }}</span>
                 <span class="current">{{ __('Visits') }} - {{ nr($options->month['impression'] ?? '0') }} <span class="fs-15px">{{ __('Unique') }} - {{ nr($options->month['unique'] ?? '0') }}</span></span>
             </div>
             <div class="line-stat">
                 <span>{{ __('This Year') }}</span>
                 <span class="dark-inverted">{{ __('Visits') }} - {{ nr($options->year['impression'] ?? '0') }} <span class="fs-15px">{{ __('Unique') }} - {{ nr($options->year['unique'] ?? '0') }}</span></span>
             </div>
         </div>
        <div class="h-250px">
           <canvas class="line-chart" id="storeVisitors"></canvas>
        </div>
      </div>
    </div>

    <div class="title my-5">
      <p class="m-0 fs-15px">{{ __('Plan History') }}</p>
    </div>
    <div class="bg-white mt-3">
       <div class="flex-table mt-4">

           <!--Table header-->
           <div class="flex-table-header">
               <span>{{ __('Name') }}</span>
               <span>{{ __('Email') }}</span>
               <span>{{ __('Price') }}</span>
               <span>{{ __('Package | Duration') }}</span>
               <span>{{ __('Date') }}</span>
           </div>
            @foreach ($options->payments as $item)
             <div class="flex-table-item">
                 <div class="flex-table-cell is-media" data-th="">
                    <span class="light-text">{{ $item->name }}</span>
                 </div>
                 <div class="flex-table-cell" data-th="{{ __('Email') }}">
                     <span class="light-text">{{$item->email}}</span>
                 </div>
                 <div class="flex-table-cell" data-th="{{ __('Price') }}">
                     <span class="dark-inverted is-weight-600">{{ $item->price }}</span>
                 </div>
                 <div class="flex-table-cell" data-th="{{ __('Package | Duration') }}">
                     <span class="tag is-green is-rounded">{{ucfirst($item->package_name)}} | {{ucfirst($item->duration)}}</span>
                 </div>
                 <div class="flex-table-cell" data-th="{{ __('Date') }}">
                     <a class="action-link is-pushed-mobile">{{ Carbon\Carbon::parse($item->date)->toFormattedDateString() }}</a>
                 </div>
             </div>
           @endforeach

         </div>

         <div class="card">
            <div class="card-inner">
               <div class="nk-block-between-md g-3">
                  <div class="g">
                     {{$options->payments->withQueryString()->links()}}
                  </div>
               </div>
            </div>
         </div>
    </div>
  </div>
</div>


@stop
