
  @extends('layouts.master')
  @section('content')
     <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <h2 class="page-title">Pincode</h2>
          <p class="text-muted"></p>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Add Pincode</strong>
                </div>
                <div class="card-body">

                  <form class="needs-validation"   method="post" action="{{url('pincodestore')}}"  novalidate>
                    {{csrf_field()}}
                    <div class="form-row">

                       <div class="col-md-6 mb-3">
                        <label for="district">District</label>
                        <input type="text" class="form-control  @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district') }}"  required>
                        @error('district')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <div class="invalid-feedback"> Please use a valid District </div>
                       </div>
                       <div class="col-md-6 mb-3">
                        <label for="city">City/Village</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"  name="city" value="{{ old('city') }}" required>
                        @error('city')
                        <span class="invalid-feedback" >
                          {{ $message }}
                        </span>
                        @enderror
                        <div class="invalid-feedback"> Please enter city or village name </div>
                       </div>
                       <div class="col-md-6 mb-3">
                        <label for="taluk">Taluk</label>
                        <input type="text" class="form-control @error('taluk') is-invalid @enderror" id="taluk"  name="taluk" value="{{ old('taluk') }}" >
                        
                        </div>

                      <div class="col-md-6 mb-3">
                        <label for="pincode">Pincode</label>
                        <input type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode"  name="pincode" value="{{ old('pincode') }}" required>
                        @error('pincode')
                        <span class="invalid-feedback" >
                          {{ $message }}
                        </span>
                        @enderror
                        <div class="invalid-feedback"> Please use a valid pincode </div>
                       </div>
                    </div>

<div class="form-row">

                       <div class="col-md-6 mb-3">
                        <label for="district">State Name</label>
                        <input type="text" class="form-control  @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') }}"  required>
                        @error('state')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <div class="invalid-feedback"> Please use a valid State Name</div>
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
