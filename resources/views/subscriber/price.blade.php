@extends('layouts.submaster')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <h2 class="h3 mb-4 page-title">Price</h2>
                @if (Session::has('success'))
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> </strong> {{ Session::get('success') }} <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
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
                                    <form class="needs-validation" method="post"
                                        action="{{ url('subscribers/pricestore') }}">
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="biketaxi_price">Bike Taxi km price</label>
                                                <input type="text" class="form-control" name="biketaxi_price"
                                                    value="{{ old('biketaxi_price', $subscriber->biketaxi_price) }}"
                                                    id="biketaxi_price">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="pickup_price">Pickup km price</label>
                                                <input type="text" class="form-control" name="pickup_price"
                                                    value="{{ old('pickup_price', $subscriber->pickup_price) }}" id="pickup_price">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="buy_price">Buy and Delivery km price</label>
                                                <input type="text" class="form-control" id="buy_price" name="buy_price"
                                                    value="{{ old('buy_price', $subscriber->buy_price) }}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="buy_price">Auto km price</label>
                                                <input type="text" class="form-control" id="auto_price" name="auto_price"
                                                    value="{{ old('auto_price', $subscriber->auto_price) }}">
                                            </div>
                                        </div>
                                        <p class="mb-2"><strong>Bike Taxi Price</strong></p>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="bt_price1">1 to 5 km</label>
                                                <input type="text"
                                                    class="form-control @error('bt_price1') is-invalid @enderror "
                                                    id="bt_price1" name="bt_price1"
                                                    value="{{ old('bt_price1', $subscriber->bt_price1) }}"
                                                    required>
                                                @error('bt_price1')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Bike Taxi (1 to 5 km) Price
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="bt_price2">5 to 8 km</label>
                                                <input type="text"
                                                    class="form-control @error('bt_price2') is-invalid @enderror "
                                                    id="bt_price2" name="bt_price2"
                                                    value="{{ old('bt_price2', $subscriber->bt_price2) }}"
                                                    required>
                                                @error('bt_price2')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Bike Taxi (5 to 8 km) Price
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="bt_price3">8 to 10 km</label>
                                                <input type="text"
                                                    class="form-control @error('bt_price3') is-invalid @enderror "
                                                    id="bt_price3" name="bt_price3"
                                                    value="{{ old('bt_price3', $subscriber->bt_price3) }}"
                                                    required>
                                                @error('bt_price3')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Bike Taxi (8 to 10 km) Price
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="bt_price4">Above 10 km</label>
                                                <input type="text"
                                                    class="form-control @error('bt_price4') is-invalid @enderror "
                                                    id="bt_price4" name="bt_price4"
                                                    value="{{ old('bt_price4', $subscriber->bt_price4) }}"
                                                    required>
                                                @error('bt_price4')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Bike Taxi (above 10 km) Price
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-2"><strong>Pickup Price</strong></p>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="pk_price1">1 to 5 km</label>
                                                <input type="text"
                                                    class="form-control @error('pk_price1') is-invalid @enderror "
                                                    id="pk_price1" name="pk_price1"
                                                    value="{{ old('pk_price1', $subscriber->pk_price1) }}"
                                                    required>
                                                @error('pk_price1')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Pickup (1 to 5 km) Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="pk_price2">5 to 8 km</label>
                                                <input type="text"
                                                    class="form-control @error('pk_price2') is-invalid @enderror "
                                                    id="pk_price2" name="pk_price2"
                                                    value="{{ old('pk_price2', $subscriber->pk_price2) }}"
                                                    required>
                                                @error('pk_price2')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Pickup (5 to 8 km) Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="pk_price3">8 to 10 km</label>
                                                <input type="text"
                                                    class="form-control @error('pk_price3') is-invalid @enderror "
                                                    id="pk_price3" name="pk_price3"
                                                    value="{{ old('pk_price3', $subscriber->pk_price3) }}"
                                                    required>
                                                @error('pk_price3')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Pickup (8 to 10 km) Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="pk_price4">Above 10 km</label>
                                                <input type="text"
                                                    class="form-control @error('pk_price4') is-invalid @enderror "
                                                    id="pk_price4" name="pk_price4"
                                                    value="{{ old('pk_price4', $subscriber->pk_price4) }}"
                                                    required>
                                                @error('pk_price4')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Pickup (above 10 km) Price
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-2"><strong>Buy and Delivery Price</strong></p>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="bd_price1">1 to 5 km</label>
                                                <input type="text"
                                                    class="form-control @error('bd_price1') is-invalid @enderror "
                                                    id="bd_price1" name="bd_price1"
                                                    value="{{ old('bd_price1', $subscriber->bd_price1) }}"
                                                    required>
                                                @error('bd_price1')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Buy and Delivey (1 to 5 km)
                                                    Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="bd_price2">5 to 8 km</label>
                                                <input type="text"
                                                    class="form-control @error('bd_price2') is-invalid @enderror "
                                                    id="bd_price2" name="bd_price2"
                                                    value="{{ old('bd_price2', $subscriber->bd_price2) }}"
                                                    required>
                                                @error('bd_price2')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Buy and Delivey (5 to 8 km)
                                                    Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="bd_price3">8 to 10 km</label>
                                                <input type="text"
                                                    class="form-control @error('bd_price3') is-invalid @enderror "
                                                    id="bd_price3" name="bd_price3"
                                                    value="{{ old('bd_price3', $subscriber->bd_price3) }}"
                                                    required>
                                                @error('bd_price3')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Buy and Delivey (8 to 10 km)
                                                    Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="bd_price4">Above 10 km</label>
                                                <input type="text"
                                                    class="form-control @error('bd_price4') is-invalid @enderror "
                                                    id="bd_price4" name="bd_price4"
                                                    value="{{ old('bd_price4', $subscriber->bd_price4) }}"
                                                    required>
                                                @error('bd_price4')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Buy and Delivey (above 10 km)
                                                    Price</div>
                                            </div>
                                        </div>
                                        <p class="mb-2"><strong>Auto Price</strong></p>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="at_price1">1 to 5 km</label>
                                                <input type="text"
                                                    class="form-control @error('at_price1') is-invalid @enderror "
                                                    id="bd_price1" name="at_price1"
                                                    value="{{ old('at_price1', $subscriber->at_price1) }}"
                                                    required>
                                                @error('at_price1')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Buy and Delivey (1 to 5 km)
                                                    Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="at_price2">5 to 8 km</label>
                                                <input type="text"
                                                    class="form-control @error('at_price2') is-invalid @enderror "
                                                    id="at_price2" name="at_price2"
                                                    value="{{ old('at_price2', $subscriber->at_price2) }}"
                                                    required>
                                                @error('at_price2')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Buy and Delivey (5 to 8 km)
                                                    Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="at_price3">8 to 10 km</label>
                                                <input type="text"
                                                    class="form-control @error('at_price3') is-invalid @enderror "
                                                    id="at_price3" name="at_price3"
                                                    value="{{ old('at_price3', $subscriber->at_price3) }}"
                                                    required>
                                                @error('at_price3')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Buy and Delivey (8 to 10 km)
                                                    Price</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="at_price4">Above 10 km</label>
                                                <input type="text"
                                                    class="form-control @error('at_price4') is-invalid @enderror "
                                                    id="at_price4" name="at_price4"
                                                    value="{{ old('at_price4', $subscriber->at_price4) }}"
                                                    required>
                                                @error('at_price4')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback"> Please Enter Buy and Delivey (above 10 km)
                                                    Price</div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-row">
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
                        </div> --}}
                                        <input type="hidden" id="id" class="form-control" placeholder=""
                                            name="id" value="{{ $subscriber->id }}">


                                        <center><button type="submit" class="btn btn-success "> Update </button></center>
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
