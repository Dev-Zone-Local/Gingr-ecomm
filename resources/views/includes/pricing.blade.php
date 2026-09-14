      <section class="p_pricing_list {{ $class ?? '' }}">
          <div class="container">
            <!-- start tab -->
            <div class="row">
              <div class="col-lg-6 ml-auto">
                <div class="row justify-content-center">
                  <div class="col-lg-10">
                    <div class="tab_pricing_list">
                      <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="pills-month-tab" data-toggle="pill" href="#pills-month" role="tab" aria-controls="pills-month" aria-selected="true">{{ __('Monthly') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="pills-quarter-tab" data-toggle="pill" href="#pills-quarter" role="tab" aria-controls="pills-annually" aria-selected="false">{{ __('Quarter') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="pills-annually-tab" data-toggle="pill" href="#pills-annually" role="tab" aria-controls="pills-annually" aria-selected="false">{{ __('Annually') }}</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End. tab -->

                <div class="row no-gutters">
                  <div class="tab-content col-lg-6" id="pills-tabContent">
                  @foreach ($packages as $item)
                        @php
                            $item->settings = (object) $item->settings;
                            $json = !empty($item->domains) && is_array(json_decode($item->domains, true)) ? json_decode($item->domains) : [];
                            $domains = [];
                            foreach($json as $value){
                                if ($domain = \App\Model\Domains::where('id', $value)->where('status', 1)->first()) {
                                    $domains[$domain->id] = (object) ['domain' => $domain->host];
                                }
                            }
                        @endphp
                    <div class="tab-pane" id="pills-{{$item->id}}-p" role="tabpanel" aria-labelledby="pills-{{$item->id}}-p-tab">
                        <div class="">
                          <div class="group_futures" data-simplebar>
                              <ul class="fadein">
                                <li >
                                  <span>{{ __('Ads') }}</span>
                                  @if ($item->settings->ads)
                                   <em class="tio checkmark_circle"></em>
                                   @else
                                   <i class="tio clear_circle_outlined c-gray"></i>
                                  @endif
                                </li>
                                <li >
                                  <span>{{ __('Custom Branding') }}</span>
                                  @if ($item->settings->custom_branding)
                                   <em class="tio checkmark_circle"></em>
                                   @else
                                   <i class="tio clear_circle_outlined c-gray"></i>
                                  @endif
                                </li>
                                <li >
                                  <span>{{ __('Add Script To Head') }}</span>
                                  @if (!empty($item->settings->add_to_head) && $item->settings->add_to_head)
                                   <em class="tio checkmark_circle"></em>
                                   @else
                                   <i class="tio clear_circle_outlined c-gray"></i>
                                  @endif
                                </li>
                                <li >
                                  <span>{{ __('Advance stats') }}</span>
                                  @if ($item->settings->statistics)
                                   <em class="tio checkmark_circle"></em>
                                   @else
                                   <i class="tio clear_circle_outlined c-gray"></i>
                                  @endif
                                </li>
                                <li >
                                  <span>{{ __('Verified badge') }}</span>
                                  @if ($item->settings->verified)
                                   <em class="tio checkmark_circle"></em>
                                   @else
                                   <i class="tio clear_circle_outlined c-gray"></i>
                                  @endif
                                </li>
                                <li >
                                  <span>{{ __('Social links to your profile') }}</span>
                                  @if ($item->settings->social)
                                   <em class="tio checkmark_circle"></em>
                                   @else
                                   <i class="tio clear_circle_outlined c-gray"></i>
                                  @endif
                                </li>
                                <li >
                                  <span>{{ __('Google analytics') }}</span>
                                  @if ($item->settings->google_analytics)
                                   <em class="tio checkmark_circle"></em>
                                   @else
                                   <i class="tio clear_circle_outlined c-gray"></i>
                                  @endif
                                </li>
                                <li >
                                  <span>{{ __('Facebook pixel') }}</span>
                                  @if ($item->settings->facebook_pixel)
                                   <em class="tio checkmark_circle"></em>
                                   @else
                                   <i class="tio clear_circle_outlined c-gray"></i>
                                  @endif
                                </li>
                                <li >
                                  <span>{{__('Multi Domain')}} | @foreach ($domains as $value) {{$value->domain}} | @endforeach {{ parse_url(config('app.url'))['host'] }}</span>
                                   <em class="tio checkmark_circle"></em>
                                </li>
                                <li >
                                  <span>{{(!empty($item->settings->products_limit) && $item->settings->products_limit == '-1' ? "Unlimited" : $item->settings->products_limit )}} {{ __('Products') }}</span>
                                   <em class="tio checkmark_circle"></em>
                                </li>

                                  
                                <li >
                                  <span>{{(!empty($item->settings->blogs_limits) && $item->settings->blogs_limits == '-1' ? "Unlimited" : $item->settings->blogs_limits )}} {{ __('Blogs') }}</span>
                                   <em class="tio checkmark_circle"></em>
                                </li>

                                <li >
                                  <span>{{ (!empty($item->settings->custom_domain_limit) && $item->settings->custom_domain_limit == '-1' ? "Unlimited" : $item->settings->custom_domain_limit )}} {{ __('Custom domain') }}</span>
                                   <em class="tio checkmark_circle"></em>
                                </li>
                              </ul>
                          </div>
                        </div>
                    </div>
                  @endforeach
                  </div>
                  <div class="col-lg-6 my-auto">
                    @php
                      $first = 0;
                    @endphp

                    <div class="tab-content content_pricing" id="pills-tabContent">
                      <div class="tab-pane active" id="pills-month" role="tabpanel" aria-labelledby="pills-month-tab">
                        <div class="group_price_table card-shadow checkbox-item">
                          <div class="fadein">
                            <!-- item -->
                            @foreach ($packages as $package)
                              @php
                                $first++;
                              @endphp
                              <a class="item_price item-select pill {{ $first == 1 ? 'active' : '' }}" id="pills-{{$package->id}}-p-tab" data-toggle="pill" href="#pills-{{$package->id}}-p" role="tab" aria-controls="pills-{{$package->id}}-p" aria-selected="false" data-href="{{ route('user-package-select', [$package->id == 'free' ? 'free' : $package->slug]) }}">
                                <div class="part_one">
                                  <span class="check_select"></span>
                                  <h3>{{ $package->name }} </h3>
                                </div>
                                <div class="part_two">
                                  <h4>{!! Currency::symbol(settings('currency')) !!}{{ number_format($package->price->month ?? '0') }} <span>/ {{ __('Monthly') }}</span></h4>
                                </div>
                              </a>
                            @endforeach

                            <div class="footer_content">
                              <a href="#" class="btn btn_md_primary bg-blue c-white rounded-8 btn-href">{{ __('Choose Plan') }}</a>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="pills-quarter" role="tabpanel" aria-labelledby="pills-quarter-tab">
                        <div class="group_price_table checkbox-item">
                          <div class="fadein">
                            <!-- item -->
                            @foreach ($packages as $package)
                              @php
                                $first++;
                              @endphp
                              <a class="item_price item-select pill {{ $first == 1 ? 'active' : '' }}" id="pills-{{$package->id}}-p-tab" data-toggle="pill" href="#pills-{{$package->id}}-p" role="tab" aria-controls="pills-{{$package->id}}-p" aria-selected="false" data-href="{{ route('user-package-select', [$package->id == 'free' ? 'free' : $package->slug]) }}">
                                <div class="part_one">
                                  <span class="check_select"></span>
                                  <h3>{{ $package->name }} </h3>
                                </div>
                                <div class="part_two">
                                  <h4>{!! Currency::symbol(settings('currency')) !!}{{ number_format($package->price->quarter ?? '0') }} <span>/ {{ __('Quarter') }}</span></h4>
                                </div>
                              </a>
                            @endforeach

                            <div class="footer_content">
                              <a href="#" class="btn btn_md_primary bg-blue rounded-8 btn-href">{{ __('Choose Plan') }}</a>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="pills-annually" role="tabpanel" aria-labelledby="pills-annually-tab">
                        <div class="group_price_table checkbox-item">
                          <div class="fadein">
                            <!-- item -->
                            @foreach ($packages as $package)
                              @php
                                $first++;
                              @endphp
                              <a class="item_price item-select pill {{ $first == 1 ? 'active' : '' }}" id="pills-{{$package->id}}-p-tab" data-toggle="pill" href="#pills-{{$package->id}}-p" role="tab" aria-controls="pills-{{$package->id}}-p" aria-selected="false" data-href="{{ route('user-package-select', [$package->id == 'free' ? 'free' : $package->slug]) }}">
                                <div class="part_one">
                                  <span class="check_select"></span>
                                  <h3>{{ $package->name }} </h3>
                                </div>
                                <div class="part_two">
                                  <h4>{!! Currency::symbol(settings('currency')) !!}{{ number_format($package->price->annual ?? '0') }} <span>/ {{ __('Annually') }}</span></h4>
                                </div>
                              </a>
                            @endforeach

                            <div class="footer_content">
                              <a href="#" class="btn btn_md_primary bg-blue rounded-8 btn-href">{{ __('Choose Plan') }}</a>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

          </div>
        </section>