@extends('layouts.submaster')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <h2 class="mb-2 page-title">Enquiry</h2>

                <div class="col ml-auto">
                    <div class="dropdown float-right">
                        <a href="{{ route('subscribers.enquiryform') }}"><button class="btn btn-primary float-right ml-3" type="button">Add more +</button></a>

                    </div>
                </div>


            </div>
            <p class="card-text"> </p>
            @if(Session::has('success'))
            <!-- Small table -->
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> </strong> {{ Session::get('success') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif
            @if(Session::has('error'))
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

                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Employee Id</th>

                                        <th>Mobile</th>
                                        <th>Email</th>

                                        <th>Category</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($enquiry as $enquiry)
                                    <tr>


                                        <td>{{ $i}}</td>
                                        <td>{{$enquiry->name}}</td>
                                        @if ($enquiry->subscriberId == 0)
                                        <td>Admin</td>
                                        @else
                                        <td>{{$enquiry->emp_id}}</td>
                                        @endif
                                        <td>{{$enquiry->mobile}}</td>

                                        <td>{{$enquiry->mailId}}</td>
                                        <td>{{$enquiry->category}}</td>

                                        <td>
                                            <a class="fe fe-24 fe-eye text-success" href="{{ url('subscribers/enquiry',$enquiry->id) }}"></a>

                                            {{-- <a href="{{ route('users.edit',$enquiry->id) }}"><span class="fe fe-24 fe-edit text-success"></span></a>
                                            <a href="{{ url('enquiry/delete/'.$enquiry->id)}}" class="button delete-confirm"><span class="fe fe-24 fe-trash text-danger"></span></a> --}}

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
