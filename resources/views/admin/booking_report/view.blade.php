@extends('layouts.master')

@section('content')
    @php
        $statusValues = [
            0 => 'Pending',
            1 => 'In Progress',
            2 => 'Completed',
            3 => 'Cancelled',
            4 => 'On Ride',
        ];
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('bookingReport') }}"> Back</a>
                        </div>
                        <h2 class="text-center m-0">Booking Details</h2>
                        <p class="text-center mb-0"><span>Booking ID :</span> {{ $booking->booking_id }}</p>

                        <p class="text-center mb-0"><span>Subscriber ID :</span> {{ $subscriber?->subscriberId }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<h5>Category:</h5>
                                    <strong>{{ App\Models\Category::where('id', $booking->category)?->first()?->category }}</strong>
                                </div>
                                <h3>Customer Details</h3>
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {{ $customer->name ?? 'N/A' }}
                                </div>
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {{ $customer->email }}
                                </div>
                                <div class="form-group">
                                    <strong>Mobile:</strong>
                                    {{ $customer->phone }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Rider Details</h3>
                                <div class="form-group">
                                    <strong>Id:</strong>
                                    {{ $booking?->driverasuser?->user_id }}
                                </div>
                                @php
                                    $rider = App\Models\Driver::where('userid', $driver?->id)?->first();
                                @endphp

                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {{ $driver ? $driver->name : 'N/A' }}
                                </div>
                                <div class="form-group">
                                    <strong>Mobile:</strong>
                                    {{ $rider?->mobile }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Start Location</h3>
                                <div class="form-group">
                                    {{ $start_location?->address1 ?? $start_location?->address2 }}
                                </div>
                                <div class="form-group">
                                    <strong>Start Time:</strong>
                                    {{ $booking->created_at ? \Carbon\Carbon::parse($booking->created_at)?->format('d-m-Y h:i A') : '-' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>End Location</h3>
                                <div class="form-group">
                                    {{ $end_location?->address1 ?? $end_location?->address2 }}
                                </div>

                                @if (isset($booking) && in_array($booking->status, [0, 1, 4]))
                                    <!-- Do not display end date for pending, inprogress, or on-ride statuses -->
                                @elseif (isset($booking) && in_array($booking->status, [2, 3]))
                                    <!-- Display end date for completed or cancelled statuses -->
                                    <div class="form-group">
                                        <strong>End Time:</strong>
                                        {{ $booking->updated_at ? \Carbon\Carbon::parse($booking->updated_at)?->format('d-m-Y h:i A') : '-' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Booking Status</h3>
                                <div class="form-group">
                                    {{ isset($booking) ? $statusValues[$booking->status] : 'N/A' }}
                                </div>
                                <h3>Booking Rating</h3>
                                <div class="form-group">
                                    {{ $booking?->bookingRating?->rating ? $booking?->bookingRating?->rating : 'Not Rated' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Payment Details</h3>
                                <div class="form-group">
                                    <strong>TotalPrice:</strong>
                                    @if ($payment->coupon_id != null)
                                        {{ $payment ? $payment->total - $payment->coupon_amount : 'N/A' }}
                                    @else
                                        {{ $payment ? $payment->total : 'N/A' }}
                                    @endif
                                </div>
                                <!--<div class="form-group">
                                                <strong>Tax:</strong>
                                                {{ $payment ? $payment->tax : 'N/A' }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Total:</strong>
                                                {{ $payment ? $payment->total : 'N/A' }}
                                            </div>-->
                            </div>


                            <div class="col-md-6">
                                <h3>Payment Type</h3>
                                <div class="form-group">

                                    @if ($booking && isset($booking->bookingPayment[0]))
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
                                        <p>No payment information available</p>
                                    @endif

                                </div>

                            </div>
                            <div class="col-md-6">
                                <h3>Booking Review</h3>
                                <div class="form-group">
                                    {{-- <strong>Base Price:</strong> --}}
                                    {{ $booking?->bookingRating?->remarks ? $booking?->bookingRating?->remarks : 'No Review Found' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Distance</h3>
                                <div class="form-group">
                                    {{-- <strong>Base Price:</strong> --}}
                                    {{ $booking->distance }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

