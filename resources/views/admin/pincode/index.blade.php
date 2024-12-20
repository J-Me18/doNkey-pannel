@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Pincode</h2>
                    @can('pincode-create')
                        <div class="col ml-auto">
                            <div class="dropdown float-right">
                                <a href="{{ url('createpincode') }}"><button class="btn btn-primary float-right ml-3"
                                        type="button">Add more +</button></a>

                            </div>
                        </div>
                    @endcan


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

                                            <th>S.No</th>
                                            <th>State</th>
                                            <th>District</th>
                                            <th>Village/Town</th>
                                            <th>Taluk</th>
                                            <th>Pincode</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($pincode as $pincode)
                                            <tr>


                                                <td>{{ $i }}</td>
                                                <td>{{ $pincode->state }}</td>
                                                <td>{{ $pincode->district }}</td>
                                                <td>{{ $pincode->city }}</td>
                                                <td>{{ $pincode->taluk }}</td>
                                                <td>{{ $pincode->pincode }}</td>

                                                <td>
                                                    @can('pincode-edit')
                                                        <a href="{{ url('pincode/' . $pincode->id) }}"><span
                                                                class="fe fe-24 fe-edit text-success"></span></a>
                                                    @endcan
                                                    @can('pincode-delete')
                                                        <a href="{{ url('pincodedelete/' . $pincode->id) }}"
                                                            class="button delete-confirm"><span
                                                                class="fe fe-24 fe-trash text-danger"></span></a>
                                                    @endcan


                                                </td>
                                            </tr>
                                            <?php $i++; ?>
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
    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    </script>
@endsection
