@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Rider</h2>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Add Rider</strong>
                        </div>
                        <div class="card-body">

                            <form class="needs-validation" method="post" action="{{url('driverstore')}}" enctype="multipart/form-data" novalidate>
                                {{csrf_field()}}
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="subscriber">Subscriber</label>
                                        <select name="subscriber" class="form-control select2 @error('subscriber') is-invalid @enderror" id="subscriber" search="true" value="">
                                            <option value="">Select Subscriber</option>
                                            @foreach ($subscriber as $subscriber)
                                            <option value="{{$subscriber->id}}" {{ (is_array(old('subscriber')) and in_array($subscriber->id, old('subscriber'))) ? ' selected' : '' }}>
                                                {{$subscriber->subscriberId}}
                                            </option>
                                            @endforeach


                                        </select>
                                        @error('subscriber')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please select a valid subscriber. </div>
                                    </div>

                                   <div class="col-md-6 mb-3">
    <label for="profile">Profile</label>
    <input type="file" class="form-control @error('profile') is-invalid @enderror" id="profile" name="profile" accept="image/*">
    @error('profile')
    <span class="invalid-feedback">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <div class="invalid-feedback">Please upload an image file for the profile.</div>
</div>



                                    <div class="col-md-6 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter name </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" value="{{ old('location') }}" name="location" required>
                                        @error('location')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter location </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please use a valid email </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" value="{{ old('mobile') }}" onkeypress="return isNumberKey(event)" name="mobile" required>
                                        @error('mobile')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter mobile number </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password" value="{{ old('password') }}" required
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);">
                                        @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter password </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pincode">Pincode</label>
                                        <select name="pincode[]" class="form-control @error('pincode') is-invalid @enderror" id="pincode" multiple multiselect-search="true" value="" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)">
                                            @foreach ($pincode as $pincode)
                                            <option value="{{$pincode->id}}" {{ (is_array(old('pincode')) and in_array($pincode->id, old('pincode'))) ? ' selected' : '' }}>
                                                {{$pincode->pincode}}
                                            </option>
                                            @endforeach


                                        </select>
                                        @error('pincode')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please select a valid pincode. </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="language">Language</label>
                                        <select name="language[]"
                                            class="form-control @error('language') is-invalid @enderror"
                                            id="language" multiple multiselect-search="true" value=""
                                            multiselect-select-all="true" multiselect-max-items="3"
                                            onchange="console.log(this.selectedOptions)">
                                            {{-- <option value="">Select Language</option> --}}
                                            @foreach ($languages as $language)
                                                <option value="{{ $language }}"
                                                    {{ (is_array(old('language')) and in_array($language, old('language'))) ? ' selected' : '' }}>
                                                    {{ $language }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('language')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please select a valid Language. </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="aadharNo">Aadhar Number</label>
                                        <input type="text" class="form-control @error('aadharNo') is-invalid @enderror" id="aadharNo" value="{{ old('aadharNo') }}" onkeypress="return isNumberKey(event)" name="aadharNo" required>
                                        @error('aadharNo')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter aadhar number </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="description">Address</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter description </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" value="{{ old('dob') }}" name="dob" required>
                                        @error('dob')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter dob </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gender">gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender" value="">
                                            <option value="">Select </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>

                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please select a valid gender. </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bankacno">Bank Account Number</label>
                                        <input type="text" class="form-control @error('bankacno') is-invalid @enderror" id="bankacno" value="{{ old('bankacno') }}" name="bankacno" required>
                                        @error('bankacno')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter bank account number </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ifsccode">IFSC Code</label>
                                        <input type="text" class="form-control @error('ifsccode') is-invalid @enderror" id="ifsccode" value="{{ old('ifsccode') }}" name="ifsccode" required>
                                        @error('ifsccode')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter bank's ifsc code </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="aadharFrontImage">Aadhar Image</label>
                                        <input type="file" class="form-control @error('aadharFrontImage') is-invalid @enderror" id="aadharFrontImage" value="{{ old('aadharFrontImage') }}" accept=".pdf" name="aadharFrontImage" required>
                                        <small id="aadharFrontImage" class="form-text text-muted">Note:Please Upload PDF
                                            Format </span></small>
                                        @error('aadharImage')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please upload aadhar front image </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="aadharBackImage">Aadhar Back Image</label>
                                        <input type="file" class="form-control @error('aadharBackImage') is-invalid @enderror" id="aadharBackImage" value="{{ old('aadharBackImage') }}" accept=".pdf" name="aadharBackImage" required>
                                        <small id="aadharBackImage" class="form-text text-muted">Note:Please Upload PDF
                                            Format </span></small>
                                        @error('aadharBackImage')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please upload aadhar back image </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="drivingLicence">Driving Licence</label>
                                        <input type="file" class="form-control @error('drivingLicence') is-invalid @enderror" id="drivingLicence" value="{{ old('drivingLicence') }}" accept=".pdf" name="drivingLicence" required>
                                        <small id="drivingLicence" class="form-text text-muted">Note:Please Upload PDF
                                            Format </span></small>
                                        @error('drivingLicence')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please upload driving licence image </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="customerdocument">Document</label>
                                        <input type="file" class="form-control @error('customerdocument') is-invalid @enderror" id="customerdocument" value="{{ old('customerdocument') }}" accept=".pdf" name="customerdocument">
                                        <small id="customerdocument" class="form-text text-muted">Note:Please upload pdf
                                            format </span></small>
                                        @error('customerdocument')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror<div class="invalid-feedback"> Please upload bike image </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="licenceexpiry">Licence Expiry Date</label>
                                        <input type="date" class="form-control @error('licenceexpiry') is-invalid @enderror " id="licenceexpiry" name="licenceexpiry" value="{{ old('licenceexpiry') }}" required>
                                        @error('licenceexpiry')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter Licence Expiry Date</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="vehicleNo">Vehicle No</label>
                                        <input type="text" class="form-control @error('vehicleNo') is-invalid @enderror " id="vehicleNo" name="vehicleNo" value="{{ old('vehicleNo') }}" required>
                                        @error('vehicleNo')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please Enter Vehicle No</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="vehicleModelNo">Vehicle Model Name</label>
                                        <input type="text" class="form-control @error('vehicleModelNo') is-invalid @enderror " id="vehicleModelNo" name="vehicleModelNo" value="{{ old('vehicleModelNo') }}" required>
                                        @error('vehicleModelNo')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter vehicle model number</div>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="rcbook">Rcbook Image</label>
                                        <input type="file" class="form-control @error('rcbook') is-invalid @enderror" id="rcbook" value="{{ old('rcbook') }}" accept=".pdf" name="rcbook" required>
                                        <small id="rcbook" class="form-text text-muted">Note:Please Upload PDF Format
                                            </span></small>
                                        @error('rcbook')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please upload rcbook image </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="insurance">Insurance</label>
                                        <input type="file" class="form-control @error('insurance') is-invalid @enderror" id="insurance" value="{{ old('bankstatement') }}" accept=".pdf" name="insurance" required>
                                        <small id="insurance" class="form-text text-muted">Note:Please Upload PDF
                                            Format</span></small>
                                        @error('insurance')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please upload insurance </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bike">Bike Image</label>
                                        <input type="file" class="form-control @error('bike') is-invalid @enderror" id="bike" value="{{ old('bike') }}" accept=".pdf" name="bike" required>
                                        <small id="bike" class="form-text text-muted">Note:Please Upload PDF Format
                                            </span></small>
                                        @error('bike')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror<div class="invalid-feedback"> Please upload bike image </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <fieldset class="">
        <label class="col-form-label">Driver Type</label>
        <div class="form-check">
            <input class="form-check-input @error('type') is-invalid @enderror" type="radio" id="bike" name="type" value="1" {{ old('type') == '1' ? 'checked' : '' }} required>
            <label class="form-check-label" for="bike">
                Bike
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input @error('type') is-invalid @enderror" type="radio" id="auto" name="type" value="2" {{ old('type') == '2' ? 'checked' : '' }}>
            <label class="form-check-label" for="auto">
                Auto
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input @error('type') is-invalid @enderror" type="radio" id="cab" name="type" value="3" {{ old('type') == '3' ? 'checked' : '' }}>
            <label class="form-check-label" for="cab">
                Cab
            </label>
        </div>
        @error('type')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </fieldset>
                                    </div>



                                </div>




                                <button class="btn btn-primary" type="submit">Submit form</button>
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

@endsection
