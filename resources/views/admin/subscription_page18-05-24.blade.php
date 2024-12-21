   @extends('admin.includes.Template')

   @section('content')

 <style type="text/css">
           .modal-dialog{max-width: 50%}
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

           @if ($message = Session::get('success'))
               <div class="alert alert-success alert-dismissible fade show">

                   <strong>Success!</strong> {{ $message }}

                   <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

               </div>
           @endif

           @php

               $subscriber_name = DB::table('users')
                   ->where('id', $id)
                   ->first();

           @endphp

           <h4>Subscription / {{ $subscriber_name->name }}</h4>

           <div class="row">
               <div class="col-xl-4 col-sm-6 col-12 mt-2">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header text-center" style="display:block">
                               <div class="dash-count">
                                   <div class="dash-title"><a href=""
                                           style=" margin-bottom: 25px;display: inline-block;">Total Wallet Amount</a>
                                   </div>
                                   <div class="dash-counts">
                                       <p>{{ $subscriber_name->wallet_amount }}</p>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-xl-4 col-sm-6 col-12 mt-2">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header text-center" style="display:block">
                               <div class="dash-count">
                                   <div class="dash-title"><a href="{{ route('base_on_service_lead', ['id' => $id]) }}"
                                           style=" margin-bottom: 25px;display: inline-block;">Based on Services Leads</a>
                                   </div>
                                   <a href="{{ route('base_on_service_lead', ['id' => $id]) }}"
                                       class="btn btn-rounded btn-outline-primary">Buy Now</a>

                                   {{-- <!-- <div class="dash-counts">
                                        <p>This is Box</p>
                                    </div> --> --}}
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

               @php

                   $price_data = DB::table('prices')
                       ->select('*')
                       ->orderBy('id', 'desc')
                       ->first();

                   //echo "<pre>";print_r($price_data);echo "</pre>";

               @endphp

               @if ($price_data->based_on_booking_service_price != '')
                   <div class="col-xl-4 col-sm-6 col-12 mt-2" style="display: none">


                       <div class="card">
                           <div class="card-body">
                               <div class="dash-widget-header text-center" style="display:block">
                                   <div class="dash-count">
                                       <div class="dash-title"><a
                                               href="{{ route('based_on_booking_services', ['id' => $id]) }}"
                                               style=" margin-bottom: 25px;display: inline-block;">{{ $price_data->based_on_booking_service_label }}</a>
                                       </div>
                                       <a href="{{ route('based_on_booking_services', ['id' => $id]) }}"
                                           class="btn btn-rounded btn-outline-primary">Buy Now</a>


                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               @endif

               @if ($price_data->based_on_listing_criteria_price != '')
                   <div class="col-xl-4 col-sm-6 col-12 mt-2">
                       <div class="card">
                           <div class="card-body">


                               <div class="dash-widget-header text-center" style="display:block">
                                   <div class="dash-count">
                                       <div class="dash-title"><a
                                               href="{{ route('based_on_listing_criteria', ['id' => $id]) }}"
                                               style=" margin-bottom: 25px;display: inline-block;">{{ $price_data->based_on_listing_criteria_label }}</a>
                                       </div>
                                       <a href="{{ route('based_on_listing_criteria', ['id' => $id]) }}"
                                           class="btn btn-rounded btn-outline-primary">Buy Now</a>

                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               @endif

               @php

                   $currentDate = now();

                   $id = $id;

                   $result = DB::table('subscription')
                       ->select('*')
                       ->where('vendor_id', '=', $id)
                       ->where('enddate', '>=', $currentDate)
                       ->orderBy('id', 'desc')
                       ->get();
                   $result_new = $result->toArray();
                   //echo "<pre>";print_r($result_new);echo "</pre>";
               @endphp

               <div class="col-lg-12">
                   <div class="card">
                       <div class="card-header">
                           <h5 class="card-title">Your Subscription Details</h5>
                       </div>
                       <div class="card-body">
                           <div class="table-responsive">
                               @if (isset($result_new) && !empty($result_new))
                                   <table class="table table-striped mb-0">
                                       <thead>
                                           <tr>
                                               <th>Subscription Name</th>
                                               <th>Total</th>
                                               <th>Start Date</th>
                                               <th>End Date</th>
                                               <th>Status</th>
                                               <th>Detail</th>
                                           </tr>
                                       </thead>
                                       <tbody>

                                           @foreach ($result_new as $subs_data)
                                               <tr>
                                                   <td>{{ $subs_data->subscription_name }}</td>
                                                   <td>{{ $subs_data->total }}</td>
                                                   <td>{{ date('d-m-Y', strtotime($subs_data->startdate)) }}</td>
                                                   <td>{{ date('d-m-Y', strtotime($subs_data->enddate)) }}</td>
                                                   <td> <span class="badge badge-pill bg-success-light">Active</span></td>
                                                    <td><a class="btn btn-primary" href="javascript:void('0');" onclick="delete_category('{{$subs_data->id}}');">View Services</a></td>
                                               </tr>
                                           @endforeach

                                       </tbody>
                                   </table>
                               @else
                                   {{ 'No Data Found' }}

                               @endif
                           </div>
                       </div>
                   </div>
               </div>

           </div>


       </div>

   @stop

   <!-- Delete  Modal -->
   @if($result_new != '')
   @foreach ($result_new as $data)
   <div class="modal custom-modal fade" id="delete_model_{{$data->id}}" role="dialog">

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
                       @if($result != '')
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
                                            @foreach($result as $result_data)
                                            <tr>
                                                <td>{!! Helper::servicename($result_data->service_id) !!}</td>
                                                <td>{!! Helper::subservicename($result_data->subservice_id) !!}</td>
                                                <td>{{$result_data->charge}}</td>
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
                                                        <td><span>{{$total}}</span></td>
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

               <!-- <div class="modal-footer text-center">

                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                   <button type="button" class="btn btn-primary" onclick="form_sub();">Delete</button>

               </div> -->

           </div>

       </div>

   </div>
   @endforeach
   @endif
<script>

       function delete_category(id) {

           

               $('#delete_model_'+id).modal('show');

           
       }




   </script>