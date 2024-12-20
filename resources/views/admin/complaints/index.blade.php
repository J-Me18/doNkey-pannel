@extends('layouts.master')
@section('content')
    <!-- Add the DataTables CSS link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Complaints</h2>

                    <div class="col ml-auto">
                        <div class="dropdown float-right">
                            <a href="{{ route('complaints.create') }}">
                                <button class="btn btn-primary float-right ml-3" type="button">Add more +</button>
                            </a>
                        </div>
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
                                            <th>Complaints ID</th>
                                            <th>Subscriber</th>
                                            <th>Rider Name</th>
                                            <th>Mobile</th>
                                            <th>Pincode</th>
                                            <th>Priority</th>
                                            <th>Category</th>
                                            <th>Complaint Taken By</th>
                                            <th>In Process</th>
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
                                                <td>
                                                    <div class="highlight-box">
                                                        <a
                                                            href="{{ route('complaint', ['complaint' => $complaint->complained_id]) }}">{{ $complaint->complained_by }}</a>
                                                    </div>
                                                </td>
                                                <td>{{ $complaint->status ? $complaint->status : "Not Started" }}</td>
                                                @if ($complaint->solved_id != '')
                                                    <td>
                                                        <div class="solved-box">
                                                            <a
                                                                href="{{ route('complaint', ['complaint' => $complaint?->solved_id]) }}">{{ $complaint?->solved_by }}</a>
                                                        </div>
                                                    </td>
                                                @else
                                                <td class="text-center">
                                                    N/A
                                                </td>
                                                @endif
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('complaints.show', $complaint->id) }}"
                                                            style="margin-right: 10px;">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('complaints.edit', $complaint->id) }}"
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add the DataTables JS link and initialize the DataTable -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
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
