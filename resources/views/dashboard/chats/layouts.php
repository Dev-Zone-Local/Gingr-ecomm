@extends('layouts.app')
@section('title', __('Chats'))
@section('content')

<style>
    footer, header{
        display: none;
    }
    body{
        padding-right: 0;
    }
</style>

<div id="messages-sidebar" class="sidebar-panel is-messages is-active">
            <div class="messages-header px-4 pt-4">
                <h3 class="no-mb">Chat</h3>

                <div class="huro-hamburger nav-trigger push-resize messages-push" data-sidebar="messages-sidebar">
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
            </div>
            <div class="inner" data-simplebar>
                <div class="is-new-conversation p-3 mb-4">
                    <a href="#" data-toggle="modal" data-target="#new-conversation"  class="btn bg-blue btn_sm_primary radius-100 btn-block c-white"><span>{{ __('New Conversation') }}</span></a>
                </div>
                <ul id="conversations-list" class="animated preFadeInUp fadeInUp">

                    <li id="conversation1" class="is-active" data-conversation-menu="conversation1" data-position="Business Analyst">
                        <div class="recent-user">
                            <div class="user-container">
                                <img class="is-user" src="assets/img/avatars/photos/10.jpg" data-demo-src="assets/img/avatars/photos/10.jpg" alt="">
                            </div>
                            <div class="recipient-meta">
                                <span>Henry G.</span>
                                <span>3 minutes ago</span>
                            </div>
                        </div>
                    </li>
                    <li id="conversation2" data-conversation-menu="conversation2" data-position="Web Developer">
                        <div class="recent-user">
                            <div class="user-container">
                                <img class="is-user" src="assets/img/avatars/photos/25.jpg" data-demo-src="assets/img/avatars/photos/25.jpg" alt="">
                            </div>
                            <div class="recipient-meta">
                                <span>Melany W.</span>
                                <span>30 minutes ago</span>
                            </div>
                        </div>
                    </li>
                    <li id="conversation3" data-conversation-menu="conversation3" data-position="UI/UX Designer">
                        <div class="recent-user">
                            <div class="user-container">
                                <img class="is-user" src="assets/img/avatars/photos/13.jpg" data-demo-src="assets/img/avatars/photos/13.jpg" alt="">
                            </div>
                            <div class="recipient-meta">
                                <span>Tara S.</span>
                                <span>1 day ago</span>
                            </div>
                        </div>
                    </li>
                    <li id="conversation4" data-conversation-menu="conversation4" data-position="UI/UX Designer">
                        <div class="recent-user">
                            <div class="user-container">
                                <img class="is-user" src="assets/img/avatars/photos/18.jpg" data-demo-src="assets/img/avatars/photos/18.jpg" alt="">
                            </div>
                            <div class="recipient-meta">
                                <span>Esteban C.</span>
                                <span>1 day ago</span>
                            </div>
                        </div>
                    </li>
                    <li id="conversation5" data-conversation-menu="conversation5" data-position="Software Engineer">
                        <div class="recent-user">
                            <div class="user-container">
                                <img class="is-user" src="assets/img/avatars/photos/7.jpg" data-demo-src="assets/img/avatars/photos/7.jpg" alt="">
                            </div>
                            <div class="recipient-meta">
                                <span>Alice C.</span>
                                <span>2 days ago</span>
                            </div>
                        </div>
                    </li>
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

                    <!-- Chat Card -->
                    <div class="is-chat animated preFadeInUp fadeInUp">

                        <div class="chat-body-wrap">

                            <!-- Chat Body -->
                            <ol id="chat-body" class="chat-body" data-simplebar data-conversation-body="conversation1">

                                <li class="no-messages is-hidden d-none">
                                    <img class="light-image" src="assets/img/illustrations/placeholders/search-4.svg" alt="">
                                    <img class="dark-image" src="assets/img/illustrations/placeholders/search-4-dark.svg" alt="">
                                    <div class="text">
                                        <h3>No messages yet</h3>
                                        <p>Start the conversation by typing a message</p>
                                    </div>
                                </li>

                                <li class="chat-loader">
                                    <div class="loader is-loading"></div>
                                </li>
                            
                            <li class="divider-container">
                                <div class="divider">
                                    <span>Yesterday</span>
                                </div>
                            </li>
                        
                            <li class="other">
                                <div class="avatar">
                                    <img src="assets/img/avatars/photos/10.jpg" draggable="false">
                                </div>
                                <div class="msg">
                                    <div class="msg-inner">
                                        <p>Hey Erik, I came accross a new Saas software while doing some research. You should definitely check it out.</p>
                                    </div>
                                    
                                    <time>
                                        08:17pm
                                    </time>
                                </div>
                            </li>
                        
                            <li class="self">
                                <div class="avatar">
                                    <img src="assets/img/avatars/photos/8.jpg" draggable="false">
                                </div>
                                <div class="msg">
                                    <div class="msg-inner">
                                        <p>Sure, I'd Love to learn more about it. Do you have any links or documentation?</p>
                                    </div>
                                    
                                    <time>
                                        08:18pm
                                    </time>
                                </div>
                            </li>
                        
                            <li class="divider-container">
                                <div class="divider">
                                    <span>just now</span>
                                </div>
                            </li>
                        
                            <li class="other">
                                <div class="avatar">
                                    <img src="assets/img/avatars/photos/10.jpg" draggable="false">
                                </div>
                                <div class="msg">
                                    <div class="msg-inner">
                                        <p>Here you go. There's also a full fledged documentation. Just click on the click in the top right corner.</p>
                                    </div>
                                    
                                    <time>
                                        11:27am
                                    </time>
                                </div>
                            </li>
                        
                            <li class="other">
                                <div class="avatar">
                                    <img src="assets/img/avatars/photos/10.jpg" draggable="false">
                                </div>
                                <div class="msg is-link-image">
                                    <figure class="image">
                                        <img src="assets/img/photo/demo/demo-apps/1.jpg">
                                        <div class="link-badge">
                                            <img src="assets/img/icons/logos/slicer.svg">
                                        </div>
                                    </figure>
                                    <div class="link-body">
                                        <span class="link-title">Manage projects like you never did before with this new app</span>
                                        <small>gettrueprojects.com</small>
                                    </div>
                                </div>
                            </li>
                        
                            <li class="self">
                                <div class="avatar">
                                    <img src="assets/img/avatars/photos/8.jpg" draggable="false">
                                </div>
                                <div class="msg">
                                    <div class="msg-inner">
                                        <p>Thanks, so do you think this one would be a good fit to manage our projects?</p>
                                    </div>
                                    
                                    <time>
                                        11:32am
                                    </time>
                                </div>
                            </li>
                        
                            <li class="other">
                                <div class="avatar">
                                    <img src="assets/img/avatars/photos/10.jpg" draggable="false">
                                </div>
                                <div class="msg">
                                    <div class="msg-inner">
                                        <p>You can start by reading the project whitepaper. Eveything you need is in there. You can also try the free demo and start exploring features.</p>
                                    </div>
                                    
                                    <time>
                                        11:43am
                                    </time>
                                </div>
                            </li>
                        
                            <li class="other">
                                <div class="avatar is-online">
                                    <img src="assets/img/avatars/photos/10.jpg" draggable="false">
                                </div>
                                <div class="msg is-link">
                                    <div class="icon-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                    </div>
                                    <p class="link-meta">
                                        <span>True Projects Whitepaper</span>
                                        <a href="#">Open Link</a>
                                    </p>
                                </div>
                            </li>
                        
                                <li class="self">
                                    <div class="avatar is-online">
                                        <img src="assets/img/avatars/photos/8.jpg" draggable="false">
                                    </div>
                                    <div class="msg is-image">
                                        <div class="image-container">
                                            <img src="assets/img/photo/demo/demo-apps/2.jpg">
                                            <div class="image-overlay"></div>
                                            <div class="image-actions">
                                                <div class="actions-inner">
                                                    <div class="action">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download-cloud"><polyline points="8 17 12 21 16 17"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"></path></svg>
                                                    </div>
                                                    <a href="assets/img/photo/demo/demo-apps/2.jpg" class="action messaging-popup">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            
                            <li class="self">
                                <div class="avatar">
                                    <img src="assets/img/avatars/photos/8.jpg" draggable="false">
                                </div>
                                <div class="msg">
                                    <div class="msg-inner">
                                        <p>Well, I think we might give it a shot. At least, it's worth trying. Don't you think so?</p>
                                    </div>
                                    
                                    <time>
                                        11:49am
                                    </time>
                                </div>
                            </li>
                        </ol>

                            <!-- Chat side -->
                            <div class="chat-side d-none">
                                <div class="chat-side-header">
                                    <div class="toolbar ml-auto">

                                        <div class="toolbar-link">
                                            <label class="dark-mode ml-auto">
                                                <input type="checkbox" checked="">
                                                <span></span>
                                            </label>
                                        </div>

                                        <a class="toolbar-link right-panel-trigger" data-panel="languages-panel">
                                            <img src="assets/img/icons/flags/united-states-of-america.svg" alt="">
                                        </a>

                                        <div class="toolbar-notifications is-hidden-mobile">
                                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger">
                                                <div class="is-trigger" aria-haspopup="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                                    <span class="new-indicator pulsate"></span>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <div class="heading">
                                                            <div class="heading-left">
                                                                <h6 class="heading-title">Notifications</h6>
                                                            </div>
                                                            <div class="heading-right">
                                                                <a class="notification-link" href="/admin-profile-notifications.html">See all</a>
                                                            </div>
                                                        </div>
                                                        <ul class="notification-list">
                                                            <li>
                                                                <a class="notification-item">
                                                                    <div class="img-left">
                                                                        <img class="user-photo" alt="" src="assets/img/avatars/photos/7.jpg" data-demo-src="assets/img/avatars/photos/7.jpg">
                                                                    </div>
                                                                    <div class="user-content">
                                                                        <p class="user-info"><span class="name">Alice C.</span> left a comment.</p>
                                                                        <p class="time">1 hour ago</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="notification-item">
                                                                    <div class="img-left">
                                                                        <img class="user-photo" alt="" src="assets/img/avatars/photos/12.jpg" data-demo-src="assets/img/avatars/photos/12.jpg">
                                                                    </div>
                                                                    <div class="user-content">
                                                                        <p class="user-info"><span class="name">Joshua S.</span> uploaded a file.</p>
                                                                        <p class="time">2 hours ago</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="notification-item">
                                                                    <div class="img-left">
                                                                        <img class="user-photo" alt="" src="assets/img/avatars/photos/13.jpg" data-demo-src="assets/img/avatars/photos/13.jpg">
                                                                    </div>
                                                                    <div class="user-content">
                                                                        <p class="user-info"><span class="name">Tara S.</span> sent you a message.</p>
                                                                        <p class="time">2 hours ago</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="notification-item">
                                                                    <div class="img-left">
                                                                        <img class="user-photo" alt="" src="assets/img/avatars/photos/25.jpg" data-demo-src="assets/img/avatars/photos/25.jpg">
                                                                    </div>
                                                                    <div class="user-content">
                                                                        <p class="user-info"><span class="name">Melany W.</span> left a comment.</p>
                                                                        <p class="time">3 hours ago</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <a id="hide-chat-side" class="toolbar-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="chat-side-content is-single">
                                    <div class="user-pic">
                                        <img id="user-details-image" src="assets/img/avatars/photos/10.jpg" data-demo-src="assets/img/avatars/photos/10.jpg" alt="">
                                        <img id="user-details-badge" class="is-badge" src="assets/img/icons/flags/united-states-of-america.svg" data-demo-src="assets/img/icons/flags/united-states-of-america.svg" alt="">
                                    </div>
                                    <h4 id="user-details-name" class="user-name">Henry G.</h4>
                                    <p id="user-details-title" class="user-job-title">Business Analyst</p>

                                    <div class="side-actions">
                                        <a class="button h-button is-rounded">
                                            <span class="icon is-small">
                                                    <i class="fas fa-phone"></i>
                                                </span>
                                            <span>Audio Call</span>
                                        </a>
                                        <a class="button h-button is-rounded">
                                            <span class="icon is-small">
                                                    <i class="fas fa-video"></i>
                                                </span>
                                            <span>Video Call</span>
                                        </a>
                                    </div>

                                    <div class="detail-photos">
                                        <div class="detail-photo-title">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                <path d="M21 15l-5-5L5 21"></path>
                                            </svg>
                                            Shared photos
                                        </div>
                                        <div class="detail-photo-grid">
                                            <img src="assets/img/photo/demo/demo-apps/1.jpg" data-demo-src="assets/img/photo/demo/demo-apps/1.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/2.jpg" data-demo-src="assets/img/photo/demo/demo-apps/2.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/3.jpg" data-demo-src="assets/img/photo/demo/demo-apps/3.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/4.jpg" data-demo-src="assets/img/photo/demo/demo-apps/4.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/5.jpg" data-demo-src="assets/img/photo/demo/demo-apps/5.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/6.jpg" data-demo-src="assets/img/photo/demo/demo-apps/6.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/7.jpg" data-demo-src="assets/img/photo/demo/demo-apps/7.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/8.jpg" data-demo-src="assets/img/photo/demo/demo-apps/8.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/9.jpg" data-demo-src="assets/img/photo/demo/demo-apps/9.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/10.jpg" data-demo-src="assets/img/photo/demo/demo-apps/10.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/11.jpg" data-demo-src="assets/img/photo/demo/demo-apps/11.jpg" alt="">
                                            <img src="assets/img/photo/demo/demo-apps/12.jpg" data-demo-src="assets/img/photo/demo/demo-apps/12.jpg" alt="">
                                        </div>
                                        <a class="view-more">View More</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="message-field-wrapper">
                            <div class="control">
                                <div class="add-content">
                                    <div class="dropdown dropdown-trigger is-up">
                                        <div>
                                            <div class="button" aria-haspopup="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </div>
                                        </div>
                                        <div class="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <a class="dropdown-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                                    <div class="meta">
                                                        <span>Video</span>
                                                        <span>Embed a video</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="dropdown-item kill-drop h-modal-trigger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                                    <div class="meta">
                                                        <span>Images</span>
                                                        <span>Upload pictures</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="dropdown-item kill-drop h-modal-trigger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                                    <div class="meta">
                                                        <span>Link</span>
                                                        <span>Post a link</span>
                                                    </div>
                                                </a>
                                                <hr class="dropdown-divider">
                                                <a href="#" class="dropdown-item kill-drop h-modal-trigger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                                    <div class="meta">
                                                        <span>File</span>
                                                        <span>Upload a file</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-emoji">
                                    <div class="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                    </div>
                                </div>
                                <input id="chat-input" class="input is-rounded" type="text" placeholder="Write a message ...">
                                <div class="send-message">
                                    <div class="button h-button is-primary is-raised is-rounded">
                                        Send
                                    </div>
                                </div>
                            </div>


                            <div class="typing-indicator">
                                <img src="assets/img/icons/typing.gif" alt="">
                            </div>
                        </div>

                    </div>

                    <div class="is-chat-placeholder animated preFadeInUp fadeInUp d-none">
                        <div class="caption">
                            <img src="assets/img/illustrations/messages/empty-placeholder.svg" data-demo-src="assets/img/illustrations/messages/empty-placeholder.svg" alt="">
                            <div class="text">
                                <h3>Nothing to show</h3>
                                <p>Select an existing conversation or start a new one</p>
                                <a id="new-chat" class="button h-button is-solid is-outlined is-big is-rounded">Start a new
                                    conversation</a>
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
