@extends('layouts.admin')
@section('title', __('global.help'))
@section('content')
    <div class="card">
        <div class="card-header"><span style="font-size:1.25rem; cursor:pointer" onclick="window.location.href='{{ url('inventory/items') }}'">&#9776;</span> {{ __('global.menu.inventory.title') }}: - {{ __('global.help') }}</div>
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-details-tab" data-bs-toggle="pill" data-bs-target="#v-pills-details" type="button" role="tab" aria-controls="v-pills-details" aria-selected="true">details</button>
                  <button class="nav-link mt-2" id="v-pills-price-tab" data-bs-toggle="pill" data-bs-target="#v-pills-price" type="button" role="tab" aria-controls="v-pills-price" aria-selected="false">price</buttona>
                  <button class="nav-link mt-2" id="v-pills-options-tab" data-bs-toggle="pill" data-bs-target="#v-pills-options" type="button" role="tab" aria-controls="v-pills-options" aria-selected="false">options</button>
                  <button class="nav-link mt-2" id="v-pills-levels-tab" data-bs-toggle="pill" data-bs-target="#v-pills-levels" type="button" role="tab" aria-controls="v-pills-levels" aria-selected="false">levels</button>
                  <button class="nav-link mt-2" id="v-pills-images-tab" data-bs-toggle="pill" data-bs-target="#v-pills-images" type="button" role="tab" aria-controls="v-pills-images" aria-selected="false">images</button>
                  <button class="nav-link mt-2" id="v-pills-activities-tab" data-bs-toggle="pill" data-bs-target="#v-pills-activities" type="button" role="tab" aria-controls="v-pills-activities" aria-selected="false">activities</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab">
                      <h5>Details </h5>
                            <p>The form is self explanitory and not complicated to process:- <a href="{{ asset('images/help/inventory/details.JPG') }}" target="_blank">Image</a> -:<span  class="text-danger">required fields</span></p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-3">Fields</th>
                                            <th class="col-9">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-danger">{{ __('inventory_items.fields.item_code') }}</td>
                                            <td>The code your company use for this item, it will usually be the supplier code.</td>
                                        </tr>
                                        <tr>
                                            <td class="text-danger">{{ __('inventory_items.fields.description') }}</td>
                                            <td>The name of the product</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.dictation') }}</td>
                                            <td>Not Required, but always good practice to have a description of the product and vital if <b>Attela</b> is linked to your website</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.keywords') }}</td>
                                            <td>Not Required, but always good practice to have a keywords to describe the product and vital if <b>Attela</b> is linked to your website</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.tags') }}</td>
                                            <td>Not Required, but always good practice to have a tags to describe the product and vital if <b>Attela</b> is linked to your website</td>
                                        </tr>
                                        <tr>
                                            <td class="text-danger">{{ __('inventory_items.fields.category_id') }}</td>
                                            <td>Categories should be selected and if it does not exist, you could simply add it, it's vital if <b>Attela</b> is linked to your website</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.barcode') }}</td>
                                            <td>Not Required, but always good practice to have a barcode especially if you use scanners</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.isbn_number') }}</td>
                                            <td>Not Required, but always good practice to have a ISBN number assosicated with your product.</td>
                                        </tr>
                                        <tr>
                                            <td class="text-danger">{{ __('inventory_items.fields.unit') }}</td>
                                            <td>The unit is required for purchasing and selling, if it does not exist, you could simply add it.</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.commodity_code') }}</td>
                                            <td>Not Required but some comapnies like to link items together and this is the place for the code.</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.nett_mass_gram') }}</td>
                                            <td>Not Required but extremly important if you send items to your customers. It will be added to the total weigt of the order and allow you to calculate delivery cost.</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.is_service') }}</td>
                                            <td>If the item is a service it will not be deducted from stock on hand.</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.allow_tax') }}</td>
                                            <td>Very important if you are a VAT vendor.</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.purchase_tax_type') }}</td>
                                            <td>Very important if you are a VAT vendor.</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.sales_tax_type') }}</td>
                                            <td>Very important if you are a VAT vendor.</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.is_fixed_description') }}</td>
                                            <td>Can the descriptin be changed on an acounting document?</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.sales_commission_item') }}</td>
                                            <td>Should this item be added to calculate sales commision</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('inventory_items.fields.is_active') }}</td>
                                            <td>If the item is listed is not active you will not be able to sell it.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            {{--  </div>
                        </div>--}}
                      </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-price" role="tabpanel" aria-labelledby="v-pills-price-tab"><h5>Prices </h5>
                    <p>The form is self explanitory and not complicated to process. You have a multitude of price options and can assign a price list to a customer. You also have the option of running a special price on an item for a limited time.:- 
                        <a href="{{ asset('images/help/inventory/price_1.JPG') }}" target="_blank">Image1</a> 
                        <a href="{{ asset('images/help/inventory/price_2.JPG') }}" target="_blank">Image2</a> 
                        -:<span  class="text-danger">required fields</span></p>
                        <p>By clicking on the Action select you can Copy, Edit, Delete an item</p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-3">Fields</th>
                                    <th class="col-9">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-danger">{{__('inventory_prices.fields.store_id')}}</td>
                                    <td>Every store can have it's own price for the same item. You will not be allowed to add more than one price of the same item to the same store.</td>
                                </tr>
                                <tr>
                                    <td>{{__('inventory_prices.fields.cost_price')}}</td>
                                    <td>Not Required but neccecary if you want you are using the acconting module to determine profit and loss</td>
                                </tr>
                                <tr>
                                    <td class="text-danger">{{__('inventory_prices.fields.retail')}}</td>
                                    <td>Every item must have a retail price wich is the base price. If a customer is on a different price list and the price is empty, it will default to the retail price list.</td>
                                </tr>
                                <tr>
                                    <td>{{__('inventory_prices.fields.dealer')}}, {{__('inventory_prices.fields.whole_sale')}}, {{__('inventory_prices.fields.price_list1')}}, {{__('inventory_prices.fields.price_list2')}}, {{__('inventory_prices.fields.price_list3')}}, {{__('inventory_prices.fields.price_list4')}}, {{__('inventory_prices.fields.price_list5')}}</td>
                                    <td>These prices are optional and not required. It gives you the flexability to be creative in price negoriations.</td>
                                </tr>
                                <tr>
                                    <td>{{__('inventory_prices.fields.special')}}</td>
                                    <td>The special price will override any price if the {{__('inventory_prices.fields.special')}} is lower.</td>
                                </tr>
                                <tr>
                                    <td>{{__('inventory_prices.fields.special_from')}}, {{__('inventory_prices.fields.special_to')}}</td>
                                    <td>The date from start to finish for the special price. it can be set in the future when planning a sal and will expire the moment the {{__('inventory_prices.fields.special_to')}} time has been reached.</td>
                                </tr>
                                </tr>
                            </tbody>
                        </table></div>
                    </div>
                  <div class="tab-pane fade" id="v-pills-options" role="tabpanel" aria-labelledby="v-pills-options-tab">
                    <p>The form is self explanitory and not complicated to process. Options are addon's for the item and can have any value. The value will be added to the customers price:- 
                        <a href="{{ asset('images/help/inventory/options_1.JPG') }}" target="_blank">Image1</a> 
                        <a href="{{ asset('images/help/inventory/options_2.JPG') }}" target="_blank">Image2</a> 
                        -:<span  class="text-danger">required fields</span></p>
                        <p>By clicking on the Action select you can Edit and Delete an option</p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-3">Fields</th>
                                    <th class="col-9">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-danger">{{__('inventory_options.fields.name')}}</td>
                                    <td>Name of the addon</td>
                                </tr>
                                <tr>
                                    <td class="text-danger">{{__('inventory_options.fields.value')}}</td>
                                    <td>Value of the addon</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-levels" role="tabpanel" aria-labelledby="v-pills-levels-tab">
                    <p>The form is self explanitory and not complicated to process. Levels can only be set once per item per store, any additional changes will have to be recorded in the activities tab:- 
                        <a href="{{ asset('images/help/inventory/level_1.JPG') }}" target="_blank">Image1</a> 
                        <a href="{{ asset('images/help/inventory/level_2.JPG') }}" target="_blank">Image2</a> 
                        -:<span  class="text-danger">required fields</span></p>
                        <p>By clicking on the Action select you can Edit and Delete an option</p>
                        <p>When editing you will only be allowed to change the {{__('inventory_levels.fields.min_order_level')}} and {{__('inventory_levels.fields.min_order_quantity')}}</p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-3">Fields</th>
                                    <th class="col-9">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-danger">{{__('inventory_levels.fields.store_id')}}</td>
                                    <td>This field is required</td>
                                </tr>
                                <tr>
                                    <td class="text-danger">{{__('inventory_levels.fields.on_hand')}}</td>
                                    <td>This field is required and must reflect the correct amount</td>
                                </tr>
                                <tr>
                                    <td>{{__('inventory_levels.fields.min_order_level')}}</td>
                                    <td>Not Required but will assist you in running out of the item.</td>
                                </tr>
                                <tr>
                                    <td>{{__('inventory_levels.fields.min_order_quantity')}}</td>
                                    <td>Not Required but will assist you when reordering the item.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  
                  </div>
                  <div class="tab-pane fade" id="v-pills-images" role="tabpanel" aria-labelledby="v-pills-images-tab">
                      <p>The form is self explanitory and not complicated to process. Images should be made for hte browser so that it loads fast, althou we do allow up to 1MB per image but your user experiance will be terrable:- 
                          <p>You are limited 5 images per item.</p>
                    <a href="{{ asset('images/help/inventory/image_1.JPG') }}" target="_blank">Image1</a> 
                    <a href="{{ asset('images/help/inventory/image_2.JPG') }}" target="_blank">Image2</a> 
                    -:<span  class="text-danger">required fields</span></p>
                    <p>By clicking on the Action select you can Edit and Delete an option</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-3">Fields</th>
                                <th class="col-9">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-danger">{{__('inventory_images.fields.image')}}</td>
                                <td>The uploaded file</td>
                            </tr>
                            <tr>
                                <td class="text-danger">{{__('inventory_images.fields.sort_order')}}</td>
                                <td>The sort order you want them to display. It is only applicable when you are integrating <b>Attela</b> with your website.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                        </div>
                  <div class="tab-pane fade" id="v-pills-activities" role="tabpanel" aria-labelledby="v-pills-activities-tab">
                    <p>The form is self explanitory and not complicated to process. Activities is the core of any item and will show every action on an item:- 
                        
                  <a href="{{ asset('images/help/inventory/image_1.JPG') }}" target="_blank">Image1</a> 
                  <a href="{{ asset('images/help/inventory/image_2.JPG') }}" target="_blank">Image2</a> 
                  -:<span  class="text-danger">required fields</span></p>
                  <p>You can only add records to an item.</p>
              <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th class="col-3">Fields</th>
                              <th class="col-9">Description</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td class="text-danger">{{__('inventory_activities.fields.action_date')}}</td>
                              <td>Action date is the date the action occured</td>
                          </tr>
                          <tr>
                              <td class="text-danger">{{__('inventory_activities.fields.action')}}</td>
                              <td>Action would mostly be adjusment as the system takes care of the rest.</td>
                          </tr>
                          <tr>
                              <td>{{__('inventory_activities.fields.document_reference')}}</td>
                              <td>Not Required, but is usfull to have a reason for the action</td>
                          </tr>
                          <tr>
                              <td class="text-danger">{{__('inventory_activities.fields.store_id')}}</td>
                              <td>The particular store</td>
                          </tr>
                          <tr>
                              <td class="text-danger">{{__('inventory_activities.fields.down')}}, {{__('inventory_activities.fields.up')}}</td>
                              <td>Only one of these fields are Required.</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
                  </div>
                </div>
              </div>
              
        </div>
    </div>
@endsection