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
     
        .hidden {
            display: none;
        }
    
    </style>


    <div class="content container-fluid">

        <!-- Page Header -->

        <div class="page-header">

            <div class="row align-items-center">

                <div class="col">

                    <h3 class="page-title">Accept Lead Form</h3>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>

                        </li>

                        <li class="breadcrumb-item active">Accept Lead Form</li>

                    </ul>

                </div>


            </div>


        </div>

        <!-- /Page Header -->


        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">

                <strong>Success!</strong> {{ $message }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        @php
            $userId = Auth::id();
        @endphp

        <div class="row">

            <div class="col-sm-12">

                <div class="card card-table">

                    <div class="card-body">

                        <form id="accept_form" action="{{ route('accept_lead_form') }}" enctype="multipart/form-data">

                            <INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand(); ?>">
                            <input type="hidden" name="inquiry_id" value="{{$packages_enquiry_data->id}}">
                            <input type="hidden" name="vendor_id" id="vendor_id" value="">

                            @csrf

                            <div class="table-responsive">

                                <table class="table table-center table-hover">
                                   
                                <tbody> 
                                        <div class="form-group">
                                            <label for="accept_lead">Select Accept Lead</label>
                                            <select class="form-control" id="accept_lead" name="accept_lead"
                                                onchange="lead_change(this.value);">
                                                <option value="">Select Accept lead</option>
                                            <option value="Enter Qoute">Enter Your Quote</option>
                                            <option value="Request Survey">Request Survey</option>
                                            </select>
                                            <p class="form-error-text" id="country_error" style="color: red; margin-top: 10px;"></p>
                                        </div>

                                    <div class="form-group hidden" id="quoteInput">
                                        <label for="name">Enter Quote (Include 5% VAT)</label>
                                        <input id="qoute" name="qoute" type="number" class="form-control"
                                            placeholder="Please Enter Quote" value="" />
                                      <p class="form-error-text" id="qoute_error" style="color: red; margin-top: 10px;"></p>
                                    </div>

                                    <div class="form-group">
                                        <h4>Quote Includes :</h4>
                                    </div>

                                    @if(($service_data)!='')
                                    @foreach($service_data as $data)
                                    <input type="hidden" name="qoute_includes_id[]" value="{{$data->id}}">
                                    <input type="hidden" name="qoute_includes_name[]" value="{{$data->name}}">
                                   
                                    <div class="form-group">
                                        <label for="qoute_includes">{{$data->name}}</label>
                                        <select class="form-control" name="qoute_include_value[]">
                                            
                                            @if($data->name == 'Rate')
                                            <option value="">Select {{$data->name}}</option>
                                            <option value="anually">Anually</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="weekly">weekly</option>
                                            <option value="daily">Daily</option>
                                            @else
                                            <option>Select {{$data->name}}</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            @endif
                                        </select>
                                    </div>
                                    @endforeach
                                    @endif
                                </tbody>  
                                
                              


                                </table>


                            </div>
                            <div class="text-end mt-4">

                                <a class="btn btn-primary" href="{{ route('vendorinquiry.index') }}"> Cancel</a>



                                <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                                    style="display: none;">

                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>

                                    Loading...

                                </button>



                                <button type="button" class="btn btn-primary" id="submit_button"
                                    onclick="javascript:accept_leads()">Submit</button>

                                <!-- <input type="submit" name="submit" value="Submit" class="btn btn-primary"> -->

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>


        {{-- <div class="col-auto" style="float: inline-end;">

            <a class="btn btn-primary me-1" href ="{{ route('accpet_form') }},'{{'enquiry_id'}}';">

                <i class="fas fa-plus"></i> Accept

            </a>

            <a class="btn btn-danger" href="javascript:void('0');"
                onclick="Enquiry('{{ $packages_enquiry_data->package_inquiry_id }}','{{ $userId }}');">Reject

            </a>


        </div> --}}



    </div>

    <!-- Delete  Modal -->

    <div class="modal custom-modal fade" id="delete_model" role="dialog">

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

    </div>

  

    <!-- /Delete Modal -->

    <form id="form_new" action="{{ route('accept_vendor_inquiry') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="inquiry_id" id="inquiry1_id" value="">
        <input type="hidden" name="vendor_id" id="vendor1_id" value="">
    </form>
@stop

@section('footer_js')




    <script>
        function delete_category(id, vendor_id) {

            $('#inquiry1_id').val(id);

            $('#vendor1_id').val(vendor_id);

            $('#delete_model').modal('show');
        }

        function form_sub() {

            $('#form_new').submit();

        }
    </script>

    <script>
        function Enquiry(id, userId) {


            $('#inquiry_id').val(id);

            $('#vendor_id').val(userId);

            $('#reject_model').modal('show');


        }
    </script>

    <script>
        function accept_leads() {

            var acceptLead = jQuery("#accept_lead").val();
    if (acceptLead === "Enter Qoute") {
        var qoute = jQuery("#qoute").val();
        if (qoute == '') {
            jQuery('#qoute_error').html("Please Enter Quote");
            jQuery('#qoute_error').show().delay(0).fadeIn('show');
            jQuery('#qoute_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#qoute').offset().top - 150
            }, 1000);
            return false;
        }
    }
             $('#spinner_button').show();

            $('#submit_button').hide();

            $('#accept_form').submit();


        }
    </script>

    <script>
      
        function lead_change(value) {
            var quoteInput = document.getElementById('quoteInput');
            if (value === 'Enter Qoute') {
                quoteInput.classList.remove('hidden');
            } else {
                quoteInput.classList.add('hidden');
            }
        }
    
    </script>

@stop
