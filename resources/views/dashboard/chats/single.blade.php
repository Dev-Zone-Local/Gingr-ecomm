@extends('layouts.app')
@section('title', __('Chats'))
@section('content')
@section('footerJS')
<script src="{{ url('js/others.js') }}"></script>
<script src="{{ url('assets/js/emoji-picker.js') }}"></script>
    <script>
    const button = document.querySelector('.add-emoji');

    const picker = new EmojiButton();

    button.addEventListener('click', () => {
      picker.togglePicker(button);
    });

    picker.on('emoji', emoji => {
       document.querySelector('#chat-input').value += emoji;
    });
    const simplebar = new SimpleBar(document.querySelector('#chat-body'), {
        autoHide: false
    });
</script>
@stop

<style>
    footer, #OverallHeader{
        display: none;
    }
    .clov-sidebar + #wrapper{
        padding-right: 5px;
    }
</style>
      <!-- Start header -->
      <header class="header-nav-center active-blue" id="myNavbar">
        <div class="container">
          <!-- navbar -->
          <nav class="navbar navbar-expand-lg navbar-light px-sm-0 justify-content-center">
              <button class="navbar-toggler menu ripplemenu toggle-chat-sidebar" type="button">
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
                    @foreach ($conversations as $item)
                        <li class="{{ request()->id == $item->id ? 'is-active' : '' }}">
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
<div id="huro-messaging" class="view-wrapper is-pushed-full">
            <div class="page-content-wrapper">
                <div class="page-content chat-content">

                    <!-- Chat Card -->
                    <div class="is-chat animated preFadeInUp fadeInUp">

                        <div class="chat-body-wrap">

                            <!-- Chat Body -->
                           <ol id="chat-body" class="chat-body get-chat" data-route="{{ route('get-chat-messages', ['id' => $convo->id, 'view' => 'store']) }}" data-id="{{ $convo->id }}" data-simsplebar>

                                {!! convo_messages_html($convo->id) !!}
                                
                            </ol>

                            <!-- Chat side -->
                        </div>

                        <div class="message-field-wrapper">
                            <form method="post" action="{{ route('user-chat-message', ['convo_id' => $convo->id]) }}" class="control" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="store" name="from">
                                <div class="add-content">

                                    <div class="dropdown">
                                      <button class="button dropdown-toggle" type="button" data-toggle="dropdown"><i class="tio add"></i></button>
                                      <div class="dropdown-menu">
                                            <div class="dropdown-content">
                                                <a href="#" class="dropdown-item show-hide-chat" data-value="images">
                                                    <i class="tio image"></i>
                                                    <div class="meta">
                                                        <span>{{ __('Images') }}</span>
                                                        <span>{{ __('Upload pictures') }}</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="dropdown-item show-hide-chat" data-value="link">
                                                    <i class="tio link"></i>
                                                    <div class="meta">
                                                        <span>{{ __('Link') }}</span>
                                                        <span>{{ __('Post a link') }}</span>
                                                    </div>
                                                </a>
                                                <hr class="dropdown-divider">
                                                <a href="#" class="dropdown-item show-hide-chat" data-value="file">
                                                    <i class="tio file_outlined"></i>
                                                    <div class="meta">
                                                        <span>{{ __('File') }}</span>
                                                        <span>{{ __('Upload a file') }}</span>
                                                    </div>
                                                </a>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="add-emoji ml-1">
                                    <div class="button">
                                        <i class="tio slightly_smilling"></i>
                                    </div>
                                </div>

                               <div class="card border-0 shadow-none custom-input-uploader hide show-open" id="open-file">
                                   <div class="card-body p-0 m-0">
                                       <div class="file-upload p-0 m-0">
                                           <input class="file-input uploader_input" name="data_file" type="file">
                                           <img src="{{ url('media/misc/upload-image-placeholder.svg') }}" class="h-25px my-3" alt=" ">
                                           <div class="card-subtitle">{{ __('Drop a file here') }}</div>
                                            <div class="list-files w-100 mt-4">
                                            </div>
                                       </div>
                                   </div>
                               </div>

                               <div class="card border-0 shadow-none custom-input-uploader hide show-open" id="open-images">
                                   <div class="card-body p-0 m-0">
                                       <div class="file-upload p-0 m-0">
                                           <input class="file-input uploader_input" name="data_image" type="file">
                                           <img src="{{ url('media/misc/upload-image-placeholder.svg') }}" class="h-25px my-3" alt=" ">
                                           <div class="card-subtitle">{{ __('Drag n Drop your image here') }}</div>
                                            <div class="list-files w-100 mt-4">
                                            </div>
                                       </div>
                                   </div>
                               </div>

                                <input type="hidden" name="type" value="text">

                                <input id="open-text" class="form-control show-open" type="text" placeholder="{{ __('Write a message ...') }}" name="data_text">

                                <input class="form-control hide show-open" id="open-link" type="text" placeholder="{{ __('Enter url') }}" name="data_link">

                                <div class="send-message">
                                    <button class="btn bg-blue c-white radius-10 effect-letter">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </form>


                            <div class="typing-indicator">
                                <img src="assets/img/icons/typing.gif" alt="">
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
