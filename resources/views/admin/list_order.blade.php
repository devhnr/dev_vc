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
                    @if(Route::currentRouteName() == 'cleaning_package_order')
                    <h3 class="page-title">Package Order - Cleaning</h3>
                    @elseif(Route::currentRouteName() == 'painting-service-order')
                    <h3 class="page-title">Package Order - Painting</h3>
                    @else
                    <h3 class="page-title">Package Order - Moving</h3>
                    @endif
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>
                        </li>
                        @if(Route::currentRouteName() == 'cleaning_package_order')
                        <li class="breadcrumb-item active">Package Order - Cleaning</li>
                        @elseif(Route::currentRouteName() == 'painting-service-order')
                        <li class="breadcrumb-item active">Package Order - Painting</li>
                        @else
                        <li class="breadcrumb-item active">Package Order - Moving</li> 
                        @endif
                        {{-- <li class="breadcrumb-item active">Package Order</li> --}}
                    </ul>
                </div>
                @if (in_array('18', $edit_perm))
                    <!-- <div class="col-auto">
                        
                        <a class="btn btn-danger me-1" href="javascript:void('0');" onclick="delete_category();">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div> -->
                @endif
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
                        <form id="form" action="{{ route('delete_order') }}" enctype="multipart/form-data">
                            <INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand(); ?>">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable" id="example">
                                    <thead class="thead-light">
                                        <tr>
                                            <!-- <th>select</th> -->
                                            <th style="display: none">Sr no</th>
                                            <th>Order Id</th>
                                            <th>Order Date</th>
                                            @if(Route::currentRouteName() == 'painting-service-order')
                                            <th>Date & Time</th>
                                            @else
                                            <th>Moving Date</th>
                                            @endif
                                            <th>Service</th>
                                            <th>Sub Service</th>
                                            <th>User Name</th>
                                            <th>Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Status</th>
                                            <th>Payment Id</th>
                                            {{-- <th>Order Status</th>
                                            <th>Create Shipment</th>
                                            <th>Schedule Pickup </th>
                                            <th>Label</th>
                                            <th>Track Order</th> --}}
                                            <th>Assign Vendor</th>
											 <th>Booking Percentage</th>
                                            <th>Action</th>
                                            <th>Add Amount</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                             
                                             if (isset($orders_list) and count($orders_list)) {
                                                foreach ($orders_list as $key => $orders) {

                                           // echo "<pre>";print_r($orders->items);echo"</pre>";
                                        @endphp
                                        
                                        @if(!empty($orders->items))
                                            <tr>
                                                <!-- <td></td> -->
                                                <td style="display: none">{{ $i }}</td>
                                                <td>{{$orders->format_order_id}}</td>
                                                <td>
                                                    @php
                                                    $order_date = strtotime( $orders->created_at);
                                                     echo $mysqldate = date( 'F d, Y', $order_date );
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                    if(Route::currentRouteName() == 'painting-service-order'){

                                                        $date = $orders->items[0]->bookingdate ?? "";
                                                        $month = $orders->items[0]->month ?? "";
                                                        $year = $orders->items[0]->bookingyear ?? "";

                                                        $timeSlot = Helper::timeslotname(strval($orders->items[0]->time_slot));

                                                        if($date != '' && $month != '' && $year != ''){

                                                            echo $month.' '.$date.', '.$year.'<br/>'.$timeSlot;
                                                        
                                                        }else{
                                                            echo "-";
                                                        }

                                                    }else{
                                                        if($orders->moving_date != ''){
                                                            $moving_date = strtotime($orders->moving_date);
                                                        echo $mysqldate = date( 'F d, Y', $moving_date );
                                                        }else{
                                                            echo "-";
                                                        }
                                                    }
                                                    
                                                    
                                                    @endphp
                                                </td>
                                              
                                                <td>
                                                    {!! isset($orders->items[0]) ? Helper::servicename($orders->items[0]->service_id) : '-' !!}
                                                </td>
                                                <td>
                                                    {!! isset($orders->items[0]) ? Helper::subservicename($orders->items[0]->subservice_id) : '-' !!}
                                                </td>
                                                
                                                <td>{{$orders->user_name}}</td>
                                                <td>{{number_format($orders->order_total,2);}}</td>
                                                <td>
                                                    @if ($orders->paymentmode == '1')
                                                        Cash On Delivery
                                                    @elseif ($orders->paymentmode == '2')
                                                        Online Payment
                                                    @endif
                                                </td>
                                                <td>{{$orders->payment_status}}</td>
                                                <td>
                                                    @if($orders->payment_id != '')
                                                        {{$orders->payment_id}}
                                                    @else
                                                        {{'-'}}
                                                    @endif
                                                </td>
                                                {{--<td>
                                                    @if ($orders->order_status === 'P')
                                                        Pending
                                                    @elseif ($orders->order_status === 'K')
                                                        Packed
                                                    @elseif ($orders->order_status === 'R')
                                                        Processing
                                                    @elseif ($orders->order_status === 'S')
                                                        Shipped
                                                    @elseif ($orders->order_status === 'O')
                                                        Out For Delivery
                                                    @elseif ($orders->order_status === 'D')
                                                        Delivered
                                                    @else
                                                        Canceled
                                                    @endif
                                                </td>
                                                 <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td> --}}
                                                
                                                <td>
                                                    @if($orders->payment_status == "Success")
                                                    <p>
                                                    @if($orders->vendor_id != 0 && $orders->vendor_id != '')
                                                        {!! Helper::vendorsname($orders->vendor_id) !!}
                                                    @endif
                                                    </p>
                                                    
                                                    <a class="btn btn-primary" href="javascript:void(0)" onclick="assign_vendor('{{$orders->order_id}}');">Assign Vendor</a>
                                                    @else
                                                    <lable>-</lable>
                                                    @endif
                                                </td>
                                                
												
												
												<td class="left">
                                                   
                                                    @if(isset($orders->items[0]))
                                                        <input type="text" value="{{ $orders->items[0]->subservice_booking_percentage }}"
                                                            onchange="updateorder_booking_percentage(this.value, '{{ $orders->items[0]->id }}');"
                                                            class="form-control" />
                                                    @else
                                                        <input type="text" value=""
                                                            onchange="updateorder_booking_percentage(this.value, '');"
                                                            class="form-control" placeholder="No data available" disabled />
                                                    @endif
                                                </td>

														   
														   
                                                <td class="text-right">
                                                    @if($orders->items[0]->service_id == 34)
                                                    <a class="btn btn-primary" href="{{ route('painting-detail', [$orders->order_id]) }}"><i class="far fa-eye me-2"></i>Details</a>
                                                    @elseif($orders->items[0]->service_id == 45)
                                                    <a class="btn btn-primary" href="{{ route('cleaning-detail', [$orders->order_id]) }}"><i class="far fa-eye me-2"></i>Details</a>
                                                    @else
                                                    <a class="btn btn-primary" href="{{ route('moving-detail', [$orders->order_id]) }}"><i class="far fa-eye me-2"></i>Details</a>
                                                        @endif
                                                </td>
                                               
                                                <td>
                                                    @if($orders->vendor_id != 0 && $orders->vendor_id != '')
                                                    <a class="btn btn-primary" href="javascript:void(0)" onclick="add_amount_model('{{$orders->order_id}}');">Add Amount</a>
                                                    @else
                                                    <lable>-</lable>
                                                    @endif
                                                </td>
                                                @endif
                                            </tr>
                                            @php
                                                $i++;
                                            } }
                                            @endphp
                                        
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
<!-- Assign Vendor  Modal -->
<div class="modal custom-modal fade" id="assign_vendor_model" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="order_vendor_form" action="{{ url('order_vendor_form') }}" method="POST" enctype="multipart/form-data">
                @csrf
               
                <input type="hidden" name="painting_order" value="{{ Route::currentRouteName() }}">
            
                
            <div class="modal-body">
                
                <div class="modal-text text-center">
                    <!-- <h3>Delete Expense Category</h3> -->
                    <!-- <p>Select Vendor</p> -->
                </div>
                <div class="modal-text text-center" id="dropdownreplace">
                </div>
                <p class="form-error-text" id="vendor_id_error" style="color: red; margin-top: 10px;"></p>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                    style="display: none;">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                    </button>
                <button type="button" class="btn btn-primary" onclick="form_sub_vendor();" id="vedor_submit">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
   <div class="modal custom-modal fade" id="set_order_model" role="dialog">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-body">
                   <div class="modal-text text-center">
                       <h3>Are you sure you want to Change Percentage</h3>
                       <input type="hidden" name="percentage" id="percentage" value="">
                       <input type="hidden" name="order_id" id="order_id" value="">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                       <button type="button" class="btn btn-primary" onclick="updateorder();">Yes</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
<!-- /Assign Vendor Modal -->

<!--Add Amount Modal -->

@if (isset($orders_list) and count($orders_list))
    @foreach ($orders_list as $key => $orders) 
<div class="modal custom-modal fade" id="add_amount_model{{$orders->order_id}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="add_amount_form{{$orders->order_id}}" action="{{ url('add_amount_form') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <input type="hidden" name="painting_order"  value="painting-service-order">
                <input type="hidden" name="cleaning_order"  value="">
                <div class="modal-text">

                    @php
                    $service_data = DB::table('ci_order_item')->where('order_id',$orders->order_id)->first();
                    @endphp

                    <input type="hidden" name="order_id" value="{{ $orders->order_id }}">
                    <input type="hidden" name="service_id" value="{{ $service_data->service_id }}">
                    <input type="hidden" name="order_total" value="{{ $orders->order_total }}">
                    <div class="form-group text-center">
                        <label>Total Amount:AED {{number_format($orders->order_total,2)}} </label>
                    </div>

                    <div class="form-group">
                        <label>Add Amount</label>
                        <input type="number" name="add_amount" id="add_amount{{$orders->order_id}}" class="form-control" placeholder="Add Amount">
                        <p class="form-error-text" id="add_amount_error{{$orders->order_id}}" style="color: red; margin-top: 10px;"></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" id="date{{$orders->order_id}}" class="form-control" placeholder="Date">
                        <p class="form-error-text" id="date_error{{$orders->order_id}}" style="color: red; margin-top: 10px;"></p>
                    </div>

                    <div class="form-group">
                        <label>Colllect By</label>
                        <select class="form-control" name="collect_by" id="collect_by{{$orders->order_id}}" >
                            <option value="">Select Colllect By</option>
                            <option value="Vendorscity">Vendorscity</option>
                            <option value="Vendor">Vendor</option>
                        </select>
                        <p class="form-error-text" id="collect_by_error{{$orders->order_id}}" style="color: red; margin-top: 10px;"></p>
                    </div>

                    <div class="form-group">
                        <label>Payment Type</label>
                        <select class="form-control" name="payment_type" id="payment_type{{$orders->order_id}}" >
                            <option value="">Select Payment Type</option>
                            <option value="Online">Online</option>
                            <option value="Cash">Cash</option>
                        </select>
                        <p class="form-error-text" id="payment_type_error{{$orders->order_id}}" style="color: red; margin-top: 10px;"></p>
                    </div>
                </div>
                    @php
                    $package_order_amount_attr_data = DB::table('package_order_amount_attr')->where('order_id',$orders->format_order_id)->get();

                    // echo"<pre>";print_r($package_order_amount_attr_data);echo"</pre>";exit;
                    $total_add_amount = $package_order_amount_attr_data->sum('add_amount');
                    $balance_amount = $orders->order_total - $total_add_amount;
                    @endphp
                    <div class="form-group">
                        <label>Amount Details : (Balance Amount :AED {{$balance_amount}})</label>
                    </div>
                    @foreach($package_order_amount_attr_data as $data)
                    <div class="form-group">
                        <label>{{$data->date}} : AED {{$data->add_amount}}</label>
                    </div>
                    @endforeach
                </div>

            
           

            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button{{$orders->order_id}}"
                style="display: none;">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
                </button>
                <button type="button" class="btn btn-primary" onclick="add_amount_popup('{{$orders->order_id}}');" id="submit_button{{$orders->order_id}}">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endforeach
@endif
<!--Add Amount Modal -->

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
    function form_sub_vendor() {
        var vendor_id = jQuery("#vendor_id").val();
            if (vendor_id == '') {
                jQuery('#vendor_id_error').html("Please Select Vendor");
                jQuery('#vendor_id_error').show().delay(0).fadeIn('show');
                jQuery('#vendor_id_error').show().delay(2000).fadeOut('show');
                
                return false;
            }
        $('#vedor_submit').hide();
        $('#spinner_button').show();
        $('#order_vendor_form').submit();
    }
    function add_amount_popup(order_id) {
        var add_amount = jQuery("#add_amount"+order_id).val();
            if (add_amount == '') {
                jQuery('#add_amount_error'+order_id).html("Please Add Amount");
                jQuery('#add_amount_error'+order_id).show().delay(0).fadeIn('show');
                jQuery('#add_amount_error'+order_id).show().delay(2000).fadeOut('show');
                
                return false;
            }
        var date = jQuery("#date"+order_id).val();
            if (date == '') {
                jQuery('#date_error'+order_id).html("Please Select Date");
                jQuery('#date_error'+order_id).show().delay(0).fadeIn('show');
                jQuery('#date_error'+order_id).show().delay(2000).fadeOut('show');
                
                return false;
            }
        var collect_by = jQuery("#collect_by"+order_id).val();
            if (collect_by == '') {
                jQuery('#collect_by_error'+order_id).html("Please Select Collect By");
                jQuery('#collect_by_error'+order_id).show().delay(0).fadeIn('show');
                jQuery('#collect_by_error'+order_id).show().delay(2000).fadeOut('show');
                
                return false;
            }
            var payment_type = jQuery("#payment_type"+order_id).val();
            if (payment_type == '') {
                jQuery('#payment_type_error'+order_id).html("Please Select Payment Type");
                jQuery('#payment_type_error'+order_id).show().delay(0).fadeIn('show');
                jQuery('#payment_type_error'+order_id).show().delay(2000).fadeOut('show');
                
                return false;
            }

            var url = '{{ url('checkAmountorder') }}';
            $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "order_id": order_id,
                        "add_amount": add_amount,
                    },
                    success: function(returnedData) {
                        if (returnedData == 0) {
                           $('#payment_type_error'+order_id).text("Added Amount Should Less than Balance Amount");
                       }else{
                           $('#spinner_button'+order_id).show();
                           $('#submit_button'+order_id).hide(); 
                           $('#add_amount_form'+order_id).submit();
                       }

                        
                    }
            });



           
    }
    function add_amount_model(order_id){

        $('#add_amount_model'+ order_id).modal('show');

    }
    function assign_vendor(order_id){
        var url = '{{ url('assign_vendor') }}';
        $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "order_id": order_id
                },
                success: function(msg) {
                    document.getElementById('dropdownreplace').innerHTML = msg;
                    $('#assign_vendor_model').modal('show');
                    
                }
        });
    }
	
	function updateorder_booking_percentage(val, id) {
           $('#percentage').val(val);
           $('#order_id').val(id);
           $('#set_order_model').modal('show');
       }
	   
	   function updateorder() {
           var percentage = $('#percentage').val();
           var order_id = $('#order_id').val();
           $.ajax({
               type: "POST",
               url: "{{ url('set_booking_percentage') }}",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "order_id": order_id,
                   "percentage": percentage
               },
               success: function(returnedData) {
                   // alert(returnedData);
                   if (returnedData == 1) {
                       //alert('yes');
                       $('#success_message').text("Booking Percentage Updated successfully");
                       //$('.success_show').show();
                       $('.success_show').show().delay(0).fadeIn('show');
                       $('.success_show').show().delay(5000).fadeOut('show');
                       $('#set_order_model').modal('hide');
                   }
               }
           });
       }
    
</script>
<script>
    $(document).ready(function() {
        // Check if the DataTable instance already exists
        if ($.fn.DataTable.isDataTable('#example')) {
            // Destroy the existing DataTable before reinitializing
            $('#example').DataTable().destroy();
        }
        // Initialize DataTable with the new options
        $('#example').dataTable({
            "searching": true
        });
    });
</script>
@stop