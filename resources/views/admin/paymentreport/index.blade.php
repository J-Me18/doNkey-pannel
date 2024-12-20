@extends('layouts.master')
<style>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Payment History</h2>

                    {{-- <div class="col ml-auto">
                    <div class="dropdown float-right">
                        <a href="{{ route('excelpincode.create') }}">
                            <button class="btn btn-primary float-right ml-3" type="button">Add more +</button>
                        </a>
                    </div>
                </div> --}}
                </div>

                @if (Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" x-data="{ showMessage: true }"
                            x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                            <strong>Error:</strong> {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif
                <style>


                </style>


                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body table-responsive">
                                {{-- <form method="GET" class="search-form form-inline"
                action="">

                <div class="form-group for pl-3">
                    <label class="mr-2">Search:</label>
                    <input value="{{ request('search') }}" type="text" class="form-control"
                        name="search" autocomplete="off" placeholder="Search..." min="" />
                </div>

                <div class="form-group pl-3">
                    <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i
                            class="fa fa-search "></i></button>
                    <a class="btn btn-danger m-btn m-btn--air m-btn--custom"
                        href="{{ route('paymenthistory.index') }}"><i class="fa fa-times"></i></a>
                </div>
                </form> --}}
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Invoice Number</th>
                                            <th>Subscriber Id</th>
                                            <th>Payment Id</th>
                                            <th>Email</th>
                                            <th>Status </th>

                                            <th>Amount</th>
                                            <th>Date</th>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($paymentDetails as $paymentDetail)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $paymentDetail?->invoice_no ? $paymentDetail?->invoice_no : "-" }}</td>
                                                <td>{{ $paymentDetail->subscriberId }}</td>
                                                <td>{{ $paymentDetail->payment_id }}</td>
                                                {{-- {{ dd($subscribermail); }} --}}

                                                <td>{{ $paymentDetail?->subscriber?->email }}</td>
                                                @if ($paymentDetail->status_code == 200)
                                                    <td style="color: green;">Success</td>
                                                @else
                                                    <td style="color: red;">Failure</td>
                                                @endif

                                                <td>{{ $paymentDetail->amount / 100 }}</td>
                                                <td>{{ $paymentDetail->created_at->format('d-m-Y') }}</td>

                                                <td>
                                                    <a href="{{ route('paymenthistory.show', $paymentDetail->id) }}">
                                                        <i class="fe fe-24 fe-eye text-warning"></i>

                                                    </a>
                                                    @if ($paymentDetail->status_code == 200)
                                                        <a href="{{ route('paymenthistory.edit', $paymentDetail->id) }}">
                                                            <button class="btn btn-success">Invoice</button>
                                                        @else
                                                            <p></p>
                                                    @endif
                                                    </a>

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
                {{-- <div class="custom-pagination"style="height:30px;" >
    {{ $paymentDetails->links() }}
</div> --}}
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
                    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switchs'));

                    elems.forEach(function(html) {
                        let switchery = new Switchery(html, {
                            size: 'small'
                        });
                    });
                </script>

                <script>
                    $(document).ready(function() {
                        $('.js-switchs').change(function() {
                            let status = $(this).prop('checked') === true ? 1 : 0;
                            let Id = $(this).data('id');
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: "driverActivate",
                                data: {
                                    'status': status,
                                    'id': Id
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

