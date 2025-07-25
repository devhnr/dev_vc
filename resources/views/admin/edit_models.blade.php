@extends('admin.includes.Template')
@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Models</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('continent.index') }}">Models</a></li>
                        <li class="breadcrumb-item active">Edit Models</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div id="validate" class="alert alert-danger alert-dismissible fade show" style="display: none;">
            <span id="login_error"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Basic Info</h4> -->
                        <form id="category_form" action="{{ route('model.update',$models->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Vehicle Name</label>
                                    <select class="form-control" id="name" name="name">
                                        <option value="" data-value="">Select a Vehicle</option>
                                            @foreach ($vehicles as $data)
                                                <option value="{{ $data->id }}" data-value="{{ $data->id }}" @if($data->id == $models->vehicle_name) selected @endif>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                     </select>
                                        
                                    <p class="form-error-text" id="name_error" style="color: red; margin-top: 10px;"></p>
                                </div>
                                </div>
                                <div class="col-md-6">
                                      <div class="form-group">
                                    <label for="name">Model Name</label>
                                    <input id="model_name" name="model_name" type="text" class="form-control"
                                        placeholder="Enter Model Name" value="{{$models->model_name}}" />
                                    <p class="form-error-text" id="model_error" style="color: red; margin-top: 10px;"></p>
                                </div>
                                </div>
                                 <div class="col-md-6">
                                      <div class="form-group">
                                    <label for="name">Category</label>
                                    <input id="category" name="category" type="text" class="form-control"
                                        placeholder="Enter Category" value="{{$models->category}}" />
                                    <p class="form-error-text" id="category_error" style="color: red; margin-top: 10px;"></p>
                                </div>
                                </div>
                                 <div class="col-md-6">
                                      <div class="form-group">
                                    <label for="name">Price</label>
                                    <input id="price" name="price" type="text" class="form-control"
                                        placeholder="Enter Price" value="{{$models->price}}" />
                                    <p class="form-error-text" id="price_error" style="color: red; margin-top: 10px;"></p>
                                </div>
                                </div>

                            </div>
                            <div class="text-end mt-4">
                                <a class="btn btn-primary" href="{{ route('model.index') }}"> Cancel</a>
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
            var name = jQuery("#name").val();            
            if (name == '') {
                jQuery('#name_error').html("Please Enter Vehicle Name");
                jQuery('#name_error').show().delay(0).fadeIn('show');
                jQuery('#name_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#name').offset().top - 150
                }, 1000);
                return false;
            }
              var model_name = jQuery("#model_name").val();            
            if (model_name == '') {
                jQuery('#model_error').html("Please Enter Model Name");
                jQuery('#model_error').show().delay(0).fadeIn('show');
                jQuery('#model_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#model_name').offset().top - 150
                }, 1000);
                return false;
            }
            $('#spinner_button').show();
            $('#submit_button').hide();
            $('#category_form').submit();
        }
    </script>
@stop
