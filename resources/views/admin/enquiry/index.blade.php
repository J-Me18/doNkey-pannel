@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <h2 class="mb-2 page-title">Enquiry</h2>

                <div class="col ml-auto">
                    <div class="dropdown float-right">
                        <a href="{{ route('enquiry.create') }}">
                            <button class="btn btn-primary float-right ml-3" type="button">Add more +</button>
                        </a>
                    </div>
                </div>
            </div>

            @if(Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif

            @if(Session::has('error'))
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                    <strong>Error:</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif

            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Employee Id</th>
                                        <th>Pincode</th>
                                        <th>Category</th>
                                        <th>Priority</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($enquiry as $enq)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $enq->name }}</td>
                                        <td>{{ $enq->mobile }}</td>
                                        <td>{{ $enq->emp_id }}</td>
                                        <td>
                                            @php
                                            $findpin = App\Models\Pincode::where('id',$enq?->pincode)?->first();
                                            @endphp
                                            @if ($findpin != null)
                                            @foreach ($pincode as $pin)
                                            @if (in_array($pin?->id, $enq?->pincode))
                                            {{ $pin?->pincode }}
                                            @endif
                                            @endforeach
                                            @else
                                            {{ $enq->pincode }}
                                            @endif
                                        </td>
                                        <td>{{ $enq->category }}</td>
                                        <td>{{ $enq->ficon == 1 ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a class="fe fe-24 fe-eye text-warning" href="{{ route('enquiry.show', $enq->id) }}"></a>
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

<script src="https://technext.github.io/tinydash/js/jquery.dataTables.min.js"></script>
<script src="https://technext.github.io/tinydash/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
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
            text: 'This record and its details will be permanently deleted!',
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

