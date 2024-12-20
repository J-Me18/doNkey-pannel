@extends('layouts.master')
<style>
    label{
        font-weight: 800;
    }
</style>
@section('content')
   <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Excel Pincode</h2>
        <p class="text-muted"></p>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-12">
            <div class="card shadow mb-4">
              <div class="card-header">
                <strong class="card-title">View Pincode</strong>
              </div>
              <div class="card-body">

               
                  <div class="form-row">

                      <div class="col-md-6 mb-3">
                          <label for="name"> Circle Name</label>
                      <p>  {{ $excelPincode->circlename }} </p>
                          @error('circlename')
                          <span class="invalid-feedback" >
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                          
                         <div class="col-md-6 mb-3">
                            <label for="name"> Region Name</label>
                       <p>{{$excelPincode->regionname }}</p>
                            @error('regionname')
                            <span class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                         </div>
                        <div class="col-md-6 mb-3">
                        <label for="name"> District</label>
                       <p>{{$excelPincode->district }}</p>

                        @error('district')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        </div>
                         
                         <div class="col-md-6 mb-3">
                            <label for="name"> Pincode</label>
                       <p>{{$excelPincode->pincode }}</p>

                            @error('pincode')
                            <span class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                         </div>
                         

                    <div class="col-md-6 mb-3">
                        <label for="name"> State Name</label>
                       <p>{{$excelPincode->statename }}</p>

                        @error('statename')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                     
                     <div class="col-md-6 mb-3">
                        <label for="name"> Tier</label>
                       <p>{{$excelPincode->tier }}</p>

                        @error('tier')
                        <span class="invalid-feedback" >
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
