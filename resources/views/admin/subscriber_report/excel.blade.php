<table>
    <caption>Subscriber - {{ $subscriber->name }}</caption>
    <div class="row">
        <div class="col-md-12">
            <h6 class="text-danger">Subscribers Pincodes</h6>
            <p class="text-muted">
                @foreach ($pincodes as $data)
                {{ $data->pincode }} &nbsp;
                @endforeach
            </p>
        </div>
    </div>
    <h6 class="text-danger">Rider Details with Booking Count and Total Cost</h6>
    <thead>
        <tr>
            <th>#</th>
            <th>Rider Name</th>
            <th>Rider ID</th>
            <th>Rider Status</th>
            <th>Mobile</th>
            <th>Pincode</th>
            <th>Booking Date</th>
            <th>Booking ID</th>
            <th>Category</th>
            <th>Booking Status</th>
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
        @php
        $subId = App\Models\Pincode::where('pincode',$booking->pincode)?->first()?->usedBy;
        $subscriber = App\Models\Subscriber::where('id',$subId)?->first();
        @endphp
        @if ($booking->accepted == $driver->userid)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $driver->name }}</td>
            <td>{{ App\Models\User::where('id',$driver->userid)->first()->user_id; }}</td>
            @php
            $status = [
            1 => ['label' => 'Active', 'color' => 'green'],
            0 => ['label' => 'Inactive', 'color' => 'red'],
            ];
            $statusValues = [
            0 => 'Pending',
            1 => 'In Progress',
            2 => 'Completed',
            3 => 'Cancelled',
            4 => 'On Ride',
            ];
            @endphp
            <td style="color: {{ $status[$driver->status]['color'] }}">
                {{ $status[$driver->status]['label'] }}
            </td>
            <td>{{ $driver->mobile }}</td>
            <td>{{ $booking->pincode }}</td>
            <td>
                @if ($booking->updated_at)
                <!-- Access first BookingPayment in the collection -->
                {{ $booking->updated_at->format('d-m-Y') }}
                @endif
            </td>
            <td>
                @if ($booking->bookingPayment->first())
                <!-- Access first BookingPayment in the collection -->
                {{ $booking->bookingPayment->first()->booking_id }}
                @endif
            </td>
            <td>{{ App\Models\Category::where('id',$booking->category)?->first()?->category; }}</td>
            <td>
                @if ($booking->status)
                // <!-- Access first BookingPayment in the collection -->
                {{ $statusValues[$booking->status] }}
                @endif
            </td>

            @if ($booking->bookingPayment->first())
            <!-- Access first BookingPayment in the collection -->
            @if($booking->bookingPayment->first()->coupon_id != null)
            <td>{{ '₹' . $booking->bookingPayment->first()->total - $booking->bookingPayment->first()->coupon_amount}}</td>
            @else
            <td>{{ '₹' . $booking->bookingPayment->first()->total}}</td>
            @endif
            @else
            <td>-</td>
            @endif

            <td>
                @if (isset($subscriber))
                <!-- Access first BookingPayment in the collection -->
                @if($booking->bookingPayment->first()->service_cost > 0)
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
        $totalAmount += optional($booking->bookingPayment->first())->coupon_id != null
        ? (optional($booking->bookingPayment->first())->total - optional($booking->bookingPayment->first())->coupon_amount ?? 0)
        : (optional($booking->bookingPayment->first())->total ?? 0);
        if($booking->bookingPayment->first()->service_cost > 0){
        $totalServiceAmount += $booking->bookingPayment->first()->service_cost;
        }else{
        if($booking->category == 1)
        { $totalServiceAmount += $subscriber->biketaxi_price; }
        elseif($booking->category == 2)
        { $totalServiceAmount += $subscriber->pickup_price; }
        else
        { $totalServiceAmount += $subscriber->buy_price; }
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
