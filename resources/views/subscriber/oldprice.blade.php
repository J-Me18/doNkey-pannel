@extends('layouts.submaster')
@section('content')

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
          <h2 class="h3 mb-4 page-title">Price</h2>
          @if(Session::has('success'))
          <!-- Small table -->
          <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong> </strong> {{ Session::get('success') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              </div>
        @endif
          <div class="my-4">
            <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Upade Price Amount</strong>
                    </div>
                    <div class="card-body">
                      <form class="needs-validation" method="post" action="{{url('subscribers/pricestore')}}">
                        {{csrf_field()}}
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="biketaxi_price">Bike Taxi km price</label>
                            <input type="text" class="form-control" name="biketaxi_price" value="{{session('subscribers')['biketaxi_price']}}" id="biketaxi_price">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="pickup_price">Pickup km price</label>
                            <input type="text" class="form-control" name="pickup_price" value="{{session('subscribers')['pickup_price']}}" id="pickup_price">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="buy_price">Buy and Delivery km price</label>
                          <input type="text" class="form-control" id="buy_price" name="buy_price" value="{{session('subscribers')['buy_price']}}" >
                        </div>
                        <input type="hidden" id="id" class="form-control" placeholder="" name="id" value="{{session('subscribers')['id'] }}">


                        <button type="submit" class="btn btn-success "> Update </button>
                      </form>
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div>
          </div> <!-- /.card-body -->
        </div> <!-- /.col-12 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->


  @endsection
