@extends('admin.includes.Template')

@section('content')

    <div class="content container-fluid">



        <!-- Page Header -->

        <div class="page-header">

            <div class="row">

                <div class="col-sm-12">

                    <h3 class="page-title">Sub Service</h3>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('subservice.index') }}">Sub Service</a></li>

                        <li class="breadcrumb-item active">Add Sub Service</li>

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

                        <form id="subservice_form" action="{{ route('subservice.store') }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">

                                        <label for="name">Service</label>

                                        <select name="serviceid" id="serviceid" class="form-control">

                                            <option value=""> Select Service</option>

                                            @foreach ($service_data as $all_service_data)
                                                <option value="{{ $all_service_data['id'] }}">
                                                    {{ $all_service_data['servicename'] }}

                                                </option>
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
                                            placeholder="Enter Sub Service" value="" />

                                        <p class="form-error-text" id="subservice_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="page_url">Page Url</label>
                                        <input id="page_url" name="page_url" type="text" class="form-control"
                                            placeholder="Enter Page Url" value="" />

                                        <p class="form-error-text" id="page_url_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="page_url">Promo Discount (in % only)</label>
                                        <input id="promo_discount" name="promo_discount" type="text" class="form-control"
                                            placeholder="Enter Promo Discount" value="" />
                                        

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
                                        <input type="radio" name="discount_type" id="price" value="0">
                                        <lable for="Percentage">Percentage</lable>
                                        <input type="radio" name="discount_type" id="percentage" value="1">
                                        <lable for="None">None</lable>
                                        <input type="radio" name="discount_type" id="none" value="2">
                                        </div>  

                                        <p class="form-error-text" id="discount_type_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="col-lg-6"> 
                                    <div class="form-group">

                                        <label for="name">Image (450px x 325px)</label>

                                        <input id="image" name="image" type="file" class="form-control"value="" />
                                        <p class="form-error-text" id="image_error" style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Banner Image (1250px x 300px)</label>

                                        <input id="banner_image" name="banner_image" type="file"
                                            class="form-control"value="" />
                                        <p class="form-error-text" id="banner_image_error"
                                            style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style="width: 100%;">Is Bookable</label>
                                        <div style="padding: 9px 0;">
                                            <input type="checkbox" name="is_bookable[]" value="0" id="is_bookable">
                                            Book Now
                                            <input type="checkbox" name="is_bookable[]" value="1" id="is_bookable">
                                            Inquiry
                                        </div>
                                        <p class="form-error-text" id="book_error" style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                </div>



                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Inquiry Charge</label>

                                        <input id="charge" name="charge" type="text" class="form-control"
                                            placeholder="Enter Inquiry Charge" value=""
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
                                            class="form-control" placeholder="No Of Inquiry" value=""
                                            onkeypress="return validateNumber(event)" />
                                        <p class="form-error-text" id="inquiry_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">Booking Service Percentage</label>
                                        <input id="servicepercentage" name="servicepercentage" type="text"
                                            class="form-control" placeholder="Booking Service Percentage" value=""
                                            onkeypress="return validateNumber(event)" />
                                        <p class="form-error-text" id="servicepercentage_error"
                                            style="color: red; margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label for="description" style="margin:15px 0 5px 0px; width:100%;">Top
                                        Description</label>

                                    <textarea id="top_description" name="top_description" class="form-control" placeholder="Enter Top Description"></textarea>

                                </div>

                                {{-- Packages more Start --}}
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group"> <label for="categoryname">Title</label>

                                            <input type="text" id="title_addmore" name="title_addmore[]"
                                                class="form-control" placeholder="Enter  Title" value="">

                                        </div>

                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group"> <label for="categoryname">Image (510px X 340px)</label>

                                            <input type="file" id="image" name="image_0" class="form-control"
                                                placeholder="">

                                        </div>

                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group"> <label for="categoryname">Description</label>

                                            {{-- <input type="text" id="price" name="description_addmore[]"
                                                class="form-control" placeholder="Enter Description"> --}}
                                            <textarea id="description_addmore" name="description_addmore[]" class="form-control"
                                                placeholder="Enter Description"></textarea>


                                        </div>

                                    </div>





                                </div>
                                <div class="input_fields_wrap01">

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">

                                        <button
                                            style="border: medium none;margin-right: 0px;line-height: 25px;margin-top: -62px;"
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
                                            @foreach ($form_field_data as $form_field)
                                                <option value="{{ $form_field->id }}">{{ $form_field->lable_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="form-error-text" id="form_fields_error"
                                            style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city">International Fields</label>
                                        <select class="form-control" id="form_fields_two" name="form_fields_two[]"
                                            multiple="multiple">
                                            <option value="">Select Form Fields</option>
                                            @foreach ($form_field_data as $form_field)
                                                <option value="{{ $form_field->id }}">{{ $form_field->lable_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="form-error-text" id="form_fields_error"
                                            style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label for="description" style="margin:15px 0 5px 0px; width:100%;">

                                        Description</label>

                                    <textarea id="description" name="description" class="form-control" placeholder="Enter Description"></textarea>

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



            var image = jQuery("#image").val();
            if (image == '') {
                jQuery('#image_error').html("Please Select Image");
                jQuery('#image_error').show().delay(0).fadeIn('show');
                jQuery('#image_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#image').offset().top - 150
                }, 1000);
                return false;
            }
            var banner_image = jQuery("#banner_image").val();
            if (banner_image == '') {
                jQuery('#banner_image_error').html("Please Select Banner-Image");
                jQuery('#banner_image_error').show().delay(0).fadeIn('show');
                jQuery('#banner_image_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#banner_image').offset().top - 150
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
            // var serviceprice = jQuery("#serviceprice").val();
            // if (serviceprice == '') {
            //     jQuery('#serviceprice_error').html("Please Enter  Booking Service Price");
            //     jQuery('#serviceprice_error').show().delay(0).fadeIn('show');
            //     jQuery('#serviceprice_error').show().delay(2000).fadeOut('show');
            //     $('html, body').animate({
            //         scrollTop: $('#serviceprice').offset().top - 150
            //     }, 1000);
            //     return false;
            // }




            $('#spinner_button').show();

            $('#submit_button').hide();



            $('#subservice_form').submit();

        }
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

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

            .create(document.querySelector('#description_addmore'))

            .catch(error => {

                console.error(error);

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
    <script type="text/javascript" language="javascript">
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
                        '<div class="row"> <div class="col-md-3"> <div class="form-group"> <label for="categoryname">Title</label>  <input type="text" id="title_addmore" name="title_addmore[]" class="form-control" placeholder="Enter  Title"></div></div><div class="col-md-3"><div class="form-group"><label for="categoryname">Image(510px X 340px)</label><input type="file" id="price" name="image_' +
                        b +
                        '" class="form-control"  placeholder=""> </div></div> <div class="col-md-3"><div class="form-group"><label for="categoryname">Description</label><textarea id="description_addmoree_' +
                        b +
                        '" name="description_addmore[]" class="form-control" placeholder="Enter Description"></textarea></div></div><a href="#" class="btn btn-danger pull-right remove_field01" style="margin-right: 0;margin-top: 23px;width: 10%;float: right;height: 38px;margin-left: 30px;">Remove</a></div>'
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



        $("#form_fields").select2({
            placeholder: "Select a Local Fields" // Replace with your desired placeholder text
        });
        $("#form_fields_two").select2({
            placeholder: "Select a International Fields" // Replace with your desired placeholder text
        });
    </script>



@stop
