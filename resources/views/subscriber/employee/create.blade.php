@extends('layouts.submaster')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Employee</h2>
                <p class="text-muted"></p>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Add Employee</strong>
                            </div>
                            <div class="card-body">

                                <form class="needs-validation" method="post" action="{{ route('subEmployee.store') }}"
                                    enctype="multipart/form-data" novalidate>
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror "
                                                id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter name </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="emp_id">PBP Employee ID</label>
                                            <input type="text" class="form-control @error('emp_id') is-invalid @enderror" placeholder="ID like #12#"
                                                id="emp_id" value="{{ old('emp_id') }}" name="emp_id" required>
                                            @error('emp_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Employee ID </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="role">Role</label>
                                            <select name="role[]"
                                                class="form-control @error('role') is-invalid @enderror" id="role"
                                                multiple multiselect-search="true" value=""
                                                multiselect-select-all="true" multiselect-max-items="3"
                                                onchange="console.log(this.selectedOptions)">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ (is_array(old('role')) and in_array($role->name, old('role'))) ? ' selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please select a valid pincode. </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please use a valid email </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="official_mail">Official Email</label>
                                            <input type="email"
                                                class="form-control @error('official_mail') is-invalid @enderror" placeholder="Official Email"
                                                id="official_mail" name="official_mail" value="{{ old('official_mail') }}"
                                                required>
                                            @error('official_mail')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please use a valid Official Mail </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile"
                                                id="mobile" value="{{ old('mobile') }}"
                                                onkeypress="return isNumberKey(event)" name="mobile" required>
                                            @error('mobile')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter mobile number </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="official_mobile">Official Mobile</label>
                                            <input type="text"
                                                class="form-control @error('official_mobile') is-invalid @enderror" placeholder="Official Mobile"
                                                id="official_mobile" value="{{ old('official_mobile') }}"
                                                onkeypress="return isNumberKey(event)" name="official_mobile" required>
                                            @error('official_mobile')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Official mobile number </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="joining_date">Date Of Joining</label>
                                            <input type="date"
                                                class="form-control @error('joining_date') is-invalid @enderror"
                                                id="joining_date" value="{{ old('joining_date') }}" name="joining_date"
                                                required>
                                            @error('joining_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Joining Date </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="gender">gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror" id="gender"
                                                value="">
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
                                            <label for="education">Eduactional Qualifiction</label>
                                            <input type="text" placeholder="Education"
                                                class="form-control @error('education') is-invalid @enderror" id="education"
                                                value="{{ old('education') }}" name="education" required>
                                            @error('education')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Eduactional Qualifiction </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="blood_group">Blood Group</label>
                                            <input type="text" placeholder="Blood Group"
                                                class="form-control @error('blood_group') is-invalid @enderror"
                                                id="blood_group" value="{{ old('blood_group') }}" name="blood_group"
                                                required>
                                            @error('blood_group')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Blood Group </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="address">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required placeholder="Address">{{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Address </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="current_address">Current Address</label>
                                            <textarea class="form-control @error('current_address') is-invalid @enderror" id="current_address"
                                                name="current_address" required placeholder="Current Address">{{ old('current_address') }}</textarea>
                                            @error('current_address')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Current Address </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="aadhar">Aadhar Number</label>
                                            <input type="text" placeholder="Aadhar Number"
                                                class="form-control @error('aadhar') is-invalid @enderror" id="aadhar"
                                                value="{{ old('aadhar') }}" name="aadhar" required>
                                            @error('aadhar')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Aadhar number </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pan">PAN Number</label>
                                            <input type="text" class="form-control @error('pan') is-invalid @enderror" placeholder="PAN Number"
                                                id="pan" value="{{ old('pan') }}" name="pan" required>
                                            @error('pan')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter PAN Number </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="payment">Payment</label>
                                            <select name="payment"
                                                class="form-control @error('payment') is-invalid @enderror"
                                                id="payment" value="">
                                                <option value="">Select </option>
                                                <option value="Half Roll">Half Roll</option>
                                                <option value="On Roll">On Roll</option>
                                            </select>
                                            @error('payment')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please select a valid gender. </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror "
                                                id="password" name="password" value="{{ old('password') }}" required>
                                            @error('password')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter password </div>
                                        </div> 
                                    </div>




                                    <button class="btn btn-primary" type="submit">Submit</button>
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
