@extends('layouts.submaster')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Complaints </h2>

                    <div class="col ml-auto">
                        <div class="dropdown float-right">
                            <a href="{{ route('subscribers.complaintsform') }}"><button
                                    class="btn btn-primary float-right ml-3" type="button">Add more +</button></a>

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
                                <div class="table-responsive">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Complaints ID</th>
                                                <th>Subscriber</th>
                                                <th>Rider Name</th>
                                                <th>Mobile</th>
                                                <th>Pincode</th>
                                                <th>Priority</th>
                                                <th>Category</th>
                                                <th>Complaint Taken By</th>
                                                <th>In Progress</th>
                                                <th>Solved By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($complaints as $complaint)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $complaint->complaintID }}</td>
                                                    <td>{{ $complaint->subscriber['name'] ?? null }}</td>
                                                    <td>{{ $complaint->name }}</td>
                                                    <td>{{ $complaint->mobile }}</td>
                                                    <td>
                                                        @php
                                                            $subspin = $complaint->pincode;
                                                            foreach ($pincode as $pin) {
                                                                if (in_array($pin->id, $subspin)) {
                                                                    echo $pin->pincode . '<br>';
                                                                }
                                                            }
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        @if ($complaint->ficon == 1)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </td>
                                                    <td>{{ $complaint->category }}</td>
                                                    {{-- {{ dd($complaint->complained_id == 'Subscriber Admin'); }} --}}
                                                    @if ($complaint->complained_by == 'Subscriber Admin')
                                                        @php
                                                            $user = Session::get('subscribers');
                                                            // dd($employee);
                                                        @endphp
                                                        @if (isset($user->subscriberId))
                                                            @php
                                                                $employee = App\Models\Employee::where('email', $user?->email)->first();
                                                            @endphp
                                                            <td>
                                                                <div class="highlight-box">
                                                                    <a
                                                                        href="{{ route('complaintAction', ['complaint' => $employee->id]) }}">{{ $complaint->complained_by }}</a>
                                                                </div>
                                                            </td>
                                                        @else
                                                            @php
                                                                $subscriber = App\Models\Subscriber::where('id', $user->subscriber_id)->first();
                                                                $employee = App\Models\Employee::where('email', $subscriber->email)->first();
                                                            @endphp
                                                            <td>
                                                                <div class="highlight-box">
                                                                    <a
                                                                        href="{{ route('complaintAction', ['complaint' => $employee->id]) }}">{{ $complaint->complained_by }}</a>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    @else
                                                        <td>
                                                            <div class="highlight-box">
                                                                <a
                                                                    href="{{ route('complaintAction', ['complaint' => $complaint->complained_id]) }}">{{ $complaint->complained_by }}</a>
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td>{{ $complaint->status ? $complaint->status : 'Not started' }}</td>
                                                    @if ($complaint->solved_by == 'Subscriber Admin')
                                                        @if (isset($user->subscriberId))
                                                            @php
                                                                $employee = App\Models\Employee::where('email', $user?->email)->first();
                                                            @endphp
                                                            @if ($complaint->solved_id != '')
                                                                <td>
                                                                    <div class="solved-box">
                                                                        <a
                                                                            href="{{ route('complaintAction', ['complaint' => $employee?->id]) }}">{{ $complaint?->solved_by }}</a>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td class="text-center">
                                                                    N/A
                                                                </td>
                                                            @endif
                                                        @else
                                                            @php
                                                                $subscriber = App\Models\Subscriber::where('id', $user->subscriber_id)->first();
                                                                $employee = App\Models\Employee::where('email', $subscriber->email)->first();
                                                            @endphp
                                                            @if ($complaint->solved_id != '')
                                                                <td>
                                                                    <div class="solved-box">
                                                                        <a
                                                                            href="{{ route('complaintAction', ['complaint' => $employee?->id]) }}">{{ $complaint?->solved_by }}</a>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td class="text-center">
                                                                    N/A
                                                                </td>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if ($complaint->solved_id != '')
                                                            <td>
                                                                <div class="solved-box">
                                                                    <a
                                                                        href="{{ route('complaintAction', ['complaint' => $complaint?->solved_id]) }}">{{ $complaint?->solved_by }}</a>
                                                                </div>
                                                            </td>
                                                        @else
                                                            <td class="text-center">
                                                                N/A
                                                            </td>
                                                        @endif
                                                    @endif
                                                    <td>
                                                        <div style="display: flex; align-items: center;">
                                                            <a href="{{ route('complaintShow', $complaint->id) }}"
                                                                style="margin-right: 10px;">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('complaintEdit', $complaint->id) }}"
                                                                class="fe fe-24 fe-log-in text-success"></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
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
