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
            max-width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            word-break: break-all;
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
            font-size: 24px;
            margin-bottom: 20px;
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
    <table>
        <caption>Booking Report</caption>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Category</th>
                <th>Booking ID</th>
                <th>Cost</th>
                <th>Service Cost</th>
                <th>Customer Name</th>
                <th>Rider ID</th>
                <th>Pincode</th>
                <th>Distance</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalAmount = 0;
            $servicetotalAmount = 0;
            @endphp

            @foreach ($bookings as $booking)
            @php
            $subId = optional(App\Models\Pincode::where('pincode', $booking->pincode)->first())->usedBy;
            $subscriber = optional(App\Models\Subscriber::find($subId));
            @endphp

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ optional(App\Models\Category::find($booking->category))->category }}</td>
                <td>{{ $booking->booking_id }}</td>
                @if( $booking->bookingPayment->first()?->coupon_id !== null)
                <td>{{ 'Rs' . ' ' . optional($booking->bookingPayment->first())->total - optional($booking->bookingPayment->first())->coupon_amount }}</td>
                @else
                <td>{{ 'Rs' . ' ' . optional($booking->bookingPayment->first())->total }}</td>
                @endif
                @if (isset($booking->bookingPayment[0]) && $booking->bookingPayment[0]->service_cost > 0)
                <td>{{ '₹' . $booking->bookingPayment[0]->service_cost }}</td>
                @else
                @php
                $price = 0;
                if (isset($subscriber)) {
                if ($booking->category == 1) {
                $price = $subscriber->biketaxi_price ?? 0;
                } elseif ($booking->category == 2) {
                $price = $subscriber->pickup_price ?? 0;
                } else {
                $price = $subscriber->buy_price ?? 0;
                }
                }
                @endphp
                <td>{{ '₹' . $price }}</td>
                @endif

                <td>{{ $booking->user->name }}</td>
                <td>{{ optional(App\Models\User::find($booking->accepted))->user_id }}</td>
                <td>{{ $booking->pincode }}</td>
                <td>{{ $booking->distance }}</td>

                @php
                $statusValues = [
                0 => 'Pending',
                1 => 'In Progress',
                2 => 'Completed',
                3 => 'Cancelled',
                4 => 'On Ride',
                ];
                @endphp

                <td>{{ isset($booking) ? $statusValues[$booking->status] : 'N/A' }}</td>
                <td>{{ isset($booking) ? \Carbon\Carbon::parse($booking->created_at)?->format('d-m-Y') : 'N/A' }}</td>
            </tr>

            @php
            if (isset($booking->bookingPayment[0])) {
            // Check if service cost is greater than 0
            if ($booking->bookingPayment[0]->service_cost > 0) {
            $servicetotalAmount += $booking->bookingPayment[0]->service_cost;
            } else {
            // Handle subscriber prices based on category
            if (isset($subscriber)) {
            if ($booking->category == 1) {
            $servicetotalAmount += $subscriber->biketaxi_price ?? 0;
            } elseif ($booking->category == 2) {
            $servicetotalAmount += $subscriber->pickup_price ?? 0;
            } else {
            $servicetotalAmount += $subscriber->buy_price ?? 0;
            }
            }
            }
            }
            // Access total amount with optional() helper to avoid null exceptions
            $totalAmount += optional($booking->bookingPayment->first())?->coupon_id !== null
            ? (optional($booking->bookingPayment->first())->total - optional($booking->bookingPayment->first())->coupon_amount ?? 0)
            : (optional($booking->bookingPayment->first())->total ?? 0);
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total:</th>
                <th>{{ 'Rs' . ' ' . $totalAmount }}</th>
                <th>{{ 'Rs' . ' ' . $servicetotalAmount }}</th>
                <th colspan="6"></th>
            </tr>
        </tfoot>
    </table>
</body>

</html>

