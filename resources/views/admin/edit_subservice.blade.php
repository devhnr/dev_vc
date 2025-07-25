@extends('admin.includes.Template')

@section('content')
<style>
    ul li {
            list-style: inherit;
        }
</style>

    <div class="content container-fluid">



        <!-- Page Header -->

        <div class="page-header">

            <div class="row">

                <div class="col-sm-12">

                    <h3 class="page-title">Edit Sub Service</h3>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('subservice.index') }}"> Sub Service</a></li>

                        <li class="breadcrumb-item active">Edit Sub Service</li>

                    </ul>

                </div>

            </div>

        </div>

        <!-- /Page Header -->



        <div id="validate" class="alert alert-danger alert-dismissible fade show" style="display: none;">

            <span id="login_error"></span>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>



        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">

                        <!-- <h4 class="card-title">Basic Info</h4> -->

                        <form id="subservice_form" action="{{ route('subservice.update', $subservice->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            @method('PUT')

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="form-group">

                                        <label for="name">Service</label>

                                        <select name="serviceid" id="serviceid" class="form-control">

                                            <option value=""> Select Service</option>

                                            @foreach ($all_service as $service)
                                                <option value="{{ $service->id }}"
                                                    @if ($subservice->serviceid == $service->id) {{ 'selected' }} @endif>

                                                    {{ $service['servicename'] }}</option>
                                            @endforeach

                                        </select>
                                        <p class="form-error-text" id="service_error" style="color: red; margin-top: 10px;">
                                        </p>

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">

                                        <label for="name">Sub Service</label>

                                        <input id="subservicename" name="subservicename" type="text" class="form-control"
                                            placeholder="Enter Sub Service" value="{{ $subservice->subservicename }}" />
                                        <p class="form-error-text" id="subservice_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="page_url">Page Url</label>
                                        <input id="page_url" name="page_url" type="text" class="form-control"
                                            placeholder="Enter Page Url" value="{{ $subservice->page_url }}" />

                                        <p class="form-error-text" id="page_url_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="page_url">Promo Discount (in % only)</label>
                                        <input id="promo_discount" name="promo_discount" type="text" class="form-control"
                                            placeholder="Enter Promo Discount" value="{{ $subservice->promo_discount }}" />
                                        

                                        <p class="form-error-text" id="promo_discount_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="page_url">Promo Discount Type</label>
                                        <br>
                                        <div class="radio" style="margin-top: 10px;">
                                        <lable for="Price">Price</lable>
                                        <input type="radio" name="discount_type" id="price" value="0" @if($subservice->discount_type == 0) checked @endif>
                                        <lable for="Percentage">Percentage</lable>
                                        <input type="radio" name="discount_type" id="percentage" value="1" @if($subservice->discount_type == 1) checked @endif>
                                        <lable for="None">None</lable>
                                        <input type="radio" name="discount_type" id="none" value="2" @if($subservice->discount_type == 2) checked @endif>
                                        </div>  

                                        <p class="form-error-text" id="discount_type_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                    <div class="col-lg-6"> 
                                    <div class="form-group">

                                        <label for="name">Banner Title</label>

                                        <input id="banner_title" name="banner_title" type="text" class="form-control"value="{{ $subservice->banner_title }}" placeholder="Enter Banner Title"/>
                                        <p class="form-error-text" id="banner_title_error" style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6"> 
                                    <div class="form-group">

                                        <label for="name">Banner Subtitle</label>

                                        <input id="banner_subtitle" name="banner_subtitle" type="text" class="form-control"value="{{ $subservice->banner_subtitle }}" placeholder="Enter Banner Subtitle" />
                                        <p class="form-error-text" id="banner_subtitle_error" style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">

                                        <label for="name">Image (840px x 570px)</label>

                                        <input id="image" name="image" type="file" class="form-control"value="" />
                                        @if ($subservice->image != '')
                                            <img src="{{ asset('public/upload/subservice/large/' . $subservice->image) }}"
                                                style=" width: 50px;margin-top: 10px;" />
                                        @endif

                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Mobile Image (140px x 107px)</label>

                                        <input id="mobile_image" name="mobile_image" type="file" class="form-control"value="" />
                                        @if ($subservice->mobile_image != '')
                                            <img src="{{ asset('public/upload/subservice/medium/' . $subservice->mobile_image) }}"
                                                style=" width: 50px;margin-top: 10px;" />
                                        @endif

                                    </div>
                                </div> --}}
                                <div class="col-lg-4">
                                    <div class="form-group">

                                        <label for="name">Banner Image (1350px x 440px)</label>

                                        <input id="banner_image" name="banner_image" type="file"
                                            class="form-control"value="" />
                                        @if ($subservice->banner_image != '')
                                            <img src="{{ asset('public/upload/subservice/banner/' . $subservice->banner_image) }}"
                                                style=" width: 50px;margin-top: 10px;" />
                                        @endif

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">

                                        <label for="name">Mobile Banner Image (400px x 475px)</label>

                                        <input id="mobile_banner_image" name="mobile_banner_image" type="file"
                                            class="form-control"value="" />
                                        @if ($subservice->mobile_banner_image != '')
                                            <img src="{{ asset('public/upload/subservice/banner/' . $subservice->mobile_banner_image) }}"
                                                style=" width: 50px;margin-top: 10px;" />
                                        @endif

                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label style="width: 100%;">Is Bookable</label>

                                        <div style="padding: 9px 0;">

                                            <input type="checkbox" name="is_bookable[]" id="is_bookable" value="0"
                                                @if (in_array('0', explode(',', $subservice->is_bookable))) {{ 'checked' }} @endif>
                                            Book Now
                                            <input type="checkbox" name="is_bookable[]" id="is_bookable" value="1"
                                                @if (in_array('1', explode(',', $subservice->is_bookable))) {{ 'checked' }} @endif> Inquiry
                                        </div>

                                        <p class="form-error-text" id="book_error" style="color: red; margin-top: 10px;">
                                        </p>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Inquiry Charge</label>

                                        <input id="charge" name="charge" type="text" class="form-control"
                                            placeholder="Enter Inquiry Charge" value="{{ $subservice->charge }}"
                                            onkeypress="return validateNumber(event)" />
                                        <p class="form-error-text" id="charge_error"
                                            style="color: red; margin-top: 10px;">
                                        </p>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">No Of Inquiry</label>

                                        <input id="no_of_inquiry" name="no_of_inquiry" type="text"
                                            class="form-control" placeholder="Enter No Of Inquiry"
                                            value="{{ $subservice->no_of_inquiry }}"
                                            onkeypress="return validateNumber(event)" />

                                        <p class="form-error-text" id="inquiry_error"
                                            style="color: red; margin-top: 10px;"></p>

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">

                                    <label for="name">Booking Service Percentage</label>

                                    <input id="servicepercentage" name="servicepercentage" type="text"
                                        class="form-control" placeholder="Enter Booking Service Percentage"
                                        value="{{ $subservice->servicepercentage }}"
                                        onkeypress="return validateNumber(event)" />

                                    <p class="form-error-text" id="serviceprice_error"
                                        style="color: red; margin-top: 10px;">
                                    </p>

                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Additional Charge Popup</label>
                                        <textarea id="additional_charge_popup" name="additional_charge_popup" type="text"
                                            class="form-control" placeholder="Enter Additional Charge Discription" value=""/>{{ $subservice->additional_charge_popup }}</textarea>
                                        <p class="form-error-text" id="additional_charge_popup_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Timing Fee Popup</label>
                                        <textarea id="timing_fee_popup" name="timing_fee_popup" type="text"
                                            class="form-control" placeholder="Enter Timing Fee Discription" value=""/>{{ $subservice->timing_fee_popup }}</textarea>
                                        <p class="form-error-text" id="timing_fee_popup_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Delivery Charge Popup</label>
                                        <textarea id="delivery_charge_popup" name="delivery_charge_popup" type="text"
                                            class="form-control" placeholder="Enter Delivery Charge Discription" value=""/>{{ $subservice->delivery_charge_popup }}</textarea>
                                        <p class="form-error-text" id="delivery_charge_popup_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Service fee Popup</label>
                                        <textarea id="service_fee_popup" name="service_fee_popup" type="text"
                                            class="form-control" placeholder="Enter Service Fee Popup Discription" value=""/>{{ $subservice->service_fee_popup }}</textarea>
                                        <p class="form-error-text" id="service_fee_popup_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                  <div class="form-group">

                                    <label for="description" style="margin:15px 0 5px 0px; width:100%;">Cancel Policy Description</label>

                                    <textarea id="cancel_policy" name="cancel_policy" class="form-control" placeholder="Enter Cancel Policy">{{ $subservice->cancel_policy }}</textarea>

                                </div>

                                <div class="form-group">

                                    <label for="description" style="margin:15px 0 5px 0px; width:100%;">Top
                                        Description</label>

                                    <textarea id="top_description" name="top_description" class="form-control" placeholder="Enter Top Description">{{ $subservice->top_description }}</textarea>

                                </div>

                                {{-- Packages more Start --}}
                                @php
                                    $k = 0;
                                @endphp

                                @if ($package_attribute_data != '')

                                    <input type="hidden" name="title_addmore1[]" value="">

                                    <input type="file" name="e_image1_<?php echo $k; ?>" value=""
                                        style="display: none;">

                                    <input type="hidden" name="description_addmore1[]" value="">

                                    {{-- <textarea type="hidden" name="description_addmore1[]" value=""></textarea> --}}

                                    @for ($i = 0; $i < count($package_attribute_data); $i++)
                                        <div class="row">
                                            <input type="hidden" name="updateid1xxx1[]"
                                                id="updateid1xxx1{{ $i + 1 }}"
                                                value="{{ $package_attribute_data[$i]->id }}">

                                            <div class="col-md-3">

                                                <div class="form-group"> <label for="categoryname">Title</label>

                                                    <input type="text" id="price" name="title_addmoreu[]"
                                                        class="form-control" placeholder="Enter  Title"
                                                        value="{{ $package_attribute_data[$i]->title_addmore }}">

                                                </div>

                                            </div>
                                            <div class="col-md-3">

                                                <div class="form-group"> <label for="categoryname">Image (510px X
                                                        340px)</label>

                                                    <input type="file" id="image"
                                                        name="imageu_{{ $i }}" class="form-control"
                                                        placeholder="" value="">

                                                    <img src="{{ url('public/upload/subservice/subservice_attr/large/' . $package_attribute_data[$i]->image) }}"
                                                        style="width:35%;">

                                                </div>
                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group"> <label for="categoryname">Description</label>

                                                    {{-- <input type="text" id="description_addmoreu"
                                                        name="description_addmoreu[]" class="form-control"
                                                        placeholder="Enter Description"
                                                        value="{{ $package_attribute_data[$i]->description_addmore }}"> --}}

                                                    <textarea id="description_addmoreu_{{ $package_attribute_data[$i]->id }}" name="description_addmoreu[]"
                                                        class="form-control" placeholder="Enter Description">{{ $package_attribute_data[$i]->description_addmore }}</textarea>



                                                </div>

                                            </div>

                                            <a href="#"
                                                onclick="singledelete('{{ route('removed_addmore_att', ['pid' => $package_attribute_data[$i]->pid, 'id' => $package_attribute_data[$i]->id]) }}')"
                                                class="btn btn-danger pull-right remove_field1"
                                                style="margin-right: 0;margin-top: 23px;width: 10%;float: right;height: 38px;margin-left: 30px;">Remove</a>

                                        </div>


                                        @php
                                            $k++;
                                        @endphp
                                    @endfor
                                @endif



                                @if (empty($package_attribute_data))
                                    <input type="file" name="e_image1_0" value="" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-3">

                                            <div class="form-group"> <label for="categoryname">Title</label>
                                                <input type="text" id="title_addmore1" name="title_addmore1[]"
                                                    class="form-control" placeholder="Enter  Title" value="">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> <label for="categoryname">image</label>
                                                <input type="file" id="image1" name="e_image1_1"
                                                    class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> <label for="categoryname">Description</label>
                                                {{-- <input type="text" id="description_addmore1"
                                                    name="description_addmore1[]" class="form-control"
                                                    placeholder="Enter Description"> --}}
                                                <textarea id="description_addmore1" name="description_addmore1[]" class="form-control"
                                                    placeholder="Enter Description"></textarea>

                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <div class="input_fields_wrap01">

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">

                                        <button
                                            style="border: medium none;margin-right: -21px;line-height: 26px;margin-top: -62px;"
                                            class="submit btn bg-purple pull-right" type="button"
                                            id="add_field_button01">Add More </button>

                                    </div>



                                </div>
                                {{-- Packages more End --}}


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city">Local Fields</label>
                                        <select class="form-control" id="form_fields" name="form_fields[]"
                                            multiple="multiple">
                                            <option value="">Select Form Fields</option>
                                            @if ($form_field_data != '' && count($form_field_data) > 0)
                                                @php $mucraft = explode(',',$subservice->form_fields); @endphp
                                                @foreach ($form_field_data as $form_field)
                                                    <option value="{{ $form_field->id }}"
                                                        {{ in_array($form_field->id, $mucraft) ? 'selected' : '' }}>
                                                        {{ $form_field->lable_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p class="form-error-text" id="form_fields_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city">International Fields</label>
                                        <select class="form-control" id="form_fields_two" name="form_fields_two[]"
                                            multiple="multiple">
                                            <option value="">Select Form Fields</option>
                                            @if ($form_field_data != '' && count($form_field_data) > 0)
                                                @php $mucraft = explode(',',$subservice->form_fields_two); @endphp
                                                @foreach ($form_field_data as $form_field)
                                                    <option value="{{ $form_field->id }}"
                                                        {{ in_array($form_field->id, $mucraft) ? 'selected' : '' }}>
                                                        {{ $form_field->lable_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p class="form-error-text" id="form_fields_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">

                                        <label for="description" style="margin:15px 0 5px 0px; width:100%;">

                                            Description</label>

                                        <textarea id="description" name="description" class="form-control" placeholder="Enter Description">{{ $subservice->description }}</textarea>

                                    </div>
                                </div>

                                <div class="col-lg-12"> 
                                    <div class="form-group">

                                        <label for="name">Service Detail Image (513px x 180px)</label>
                                        <input id="service_detail_image" name="service_detail_image" type="file" class="form-control"value="" />
                                        <img src="{{ asset('public/upload/subservice/' . $subservice->service_detail_image) }}"
                                                style=" width: 50px;margin-top: 10px;" />
                                        <p class="form-error-text" id="service_detail_image_error" style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-12"> 
                                <div class="form-group">
                                    <label for="service_detail_short_description" style="margin:15px 0 5px 0px; width:100%;">Service Detail Short Description</label>
                                    <textarea id="service_detail_short_description" name="service_detail_short_description" class="form-control" placeholder="Enter Service Detail Short Description">{{ $subservice->service_detail_short_description }}</textarea>
                                </div>
                                </div>

                                <div class="col-lg-12"> 
                                <div class="form-group">
                                    <label for="service_detail_popup_description" style="margin:15px 0 5px 0px; width:100%;">Service Detail Description</label>
                                    <textarea id="service_detail_popup_description" name="service_detail_popup_description" class="form-control" placeholder="Enter Service Detail Description">{{ $subservice->service_detail_popup_description }}</textarea>
                                </div>
                                </div>

                                <div class="col-lg-12"> 
                                    <div class="form-group">
                                        <label for="service_detail_popup_description" style="margin:15px 0 5px 0px; width:100%;">Meta Title</label>
                                        <input id="meta_title" name="meta_title" type="text" class="form-control" value="{{ $subservice->meta_title }}">

                                        
                                    </div>
                                    </div>
                                    <div class="col-lg-12"> 
                                        <div class="form-group">
                                            <label for="service_detail_popup_description" style="margin:15px 0 5px 0px; width:100%;">Meta Keyword</label>
                                            <input id="meta_keyword" name="meta_keyword" type="text" class="form-control" value="{{ $subservice->meta_keyword }}">
    
                                            
                                        </div>
                                        </div>
                                        <div class="col-lg-12"> 
                                            <div class="form-group">
                                                <label for="meta_description" style="margin:15px 0 5px 0px; width:100%;">Meta Description</label>
                                                <textarea id="meta_description" name="meta_description" class="form-control" placeholder="Enter Meta Description">{{ $subservice->meta_description }}</textarea>
                                            </div>
                                            </div>

                            </div>

                            <div class="text-end mt-4">

                                <a class="btn btn-primary" href="{{ route('subservice.index') }}"> Cancel</a>

                                <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                                    style="display: none;">

                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>

                                    Loading...

                                </button>



                                <button type="button" class="btn btn-primary" id="submit_button"
                                    onclick="javascript:subservice_validation()">Submit</button>

                                <!-- <input type="submit" name="submit" value="Submit" class="btn btn-primary"> -->

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
        $(function() {

            $("#subservicename").keyup(function() {

                var Text = $(this).val();

                Text = Text.toLowerCase();

                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');

                $("#page_url").val(Text);

            });

        });


        function validateNumber(event) {

            var key = window.event ? event.keyCode : event.which;

            if (event.keyCode === 8 || event.keyCode === 46) {

                return true;

            } else if (key < 48 || key > 57) {

                return false;

            } else {

                return true;

            }

        }
    </script>



    <script>
        function subservice_validation() {

            var serviceid = jQuery("#serviceid").val();
            if (serviceid == '') {
                jQuery('#service_error').html("Please Select Service");
                jQuery('#service_error').show().delay(0).fadeIn('show');
                jQuery('#service_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#serviceid').offset().top - 150
                }, 1000);
                return false;
            }



            var subservicename = jQuery("#subservicename").val();
            if (subservicename == '') {
                jQuery('#subservice_error').html("Please Enter Sub Service");
                jQuery('#subservice_error').show().delay(0).fadeIn('show');
                jQuery('#subservice_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#subservicename').offset().top - 150
                }, 1000);
                return false;
            }

            var page_url = jQuery("#page_url").val();
            if (page_url == '') {
                jQuery('#page_url_error').html("Please Enter Page Url");
                jQuery('#page_url_error').show().delay(0).fadeIn('show');
                jQuery('#page_url_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#page_url').offset().top - 150
                }, 1000);
                return false;
            }

            var isBookableCheckboxes = jQuery('input[name="is_bookable[]"]:checked');

            if (isBookableCheckboxes.length === 0) {
                jQuery('#book_error').html("Please Select Is Bookable");
                jQuery('#book_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: jQuery('#is_bookable').offset().top - 150
                }, 1000);
                return false;
            }

            var charge = jQuery("#charge").val();
            if (charge == '') {
                jQuery('#charge_error').html("Please Enter Inquiry Charge");
                jQuery('#charge_error').show().delay(0).fadeIn('show');
                jQuery('#charge_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#charge').offset().top - 150
                }, 1000);
                return false;
            }

            var no_of_inquiry = jQuery("#no_of_inquiry").val();
            if (no_of_inquiry == '') {
                jQuery('#inquiry_error').html("Please Enter No Of Inquiry");
                jQuery('#inquiry_error').show().delay(0).fadeIn('show');
                jQuery('#inquiry_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#no_of_inquiry').offset().top - 150
                }, 1000);
                return false;
            }
            var promo_discount = jQuery("#promo_discount").val();
            if (promo_discount == '') {
                jQuery('#promo_discount_error').html("Please Enter Promo Discount");
                jQuery('#promo_discount_error').show().delay(0).fadeIn('show');
                jQuery('#promo_discount_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#promo_discount').offset().top - 150
                }, 1000);
                return false;
            }
            // var service_fee_popup = jQuery("#service_fee_popup").val();
            // if (service_fee_popup == '') {
            //     jQuery('#service_fee_popup_error').html("Please Enter Service fee Popup Discription");
            //     jQuery('#service_fee_popup_error').show().delay(0).fadeIn('show');
            //     jQuery('#service_fee_popup_error').show().delay(2000).fadeOut('show');
            //     $('html, body').animate({
            //         scrollTop: $('#service_fee_popup').offset().top - 150
            //     }, 1000);
            //     return false;
            // }

            // var banner_title = jQuery("#banner_title").val();
            // if (banner_title == '') {
            //     jQuery('#banner_title_error').html("Please Enter Banner Title");
            //     jQuery('#banner_title_error').show().delay(0).fadeIn('show');
            //     jQuery('#banner_title_error').show().delay(2000).fadeOut('show');
            //     $('html, body').animate({
            //         scrollTop: $('#banner_title').offset().top - 150
            //     }, 1000);
            //     return false;
            // }

            // var banner_subtitle = jQuery("#banner_subtitle").val();
            // if (banner_subtitle == '') {
            //     jQuery('#banner_subtitle_error').html("Please Enter Banner Sub Title");
            //     jQuery('#banner_subtitle_error').show().delay(0).fadeIn('show');
            //     jQuery('#banner_subtitle_error').show().delay(2000).fadeOut('show');
            //     $('html, body').animate({
            //         scrollTop: $('#banner_subtitle').offset().top - 150
            //     }, 1000);
            //     return false;
            // }




            $('#spinner_button').show();

            $('#submit_button').hide();

            $('#subservice_form').submit();

        }
    </script>


    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script> --}}
    <script src="{{ asset('public/admin/assets/ckeditor/build/ckeditor.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor

            .create(document.querySelector('#description'))

            .catch(error => {

                console.error(error);

            });
        ClassicEditor

            .create(document.querySelector('#top_description'))

            .catch(error => {

                console.error(error);

            });
        ClassicEditor

            .create(document.querySelector('#cancel_policy'))

            .catch(error => {

                console.error(error);

            });
        ClassicEditor

            .create(document.querySelector('#description_addmore1'))

            .catch(error => {

                console.error(error);

            });


        @for ($i = 0; $i < count($package_attribute_data); $i++)
            ClassicEditor

                .create(document.querySelector('#description_addmoreu_{{ $package_attribute_data[$i]->id }}'))

                .catch(error => {

                    console.error(error);

                });
        @endfor
        ClassicEditor

        .create(document.querySelector('#service_detail_popup_description'))

        .catch(error => {

        console.error(error);

        }); 

        $("#form_fields").select2({
            placeholder: "Select a Local Fields" // Replace with your desired placeholder text
        });
        $("#form_fields_two").select2({
            placeholder: "Select a International Fields" // Replace with your desired placeholder text
        });
    </script>


    <script>
        function singledelete(url) {
            var t = confirm('Are You Sure To Delete The Attribute ?');

            if (t) {

                window.location.href = url;

            } else {

                return false;

            }


        }

        $(document).ready(function() {
            var max_fields = 50;
            var wrapper = $(".input_fields_wrap01");
            var add_button = $("#add_field_button01");
            var b = 0;

            $(add_button).click(function(e) {
                e.preventDefault();
                if (b < max_fields) {
                    b++;
                    var newField = $(
                        '<div class="row"> <div class="col-md-3"> <div class="form-group"> <label for="categoryname">Title</label>  <input type="text" id="title_addmore" name="title_addmore1[]" class="form-control" placeholder="Enter  Title"></div></div><div class="col-md-3"><div class="form-group"><label for="categoryname">Image(510px X 340px)</label><input type="file" id="price" name="e_image1_' +
                        b +
                        '" class="form-control"  placeholder=""> </div></div> <div class="col-md-3"><div class="form-group"><label for="categoryname">Description</label><textarea id="description_addmoree_' +
                        b +
                        '" name="description_addmore1[]" class="form-control" placeholder="Enter Description"></textarea></div></div><a href="#" class="btn btn-danger pull-right remove_field01" style="margin-right: 0;margin-top: 23px;width: 10%;float: right;height: 38px;margin-left: 30px;">Remove</a></div>'
                    );

                    $(wrapper).append(newField);
                    var newDescriptionField = newField.find('#description_addmoree_' + b);
                    ClassicEditor
                        .create(newDescriptionField[0])
                        .catch(error => {
                            console.error(error);
                        });
                }
            });

            $(wrapper).on("click", ".remove_field01", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                b--;
            });

            // Add a function to update the textarea content before form submission
            $('form').submit(function() {
                $('.input_fields_wrap01 textarea').each(function() {
                    $(this).val($(this).siblings('.ck-editor__editable').html());
                });
            });
        });
    </script>



@stop
