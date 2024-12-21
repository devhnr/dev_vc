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
                    <h3 class="page-title">Painting Leads Enquiry Detail</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Painting Leads Enquiry Detail</li>
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
                                    @if ($painting_enquiry_data != '')
                                        @php
                                            $i = 0;
                                        @endphp
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Inquiry No</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->inquiry_id }}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Type of Painting</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->type_of_painting }}</td>
                                            </tr>
                                        </tbody>

                                        {{-- <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->name }}</td>
                                            </tr>
                                        </tbody>

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Email</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->email }}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Mobile No</th>                                                
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->mobile }}</td>
                                            </tr>
                                        </tbody>--}}
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Service</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{!! Helper::servicename(strval($painting_enquiry_data->service_id)) !!}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Sub Service</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{!! Helper::subservicename(strval($painting_enquiry_data->subservice_id)) !!}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Address</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->city.', '.$painting_enquiry_data->area.', '.$painting_enquiry_data->building_street_no.', ' }}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Date</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->enquiry_month.' '.$painting_enquiry_data->enquiry_date.', '.$painting_enquiry_data->enquiry_year }}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Time</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{!! Helper::timeslotname(strval($painting_enquiry_data->time_slot)) !!}</td>
                                            </tr>
                                        </tbody>
                                        @if($painting_enquiry_data->describe_painting_service !="")
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Describe Painting Service</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->describe_painting_service ?? "" }}</td>
                                            </tr>
                                        </tbody>
                                        @endif
                                        @if($painting_enquiry_data->no_of_rooms_painted != 0)
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No.of Rooms</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->no_of_rooms_painted }}</td>
                                            </tr>
                                        </tbody>
                                        @endif
                                        @if($painting_enquiry_data->no_of_walls_painted != 0)
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No.of Walls</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $painting_enquiry_data->no_of_walls_painted }}</td>
                                            </tr>
                                        </tbody>
                                        @endif
                                    @else
                                    <tbody>
                                        <tr>
                                            <td>no data found</td>
                                        </tr>
                                    </tbody>
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
