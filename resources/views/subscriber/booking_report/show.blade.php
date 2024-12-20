@extends('layouts.submaster')

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
                            <a class="btn btn-primary" href="{{ route('bookingReport.index') }}"> Back</a>
                        </div>
                        <h2 class="text-center m-0">Booking Details</h2>
                        <p class="text-center mb-0"><span>Booking ID :</span> {{ $booking->booking_id }}</p>
                        @php
                            $user = session('subscribers');
                            // dd($user);
                        @endphp
                        @if (isset($user->subscriberId))
                            <p class="text-center mb-0"><span>Subscriber ID :</span> {{ $user->subscriberId }}</p>
                        @else

                            <p class="text-center mb-0"><span>Subscriber ID :</span>
                                {{ App\Models\Subscriber::where('id', $user->subscriber_id)->pluck('subscriberId')->first() }}</p>
                        @endif

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                            <h5>Category:</h5><strong>{{App\Models\Category::where('id',$booking->category)?->first()?->category;}}</strong>
                            <div class="row">
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
                                    {{ $driver ? $driver->user_id : 'N/A' }}
                                </div>                                
                                @php
                                 $rider=App\Models\Driver::where('userid',$driver?->id)?->first();
                               @endphp
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {{ $driver ? $rider->name : 'N/A' }}
                                </div>
                                
                                <div class="form-group">
                                    <strong>Mobile:</strong>
                                    {{ $driver ? $rider->mobile: 'N/A' }}
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
                                    {{ $booking->created_at ? \Carbon\Carbon::parse($booking?->created_at)?->format('d-m-Y h:i A') : '-' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>End Location</h3>
                                <div class="form-group">
                                    {{ $end_location?->address1 ?? $end_location?->address2 }}
                                </div>
                                <div class="form-group">
                                    <strong>End Time:</strong>
                                    {{ $booking->updated_at ? $booking->updated_at->format('d-m-Y h:i A') : '-' }}
                                </div>
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
                                    <strong>Total Price:</strong>
                                    @if ($payment?->coupon_id != null)
                                    {{ $payment ? $payment->total - $payment->coupon_amount : 'N/A' }}
                                    @else
                                    {{ $payment ? $payment->total : 'N/A' }}
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
