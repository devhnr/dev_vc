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
                    <h3 class="page-title">Garden and Mouse Enquiry Detail</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Garden and Mouse Enquiry Detail</li>
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
                                    @if ($garden_enquiry_data != '')
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
                                                <td>{{ $garden_enquiry_data->inquiry_id }}</td>
                                            </tr>
                                        </tbody>
                                  

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Service</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{!! Helper::servicename(strval($garden_enquiry_data->service)) !!}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Sub Service</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{!! Helper::subservicename(strval($garden_enquiry_data->subservice)) !!}</td>
                                            </tr>
                                        </tbody>

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Service Type</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                @if($garden_enquiry_data->service_type != "")
                                                    {{ $garden_enquiry_data->service_type }}
                                                @else
                                                    -
                                                @endif
                                                </td>
                                            </tr>
                                        </tbody>

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Type of Home</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $garden_enquiry_data->type_of_home }}</td>
                                            </tr>
                                        </tbody>

                                        @php
                                        $Home = DB::table('painting_prices')->where('id',$garden_enquiry_data->size_of_home)->pluck('size_of_home')->first();
                                       @endphp

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Size of Home</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @if($Home != "" && $Home != null)
                                                    {{ $Home }}
                                                @else
                                                    -
                                                @endif
                                                </td>
                                            </tr>
                                        </tbody>

                                        
                                        <thead class="thead-light">
                                            <tr>
                                        <th>City</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{!! Helper::city_name_for_garden($garden_enquiry_data->city) !!}</td>
                                            </tr>
                                        </tbody>

                                        <thead class="thead-light">
                                            <tr>
                                            <th>Address</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $garden_enquiry_data->address}}</td>
                                            </tr>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Service Date</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $garden_enquiry_data->service_date }}</td>
                                            </tr>
                                        </tbody>
                                        
                                        @if($garden_enquiry_data->describe_your_requirements !="")
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Describe Garden Service</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $garden_enquiry_data->describe_your_requirements ?? "" }}</td>
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
