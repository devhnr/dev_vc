   @extends('admin.includes.Template')

   @section('content')

       <!-- Main Wrapper -->
       <!-- <div class="main-wrapper"> -->


       <!-- Page Wrapper -->
       {{-- <div class="page-wrapper"> --}}
       <div class="content container-fluid">
           <div class="page-header">
               <div class="row">
                   <div class="col-sm-6">
                       <h3 class="page-title">Edit Profile</h3>
                       <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{ url('/vendors') }}">Dashboard</a>
                           </li>
                           <li class="breadcrumb-item active">Edit Profile</li>
                       </ul>
                   </div>
               </div>
           </div>

           @if ($message = Session::get('success'))
               <div class="alert alert-success alert-dismissible fade show">

                   <strong>Success!</strong> {{ $message }}

                   <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

               </div>
           @endif



           <div class="alert alert-success alert-dismissible fade show success_show" style="display: none;">

               <strong>Success! </strong><span id="success_message"></span>

               <!-- <button type="button" class="btn-close" data-bs-dismiss="alert"></button> -->

           </div>

           <div class="row">


               <div class="col-xl-12 col-md-12">

                   <div class="card">
                       <div class="card-header">
                           <h5 class="card-title">Basic information</h5>
                       </div>
                       <div class="card-body">

                           <!-- Form -->
                           <form id="category_form" action="{{ route('vendorsprofile.update', $vendorsprofile->id) }}"
                               method="POST" enctype="multipart/form-data">
                               @csrf

                               @method('PUT')
                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Image</label>
                                   <div class="col-sm-9">
                                       <div class="d-flex align-items-center">
                                           <label class="avatar avatar-xxl profile-cover-avatar m-0" for="edit_img">
                                               @if ($vendorsprofile->image != '')
                                                   <img id="avatarImg" class="avatar-img"
                                                       src="{{ asset('public/upload/vendors/small/' . $vendorsprofile->image) }}"
                                                       alt="Profile Image">
                                               @else
                                                   <img class="avatar-img" src="{{ asset('public/upload/avatar.jpg') }}"
                                                       alt="Profile Image">
                                               @endif

                                               <input type="file" name="image" id="edit_img">
                                               <span class="avatar-edit">
                                                   <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                               </span>
                                           </label>
                                       </div>
                                   </div>
                               </div>

                               <div class="form-group" style="display: none;">
                                   <label for="vendors">User Category</label>
                                   <select class="form-control" id="role_id" name="role_id">
                                       @foreach ($permission_data as $permission)
                                           <option value="{{ $permission->id }}" <?php if ($permission->id == $vendorsprofile->name) {
                                               echo 'selected';
                                           } ?>>
                                               {{ $permission->cname }}</option>
                                       @endforeach
                                   </select>
                                   <input type="hidden" name="hidden_role_id" id="hidden_role_id" value="">

                               </div>

                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Company
                                       Name</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Company Name" value="{{ $vendorsprofile->name }}">
                                       <p class="form-error-text" id="name_error" style="color: red; margin-top: 10px;"></p>
                                   </div>

                               </div>
                               <div class="form-group">
                                   <input id="user_name" name="user_name" type="hidden" class="form-control"
                                       placeholder="Enter  Name" value="{{ $vendorsprofile->user_name }}" />
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
                                                   <input type="text" id="pocu" name="pocu[]"
                                                       class="form-control" placeholder="Enter POC"
                                                       value="{{ $attribute_data[$i]->poc }}">
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
                                                       onkeypress="return validateNumber(event)" class="form-control"
                                                       placeholder="Enter Telephone"
                                                       value="{{ $attribute_data[$i]->telephone }}">
                                               </div>
                                           </div>
                                           <a href="#"
                                               onclick="singledelete('{{ route('remove_vendorsprofile_att', ['pid' => $attribute_data[$i]->pid, 'id' => $attribute_data[$i]->id]) }}')"
                                               class="btn btn-danger pull-right remove_field1"
                                               style="margin-right: 0;margin-top: 22px;width: 9%;float: right;height: 40px;margin-left: 150px;">Remove</a>

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
                                                   onkeypress="return validateNumber(event)" class="form-control"
                                                   placeholder="Enter Telephone">
                                           </div>
                                       </div>
                                   </div>
                               </span>

                               <div class="input_fields_wrap12"> </div>
                               <div class="form-group">

                                   <div class="col-sm-12">
                                       <button
                                           style="border: medium none;margin-right: 50px;line-height: 26px;margin-top: -62px;"
                                           class="submit btn bg-purple pull-right" type="button"
                                           id="add_field_button12">Add</button>
                                   </div>
                               </div>

                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Company
                                       Website</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="companywebsite"
                                           name="companywebsite" placeholder="Company Website"
                                           value="{{ $vendorsprofile->companywebsite }}">
                                   </div>
                               </div>
                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Company City</label>
                                   <div class="col-sm-9">
                                       <select class="form-control" id="city" name="city">
                                           @foreach ($city_data as $city)
                                               <option value="{{ $city->id }}" <?php if ($city->id == $vendorsprofile->city) {
                                                   echo 'selected';
                                               } ?>>
                                                   {{ $city->name }}</option>
                                           @endforeach
                                       </select>
                                   </div>
                               </div>
                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Company Role</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="crole" name="crole"
                                           placeholder="Company Role" value="{{ $vendorsprofile->crole }}">
                                   </div>
                               </div>
                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Parent Company
                                       Name</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="parentcname" name="parentcname"
                                           placeholder="Parent Company Name" value="{{ $vendorsprofile->parentcname }}">
                                   </div>
                               </div>
                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Establishment
                                       Date</label>
                                   <div class="col-sm-9">
                                       <input type="date" class="form-control" id="establishment_date"
                                           name="establishment_date" placeholder="Select Establishment Date"
                                           value="{{ $vendorsprofile->establishment_date }}">
                                   </div>
                               </div>
                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">VAT
                                       Certificate</label>
                                   <div class="col-sm-9">
                                       <input id="vatcertificate" name="vatcertificate" type="file"
                                           class="form-control" placeholder="Select VAT Certificate" />
                                       @if ($vendorsprofile->vatcertificate != '')
                                           <img src="{{ asset('public/upload/vendors/' . $vendorsprofile->vatcertificate) }}"
                                               style="width: 5%;margin-top: 10px;" />
                                       @endif
                                   </div>
                               </div>

                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">TRN
                                       Certificate</label>
                                   <div class="col-sm-9">
                                       <input id="trncertificate" name="trncertificate" type="file"
                                           class="form-control" placeholder="Select TRN Certificate" />
                                       @if ($vendorsprofile->trncertificate != '')
                                           <img src="{{ asset('public/upload/vendors/' . $vendorsprofile->trncertificate) }}"
                                               style="width: 5%;margin-top: 10px;" />
                                       @endif
                                   </div>
                               </div>

                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Trade License</label>
                                   <div class="col-sm-9">
                                       <input id="tradelicense" name="tradelicense" type="file" class="form-control"
                                           placeholder="Select Trade License" />
                                       @if ($vendorsprofile->tradelicense != '')
                                           <img src="{{ asset('public/upload/vendors/' . $vendorsprofile->tradelicense) }}"
                                               style="width: 5%;margin-top: 10px;" />
                                       @endif
                                   </div>
                               </div>

                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">TL expiry
                                       date</label>
                                   <div class="col-sm-9">
                                       <input type="date" class="form-control" id="tlexpiry" name="tlexpiry"
                                           placeholder="Select TL expiry date" value="{{ $vendorsprofile->tlexpiry }}">
                                   </div>
                               </div>
                               <div class="row form-group">
                                   @php $maxStaff = 20; @endphp
                                   <label for="name" class="col-sm-3 col-form-label input-label">No Of Staff</label>
                                   <div class="col-sm-9">
                                       <select class="form-control" id="staff" name="staff">
                                           <option value="">Select No Of Staff</option>
                                           @for ($i = 1; $i <= $maxStaff; $i++)
                                               <option value="{{ $i }}"
                                                   @if ($i == $vendorsprofile->staff) selected @endif>
                                                   {{ $i }}
                                               </option>
                                           @endfor
                                       </select>
                                   </div>
                               </div>

                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Remarks</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="remarks" name="remarks"
                                           placeholder="Enter Remarks" value="{{ $vendorsprofile->remarks }}">
                                   </div>
                               </div>
                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Social Media</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="socialmedai" name="socialmedai"
                                           placeholder="Enter Social Media" value="{{ $vendorsprofile->socialmedai }}">
                                   </div>
                               </div>

                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Email for
                                       Login</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="email" name="email"
                                           placeholder="Enter Email for Login" value="{{ $vendorsprofile->email }}"
                                           readonly>
                                       <p class="form-error-text" id="email_error" style="color: red; margin-top: 10px;">
                                       </p>
                                   </div>

                               </div>

                               <div class="row form-group">
                                   <label for="name" class="col-sm-3 col-form-label input-label">Mobile No.</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="mobile" name="mobile"
                                           onkeypress="return validateNumber(event)" placeholder="Enter Enter Mobile No."
                                           value="{{ $vendorsprofile->mobile }}">

                                       <p class="form-error-text" id="mobile_error"
                                           style="color: red; margin-top: 10px;"></p>
                                   </div>
                               </div>

                               <div class="text-end">
                                   {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                                   <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                                       style="display: none;">

                                       <span class="spinner-border spinner-border-sm" role="status"
                                           aria-hidden="true"></span>

                                       Loading...

                                   </button>
                                   <button type="button" class="btn btn-primary"
                                       onclick="javascript:category_validation()" id="submit_button">Submit</button>
                               </div>
                           </form>
                           <!-- /Form -->

                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- </div> -->
       <!-- /Page Wrapper -->
       {{-- </div> --}}
       <!-- /Main Wrapper -->


   @stop
   @section('footer_js')

       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <script>
           function singledelete(url) {

               var checked = $("#form input:checked").length > 0;

               if (!checked) {

                   $('#select_one_record').modal('show');

               } else {

                   $('#delete_model').modal('show');

               }







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

                           '<div class="row"><div class="col-md-2"><div class="form-group"><label for="poc">POC Full</label><input type="text" id="poc" name="poc1[]" class="form-control" placeholder="Enter POC"></div></div><div class="col-md-2"><div class="form-group"> <label for="poctitle">POC Title</label><input type="text" id="poctitle" name="poctitle1[]" class="form-control" placeholder="Enter  POC Title"></div></div><div class="col-md-2"><div class="form-group"> <label for="email">Company Email</label><input type="text" id="c_email" name="c_email1[]" class="form-control" placeholder="Enter Email"></div></div><div class="col-md-2"><div class="form-group"> <label for="telephone">Company Telephone</label><input type="text" id="telephone" name="telephone1[]" onkeypress="return validateNumber(event)" class="form-control" placeholder="Enter Telephone"></div></div><a href="#" class="btn btn-danger pull-right remove_field1" style="margin-right: 0;margin-top: 22px;width: 9%;float: right;height: 40px;margin-left: 150px;">Remove</a></div>'

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
       <script>
           $(document).ready(function() {
               var role_id = jQuery("#role_id").val();

               $("#hidden_role_id").val(role_id);
           });



           $(function() {

               $("#name").keyup(function() {

                   var Text = $(this).val();

                   Text = Text.toLowerCase();

                   Text = Text.replace(/[^a-zA-Z0-9]+/g, ' ');

                   $("#user_name").val(Text);

               });

           });


           function category_validation() {

               $(document).ready(function() {
                   var role_id = jQuery("#role_id").val();

                   $("#hidden_role_id").val(role_id);
               });





               var name = jQuery("#name").val();

               if (name == '') {

                   jQuery('#name_error').html("Please Enter Company Name");
                   jQuery('#name_error').show().delay(0).fadeIn('show');
                   jQuery('#name_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#name').offset().top - 150
                   }, 1000);
                   return false;

               }

               var email = jQuery("#email").val();

               if (email == '') {

                   jQuery('#email_error').html("Please Enter Email for Login");
                   jQuery('#email_error').show().delay(0).fadeIn('show');
                   jQuery('#email_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#email').offset().top - 150
                   }, 1000);
                   return false;

               }



               var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

               if (!filter.test(email)) {

                   jQuery('#email_error').html("Please Enter Valid Email for Login");
                   jQuery('#email_error').show().delay(0).fadeIn('show');
                   jQuery('#email_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#email').offset().top - 150
                   }, 1000);
                   return false;

               }

               var mobile = jQuery("#mobile").val();
               var filter = /^\d{10}$/;

               if (mobile != '' && !filter.test(mobile)) {

                   jQuery('#mobile_error').html("Please Enter Valid Mobile");
                   jQuery('#mobile_error').show().delay(0).fadeIn('show');
                   jQuery('#mobile_error').show().delay(2000).fadeOut('show');
                   $('html, body').animate({
                       scrollTop: $('#mobile').offset().top - 150
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
