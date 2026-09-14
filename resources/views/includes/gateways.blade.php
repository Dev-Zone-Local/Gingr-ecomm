<div class="row">
          <div class="col-md-6">
            <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Currency') }}</span>
                <small class="d-block mt-2">{{ __('Select currency code') }}</small>
              </label>
              <select name="gateway_currency" class="form-select custom-select" data-search="on" data-ui="lg">
                @foreach (Currency::all() as $key => $code)
                 <option value="{{ $key }}" {{ (user('gateway.currency') == $key) ? 'selected' : '' }}>{{ $key }}</option>
                @endforeach
              </select>
           </div>
           @if (has_gateway('paypal', $user->id))
            <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Paypal') }}</span>
                <small class="d-block mt-2">{{ __('Enter your paypal client id and secret key or leave empty to disable') }}</small>
              </label>
              <select name="gateway_paypal_mode" class="form-select custom-select" data-search="on" data-ui="lg">
                <option value="live" {{ user('gateway.paypal_mode') == 'live' ? 'selected' : '' }}>{{ __('Live') }}</option>
                <option value="sandbox" {{ user('gateway.paypal_mode') == 'sandbox' ? 'selected' : '' }}>{{ __('Sandbox') }}</option>
              </select>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.paypal_client_id') }}" class="form-control form-control-lg" placeholder="Paypal client id" name="gateway_paypal_client_id">
              </div>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.paypal_secret_key') }}" class="form-control form-control-lg" placeholder="Paypal secret key" name="gateway_paypal_secret_key">
              </div>
           </div>
        @endif
        @if (license('license') != 'Extended License')
           @if (has_gateway('paytm', $user->id))
            <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('PayTM') }}</span>
                <small class="d-block mt-2">{{ __('Enter your paytm credentials to enable') }}</small>
              </label>
              <select name="gateway[paytm_status]" class="form-select custom-select" data-search="on" data-ui="lg">
                <option value="1" {{ user('gateway.paytm_status') == 1 ? 'selected' : '' }}>{{ __('Activate') }}</option>
                <option value="0" {{ user('gateway.paytm_status') == 0 ? 'selected' : '' }}>{{ __('Dsiable') }}</option>
              </select>
              <select name="gateway[paytm_environment]" class="form-select custom-select mt-4" data-search="on" data-ui="lg">
                <option value="production" {{ user('gateway.paytm_environment') == 'production' ? 'selected' : '' }}>{{ __('Production') }}</option>
                <option value="local" {{ user('gateway.paytm_environment') == 'local' ? 'selected' : '' }}>{{ __('Local') }}</option>
              </select>

              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.paytm_merchant_id') }}" class="form-control form-control-lg" placeholder="{{ __('Merchant ID') }}" name="gateway[paytm_merchant_id]">
              </div>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.paytm_merchant_key') }}" class="form-control form-control-lg" placeholder="{{ __('Merchant Key') }}" name="gateway[paytm_merchant_key]">
              </div>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.paytm_merchant_website') }}" class="form-control form-control-lg" placeholder="{{ __('Merchant Website') }}" name="gateway[paytm_merchant_website]">
              </div>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.paytm_channel') }}" class="form-control form-control-lg" placeholder="{{ __('Channel') }}" name="gateway[paytm_channel]">
              </div>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.paytm_industrytype') }}" class="form-control form-control-lg" placeholder="{{ __('Industry Type') }}" name="gateway[paytm_industrytype]">
              </div>
           </div>
           @endif
           @if (has_gateway('paystack', $user->id))
            <div class="form-group custom mt-5">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Paystack') }}</span>
                <small class="d-block mt-2">{{ __('Enter your paystack secret key or leave empty to disable') }}</small>
              </label>
               <div class="form-control-wrap">
               <input type="text" value="{{ user('gateway.paystack_secret_key') }}" class="form-control form-control-lg" placeholder="your secret key" name="gateway_paystack_secret_key">
               </div>
            </div>
            @endif
           @endif
           @if (has_gateway('bank', $user->id))
            <div class="form-group custom mt-5">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Bank transfer') }}</span>
                <small class="d-block mt-2">{{ __('Input your bank details including bank name. Leave empty to disable') }}</small>
              </label>
               <div class="form-control-wrap">
                <input type="text" value="{{ user('gateway.bank_details') }}" class="form-control form-control-lg" placeholder="Enter details" name="gateway_bank_details">
               </div>
            </div>
            @endif
           @if (has_gateway('cash', $user->id))
            <div class="form-group custom mt-5">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Cash on delivery') }}</span>
                <small class="d-block mt-2">{{ __('Enable or disable cash on delivery.') }}</small>
              </label>
               <div class="form-control-wrap">
                <select name="gateway_cash_status" class="form-select custom-select" data-search="on" data-ui="lg">
                  <option value="0" {{ user('gateway.cash_status') == '0' ? 'selected' : '' }}>{{ __('Disable') }}</option>

                  <option value="1" {{ user('gateway.cash_status') == '1' ? 'selected' : '' }}>{{ __('Enable') }}</option>
                </select>
               </div>
            </div>
            @endif
          </div>
        @if (license('license') != 'Extended License')
          <div class="col-md-6">
           @if (has_gateway('stripe', $user->id))
            <div class="form-group custom mt-5">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Stripe') }}</span>
                <small class="d-block mt-2">{{ __('Input your stripe client and secret keys or leave empty to disable') }}</small>
              </label>
               <div class="form-control-wrap">
                <input type="text" value="{{ user('gateway.stripe_client') }}" class="form-control form-control-lg" placeholder="Stripe client key" name="gateway_stripe_client">
               </div>
               <div class="form-control-wrap mt-3">
                <input type="text" value="{{ user('gateway.stripe_secret') }}" class="form-control form-control-lg" placeholder="Stripe secret key" name="gateway_stripe_secret">
               </div>
            </div>
            @endif
           @if (has_gateway('razor', $user->id))
            <div class="form-group custom mt-5">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Razor pay') }}</span>
                <small class="d-block mt-2">{{ __('Input your razor key id and secret keys or leave empty to disable') }}</small>
              </label>
               <div class="form-control-wrap">
                <input type="text" value="{{ user('gateway.razor_key_id') }}" class="form-control form-control-lg" placeholder="Razor client key" name="gateway_razor_key_id">
               </div>
               <div class="form-control-wrap mt-3">
                <input type="text" value="{{ user('gateway.razor_secret_key') }}" class="form-control form-control-lg" placeholder="Razor secret key" name="gateway_razor_secret_key">
               </div>
            </div>
            @endif
           @if (has_gateway('midtrans', $user->id))
            <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('MidTrans') }}</span>
                <small class="d-block mt-2">{{ __('Enter your midtrans client key and server key or leave empty to disable') }}</small>
              </label>
              <select name="gateway_midtrans_mode" class="form-select custom-select" data-search="on" data-ui="lg">
                <option value="live" {{ user('gateway.midtrans_mode') == 'live' ? 'selected' : '' }}>{{ __('Live') }}</option>
                <option value="sandbox" {{ user('gateway.midtrans_mode') == 'sandbox' ? 'selected' : '' }}>{{ __('Sandbox') }}</option>
              </select>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.midtrans_client_key') }}" class="form-control form-control-lg" placeholder="MidTrans client id" name="gateway_midtrans_client_key">
              </div>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.midtrans_server_key') }}" class="form-control form-control-lg" placeholder="MidTrans secret key" name="gateway_midtrans_server_key">
              </div>
           </div>
           @endif
           @if (has_gateway('mercadopago', $user->id))
            <div class="form-group mt-5 custom">
              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                <span>{{ __('Mercadopago') }}</span>
                <small class="d-block mt-2">{{ __('Enter your mercadopago access token or leave empty to disable') }}</small>
              </label>
              <div class="form-control-wrap mt-3">
               <input type="text" value="{{ user('gateway.mercadopago_access_token') }}" class="form-control form-control-lg" placeholder="Mercadopago access token" name="gateway_mercadopago_access_token">
              </div>
           </div>
           @endif
          </div>
          @endif
        </div>