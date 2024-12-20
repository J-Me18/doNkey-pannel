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
                                <strong class="card-title">Edit Employee</strong>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" method="post"
                                    action="{{ route('subEmployee.update', $employee->id) }}" enctype="multipart/form-data"
                                    novalidate>
                                    {{ csrf_field() }}
                                    @method("PUT")
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror "
                                                id="name" name="name" value="{{ old('name', $employee->name) }}" required>
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter name </div>
                                        </div>
{{-- {{ dd($employee) }} --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="emp_id">Employee ID</label>
                                            <input type="text" class="form-control @error('emp_id') is-invalid @enderror"
                                                id="emp_id" value="{{ old('emp_id', $employee->emp_id) }}" name="emp_id"
                                                required>
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
                                                multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}"
                                                        {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                        {{ $role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please select a valid role. </div>
                                        </div>
                 
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $employee->email) }}" required>
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
                                                class="form-control @error('official_mail') is-invalid @enderror"
                                                id="official_mail" name="official_mail"
                                                value="{{ old('official_mail', $employee->official_mail) }}" required>
                                            @error('official_mail')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please use a valid Official Mail </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                                id="mobile" value="{{ old('mobile', $employee->mobile) }}" name="mobile"
                                                required>
                                            @error('mobile')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter mobile number </div>
                                        </div>
{{-- {{ dd($employee) }} --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="official_mobile">Official Mobile</label>
                                            <input type="text"
                                                class="form-control @error('official_mobile') is-invalid @enderror"
                                                id="official_mobile" value="{{ old('official_mobile', $employee->official_mobile) }}"
                                                 name="official_mobile">
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
                                                id="joining_date" value="{{ old('joining_date', $employee->joining_date) }}"
                                                name="joining_date">
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
                                                <option {{ $employee->gender == 'Male' ? 'selected' : '' }} value="Male">
                                                    Male</option>
                                                <option {{ $employee->gender == 'Female' ? 'selected' : '' }}
                                                    value="Female">Female</option>
                                                <option {{ $employee->gender == 'Other' ? 'selected' : '' }}
                                                    value="Other">Other</option>
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
                                            <input type="text"
                                                class="form-control @error('education') is-invalid @enderror" id="education"
                                                value="{{ old('education', $employee->education) }}" name="education" required>
                                            @error('education')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Eduactional Qualifiction </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="blood_group">Blood Group</label>
                                            <input type="text"
                                                class="form-control @error('blood_group') is-invalid @enderror"
                                                id="blood_group" value="{{ old('blood_group', $employee->blood_group) }}"
                                                name="blood_group" required>
                                            @error('blood_group')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Blood Group </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="address">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>{{ old('address', $employee->address) }}</textarea>
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
                                                name="current_address" required>{{ old('current_address', $employee->current_address) }}</textarea>
                                            @error('current_address')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Current Address </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="aadhar">Aadhar Number</label>
                                            <input type="text"
                                                class="form-control @error('aadhar') is-invalid @enderror" id="aadhar"
                                                value="{{ old('aadhar', $employee->aadhar) }}" name="aadhar" required>
                                            @error('aadhar')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter Aadhar number </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pan">PAN Number</label>
                                            <input type="text" class="form-control @error('pan') is-invalid @enderror"
                                                id="pan" value="{{ old('pan', $employee->pan) }}" name="pan"
                                                required>
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
                                                {{-- <option value="Half Roll">Half Roll</option>
                                                <option value="On Roll">On Roll</option> --}}
                                                <option {{ $employee->payment == 'Half Roll' ? 'selected' : '' }} value="Half Roll">
                                                    Half Roll</option>
                                                <option {{ $employee->payment == 'On Roll' ? 'selected' : '' }}
                                                    value="On Roll">On Roll</option>
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
                                                id="password" name="password" value="{{ old('password', $employee->password) }}"
                                                required>
                                            @error('password')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter password </div>
                                        </div>{{-- {{ dd($employee); }} --}}
                                        



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
