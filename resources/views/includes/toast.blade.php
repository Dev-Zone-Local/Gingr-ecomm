
    <!-- Tosts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center toast-outer">
    @if ($message = Session::get('error'))
            <div class="toast ecom-toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true"
              data-animation="true" data-autohide="false">
              <div class="toast-body">
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                  <i class="tio clear"></i>
                </button>
                <h5 class="text-white m-0">{{ __('Error!') }}</h5>
                <p class="m-0 text-white">{{ $message }}</p>
              </div>
            </div>
    @endif
    
    @if ($message = Session::get('success'))
            <div class="toast ecom-toast bg-success" role="alert" aria-live="assertive" aria-atomic="true"
              data-animation="true" data-autohide="false">
              <div class="toast-body">
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                  <i class="tio clear"></i>
                </button>
                <h5 class="text-white m-0">{{ __('Success') }}</h5>
                <p class="m-0 text-white">{{ $message }}</p>
              </div>
            </div>
    @endif
    @if ($message = Session::get('info'))
            <div class="toast ecom-toast bg-info" role="alert" aria-live="assertive" aria-atomic="true"
              data-animation="true" data-autohide="false">
              <div class="toast-body">
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                  <i class="tio clear"></i>
                </button>
                <h5 class="text-white m-0">{{ __('Info') }}</h5>
                <p class="m-0 text-white">{{ $message }}</p>
              </div>
            </div>
    @endif
      @if(!$errors->isEmpty())
           @foreach ($errors->all() as $error)
            <div class="toast ecom-toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true"
              data-animation="true" data-autohide="false">
              <div class="toast-body">
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                  <i class="tio clear"></i>
                </button>
                <h5 class="text-white m-0">{{ __('Error!') }}</h5>
                <p class="m-0 text-white">{{ $error }}</p>
              </div>
            </div>
           @endforeach
      @endif
    </div>
    <!-- End. Toasts -->