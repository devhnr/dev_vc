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
                    <h3 class="page-title">Packages </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Packages </li>
                    </ul>
                </div>
                @if (in_array('12', $edit_perm))
                    <div class="col-auto">

                        {{-- <a class="btn btn-primary me-1" href="{{ asset('public/upload/city_upload.xlsx') }}">
                            Download Bulk Upload City Format
                        </a>

                        <a class="btn btn-primary me-1" href="{{ route('bulk_upload_city') }}">
                            <i class="fas fa-plus"></i> Bulk Upload City

                        </a> --}}

                        <a class="btn btn-primary me-1" href="{{ route('packages.create') }}">
                            <i class="fas fa-plus"></i> Add Packages
                        </a>
                        <a class="btn btn-danger me-1" href="javascript:void('0');"
                            onclick="delete_packagecategory();return false;">
                            <i class="fas fa-trash"></i> Delete
                        </a>

                    </div>
                @endif
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
                        <form id="form" action="{{ route('delete_packages') }}" enctype="multipart/form-data">
                            <INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand(); ?>">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable" id="example">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Select</th>
                                            <th>Service</th>
                                            <th>Sub Service</th>
                                            <th>Package Category</th>
                                            <th>Title</th>
                                            <th>Sub Title</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Set Order</th>
                                            <th>Add Images</th>
                                            <!-- <th>Page Url</th> -->
                                            @if (in_array('12', $edit_perm))
                                                <th class="text-right">Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($packages_data as $data)
                                            <tr>
                                                <td>
                                                    <input name="selected[]" id="selected" value="{{ $data->id }}"
                                                        type="checkbox" class="minimal-red"
                                                        style="height: 20px;width: 20px;border-radius: 0px;color: red;">
                                                </td>

                                                <td>{!! Helper::servicename($data->service_id) !!}</td>

                                                <td>{!! Helper::subservicename($data->subservice_id) !!}</td>
                                                <td>{!! Helper::packagescategory($data->packagecategory_id) !!}</td>

                                                <td>
                                                    @if ($data->title != '')
                                                        {{ $data->title }}
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->sub_title != '')
                                                        {{ $data->sub_title }}
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                                </td>
                                                <td>{{ $data->name }}</td>
                                                <td><img src="{{ url('public/upload/packages/large/' . $data->image) }}"
                                                        width="50px" height="50px">
                                                </td>
                                                <td class="left">
                                                    <input type="text" value="{{ $data->set_order }}"
                                                        onchange="updateorder_popup(this.value, '{{ $data->id }}');"
                                                        class="form-control" />
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary me-1"
                                                        href="{{ route('editimage', ['id' => $data->id]) }}">
                                                        Add Image
                                                    </a>
                                                </td>

                                                @if (in_array('12', $edit_perm))
                                                    <td class="text-right">
                                                        <a class="btn btn-primary"
                                                            href="{{ route('packages.edit', $data->id) }}"><i
                                                                class="far fa-edit"></i></a>
                                                    </td>
                                                @endif
                                            </tr>
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

    <!-- /Page Wrapper -->
@stop
@section('footer_js')

    <!-- Delete Category Modal -->
    <div class="modal custom-modal fade" id="delete_packagecategory" role="dialog">
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
    <!-- /Delete Category Modal -->

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
    <!-- set order Modal -->

    <div class="modal custom-modal fade" id="set_order_model" role="dialog">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-body">

                    <div class="modal-text text-center">

                        <h3>Are you sure you want to Set order of Packages</h3>

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



    <script>
        function delete_packagecategory() {
            // alert('test');
            var checked = $("#form input:checked").length > 0;
            if (!checked) {
                $('#select_one_record').modal('show');
            } else {
                $('#delete_packagecategory').modal('show');
            }
        }

        function form_sub() {
            $('#form').submit();
        }

        function updateorder_popup(val, id) {

            $('#set_order_val').val(val);

            $('#set_order_id').val(id);

            $('#set_order_model').modal('show');

        }

        function updateorder() {

            var id = $('#set_order_id').val();

            var val = $('#set_order_val').val();

            $.ajax({

                type: "POST",

                url: "{{ url('set_order_packages') }}",

                data: {

                    "_token": "{{ csrf_token() }}",

                    "id": id,

                    "val": val

                },

                success: function(returnedData) {

                    // alert(returnedData);

                    if (returnedData == 1) {

                        //alert('yes');

                        $('#success_message').text("Set Order has been Updated successfully");

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
