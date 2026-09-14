@extends('layouts.app')
@section('title', 'New Product')
@section('headJS')
<link href="{{ url('css/tagify.css') }}" rel="stylesheet">
<script src="{{ url('js/tagify.min.js') }}"></script>
<script src="{{ asset('js/Sortable.min.js') }}"></script>
@stop
@section('footerJS')
<script src="{{ url('js/tagify.country.js') }}"></script>
<script src="{{ url('tinymce/tinymce.min.js') }}"></script>
<script src="{{ url('tinymce/sr.js') }}"></script>
<script src="{{ url('js/others.js') }}"></script>
@stop
@section('content')
<div class="mt-8">
   <form class="form" action="{{ route('user-post-product', 'new') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <!-- Start section__showcase -->
      <section class="section__showcase margin-b-6">
         <div class="container">
            <div class="row justify-content-center text-center">
               <div class="col-lg-5">
                  <div class="title_sections_inner margin-b-5">
                     <h2>{{ __('Add Product') }}</h2>
                  </div>
               </div>
            </div>
            <div class="block__tab">
               <ul class="nav nav-pills" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab"
                        aria-controls="pills-general" aria-selected="true">
                        <div class="icon">
                           <i class="tio transform c-black"></i>
                        </div>
                        <h3>{{ __('General') }}</h3>
                        <div class="prog"></div>
                     </a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="pills-inventory-tab" data-toggle="pill" href="#pills-inventory" role="tab"
                        aria-controls="pills-inventory" aria-selected="true">
                        <div class="icon">
                           <i class="tio calculator c-black"></i>
                        </div>
                        <h3>{{ __('Inventory') }}</h3>
                        <div class="prog"></div>
                     </a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="pills-options-tab" data-toggle="pill" href="#pills-options" role="tab"
                        aria-controls="pills-options" aria-selected="true">
                        <div class="icon">
                           <i class="tio tools c-black"></i>
                        </div>
                        <h3>{{ __('Options') }}</h3>
                        <div class="prog"></div>
                     </a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="pills-others-tab" data-toggle="pill" href="#pills-others" role="tab"
                        aria-controls="pills-others" aria-selected="true">
                        <div class="icon">
                           <i class="tio more_vertical c-black"></i>
                        </div>
                        <h3>{{ __('Others') }}</h3>
                        <div class="prog"></div>
                     </a>
                  </li>
               </ul>
               <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-general" role="tabpanel"
                     aria-labelledby="pills-general-tab">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('Product name') }}</span>
                              <small class="d-block mt-2">{{ __('Give this product a name. Ex: Phones') }}</small>
                              </label>
                              <input class="form-control" type="text" value="{{ old('product_name') }}" placeholder="Product Title" name="product_name">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('Product Price') }}</span>
                              <small class="d-block mt-2">{{ __('Enter this product price.') }}</small>
                              </label>
                              <input class="form-control" type="text" placeholder="Product Price" name="product_price" value="{{ old('product_price') }}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('Sale Price') }}</span>
                              <small class="d-block mt-2">{{ __('Enter sale price if this product is on discount. Remove to disable') }}</small>
                              </label>
                              <input class="form-control" type="text" value="{{ old('product_salePrice') }}" placeholder="Sale Price" name="product_salePrice">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group tags custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('Shipping') }}</span>
                              <small class="d-block mt-2">{{ __('Enter shipping locations. State or country. Remove to disable shipping.') }}</small>
                              </label>
                              <div class="form-control-wrap">
                                 <input class="form-control" type="text" class="form-control form-control-lg custom-tags" placeholder="{{ __('Product shipping') }}" value="{{ old('product_shipping') }}" name="product_shipping">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mt-5 mt-lg-2">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4"><span>{{ __('Product Condition') }}</span></label>
                              <div class="form-control-wrap">
                                 <select class="form-control custom-select" data-search="off" data-ui="lg" name="product_condition">
                                    <option value="none"> {{ __('None') }} </option>
                                    <option value="new"> {{ __('New') }} </option>
                                    <option value="used"> {{ __('Used') }}</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mt-3 mt-lg-2 p-3">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4"><span>{{ __('Product Categories') }}</span></label>
                              <div class="form-control-wrap mt-3">
                                 <select class="form-control custom-select" data-search="off" data-ui="lg" name="product_categories[]" multiple>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->slug }}"> {{ $item->title }} </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 col-md-6">
                           <div class="section-head my-5">
                              <p>{{ __('Product Images') }}</p>
                           </div>
                           <div class="card border-0 card-shadow custom-input-uploader">
                              <div class="card-body py-3 px-3">
                                 <div class="card-title d-none">Upload your file here</div>
                                 <div class="card-subtitle py-3">{{ __('The maximum file size is ') . settings('user.products_image_size') . 'MB' }}</div>
                                 <div class="file-upload mt-0">
                                    <input class="file-input uploader_input" name="media[]" multiple="" type="file">
                                    <img src="{{ url('media/misc/upload-image-placeholder.svg') }}" class="mb-3 h-73px" alt="">
                                    <div class="card-subtitle">{{ __('Drag n Drop your file here') }} <br> <span>{{ __('maximum image is') }} <b>{{ settings('user.products_image_limit') }}</b></span></div>
                                    <div class="list-files w-100 mt-4">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mt-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-5"><span>{{ __('Product Description') }}</span></label>
                              <textarea class="form-control editor b-0" name="product_description" placeholder="Write a description">{{ old('product_description') }}</textarea>
                           </div>
                        </div>
                     </div>


                     <div class="row mt-5">
                       <div class="col-6"></div>
                       <div class="col-6">
                         <a class="btn btn-secondary btn-block rounded-8 scale btn_sm_primary" id="pills-inventory-tab" data-toggle="pill" href="#pills-inventory" role="tab"
                        aria-controls="pills-inventory" aria-selected="true">{{ __('Next') }}</a>
                       </div>
                     </div> 
                  </div>
                  <div class="tab-pane fade" id="pills-inventory" role="tabpanel" aria-labelledby="pills-inventory-tab">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('Product Stock') }}</span>
                              <small class="d-block mt-2">{{ __('Enter available stock. Leave empty to disable.') }}</small>
                              </label>
                              <input class="form-control" type="text" placeholder="Product Stock" name="product_stock" value="{{ old('product_stock') }}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('Stock Management') }}</span>
                              <small class="d-block mt-2">{{ __('Choose the way you want our platform to manage your stock') }}</small>
                              </label>
                              <select class="form-select custom-select" name="manage_stock" data-search="off" data-ui="lg">
                                 <option value="0">{{ __('Dont manage stock') }}</option>
                                 <option value="1">{{ __('Manage stock') }}</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('Stock Status') }}</span>
                              <small class="d-block mt-2">{{ __('Choose if stock is available or not') }}</small>
                              </label>
                              <select class="form-select custom-select" name="stock_status" data-search="off" data-ui="lg">
                                 <option value="1">{{ __('In Stock') }}</option>
                                 <option value="0">{{ __('Out of stock') }}</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('Product Sku') }}</span>
                              <small class="d-block mt-2">{{ __('Enter product sku') }}</small>
                              </label>
                              <input class="form-control" type="text" placeholder="{{ __('Product Sku') }}" name="product_sku" value="{{ old('product_sku') }}">
                           </div>
                        </div>
                     </div>
                     <div class="row mt-5">
                       <div class="col-6">
                         <a class="btn bg-skuy c-white btn-block rounded-8 scale btn_sm_primary" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab"
                        aria-controls="pills-general" aria-selected="true">{{ __('Prev') }}</a>
                       </div>
                       <div class="col-6">
                         <a class="btn btn-secondary btn-block rounded-8 scale btn_sm_primary" id="pills-options-tab" data-toggle="pill" href="#pills-options" role="tab"
                        aria-controls="pills-options" aria-selected="true">{{ __('Next') }}</a>
                       </div>
                     </div> 
                  </div>
                  <div class="tab-pane fade" id="pills-options" role="tabpanel" aria-labelledby="pills-options-tab">
                     <div class="col-12">
                        <div class="nk-tb-list po-wrap is-separate is-medium mb-3"></div>
                        <a class="btn scale btn_sm_primary bg-blue c-white effect-letter rounded-8 po-add-button">{{ __('Add New Option') }}</a>
                     </div>

                     <div class="row mt-5">
                       <div class="col-6">
                         <a class="btn bg-skuy c-white btn-block rounded-8 scale btn_sm_primary" id="pills-inventory-tab" data-toggle="pill" href="#pills-inventory" role="tab"
                        aria-controls="pills-inventory" aria-selected="true">{{ __('Prev') }}</a>
                       </div>
                       <div class="col-6">
                         <a class="btn btn-secondary btn-block rounded-8 scale btn_sm_primary" id="pills-others-tab" data-toggle="pill" href="#pills-others" role="tab"
                        aria-controls="pills-others" aria-selected="true">{{ __('Next') }}</a>
                       </div>
                     </div> 
                  </div>
                  <div class="tab-pane fade" id="pills-others" role="tabpanel" aria-labelledby="pills-others-tab">
                     <div class="row">
                        <div class="col-12 col-md-6">
                           <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                           <span>{{ __('Downloadable Product *optional') }}</span>
                           <small class="d-block mt-2">{{ __('Enter item to be download when this product is purchased') }}</small>
                           </label>
                           <div class="card border-0 card-shadow custom-input-uploader">
                              <div class="card-body py-3 px-3">
                                 <div class="card-title d-none">Upload your file here</div>
                                 <div class="file-upload mt-0">
                                    <input class="file-input uploader_input" name="downloadables" type="file">
                                    <img src="{{ url('media/misc/upload-image-placeholder.svg') }}" class="mb-3 h-73px" alt="">
                                    <div class="card-subtitle">{{ __('Drag n Drop your file here') }}</div>
                                    <div class="list-files w-100 mt-4">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('External Product Url *optional') }}</span>
                              <small class="d-block mt-2">{{ __('Link to your external product page') }}</small>
                              </label>
                              <input class="form-control" type="text" placeholder="Url" name="external_url">
                           </div>
                           <div class="form-group custom mb-4">
                              <label class="muted-deep fw-normal form-label fw-normal ml-2 mb-4">
                              <span>{{ __('External Product Site *optional') }}</span>
                              <small class="d-block mt-2">{{ __('Enter name of external product site') }}</small>
                              </label>
                              <input class="form-control" type="text" placeholder="Ex: Amazon" name="external_url_name">
                           </div>
                        </div>
                     </div>
                     <div class="row mt-5">
                       <div class="col-6">
                         <a class="btn bg-skuy c-white btn-block rounded-8 scale btn_sm_primary" id="pills-options-tab" data-toggle="pill" href="#pills-options" role="tab"
                        aria-controls="pills-options" aria-selected="true">{{ __('Prev') }}</a>
                       </div>
                       <div class="col-6">
                         <button class="btn btn_sm_primary bg-blue c-white btn-block rounded-8 scale">{{ __('Save Product') }}</button>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </form>
</div>
<div class="po-val-field-add d-none">
   <div class="exp-line-list p-0 bg-white mt-4 py-2 px-2 radius-7 mb-3 scroll-content po-val-item" data-poval-name="values">
      <input type="hidden" data-poval-name="id" class="option-values-id">
      <div class="exp-line mb-0 p-0">
         <div class="form-group text-sticker full bg-clighter radius-5 py-2 h-120px">
            <label class="muted-deep fw-normal m-2">{{ __('Label') }}</label>
            <input type="text" data-poval-name="label" class="form-control bg-clighter" placeholder="{{ __('Type here') }}">
         </div>
         <div class="form-group text-sticker radius-5 py-2 h-120px bg-clighter">
            <label class="muted-deep fw-normal m-2">{{ __('Price') }}</label>
            <input type="number" data-poval-name="price" class="form-control bg-clighter" placeholder="{{ __('Type here') }}">
         </div>
         <div class="d-flex ml-auto">
            <a data-route="{{ route('user-remove-product-option-value') }}" class="btn bg-danger text-sticker text-white option-remove">
            <i class="tio delete"></i>
            {{ __('Delete') }}
            </a>
         </div>
      </div>
   </div>
</div>
<div class="po-field-add d-none">
   <div class="widget-box h-100 no-padding po-item mb-4" data-poname="options">
      <input type="hidden" data-po-name="id">
      <div class="widget-box-content h-100 small-margin-top padded-for-scroll small">
         <div class="exp-line-list bg-clighter py-2 px-2 radius-7 mb-3 scroll-content">
            <div class="exp-line mb-0 p-0">
               <p class="text-sticker small-text full mb-0" hidden></p>
               <div class="form-group text-sticker radius-5 full py-2 h-120px">
                  <label class="muted-deep fw-normal m-2">{{ __('Name') }}</label>
                  <input type="text" name="" data-po-name="name" placeholder="{{ __('Ex: Size') }}" class="form-control">
               </div>
               <div class="text-sticker form-group radius-5 py-2 h-120px">
                  <label class="muted-deep fw-normal m-2">{{ __('Type') }}</label>
                  <select data-po-name="type" class="form-control custom-select">
                     <option>
                        {{ __('Please Select') }}
                     </option>
                     <optgroup label="Select">
                        <option value="dropdown">
                           {{ __('Dropdown') }}
                        </option>
                        <option value="checkbox">
                           {{ __('Checkbox') }}
                        </option>
                        <option value="radio">
                           {{ __('Radio Button') }}
                        </option>
                        <option value="color">
                           {{ __('Color Button') }}
                        </option>
                        <option value="multiple_select">
                           {{ __('Multiple Select') }}
                        </option>
                     </optgroup>
                  </select>
               </div>
               <div class="text-sticker form-group radius-5 py-2 h-120px">
                  <div class="h-100 d-flex align-items-center">
                     <div class="custom-control custom-control-alternative custom-checkbox">
                        <input type="hidden" data-po-name="required" value="0">
                        <input class="custom-control-input" type="checkbox" data-po-name="required" id="required" value="1">
                        <label class="custom-control-label" for="required">
                        <span class="text-muted">{{ __('Required') }}</span>
                        </label>
                     </div>
                  </div>
               </div>
               <div class="d-flex ml-auto">
                  <a data-route="{{ route('user-remove-product-option') }}" class="text-white bg-danger remove text-sticker">
                  <i class="tio delete"></i>
                  {{ __('Delete') }}
                  </a>
               </div>
            </div>
            <div class="px-2 px-lg-5 po-val-wrap">
            </div>
         </div>
      </div>
      <a class="btn scale btn_sm_primary bg-blue c-white effect-letter rounded-8 mx-3 my-4 po-val-add-button">{{ __('Add New Row') }}</a>
   </div>
</div>
@stop
