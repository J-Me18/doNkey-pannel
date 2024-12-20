 @extends('layouts.master')
  @section('content')
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
                  <strong class="card-title">Add Coupons</strong>
                </div>
                <div class="card-body">

                  <form class="needs-validation" method="post" action="{{url('couponsstore')}}" enctype="multipart/form-data"  novalidate>
                    {{csrf_field()}}
                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name"  value="{{ old('name') }}"  required>
                            @error('name')
                            <span class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <div class="invalid-feedback"> Please enter coupon name </div>
                           </div>
                           <div class="col-md-6 mb-3">
                            <label for="code">Code</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" value="{{ old('code') }}"  name="code"  required>
                            @error('code')
                            <span class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <div class="invalid-feedback"> Please enter coupon code </div>
                           </div>
                           <div class="col-md-6 mb-3">
                            <label for="user_limit">User Limit</label>
                            <input type="number" class="form-control @error('user_limit') is-invalid @enderror" id="user_limit" name="user_limit" value="{{ old('user_limit') }}"  required>
                            @error('user_limit')
                            <span class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <div class="invalid-feedback"> Please enter the user limit </div>
                           </div>
                           <div class="col-md-6 mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"  name="description"  required>{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <div class="invalid-feedback"> Please enter description </div>
                           </div>

                      <div class="col-md-6 mb-3">
                        <label for="valid_from">Valid from</label>
                        <input type="date" class="form-control @error('valid_from') is-invalid @enderror" id="valid_from" value="{{ old('valid_from') }}"   name="valid_from"  required>
                        @error('valid_from')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <div class="invalid-feedback"> Please enter valid date </div>
                       </div>
                       <div class="col-md-6 mb-3">
                        <label for="valid_to">Valid To</label>
                        <input type="date" class="form-control @error('valid_to') is-invalid @enderror" id="valid_to" value="{{ old('valid_to') }}"   name="valid_to"  required>
                        @error('valid_to')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <div class="invalid-feedback"> Please enter valid date </div>
                       </div>
                       <div class="col-md-6 mb-3">
                        <label for="customSwitch1">Active Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" value='1' name="active" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1"></label>
                          </div>

                        @error('active')
                        <span class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

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
