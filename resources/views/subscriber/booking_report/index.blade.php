@extends('layouts.submaster')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Booking Report</h2>
                </div>
                <p class="card-text"></p>
                <div class="row">
                    <span id="message" class="alert alert-success alert-dismissible fade show col-md-12"
                        style="display: none;" role="alert"></span>
                </div>

                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="m-section__content">
                                    <form method="GET" class="search-form form-inline"
                                        action="{{ route('bookingReport.index') }}">
                                        <div class="form-group for pl-3">
                                            <label>From Date:</label>
                                            <input value="{{ request('from_date') }}" type="date" class="form-control"
                                                name="from_date" autocomplete="off" placeholder="From Date"
                                                min="" />
                                        </div>
                                        <div class="form-group for pl-3">
                                            <label>To Date:</label>
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
                                        <div class="form-group for pl-3" style="margin-top: 30px !important;">
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
                                        <div class="form-group pl-3" style="margin-top: 30px;">
                                            <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                            <a class="btn btn-danger m-btn m-btn--air m-btn--custom"
                                                href="{{ route('bookingReport.index') }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    </form>
                                    <div class="pull-right">
                                        <a class="btn btn-danger" target="_blank"
                                            href="{{ route('downloadsPDF', ['from_date' => request('from_date'), 'to_date' => request('to_date'), 'search' => request('search'), 'status' => request('status'), 'type' => request('type')]) }}">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <a class="btn btn-success"
                                            href="{{ route('downloadsExcel', ['from_date' => request('from_date'), 'to_date' => request('to_date'), 'search' => request('search'), 'status' => request('status'), 'type' => request('type')]) }}">
                                            <i class="fas fa-file-excel"></i>
                                        </a>
                                    </div>
                                </div>

                                <div id="dataContainer" class="table-responsive">
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Booking ID</th>
                                                <th>Category</th>
                                                <th>Cost</th>
                                                <th>Service Cost</th>
                                                <th>Customer Name</th>
                                                <th>Driver ID</th>
                                                <th>Pincode</th>
                                                <th>Distance</th>
                                                <th>Status</th>
                                                <th>Booking Type</th>
                                                <th>Date</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalAmount = 0;
                                                $totalServiceAmount = 0;
                                            @endphp
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $booking->booking_id }}</td>
                                                    <td>
                                                        {{ App\Models\Category::where('id', $booking->category)?->first()?->category }}
                                                    </td>
                                                    <td>
                                                        @if (isset($booking->bookingPayment[0]))
                                                            @if ($booking->bookingPayment[0]->coupon_id != '')
                                                                Rs.
                                                                {{ $booking->bookingPayment[0]->total - $booking->bookingPayment[0]->coupon_amount }}
                                                                <i class="fas fa-ticket-alt"
                                                                    style="color: green; font-size: 12px !important;"></i>
                                                            @else
                                                                Rs. {{ $booking->bookingPayment[0]->total }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $subId =
                                                                App\Models\Pincode::where(
                                                                    'pincode',
                                                                    $booking->pincode,
                                                                )->first()->usedBy ?? null;
                                                            $subscriber = App\Models\Subscriber::find($subId);
                                                        @endphp
                                                        @if (isset($booking->bookingPayment[0]))
                                                            @if ($booking->bookingPayment[0]->service_cost > 0)
                                                                Rs. {{ $booking->bookingPayment[0]->service_cost }}
                                                            @else
                                                                @if ($booking->category == 1)
                                                                    Rs. {{ $subscriber->biketaxi_price ?? '' }}
                                                                @elseif ($booking->category == 2)
                                                                    Rs. {{ $subscriber->pickup_price ?? '' }}
                                                                @else
                                                                    Rs. {{ $subscriber->buy_price ?? '' }}
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{ $booking->user->name }}</td>
                                                    <td>
                                                        @php
                                                            $driver = App\Models\Driver::where(
                                                                'userid',
                                                                $booking->accepted,
                                                            )->first();
                                                            //dd($driver);
                                                            $user = App\Models\User::where(
                                                                'id',
                                                                $driver?->userid,
                                                            )->first();
                                                            //dd($user);
                                                            $user_id = $user? $user->user_id : '';
                                                        @endphp
                                                        {{ $user_id }}</td>
                                                    <td>{{ $booking->pincode }}</td>
                                                    <td>{{ $booking->distance }}</td>
                                                    <td>{{ $statusValues[$booking->status] }}</td>
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
                                                    <td>{{ $booking->created_at ? \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('bookingReport.show', $booking->id) }}">
                                                            <span class="badge badge-danger">View</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $totalAmount += isset($booking->bookingPayment[0])
                                                        ? $booking->bookingPayment[0]->total - $booking->bookingPayment[0]?->coupon_amount
                                                        : 0;
                                                    if (isset($booking->bookingPayment[0])) {
                                                        $totalServiceAmount +=
                                                            $booking->bookingPayment[0]->service_cost > 0
                                                                ? $booking->bookingPayment[0]->service_cost
                                                                : ($booking->category == 1
                                                                    ? $subscriber->biketaxi_price ?? 0
                                                                    : ($booking->category == 2
                                                                        ? $subscriber->pickup_price ?? 0
                                                                        : $subscriber->buy_price ?? 0));
                                                    }
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total:</th>
                                                <th>{{ '₹' . $totalAmount }}</th>
                                                <th>{{ '₹' . $totalServiceAmount }}</th>
                                                <th colspan="6"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
                lengthMenu: [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ],
                paging: true,
                searching: false
            });
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

