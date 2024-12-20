@extends('layouts.submaster')
@section('content')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <style>
        .error {
            color: red;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Coupons</h2>
                <p class="text-muted"></p>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Generate Coupon</strong>
                            </div>

                            <div class="card-body">
                                <form id="couponForm" method="post" action="{{ route('subscribers.coupon.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-8 mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror "
                                                id="title" name="title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter title</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                accept="image/*" name="image">
                                            @error('image')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter title</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="code">Code</label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                id="code" value="{{ old('code') }}" name="code">
                                            @error('code')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter code</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="type">Type</label>
                                            <select class="form-control @error('type') is-invalid @enderror" id="type"
                                                name="type" required>
                                                <option value="">Select Type</option>
                                                {{-- <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Admin
                                                </option> --}}
                                                <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Pincode
                                                </option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="invalid-feedback"> Please select a valid type</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="pincode_id">Pincode</label>
                                            <select class="form-control @error('pincode_id') is-invalid @enderror" disabled
                                                id="pincode_id" name="pincode_id">
                                                <option value="">Select pincode</option>
                                                @foreach ($pincodes as $pincode)
                                                    <option value="{{ $pincode->id }}"
                                                        {{ old('pincode_id') == $pincode->id ? 'selected' : '' }}>
                                                        {{ $pincode->pincode }} {{-- Replace with the actual subscriber name field --}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pincode_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="invalid-feedback"> Please select a valid subscriber. </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="code">Limit To Use</label>
                                            <input type="text" class="form-control @error('limit') is-invalid @enderror"
                                                min=1
                                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                id="limit" value="{{ old('limit') }}" name="limit">
                                            @error('limit')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter limit</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="code">Start date</label>
                                            <input type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                min="{{ now()->format('Y-m-d') }}" value="{{ old('start_date') }}"
                                                name="start_date">
                                            @error('start_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter limit</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="code">End date</label>
                                            <input type="date"
                                                class="form-control @error('expiry_date') is-invalid @enderror"
                                                min="{{ now()->format('Y-m-d') }}" value="{{ old('expiry_date') }}"
                                                name="expiry_date">
                                            @error('expiry_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please select end date</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="discount_type">Discount type</label>
                                            <select class="form-control @error('discount_type') is-invalid @enderror"
                                                id="discount_type" name="discount_type" required>
                                                <option value="2" {{ old('discount_type') == '2' ? 'selected' : '' }}>
                                                    Percentage</option>
                                                <option value="1" {{ old('discount_type') == '1' ? 'selected' : '' }}>
                                                    Fixed</option>
                                            </select>
                                            @error('discount_type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="invalid-feedback"> Please select a valid type</div>
                                        </div>

                                        <div class="col-md-4 mb-3" style="display: none;" id="diaplay_amount">
                                            <label for="amount">Amount <span class="text-primary">₹</span></label>
                                            <input type="text"
                                                class="form-control @error('amount') is-invalid @enderror" min=1
                                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                id="amount" value="{{ old('amount') }}" name="amount">
                                            @error('amount')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter amount</div>
                                        </div>

                                        <div class="col-md-4 mb-3" id="diaplay_percentage">
                                            <label for="percentage">Percentage <span class="text-success">%</span></label>
                                            <input type="text"
                                                class="form-control @error('percentage') is-invalid @enderror" min=1
                                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                id="percentage" value="{{ old('percentage') }}" name="percentage">
                                            @error('percentage')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter percentage</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label>Multiple time?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    class="form-check-input @error('is_multiple') is-invalid @enderror"
                                                    type="radio" name="is_multiple" id="is_multiple_yes"
                                                    value="1" {{ old('is_multiple') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_multiple_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    class="form-check-input @error('is_multiple') is-invalid @enderror"
                                                    type="radio" name="is_multiple" id="is_multiple_no"
                                                    value="0" {{ old('is_multiple') == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_multiple_no">No</label>
                                            </div>
                                            @error('is_multiple')
                                                <div class="invalid-feedback" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <center>
                                        <button class="btn btn-primary" type="submit">create</button>
                                    </center>
                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->

                </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#couponForm').validate({
                rules: {
                    title: "required",
                    code: "required",
                    type: "required",
                    pincode_id: {
                        required: function(element) {
                            return $('#type').val() === '2'; // Check if type is 2
                        }
                    },
                    limit: "required",
                    start_date: "required",
                    expiry_date: "required",
                    discount_type: "required",
                    amount: {
                        required: function(element) {
                            return $('#discount_type').val() === '1'; // Required if discount_type is 1
                        }
                    },
                    percentage: {
                        required: function(element) {
                            return $('#discount_type').val() === '2'; // Required if discount_type is 2
                        }
                    },
                    is_multiple: "required",
                },
                messages: {
                    title: "Title is required",
                    code: "Code is required",
                    type: "Type is required",
                    pincode_id: "Select a valid pincode",
                    limit: "Limit is required",
                    start_date: "Start date is required",
                    expiry_date: "End date is required",
                    discount_type: "Discount Type is required",
                    amount: "Amount is required",
                    percentage: "Percentage is required",
                    is_multiple: "Usage type is required",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $('#type').on('change', function() {
                var type = $(this).val();
                console.log(type);
                if (type === '2') {
                    $('#pincode_id').prop('disabled', false);
                } else {
                    $('#pincode_id').prop('disabled', true);
                }
            });

            $('#discount_type').on('change', function() {
                var discount_type = $(this).val();
                console.log(discount_type);
                if (discount_type === '2') {
                    $('#diaplay_amount').css('display', 'none');
                    $('#diaplay_percentage').css('display', 'block');
                } else {
                    $('#diaplay_amount').css('display', 'block');
                    $('#diaplay_percentage').css('display', 'none');
                }
            });
        });
    </script>
@endsection