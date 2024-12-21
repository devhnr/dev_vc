@extends('admin.includes.Template')

@section('content')

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

                                        <label for="name">Image (230px x 320px)</label>

                                        <input id="image" name="image" type="file" class="form-control"value="" />
                                        @if ($subservice->image != '')
                                            <img src="{{ asset('public/upload/subservice/large/' . $subservice->image) }}"
                                                style=" width: 10%;margin-top: 10px;" />
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
                                        <p class="form-error-text" id="charge_error" style="color: red; margin-top: 10px;">
                                        </p>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <label for="name">No Of Inquiry</label>

                                        <input id="no_of_inquiry" name="no_of_inquiry" type="text" class="form-control"
                                            placeholder="Enter No Of Inquiry" value="{{ $subservice->no_of_inquiry }}"
                                            onkeypress="return validateNumber(event)" />

                                        <p class="form-error-text" id="inquiry_error"
                                            style="color: red; margin-top: 10px;"></p>

                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="name">Booking Service Percentage</label>

                                    <input id="servicepercentage" name="servicepercentage" type="text"
                                        class="form-control" placeholder="Enter Booking Service Percentage"
                                        value="{{ $subservice->servicepercentage }}"
                                        onkeypress="return validateNumber(event)" />

                                    <p class="form-error-text" id="serviceprice_error"
                                        style="color: red; margin-top: 10px;">
                                    </p>

                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">

                                        <label for="description" style="margin:15px 0 5px 0px; width:100%;">

                                            Description</label>

                                        <textarea id="description" name="description" class="form-control" placeholder="Enter Description">{{ $subservice->description }}</textarea>

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
    </script>

@stop
