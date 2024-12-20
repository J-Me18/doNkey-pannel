@extends('layouts.master')
@section('content')
   <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Pricing</h2>
        <p class="text-muted"></p>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-12">
            <div class="card shadow mb-4">
              <div class="card-header">
                <strong class="card-title">Edit Pricing</strong>
              </div>
              <div class="card-body">

                <form class="needs-validation" method="post" action="{{ route('excelpincode.update', $excelPincode->id) }}" >
                  {{csrf_field()}}
                  @method('PUT')
                  <div class="form-row">

                      <div class="col-md-6 mb-3">
                          <label for="name"> Circle Name</label>
                          <input type="text" class="form-control @error('circlename') is-invalid @enderror " id="circlename" name="circlename" value="{{ old('circlename', $excelPincode->circlename) }}"  required>
                          @error('circlename')
                          <span class="invalid-feedback" >
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                          
                         <div class="col-md-6 mb-3">
                            <label for="name"> Region Name</label>
                            <input type="text" class="form-control @error('regionname') is-invalid @enderror " id="regionname" name="regionname"  value="{{ old('regionname',$excelPincode->regionname) }}" required>
                            @error('regionname')
                            <span class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                         </div>
                        <div class="col-md-6 mb-3">
                        <label for="name"> District</label>
                        <input type="text" class="form-control @error('district') is-invalid @enderror " id="district" name="district" value="{{ old('district',$excelPincode->district) }}" required>
                        @error('district')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        </div>
                         
                         <div class="col-md-6 mb-3">
                            <label for="name"> Pincode</label>
                            <input type="text" class="form-control @error('pincode') is-invalid @enderror " id="pincode" name="pincode"  value="{{ old('pincode',$excelPincode->pincode) }}"  required>
                            @error('pincode')
                            <span class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                         </div>
                         

                    <div class="col-md-6 mb-3">
                        <label for="name"> State Name</label>
                        <input type="text" class="form-control @error('statename') is-invalid @enderror " id="statename" name="statename"  value="{{ old('statename',$excelPincode->statename) }}"  required>
                        @error('statename')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                     
                     <div class="col-md-6 mb-3">
                        <label for="name"> Tier</label>
                        <input type="text" class="form-control @error('tier') is-invalid @enderror " id="tier" name="tier"  value="{{ old('tier',$excelPincode->tier) }}"  required>
                        @error('tier')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                      

                     </div>

                  </div>

                  <button class="btn btn-primary" type="submit">Update </button>
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
