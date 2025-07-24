@extends('admin.includes.Template')
@section('content')
<style type="text/css">
    ul li{list-style: inherit;}
</style>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Package Order - Cleaning</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Package Order - Cleaning</a></li>
                        <li class="breadcrumb-item active">Add Package Order - Cleaning</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div id="validator" class="alert alert-danger alert-dismissable" style="display:none;">
            <i class="fa fa-warning"></i>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert"></button> -->
            <b>Error &nbsp;: </b><span id="error_msg1"></span>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Basic Info</h4> -->

                        <form action="{{ route('cleaning-order-store') }}" method="POST" id="form"
                            enctype="multipart/form-data">
                            @csrf
                    <input type="hidden" name="service_charge" id="service_charge" value="0">
                    <input type="hidden" name="sub_total" id="sub_total" value="0">
                    <input type="hidden" name="vat_charge" id="vat_charge" value="0">
                    <input type="hidden" name="order_total" id="order_total" value="0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <select id="customer_id" name="customer_id" class="form-control form-select">
                                            <option value="">Select Customer Name</option>
                                            @foreach ($customer_data as $item)
                                                <option value="{{ $item->id }}">{{ $item->id }}-{{ $item->name }}-{{ $item->email }}</option>
                                            @endforeach
                                        </select>
                                        <p class="form-error-text" id="customer_name_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subservice</label>
                                        <select id="subservice_id" name="subservice_id" class="form-control form-select">
                                            <option value="">Select Subservice</option>
                                            @foreach ($subservice_data as $item)
                                                <option value="{{ $item->id }}">{{ $item->subservicename }}</option>
                                            @endforeach
                                        </select>
                                        <p class="form-error-text" id="subservice_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>
                            
                            <div class="home_cleaning_form" style="display: none;">
                                <h4>Service Details : </h4>
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>How many hours your cleaner will stay ?</label>
                                        <select id="hour_value" name="hour_value" class="form-control form-select">
                                            <option value="">Select Cleaning Hour Value</option>
                                            @foreach ($cleanin_subserviceprice as $key => $data)
                                            <option value="{{ $data->hour_value }}" {{ $key === 0 ? 'selected' : '' }}>
                                                {{ $data->hour_value }}
                                            </option>
                                        @endforeach
                                        

                                        </select>
                                        <p class="form-error-text" id="hour_value_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cleaner Charge Per Hour</label>
                                        <input type="number" name="cleaner_charge" id="cleaner_charge" class="form-control"
                                            placeholder="Enter Cleaner Charge Per Hour">
                                        <p class="form-error-text" id="cleaner_charge_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>How many cleaners do you require ?</label>
                                        <select id="how_many_cleaner" name="how_many_cleaner" class="form-control form-select">
                                            <option value="">Select Cleaners</option>
                                            <option value="1" selected> 1 </option>
                                            <option value="2"> 2 </option>
                                            <option value="3"> 3 </option>
                                            <option value="4"> 4 </option>
                                            <option value="5"> 5 </option>
                                            <option value="6"> 6 </option>
                                        </select>
                                        <p class="form-error-text" id="how_many_cleaner_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>How often do you need cleaning ?</label>
                                        <select id="how_often_you_need" name="how_often_you_need" class="form-control form-select">
                                            <option value="">Select how often do you need</option>
                                            <option value="Once"> Once</option>
                                            <option value="Weekly"> Weekly</option>
                                            <option value="Multiple times a week"> Multiple Times a Week</option>
                                        </select>
                                        <p class="form-error-text" id="how_often_you_need_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4" id="which_day_you_want_div" style="display: none;">
                                    <div class="form-group">
                                        <label>Which days of the week do you want the service ?</label>
                                        <select id="which_day_you_want" name="which_day_you_want[]" class="form-control form-select" multiple="multiple">
                                            <option value="">Select which days you want service</option>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>
                                            <option value="sunday">Sunday</option>
                                        </select>
                                        <p class="form-error-text" id="which_day_you_want_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Need cleaning materials ?</label>
                                        <select id="need_cleaning_material" name="need_cleaning_material" class="form-control form-select">
                                            <option value="">Select Cleaning Materials</option>
                                            <option value="Yes"> Yes</option>
                                            <option value="No"> No</option>
                                        </select>
                                        <p class="form-error-text" id="need_cleaning_material_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-md-4" id="cleaning_material_charge_div" style="display: none;">
                                    <div class="form-group">
                                        <label>Cleaning Materials Charge Per Hour</label>
                                        <input type="text" name="cleaning_material_charge" id="cleaning_material_charge" class="form-control"
                                            placeholder="Enter Cleaning Material Charge" value="0">
                                        <p class="form-error-text" id="cleaning_material_charge_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="special_instruction" style="margin:15px 0 5px 0px; width:100%;">
                                            Do you have any special instructions</label>
                                        <textarea id="special_instruction" name="special_instruction" class="form-control" placeholder="Enter Special Instruction"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="add_to_cart" style="display: none;">
                            <h4>Service Details : </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Your Package Category</label>
                                    <div id="package_category_change">
                                    <select id="package_category" name="package_category[]" class="form-control form-select"  onchange="get_package();" multiple="multiple">
                                        <option value="">Select Package Category</option>
                                    </select>
                                    </div>
                                    <p class="form-error-text" id="package_category_error" style="color: red; margin-top: 10px;"></p>
                                </div>
                            </div>

                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Your Package</label>
                                    <div id="package_change"> 
                                    <select id="package" name="package[]" class="form-control form-select" multiple="multiple">
                                        <option value="">Select Package</option>
                                    </select>
                                    </div>
                                    <p class="form-error-text" id="package_error" style="color: red; margin-top: 10px;"></p>
                                </div>
                            </div>
                            <div id="package_quantity_price_div" style="display: none;">
                                <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Enter Package Quantity</label>
                                        <input type="number" name="package_quantity" id="package_quantity" class="form-control"
                                            placeholder="Enter Your Quantity">
                                        <p class="form-error-text" id="package_quantity_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Enter Package Price</label>
                                        <input type="number" name="package_price" id="package_price" class="form-control"
                                            placeholder="Enter Your Quantity">
                                        <p class="form-error-text" id="package_price_error" style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                       <h4>Scheduling Your Service : </h4>
                        <div class="col-md-4" id="cleaner_div">
                            <div class="form-group">
                                <label>Select your Preferred cleaner</label>
                                <div id="cleaner_change">
                                <select id="cleaner" name="cleaner" class="form-control form-select" onchange="cleaner_on_change();">
                                    <option value="">Select Preferred Cleaner</option>
                                </select>
                                </div>
                                <p class="form-error-text" id="cleaner_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>When would you like your service ?</label>
                                <input type="date" name="service_date" id="service_date" class="form-control"
                                    placeholder="Enter Service Date">
                                <p class="form-error-text" id="service_date_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="time_slot_change">
                                <label>What time would you like us to start ?</label>
                                <div id="time_slot_change"> 
                               <select id="time_slot" name="time_slot" class="form-control form-select" onchange="time_slot_on_change();">
                                    <option value="">Select Time Slot</option>
                                    
                                </select>
                                </div>
                            </div>
                                <p class="form-error-text" id="time_slot_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date Charge</label>
                                <input type="text" name="date_charge" id="date_charge" class="form-control"
                                    placeholder="Enter Date Charge" value="0">
                                <p class="form-error-text" id="date_charge_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Timing Charge</label>
                                <input type="text" name="timing_charge" id="timing_charge" class="form-control"
                                    placeholder="Enter Timing Charge" value="0">
                                <p class="form-error-text" id="timing_charge_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Service Fee</label>
                                <input type="text" name="service_fee" id="service_fee" class="form-control"
                                    placeholder="Enter Service Fee" value="0">
                                <p class="form-error-text" id="service_fee_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cash On Delivery Charge</label>
                                <input type="text" name="cod_charge" id="cod_charge" class="form-control"
                                    placeholder="Enter Cash On Delivery Charge" value="0">
                                <p class="form-error-text" id="cod_charge_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <h4>Your Location : </h4>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Where would you like your service ?</label>
                                <select id="address_type" name="address_type" class="form-control form-select">
                                    <option value="">Select Your Address</option>
                                    <option value="home" selected>Home</option>
                                    <option value="office">Office</option>
                                    <option value="other">Other</option>
                                </select>
                                <p class="form-error-text" id="address_type_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Your City</label>
                                <select id="city" name="city" class="form-control form-select">
                                    <option value="">Select Your City</option>
                                    <option value="Dubai" selected>Dubai</option>
                                    <option value="Abu Dhabhi">Abu Dhabhi</option>
                                    <option value="Sharjah">Sharjah</option>
                                </select>
                                <p class="form-error-text" id="city_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Your Area</label>
                                <input type="text" name="area" id="area" class="form-control"
                                    placeholder="Enter Your Area">
                                <p class="form-error-text" id="area_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Your Building Name</label>
                                <input type="text" name="building_name" id="building_name" class="form-control"
                                    placeholder="Enter Your Building name and/or street">
                                <p class="form-error-text" id="building_name_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Your Apartment or Villa Number</label>
                                <input type="text" name="apartment_villa_num" id="apartment_villa_num" class="form-control"
                                    placeholder="Enter Your Apartment number & floor or Villa Number">
                                <p class="form-error-text" id="apartment_villa_num_error" style="color: red; margin-top: 10px;"></p>
                            </div>
                        </div>
                  </div>
                            <div class="text-end mt-4">
                                <a href="{{ route('cleaning_package_order') }}" class="btn btn-primary text-light">Cancel</a>
                                <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                                    style="display: none;">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                                <button type="button" onclick="validation();" id="submit_button"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script>
        function validation() {
            var customer_id = jQuery("#customer_id").val();
               if (customer_id == '') {
                   jQuery('#customer_name_error').html("Please Select Customer Name");
                   jQuery('#customer_name_error').show().delay(0).fadeIn('show');
                   jQuery('#customer_name_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#customer_id').offset().top - 150
                   }, 1000);
                   return false;
               }

            var subservice_id = jQuery("#subservice_id").val();
               if (subservice_id == '') {
                   jQuery('#subservice_error').html("Please Select Subservice");
                   jQuery('#subservice_error').show().delay(0).fadeIn('show');
                   jQuery('#subservice_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#subservice_id').offset().top - 150
                   }, 1000);
                   return false;
               }
            var subservice_id = $("#subservice_id").val();
            if(subservice_id == 28){

            var hour_value = jQuery("#hour_value").val();
               if (hour_value == '') {
                   jQuery('#hour_value_error').html("Please Select Cleaning Hour Value");
                   jQuery('#hour_value_error').show().delay(0).fadeIn('show');
                   jQuery('#hour_value_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#hour_value').offset().top - 150
                   }, 1000);
                   return false;
               }

            var cleaner_charge = jQuery("#cleaner_charge").val();
               if (cleaner_charge == '') {
                   jQuery('#cleaner_charge_error').html("Please Enter Cleaner Charge Per Hour");
                   jQuery('#cleaner_charge_error').show().delay(0).fadeIn('show');
                   jQuery('#cleaner_charge_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#cleaner_charge').offset().top - 150
                   }, 1000);
                   return false;
               }

            var how_many_cleaner = jQuery("#how_many_cleaner").val();
               if (how_many_cleaner == '') {
                   jQuery('#how_many_cleaner_error').html("Please Select How many cleaners do you require");
                   jQuery('#how_many_cleaner_error').show().delay(0).fadeIn('show');
                   jQuery('#how_many_cleaner_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#how_many_cleaner').offset().top - 150
                   }, 1000);
                   return false;
               }

            var how_often_you_need = jQuery("#how_often_you_need").val();
               if (how_often_you_need == '') {
                   jQuery('#how_often_you_need_error').html("Please Select How Often Do You Need Cleaning");
                   jQuery('#how_often_you_need_error').show().delay(0).fadeIn('show');
                   jQuery('#how_often_you_need_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#how_often_you_need').offset().top - 150
                   }, 1000);
                   return false;
               }
               if(how_often_you_need == 'Multiple times a week'){
                   var which_day_you_want = jQuery("#which_day_you_want").val();
                   if (which_day_you_want == '') {
                       jQuery('#which_day_you_want_error').html("Please Select Which days of the week do you want the service");
                       jQuery('#which_day_you_want_error').show().delay(0).fadeIn('show');
                       jQuery('#which_day_you_want_error').show().delay(2000).fadeOut('show');
                       $('html, body').animate({
                           scrollTop: $('#which_day_you_want').offset().top - 150
                       }, 1000);
                       return false;
                   }
               }

               var need_cleaning_material = jQuery("#need_cleaning_material").val();
               if (need_cleaning_material == '') {
                   jQuery('#need_cleaning_material_error').html("Please Select Need Cleaning Materials");
                   jQuery('#need_cleaning_material_error').show().delay(0).fadeIn('show');
                   jQuery('#need_cleaning_material_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#need_cleaning_material').offset().top - 150
                   }, 1000);
                   return false;
               }

               if(need_cleaning_material === 'Yes'){
               var cleaning_material_charge = jQuery("#cleaning_material_charge").val();
               if (cleaning_material_charge == '') {
                   jQuery('#cleaning_material_charge_error').html("Please Enter Cleaning Materials Charge");
                   jQuery('#cleaning_material_charge_error').show().delay(0).fadeIn('show');
                   jQuery('#cleaning_material_charge_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#cleaning_material_charge').offset().top - 150
                   }, 1000);
                   return false;
               }
            }
            }else{
                var package_category = jQuery("#package_category").val();
               if (package_category == '') {
                   jQuery('#package_category_error').html("Please Select Package Category");
                   jQuery('#package_category_error').show().delay(0).fadeIn('show');
                   jQuery('#package_category_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#package_category').offset().top - 150
                   }, 1000);
                   return false;
               }

               var package = jQuery("#package").val();
               if (package == '') {
                   jQuery('#package_error').html("Please Select Package");
                   jQuery('#package_error').show().delay(0).fadeIn('show');
                   jQuery('#package_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#package').offset().top - 150
                   }, 1000);
                   return false;
               }

               var package_quantity = jQuery("#package_quantity").val();
               if (package_quantity == '') {
                   jQuery('#package_quantity_error').html("Please Enter Package Quantity");
                   jQuery('#package_quantity_error').show().delay(0).fadeIn('show');
                   jQuery('#package_quantity_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#package_quantity').offset().top - 150
                   }, 1000);
                   return false;
               }

               var package_price = jQuery("#package_price").val();
               if (package_price == '') {
                   jQuery('#package_price_error').html("Please Enter Package Price");
                   jQuery('#package_price_error').show().delay(0).fadeIn('show');
                   jQuery('#package_price_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#package_price').offset().top - 150
                   }, 1000);
                   return false;
               }

            }
          
            if (how_many_cleaner == 1 ) {
            var cleaner = jQuery("#cleaner").val();
               if (cleaner == '') {
                   jQuery('#cleaner_error').html("Please Select Cleaner");
                   jQuery('#cleaner_error').show().delay(0).fadeIn('show');
                   jQuery('#cleaner_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#cleaner').offset().top - 150
                   }, 1000);
                   return false;
               }
            }

               var service_date = jQuery("#service_date").val();
               if (service_date == '') {
                   jQuery('#service_date_error').html("Please Select Service Date");
                   jQuery('#service_date_error').show().delay(0).fadeIn('show');
                   jQuery('#service_date_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#service_date').offset().top - 150
                   }, 1000);
                   return false;
               }

               var date_charge = jQuery("#date_charge").val();
               if (date_charge == '') {
                   jQuery('#date_charge_error').html("Please Enter Date Charge");
                   jQuery('#date_charge_error').show().delay(0).fadeIn('show');
                   jQuery('#date_charge_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#date_charge').offset().top - 150
                   }, 1000);
                   return false;
               }

               var timing_charge = jQuery("#timing_charge").val();
               if (timing_charge == '') {
                   jQuery('#timing_charge_error').html("Please Enter Timing Charge");
                   jQuery('#timing_charge_error').show().delay(0).fadeIn('show');
                   jQuery('#timing_charge_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#timing_charge').offset().top - 150
                   }, 1000);
                   return false;
               }


               var service_fee = jQuery("#service_fee").val();
               if (service_fee == '') {
                   jQuery('#service_fee_error').html("Please Enter Service Fee");
                   jQuery('#service_fee_error').show().delay(0).fadeIn('show');
                   jQuery('#service_fee_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#service_fee').offset().top - 150
                   }, 1000);
                   return false;
               }

               var cod_charge = jQuery("#cod_charge").val();
               if (cod_charge == '') {
                   jQuery('#cod_charge_error').html("Please Enter Cash On Delivery Charge");
                   jQuery('#cod_charge_error').show().delay(0).fadeIn('show');
                   jQuery('#cod_charge_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#cod_charge').offset().top - 150
                   }, 1000);
                   return false;
               }

               var time_slot = jQuery("#time_slot").val();
               if (time_slot == '') {
                   jQuery('#time_slot_error').html("Please Select Time Slot");
                   jQuery('#time_slot_error').show().delay(0).fadeIn('show');
                   jQuery('#time_slot_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#time_slot').offset().top - 150
                   }, 1000);
                   return false;
               }

               var address_type = jQuery("#address_type").val();
               if (address_type == '') {
                   jQuery('#address_type_error').html("Please Select Address Type");
                   jQuery('#address_type_error').show().delay(0).fadeIn('show');
                   jQuery('#address_type_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#address_type').offset().top - 150
                   }, 1000);
                   return false;
               }

               var city = jQuery("#city").val();
               if (city == '') {
                   jQuery('#city_error').html("Please Select City");
                   jQuery('#city_error').show().delay(0).fadeIn('show');
                   jQuery('#city_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#city').offset().top - 150
                   }, 1000);
                   return false;
               }

               var area = jQuery("#area").val();
               if (area == '') {
                   jQuery('#area_error').html("Please Enter Your Area");
                   jQuery('#area_error').show().delay(0).fadeIn('show');
                   jQuery('#area_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#area').offset().top - 150
                   }, 1000);
                   return false;
               }

               var building_name = jQuery("#building_name").val();
               if (building_name == '') {
                   jQuery('#building_name_error').html("Please Enter Your Building or Street Name ");
                   jQuery('#building_name_error').show().delay(0).fadeIn('show');
                   jQuery('#building_name_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#building_name').offset().top - 150
                   }, 1000);
                   return false;
               }

               var apartment_villa_num = jQuery("#apartment_villa_num").val();
               if (apartment_villa_num == '') {
                   jQuery('#apartment_villa_num_error').html("Please Enter Apartment or Villa Number");
                   jQuery('#apartment_villa_num_error').show().delay(0).fadeIn('show');
                   jQuery('#apartment_villa_num_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#apartment_villa_num').offset().top - 150
                   }, 1000);
                   return false;
               }
            
            // for home cleaning Calculation
            home_cleaning_calculation();

            
            $('#spinner_button').show();
            $('#submit_button').hide();
            $('#form').submit();

        }
       
 

    </script>

<script>
    //For 14 days avaialble for booking
        const today = new Date();
        const futureDate = new Date();
        
        // Set future date to 14 days from today
        futureDate.setDate(today.getDate() + 14);

        // Format dates to YYYY-MM-DD
        const todayStr = today.toISOString().split('T')[0];
        const futureDateStr = futureDate.toISOString().split('T')[0];

        // Set the min and max attributes
        const dateInput = document.getElementById('service_date');
        dateInput.min = todayStr;
        dateInput.max = futureDateStr;
</script>
  
<script>
   $(document).ready(function() {
    $('#how_often_you_need').change(function() {
        var how_often_you_need = $('#how_often_you_need').val();
        if (how_often_you_need === 'Multiple times a week') {
            $('#which_day_you_want_div').show();
            $('#which_day_you_want').select2({
                placeholder: 'Select which days you want service', 
            });
        } else {
            $('#which_day_you_want_div').hide();
            $('#which_day_you_want').val([]).trigger('change'); 
        }
        });

        $('#customer_id').select2({
            placeholder: 'Select Customer Name',
            allowClear: true
        });
        $('#package').select2({
                placeholder: 'Select Packages', // Add your desired placeholder text here
            });
        $('#package_category').select2({
                placeholder: 'Select Package Category', // Add your desired placeholder text here
            });
    });


    //Need Cleaning Material Yes then Material Value element Show

    $('#need_cleaning_material').change(function() {
        var need_cleaning_material = $('#need_cleaning_material').val();
        if (need_cleaning_material === 'Yes') {
            $('#cleaning_material_charge_div').show();
        } else {
            $('#cleaning_material_charge_div').hide();
        }
    });

    //If cleaner more then 1 then cleaner div hide

    $('#how_many_cleaner').change(function() {
        var how_many_cleaner = $('#how_many_cleaner').val();
        if (how_many_cleaner == 1 ) {
            $('#cleaner_div').show();
        } else {
            $('#cleaner_div').hide();
        }
    });
  
 
//On subservice Change the cleaner will change and date & time slot will be empty

     $('#subservice_id').change(function(){
        var subservice_id = $(this).val();

        $('#time_slot').val('');
        $('#service_date').val('');

        if(subservice_id == 28){
            $('.home_cleaning_form').show();
            $('.add_to_cart').hide();
            $('.add_to_cart').find('input, select, textarea').val(''); 
        }else{
            $('.home_cleaning_form').hide();
            $('.add_to_cart').show();
            $('.home_cleaning_form').find('input, select, textarea').val(''); 
        }
      

        var url = '{{ url('get-subservice-cleaners') }}';
        $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "subservice_id": subservice_id
                },
                success: function(msg) {
                    // alert(msg);
                    document.getElementById('cleaner_change').innerHTML = msg;
                }
            });

        var url = '{{ url('get-package-category') }}';
        $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "subservice_id": subservice_id
                },
                success: function(msg) {
                    // alert(msg);
                    document.getElementById('package_category_change').innerHTML = msg;
                    $('#package_category').select2({
                        placeholder: 'Select Package Category', 
                    });
                }
            });
        });

// On hour value change the time slot and service date will be empty
        $('#hour_value').change(function(){
            $('#time_slot').val('');
            $('#service_date').val('');
        });
    
//On date change the Time slot will change

        $('#service_date').change(function(){
            var date = $(this).val();
            $('#time_slot').val('');
            var cleaner = $('#cleaner').val();
          
            var subservice_id = $('#subservice_id').val();

            var url = '{{ url('get-cleaners-time-slot') }}';

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "date": date,
                    "cleaner": cleaner,
                    "subservice_id": subservice_id,
                   
                },
                success: function(msg) {
                    // alert(msg);
                    document.getElementById('time_slot_change').innerHTML = msg;
                }
            });

        });
    
//On cleaner change the time slot and service date will be empty
        function  cleaner_on_change(){
            $('#service_date').val('');
            $('#time_slot').val('');
        }

        function get_package(){

            selectedPackages = $('#package').val() || [];
            var package_category = $('#package_category').val();
            // alert(package_category);
            var subservice_id = $('#subservice_id').val();
            $('#time_slot').val('');
            $('#service_date').val('');
            var url = '{{ url('get-package') }}';
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "package_category": package_category,
                    "subservice_id": subservice_id,
                    "selectedPackages": selectedPackages
                },
                success: function(msg) {
                    // alert(msg);
                    document.getElementById('package_change').innerHTML = msg;
                    $('#package').select2({
                        placeholder: 'Select Packages', // Add your desired placeholder text here
                    });
                    $('#package_quantity_price_div').show();
                }
            });
        }

        function time_slot_on_change(){

            var time_slot = $('#time_slot').val();
            var hour_value = $('#hour_value').val();
            var cleaner = $('#cleaner').val();
            var service_date = $('#service_date').val();
            var subservice_id = $('#subservice_id').val();

            var url = '{{ url('time-slot-available') }}';
            $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "time_slot": time_slot,
                        "hour_value": hour_value,
                        "cleaner": cleaner,
                        "subservice_id": subservice_id,
                        "service_date": service_date,
                    },
                    dataType: "json",  // Ensure response is treated as JSON
                        success: function(response) {
                            if (response.status === "error") {
                                alert(response.message); 
                                $('#time_slot').val('');
                            } else {
                                console.log("Success");
                            }
                        },
                });

        }
   
</script>

<script>
    function home_cleaning_calculation(){

    let hour_value = parseFloat($('#hour_value').val()) || 0;
    let cleaner_charge = parseFloat($('#cleaner_charge').val()) || 0;
    let how_many_cleaner = parseInt($('#how_many_cleaner').val()) || 0;
    let cleaning_material_charge = parseFloat($('#cleaning_material_charge').val()) || 0;
    let cod_charge = parseFloat($('#cod_charge').val()) || 0;
    let timing_charge = parseFloat($('#timing_charge').val()) || 0;
    let date_charge = parseFloat($('#date_charge').val()) || 0;
    let service_fee = parseFloat($('#service_fee').val()) || 0;

    // alert(hour_value);
    // alert(how_many_cleaner);
    // alert(cleaning_material_charge);
  
    // Calculate the service charge
    let service_charge = hour_value * cleaner_charge * how_many_cleaner;

    let additional_charge = hour_value * how_many_cleaner * cleaning_material_charge;

    // alert(additional_charge);
    

    // Calculate subtotal and VAT
    let sub_total = service_charge + additional_charge + cod_charge + service_fee + timing_charge + date_charge;
    let vat_charge = sub_total * 5 / 100;

    let order_total = sub_total + vat_charge;

    // Update the form fields
    $('#service_charge').val(service_charge.toFixed(2));
    $('#sub_total').val(sub_total.toFixed(2));
    $('#vat_charge').val(vat_charge.toFixed(2));
    $('#order_total').val(order_total.toFixed(2));
     
    }
</script>
@stop
