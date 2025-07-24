   @extends('admin.includes.Template')

   @section('content')

       @php

           $userId = Auth::id();

           $get_user_data = Helper::get_user_data($userId);

        //    $get_permission_data = Helper::get_permission_data($get_user_data->role_id);

        //    $edit_perm = [];

        //    if ($get_permission_data->editperm != '') {
        //        $edit_perm = $get_permission_data->editperm;

        //        $edit_perm = explode(',', $edit_perm);
        //    }
        $roleIds = explode(',', $get_user_data->role_id);

			$edit_perm = [];

			foreach ($roleIds as $roleId) {
				$roleId = trim($roleId); // Clean any spaces
				
				$get_permission_data = Helper::get_permission_data($roleId);

				if (
					is_object($get_permission_data) &&
					property_exists($get_permission_data, 'editperm') &&
					$get_permission_data->editperm != ''
				) {
					$perms = explode(',', $get_permission_data->editperm);
					$edit_perm = array_merge($edit_perm, $perms); // Combine permissions
				}
			}

			// Optional: remove duplicates and reset array keys
			$edit_perm = array_values(array_unique($edit_perm));


       @endphp



       <div class="content container-fluid">





           <!-- Page Header -->

           <div class="page-header">

               <div class="row align-items-center">

                   <div class="col">

                       <h3 class="page-title">Garden & Mouse Rejected Leads</h3>

                       <ul class="breadcrumb">

                           <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>

                           </li>

                           <li class="breadcrumb-item active">Garden & Mouse Rejected Leads</li>

                       </ul>

                   </div>

                   <div class="col-auto">
                    
                    {{-- <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
                        <i class="fas fa-filter"></i>
                    </a> --}}

                    
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

                                //    $package_inquiry_accepted = DB::table('package_inquiry_accepted')
                                //        ->select('*')
                                //        ->where('vendor_id', '=', $userId)
                                //        ->where('accept_reject', 0)
                                //        ->orderBy('id', 'desc')
                                //        ->get();

                                   //echo"<pre>";print_r($resultArray);echo"</pre>";

                               @endphp

                               <div class="table-responsive">

                                   <table class="table table-center table-hover datatable" id="example">

                                       <thead class="thead-light">

                                           <tr>
                                               <th style="display: none">Sr No</th>
                                               <th>Date</th>
                                               <th>Vendor Name</th>
                                               <th>Inquiry No</th>
                                               <th>Rejected Date</th>
                                               <th>Name</th>
                                               {{-- <th>Email</th>
                                               <th>Mobile</th> --}}
                                               <th>Service</th>
                                               <th>Sub Service</th>
                                               {{-- <th>view</th> --}}
                                               {{-- <th>Lead Info</th> --}}

                                           </tr>

                                       </thead>

                                       <tbody>

                                        @php
                                        //    echo"<pre>";print_r($package_inquiry_accepted);echo"</pre>";
                                        @endphp

                                           @if ($package_inquiry_accepted != '')

                                               @php
                                                   $i = 1;
                                               @endphp

                                               @foreach ($package_inquiry_accepted as $package_inquiry_accepted_data)
                                                   @php

                                                       $packages_enquiry_data = DB::table('packages_enquiry')
                                                           ->select('*')
                                                           ->where(
                                                            'id',
                                                            '=',
                                                            $package_inquiry_accepted_data->packages_inquiry_id,
                                                           )
                                                           ->first();

                                                        $service_quote_includes = DB::table('service_quote_includes')->where('service_id',$packages_enquiry_data->service_id)->get();

                                                        //   echo '<pre>';
                                                        //   print_r($service_quote_includes);
                                                        //   echo '</pre>';
                                                        //   exit();
                                                   @endphp
                                                   <tr>

                                                       <td style="display: none">{{ $i }}</td>
                                                       

                                                       <td>{{ date('d-m-Y', strtotime($packages_enquiry_data->added_date))}}</td>
                                                       <td>{!! Helper::vendorsname($package_inquiry_accepted_data->vendor_id) !!}</td>
                                                            <td>{{ $packages_enquiry_data->inquiry_id }}</td>

                                                            <td>{{ date('d-m-Y', strtotime($package_inquiry_accepted_data->added_date))}}</td>

                                                            <td>{{ $packages_enquiry_data->name ?? '' }}</td>
                                                       {{-- <td>{{ $packages_enquiry_data->email ?? '' }}</td>
                                                       <td>{{ $packages_enquiry_data->mobile ?? '' }}</td> --}}

                                                       {{-- <td>{{ $packages_enquiry_data->name }}</td> --}}
                                                       {{-- <td>{{ $packages_enquiry_data->email }}</td> --}}
                                                       {{-- <td>{{ $packages_enquiry_data->mobile }}</td> --}}

                                                       <td>
                                                           @if ($packages_enquiry_data->service_id ?? '')
                                                               {!! Helper::servicename(strval($packages_enquiry_data->service_id)) !!}
                                                           @endif
                                                       </td>
                                                       <td>
                                                           @if ($packages_enquiry_data->subservice_id ?? '')
                                                               {!! Helper::subservicename(strval($packages_enquiry_data->subservice_id)) !!}
                                                           @endif

                                                       </td>
                                                       {{-- <td>
                                                        {{-- <td>
                                                            <a class="btn btn-primary" href="javascript:void(0)"
                                                                onclick="quotes_leads('{{ $package_inquiry_accepted_data->id }}');">View</a>
                                                        </td> 
                                                       
                                                       </td> --}}
                                                       {{-- <td>
                                                           <a class="btn btn-primary"
                                                               href="{{ url('enquiry_details', $packages_enquiry_data->id) }}">View Information</a>
                                                       </td> --}}

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

       @foreach ($package_inquiry_accepted as $package_inquiry_accepted_data)
    @php
        $packge_inquiry_data = DB::table('packages_enquiry')->where('id',$package_inquiry_accepted_data->packages_inquiry_id)->first();

        $quote_includes_data = DB::table('qoute_includes')->where('package_inquiry_accepted_id',$package_inquiry_accepted_data->id)->get()->toArray();

       

        //   echo"<pre>";print_r($quote_includes_data);echo"</pre>";exit;
       @endphp
    <div class="modal custom-modal fade" id="show_comment_model_{{ $package_inquiry_accepted_data->id }}" role="dialog">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 50% !important;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-text text-center"></div>
                    <div class="modal-text text-center" id="dropdownreplace">
                        <div class="row">
                            <div id="quotes_leads">

                                <style>
                                    #table_new,#table_new
                                    th,
                                    #table_new td {
                                        border: 1px solid black;
                                        border-collapse: collapse;
                                    }
                                    #table_new td{
                                        text-align: left;
                                    }

                                    </style>
                           
                                <table style="width:100%" id="table_new">
                                     <h6>{{$packge_inquiry_data->name}}</h6>   
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @php
                                                $i=0;
                                            @endphp

                                            @foreach($quote_includes_data as $quote_includes_data_new)

                                            @if($i == 0)

                                                @if($quote_includes_data_new->accept_lead == 'Enter Qoute')
                                                    {{'Quoted'}}
                                                    @else
                                                        {{' Requested a Survey'}}
                                                    @endif
                                            @endif

                                            @php
                                            $i++;
                                        @endphp
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>Service Requested</td>
                                        
                                    @if($packge_inquiry_data->form_type  != '')
                                    <td>
                                        {{ $packge_inquiry_data->form_type }}
                                    </td>
                                    @else
                                    <td>{{'NA'}}</td>
                                    @endif  



                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$packge_inquiry_data->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td>{{$packge_inquiry_data->mobile}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Move Type</td>
                                        <td>VILLA</td>
                                    </tr>
                                    <tr>
                                        <td>Move Size</td>
                                        <td>1BR</td>
                                    </tr>
                                    <tr>
                                        <td>Service Date</td>
                                        <td>03/06/2024</td>
                                    </tr> --}}
                            
                                    @foreach($quote_includes_data as $quote_data)
                                    <tr>
                                        <td>{{$quote_data->qoute_includes_name}}</td>
                                        <td>{{$quote_data->qoute_include_value}}</td>
                                    </tr>
                                    @endforeach
                             
                                    {{-- <tr>
                                        <td>Packaging Material</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Packing Service</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Handyman</td>
                                        <td>Yes</td>
                                    </tr> --}}
                                    
                                </table>
                                
                               

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endforeach


       <script>

           

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
