@extends('layouts.master')
<style>
    label {
        font-weight: 800;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Payment History</h2>
                <p class="text-muted"></p>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">View Payment History</strong>
                            </div>

                            <div class="card-body">


                                <div class="form-row">

                                    <div class="col-md-6 mb-3">
                                        <label for="name"> Invoice Number</label>
                                        <p> {{ $paymentDetail?->invoice_no }} </p>
                                        @error('circlename')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="name"> Subscriber Id</label>
                                        <p> {{ $paymentDetail->subscriberId }} </p>
                                        @error('circlename')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="name"> Payment Id</label>
                                        <p>{{ $paymentDetail->payment_id }}</p>
                                        @error('regionname')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name"> Email</label>
                                        <p>{{ $paymentDetail?->subscriber?->email }}</p>

                                        @error('district')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="name"> Status</label>
                                        @if ($paymentDetail->status_code == 200)
                                            <p style="color: green;">Success</p>
                                        @else
                                            <p style="color: red;">Failure</p>
                                        @endif

                                        @error('pincode')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name"> Signature</label>
                                        <p>{{ $paymentDetail->signature }}</p>

                                        @error('tier')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="name"> Amount</label>
                                        <p>{{ $paymentDetail->amount / 100 }}</p>

                                        @error('statename')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="name"> Date</label>
                                        <p>{{ $paymentDetail->created_at }}</p>

                                        @error('tier')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>

                                </div>


                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->

                </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
@section('scripts')
@endsection

