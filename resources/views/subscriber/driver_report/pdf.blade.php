<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        @page {
            size: A4;
            margin: 20mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        caption {
            font-size: 18px;
            margin-bottom: 10px;
        }

        /* Print styles */
        @media print {
            body {
                font-size: 10pt;
            }

            table {
                page-break-inside: auto;
            }

            th,
            td {
                page-break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }

            caption {
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <table class="table datatables" id="dataTable-1">
        <caption>Rider's Report</caption>
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
                <td>{{ App\Models\User::where('id', $driver->userid)->first()->user_id }}</td>
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
                    {{ $booking->updated_at->format('d-m-Y') }}
                    @endif
                </td>
                <td>
                    @if ($booking->status)
                    {{ $statusValues[$booking->status] }}
                    @endif
                </td>
                <td>{{ $booking->pincode }}</td>
                @if (isset($booking->category))
                <td>{{ App\Models\Category::where('id', $booking->category)->first()->category }}</td>
                @else
                <td>Contact Admin</td>
                @endif
                <td>
                    @if ($booking->bookingPayment->first())
                    {{ $booking->bookingPayment->first()->booking_id }}
                    @endif
                </td>
                
                    @if ($booking->bookingPayment->first())
                    @if ($booking->bookingPayment->first()->coupon_id != null)
                    <td> {{ '₹' . $booking->bookingPayment->first()->total - $booking->bookingPayment->first()->coupon_amount }} </td>
                    @else
                    <td> {{ '₹' . $booking->bookingPayment->first()->total }} </td>
                    @endif
                    @else
                    <td>-</td>
                    @endif
                
                @php
                $subscriberId = App\Models\Pincode::where('pincode', $booking->pincode)->first()->usedBy;
                $subscriber = App\Models\Subscriber::where('id', $subscriberId)->first();
                @endphp
                <td>
                    @if (isset($subscriber))
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
            $subId = App\Models\Pincode::where('pincode', $booking->pincode)->first()->usedBy;
            $subscriber = App\Models\Subscriber::where('id', $subId)->first();
            $totalAmount += optional($booking->bookingPayment->first())->coupon_id != null
            ? (optional($booking->bookingPayment->first())->total - optional($booking->bookingPayment->first())->coupon_amount ?? 0)
            : (optional($booking->bookingPayment->first())->total ?? 0);
            if ($booking->bookingPayment->first()->service_cost > 0) {
            $totalServiceAmount += $booking->bookingPayment->first()->service_cost;
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
                <td colspan="10"><strong>Total Amount:</strong></td>
                <td>₹<strong>{{ $totalAmount }}</strong></td>
                <td>₹<strong>{{ $totalServiceAmount }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
