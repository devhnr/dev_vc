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

                    <h3 class="page-title">Packages Enquiry</h3>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>

                        </li>

                        <li class="breadcrumb-item active">Packages Enquiry</li>

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

        <div class="row">

            <div class="col-sm-12">

                <div class="card card-table">

                    <div class="card-body">

                        <form id="form" action="{{-- route('delete_price') --}}" enctype="multipart/form-data">

                            <INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand(); ?>">

                            @csrf

                            <div class="table-responsive">

                                <table class="table table-center table-hover datatable">

                                    <thead class="thead-light">

                                        <tr>
                                            <th>Sr No</th>
                                            <th>Name</th>
                                            <th>Email</th>

                                            <th>Mobile</th>

                                            <th>Service</th>

                                            <th>Sub Service</th>

                                            {{-- <th>Package Category</th> --}}

                                            <th>Packages Enquiry</th>
                                            <th>Detail</th>





                                        </tr>

                                    </thead>

                                    <tbody>

                                        @php

                                            $i = 1;
                                        @endphp

                                        @foreach ($packages_data as $data)
                                            <tr>

                                                <td>

                                                    {{ $i }}

                                                </td>
                                                <td>

                                                    {{ $data->name }}

                                                </td>
                                                <td>
                                                    {{ $data->email }}
                                                </td>

                                                <td>
                                                    {{ $data->mobile }}

                                                </td>

                                                <td>
                                                    {!! Helper::servicename($data->service_id) !!}
                                                </td>

                                                <td>
                                                    {!! Helper::subservicename($data->subservice_id) !!}
                                                </td>

                                                {{-- <td>
                                                    {!! Helper::packagescategory($data->packagecategory_id) !!}
                                                </td> --}}

                                                <td>
                                                    {!! Helper::packages_enquiry($data->pakage_id) !!}
                                                </td>

                                                <td><a class="btn btn-primary" href="javascript:void('0');"
                                                        onclick="delete_category('{{ $data->id }}');">View
                                                        Package Enquiry</a></td>
                                            </tr>

                                            @php

                                                $i++;
                                            @endphp
                                        @endforeach



                                    </tbody>

                                </table>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Delete  Modal -->
    @if ($packages_data != '')
        @foreach ($packages_data as $data)
            <div class="modal custom-modal fade" id="delete_model_{{ $data->id }}" role="dialog">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-body">


                            <div class="modal-text text-center">

                                <!-- <h3>Delete Expense Category</h3> -->

                                @php

                                    $result = DB::table('more_formfields_details')
                                        ->select('*')
                                        ->where('package_inquiry_id', '=', $data->id)
                                        ->get();

                                    //$servicename = Helper::servicename($result->service_id);

                                    // echo '<pre>';
                                    // print_r($result);
                                    // echo '</pre>';
                                    // exit();

                                @endphp
                                @if ($result != '')
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
    @endif

@stop


<script>
    function delete_category(id) {

        // alert(id);

        $('#delete_model_' + id).modal('show');


    }
</script>
