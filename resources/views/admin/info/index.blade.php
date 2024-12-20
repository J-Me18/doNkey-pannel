@extends('layouts.master')
@section('content')
    <!-- Add the DataTables CSS link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <style>
        /* body {
                                                                     height: 100vh;
                                                                     display: grid;
                                                                     place-items: center;
                                                                     margin: 0;
                                                                  background: #222;
                                                                 } */
        .error {
            color: red;
        }

        .check-box {
            transform: scale(.5);
        }

        input[type="checkbox"] {
            position: relative;
            appearance: none;
            width: 100px;
            height: 50px;
            background: red;
            border-radius: 50px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: 0.4s;
        }

        input:checked[type="checkbox"] {
            background-color: rgb(100, 189, 99);

        }

        input[type="checkbox"]::after {
            position: absolute;
            content: "";
            width: 50px;
            height: 50px;

            top: 0;
            left: 0;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
            transition: 0.4s;
        }

        input:checked[type="checkbox"]::after {
            left: 50%;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Info <small>(App)</small></h2>
                    <div class="col ml-auto">
                        <div class="dropdown float-right">
                            <a href="{{ route('admin.info.create') }}"><button class="btn btn-primary float-right ml-3"
                                    type="button">Add more +</button></a>
                        </div>
                    </div>
                </div>
                <p class="card-text"> </p>
                @if (Session::has('success'))
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> </strong> {{ Session::get('success') }} <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif
                @if (Session::has('error'))
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" x-data="{ showMessage: true }"
                            x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                            <strong> </strong> {{ Session::get('error') }} <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="row my-4">

                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Info <small>(App)</small></th>
                                            <th style="width:45%">Description</th>
                                            <th>Active Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($infos as $info)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $info->content }}</td>
                                                <td style="width:45%">{{ $info->description }}</td>
                                                <td>
                                                    <div class="check-box text-left">
                                                        <input type="checkbox" data-infoId="{{ $info->id }}"
                                                            name="status" class="js-switchs infoStatus"
                                                            {{ $info->status == 1 ? 'checked' : '' }}
                                                            style="font-size:small;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.info.edit', $info->id) }}"><span
                                                            class="fe fe-24 fe-edit text-success"></span>
                                                    </a>
                                                    <a href="#" class="button delete-confirm"
                                                        onclick="event.preventDefault(); 
            if(confirm('Are you sure you want to delete this item?')) 
            document.getElementById('delete-form-{{ $info->id }}').submit();">
                                                        <span class="fe fe-24 fe-trash text-danger"></span>
                                                    </a>

                                                    <form id="delete-form-{{ $info->id }}"
                                                        action="{{ route('admin.info.destroy', $info->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <script src="https://technext.github.io/tinydash/js/jquery.dataTables.min.js"></script>
    <script src='https://technext.github.io/tinydash/js/dataTables.bootstrap4.min.js'></script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();

            // Get the associated form ID
            const formId = $(this).attr('onclick').match(/deleteInfo\((\d+)\)/)[1];
            const form = $('#delete-form-' + formId);
            const url = form.attr('action');

            swal({
                title: 'Are you sure?',
                text: 'This record and its details will be permanently deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    // Send an AJAX DELETE request
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Add CSRF token for Laravel
                        },
                        success: function(response) {
                            swal("Deleted!", "The record has been deleted.", "success")
                                .then(() => {
                                    // Reload the page or redirect
                                    location.reload();
                                });
                        },
                        error: function(xhr) {
                            swal("Error!", "Something went wrong. Please try again.", "error");
                        }
                    });
                }
            });
        });
    </script> --}}


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#dataTable-1').on('change', '.infoStatus', function() {
                var infoId = $(this).attr('data-infoId');
                var status1 = $(this).is(':checked');
                var status = 0;
                if (status1 == true) {
                    status = 1;
                }

                $.ajax({
                    url: "{{ route('admin.infoStatus') }}",
                    type: 'GET',
                    data: {
                        'infoId': infoId,
                        'status': status,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection
