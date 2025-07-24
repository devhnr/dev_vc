@extends('admin.includes.Template')
@section('content')
    @php
        $userId = Auth::id();
        $get_user_data = Helper::get_user_data($userId);
        $get_permission_data = Helper::get_permission_data($get_user_data->role_id);
        $edit_perm = [];
        if ($get_permission_data->editperm != '') {
            $edit_perm = $get_permission_data->editperm;
            $edit_perm = explode(',', $edit_perm);
        }
    @endphp
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Wooden Floor Polishing Leads Enquiry</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Wooden Floor Polishing Leads Enquiry</li>
                    </ul>
                </div>
                {{-- <div class="col-auto">
                 <a class="btn btn-primary me-1" href="javascript:void('0');" onclick="excel_download();">Excel Download</a>
                 
                 <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
                     <i class="fas fa-filter"></i>
                 </a>
                 
             </div> --}}
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <strong>Success!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($message = Session::get('vendor-assigned-error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <form method="GET" action="{{ url('filter_data') }}" id="filter_data">
         <input type="hidden" name="filter_vendor_id_fil" id="filter_vendor_id_fil" value="">
     </form>
        <div class="alert alert-success alert-dismissible fade show success_show" style="display: none;">
            <strong>Success! </strong><span id="success_message"></span>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert"></button> -->
        </div>
        @php
             if(!empty($filter_vendor_id)){
                 $css = "display:block;";
             }else{
                 $css = "display:none;";
             }
         @endphp
        <!-- Search Filter -->
        <div id="filter_inputs" class="card filter-card" style="{{ $css }}">
            <div class="card-body pb-0">
             <form id="filter_form" action="{{ route('enquiry_accept') }}" method="POST">
                 @csrf
                 <input type="hidden" name="action" value="filter">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Vendor</label>
                             <select class="select select2-hidden-accessible" id="vendor_id" name="vendor_id">
                                 <option value ="">Select Vendor</option>
                                 @if(!empty($all_vendor))
                                     @foreach($all_vendor as $all_vendor_data)
                                         <option value="{{ $all_vendor_data->id }}" @if($filter_vendor_id == $all_vendor_data->id ) {{ 'selected' }} @endif>{{ $all_vendor_data->name }}</option>
                                     @endforeach
                                 @endif
                             </select>
                             <p class="form-error-text" id="vendor_id_error"
                                         style="color: red; margin-top: 10px;"></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                         <div class="form-group">
                             <a class="btn btn-primary filter-btn" href="javascript:void(0);" style="
                             margin-top: 22px;
                         " onclick="filter_validation()">
                                Submit
                             </a>
                             <a class="btn btn-primary filter-btn" href="{{ route('enquiry_accept') }}" style="
                             margin-top: 22px;">Reset</a>
                         </div>
                    </div>
                </div>
             </form>
            </div>
        </div>
        <!-- /Search Filter -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <form id="form" action="" enctype="multipart/form-data">
                            <INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand(); ?>">
                            @csrf
                            @php
                                $userId = Auth::id();
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable" id="example">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="display: none">Sr No</th>
                                            <th>Date</th>
                                            <th>Inquiry No</th>
                                            <th>Type Of Property</th>
                                            <th>Service</th>
                                            <th>Sub Service</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            {{-- <th>view</th> --}}
                                            <th>Assign Vendor</th>
                                            <th>Email</th>
                                            <th>Lead Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($wooden_floor_enquiry != '')
                                            @php
                                                $i = 1;
                                            @endphp
                                             {{-- @php
                                             echo "<pre>";print_r($painting_enquiry);echo "</pre>";exit;
                                         @endphp --}}
                                            @foreach ($wooden_floor_enquiry as $wooden_data)
                                                <tr>
                                                    <td style="display: none">{{ $i }}</td>
                                                    
                                                    <td>{{ date('d-m-Y', strtotime($wooden_data->added_date))}}</td>
                                                     <td>{{ $wooden_data->inquiry_id }}</td>
                                                     <td>{{ $wooden_data->property_type }}</td>
                                                     <td>
                                                         @if ($wooden_data->service_id ?? '')
                                                             {!! Helper::servicename(strval($wooden_data->service_id)) !!}
                                                         @endif
                                                     </td>
                                                     <td>
                                                         @if ($wooden_data->subservice_id ?? '')
                                                             {!! Helper::subservicename(strval($wooden_data->subservice_id)) !!}
                                                         @endif
                                                     </td>
                                                     <td>{{ $wooden_data->name ?? '' }}</td>
                                                     <td>{{ $wooden_data->email ?? '' }}</td>
                                                     <td>{{ $wooden_data->mobile ?? '' }}</td>
                                                     <td>

                                                         <p>
                                                             @php
                                                                 // echo "<pre>";print_r(explode(",",$painting_data->vendor_id));echo "</pre>";exit;
                                                             @endphp
                                                             @if($wooden_data->vendor_id != 0 && $wooden_data->vendor_id != '')
                                                                 {!! Helper::vendorsnamepainting(explode(",",$wooden_data->vendor_id)) !!}
                                                             @endif
                                                             </p>


                                                         <a class="btn btn-primary" href="javascript:void(0)" onclick="assign_vendor('{{$wooden_data->id}}');">Assign Vendor</a>
                                                     </td>
                                                     <td>

                                                         <p>
                                                             @php
                                                                 // echo "<pre>";print_r(explode(",",$painting_data->vendor_id));echo "</pre>";exit;
                                                             @endphp
                                                             @if($wooden_data->vendor_id_for_email != 0 && $wooden_data->vendor_id_for_email != '')
                                                                 {!! Helper::vendorsnamepainting(explode(",",$wooden_data->vendor_id_for_email)) !!}
                                                             @endif
                                                             </p>

                                                         <a class="btn btn-primary" href="javascript:void(0)" onclick="email_to_vendor('{{$wooden_data->id}}');">Email</a>
                                                     </td>
                                                     <td>    
                                                     <a class="btn btn-primary"
                                                         href="{{ url('wooden-floor-lead-detail', $wooden_data->id) }}">View Information</a>
                                                 </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        @else
                                            <p>No Data Found</p>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <!-- Delete  Modal -->
    <div class="modal custom-modal fade" id="delete_model" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-icon text-center mb-3">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </div>
                    <div class="modal-text text-center">
                        <!-- <h3>Delete Expense Category</h3> -->
                        <p>Are you sure want to delete?</p>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="form_sub();">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->
    <!-- Select one record Category Modal -->
    <div class="modal custom-modal fade" id="select_one_record" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-text text-center">
                        <h3>Please select at least one record to delete</h3>
                        <!-- <p>Are you sure want to delete?</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Select one record Category Modal -->
    <!-- set order Modal -->
    <div class="modal custom-modal fade" id="set_order_model" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-text text-center">
                        <h3>Are you sure you want to Set order of Groups</h3>
                        <input type="hidden" name="set_order_val" id="set_order_val" value="">
                        <input type="hidden" name="set_order_id" id="set_order_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" onclick="updateorder();">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /set orderModal -->

    <!-- Assign Vendor  Modal -->
<div class="modal custom-modal fade" id="assign_vendor_model" role="dialog">
 <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
         <form id="wooden_vendor_form" action="{{ url('wooden-vendor-form') }}" method="POST" enctype="multipart/form-data">
             @csrf
         <div class="modal-body">
             
             <div class="modal-text text-center">
                 <!-- <h3>Delete Expense Category</h3> -->
                 <!-- <p>Select Vendor</p> -->
             </div>
             <div class="modal-text text-center" id="dropdownreplace_new">
             </div>
             <p class="form-error-text" id="wooden_vendor_id_error" style="color: red; margin-top: 10px;"></p>
         </div>
         <div class="modal-footer text-center">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-primary" onclick="form_sub_vendor();">Submit</button>
         </div>
         </form>
     </div>
 </div>
</div>


<!-- Email to Vendor  Modal -->
<div class="modal custom-modal fade" id="email_vendor_model" role="dialog">
 <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
         <form id="wooden_email_to_vendor" action="{{ url('wooden-wallet-vendor') }}" method="POST" enctype="multipart/form-data">
             @csrf
         <div class="modal-body">
             
             <div class="modal-text text-center">
                 <!-- <h3>Delete Expense Category</h3> -->
                 <!-- <p>Select Vendor</p> -->
             </div>
             <div class="modal-text text-center" id="dropdownreplace_vendor">
             </div>
             <p class="form-error-text" id="wooden_email_vendor_id_error" style="color: red; margin-top: 10px;"></p>
         </div>
         <div class="modal-footer text-center">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-primary" onclick="form_sub_email_vendor();">Submit</button>
         </div>
         </form>
     </div>
 </div>
</div>
    <script>

     function assign_vendor(inquiry_id){

         var url = '{{ url('wooden-assign-vendor') }}';
         $.ajax({
                 url: url,
                 type: 'post',
                 data: {
                     "_token": "{{ csrf_token() }}",
                     "inquiry_id": inquiry_id
                 },
                 success: function(msg) {
                     // console.log(msg); // Check the response in the console
                     document.getElementById('dropdownreplace_new').innerHTML = msg;
                     $('#assign_vendor_model').modal('show');
                     $('#dropdownreplace_new .select2').select2({
                         dropdownParent: $('#assign_vendor_model'),
                         placeholder: "Select a Vendor",
                         allowClear: false, // Set to false for multiple select to properly display placeholder
                         closeOnSelect: true, // Keep dropdown open for multiple selection if needed
                     });
                 }
         });
     }
     

     function form_sub_vendor() {
     var vendor_id = jQuery("#wooden_vendor_id").val();
         if (vendor_id == '') {
             jQuery('#wooden_vendor_id_error').html("Please Select Vendor");
             jQuery('#wooden_vendor_id_error').show().delay(0).fadeIn('show');
             jQuery('#wooden_vendor_id_error').show().delay(2000).fadeOut('show');
             
             return false;
         }
     $('#wooden_vendor_form').submit();
 }


 function email_to_vendor(inquiry_id){

     var url = '{{ url('wooden-email-vendor') }}';
     $.ajax({
             url: url,
             type: 'post',
             data: {
                 "_token": "{{ csrf_token() }}",
                 "inquiry_id": inquiry_id
             },
             success: function(msg) {
                 // console.log(msg); // Check the response in the console
                 document.getElementById('dropdownreplace_vendor').innerHTML = msg;
                 $('#email_vendor_model').modal('show');
                 $('#dropdownreplace_vendor .select2').select2({
                     dropdownParent: $('#email_vendor_model'),
                     placeholder: "Select a Vendor",
                     allowClear: false, // Set to false for multiple select to properly display placeholder
                     closeOnSelect: true, // Keep dropdown open for multiple selection if needed
                 });
             }
     });
     }


 function form_sub_email_vendor() {
     var vendor_id = jQuery("#wooden_vendor_id").val();
     if (vendor_id == '') {
         jQuery('#wooden_email_vendor_id_error').html("Please Select Vendor");
         jQuery('#wooden_email_vendor_id_error').show().delay(0).fadeIn('show');
         jQuery('#wooden_email_vendor_id_error').show().delay(2000).fadeOut('show');
         
         return false;
     }
     $('#wooden_email_to_vendor').submit();
 }
  
 function excel_download() {
         $('#filter_data').submit();
 }
        
         $('#vendor_id').select2();
         function filter_validation(){
             
             var vendor_id = jQuery("#vendor_id").val();
             if (vendor_id == '') {
                 jQuery('#vendor_id_error').html("Please Select Vendor");
                 jQuery('#vendor_id_error').show().delay(0).fadeIn('show');
                 jQuery('#vendor_id_error').show().delay(2000).fadeOut('show');
                 $('html, body').animate({
                     scrollTop: $('#vendor_id').offset().top - 150
                 }, 1000);
                 return false;
             }
             $('#filter_form').submit();
         }
        function delete_category() {
            // alert('test');
            var checked = $("#form input:checked").length > 0;
            if (!checked) {
                $('#select_one_record').modal('show');
            } else {
                $('#delete_model').modal('show');
            }
        }
        function form_sub() {
            $('#form').submit();
        }
        function quotes_leads(id) {
         $('#show_comment_model_'+ id).modal('show');
         }
    </script>
    <script>
        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().destroy();
        }
        $(document).ready(function() {
            $('#example').dataTable({
                "searching": true
            });
        })
    </script>
@stop
