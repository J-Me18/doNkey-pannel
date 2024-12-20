@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- In the <head> section of your layout file -->
<!-- jQuery CDN link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title"> Booking Report </h2>
                </div>
                <p class="card-text"> </p>
                <div class="row">
                    <span id="message" class="alert alert-success alert-dismissible fade show col-md-12"
                        style="display: none;" role="alert">

                    </span>
                </div>

                <div class="row my-4">

                    <!-- Small table -->
                    <div class="col-md-12">


                        <div class="card shadow">

                            <div class="card-body">
                                <div class="m-section__content">
                                    <form method="GET" class="search-form form-inline"
                                        action="{{ route('bookingReport') }}">

                                        <div class="form-group for pl-2">
                                            <label class="mr-2">From Date:</label>
                                            <input value="{{ request('from_date') }}" type="date" class="form-control"
                                                name="from_date" autocomplete="off" placeholder="From Date"
                                                min="" />
                                        </div>
                                        <div class="form-group for pl-3">
                                            <label class="mr-2">To Date:</label>
                                            <input value="{{ request('to_date') }}" type="date" class="form-control"
                                                name="to_date" autocomplete="off" placeholder="To Date" min="" />
                                        </div>
                                        <div class="form-group for pl-3">
                                            <label class="mr-2">Search:</label>
                                            <input value="{{ request('search') }}" type="text" class="form-control"
                                                name="search" autocomplete="off" placeholder="Search..." min="" />
                                        </div>
                                        @php
                                            $statusValues = [
                                                0 => 'Pending',
                                                1 => 'In Progress',
                                                2 => 'Completed',
                                                3 => 'Cancelled',
                                                4 => 'On Ride',
                                            ];
                                        @endphp
                                        <div class="form-group for pl-3">
                                            <label class="mr-2">Status:</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>
                                                @foreach ($statuses as $status)
                                                    <option {{ request('status') == $status ? 'selected' : '' }}
                                                        value="{{ $status }}">
                                                        {{ $statusValues[$status] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @php
                                            $paymenttypes = [
                                                0 => 'Wallet',
                                                1 => 'Cash',
                                                2 => 'Online',
                                            ];
                                        @endphp

                                        <div class="form-group for pl-3" style="margin-top:30px;">
                                            <label class="mr-2">Payment Type:</label>
                                            <select class="form-control" name="type">
                                                <option value="">Select Type</option>
                                                @foreach ($types as $type)
                                                    <option {{ request('type') == $type ? 'selected' : '' }}
                                                        value="{{ $type }}">
                                                        {{ $paymenttypes[$type] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group pl-3" style="margin-top:30px;">
                                            <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i
                                                    class="fa fa-search "></i></button>
                                            <a class="btn btn-danger m-btn m-btn--air m-btn--custom"
                                                href="{{ route('bookingReport') }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    </form>

                                    <div class="pull-left">
                                        {{-- <button class="btn btn-primary" id="list">
                                            <i class="fas fa-eye-slash"></i>
                                            <ul id="dataList" style="display: none;"></ul>
                                        </button> --}}
                                    </div>
                                    <div class="pull-right pl-2">
                                        <a class="btn btn-danger" target="blank"
                                            href="{{ route('downloadPDF', ['from_date' => request('from_date'), 'to_date' => request('to_date'), 'search' => request('search'), 'status' => request('status'), 'type' => request('type')]) }}">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <a class="btn btn-success"
                                            href="{{ route('downloadExcel', ['from_date' => request('from_date'), 'to_date' => request('to_date'), 'search' => request('search'), 'status' => request('status'), 'type' => request('type')]) }}">
                                            <i class="fas fa-file-excel"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- table  -->
                                <div id="dataContainer" class=table-responsive>
                                    <table class="table datatables" id="dataTable-1">

                                        <thead>

                                            <tr>

                                                <th>S.No</th>
                                                <th>Booking ID</th>
                                                <th>Category</th>
                                                <th>Cost</th>
                                                <th>Service Cost</th>
                                                <th>Customer Name</th>
                                                <th>Rider ID</th>
                                                <th>Pincode</th>
                                                <th>Distance</th>
                                                @php
                                                    $statusValues = [
                                                        0 => 'Pending',
                                                        1 => 'In Progress',
                                                        2 => 'Completed',
                                                        3 => 'Cancelled',
                                                        4 => 'On Ride',
                                                    ];
                                                @endphp
                                                <th>Status</th>
                                                <th>Payment Method</th>
                                                <th>Date </th>
                                                <th>View </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @php
                                                $totalAmount = 0;
                                                $servicetotalAmount = 0;
                                            @endphp
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $booking?->booking_id }}</td>
                                                    <td>{{ App\Models\Category::where('id', $booking?->category)?->first()?->category }}
                                                    </td>
                                                    <td>
                                                        @if ($booking && count($booking->bookingPayment) > 0)
                                                            @if ($booking->bookingPayment[0]->coupon_id != '')
                                                                {{ '₹' . $booking->bookingPayment[0]->total - $booking->bookingPayment[0]->coupon_amount }}
                                                                <i class="fas fa-ticket-alt"
                                                                    style="color: green; font-size: 12px !important;"></i>
                                                            @else
                                                                {{ '₹' . $booking->bookingPayment[0]->total }}
                                                            @endif
                                                        @endif
                                                    </td>

                                                    @php
                                                        $subId = App\Models\Pincode::where(
                                                            'pincode',
                                                            $booking->pincode,
                                                        )?->first()?->usedBy;
                                                        $subscriber = App\Models\Subscriber::where(
                                                            'id',
                                                            $subId,
                                                        )?->first();
                                                    @endphp
                                                    @if (
                                                        $booking &&
                                                            isset($booking->bookingPayment) &&
                                                            count($booking->bookingPayment) > 0 &&
                                                            $booking->bookingPayment[0]->service_cost > 0)
                                                        <td>{{ '₹' . $booking->bookingPayment[0]->service_cost }}</td>
                                                    @else
                                                        @if (isset($subscriber))
                                                            @if ($booking && $booking->category == 1)
                                                                <td>{{ '₹' . $subscriber->biketaxi_price }}</td>
                                                            @elseif($booking && $booking->category == 2)
                                                                <td>{{ '₹' . $subscriber->pickup_price }}</td>
                                                            @else
                                                                <td>{{ '₹' . $subscriber->buy_price }}</td>
                                                            @endif
                                                        @else
                                                            <td>{{ '₹0' }}</td>
                                                        @endif
                                                    @endif
                                                    <td>{{ $booking->user->name }}</td>

                                                    @if (isset($userid))
                                                        @php
                                                            $userid = App\Models\Driver::where(
                                                                'id',
                                                                $booking->accepted,
                                                            )->first()?->userid;
                                                            $user_id = App\models\User::where('id', $userid)->first()
                                                                ->user_id;
                                                        @endphp
                                                        <td>{{ $user_id }}
                                                        </td>
                                                    @else
                                                        <td>{{ App\Models\User::where('id', $booking->accepted)->first()?->user_id }}
                                                        </td>
                                                    @endif


                                                    <td>{{ $booking->pincode }}</td>
                                                    <td>{{ $booking->distance }}</td>
                                                    <td>{{ isset($booking) ? $statusValues[$booking->status] : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        @if ($booking && isset($booking->bookingPayment) && count($booking->bookingPayment) > 0)
                                                            @if ($booking->bookingPayment[0]->type == 0)
                                                                <p>Wallet</p>
                                                            @elseif ($booking->bookingPayment[0]->type == 1)
                                                                <p>Cash</p>
                                                            @elseif ($booking->bookingPayment[0]->type == 2)
                                                                <p>Online</p>
                                                            @else
                                                                <p>Not Yet</p>
                                                            @endif
                                                        @else
                                                            <p>Not Yet</p>
                                                        @endif

                                                    </td>
                                                    <td>{{ isset($booking) ? \Carbon\Carbon::parse($booking?->created_at)?->format('d-m-Y') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('viewbooking', $booking->id) }}"><span
                                                                class="badge badge-danger">View</span></a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                                @php
                                                    $subId = App\Models\Pincode::where(
                                                        'pincode',
                                                        $booking->pincode,
                                                    )->first();
                                                    $subscriber = null;

                                                    if ($subId) {
                                                        $subscriber = App\Models\Subscriber::find($subId->usedBy);
                                                    }
                                                    if ($booking->bookingPayment->first()?->coupon_id != '') {
                                                        $totalAmount +=
                                                            optional($booking->bookingPayment->first())->total -
                                                                optional($booking->bookingPayment->first())
                                                                    ->coupon_amount ??
                                                            0;
                                                    } else {
                                                        $totalAmount +=
                                                            optional($booking->bookingPayment->first())->total ?? 0;
                                                    }

                                                    if (
                                                        $booking->bookingPayment->isNotEmpty() &&
                                                        $booking->bookingPayment->first()->service_cost > 0
                                                    ) {
                                                        $servicetotalAmount += $booking->bookingPayment->first()
                                                            ->service_cost;
                                                    } else {
                                                        if ($booking->category == 1) {
                                                            $servicetotalAmount +=
                                                                optional($subscriber)->biketaxi_price ?? 0;
                                                        } elseif ($booking->category == 2) {
                                                            $servicetotalAmount +=
                                                                optional($subscriber)->pickup_price ?? 0;
                                                        } else {
                                                            $servicetotalAmount +=
                                                                optional($subscriber)->buy_price ?? 0;
                                                        }
                                                    }
                                                @endphp
                                            @endforeach
                                            {{-- {{ $bookings->links() }} --}}
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total:</th>
                                                <th>{{ '₹' . '' . $totalAmount }}</th>
                                                <th>{{ '₹' . '' . $servicetotalAmount }}</th>
                                                <th colspan="5"></th>
                                            </tr>
                                        </tfoot>
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
        $(document).ready(function() {
            $('#dataTable-1').DataTable({
                autoWidth: true,
                "lengthMenu": [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ],
                "paging": true, // Enable pagination
                "searching": false // Disable search bar
            });
        });
        $(document).ready(function() {
            // Attach a click event handler to the button
            // $('#list').click(function() {
            //     // Assuming you have a function to retrieve the data, call it here
            //     // For demonstration purposes, let's assume you have an object containing the data
            //     var data = {
            //         name: "John Doe",
            //         age: 30
            //     };

            //     // Clear the previous data
            //     $('#dataContainer').empty();

            //     // Create and append list items for name and age
            //     var nameItem = $('<li>').text("Name: " + data.name);
            //     var ageItem = $('<li>').text("Age: " + data.age);
            //     $('#dataContainer').append(nameItem, ageItem);
            // });
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
        $(document).ready(function() {
            $('.js-switch').change(function() {
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
@endsection
@section('scripts')
@endsection

