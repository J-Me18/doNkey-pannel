@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <h2 class="mb-2 page-title">Banner</h2>
                <!-- @can('pincode-create') -->
                <div class="col ml-auto">
                    <div class="dropdown float-right">
                        <a href="{{ route('admin.banner.create') }}"><button class="btn btn-primary float-right ml-3" type="button">Add more +</button></a>
                    </div>
                </div>
                <!-- @endcan -->


            </div>
            <p class="card-text"> </p>
            @if (Session::has('success'))
            <!-- Small table -->
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> </strong> {{ Session::get('success') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif
            @if (Session::has('error'))
            <!-- Small table -->
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                    <strong> </strong> {{ Session::get('error') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                                        <th>Banner Image</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if(isset($banner->image))
                                        @php
                                        $extension = pathinfo($banner->image, PATHINFO_EXTENSION); // Get the file extension
                                        $extension = strtolower($extension); // Convert to lowercase for case insensitivity
                                        @endphp

                                        @if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif')
                                        <td>
                                            <img src="{{url('public/banner/'.$banner->image)}}" style="height:60px;width: 60px;" alt="Banner-Ct">
                                        </td>
                                        @else
                                        <td>
                                            <video controls style="height: 100px; width: 100px;">
                                                <source src="{{ url('public/banner/'.$banner->image) }}" type="video/mp4">
                                            </video>
                                        </td>
                                        @endif
                                        @endif
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->link }}</td>
                                        <td>
                                            <!-- @can('pincode-edit') -->
                                            <a href="{{ route('admin.banner.edit',$banner->id) }}"><span class="fe fe-24 fe-edit text-success"></span></a>
                                            <!-- @endcan
                                            @can('pincode-delete') -->
                                            <a href="{{ route('admin.banner.delete',$banner->id) }}" class="button delete-confirm"><span class="fe fe-24 fe-trash text-danger"></span></a>
                                            <!-- @endcan -->
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