@extends('layouts.app')
@section('title', __('Login activities'))
@section('content')


  <div class="row justify-content-center text-center mt-8">
    <div class="col-lg-5">
      <div class="title_sections_inner margin-b-5">
        <h2>{{ __('Login activities') }}</h2>
        <p class="nk-block-title title m-0">{{ __('Activity on your account') }}</p>
        <form action="{{ route('user-activities') }}" method="post">
             @csrf
             <button type="submit" class="btn bg-danger fs-12px">{{ __('Clear all') }}</button>
        </form>
      </div>
    </div>
  </div>
<div class="nk-block col-md-8 mx-auto">
    <div class="card card-shadow p-3 radius-10 border-0 card-inner">
        <table class="table table-ulogs">
            <thead>
                <tr>
                    <th class="tb-col-os"><span class="overline-title">{{ __('Activity') }}</span></th>
                    <th class="tb-col-ip"><span class="overline-title">{{ __('Ip') }}</span></th>
                    <th class="tb-col-time"><span class="overline-title">{{ __('Browser') }}</span></th>
                    <th class="tb-col-time"><span class="overline-title">{{ __('Os') }}</span></th>
                    <th class="tb-col-time"><span class="overline-title">{{ __('Date') }}</span></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($activities as $activity)
                <tr>
                    <td class="tb-col-os">{{ $activity->what }}</td>
                    <td class="tb-col-ip"><span class="sub-text">{{ $activity->ip }}</span></td>
                    <td class="tb-col-time"><span class="sub-text">{{ $activity->browser }}</span></td>
                    <td class="tb-col-time"><span class="sub-text">{{ $activity->os }}</span></td>
                    <td class="tb-col-time"><span class="sub-text">{{ Carbon\Carbon::parse($activity->date)->toDateString() }}</span></td>
                </tr>
              @endforeach
            </tbody>
        </table>
        {{ $activities->withQueryString()->links() }}
    </div><!-- .card -->
</div><!-- .nk-block -->
@endsection
