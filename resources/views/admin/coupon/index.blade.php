@extends('layouts.master')
@section('content')
    <!-- Add the DataTables CSS link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <style>
        /* body {
                height: 100vh;
                display: grid;
                place-items: center;
                margin: 0;
             background: #222;
            } */
        .error {
            color: red;
        }

        .check-box {
            transform: scale(.5);
        }

        input[type="checkbox"] {
            position: relative;
            appearance: none;
            width: 100px;
            height: 50px;
            background: red;
            border-radius: 50px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: 0.4s;
        }

        input:checked[type="checkbox"] {
            background-color: rgb(100, 189, 99);

        }

        input[type="checkbox"]::after {
            position: absolute;
            content: "";
            width: 50px;
            height: 50px;

            top: 0;
            left: 0;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
            transition: 0.4s;
        }

        input:checked[type="checkbox"]::after {
            left: 50%;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Coupons</h2>

                    <div class="col ml-auto">
                        @can('coupon-create')
                            <div class="dropdown float-right">
                                <a href="{{ route('coupon.create') }}">
                                    <button class="btn btn-primary float-right ml-3" type="button">Add more +</button>
                                </a>
                            </div>
                        @endcan
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
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Code</th>
                                                <th>Type</th>
                                                <th>Pincode</th>
                                                <th>Limit</th>
                                                <th>Multiple Time</th>
                                                <th>Start Date</th>
                                                <th>Exipry Date</th>
                                                <th>Status</th>
                                                @can('coupon-edit')
                                                    <th>Action</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                            @foreach ($coupons as $coupon)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $coupon->title }}</td>
                                                    <td>
                                                        @if (isset($coupon?->image))
                                                            <img src="{{ asset('coupon/' . $coupon?->image) }}"
                                                                alt="Coupon-Img" style="width: 35px;height: 35px;">
                                                        @endif
                                                    </td>
                                                    <td><span class="badge badge-success">{{ $coupon->code }}</span></td>
                                                    <td>{{ $coupon->type == 1 ? 'Admin' : 'Pincode' }}</td>
                                                    <td>
                                                        @if (isset($coupon->pincode))
                                                            {{ $coupon?->pincode?->pincode }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($coupon->limit == 0)
                                                            <span class="badge badge-danger">Limit Reached</span>
                                                        @else
                                                            {{ $coupon->limit }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                    
                                                        @if ($coupon->is_multiple == 1)
                                                            <span class="badge badge-success">Yes</span>
                                                        @elseif (($coupon->is_multiple != null || $coupon->is_multiple != "null") && ($coupon->is_multiple == 0) )
                                                            <span class="badge badge-danger">No</span>
                                                        @else
                                                            <span class="badge badge-warning">Something Wrong</span>
                                                        @endif
                                                    </td>
                                                    @if ($coupon->expiry_date->format('Y-m-d') < now()->format('Y-m-d'))
                                                        <td><span class="badge badge-danger">Expired</span></td>
                                                        <td><span class="badge badge-danger">Expired</span></td>
                                                    @else
                                                        <td>{{ $coupon->start_date->format('dM,Y') }}</td>
                                                        <td>{{ $coupon->expiry_date->format('dM,Y') }}</td>
                                                    @endif
                                                    @can('Status on')
                                                        @if ($coupon->expiry_date->format('Y-m-d') < now()->format('Y-m-d') && $coupon->status == 0)
                                                            <td><span class="badge badge-danger">Expired</span></td>
                                                        @else
                                                            <td>
                                                                <div class="check-box text-left">
                                                                    <input type="checkbox" data-couponId="{{ $coupon->id }}"
                                                                        name="status" class="js-switchs couponStatus"
                                                                        {{ $coupon->status == 1 ? 'checked' : '' }}
                                                                        style="font-size:small;">
                                                                </div>
                                                            </td>
                                                        @endif
                                                    @endcan
                                                    @can('coupon-edit')
                                                        <td>
                                                            <a href="#" data-toggle="modal"
                                                                data-dataId="{{ $coupon->id }}"
                                                                data-target="#coupon{{ $coupon->id }}"><span
                                                                    class="fe fe-24 fe-edit text-success couponModal"></span></a>
                                                        </td>
                                                    @endcan
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="coupon{{ $coupon->id }}" tabindex="-1"
                                                    aria-labelledby="coupon{{ $coupon->id }}Label" aria-hidden="true"
                                                    data-backdrop="static" data-keyboard="false">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="coupon{{ $coupon->id }}Label">
                                                                    {{ $coupon->title }} coupon edit
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('coupon.update', $coupon->id) }}"
                                                                method="POST" class="coupUpdateForm{{ $coupon->id }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-row">
                                                                        <div class="col-md-12 mb-3">
                                                                            <label for="title">Title</label>
                                                                            <input type="text"
                                                                                class="form-control @error('title') is-invalid @enderror "
                                                                                id="title" name="title"
                                                                                value="{{ old('title', $coupon->title) }}">
                                                                            @error('title')
                                                                                <span class="invalid-feedback">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="col-md-12 mb-3">
                                                                            <label for="title">Start Date</label>
                                                                            <input type="date"
                                                                                class="form-control @error('start_date') is-invalid @enderror "
                                                                                id="start_date" name="start_date"
                                                                                value="{{ old('start_date', \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d')) }}"
                                                                                readonly>
                                                                            @error('start_date')
                                                                                <span class="invalid-feedback">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="col-md-12 mb-3">
                                                                            <label for="title">End Date</label>
                                                                            <input type="date"
                                                                                class="form-control @error('expiry_date') is-invalid @enderror "
                                                                                id="expiry_date" name="expiry_date"
                                                                                value="{{ old('expiry_date', \Carbon\Carbon::parse($coupon->expiry_date)->format('Y-m-d')) }}"
                                                                                min="{{ now()->format('Y-m-d') }}">
                                                                            @error('expiry_date')
                                                                                <span class="invalid-feedback">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="col-md-12 mb-3">
                                                                            <label for="code">Limit To Use</label>
                                                                            <input type="text"
                                                                                class="form-control @error('limit') is-invalid @enderror"
                                                                                min=1
                                                                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                                                id="limit"
                                                                                value="{{ old('limit', $coupon->limit) }}"
                                                                                name="limit">
                                                                            @error('limit')
                                                                                <span class="invalid-feedback">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            var couponId;
            $('.couponModal').on('click', function() {
                couponId = $(this).attr('data-dataId');
            });
            $('.coupUpdateForm' + couponId).validate({
                //  alert(couponId);
                rules: {
                    title: "required",
                    limit: "required",

                },
                messages: {
                    title: "Title is required",
                    limit: "Limit is required",

                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $('#dataTable-1').on('change', '.couponStatus', function() {
                var couponId = $(this).attr('data-couponId');
                var status1 = $(this).is(':checked');
                var status = 0;
                if (status1 == true) {
                    status = 1;
                }

                $.ajax({
                    url: "{{ route('coupStatus') }}",
                    type: 'GET',
                    data: {
                        'couponId': couponId,
                        'status': status,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection
@endsection

