@extends('layouts.master')
@section('content')
    <style>
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            /* for circular image */
            /* or */
            /* border-radius: 10px; */
            /* for square image with rounded corners */
        }

        .profile-image-wrapper {
            overflow: hidden;
        }
        
        </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('drivers') }}"> Back</a>
                </div>
                <h2 class="page-title">Rider</h2>
                <p class="text-muted"></p>
                <div class="row">

                    <div class="col-md-9">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Edit Rider - {{ $driver->name }} ({{ $driver->id }})</strong>
                            </div>
                            <div class="card-body">

                                <form class="needs-validation" method="post"
                                    action="{{ url('driverupdate/' . $driver->id) }}" enctype="multipart/form-data"
                                    novalidate>
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <div class="form-row">
                                        <div class="col-md-8 mb-3">
                                            <label for="profile">Upload New Profile Image</label>
                                            <input type="file"
                                                class="form-control @error('profile') is-invalid @enderror" id="profile"
                                                name="profile">
                                            @error('profile')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">Please upload a profile image.</div>
                                        </div>
                                        @if (isset($user[0]->image))
                                            <div class="col-md-4 mb-3">
                                                <label for="profile">Existing Image</label>
                                                <div class="profile-image-wrapper">
                                                    <img src="{{ asset('subscriber/driver/profile/' . $user[0]->image) }}"
                                                        alt="profile" class="profile-image">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror "
                                                id="name" name="name" value="{{ old('name', $driver->name) }}"
                                                required>
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter name </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="location">Location</label>
                                            <input type="text"
                                                class="form-control @error('location') is-invalid @enderror" id="location"
                                                value="{{ $driver->location, old('location') }}" name="location" required>
                                            @error('location')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter location </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror " id="password"
                                                name="password" value="{{ old('password') }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);">
                                            @error('password')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter name </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ $driver->email, old('email') }}"
                                                required>
                                            @error('email')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please use a valid email </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="dob">Date Of Birth</label>

                                            @php
                                                $dob = isset($user[0]->dob)
                                                    ? Carbon\Carbon::parse($user[0]->dob)->format('Y-m-d')
                                                    : '';
                                            @endphp
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                                id="dob" value="{{ old('dob', $dob) }}" name="dob" required>
                                            @error('dob')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter dob </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="gender">gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror" id="gender">
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
                                        <script>
                                            $('#gender option[value="{{ $user[0]->gender }}"]').attr('selected', true);
                                        </script>
                                        <div class="col-md-6 mb-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                                id="mobile" value="{{ $driver->mobile, old('mobile') }}"
                                                onkeypress="return isNumberKey(event)" name="mobile" required>
                                            @error('mobile')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter mobile number </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pincode">Pincode</label>
                                            @php
                                                $driverpincode = json_decode($driver->pincode);

                                            @endphp
                                            <select name="pincode[]"
                                                class="form-control @error('pincode') is-invalid @enderror" id="pincode"
                                                multiple multiselect-search="true" value=""
                                                multiselect-select-all="true" multiselect-max-items="3"
                                                onchange="console.log(this.selectedOptions)">
                                                @foreach ($pincode as $pincode)
                                                    <option value="{{ $pincode->id }}"
                                                        {{ (is_array($driverpincode) and in_array($pincode->id, $driverpincode)) ? ' selected' : '', (is_array(old('pincode')) and in_array($pincode->id, old('pincode'))) ? ' selected' : '' }}>
                                                        {{ $pincode->pincode }}
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
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language }}"
                                                        {{ (is_array(old('language')) and in_array($language, old('language'))) || (is_array($languageArray) and in_array($language, $languageArray)) ? ' selected' : '' }}>
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
                                            <input type="text"
                                                class="form-control @error('aadharNo') is-invalid @enderror"
                                                id="aadharNo" value="{{ $driver->aadharNo, old('aadharNo') }}"
                                                onkeypress="return isNumberKey(event)" name="aadharNo" required>
                                            @error('aadharNo')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter aadhar number </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="description">Address</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                required>{{ $driver->description, old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter description </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="bankacno">Bank Account Number</label>
                                            <input type="text"
                                                class="form-control @error('bankacno') is-invalid @enderror"
                                                id="aadharNo" value="{{ $driver->bankacno, old('bankacno') }}"
                                                name="bankacno" required>
                                            @error('bankacno')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter bank account number</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ifsccode">IFSC Code</label>
                                            <input type="text"
                                                class="form-control @error('ifsccode') is-invalid @enderror"
                                                id="ifsccode" value="{{ $driver->ifsccode, old('ifsccode') }}"
                                                name="ifsccode" required>
                                            @error('ifsccode')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter ifsc code </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="aadharFrontImage">Aadhar Front Image</label>
                                            <input type="file"
                                                class="form-control @error('aadharFrontImage') is-invalid @enderror"
                                                id="aadharFrontImage" value="{{ old('aadharFrontImage') }}"
                                                name="aadharFrontImage" accept=".pdf">
                                            @error('aadharFrontImage')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mobile">Aadhar Back Image</label>
                                            <input type="file"
                                                class="form-control @error('aadharBackImage') is-invalid @enderror"
                                                id="aadharBackImage" value="{{ old('aadharBackImage') }}"
                                                name="aadharBackImage" accept=".pdf">
                                            @error('aadharBackImage')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="rcbook">Rcbook Image</label>
                                            <input type="file"
                                                class="form-control @error('rcbook') is-invalid @enderror" id="rcbook"
                                                value="{{ old('rcbook') }}" name="rcbook" accept=".pdf">
                                            @error('rcbook')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="insurance">Insurance</label>
                                            <input type="file"
                                                class="form-control @error('insurance') is-invalid @enderror"
                                                id="insurance" value="{{ old('insurance') }}" name="insurance"
                                                accept=".pdf">

                                            @error('insurance')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="drivingLicence">DrivingLicence</label>
                                            <input type="file"
                                                class="form-control @error('drivingLicence') is-invalid @enderror"
                                                id="drivingLicence" value="{{ old('drivingLicence') }}" accept=".pdf"
                                                name="insurance">

                                            @error('drivingLicence')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="bike">Bike</label>
                                            <input type="file"
                                                class="form-control @error('bike') is-invalid @enderror" id="bike"
                                                value="{{ old('bike') }}" accept=".pdf" name="bike">

                                            @error('bike')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="vehicleNo">Vehicle No</label>
                                            <input type="text"
                                                class="form-control @error('vehicleNo') is-invalid @enderror "
                                                id="vehicleNo" name="vehicleNo"
                                                value="{{ $driver->vehicleNo, old('vehicleNo') }}" required>
                                            @error('vehicleNo')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please Enter Vehicle No</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="vehicleModelNo">Vehicle Model Name</label>
                                            <input type="text"
                                                class="form-control @error('vehicleModelNo') is-invalid @enderror "
                                                id="vehicleModelNo" name="vehicleModelNo"
                                                value="{{ $driver->vehicleModelNo, old('vehicleModelNo') }}" required>
                                            @error('vehicleModelNo')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter vehicle model number</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="licenceexpiry">Licence Expiry Date</label>
                                            <input type="date"
                                                class="form-control @error('licenceexpiry') is-invalid @enderror "
                                                id="licenceexpiry" name="licenceexpiry"
                                                value="{{ $driver->licenceexpiry, old('licenceexpiry') }}" required>
                                            @error('licenceexpiry')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Licence Expiry Date</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="customerdocument">Document</label>
                                            <input type="file"
                                                class="form-control @error('customerdocument') is-invalid @enderror"
                                                id="customerdocument" value="{{ old('customerdocument') }}"
                                                accept=".pdf" name="customerdocument">
                                            <small id="customerdocument" class="form-text text-muted">Note:Please upload
                                                pdf
                                                format </span></small>
                                            @error('customerdocument')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please upload bike image </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
    <fieldset>
        <legend class="col-form-label">Driver Type</legend>
        <div class="form-check">
            <input class="form-check-input @error('type') is-invalid @enderror"
                type="radio" id="bike" name="type" value="1"
                {{ old('type', $driver->type) == '1' ? 'checked' : '' }} required>
            <label class="form-check-label" for="bike">
                Bike
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input @error('type') is-invalid @enderror"
                type="radio" id="auto" name="type" value="2"
                {{ old('type', $driver->type) == '2' ? 'checked' : '' }}>
            <label class="form-check-label" for="auto">
                Auto
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input @error('type') is-invalid @enderror"
                type="radio" id="cab" name="type" value="3"
                {{ old('type', $driver->type) == '3' ? 'checked' : '' }}>
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
                                        <div class="col-md-12 mb-3">
                                            <label for="comments">Comments</label>
                                            <textarea class="form-control @error('comments') is-invalid @enderror" id="comments" name="comments" required>{{ $driver->comments, old('comments') }}</textarea>
                                            @error('comments')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter the changes you have made </div>
                                        </div>


                                    </div>




                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->
                    <div class="col-md-3">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Proof's Uploaded</strong>
                            </div>
                            <div class="card-body">
                                <strong class="card-title">Aadhar Front</strong>
                                <div class="row ">

                                    <embed src="{{ asset('subscriber/driver/aadhar/' . $driver->aadharFrontImage) }}"
                                        type="" width="150px;" height="93px;" alt="{{ $driver->name }}"
                                        class="avatar-img ">
                                    <!-- <img src="{{ asset('subscriber/driver/aadhar/' . $driver->aadharFrontImage) }}"
                                                            width="150px;" height="93px;" alt="{{ $driver->name }}" class="avatar-img "> -->

                                </div>
                                <strong class="card-title">Aadhar Back</strong>
                                <div class="row">

                                    <embed src="{{ asset('subscriber/driver/aadhar/back/' . $driver->aadharBackImage) }}"
                                        width="150px;" height="93px;" alt="{{ $driver->name }}" class="avatar-img ">
                                    <!-- <img src="{{ asset('subscriber/driver/aadhar/back/' . $driver->aadharBackImage) }}"
                                                            width="150px;" height="93px;" alt="{{ $driver->name }}" class="avatar-img "> -->

                                </div>
                                <strong class="card-title">Rcbook</strong>
                                <div class="row">

                                    <embed src="{{ asset('subscriber/driver/rcbook/' . $driver->rcbook) }}"
                                        width="150px;" height="93px;" alt="{{ $driver->name }}" class="avatar-img ">
                                    <!-- <img src="{{ asset('subscriber/driver/rcbook/' . $driver->rcbook) }}" width="150px;"
                                                            height="93px;" alt="{{ $driver->name }}" class="avatar-img "> -->

                                </div>
                                <strong class="card-title">Driving Licence</strong>
                                <div class="row">
                                    <embed
                                        src="{{ asset('subscriber/driver/drivingLicence/' . $driver->drivingLicence) }}"
                                        width="150px;" height="93px;" alt="{{ $driver->name }}" class="avatar-img ">
                                    <!-- <img src="{{ asset('subscriber/driver/drivingLicence/' . $driver->drivingLicence) }}"
                                                            width="150px;" height="93px;" alt="{{ $driver->name }}" class="avatar-img "> -->


                                </div>
                                <strong class="card-title">Insurance</strong>
                                <div class="row">

                                    <embed src="{{ asset('subscriber/driver/insurance/' . $driver->insurance) }}"
                                        width="150px;" height="93px;" alt="{{ $driver->name }}" class="avatar-img ">
                                    <!-- <img src="{{ asset('subscriber/driver/insurance/' . $driver->insurance) }}" width="150px;"
                                                            height="93px;" alt="{{ $driver->name }}" class="avatar-img "> -->

                                </div>
                                <strong class="card-title">Bike</strong>
                                <div class="row">

                                    <embed src="{{ asset('subscriber/driver/bike/' . $driver->bike) }}" width="150px;"
                                        height="93px;" alt="{{ $driver->name }}" class="avatar-img ">
                                    <!-- <img src="{{ asset('subscriber/driver/bike/' . $driver->bike) }}" width="150px;"
                                                            height="93px;" alt="{{ $driver->name }}" class="avatar-img "> -->

                                </div>
                                <strong class="card-title">Document</strong>
                                <div class="row">

                                    <embed src="{{ asset('subscriber/driver/document/' . $driver->customerdocument) }}"
                                        width="150px;" height="93px;" alt="{{ $driver->name }}" class="avatar-img ">

                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
@section('scripts')
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        $('#subscriptionDate').change(function() {
            var date_input = document.getElementById("subscriptionDate").value;
            var myDate = new Date(date_input);
            var future = myDate.setDate(myDate.getDate() + 30);
            var f1 = new Date(future);
            var exp = f1.toLocaleDateString("id-ID");
            document.getElementById("expiryDate").value = exp;
            //console.log(f1.toLocaleDateString("id-ID"));




        })
    </script>
@endsection
