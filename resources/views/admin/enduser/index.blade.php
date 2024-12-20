@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<style>
.custom-table-container {
    overflow-x: auto;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
}

.custom-table th, .custom-table td {
    padding: 8px;
    border: 1px solid #ddd;
}

.custom-table th {
    background-color: #f2f2f2;
}

</style>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Enduser</h2>

                    <div class="col ml-auto">
                        <div class="dropdown float-right">
                            {{-- <a href="{{ url('createenduser') }}"><button class="btn btn-primary float-right ml-3" type="button">Add more +</button></a> --}}

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

                                            <th>S.No</th>
                                            <th>User Id</th>
                                            <th> Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Current Status</th>
                                            <th>Changing Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($enduser as $enduser)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $enduser->user_id }}</td>
                                                <td>{{ $enduser->name }}</td>
                                                <td>{{ $enduser->email }}</td>
                                                <td>{{ $enduser->phone }}</td>
                                                @php
                                                    $statusValues = [
                                                        0 => ['label' => 'Block', 'color' => 'red'],
                                                        1 => ['label' => 'Unblock', 'color' => 'green'],
                                                    ];
                                                @endphp
                                                <td> <span
                                                        style="color: {{ $statusValues[$enduser->blockedstatus]['color'] ?? 'black' }}">
                                                        {!! htmlspecialchars($statusValues[$enduser->blockedstatus]['label'] ?? 'Unknown') !!}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($enduser->blockedstatus == 0)
                                                        <button type="submit" class="btn mb-2 btn-outline-success"
                                                            data-toggle="modal"
                                                            data-target="#unblockModalCenter{{ $enduser->id }}">Unblock</button>
                                                    @else
                                                        <button type="submit" class="btn mb-2 btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#blockModalCenter{{ $enduser->id }}">Block</button>
                                                    @endif
                                                </td>
                                                           
<!-- Modal -->
<td>
    <i class="fe fe-info fe-16" style="font-size: 17px; color:#007fff; cursor: pointer;" data-toggle="modal" data-target="#infoModal{{ $enduser->id }}"></i>
</td>

<!-- Modal -->
<div class="modal fade" id="infoModal{{ $enduser->id }}" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <div class="modal-body">
    <!-- Add your reason content here -->
    @if ($enduser->enduserreason->isNotEmpty())
        @php
            $latestReason = $enduser->enduserreason->sortByDesc('created_at')->first();
        @endphp
        <div class="row">
            <div class="col-6">  <p>User Id: <span> {{ $enduser->user_id }}</span> </p></div>
            <div class="col-6">  <p>Employee ID: <span>{{ App\Models\Admin::where('id',$latestReason?->admin_id)?->first()?->emp_id}}</span> </p></div>
        </div>
        <h6>Status: <span style="color: gray">{{ $latestReason->status }}</span></h6>
        <h6>Reason: <span style="color: gray">{{ $latestReason->reason }}</span></h6>
        <p style="font-weight:500;color:black;">Date: <span style="color: black;font-weight:500;">{{ $latestReason->created_at->format('d-m-Y') }}</span></p>
    @else
        <p>No reason available.</p>
    @endif
</div>


            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

                                            </tr>
                                            <!--Block Modal -->
                                            <div class="modal fade" id="blockModalCenter{{ $enduser->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="blockModalCenterTitle" aria-hidden="true">
                                                <form action="{{ route('blockenduser', $enduser->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    @php
                                                        $admin = Auth::user();
                                                        $employeeId = $admin->emp_id;
                                                    @endphp
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Why Are
                                                                    You
                                                                    Block {{ $enduser->name }}?
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-12 mb-6">
                                                                    <label>Your Id:</label>
                                                                    <input
                                                                        class="form-control @error('employee_id') is-invalid @enderror"
                                                                        id="employee_id" name="employee_id"
                                                                        value="{{ $employeeId }}" readonly>
                                                                </div>
                                                                <div class="col-md-12 mb-6">
                                                                    <label>End User Id:</label>
                                                                    <input
                                                                        class="form-control @error('user_id') is-invalid @enderror"
                                                                        id="user_id" name="user_id"
                                                                        value="{{ $enduser->user_id }}" readonly>
                                                                </div>
                                                                <div class="col-md-12 mb-6">
                                                                    <label>Reason:</label>
                                                                    <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" required>{{ old('reason') }}</textarea>
                                                                </div>
                                                                <div class="col-md-12 mb-6" hidden>
                                                                    {{-- <label>End User Id:</label> --}}
                                                                    <input
                                                                        class="form-control @error('status') is-invalid @enderror"
                                                                        name="status" value="Block" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="sybmit" class="btn btn-danger">Block</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Unblock Modal -->
                                            <div class="modal fade" id="unblockModalCenter{{ $enduser->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="unblockModalCenterTitle"
                                                aria-hidden="true">
                                                <form action="{{ route('unblockenduser', $enduser->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Why Are
                                                                    You
                                                                    Unblock {{ $enduser->name }}?
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-12 mb-6">
                                                                    <label>Your Id:</label>
                                                                    <input
                                                                        class="form-control @error('employee_id') is-invalid @enderror"
                                                                        id="employee_id" name="employee_id"
                                                                        value="{{ $employeeId }}" readonly>
                                                                </div>
                                                                <div class="col-md-12 mb-6">
                                                                    <label>End User Id:</label>
                                                                    <input
                                                                        class="form-control @error('user_id') is-invalid @enderror"
                                                                        id="user_id" name="user_id"
                                                                        value="{{ $enduser->user_id }}" readonly>
                                                                </div>
                                                                <div class="col-md-12 mb-6">
                                                                    <label>Reason:</label>
                                                                    <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" required>{{ old('reason') }}</textarea>
                                                                </div>
                                                                <div class="col-md-12 mb-6" hidden>
                                                                    {{-- <label>End User Id:</label> --}}
                                                                    <input
                                                                        class="form-control @error('status') is-invalid @enderror"
                                                                        name="status" value="Unblock" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="sybmit"
                                                                    class="btn btn-success">Unblock</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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
    <script>
        $(".update_user").click(function() {

            var player_id = $(this).attr('data-payer_id');

            $("#update-form").find("#sub_id").val(player_id);
            $('#update-form').modal('show');
            //$("#update-form").dialog("open");
        });

        function showtextarea(value) {
            if (value == "Other") {
                $('.statuschangeselecttextarea').slideDown()
            } else {
                $('.statuschangeselecttextarea').slideUp()
            }
        }
    </script>
@endsection
