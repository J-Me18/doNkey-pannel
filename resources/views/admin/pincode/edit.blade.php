@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('pincode') }}"> Back</a>
                </div>
                <h2 class="page-title">Pincode</h2>
                <p class="text-muted"></p>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Edit Pincode</strong>
                            </div>
                            <div class="card-body">

                                <form class="needs-validation" method="post"
                                    action="{{ url('pincodeupdate/' . $pincode->id) }}" novalidate>
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="district">District</label>
                                            <input type="text"
                                                class="form-control  @error('district') is-invalid @enderror" id="district"
                                                name="district" value="{{ $pincode->district, old('district') }}" required>
                                            @error('district')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please use a valid District </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="pincode">Pincode</label>
                                            <input type="text"
                                                class="form-control @error('pincode') is-invalid @enderror" id="pincode"
                                                name="pincode" value="{{ $pincode->pincode, old('pincode') }}" required>
                                            @error('pincode')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please use a valid pincode </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="city">Village/Taluk</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                                id="city" name="city" value="{{ $pincode->city, old('city') }}"
                                                required>
                                            @error('city')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please enter village/town name </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="taluk">Taluk</label>
                                            <input type="text" class="form-control @error('taluk') is-invalid @enderror"
                                                id="taluk" name="taluk" value="{{ $pincode->taluk, old('taluk') }}">


                                        </div>
                                    </div>

 <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="district">State</label>
                                            <input type="text"
                                                class="form-control  @error('state') is-invalid @enderror" id="state"
                                                name="state" value="{{ $pincode->state, old('state') }}" required>
                                            @error('district')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please use a valid State</div>
                                        </div>
</div>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->

                </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
