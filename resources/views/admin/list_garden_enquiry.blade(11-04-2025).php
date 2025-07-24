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
                    <h3 class="page-title">Garden and Mouse Enquiry</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Garden and Mouse Enquiry</li>
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
                                            <th>Status</th>
                                            <th>Service</th>
                                            <th>Sub Service</th>
                                            <th>Service Type</th>
                                            <th>Type of Home</th>
                                            <th>Size of Home</th>
                                            <th>Service Date</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            {{-- <th>view</th> --}}
                                            <th>Assign Vendor</th>
                                            {{-- <th>Email</th> --}}
                                            <th>Lead Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($garden_enquiry != '')
                                            @php
                                                $i = 1;
                                            @endphp
                                            
                                            @foreach ($garden_enquiry as $garden_data)
                                                <tr>
                                                    <td style="display: none">{{ $i }}</td>

                                                    @php
                                                        $package_enquiry = DB::table('packages_enquiry')->where('id', $garden_data->inquiry_id)->first();
                                                    @endphp
                                                    
                                                    <td>{{ date('d-m-Y', strtotime($garden_data->added_date))}}</td>

                                                     <td>{{ $package_enquiry->inquiry_id }}</td>
                                                   
                                                     <td><a href="javascript:void(0)"
                                                        onclick="agent_detail('{{ $garden_data->id }}');">{{ $package_enquiry->count }}/5 Accepted
                                                    </a></td>

                                                     <td>
                                                         @if ($garden_data->service ?? '')
                                                             {!! Helper::servicename(strval($garden_data->service)) !!}
                                                         @endif
                                                     </td>
                                                     <td>
                                                         @if ($garden_data->subservice ?? '')
                                                             {!! Helper::subservicename(strval($garden_data->subservice)) !!}
                                                         @endif
                                                     </td>
                                                     
                                                     <td>
                                                        @if($garden_data->service_type != "")
                                                        {{ $garden_data->service_type }}
                                                        @else
                                                        -
                                                        @endif
                                                    </td>

                                                     <td>
                                                        @if($garden_data->type_of_home != "" && $garden_data->type_of_home != null)
                                                        {{ $garden_data->type_of_home }}
                                                        @else
                                                        -   
                                                        @endif
                                                    </td>

                                                     <td>
                                                        @if($garden_data->size_of_home != "" && $garden_data->size_of_home != null)
                                                        {{ $garden_data->size_of_home }}
                                                        @else
                                                        -
                                                        @endif
                                                    </td>

                                                     <td>{{ $garden_data->service_date }}</td>
                                                     <td>{{ $garden_data->user_name ?? '' }}</td>
                                                     <td>{{ $garden_data->user_email ?? '' }}</td>
                                                     <td>{{ $garden_data->user_mobile ?? '' }}</td>
                                                     <td>

                                                         <p>
                                                             @if($garden_data->vendor_id != 0 && $garden_data->vendor_id != '')
                                                                 {!! Helper::vendorsnamepainting(explode(",",$garden_data->vendor_id)) !!}
                                                             @endif
                                                             </p>


                                                         <a class="btn btn-primary" href="javascript:void(0)" onclick="garden_assign_vendor('{{$garden_data->id}}');">Assign Vendor</a>
                                                     </td>
                                                    
                                                     <td>    
                                                     <a class="btn btn-primary"
                                                         href="{{ url('garden-enquiry-view', $garden_data->inquiry_id) }}">View Information</a>
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

    <!-- Vendor Status Modal -->
    @foreach ($garden_enquiry as $garden_data)


    @php

   

    $packages_accepted_data = DB::table('package_inquiry_accepted')
                            ->select('*')
                            ->where('subscription_type','!=','A')
                            ->where('packages_inquiry_id','=',$garden_data->inquiry_id)
                            ->get();

    // echo"<pre>";print_r($packages_accepted_data);echo"</pre>";exit;

    $id = $garden_data->id;
    @endphp
    <div class="modal custom-modal fade" id="show_comment_model_{{$id}}" role="dialog">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-text text-center"></div>
                    <div class="modal-text text-center" id="dropdownreplace">
                        <div class="row">
                            <div id="agent_detail">
                                @if($packages_accepted_data)
                                    <div class="table-responsive mb-30" style="margin-bottom: 40px;">
                                        <table class="table mb-30">
                                            <thead>
                                                <tr>
                                                    <th>Vendor Name</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($packages_accepted_data as $data)

                                                    <tr>
                                                        <td>{!! Helper::vendorsname($data->vendor_id) !!}</td>
                                                       <td>{{ $garden_data->user_name ?? '' }}</td>
                                                       <td>{{ $garden_data->user_email ?? '' }}</td>
                                                       <td>{{ $data->price_of_lead ?? '0' }}</td>
                                                

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div>No Agent Data Found.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
    <!-- /set orderModal -->

    <!-- Assign Vendor  Modal -->
<div class="modal custom-modal fade" id="assign_vendor_model" role="dialog">
 <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
         <form id="garden_vendor_form" action="{{ url('garden-vendor-form') }}" method="POST" enctype="multipart/form-data">
             @csrf
         <div class="modal-body">
             
             <div class="modal-text text-center">
                 <!-- <h3>Delete Expense Category</h3> -->
                 <!-- <p>Select Vendor</p> -->
             </div>
             <div class="modal-text text-center" id="dropdownreplace_new">
             </div>
             <p class="form-error-text" id="painting_vendor_id_error" style="color: red; margin-top: 10px;"></p>
         </div>
         <div class="modal-footer text-center">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-primary" onclick="form_sub_vendor();">Submit</button>
         </div>
         </form>
     </div>
 </div>
</div>

<script>

     function garden_assign_vendor(inquiry_id){

         var url = '{{ url('garden-assign-vendor') }}';
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
     var vendor_id = jQuery("#painting_vendor_id").val();
         if (vendor_id == '') {
             jQuery('#painting_vendor_id_error').html("Please Select Vendor");
             jQuery('#painting_vendor_id_error').show().delay(0).fadeIn('show');
             jQuery('#painting_vendor_id_error').show().delay(2000).fadeOut('show');
             
             return false;
         }
     $('#garden_vendor_form').submit();
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
        function agent_detail(id) {
            $('#show_comment_model_'+ id).modal('show');
            }
    </script>
@stop
