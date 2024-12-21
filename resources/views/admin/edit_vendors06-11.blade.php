@extends('admin.includes.Template')

@section('content')

    <div class="content container-fluid">



        <!-- Page Header -->

        <div class="page-header">

            <div class="row">

                <div class="col-sm-12">

                    <h3 class="page-title">Edit User</h3>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('vendors.index') }}">User</a></li>

                        <li class="breadcrumb-item active">Edit User</li>

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

                        <form id="category_form" action="{{ route('vendors.update', $vendors->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            @method('PUT')

                            <div class="row">

                                <div class="form-group">
                                    <label for="vendors">User Category</label>
                                    <select class="form-control" id="role_id" name="role_id" readonly>
                                        @foreach ($permission_data as $permission)
                                            <option value="{{ $permission->id }}" <?php if ($permission->id == $vendors->name) {
                                                echo 'selected';
                                            } ?>>
                                                {{ $permission->cname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <input id="name" name="name" type="text" class="form-control"
                                        placeholder="Enter Name" value="{{ $vendors->name }}" />
                                </div>



                                <div class="form-group">
                                    <input id="user_name" name="user_name" type="hidden" class="form-control"
                                        placeholder="Enter  Name" value="{{ $vendors->user_name }}" />
                                </div>


                                {{-- add more start --}}
                                @if ($attribute_data != '')
                                    <input type="hidden" name="poc1[]" value="">
                                    <input type="hidden" name="poctitle1[]" value="">
                                    <input type="hidden" name="c_email1[]" value="">
                                    <input type="hidden" name="telephone1[]" value="">


                                    @for ($i = 0; $i < count($attribute_data); $i++)
                                        <div class="row">

                                            <input type="hidden" name="updateid1xxx[]" id="updateid1xxx{{ $i + 1 }}"
                                                value="{{ $attribute_data[$i]->id }}">

                                            <div class="col-md-2">
                                                <div class="form-group"> <label for="poc">POC Full</label>
                                                    <input type="text" id="pocu" name="pocu[]" class="form-control"
                                                        placeholder="Enter POC" value="{{ $attribute_data[$i]->poc }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group"> <label for="poctitle">POC Title</label>
                                                    <input type="text" id="poctitleu" name="poctitleu[]"
                                                        class="form-control" placeholder="Enter  POC Title"
                                                        value="{{ $attribute_data[$i]->poctitle }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group"> <label for="email">Company Email</label>
                                                    <input type="text" id="c_emailu" name="c_emailu[]"
                                                        class="form-control" placeholder="Enter Email"
                                                        value="{{ $attribute_data[$i]->c_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group"> <label for="telephone">Company Telephone</label>
                                                    <input type="text" id="telephoneu" name="telephoneu[]"
                                                        class="form-control" placeholder="Enter Telephone"
                                                        value="{{ $attribute_data[$i]->telephone }}">
                                                </div>
                                            </div>
                                            <a href="#"
                                                onclick="singledelete('{{ route('remove_vendors_att', ['pid' => $attribute_data[$i]->pid, 'id' => $attribute_data[$i]->id]) }}')"
                                                class="btn btn-danger pull-right remove_field1"
                                                style="margin-right: 0;margin-top: 22px;width: 9%;float: right;height: 40px;margin-left: 166px;">Remove</a>

                                        </div>
                                    @endfor
                                @endif

                                @php

                                    $test = count($attribute_data);
                                    if ($test > 0) {
                                        $style = 'display:none';
                                    } else {
                                        $style = 'display:block';
                                    }
                                @endphp
                                <span style="@php echo $style; @endphp">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group"> <label for="poc">POC Full</label>
                                                <input type="text" id="poc" name="poc1[]" class="form-control"
                                                    placeholder="Enter POC">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group"> <label for="poctitle">POC Title</label>
                                                <input type="text" id="poctitle" name="poctitle1[]"
                                                    class="form-control" placeholder="Enter  POC Title">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group"> <label for="email">Company Email</label>
                                                <input type="text" id="c_email" name="c_email1[]"
                                                    class="form-control" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group"> <label for="telephone">Company Telephone</label>
                                                <input type="text" id="telephone" name="telephone1[]"
                                                    class="form-control" placeholder="Enter Telephone">
                                            </div>
                                        </div>
                                    </div>
                                </span>

                                <div class="input_fields_wrap12"> </div>
                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <button
                                            style="border: medium none;margin-right: -21px;line-height: 26px;margin-top: -62px;"
                                            class="submit btn bg-purple pull-right" type="button"
                                            id="add_field_button12">Add Price </button>
                                    </div>
                                </div>

                                {{-- add more End --}}


                                <div class="form-group">
                                    <label for="name">Company Website</label>
                                    <input id="companywebsite" name="companywebsite" type="text" class="form-control"
                                        placeholder="Enter Company Website" value="{{ $vendors->companywebsite }}" />
                                </div>

                                <div class="form-group">
                                    <label for="vendors">Company City</label>
                                    <select class="form-control" id="city" name="city">
                                        @foreach ($city_data as $city)
                                            <option value="{{ $city->id }}" <?php if ($city->id == $vendors->city) {
                                                echo 'selected';
                                            } ?>>
                                                {{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Company Role</label>
                                    <input id="crole" name="crole" type="text" class="form-control"
                                        placeholder="Enter Company Role" value="{{ $vendors->crole }}" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Parent Company Name</label>
                                    <input id="parentcname" name="parentcname" type="text" class="form-control"
                                        placeholder="Enter Parent Company Name" value="{{ $vendors->parentcname }}" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Establishment Date</label>
                                    <input id="establishment_date" name="establishment_date" type="date"
                                        class="form-control" placeholder="Select Establishment Date"
                                        value="{{ $vendors->establishment_date }}" />
                                </div>
                                <div class="form-group">
                                    <label for="name">VAT Certificate </label>
                                    <input id="vatcertificate" name="vatcertificate" type="file" class="form-control"
                                        placeholder="Select VAT Certificate" />
                                    @if ($vendors->vatcertificate != '')
                                        <img src="{{ asset('public/upload/vendors/' . $vendors->vatcertificate) }}"
                                            style="width: 10%;margin-top: 10px;" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">TRN Certificate </label>
                                    <input id="trncertificate" name="trncertificate" type="file" class="form-control"
                                        placeholder="Select TRN Certificate" />
                                    @if ($vendors->trncertificate != '')
                                        <img src="{{ asset('public/upload/vendors/' . $vendors->trncertificate) }}"
                                            style="width: 10%;margin-top: 10px;" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Trade License</label>
                                    <input id="tradelicense" name="tradelicense" type="file" class="form-control"
                                        placeholder="Select Trade License" />
                                    @if ($vendors->tradelicense != '')
                                        <img src="{{ asset('public/upload/vendors/' . $vendors->tradelicense) }}"
                                            style="width: 10%;margin-top: 10px;" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">TL expiry date</label>
                                    <input id="tlexpiry" name="tlexpiry" type="date" class="form-control"
                                        placeholder="Select TL expiry date" value="{{ $vendors->tlexpiry }}" />
                                </div>
                                <div class="form-group">
                                    @php $maxStaff = 5; @endphp
                                    <label for="">No Of Staff</label>
                                    <select class="form-control" id="staff" name="staff">
                                        <option value="">Select No Of Staff</option>
                                        @for ($i = 1; $i <= $maxStaff; $i++)
                                            <option value="{{ $i }}"
                                                @if ($i == $vendors->staff) selected @endif>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Remarks</label>
                                    <input id="remarks" name="remarks" type="text" class="form-control"
                                        placeholder="Enter Remarks" value="{{ $vendors->remarks }}" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Social Media</label>
                                    <input id="socialmedai" name="socialmedai" type="text" class="form-control"
                                        placeholder="Enter Social Media" value="{{ $vendors->socialmedai }}" />
                                </div>
                                {{-- <div class="form-group">
                                    <label for="name">Password</label>
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="Enter Password" value="{{ $vendors->password }}" />
                                </div> --}}


                                <div class="form-group">

                                    <label for="name">Email for Login</label>

                                    <input id="email" name="email" type="text" class="form-control"
                                        placeholder="Enter Email" value="{{ $vendors->email }}" />

                                </div>

                                <div class="form-group">

                                    <label for="name">Mobile No.</label>

                                    <input id="mobile" name="mobile" type="text" class="form-control"
                                        placeholder="Enter Mobile No." onkeypress="return validateNumber(event)"
                                        value="{{ $vendors->mobile }}" />

                                </div>

                            </div>

                            <div class="text-end mt-4">

                                <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Cancel</a>

                                <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                                    style="display: none;">

                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>

                                    Loading...

                                </button>

                                <button type="button" class="btn btn-primary" onclick="javascript:category_validation()"
                                    id="submit_button">Submit</button>

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
        function category_validation() {

            var select = jQuery("#select").val();

            if (select == '') {

                jQuery('#validate').html("Please Select User Category");

                jQuery('#validate').show().delay(0).fadeIn('show');

                jQuery('#validate').show().delay(2000).fadeOut('show');

                $('html, body').animate({

                    scrollTop: $('#validate').offset().top - 150

                }, 1000);

                return false;

            }



            var name = jQuery("#name").val();

            if (name == '') {

                jQuery('#validate').html("Please Enter Name");

                jQuery('#validate').show().delay(0).fadeIn('show');

                jQuery('#validate').show().delay(2000).fadeOut('show');

                $('html, body').animate({

                    scrollTop: $('#validate').offset().top - 150

                }, 1000);

                return false;

            }



            var user_name = jQuery("#user_name").val();

            if (user_name == '') {

                jQuery('#validate').html("Please Enter User Name");

                jQuery('#validate').show().delay(0).fadeIn('show');

                jQuery('#validate').show().delay(2000).fadeOut('show');

                $('html, body').animate({

                    scrollTop: $('#validate').offset().top - 150

                }, 1000);

                return false;

            }



            var password = jQuery("#password").val();

            if (password == '') {

                jQuery('#validate').html("Please Enter Password");

                jQuery('#validate').show().delay(0).fadeIn('show');

                jQuery('#validate').show().delay(2000).fadeOut('show');

                $('html, body').animate({

                    scrollTop: $('#validate').offset().top - 150

                }, 1000);

                return false;

            }



            // var conf_password = jQuery("#conf_password").val();

            // if (conf_password == '') {

            //     jQuery('#validate').html("Please Enter Confirm Password");

            //     jQuery('#validate').show().delay(0).fadeIn('show');

            //     jQuery('#validate').show().delay(2000).fadeOut('show');

            //     $('html, body').animate({

            //         scrollTop: $('#validate').offset().top - 150

            //     }, 1000);

            //     return false;

            // }



            // if (conf_password != password) {

            //     jQuery('#validate').html("Confirm Password Doesn't Match Password");

            //     jQuery('#validate').show().delay(0).fadeIn('show');

            //     jQuery('#validate').show().delay(2000).fadeOut('show');

            //     $('html, body').animate({

            //         scrollTop: $('#validate').offset().top - 150

            //     }, 1000);

            //     return false;

            // }



            var email = jQuery("#email").val();

            if (email == '') {

                jQuery('#validate').html("Please Enter Email");

                jQuery('#validate').show().delay(0).fadeIn('show');

                jQuery('#validate').show().delay(2000).fadeOut('show');

                $('html, body').animate({

                    scrollTop: $('#validate').offset().top - 150

                }, 1000);

                return false;

            }



            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (!filter.test(email)) {

                jQuery('#validate').html("Enter Valid Email Address.");

                jQuery('#validate').show().delay(0).fadeIn('show');

                jQuery('#validate').show().delay(2000).fadeOut('show');

                $('html, body').animate({

                    scrollTop: $('#validate').offset().top - 150

                }, 1000);

                return false;

            }



            var mobile = jQuery("#mobile").val();

            if (mobile == '') {

                jQuery('#validate').html("Please Enter Mobile");

                jQuery('#validate').show().delay(0).fadeIn('show');

                jQuery('#validate').show().delay(2000).fadeOut('show');

                $('html, body').animate({

                    scrollTop: $('#validate').offset().top - 150

                }, 1000);

                return false;

            }
            var mobileNumberPattern = /^[0-9]{10}$/;

            if (mobile.match(mobileNumberPattern)) {

                jQuery('#validate').html("Please Enter Valid Mobile");

                jQuery('#validate').show().delay(0).fadeIn('show');

                jQuery('#validate').show().delay(2000).fadeOut('show');

                $('html, body').animate({

                    scrollTop: $('#validate').offset().top - 150

                }, 1000);

                return false;

            }

            $('#spinner_button').show();

            $('#submit_button').hide();

            $('#category_form').submit();

        }
    </script>



    <script type="text/javascript">
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

            var wrapper = $(".input_fields_wrap12");

            var add_button = $("#add_field_button12");



            var b = 0;

            $(add_button).click(function(e) { //alert('ok');

                e.preventDefault();

                if (b < max_fields) {

                    b++;

                    $(wrapper).append(

                        '<div class="row"><div class="col-md-2"><div class="form-group"> <label for="poc">POC Full</label><input type="text" id="poc" name="poc1[]" class="form-control" placeholder="Enter POC"></div></div><div class="col-md-2"><div class="form-group"> <label for="poctitle">POC Title</label><input type="text" id="poctitle" name="poctitle1[]" class="form-control" placeholder="Enter  POC Title"></div></div><div class="col-md-2"><div class="form-group"> <label for="email">Company Email</label><input type="text" id="c_email" name="c_email1[]" class="form-control" placeholder="Enter Email"></div></div><div class="col-md-2"><div class="form-group"> <label for="telephone">Company Telephone</label><input type="text" id="telephone" name="telephone1[]" class="form-control" placeholder="Enter Telephone"></div></div><a href="#" class="btn btn-danger pull-right remove_field1" style="margin-right: 0;margin-top: 22px;width: 9%;float: right;height: 40px;margin-left: 150px;">Remove</a></div>'

                    );

                }

            });

            $(wrapper).on("click", ".remove_field1", function(e) {

                e.preventDefault();

                $(this).parent('div').remove();

                b--;

            })

        });
    </script>
@stop
