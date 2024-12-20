@extends('layouts.submaster')
@section('content')
<style>

.mm{
color:black;
}
</style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card card-fill timeline">
                    <div class="card-header">
                        <h5 class="text-center "><strong class="text-danger">ENQUIRY DETAILS</strong></h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped  table-bordered ">

                            <tbody>
                                <tr class="table-secondary">
                                    <td class="text-center mm"> <strong class="mm">Name </strong></td>
                                    <td class="mm">{{ $enquiry->name }}</td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center mm"><strong class="mm"> Email ID</strong></td>
                                    <td class="mm"> {{ $enquiry->mailId }}</td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center mm"><strong class="mm"> Mobile</strong> </td>
                                    <td class="mm"> {{ $enquiry->mobile }}</td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center mm"> <strong class="mm">Area </strong></td>
                                    <td class="mm"> {{ $enquiry->area }}</td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center mm"><strong class="mm"> Category </strong></td>
                                    <td class="mm"> {{ $enquiry->category }}</td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center mm"><strong class="mm"> Pincode</strong> </td>
                                    <td class="mm">


                                        @foreach ($pincode as $pin)
                                            @if (in_array($pin->id, $enquiry->pincode))
                                                {{ $pin->pincode }}
                                            @endif
                                        @endforeach



                                    </td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center mm"><strong class="mm"> Favourite </strong></td>
                                    <td class="mm">
                                        @if ($enquiry->ficon == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center mm"> <strong class="mm">Submitted On </strong></td>
                                    <td class="mm">{{ $enquiry->created_at }}</td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center mm"><strong class="mm"> Description</strong> </td>
                                    <td class="mm"> {{ $enquiry->description }}</td>

                                </tr>

                            </tbody>

                        </table>
                        <div class="pull-left">
                            <a class="btn btn-primary" href="{{ route('enquiry.index') }}" data-toggle="modal"
                                data-target="#commentsModal">+ Add Commands</a>
                        </div>
                        @php
                            // $admin = Sesssion::get('subscribers');
                            // $employeeId = $admin->emp_id;
                            // dd($employeeId);
                        @endphp
                        <!-- Modal -->
                        <div class="modal fade" id="commentsModal" tabindex="-1" role="dialog"
                            aria-labelledby="commentsModalTitle" aria-hidden="true">
                            <form class="needs-validation" method="post" action="{{ route('enquiryComment.store') }}"
                                enctype="multipart/form-data" novalidate>
                                {{ csrf_field() }}
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Give Your Comment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" hidden>
                                            <div class="col-md-12 mb-6"></div>
                                            <input class="form-control @error('enquiry_id') is-invalid @enderror"
                                                id="enquiry_id" name="enquiry_id" value="{{ $enquiry->id }}" readonly>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12 mb-6"></div>
                                            <label>Your Id</label>
                                            <input class="form-control @error('employee_id') is-invalid @enderror"
                                                id="employee_id" name="employee_id" value="{{ $employeeId }}" readonly>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12 mb-6"></div>
                                            <label>Comment:</label>
                                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" required>{{ old('comment') }}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="sybmit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>






                    </div> <!-- / .card-body -->
                </div> <!-- / .card -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
    <br>
    <br>
    <div class="container-fluid">
        <div class="justify-content-center table-responsive">
            <table class="table datatables" id="dataTable-1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Employee ID</th>
                        <th>Comment</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($enquiry->enquiryComment as $comment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if(is_numeric($comment->admin_id))
                            <td>Admin</td>
                            @else
                            <td>{{ $comment->employee_id }}</td>
                            @endif                            
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->created_at->format('d-m-Y h:i:s A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://technext.github.io/tinydash/js/jquery.dataTables.min.js"></script>
    <script src='https://technext.github.io/tinydash/js/dataTables.bootstrap4.min.js'></script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [10, 32, 64, -1],
                [10, 32, 64, "All"]
            ]
        });
    </script>
@endsection
@section('scripts')
@endsection
