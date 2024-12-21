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

                       <h3 class="page-title">Accepted Leads</h3>

                       <ul class="breadcrumb">

                           <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>

                           </li>

                           <li class="breadcrumb-item active">Accepted Leads</li>

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



           <!-- Search Filter -->

           <div id="filter_inputs" class="card filter-card">

               <div class="card-body pb-0">

                   <div class="row">

                       <div class="col-sm-6 col-md-3">

                           <div class="form-group">

                               <label>Name</label>

                               <input type="text" class="form-control">

                           </div>

                       </div>

                       <div class="col-sm-6 col-md-3">

                           <div class="form-group">

                               <label>Email</label>

                               <input type="text" class="form-control">

                           </div>

                       </div>

                       <div class="col-sm-6 col-md-3">

                           <div class="form-group">

                               <label>Phone</label>

                               <input type="text" class="form-control">

                           </div>

                       </div>

                   </div>

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

                                   $package_inquiry_accepted = DB::table('package_inquiry_accepted')
                                       ->select('*')
                                       ->where('vendor_id', '=', $userId)
                                       ->where('accept_reject', 0)
                                       ->orderBy('id', 'desc')
                                       ->get();

                                   //echo"<pre>";print_r($resultArray);echo"</pre>";

                               @endphp

                               <div class="table-responsive">

                                   <table class="table table-center table-hover datatable" id="example">

                                       <thead class="thead-light">

                                           <tr>
                                               <th>Sr No</th>
                                               <th>Name</th>
                                               <th>Email</th>
                                               <th>Mobile</th>
                                               <th>Service</th>
                                               <th>Sub Service</th>

                                           </tr>

                                       </thead>

                                       <tbody>

                                           @if ($package_inquiry_accepted != '')

                                               @php
                                                   $i = 1;
                                               @endphp

                                               @foreach ($package_inquiry_accepted as $package_inquiry_accepted_data)
                                                   @php

                                                       $packages_enquiry_data = DB::table('packages_enquiry')
                                                           ->select('*')
                                                           ->where('id', '=', $package_inquiry_accepted_data->packages_inquiry_id)
                                                           ->first();
                                                       //    echo '<pre>';
                                                       //    print_r($packages_enquiry_data);
                                                       //    echo '</pre>';
                                                       //    exit();
                                                   @endphp
                                                   <tr>

                                                       <td>{{ $i }}</td>
                                                       <td>{{ $packages_enquiry_data->name ?? '' }}</td>
                                                       <td>{{ $packages_enquiry_data->email ?? '' }}</td>
                                                       <td>{{ $packages_enquiry_data->mobile ?? '' }}</td>

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



       <script>
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
