@extends('admin.includes.Template')

@section('content')

    <div class="content container-fluid">



        <!-- Page Header -->

        <div class="page-header">

            <div class="row">

                <div class="col-sm-12">

                    <h3 class="page-title">Edit Time Slot Price</h3>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>

                        {{-- <li class="breadcrumb-item"><a href="{{ route('state.index') }}">System</a></li> --}}

                        <li class="breadcrumb-item active">Edit Time Slot Price</li>

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
        <div class="alert alert-success alert-dismissible fade show success_show" style="display: none;">
            <strong>Success! </strong><span id="success_message"></span>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert"></button> -->
        </div>



        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">

                        <!-- <h4 class="card-title">Basic Info</h4> -->

                        <form id="time_slot_price_form" action="{{ route('time_slot_price.update',2) }}" method="POST"
                            enctype="multipart/form-data">

                            @php
                            $time_slot_price_data = DB::table('time_slots')->get();  
                            @endphp

                            @csrf
                            @method('PUT')

                            <div class="row">
                                @php
                                $i=0;
                                @endphp
                                @foreach ($time_slot_price_data as $data)

                                @php
                                   $subservice_timeslot_price =  DB::table('subservice_timeslot_price')
                                                ->where('time_slot_id',$data->id)
                                                ->where('subservice_id',28)
                                                ->first();
                                if(isset($subservice_timeslot_price) && !empty($subservice_timeslot_price)){
                                   $value =  $subservice_timeslot_price->price;
                                }else{
                                    $value = 0;
                                }
                                @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($i == 0)
                                        <label for="name"><b>Hours</b></label>
                                        @endif
                                        <input type="hidden" id="time_slot_id" value="{{$data->id}}" name="time_slot_id[]" > 

                                        <input type="text" name="time_slot_name[]" value="{{$data->name}}" class="form-control" style="margin-top: 10px;" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        @if($i == 0)
                                        <label for="name"><b>Price</b></label>
                                        @endif
                                        <input type="text" name="price[]" id="{{$data->id}}" value="{{$value}}" placeholder="Enter Price" class="form-control" style="margin-top: 10px;" >
                                    </div>
                                </div>
                                @php

                                $i++;
                                @endphp
                                @endforeach


                            </div>



                            <div class="text-end mt-4">

                                <a class="btn btn-primary" href="{{ url('/admin') }}"> Cancel</a>



                                <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                                    style="display: none;">

                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                                    Loading...

                                </button>



                                <button type="button" class="btn btn-primary" id="submit_button"
                                    onclick="javascript:category_validation()">Submit</button>

                                <!-- <input type="submit" name="submit" value="Submit" class="btn btn-primary"> -->

                            </div>

                        </form>



                    </div>

                </div>

            </div>

        </div>

    </div>

@stop

@section('footer_js')

    <script>
        function category_validation() {

            $('#spinner_button').show();
            $('#submit_button').hide();
            $('#time_slot_price_form').submit();

        }
    </script>


@stop
