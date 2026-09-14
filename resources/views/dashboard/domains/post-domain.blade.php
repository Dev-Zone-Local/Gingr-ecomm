@extends('layouts.app')

@section('title', __('Create domain'))
@section('content')
  <div class="row justify-content-center text-center mt-8">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Custom Domain') }}</h2>
      </div>
    </div>
  </div>

<div class="card card-shadow border-0 radius-7 p-4">
    <div class="card-body">
        <form action="{{ route('user-domains-post') }}" method="post" role="form">
           @csrf
           @if (!empty(request()->get('id')))
             <input type="hidden" name="domain_id" value="{{request()->get('id')}}">
           @endif
           <input type="hidden" value="{{ $user->id }}" name="user">

           <div class="card-header border-0 mb-5 radius-5">
              <p class="text-muted m-0">{{ __('Make sure your domain or subdomain has a CNAME record pointing to') }} <b>{{ parse_url(url(env('APP_URL')))['host'] ?? '' }}</b>.</p>
           </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <h6 class="mb-3">{{ __('Domain / Subdomain') }}</h6>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select name="scheme" class="custom-select input-group-text">
                                <option value="https://" {{ !empty($domain) && $domain->scheme == 'https://' ? 'selected' : '' }}>{{ __('https://') }}</option>
                                <option value="http://" {{ !empty($domain) && $domain->scheme == 'http://' ? 'selected' : '' }}>{{ __('http://') }}</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="host" placeholder="domain.com" value="{{ $domain->host ?? '' }}" required="required">
                    </div>
                    <p class="text-muted fs-13px mt-2">{!! __('Only <code>subdomain.domain.com</code> and <code>domain.com</code> formats are allowed (subdomains or root domains).') !!}</p>
                </div>
              </div>
              <div class="col-md-6 mt-4 mt-lg-0 form-group">
               <h6 class="mb-3">{{ __('Status') }}</h6>
               <select name="status" class="custom-select input-group-text">
                   <option value="1" {{ !empty($domain) && $domain->status == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                   <option value="0" {{ !empty($domain) && $domain->status == 0 ? 'selected' : '' }}>{{ __('In active') }}</option>
               </select>
              </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="submit" class="btn btn_sm_primary bg-blue effect-letter c-white">{{ !empty($domain) ? __('Edit domain') : __('Add Domain') }}</button>
            </div>
        </form>

    </div>
</div>

@endsection
