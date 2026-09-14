@extends('layouts.app')
@section('title', __('Chats'))
@section('content')

<style>
    footer, #OverallHeader{
        display: none;
    }
</style>
      <!-- Start header -->
      <header class="header-nav-center active-blue" id="myNavbar">
        <div class="container">
          <!-- navbar -->
          <nav class="navbar navbar-expand-lg navbar-light px-sm-0 justify-content-center">
              <button class="navbar-toggler menu ripplemenu toggle-chat-sidebar" type="button">
                <i class="tio chat"></i>
              </button>

              <button class="navbar-toggler menu ripplemenu toggle-sidebar ml-auto" type="button">
                <svg viewBox="0 0 64 48">
                  <path d="M19,15 L45,15 C70,15 58,-2 49.0177126,7 L19,37"></path>
                  <path d="M19,24 L45,24 C61.2371586,24 57,49 41,33 L32,24"></path>
                  <path d="M45,33 L19,33 C-8,33 6,-2 22,14 L45,37"></path>
                </svg>
              </button>
          </nav>
          <!-- End Navbar -->
        </div>
        <!-- end container -->
      </header>
      <!-- End header -->

<div class="is-messages-overlay overlay-sidebar"></div>
<div id="messages-sidebar" class="sidebar-panel is-messages">
            <div class="messages-header px-4 pt-4">
                <h3 class="fs-18px">{{ __('Chat') }}</h3>
            </div>
            <div class="inner" data-simplebar>
                <div class="is-new-conversation p-3 mb-4">
                    <a href="#" data-toggle="modal" data-target="#new-conversation"  class="btn bg-blue radius-7 btn-block c-white"><span>{{ __('New Conversation') }}</span></a>
                </div>
                <ul class="p-0">
                    @foreach ($convo as $item)
                        <li class="">
                            <a href="{{ route('user-chat', $item->id) }}" class="recent-user">
                                <div class="user-container">
                                    <img class="is-user" src="{{ c_avatar($item->customer) }}"alt="">
                                </div>
                                <div class="recipient-meta">
                                    @php
                                        if($last_message = \App\Model\Messages::where('conversation_id', $item->id)->latest()->first()):
                                            $date = $last_message->created_at;

                                            if (\Carbon\Carbon::parse($date)->isToday()) {
                                              $date = 'Today';
                                            }elseif (\Carbon\Carbon::parse($date)->isYesterday()) {
                                              $date = 'Yesterday';
                                            }else{
                                              $date = \Carbon\Carbon::parse($date)->diffForHumans();
                                            }
                                            else:
                                                $date = __('Never');
                                        endif;
                                    @endphp
                                    <span>{{ customer('name', $item->customer) }}</span>
                                    <span>{{ $date }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
<div id="huro-messaging" class="view-wrapper is-pushed-full" data-sidebar-open="" data-naver-offset="406" data-menu-item="#sidebar-bubble" data-mobile-item="#mobile-bubble">
            <div class="page-content-wrapper">
                <div class="page-content chat-content">

                    <div class="page-title has-text-centered is-hidden d-none">

                        <div class="huro-hamburger nav-trigger push-resize" data-sidebar="messages-sidebar">
                            <span class="menu-toggle has-chevron">
                                    <span class="icon-box-toggle active">
                                        <span class="rotate">
                                            <i class="icon-line-top"></i>
                                            <i class="icon-line-center"></i>
                                            <i class="icon-line-bottom"></i>
                                        </span>
                            </span>
                            </span>
                        </div>

                        <h1 class="title is-5">Messages </h1>
                    </div>
                    <div class="is-chat-placeholder animated preFadeInUp fadeInUp">
                        <div class="caption">
                            <img src="assets/img/illustrations/messages/empty-placeholder.svg" data-demo-src="assets/img/illustrations/messages/empty-placeholder.svg" alt="">
                            <div class="text">
                                <h3>Nothing to show</h3>
                                <p>Select an existing conversation or start a new one</p>
                                <a href="#" data-toggle="modal" data-target="#new-conversation" class="button h-button is-solid is-outlined is-big is-rounded">{{ __('Start a new conversation') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="new-conversation" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content bdrs-20">
                <a href="#" class="close" data-dismiss="modal">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-lg">
                <h4 class="mb-4">{{ __('Start a new Conversation') }}</h4>
                <form method="post" action="{{ route('user-chat-start') }}" class="form-group">
                    @csrf
                    <label for="">{{ __('Choose customer to start a conversation with') }}</label>
                    <select name="customer" id="" class="form-control custom-select">
                        @foreach ($customers as $item)
                             <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn_sm_primary bg-blue btn-block mt-5 submit-closest text-white">{{ __('Start') }} <em class="icon tio"></em></button>
                </form>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
@endsection
