@extends('layouts.master')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <h2 class="page-title">Complaints</h2>
      <p class="text-muted"></p>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">Complaints Form</strong>
            </div>
            <div class="card-body">

              <form class="needs-validation" method="post" action="{{route('complaints.store')}}" enctype="multipart/form-data" novalidate>
                {{csrf_field()}}
                <div class="form-row">



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
                    <label for="area">Area</label>
                    <input type="text" class="form-control @error('area') is-invalid @enderror" id="area" value="{{ old('area') }}" name="area" required>
                    @error('area')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="invalid-feedback"> Please enter location </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="mailId">Email</label>
                    <input type="email" class="form-control @error('mailId') is-invalid @enderror" id="mailId" name="mailId" value="{{ old('mailId') }}" required>
                    @error('mailId')
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
                    <label for="pincode">Pincode</label>
                    <select name="pincode[]" class="form-control @error('pincode') is-invalid @enderror" id="pincode" multiple multiselect-search="true" value="" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)">
                      @foreach ($pincode as $pincode)
                      <option value="{{$pincode->id}}" {{ (is_array(old('pincode')) and in_array($pincode->id, old('pincode'))) ? ' selected' : '' }}>{{$pincode->pincode}}</option>
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
                    <label for="ficon">Priority </label>



                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio1" name="ficon" value="1" class="custom-control-input  @error('ficon') is-invalid @enderror">
                      <label class="custom-control-label" for="customRadio1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio2" name="ficon" value="0" class="custom-control-input  @error('ficon') is-invalid @enderror">
                      <label class="custom-control-label" for="customRadio2">No</label>
                    </div>
                  </div>
                  @error('ficon')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <div class="invalid-feedback"> Please check </div>

                  <div class="col-md-6 mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="invalid-feedback"> Please enter description </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="category">Category</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror" id="category">

                      <option value="driver" {{ (old('category') ) ? ' selected' : '' }}>Rider</option>
                      <option value="subscriber" {{ (old('category') ) ? ' selected' : '' }}>Subscriber</option>
                      <option value="user" {{ (old('category') ) ? ' selected' : '' }}>User</option>



                    </select>
                    @error('category')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="invalid-feedback"> Please select a category. </div>


                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="complaint">Complaint </label>
                    <textarea class="form-control @error('complaint') is-invalid @enderror" id="complaint" name="complaint" required>{{ old('complaint') }}</textarea>
                    @error('complaint')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="invalid-feedback"> Please enter your complaint </div>
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