@extends('layouts.submaster')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                {{-- <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('driverReport.index') }}"> Back</a>
        </div> --}}
                <h2 class="h3 mb-4 page-title">Subscriber - {{ $subscriber->name }}(<span
                        class="">{{ $subscriber->subscriberId }}</span>)</h2>
                <!-- ... existing code ... -->
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-primary">Subscribers Pincodes</h6>
                        <p class="text-muted">
                            @foreach ($pincodes as $data)
                                {{ $data->pincode }} &nbsp;
                            @endforeach
                        </p>
                    </div>
                </div>
                <h6 class="text-primary">Rider Details with Booking Count and Total Cost</h6>
                <br>
                <form method="GET" class="search-form form-inline"
                    action="{{ route('driverReport.show', $subscriber->id) }}">

                    <div class="form-group for pl-4">
                        <label class="mr-2">From Date:</label>
                        <input value="{{ request('from_date') }}" type="date" class="form-control" name="from_date"
                            autocomplete="off" placeholder="From Date" min="" />
                    </div>
                    <div class="form-group for pl-3">
                        <label class="mr-2">To Date:</label>
                        <input value="{{ request('to_date') }}" type="date" class="form-control" name="to_date"
                            autocomplete="off" placeholder="To Date" min="" />
                    </div>
                    <div class="form-group for pl-3">
                        <label class="mr-2">Search:</label>
                        <input value="{{ request('search') }}" type="text" class="form-control" name="search"
                            autocomplete="off" placeholder="Rider Id/Booking Id/pincode" min="" />
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
                                <option {{ request('status') == $status ? 'selected' : '' }} value="{{ $status }}">
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
                                <option {{ request('type') == $type ? 'selected' : '' }} value="{{ $type }}">
                                    {{ $paymenttypes[$type] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group pl-3" style="margin-top:30px;">
                        <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i
                                class="fa fa-search "></i></button>
                        <a class="btn btn-danger m-btn m-btn--air m-btn--custom"
                            href="{{ route('driverReport.show', $subscriber->id) }}"><i class="fa fa-times"></i></a>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card-body table-responsive">
                            <div class="pull-right">
                                <a class="btn btn-danger" target="blank"
                                    href="{{ route('driverPdfDownload', ['driver' => $subscriber->id, 'from_date' => request('from_date'), 'to_date' => request('to_date'), 'search' => request('search'), 'status' => request('status'), 'type' => request('type')]) }}">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <a class="btn btn-success"
                                    href="{{ route('driverExcelDownload', ['driver' => $subscriber->id, 'from_date' => request('from_date'), 'to_date' => request('to_date'), 'search' => request('search'), 'status' => request('status'), 'type' => request('type')]) }}">
                                    <i class="fas fa-file-excel"></i>
                                </a>
                            </div>
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rider Name</th>
                                        <th>Rider ID</th>
                                        <th>Rider Status</th>
                                        <th>Mobile</th>
                                        <th>Booking Date</th>
                                        <th>Status</th>
                                        <th>Pincode</th>
                                        <th>Category</th>
                                        <th>Booking ID</th>
                                        <th>Payment Type</th>
                                        <th>Total Cost</th>
                                        <th>Service Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalAmount = 0;
                                        $totalServiceAmount = 0;
                                    @endphp
                                    @foreach ($subscriber->driver as $driver)
                                        @foreach ($bookings as $booking)
                                            @if ($booking->accepted == $driver->userid)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $driver->name }}</td>
                                                    <td>{{ App\Models\User::where('id', $driver->userid)?->first()?->user_id }}
                                                    </td>
                                                    @php
                                                        $status = [
                                                            1 => ['label' => 'Active', 'color' => 'green'],
                                                            0 => ['label' => 'Inactive', 'color' => 'red'],
                                                        ];
                                                    @endphp
                                                    <td style="color: {{ $status[$driver->status]['color'] }}">
                                                        {{ $status[$driver->status]['label'] }}
                                                    </td>
                                                    <td>{{ $driver->mobile }}</td>
                                                    <td>
                                                        @if ($booking->updated_at)
                                                            <!-- Access first BookingPayment in the collection -->
                                                            {{ $booking->updated_at->format('d-m-Y') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($booking->status)
                                                            <!-- Access first BookingPayment in the collection -->
                                                            {{ $statusValues[$booking->status] }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $booking->pincode }}</td>
                                                    @if (isset($booking?->category))
                                                        <td>{{ App\Models\Category::where('id', $booking->category)?->first()?->category }}
                                                        </td>
                                                    @else
                                                        <td>Contact Admin</td>
                                                    @endif
                                                    <td>
                                                        @if ($booking->bookingPayment->first())
                                                            <!-- Access first BookingPayment in the collection -->
                                                            {{ $booking->bookingPayment->first()->booking_id }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($booking?->bookingPayment[0]?->type == 0)
                                                            <p>Wallet</p>
                                                        @elseif ($booking?->bookingPayment[0]?->type == 1)
                                                            <p>Cash</p>
                                                        @elseif($booking?->bookingPayment[0]?->type == 2)
                                                            <p>Online</p>
                                                        @else
                                                            <p>Not Yet</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($booking->bookingPayment->first())
                                                            <!-- Access first BookingPayment in the collection -->
                                                            @if ($booking->bookingPayment->first()->coupon_id != '')
                                                                {{ '₹' . $booking->bookingPayment->first()->total - $booking->bookingPayment->first()->coupon_amount }}<i
                                                                    class="fas fa-ticket-alt"
                                                                    style="color: green; font-size: 12px !important;"></i>
                                                            @else
                                                                {{ '₹' . $booking->bookingPayment->first()->total }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    @php
                                                        $subscriberId = App\Models\Pincode::where(
                                                            'pincode',
                                                            $booking->pincode,
                                                        )?->first()->usedBy;
                                                        $subscriber = App\Models\Subscriber::where(
                                                            'id',
                                                            $subscriberId,
                                                        )?->first();
                                                    @endphp
                                                    <td>
                                                        @if (isset($subscriber))
                                                            <!-- Access first BookingPayment in the collection -->
                                                            @if ($booking->bookingPayment->first()->service_cost > 0)
                                                                {{ '₹' . $booking->bookingPayment->first()->service_cost }}
                                                            @else
                                                                @if ($booking->category == 1)
                                                                    {{ '₹' . $subscriber->biketaxi_price }}
                                                                @elseif ($booking->category == 2)
                                                                    {{ '₹' . $subscriber->pickup_price }}
                                                                @else
                                                                    {{ '₹' . $subscriber->buy_price }}
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>

                                                </tr>
                                                @php
                                                    $subId = App\Models\Pincode::where(
                                                        'pincode',
                                                        $booking->pincode,
                                                    )?->first()->usedBy;
                                                    $subscriber = App\Models\Subscriber::where('id', $subId)?->first();
                                                    $totalAmount +=
                                                        $booking->bookingPayment->first()->total -
                                                        $booking->bookingPayment?->first()?->coupon_amount;
                                                    if ($booking->bookingPayment->first()->service_cost > 0) {
                                                        $totalServiceAmount += $booking->bookingPayment->first()
                                                            ->service_cost;
                                                    } else {
                                                        if ($booking->category == 1) {
                                                            $totalServiceAmount += $subscriber->biketaxi_price;
                                                        } elseif ($booking->category == 2) {
                                                            $totalServiceAmount += $subscriber->pickup_price;
                                                        } else {
                                                            $totalServiceAmount += $subscriber->buy_price;
                                                        }
                                                    }
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="11"><strong>Total Amount:</strong></td>
                                        <td>₹<strong>{{ $totalAmount }}</strong></td>
                                        <td>₹<strong>{{ $totalServiceAmount }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ... rest of your code ... -->
            </div> <!-- /.col-12 -->
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
        $(document).ready(function() {
            setInterval(() => {
                $total = 0;
                $('.amounts').each(function() {
                    $total = $total + parseInt($(this).val());
                })
                $('.showtotal').text($total);
            }, 500);
            $('.statuschangeselecttextarea').slideUp()
            $('.close1').click(function() {
                window.location.reload();
            });

            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');

                if (status == 0) {
                    $('#verticalModalone' + userId).modal('show');
                } else {
                    $('#verticalModaltwo' + userId).modal('show');
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

        // function showtextarea(value) {
        //     if (value == "Other") {
        //         $('.statuschangeselecttextarea').slideDown()
        //     } else {
        //         $('.statuschangeselecttextarea').slideUp()
        //     }
        // }
    </script>
@endsection

