@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Category Settings <span style="font-size: 12px;">(Pincode
                            Wise)</span></h2>
                </div>
                <p class="card-text"> </p>
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
                                            <th>District</th>
                                            <th>Pincode</th>
                                            <th>Subscriber</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pincodes as $pincode)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pincode->district }}</td>
                                                <td>{{ $pincode->pincode }}</td>
                                                @php
                                                    $subscriber = App\Models\Subscriber::where(
                                                        'id',
                                                        $pincode->usedBy,
                                                    )->first();
                                                @endphp
                                                <td>
                                                    <div class="row" style="align-items: center !important;">
                                                        <div class="col-2"><img
                                                                src="{{ url('public/admin/subscriber/profile/' . $subscriber?->image) }}"
                                                                alt="User-Ple"
                                                                style="height: 35px; width:35px;border-radius: 100px;">
                                                        </div>
                                                        <div class="col-10"><a
                                                                href="{{ url('subscriber/show/' . $subscriber?->id) }}">{{ $subscriber?->name }}</a><br>
                                                            {{ $subscriber?->subscriberId }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('pincodebasedcategory.index', ['pincodeId' => $pincode?->id]) }}"><span
                                                            class="fe fe-24 fe-settings text-warning"></span></a>

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

