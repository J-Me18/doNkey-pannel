@extends('layouts.master')

@section('content')
    <!-- Add the DataTables CSS link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- Font Awesome 4.x -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap 4.x CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy1q7rpJ4hS0BhEuRQahg2JjDHpptMizo" crossorigin="anonymous">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Feedbacks</h2>
                    <div class="col ml-auto">
                    </div>
                </div>

                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>E-mail</th>
                                                <th>Phone</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feedbacks as $feedback)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $feedback->name}}</td>
                                                    <td>{{ $feedback->email }}</td>
                                                    <td>{{ $feedback->phone }}</td>
                                                    <td>{{ $feedback->created_at->format('d-m-Y h:i:s A') }}</td>
                                                    <td>
                                                        <div style="display: flex; align-items: center;">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $feedback->id }}">
                                                                Feedback
                                                            </button>
                                                            <div class="modal fade" id="exampleModal{{ $feedback->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {{ $feedback->message }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add the DataTables JS link and initialize the DataTable -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable-1').DataTable({
                autoWidth: true,
                "lengthMenu": [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ],
            });
        });
    </script>

    <!-- Bootstrap 4.x JS, Popper.js is required -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js" integrity="sha384-bz3e9HC8OO6TYqkgPhdSo5ssx8xE00Ra8Sy8Q+rG/N3fUKMIz9cWWPLJ2N9c9u2o" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy1q7rpJ4hS0BhEuRQahg2JjDHpptMizo" crossorigin="anonymous"></script>

    <style>
        /* Define the highlight style */
        .highlight-box {
            text-align: center;
            background-color: #CDE8D1;
            /* Green background color */
            border: 1px solid #1F7A1F;
            /* Dark green border color */
            padding: 3px;
            /* Adjust the padding for a smaller box */
            border-radius: 3px;
            /* Adjust the border radius for a smaller box with rounded corners */
        }

        .solved-box {
            text-align: center;
            background-color: #e8cdcd;
            /* Red background color */
            border: 1px solid #f11717;
            /* Dark red border color */
            padding: 3px;
            /* Adjust the padding for a smaller box */
            border-radius: 3px;
            /* Adjust the border radius for a smaller box with rounded corners */
        }
    </style>
@endsection

