@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Complaint</h2>
                <p class="text-muted"></p>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        {{-- <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('complaints.index') }}"> Back</a>
                        </div> --}}
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Edit Complaint Status</strong>
                            </div>
                            <div class="card-body">

                                <form class="needs-validation" method="post"
                                    action="{{ route('complaints.update', $complaints->id) }}" novalidate>
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <div class="form-row">


                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror "
                                                id="name" name="name" value="{{ old('name', $complaints->name) }}"
                                                readonly>
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter name </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="area">Area</label>
                                            <input type="text" class="form-control @error('area') is-invalid @enderror"
                                                id="area" value="{{ old('area', $complaints->area) }}" name="area"
                                                readonly>
                                            @error('area')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter location </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mailId">Email</label>
                                            <input type="email" class="form-control @error('mailId') is-invalid @enderror"
                                                id="mailId" name="mailId"
                                                value="{{ old('mailId', $complaints->mailId) }}" readonly>
                                            @error('mailId')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please use a valid email </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                                id="mobile" value="{{ old('mobile', $complaints->mobile) }}"
                                                onkeypress="return isNumberKey(event)" name="mobile" readonly>
                                            @error('mobile')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter mobile number </div>
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="pincode">Pincode</label>
                                            <select name="pincode[]"
                                                class="form-control @error('pincode') is-invalid @enderror" id="pincode"
                                                multiple multiselect-search="true" value=""
                                                multiselect-select-all="true" multiselect-max-items="3"
                                                onchange="console.log(this.selectedOptions)">
                                                @foreach ($pincode as $pincode)
                                                    <option value="{{ $pincode->id }}"  style="color:black;"
                                                        {{ (is_array(old('pincode', $complaints->pincode)) and in_array($pincode->id, old('pincode', $complaints->pincode))) ? ' selected' : '' }}>
                                                        {{ $pincode->pincode }}</option>
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
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" readonly>{{ old('description', $complaints->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter description </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="category">Category</label>
                                            <select name="category"
                                                class="form-control @error('category') is-invalid @enderror" id="category">

                                                <option value="driver"
                                                    {{ old('category', $complaints->category) ? ' selected' : '' }}>
                                                    Rider</option>
                                                <option value="subscriber"
                                                    {{ old('category', $complaints->category) ? ' selected' : '' }}>
                                                    Subscriber</option>
                                                <option value="user"
                                                    {{ old('category', $complaints->category) ? ' selected' : '' }}>User
                                                </option>



                                            </select>
                                            @error('category')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please select a category. </div>


                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Select Status</option>
                                                <option {{ $complaints->status == 'Done' ? 'selected' : '' }}
                                                    value="Done">Done</option>
                                                <option {{ $complaints->status == 'Partially' ? 'selected' : '' }}
                                                    value="Partially">Partially Done</option>
                                            </select>
                                            {{-- <small id="status" class="form-text text-muted"></span></small> --}}
                                            @error('status')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{-- <div class="invalid-feedback"> Please Select Account Type </div> --}}
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="complaint">Complaint </label>
                                            <textarea class="form-control @error('complaint') is-invalid @enderror" id="complaint" name="complaint" readonly>{{ old('complaint', $complaints->complaint) }}</textarea>
                                            @error('complaint')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter your complaint </div>
                                        </div>

                                        <br>
                                        <div class="col-md-12 mb-3"
                                            style="display: flex; align-items:center; justify-content:center">
                                            <button class="btn btn-primary pull-center" type="submit">Update</button>
                                        </div>

                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->

                </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
