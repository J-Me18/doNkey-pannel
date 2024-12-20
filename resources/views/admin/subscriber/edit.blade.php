@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- <h2 class="page-title">Subscriber</h2> -->
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('subscriber') }}"> Back</a>
            </div>
            <h2 class="h3 mb-4 page-title">Edit Subscriber </h2>
            <p class="text-muted"></p>
            <div class="row">

                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Edit Subscriber - {{ $subscriber->name }}(<span class="">
                                    {{ $subscriber->subscriberId }}</span>)</strong>
                        </div>
                        <div class="card-body">

                            <form class="needs-validation" method="post"
                                action="{{url('subscriberupdate/'.$subscriber->id)}}" enctype="multipart/form-data"
                                novalidate>
                                {{csrf_field()}}
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror "
                                            id="name" name="name" value="{{ old('name',$subscriber->name )}}" required>
                                        @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter name </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                                            id="location" value="{{ $subscriber->location, old('location') }}"
                                            name="location" required>
                                        @error('location')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter location </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password">Password</label>

                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror " id="password"
                                            name="password" value="{{ old('password',$subscriber->password )}}"
                                            required>
                                        @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter name </div>
                                    </div>
                                   <div class="col-md-6 mb-3">
                                        <label for="subscriptionDate">Date</label>
                                        <input class="form-control @error('subscriptionDate') is-invalid @enderror"
                                            id="subscriptionDate" type="date"
                                          
                                            value="{{ \Carbon\Carbon::parse($subscriber->subscriptionDate)->format('Y-m-d')}}"
                                            name="subscriptionDate" required readonly>
                                        @error('subscriptionDate')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="expiryDate">Expiry Date</label>
                                        <input class="form-control @error('expiryDate') is-invalid @enderror"
                                            id="expiryDate" type="text"
                                            value="  {{ $subscriber->expiryDate, old('expiryDate') }}" name="expiryDate"
                                            readonly>
                                        @error('expiryDate')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ $subscriber->email, old('email') }}"
                                            required>
                                        @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please use a valid email </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                            id="mobile" value="{{ $subscriber->mobile, old('mobile') }}"
                                            onkeypress="return isNumberKey(event)" name="mobile" required>
                                        @error('mobile')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter mobile number </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pincode">Pincode</label>
                                        @php
                                        $subscriberpincode=json_decode($subscriber->pincode);

                                        @endphp
                                        <select name="pincode[]"
                                            class="form-control @error('pincode') is-invalid @enderror" id="pincode"
                                            multiple multiselect-search="true" value="" multiselect-select-all="true"
                                            multiselect-max-items="3" onchange="console.log(this.selectedOptions)">
                                            @foreach ($pincode as $pincode)
                                            <option value="{{$pincode->id}}"
                                                {{ (is_array($subscriberpincode) and in_array($pincode->id, $subscriberpincode)) ? ' selected' : '',(is_array(old('pincode')) and in_array($pincode->id, old('pincode'))) ? ' selected' : ''  }}>
                                                {{$pincode->pincode}}</option>
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
                                        <label for="expiryDate">Expiry Date</label>
                                        <input class="form-control @error('expiryDate') is-invalid @enderror"
                                            id="expiryDate" type="text"
                                            value="  {{ $subscriber->expiryDate, old('expiryDate') }}" name="expiryDate"
                                            readonly>
                                        @error('expiryDate')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="subscriptionPrice">Price for Subscription</label>
                                        <input type="text"
                                            class="form-control @error('subscriptionPrice') is-invalid @enderror"
                                            id="subscriptionPrice"
                                            value=" {{ $subscriber->subscription_price, old('subscriptionPrice') }}"
                                            onkeypress="return isNumberKey(event)" name="subscriptionPrice" required>
                                        @error('subscriptionPrice')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter subscription price </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="description">Address</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description"
                                            required>{{ $subscriber->description , old('description')}}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter description </div>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="aadharNo">Aadhar Number</label>
                                        <input type="text" class="form-control @error('aadharNo') is-invalid @enderror"
                                            id="aadharNo" value="{{ $subscriber->aadharNo, old('aadharNo') }}"
                                            onkeypress="return isNumberKey(event)" name="aadharNo" required>
                                        @error('aadharNo')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter aadhar number </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile">Aadhar Image</label>
                                        <input type="file"
                                            class="form-control @error('aadharImage') is-invalid @enderror"
                                            id="aadharImage" value="{{ old('aadharImage') }}" name="aadharImage"
                                            accept=".pdf">
                                        @error('aadharImage')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile">Aadhar Back Image</label>
                                        <input type="file"
                                            class="form-control @error('aadharBackImage') is-invalid @enderror"
                                            id="aadharBackImage" value="{{ old('aadharBackImage') }}"
                                            name="aadharBackImage" accept=".pdf">
                                        @error('aadharBackImage')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pancardImage">Pancard Image</label>
                                        <input type="file"
                                            class="form-control @error('pancardImage') is-invalid @enderror"
                                            id="pancardImage" value="{{ old('pancardImage') }}" name="pancardImage"
                                            accept=".pdf">
                                        @error('pancardImage')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bankacno">Bank Account Number</label>
                                        <input type="text" class="form-control @error('bankacno') is-invalid @enderror"
                                            id="aadharNo" value="{{ $subscriber->bankacno, old('bankacno') }}"
                                            name="bankacno" required>
                                        @error('bankacno')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter bank account number</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ifsccode">IFSC Code</label>
                                        <input type="text" class="form-control @error('ifsccode') is-invalid @enderror"
                                            id="ifsccode" value="{{ $subscriber->ifsccode, old('ifsccode') }}"
                                            name="ifsccode" required>
                                        @error('ifsccode')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter ifsc code </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bankstatement">Bank Statement</label>
                                        <input type="file"
                                            class="form-control @error('bankstatement') is-invalid @enderror"
                                            id="bankstatement" value="{{ old('bankstatement') }}" name="bankstatement"
                                            accept=".pdf">
                                        @error('bankstatement')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="account_type">Account Type</label>
                                        <select class="form-control" name="account_type">
                                            <option value="">Select Type</option>
                                            <option {{ $subscriber->account_type == 'Current' ? 'selected' : '' }}
                                                value="Current">Current</option>
                                            <option {{ $subscriber->account_type == 'Savings' ? 'selected' : '' }}
                                                value="Savings">Savings</option>
                                        </select>
                                        {{-- <small id="account_type" class="form-text text-muted"></span></small> --}}
                                        @error('account_type')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- <div class="invalid-feedback"> Please Select Account Type </div> --}}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="customerdocument">Document</label>
                                        <input type="file"
                                            class="form-control @error('customerdocument') is-invalid @enderror"
                                            id="customerdocument" value="{{ old('customerdocument') }}" accept=".pdf"
                                            name="customerdocument">
                                        <small id="customerdocument" class="form-text text-muted">Note:Please upload pdf
                                            format </span></small>
                                        @error('customerdocument')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror<div class="invalid-feedback"> Please upload bike image </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="image">Photo</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            id="image" value="{{ old('image') }}" name="image"
                                            accept="image/png,image/jpeg,image/jpg,image/gif">

                                        @error('image')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror


                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="video">Video </label>
                                        <input type="file" class="form-control @error('video') is-invalid @enderror"
                                            id="video" value="{{ old('video') }}" accept=".mp4" name="video">
                                        <small id="video" class="form-text text-muted">Note:Please upload mp4
                                            format </span></small>
                                        @error('video')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror<div class="invalid-feedback"> Please upload Video </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="biketaxi_price">Bike Taxi km price</label>
                                        <input type="text"
                                            class="form-control @error('biketaxi_price') is-invalid @enderror "
                                            id="biketaxi_price" name="biketaxi_price"
                                            value="{{ $subscriber->biketaxi_price,old('biketaxi_price') }}" required>
                                        @error('biketaxi_price')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please Enter Bike Taxi km Price</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="pickup_price">Pickupkm price</label>
                                        <input type="text"
                                            class="form-control @error('pickup_price') is-invalid @enderror "
                                            id="pickup_price" name="pickup_price"
                                            value="{{ $subscriber->pickup_price, old('pickup_price') }}" required>
                                        @error('pickup_price')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter pickup km price</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="buy_price">Buy and Delivery km price</label>
                                        <input type="text"
                                            class="form-control @error('buy_price') is-invalid @enderror "
                                            id="buy_price" name="buy_price"
                                            value="{{ $subscriber->buy_price, old('buy_price') }}" required>
                                        @error('buy_price')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter buy and delivery km price</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="buy_price">Auto km price</label>
                                        <input type="text"
                                            class="form-control @error('auto_price') is-invalid @enderror "
                                            id="auto_price" name="auto_price"
                                            value="{{ $subscriber->auto_price, old('auto_price') }}" required>
                                        @error('auto_price')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter buy and delivery km price</div>
                                    </div>
                                    <div class="container">
                                    <div class="container">
                                    <p class="mb-2"><strong>Bike Taxi Price</strong></p>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="bt_price1">1 to 5 km</label>
                                            <input type="text"
                                                class="form-control @error('bt_price1') is-invalid @enderror "
                                                id="bt_price1" name="bt_price1"
                                                value="{{ $subscriber->bt_price1, old('bt_price1') }}" required>
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
                                                value="{{ $subscriber->bt_price2, old('bt_price2') }}" required>
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
                                                value="{{ $subscriber->bt_price3, old('bt_price3') }}" required>
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
                                                value="{{ $subscriber->bt_price4, old('bt_price4') }}" required>
                                            @error('bt_price4')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please Enter Bike Taxi (above 10 km) Price
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="container">
                                    <p class="mb-2"><strong>Pickup Price</strong></p>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="pk_price1">1 to 5 km</label>
                                            <input type="text"
                                                class="form-control @error('pk_price1') is-invalid @enderror "
                                                id="pk_price1" name="pk_price1"
                                                value="{{ $subscriber->pk_price1, old('pk_price1') }}" required>
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
                                                value="{{ $subscriber->pk_price2, old('pk_price2') }}" required>
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
                                                value="{{ $subscriber->pk_price3, old('pk_price3') }}" required>
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
                                                value="{{ $subscriber->pk_price4, old('pk_price4') }}" required>
                                            @error('pk_price4')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please Enter Pickup (above 10 km) Price</div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="container">
                                    <p class="mb-2"><strong>Buy and Delivery Price</strong></p>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="bd_price1">1 to 5 km</label>
                                            <input type="text"
                                                class="form-control @error('bd_price1') is-invalid @enderror "
                                                id="bd_price1" name="bd_price1"
                                                value="{{ $subscriber->bd_price1, old('bd_price1') }}" required>
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
                                                value="{{ $subscriber->bd_price2, old('bd_price2') }}" required>
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
                                                value="{{ $subscriber->bd_price3, old('bd_price3') }}" required>
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
                                                value="{{ $subscriber->bd_price4, old('bd_price4') }}" required>
                                            @error('bd_price4')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please Enter Buy and Delivey (above 10 km)
                                                Price</div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="container">
                                    <p class="mb-2"><strong>Auto Price</strong></p>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="at_price1">1 to 5 km</label>
                                            <input type="text"
                                                class="form-control @error('at_price1') is-invalid @enderror "
                                                id="at_price1" name="at_price1"
                                                value="{{ $subscriber->at_price1, old('at_price1') }}" required>
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
                                                value="{{ $subscriber->at_price2, old('at_price2') }}" required>
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
                                                value="{{ $subscriber->at_price3, old('at_price3') }}" required>
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
                                                value="{{ $subscriber->at_price4, old('at_price4') }}" required>
                                            @error('at_price4')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <div class="invalid-feedback"> Please Enter Buy and Delivey (above 10 km)
                                                Price</div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="comments">Comments</label>
                                        <textarea class="form-control @error('comments') is-invalid @enderror "
                                            id="comments" name="comments" value=""
                                            required>{{old('comments') }}</textarea>
                                        @error('comments')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="invalid-feedback"> Please enter what changes you have made</div>

                                    </div>


                                </div>




                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Proof's</strong>
                        </div>
                        <div class="card-body">
                            <strong class="card-title">Aadhar Front</strong>
                            <div class="row ">
                                <embed src="{{ asset('admin/subscriber/aadhar/'.$subscriber->aadharImage) }}"
                                    width="150px;" height="93px;" alt="{{ $subscriber->name }}" class="avatar-img ">

                                <!-- <img src="{{ asset('admin/subscriber/aadhar/'.$subscriber->aadharImage) }}"
                                    width="150px;" height="93px;" alt="{{ $subscriber->name }}" class="avatar-img "> -->

                            </div>
                            <strong class="card-title">Aadhar Back</strong>
                            <div class="row">
                                <embed src="{{ asset('admin/subscriber/aadhar/back/'.$subscriber->aadharBackImage) }}"
                                    width="150px;" height="93px;" alt="{{ $subscriber->name }}" class="avatar-img ">
                                <!-- <img src="{{ asset('admin/subscriber/aadhar/back/'.$subscriber->aadharBackImage) }}"
                                    width="150px;" height="93px;" alt="{{ $subscriber->name }}" class="avatar-img "> -->

                            </div>
                            <strong class="card-title">Pancard</strong>
                            <div class="row">
                                <embed src="{{ asset('admin/subscriber/pan/'.$subscriber->pancardImage) }}"
                                    width="150px;" height="93px;" alt="{{ $subscriber->name }}" class="avatar-img ">
                                <!-- <img src="{{ asset('admin/subscriber/pan/'.$subscriber->pancardImage) }}" width="150px;"
                                    height="93px;" alt="{{ $subscriber->name }}" class="avatar-img "> -->

                            </div>
                            <strong class="card-title">BankStatement</strong>
                            <div class="row">

                                <embed src="{{ asset('admin/subscriber/bankstatement/'.$subscriber->bankstatement) }}"
                                    width="150px;" height="93px;" />

                            </div>
                            <strong class="card-title">Profile</strong>
                            <div class="row">

                                <img src="{{ asset('admin/subscriber/profile/'.$subscriber->image) }}" width="150px;"
                                    height="93px;" alt="{{ $subscriber->name }}" class="avatar-img ">

                            </div>
                            @if($subscriber->customerdocument!="")
                            <strong class="card-title">Document</strong>
                            <div class="row">

                                <embed src="{{ asset('admin/subscriber/document/'.$subscriber->customerdocument) }}"
                                    width="150px;" height="93px;" />
                                <!-- <img src="{{ asset('admin/subscriber/video/'.$subscriber->video) }}" width="150px;"
                                    height="93px;" alt="{{ $subscriber->name }}" class="avatar-img "> -->

                            </div>
                            @endif
                            @if($subscriber->video!="")
                            <strong class="card-title">Video</strong>
                            <div class="row">

                                <embed src="{{ asset('admin/subscriber/video/'.$subscriber->video) }}" width="150px;"
                                    height="93px;" />
                                <!-- <img src="{{ asset('admin/subscriber/video/'.$subscriber->video) }}" width="150px;"
                                    height="93px;" alt="{{ $subscriber->name }}" class="avatar-img "> -->

                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div> <!-- end section -->
        </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->


@endsection
@section('scripts')
<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
$('#subscriptionDate').change(function() {
    var date_input = document.getElementById("subscriptionDate").value;
    var myDate = new Date(date_input);
    var future = myDate.setDate(myDate.getDate() + 30);
    var f1 = new Date(future);
    var exp = f1.toLocaleDateString("id-ID");
    var aa = exp.split('/').join('-');
    // var d = new Date(exp);
    // console.log(d.getDate())
    // exp1 = [d.getDate(), d.getMonth() + 1, d.getFullYear()].join('-');
    document.getElementById("expiryDate").value = aa;
    //console.log(f1.toLocaleDateString("id-ID"));
})
</script>
@endsection
