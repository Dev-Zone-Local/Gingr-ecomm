@extends('layouts.app')
@section('title', __('Invoice - ') . strtolower($plan->name))
@section('content')


<div class="invoice-wrapper mt-8">
                            <div class="invoice-header px-3">
                                <div class="left">
                                    <h3>{{ __('Invoice') }}</h3>
                                </div>
                                <div class="right">
                                    <div class="controls">
                                        <a href="Javascript::void" class="action" onclick="window.print()">
                                            <i class="tio print fs-19px"></i>
                                        </a>


                                        <a href="Javascript::void" class="action html-to-canvas-download" data-html=".invoice-body" data-name="plan-invoice">
                                            <i class="tio download_from_cloud fs-19px"></i>
                                        </a>

                                        <a href="{{ route('pricing') }}" class="action">
                                            <i class="tio arrow_backward fs-19px"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-body card border-0 radius-5">
                                <div class="invoice-card">
                                    <div class="invoice-section is-flex is-bordered">
                                        <div class="h-avatar is-large">
                                            <img class="ob-cover w-68px h-68px radius-100" src="{{ url('media/logo/' . settings('logo')) }}" alt=" " data-user-popover="6">
                                        </div>
                                        <div class="meta">
                                         <small>{{ __('Name') }} - {{settings('business.name')}}</small>
                                         @if(!empty(settings('business.address')))
                                          <small class="d-block">{{ __('Address') }} - {{settings('business.address')}}</small>
                                         @endif
                                         @if(!empty(settings('business.city')))
                                          <small class="d-block">{{ __('City') }} - {{settings('business.city')}}</small>
                                         @endif
                                         @if(!empty(settings('business.county')))
                                          <small class="d-block">{{ __('County') }} - {{settings('business.county')}}</small>
                                         @endif
                                         @if(!empty(settings('business.zip')))
                                          <small class="d-block">{{ __('Zip') }} - {{settings('business.zip')}}</small>
                                         @endif
                                         @if(!empty(settings('business.country')))
                                          <small class="d-block">{{ __('Country') }} - {{settings('business.country')}}</small>
                                         @endif
                                         @if(!empty(settings('business.email')))
                                          <small class="d-block">{{ __('Email') }} - {{settings('business.email')}}</small>
                                         @endif
                                         @if(!empty(settings('business.phone')))
                                          <small class="d-block">{{ __('Phone') }} - {{settings('business.phone')}}</small>
                                         @endif
                                         @if(!empty(settings('business.tax_type')) && !empty(settings('business.tax_id')))
                                          <small class="d-block">{{ __('Tax') }} - {{settings('business.tax_id')}}</small>
                                         @endif
                                         @if(!empty(settings('business.custom_key_one')) && !empty(settings('business.custom_value_one')))
                                          <small class="d-block">{{settings('business.custom_key_one')}} - {{settings('business.custom_value_one')}}</small>
                                         @endif
                                         @if(!empty(settings('business.custom_key_two')) && !empty(settings('business.custom_value_two')))
                                          <small class="d-block">{{settings('business.custom_key_two')}} - {{settings('business.custom_value_two')}}</small>
                                         @endif
                                        </div>
                                        <div class="end">
                                            <h3>{{ __('New invoice') }}</h3>
                                            <span>{{ __('Issued on') }}: {{ Carbon\Carbon::now()->toFormattedDateString() }}</span>
                                            <span>{{ __('By') }}: {{full_name($user->id)}}</span>
                                        </div>
                                    </div>
                                    <div class="invoice-section is-flex is-bordered">
                                        <div class="h-avatar is-customer is-large">
                                            <img class="ob-cover w-68px h-68px radius-100" src="{{avatar()}}" alt=" ">
                                        </div>
                                        <div class="meta">
                                          <small>{{ __('Name') }} - {{full_name($user->id)}}</small>
                                          <small class="d-block">{{ __('Email') }} - {{$user->email}}</small>
                                        </div>
                                        <div class="end is-left">
                                            <h3>{{ __('Status') }}</h3>
                                            <p>{{ __('Unpaid') }}</p>

                                            <a href="{{ route(strtolower($gateway).'-create', ['plan' => $plan->slug, 'duration' => $duration]) }}" class="btn bg-blue c-white">{{ __('Pay now') }}</a>
                                        </div>
                                    </div>
                                    <div class="invoice-section">
                                             <div class="flex-table">
                                                 <!--Table header-->
                                                 <div class="flex-table-header">
                                                     <span>{{ __('Product') }}</span>
                                                     <span>{{ __('Quantity') }}</span>
                                                     <span>{{ __('Price') }}</span>
                                                     <span>{{ __('Duration') }}</span>
                                                     <span>{{ __('Total') }}</span>
                                                 </div>
                                                     <div class="flex-table-item">
                                                         <div class="flex-table-cell is-media" data-th="">
                                                             <div class="h-avatar is-medium">
                                                                 <img class="avatar is-squared h-40px object-cover d-none" src=" " alt=" ">
                                                             </div>
                                                             <div>
                                                                 <span class="item-name dark-inverted fs-11px">{{$plan->name}}</span>
                                                             </div>
                                                         </div>
                                                         <div class="flex-table-cell" data-th="{{ __('Quantity') }}">
                                                             <span class="light-text fs-11px">1</span>
                                                         </div>
                                                         <div class="flex-table-cell" data-th="{{ __('Price') }}">
                                                             <span class="tag fs-11px">{{ $plan->price->{$duration} }}</span>
                                                         </div>
                                                         <div class="flex-table-cell" data-th="{{ __('Gateway') }}">
                                                             <span class="tag fs-11px">{{ ucfirst($duration) }}</span>
                                                         </div>
                                                         <div class="flex-table-cell" data-th="{{ __('Total') }}">
                                                             <span class="tag fs-11px">{{ nf($plan->price->{$duration}) }}</span>
                                                         </div>
                                                     </div>
                                          </div>
                                        <div class="flex-table sub-table">
                                            <!--Table item-->
                                            <div class="flex-table-item shadow-none">
                                                <div class="flex-table-cell is-grow is-vhidden" data-th=""></div>
                                                <div class="flex-table-cell cell-end is-vhidden" data-th=""></div>
                                                <div class="flex-table-cell is-vhidden" data-th=""></div>


                                                <div class="flex-table-cell" data-th="">
                                                    <span class="table-label">{{ __('Quantity') }}</span>
                                                </div>
                                                <div class="flex-table-cell has-text-right" data-th="">
                                                    <span class="table-total dark-inverted">1</span>
                                                </div>
                                            </div>

                                            <!--Table item-->
                                            <div class="flex-table-item shadow-none">
                                                <div class="flex-table-cell is-grow is-vhidden" data-th=""></div>
                                                <div class="flex-table-cell cell-end is-vhidden" data-th=""></div>
                                                <div class="flex-table-cell is-vhidden" data-th=""></div>


                                                <div class="flex-table-cell" data-th="">
                                                    <span class="table-label">{{ __('Subtotal') }}</span>
                                                </div>
                                                <div class="flex-table-cell has-text-right" data-th="">
                                                    <span class="table-total dark-inverted">{!! Currency::symbol(settings('currency')) !!}{{ nf($plan->price->{$duration}) }}</span>
                                                </div>
                                            </div>
                                            <!--Table item-->
                                            <div class="flex-table-item shadow-none">
                                                <div class="flex-table-cell is-grow is-vhidden" data-th=""></div>
                                                <div class="flex-table-cell cell-end is-vhidden" data-th=""></div>
                                                <div class="flex-table-cell is-vhidden" data-th=""></div>


                                                <div class="flex-table-cell" data-th="">
                                                    <span class="table-label">{{ __('Total') }}</span>
                                                </div>
                                                <div class="flex-table-cell has-text-right" data-th="">
                                                    <span class="table-total is-bigger dark-inverted">{!! Currency::symbol(settings('currency')) !!}{{ nf($plan->price->{$duration}) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection
