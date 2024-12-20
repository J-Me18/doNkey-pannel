@extends('layouts.submaster')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Employee List</h2>

                    <div class="col ml-auto">
                        <div class="dropdown float-right">
                            <!-- {{-- @can('employee-create') --}} -->
                            <a href="{{ route('subEmployee.create') }}"><button class="btn btn-primary float-right ml-3"
                                    type="button">Add more +</button></a>
                            <!-- {{-- @endcan --}} -->
                        </div>
                    </div>


                </div>
                <p class="card-text"> </p>
                <div class="row">
                    <span id="message" class="alert alert-success alert-dismissible fade show col-md-12"
                        style="display: none;" role="alert">

                    </span>
                </div>
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
                                            <th>Name & Employee Id</th>
                                            <th>Company Mail</th>
                                            <th>Company Mobile</th>
                                            <th>Roles</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->name . ' & ' . $employee->emp_id }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->mobile }}</td>
                                                <td>{{ $employee?->roles[0]?->name }}</td>                                                
                                                <td>
                                                    <a href="{{ route('subEmployee.show', $employee->id) }}"><span
                                                            class="fe fe-24 fe-eye text-warning"></span></a>
                                                    <!-- {{-- @can('employee-edit') --}} -->
                                                    <a href="{{ route('subEmployee.edit', $employee->id) }}"><span
                                                            class="fe fe-24 fe-edit text-success"></span></a>
                                                    <!-- {{-- @endcan --}} -->
                                                    @php
                                                        $user = Session::get('subscribers');
                                                    @endphp
                                                    <!-- @if ($user->hasPermissionTo('employee-destroy')) -->
                                                       <form action="{{ route('subEmployee.destroy', $employee->id) }}" method="post"
                                            class="">
                                            @csrf
                                            @method('DELETE')
                                                      <button type="submit" class="" style="border:unset; background:white;"> <span class="fe fe-24 fe-trash text-danger"></span></button></form>
</a>

                                                    <!-- @endif -->

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
 
    
</script>

    <script>
        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    // url: "{{ url('statusonoroff') }}",
                    url: "{{ url('subscribers/driverStatus') }}",
                    data: {
                        'status': status,
                        'id': userId
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
    <script>
        $(".update_user").click(function() {

            var player_id = $(this).attr('data-payer_id');

            $("#update-form").find("#sub_id").val(player_id);
            $('#update-form').modal('show');
            //$("#update-form").dialog("open");
        });
    </script>
@endsection
@section('scripts')
@endsection
