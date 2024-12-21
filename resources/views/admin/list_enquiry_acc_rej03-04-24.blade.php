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

    {{-- <style>
        #delete_model_1 .modal-dialog {
            max-width: 50% !important;
        }
    </style> --}}

    <div class="content container-fluid">

        <!-- Page Header -->

        <div class="page-header">

            <div class="row align-items-center">

                <div class="col">

                    <h3 class="page-title">Packages Enquiry Detail</h3>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>

                        </li>

                        <li class="breadcrumb-item active">Packages Enquiry Detail</li>

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

                                <table class="table table-center table-hover">


                                    @if ($packages_enquiry != '')
                                        @php
                                            // echo '<pre>';
                                            // print_r($packages_enquiry);
                                            // echo '</pre>';
                                            // exit();
                                        @endphp
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($packages_enquiry as $packages_enquiry_data)
                                            @if ($packages_enquiry_data->formfield_value != '')
                                                @if ($packages_enquiry_data->form_field_id != $i)
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>{!! Helper::form_fields($packages_enquiry_data->form_field_id) !!}</th>
                                                        </tr>
                                                    </thead>
                                                @endif
                                            @endif
                                            <tbody>
                                                <tr>
                                                    @if ($packages_enquiry_data->formfield_value != '')
                                                        @if (is_numeric($packages_enquiry_data->formfield_value) && $packages_enquiry_data->form_field_id != 30)
                                                            <td> {!! Helper::form_fields_attr($packages_enquiry_data->formfield_value) !!}</td>
                                                        @else
                                                            @php
                                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                                                $extension = pathinfo(
                                                                    $packages_enquiry_data->formfield_value,
                                                                    PATHINFO_EXTENSION,
                                                                );
                                                            @endphp
                                                            @if (in_array(strtolower($extension), $imageExtensions))
                                                                <td> <a class=""
                                                                        href="{{ url('admin/download/' . $packages_enquiry_data->formfield_value) }}">
                                                                        Download</a></td>
                                                            @else
                                                                <td> {{ $packages_enquiry_data->formfield_value }}</td>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </tr>
                                            </tbody>

                                            @php
                                                $get_more_id = DB::table('more_formfields_details_att')
                                                    ->where('form_id', '=', $packages_enquiry_data->form_field_id)
                                                    ->where(
                                                        'package_inquiry_id',
                                                        '=',
                                                        $packages_enquiry_data->package_inquiry_id,
                                                    )
                                                    ->get()
                                                    ->toArray();

                                            @endphp


                                            @if (isset($get_more_id) && count($get_more_id) > 0)
                                                <thead class="thead-light">

                                                    <tr>
                                                        <th>Type of Home</th>
                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        @foreach ($get_more_id as $get_more_id_data)
                                                            <td> {!! Helper::form_fields_attr_more($get_more_id_data->more_form_attributes_id) !!}</td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            @endif
                                            @php
                                                $i = $packages_enquiry_data->form_field_id;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>no data found</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

@stop
