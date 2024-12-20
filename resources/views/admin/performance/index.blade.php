@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- In the <head> section of your layout file -->
<!-- jQuery CDN link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Employee Performance Reports </h2>
                </div>
                <p class="card-text"> </p>
                <div class="row">
                    <span id="message" class="alert alert-success alert-dismissible fade show col-md-12"
                        style="display: none;" role="alert">

                    </span>
                </div>

                <div class="row my-4">

                    <!-- Small table -->
                    <div class="col-md-12">


                        <div class="card shadow">

                            <div class="card-body">
                                <div class="m-section__content">

                                    <div class="pull-left">
                                        {{-- <button class="btn btn-primary" id="list">
                                            <i class="fas fa-eye-slash"></i>
                                            <ul id="dataList" style="display: none;"></ul>
                                        </button> --}}
                                    </div>
                                </div>
                                <!-- table  -->
                                <div id="dataContainer">
                                    <table class="table datatables" id="dataTable-1">

                                        <thead>

                                            <tr>
                                                <th>S.No</th>
                                                <th>Employee Name</th>
                                                <th>Employee ID</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($employees as $employee)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->emp_id }}</td>
                                                    <td>{{ $employee->mobile }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>{{ $employee->roles[0]->name }}</td>
                                                    <td>
                                                        <a href="{{ route('employeePerformance.show', $employee->id) }}"><span
                                                                class="badge badge-primary">Report</span></a>
                                                        <a href="{{ route('employeeReport.show', $employee->id) }}"><span
                                                                class="badge badge-warning">Attendance</span></a>
                                                        <a
                                                            href="{{ route('complaintReport.show', $employee->id) }}"><span
                                                                class="badge badge-secondary">Complaints</span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- {{ $bookings->links() }} --}}
                                        </tbody>
                                    </table>
                                </div>
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
        $(document).ready(function() {
            // Attach a click event handler to the button
            // $('#list').click(function() {
            //     // Assuming you have a function to retrieve the data, call it here
            //     // For demonstration purposes, let's assume you have an object containing the data
            //     var data = {
            //         name: "John Doe",
            //         age: 30
            //     };

            //     // Clear the previous data
            //     $('#dataContainer').empty();

            //     // Create and append list items for name and age
            //     var nameItem = $('<li>').text("Name: " + data.name);
            //     var ageItem = $('<li>').text("Age: " + data.age);
            //     $('#dataContainer').append(nameItem, ageItem);
            // });
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html, {
                size: 'small'
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let Id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "driverActivate",
                    data: {
                        'status': status,
                        'id': Id
                    },
                    success: function(data) {
                        //console.log(data.success);
                        $('#message').fadeIn().html(data.success);
                        setTimeout(function() {
                            $('#message').fadeOut("slow");
                        }, 1000);

                    }
                });
            });
        });
    </script>
@endsection
@section('scripts')
@endsection
