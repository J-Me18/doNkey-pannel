<table>
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
        $subscriber = optional(App\Models\Subscriber::where('id',$subId)->first());
        @endphp

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ optional(App\Models\Category::find($booking->category))->category }}</td>
            <td>{{ $booking->booking_id }}</td>
            @if($booking?->bookingPayment?->first()?->coupon_id != null)
            <td>{{ 'Rs ' . optional($booking->bookingPayment->first())->total - optional($booking->bookingPayment->first())->coupon_amount }}</td>
            @else
            <td>{{ 'Rs ' . optional($booking->bookingPayment->first())->total }}</td>
            @endif
            @if ($booking && isset($booking->bookingPayment) && count($booking->bookingPayment) > 0)
            @if ($booking->bookingPayment[0]->service_cost > 0)
            <td>{{ '₹' . $booking->bookingPayment[0]->service_cost }}</td>
            @else
            @if (isset($subscriber))
            @if ($booking->category == 1)
            <td>{{ '₹' . $subscriber->biketaxi_price }}</td>
            @elseif ($booking->category == 2)
            <td>{{ '₹' . $subscriber->pickup_price }}</td>
            @else
            <td>{{ '₹' . $subscriber->buy_price }}</td>
            @endif
            @else
            <td>{{ '₹' . '0' }}</td>
            @endif
            @endif
            @else
            <td>{{ '₹' . '0' }}</td>
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
            <td>{{ isset($booking) ? \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') : 'N/A' }}</td>
        </tr>

        @php
        if ($booking->bookingPayment->isNotEmpty() && isset($booking->bookingPayment[0])) {
        if ($booking->bookingPayment[0]->service_cost > 0) {
        $servicetotalAmount += $booking->bookingPayment[0]->service_cost;
        } else {
        if ($booking->category == 1) {
        $servicetotalAmount += $subscriber->biketaxi_price ?? 0;
        } elseif ($booking->category == 2) {
        $servicetotalAmount += $subscriber->pickup_price ?? 0;
        } else {
        $servicetotalAmount += $subscriber->buy_price ?? 0;
        }
        }
        }

        $totalAmount += optional($booking->bookingPayment->first())->coupon_id != null
        ? (optional($booking->bookingPayment->first())->total - optional($booking->bookingPayment->first())->coupon_amount ?? 0)
        : (optional($booking->bookingPayment->first())->total ?? 0);
        @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total:</th>
            <th>{{ 'Rs ' . $totalAmount }}</th>
            <th>{{ 'Rs ' . $servicetotalAmount }}</th>
            <th colspan="6"></th>
        </tr>
    </tfoot>
</table>
