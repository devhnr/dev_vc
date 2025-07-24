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

    <style>
        #delete_model_1 .modal-dialog {
            max-width: 50% !important;
        }
    </style>


    <div class="content container-fluid">





        <!-- Page Header -->

        <div class="page-header">

            <div class="row align-items-center">

                <div class="col">

                    <h3 class="page-title">Inquiry</h3>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>

                        </li>

                        <li class="breadcrumb-item active">Inquiry</li>

                    </ul>

                </div>
                <div class="col-auto">

                    {{-- <a class="btn btn-primary me-1" href="javascript:void('0');" onclick="excel_download();">Excel Download</a> --}}
                    
                    <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
                        <i class="fas fa-filter"></i>
                    </a>

                    
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

        @php

        if(!empty($startdate) || !empty($enddate) || !empty($filter_service_id)){
            $css = "display:block;";
        }else{
            $css = "display:none;";
        }

    @endphp

   <!-- Search Filter -->

   <div id="filter_inputs" class="card filter-card" style="{{ $css }}">

       <div class="card-body pb-0">
        <form id="filter_form" action="{{ route('vendor-enquiry-filter') }}" method="POST">
            @csrf
            <input type="hidden" name="action" value="filter">

           <div class="row">

               <div class="col-sm-6 col-md-8">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="s_date" id="s_date" placeholder="Enter Start Date"
                                value="{{ $startdate ?: '' }}">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="e_date" id="e_date" placeholder="Enter End Date"
                                value="{{ $enddate ?: '' }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Select Services</label>
                            <select name="servicename" class="form-control form-select" id="servicename">
                                <option value="">Select Service</option>
                                @foreach ($service_data as $service_data_new)
                                    <option value="{{ $service_data_new->id }}"
                                        @if ($service_data_new->id == $filter_service_id) {{ 'selected' }} @endif>
                                        {{ $service_data_new->servicename }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
               </div>
               </div>
               <div class="col-sm-3 col-md-4">
                <div class="form-group">
                    <a class="btn btn-primary filter-btn" href="javascript:void(0);" style="margin-top: 22px;" onclick="filter_validation()">Submit</a>

                    <a class="btn btn-primary filter-btn" href="{{ route('vendorinquiry.index') }}" style="margin-top: 22px;">Reset</a>
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
                                $currentDate = now();

                                $vendor_subscription = DB::table('subscription')
                                    ->select('*')
                                    ->where('vendor_id', '=', $userId)
                                   // ->where('enddate', '>=', $currentDate)
                                    ->orderBy('id', 'desc')
                                    ->get();
                                //    echo '<pre>';
                                //    print_r($vendor_subscription);
                                //    echo '</pre>';
                                //    exit();

                                $resultArray = [];

                                foreach ($vendor_subscription as $vendor_subscription_data) {
                                    $vendor_subscription_att = DB::table('subscription_subservice_attribute')
                                        ->select('*')
                                        ->where('subscription_id', '=', $vendor_subscription_data->id)
                                        ->get();

                                    foreach ($vendor_subscription_att as $vendor_subscription_att_data) {
                                        $resultArray[] = [
                                            'service_id' => $vendor_subscription_att_data->service_id,
                                            'subservice_id' => $vendor_subscription_att_data->subservice_id,
                                            'city_id' => $vendor_subscription_data->city,
                                            'country_id' => $vendor_subscription_data->country,
                                            'type_of_package' => $vendor_subscription_data->type_of_package,
                                        ];
                                    }
                                }

                                

                                $combined_data = [];


                                foreach ($resultArray as $resultArray_data) {

                                    $query = DB::table('packages_enquiry')
                                            ->select('*')   
                                            ->where('service_id', '=', $resultArray_data['service_id'])
                                            ->where('subservice_id', '=', $resultArray_data['subservice_id']);

                                        if (!empty($startdate)) {
                                            $query->where('added_date', '>=', date('Y-m-d', strtotime($startdate)));
                                        }

                                        if (!empty($enddate)) {
                                            // echo"<pre>";print_r($enddate);echo"</pre>";
                                            $query->where('added_date', '<=', date('Y-m-d', strtotime($enddate)));
                                        }

                                        if (!empty($filter_service_id)) {
                                            $query->where('service_id', '=', $filter_service_id);
                                        } 


                                        $packages_enquiry = $query->where('count', '<', 5)->orderBy('id', 'desc')->get();

                                        // echo "<pre>";print_r($packages_enquiry);
                                        // echo "</pre>";exit;


                                    foreach ($packages_enquiry as $packages_enquiry_da) {

                                        if($packages_enquiry_da->service_id == 30 && $packages_enquiry_da->subservice_id == 23 || $packages_enquiry_da->service_id == 30 && $packages_enquiry_da->subservice_id == 26){


                                            if($packages_enquiry_da->form_type == 'International Move'){
                                            $package_inquiry_data = DB::table('more_formfields_details')
                                                    ->where('package_inquiry_id', $packages_enquiry_da->id)
                                                    ->where('form_field_id', 47)
                                                    ->first();

                                                    //  echo "<pre>";print_r($packages_enquiry_da);echo "</pre>";exit;

                                                if(!empty($package_inquiry_data)){           

                                                    $form_attributes_data = DB::table('form_attributes')
                                                                        ->where('id',$package_inquiry_data->formfield_value)
                                                                        ->first();
                                                    // echo "<pre>";print_r($form_attributes_data);echo "</pre>";exit;

                                            $country = DB::table('countries')
                                                        ->where('country', $form_attributes_data->form_option)
                                                        ->first();

                                                // echo "<pre>";print_r($country);echo "</pre>";exit;


                                                        if(isset($country)){
                                                            $country_id = $country->id;
                                                        }else{
                                                            $country_id = "";
                                                        }

                                       

                                            //if($city_data)

                                            $subs_country = explode(',', $resultArray_data['country_id']);
                                            // echo "<pre>";print_r($city_data->id);echo"</pre>";
                                            // echo "<pre>";print_r($subs_city);echo"</pre>";exit;
                                                        

                                            if($packages_enquiry_da->form_type == 'Local Move'){
                                                $packages_enquiry_type = 0;
                                            }else{
                                                $packages_enquiry_type = 1;
                                            }
                                            // echo $resultArray_data['type_of_package']."  ccc<br>";
                                            // echo $packages_enquiry_type."<br>";
                                            if(in_array($country_id,$subs_country) && isset($resultArray_data['type_of_package']) && 
                                            $packages_enquiry_type == $resultArray_data['type_of_package']){

                                                        
                                                        $combined_data[] = $packages_enquiry_da->id;

                                                        //echo "gxsdaaa";exit;
                                                    }
                                                }
                                                    //   echo "<pre>";print_r($packages_enquiry_da->id);echo"</pre>";

                                            }else{

                                                $package_inquiry_data = DB::table('more_formfields_details')
                                            ->where('package_inquiry_id', $packages_enquiry_da->id)
                                            ->where('form_field_id', 17)
                                            ->first();

                                          

                                            if(!empty($package_inquiry_data)){

                                                $form_attributes_data = DB::table('form_attributes')
                                                                        ->where('id',$package_inquiry_data->formfield_value)
                                                                        ->first();


                                                $city_data = DB::table('cities')
                                                        ->where('name', $form_attributes_data->form_option)
                                                        ->first();

                                                $subs_city = explode(',', $resultArray_data['city_id']);

                                                if($packages_enquiry_da->form_type == 'Local Move'){
                                                    $packages_enquiry_type = 0;
                                                }else{
                                                    $packages_enquiry_type = 1;
                                                }


                                                // echo $resultArray_data['type_of_package']."  ccc<br>";
                                                // echo $packages_enquiry_type."<br>";
                                                if(in_array($city_data->id,$subs_city) && isset($resultArray_data['type_of_package']) && 
                                                $packages_enquiry_type == $resultArray_data['type_of_package']){
                                                    $combined_data[] = $packages_enquiry_da->id;
                                                }

                                                }

                                            }

                                            



                                        }else{
                                            $combined_data[] = $packages_enquiry_da->id;
                                        }


                                        $package_inquiry_data = DB::table('more_formfields_details')
                                            ->where('package_inquiry_id', $packages_enquiry_da->id)
                                            ->where('form_field_id', 17)
                                            ->first();

                                        if (!empty($package_inquiry_data)) {
                                            $form_attributes_data = DB::table('form_attributes')
                                                ->where('id', $package_inquiry_data->formfield_value)
                                                ->first();

                                        
                                         }
                                    }
                                }

                                // Output or further process $combined_data as needed
                                // echo "<pre>";
                                // print_r($combined_data);
                                // echo "</pre>";


                                $uniqueArray = [];

                                foreach ($resultArray as $entry) {
                                    // Create a unique key for each combination
                                    $key = $entry['service_id'] . '_' . $entry['subservice_id'];

                                    // Check if the combination already exists in the unique array
                                    if (!isset($uniqueArray[$key])) {
                                        // If not, add it to the unique array
                                        $uniqueArray[$key] = $entry;
                                    }
                                }

                                $resultArray = array_values($uniqueArray);

                                // echo"<pre>";print_r($resultArray);echo"</pre>";

                            @endphp

                            <div class="table-responsive">

                                <table class="table table-center table-hover datatable" id="example">

                                    <thead class="thead-light">

                                        <tr>
                                            <th style="display: none">Sr No</th>
                                            <th>Date</th>
                                            <th>Inquiry No</th>
                                            <th>Name</th>
                                            <th>Service</th>
                                            <th>Sub Service</th>
                                            <th>Lead Info</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @if ($vendor_subscription != '')


                                            @php
                                                $i = 1;
                                            @endphp

                                            @foreach ($resultArray as $resultArray_data)
                                                @php

                                                    $packages_enquiry = DB::table('packages_enquiry')
                                                        ->select('*')
                                                        ->where('service_id', '=', $resultArray_data['service_id'])
                                                        ->where('subservice_id', '=', $resultArray_data['subservice_id'])
                                                        ->where('count', '<', 5)
                                                        ->orderBy('id', 'desc')
                                                        ->get();

                                                    //    echo '<pre>';
                                                    //    print_r($packages_enquiry);
                                                    //    echo '</pre>';
                                                    //    exit();

                                                @endphp



                                                @foreach ($packages_enquiry as $packages_enquiry_data)
                                                    @php
                                                        // echo '<pre>';
                                                        // print_r($packages_enquiry_data);
                                                        // echo '</pre>';
                                                        // exit();
                                                        $vendor_data = Auth::user();
                                                        $vendors_data = DB::table('package_inquiry_accepted')
                                                            ->where('packages_inquiry_id', $packages_enquiry_data->id)
                                                            ->where('vendor_id', $vendor_data->id)
                                                            ->first();
                                                        //    echo '<pre>';
                                                        //    print_r($vendors_data);
                                                        //    echo '</pre>';
                                                        //    exit();
                                                    @endphp
                                                    @if ($vendors_data == '')
                                                    @if (in_array($packages_enquiry_data->id,$combined_data))
                                                    
                                                        <tr>

                                                            <td style="display: none">{{ $i }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($packages_enquiry_data->added_date))}}</td>
                                                            <td>{{ $packages_enquiry_data->inquiry_id }}</td>
                                                            <td>{{ $packages_enquiry_data->name }}</td>

                                                            <td>
                                                                @if ($packages_enquiry_data->service_id != '')
                                                                    {!! Helper::servicename(strval($packages_enquiry_data->service_id)) !!}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($packages_enquiry_data->subservice_id != '')
                                                                    {!! Helper::subservicename(strval($packages_enquiry_data->subservice_id)) !!}
                                                                @endif

                                                            </td>
                                                            <td>
                                                                <a class="btn btn-primary"
                                                                    href="{{ url('enquiry_detail', $packages_enquiry_data->id) }}">View Information</a>

                                                                {{-- <a class="btn btn-primary" href="javascript:void('0');"
                                                                    onclick="Enquiry('{{ $packages_enquiry_data->id }}');">View
                                                                    Details
                                                                </a> --}}
                                                            </td>
                                                            {{-- <td><a class="btn btn-primary" href="javascript:void('0');"
                                                                    onclick="delete_category('{{ $packages_enquiry_data->id }}','{{ $userId }}');">
                                                                    Accept
                                                                </a></td> --}}

                                                        </tr>
                                                    @endif
                                                    @endif
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
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

    {{-- @php
        echo '<pre>';
        print_r($packages_enquiry);
        echo '</pre>';
        exit();
    @endphp --}}

    @isset($packages_enquiry)
        {{-- @if ($packages_enquiry != '') --}}


        @foreach ($packages_enquiry as $packages_enquirys)
            <div class="modal custom-modal fade" id="delete_model_{{ $packages_enquirys->id }}" role="dialog">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-body">


                            <div class="modal-text text-center">

                                <!-- <h3>Delete Expense Category</h3> -->

                                @php

                                    $result = DB::table('more_formfields_details')
                                        ->select('*')
                                        ->where('package_inquiry_id', '=', $packages_enquirys->id)
                                        ->get();

                                    //    echo '<pre>';
                                    //    print_r($result);
                                    //    echo '</pre>';
                                    //

                                    //$servicename = Helper::servicename($result->service_id);

                                @endphp
                                @if ($result != '' && count($result) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="invoice-table table table-bordered">
                                                    <thead>
                                                        @foreach ($result as $result_data)
                                                            <tr>
                                                                <th>{!! Helper::form_fields($result_data->form_field_id) !!}</th>
                                                            </tr>

                                                    </thead>
                                                    <tbody>


                                                        <tr>
                                                            <td>{{ $result_data->formfield_value }}</td>
                                                        </tr>
                                @endforeach
                                </tbody>
                                </table>


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
    @endisset



    <!-- Delete  Modal -->

    {{-- <div class="modal custom-modal fade" id="delete_model" role="dialog">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-body">


                    <div class="modal-text text-center">

                        <h3>Are you sure want to Accept</h3>

                        <p></p>

                    </div>

                </div>

                <div class="modal-footer text-center">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>

                    <button type="button" class="btn btn-primary" onclick="form_sub();">Yes</button>

                </div>

            </div>

        </div>

    </div> --}}

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
    {{-- <form id="form_new" action="{{ route('accept_vendor_inquiry') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="inquiry_id" id="inquiry_id" value="">
        <input type="hidden" name="vendor_id" id="vendor_id" value="">
    </form> --}}


    {{-- <script>
    function delete_category(id, vendor_id) {

        $('#inquiry_id').val(id);

        $('#vendor_id').val(vendor_id);

        $('#delete_model').modal('show');
    }



    function form_sub() {

        $('#form_new').submit();

    }
</script> --}}

    <script>
         function filter_validation(){
                $('#filter_form').submit();
            }
        function Enquiry(id) {

            //    alert(id);

            $('#delete_model_' + id).modal('show');


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

        // $(document).ready(function() {
        //     // Destroy existing DataTable instance if it exists
        //     if ($.fn.DataTable.isDataTable('#example')) {
        //         $('#example').DataTable().destroy();
        //     }

        //     // Reinitialize DataTable with new options
        //     $('#example').DataTable({
        //         "order": [[ 0, "desc" ]], // Set initial sorting order
        //         "columnDefs": [{
        //             "targets": 0,
        //             "type": "date-eu"
        //         }]
        //     });
        // });

    </script>

@stop
