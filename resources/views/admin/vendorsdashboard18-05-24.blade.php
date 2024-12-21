   @extends('admin.includes.Template')

   @section('content')

       <style type="text/css">
           .modal-dialog {
               max-width: 50%
           }
       </style>

       <div class="content container-fluid">

           <div class="success">

               @if ($message = Session::get('login_success'))
                   <div class="alert alert-success alert-dismissible fade show" style="text-align: center;">

                       {{ $message }}

                       <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                   </div>
               @endif

           </div>

           <!-- Page Header -->

           @php
               //    echo '<pre>';
               //    print_r(Auth::user()->vendor);
               //    echo '</pre>';
               //    exit();
           @endphp
           <h4>Welcome, {{ Auth::user()->name }} Dashboard</h4> <br />

           @php

               $vendor_id = Auth::user()->id;

               $vendor_data = DB::table('users')
                   ->where('id', $vendor_id)
                   ->first();

               $subscription_data = DB::table('subscription')
                   ->where('vendor_id', $vendor_id)
                   ->orderBy('id', 'DESC')
                   ->get();

               if ($subscription_data != '') {
                   $no_of_inquiry = 0;

                   foreach ($subscription_data as $subscription_data_new) {
                       $subscription_subservice_attribute = DB::table('subscription_subservice_attribute')
                           ->where('subscription_id', $subscription_data_new->id)
                           ->orderBy('id', 'DESC')
                           ->get();

                       if ($subscription_subservice_attribute != '') {
                           foreach ($subscription_subservice_attribute as $subscription_subservice_attribute_data) {
                               $no_of_inquiry += $subscription_subservice_attribute_data->no_of_inquiry;
                               //echo '<pre>';print_r($subscription_subservice_attribute_data);echo '</pre>';
                           }
                       }
                   }
               } else {
                   $no_of_inquiry = 0;
               }

               $accept_lead_data = DB::table('package_inquiry_accepted')
                   ->where('vendor_id', $vendor_id)
                   ->orderBy('id', 'DESC')
                   ->get();

               $accept_lkead_count = 0;

               if ($accept_lead_data != '') {
                   foreach ($accept_lead_data as $accept_lead_data_new) {
                       $accept_lkead_count += 1;
                   }
               }

               $pending_lead = $no_of_inquiry - $accept_lkead_count;

               // echo '<pre>';print_r($accept_lkead_count);echo '</pre>';

               //echo $no_of_inquiry;

           @endphp

           <div class="row">
               <div class="col-xl-3 col-sm-6 col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header">
                               <span class="dash-widget-icon bg-1">
                                   <i class="fas fa-dollar-sign"></i>
                               </span>
                               <div class="dash-count">
                                   <div class="dash-title">Wallet Amount</div>
                                   <div class="dash-counts">
                                       <p>{{ $vendor_data->wallet_amount }}</p>
                                   </div>
                               </div>
                           </div>
                           <div class="progress progress-sm mt-3">
                               <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75"
                                   aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <!--<p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>1.15%</span> since last week</p>-->
                       </div>
                   </div>
               </div>
               <div class="col-xl-3 col-sm-6 col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header">
                               <span class="dash-widget-icon bg-2">
                                   <i class="fas fa-users"></i>
                               </span>
                               <div class="dash-count">
                                   <div class="dash-title">Current Active Leads</div>
                                   <div class="dash-counts">
                                       <p>{{ $no_of_inquiry }}</p>
                                   </div>
                               </div>
                           </div>
                           <div class="progress progress-sm mt-3">
                               <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75"
                                   aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <!--<p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>2.37%</span> since last week</p>-->
                       </div>
                   </div>
               </div>
               <div class="col-xl-3 col-sm-6 col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header">
                               <span class="dash-widget-icon bg-3">
                                   <i class="fas fa-file-alt"></i>
                               </span>
                               <div class="dash-count">
                                   <div class="dash-title">Accepted Leads</div>
                                   <div class="dash-counts">
                                       <p>{{ $accept_lkead_count }}</p>
                                   </div>
                               </div>
                           </div>
                           <div class="progress progress-sm mt-3">
                               <div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75"
                                   aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <!--<p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>3.77%</span> since last week</p>-->
                       </div>
                   </div>
               </div>
               <div class="col-xl-3 col-sm-6 col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header">
                               <span class="dash-widget-icon bg-4">
                                   <i class="far fa-file"></i>
                               </span>
                               <div class="dash-count">
                                   <div class="dash-title">Pending Leads</div>
                                   <div class="dash-counts">
                                       <p>{{ $pending_lead }}</p>
                                   </div>
                               </div>
                           </div>
                           <div class="progress progress-sm mt-3">
                               <div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75"
                                   aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <!--<p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>8.68%</span> since last week</p>-->
                       </div>
                   </div>
               </div>
           </div>


           @php
               $vendor_id = Auth::user()->id;
               $currentDate = now();
               $result = DB::table('subscription')
                   ->where('vendor_id', $vendor_id)
                   ->get();

               $result = $result->map(function ($item) use ($currentDate) {
                   $item->status = $item->enddate >= $currentDate ? 'active' : 'inactive';
                   return $item;
               });

               //    echo '<pre>';
               //    print_r($subscription_data);
               //    echo '</pre>';
               //    exit();

           @endphp

           <div class="table-responsive">

               <table class="table table-stripped table-hover">
                   <thead class="thead-light">
                       <tr>
                           <th>Subscription</th>
                           <th>Amount</th>
                           <th>Start Date</th>
                           <th>End Date</th>

                           <th>Status</th>
                           <th>Details</th>

                           <th class="text-right">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($result as $subscription)
                           <tr>
                               <th>{{ $subscription->subscription_name }}</th>
                               <td>{{ $subscription->total }}</td>
                               <td>{{ date('d-m-Y', strtotime($subscription->startdate)) }}</td>
                               <td>{{ date('d-m-Y', strtotime($subscription->enddate)) }}</td>

                               <td>
                                   @if ($subscription->status == 'inactive')
                                       <span class="badge badge-pill bg-danger-light">Inactive</span>
                                   @endif
                                   @if ($subscription->status == 'active')
                                       <span class="badge badge-pill bg-success-light">Active</span>
                                   @endif

                               </td>
                               <td>
                                   <a class="btn btn-primary" href="javascript:void('0');"
                                       onclick="delete_category('{{ $subscription->id }}');">View
                                       Services
                                   </a>
                               </td>

                               <td class="text-right">
                                   <div class="dropdown dropdown-action">
                                       <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                           aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                       <div class="dropdown-menu dropdown-menu-right">
                                           <a class="dropdown-item"
                                               href="{{ route('subscription-details.show', $subscription->id) }}"><i
                                                   class="far fa-eye me-2"></i>View Detail
                                           </a>

                                           <a class="dropdown-item"
                                               href="{{ route('vendor-invoice', ['id' => $subscription->id]) }}"><i
                                                   data-feather="clipboard" class="me-2"></i>Invoice
                                           </a>
                                       </div>
                                   </div>
                               </td>
                           </tr>
                       @endforeach

                   </tbody>
               </table>
           </div>

       </div>

   @stop
   @section('footer_js')
<script src="{{ asset('public/admin/assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
   <script src="{{ asset('public/admin/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

       <!-- Delete  Modal -->
       @if ($result != '')
           @foreach ($result as $data)
               <div class="modal custom-modal fade" id="delete_model_{{ $data->id }}" role="dialog">

                   <div class="modal-dialog modal-dialog-centered">

                       <div class="modal-content">

                           <div class="modal-body">


                               <div class="modal-text text-center">

                                   <!-- <h3>Delete Expense Category</h3> -->

                                   @php

                                       $result = DB::table('subscription_subservice_attribute')
                                           ->select('*')
                                           ->where('subscription_id', '=', $data->id)
                                           ->get();

                                       //$servicename = Helper::servicename($result->service_id);

                                       //echo"<pre>";print_r($servicename);echo"</pre>";

                                   @endphp
                                   @if ($result != '')
                                       <div class="row">
                                           <div class="col-md-12">
                                               <div class="table-responsive">
                                                   <table class="invoice-table table table-bordered">
                                                       <thead>
                                                           <tr>
                                                               <th>Services</th>
                                                               <th>Sub Services</th>
                                                               <th class="text-end">Price</th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                           @php
                                                               $total = 0;
                                                           @endphp
                                                           @foreach ($result as $result_data)
                                                               <tr>
                                                                   <td>{!! Helper::servicename($result_data->service_id) !!}</td>
                                                                   <td>{!! Helper::subservicename($result_data->subservice_id) !!}</td>
                                                                   <td>{{ $result_data->charge }}</td>
                                                               </tr>
                                                               @php
                                                                   $total += $result_data->charge;
                                                               @endphp
                                                           @endforeach
                                                       </tbody>
                                                   </table>

                                                   <div class="col-md-6 col-xl-4 ms-auto">
                                                       <div class="table-responsive">
                                                           <table class="invoice-table-two table">
                                                               <tbody>
                                                                   <tr>
                                                                       <th>Total :</th>
                                                                       <td><span>{{ $total }}</span></td>
                                                                   </tr>
                                                               </tbody>
                                                           </table>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>

                                       </div>
                                   @else
                                       <p>No Data Found</p>
                                   @endif

                               </div>

                           </div>
                       </div>

                   </div>

               </div>
           @endforeach
       @endif

       <!-- /Delete Modal -->




       <script>
           function delete_category(id) {

               //    alert(id);

               $('#delete_model_' + id).modal('show');


           }



           function form_sub() {

               $('#form').submit();

           }
       </script>

       <script>
        // Your custom function to be called before the page is unloaded
        function myCustomFunction() {
            // Your code goes here
            //alert('here');
            
                Swal.fire({ position: "top-end", type: "success", title: "Welcome To Vendor City", showConfirmButton: !1, timer: 3000, confirmButtonClass: "btn btn-primary", buttonsStyling: !1 }) 

        }

        $(window).on('load',function(){
            myCustomFunction();
            });

        
    </script>

   @stop
