@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Subscriber - {{ $subscriber->name }}(<span class="">
                        {{ $subscriber->subscriberId }}</span>)</h2>
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('public/admin/subscriber/profile/' . $subscriber->image) }}"
                                alt="{{ $subscriber->name }}" height="110px;" class="avatar-img rounded-circle">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-7">

                                <h4 class="mb-1">{{ $subscriber->name }}</h4>
                                <p class="small mb-3"><span
                                        class="badge badge-dark">{{ ucfirst($subscriber->location) }}</span></p>
                            </div>
                        </div>
                        <div class="row mb-4">

                            <div class="col">
                                <p class="small mb-0 text-muted">Mobile : {{ $subscriber->mobile }}</p>
                                <p class="small mb-0 text-muted">Email : {{ $subscriber->email }}</p>
                                <p class="small mb-0 text-muted">Aadhar : {{ $subscriber->aadharNo }}</p>

                                <p class="small mb-0 text-muted">Account No : {{ $subscriber->bankacno }}</p>
                                <p class="small mb-0 text-muted">IFSC code : {{ $subscriber->ifsccode }}</p>
                                <p class="small mb-0 text-muted">Account Type :
                                    {{ $subscriber->account_type ? $subscriber->account_type : '-' }}</p>




                            </div>
                            <div class="col-md-4">
                                <h6 class="text-danger"> Subscription Details </h6>
                                <p class="small mb-0 text-muted">Subscription Date : {{ $subscriber->subscriptionDate }}
                                </p>

                                <p class="small mb-0 text-muted">Expiry Date : {{ $subscriber->expiryDate }}</p>

                                <p class="small mb-0 text-muted">Subscription Price : {{ $subscriber->subscription_price }}
                                </p>

                            </div>
                            <div class="col-md-3">
                                <h6 class="text-danger"> Pincode </h6>
                                <p class="text-muted">
                                    @foreach ($pincode as $data)
                                        {{ $data->pincode }} &nbsp;
                                    @endforeach
                                </p>
                            </div>



                        </div>
                        <div class="row">
                            <h6 class="text-danger"> Address </h6>
                            <p class="small mb-0 text-muted"> {{ $subscriber->description }}</p>
                        </div>
                        <div class="row">
                            <h6 class="col-md-12 text-danger"> Price List </h6>


                            <div class="col-md-4">
                                <h6>Biketaxi price </h6>
                                <p class="small mb-0 text-muted">Service price : ₹{{ $subscriber->biketaxi_price }}</p>
                                <p class="small mb-0 text-muted"> (0 to 5 km): ₹{{ $subscriber->bt_price1 }}</p>
                                <p class="small mb-0 text-muted"> (5 to 8 km): ₹{{ $subscriber->bt_price2 }}</p>
                                <p class="small mb-0 text-muted"> (8 to 10 km): ₹{{ $subscriber->bt_price3 }}</p>
                                <p class="small mb-0 text-muted"> (above 10 km): ₹{{ $subscriber->bt_price4 }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6>Pickup price</h6>
                                <p class="small mb-0 text-muted">Service price : ₹{{ $subscriber->pickup_price }}</p>
                                <p class="small mb-0 text-muted"> (0 to 5 km): ₹{{ $subscriber->pk_price1 }}</p>
                                <p class="small mb-0 text-muted"> (5 to 8 km): ₹{{ $subscriber->pk_price2 }}</p>
                                <p class="small mb-0 text-muted"> (8 to 10 km): ₹{{ $subscriber->pk_price3 }}</p>
                                <p class="small mb-0 text-muted"> (above 10 km): ₹{{ $subscriber->pk_price4 }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6>Buy and Delivery price</h6>
                                <p class="small mb-0 text-muted">Service price : ₹{{ $subscriber->buy_price }}</p>

                                <p class="small mb-0 text-muted"> (0 to 5 km): ₹{{ $subscriber->bd_price1 }}</p>
                                <p class="small mb-0 text-muted"> (5 to 8 km): ₹{{ $subscriber->bd_price2 }}</p>
                                <p class="small mb-0 text-muted"> (8 to 10 km): ₹{{ $subscriber->bd_price3 }}</p>
                                <p class="small mb-0 text-muted"> (above 10 km): ₹{{ $subscriber->bd_price4 }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow">
                            <div class="card-body my-n3">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <a href="{{ asset('public/admin/subscriber/aadhar/' . $subscriber->aadharImage) }}"
                                            target="_blank" download><span class="circle circle-lg bg-light">
                                                <i class="fe fe-download fe-24 text-primary"></i>

                                            </span></a>
                                    </div> <!-- .col -->
                                    <div class="col">

                                        <h3 class="h5 mt-4 mb-1">Aadhar Front Image</h3>
                                        <embed
                                            src="{{ asset('public/admin/subscriber/aadhar/' . $subscriber->aadharImage) }}"
                                            width="100%;" height="150px;" alt="{{ $subscriber->name }}"
                                            class="avatar-img ">
                                        <!-- <img src="{{ asset('public/admin/subscriber/aadhar/' . $subscriber->aadharImage) }}"
                                                width="100%;" height="150px;" alt="{{ $subscriber->name }}" class="avatar-img "> -->

                                    </div> <!-- .col -->
                                </div> <!-- .row -->
                            </div> <!-- .card-body -->
                            <!-- .card-footer -->
                        </div> <!-- .card -->
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow">
                            <div class="card-body my-n3">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <a href="{{ asset('public/admin/subscriber/aadhar/back/' . $subscriber->aadharBackImage) }}"
                                            target="_blank" download><span class="circle circle-lg bg-light">
                                                <i class="fe fe-download fe-24 text-primary"></i>
                                            </span></a>
                                    </div> <!-- .col -->
                                    <div class="col">

                                        <h3 class="h5 mt-4 mb-1">Aadhar Back Image</h3>
                                        <embed
                                            src="{{ asset('public/admin/subscriber/aadhar/back/' . $subscriber->aadharBackImage) }}"
                                            width="100%;" height="150px;" alt="{{ $subscriber->name }}"
                                            class="avatar-img ">
                                        <!-- <img src="{{ asset('public/admin/subscriber/aadhar/back/' . $subscriber->aadharBackImage) }}"
                                                width="100%;" height="150px;" alt="{{ $subscriber->name }}" class="avatar-img "> -->
                                    </div> <!-- .col -->
                                </div> <!-- .row -->
                            </div> <!-- .card-body -->
                            <!-- .card-footer -->
                        </div> <!-- .card -->
                    </div><!-- .col-md-->
                    <div class="col-md-4">
                        <div class="card mb-4 shadow">
                            <div class="card-body my-n3">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <a href="{{ asset('public/admin/subscriber/pan/' . $subscriber->pancardImage) }}"
                                            target="_blank" download> <span class="circle circle-lg bg-light">
                                                <i class="fe fe-download fe-24 text-primary"></i>
                                            </span></a>
                                    </div> <!-- .col -->
                                    <div class="col">

                                        <h3 class="h5 mt-4 mb-1">Pancard Image</h3>

                                        <p class="text-muted">
                                            <embed
                                                src="{{ asset('public/admin/subscriber/pan/' . $subscriber->pancardImage) }}"
                                                width="100%;" height="150px;" alt="{{ $subscriber->name }}"
                                                class="avatar-img ">
                                            <!-- <img src="{{ asset('public/admin/subscriber/pan/' . $subscriber->pancardImage) }}"
                                                    width="100%;" height="150px;" alt="{{ $subscriber->name }}"
                                                    class="avatar-img "> -->
                                    </div> <!-- .col -->
                                </div> <!-- .row -->
                            </div> <!-- .card-body -->

                        </div> <!-- .card -->
                    </div> <!-- .col-md-->
                    <div class="col-md-4">
                        <div class="card mb-4 shadow">
                            <div class="card-body my-n3">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-lg bg-light">
                                            <i class="fe fe-info fe-24 text-primary"></i>
                                        </span>
                                    </div> <!-- .col -->
                                    <div class="col">

                                        <h3 class="h5 mt-4 mb-1">Document</h3>

                                        <p class="text-muted"><embed
                                                src="{{ asset('public/admin/subscriber/document/' . $subscriber->customerdocument) }}"
                                                width="100%;" height="150px;" alt="{{ $subscriber->name }}"
                                                class="avatar-img ">
                                    </div> <!-- .col -->
                                </div> <!-- .row -->
                            </div> <!-- .card-body -->

                        </div> <!-- .card -->
                    </div> <!-- .col-md-->
                    <div class="col-md-12">
                        <div class="card mb-4 shadow">
                            <div class="card-body my-n3">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-lg bg-light">
                                            <i class="fe fe-trello fe-24 text-primary"></i>
                                        </span>
                                    </div> <!-- .col -->
                                    <div class="col">

                                        <h3 class="h5 mt-4 mb-1">Bank Statement</h3>

                                        <embed
                                            src="{{ asset('public/admin/subscriber/bankstatement/' . $subscriber->bankstatement) }}"
                                            width="100%" height="290px" />

                                    </div> <!-- .col -->
                                </div> <!-- .row -->
                            </div> <!-- .card-body -->

                        </div> <!-- .card -->
                    </div> <!-- .col-md-->
                    @if ($subscriber->video != '')
                        <div class="col-md-12">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-lg bg-light">
                                                <!-- <i class="fe fe-trello fe-24 text-primary"></i> -->
                                                <a target="_blank" download
                                                    href="{{ asset('public/admin/subscriber/video/' . $subscriber->video) }}">
                                                    <i class="fe fe-download fe-24 text-primary ml-3"></i>
                                                </a>

                                            </span>
                                            <span class="circle circle-lg bg-light">
                                                <!-- <i class="fe fe-trello fe-24 text-primary"></i> -->
                                                <!-- <a target="_blank" download
                                                    href="{{ asset('public/admin/subscriber/video/' . $subscriber->video) }}">
                                                    <i class="fe fe-download fe-24 text-primary ml-3"></i>
                                                </a> -->
                                                <a href="{{ url('deletesubscribervideo/' . $subscriber->id) }}">
                                                    <i class="fe fe-trash fe-24 text-danger ml-3"></i>
                                                </a>
                                            </span>
                                        </div> <!-- .col -->
                                        <div class="col">

                                            <h3 class="h5 mt-4 mb-1">Video</h3>

                                            <embed
                                                src="{{ asset('public/admin/subscriber/video/' . $subscriber->video) }}"
                                                width="100%" height="290px" />

                                        </div> <!-- .col -->
                                    </div> <!-- .row -->
                                </div> <!-- .card-body -->

                            </div> <!-- .card -->
                        </div> <!-- .col-md-->
                    @endif
                </div> <!-- .row-->

                <div class="row p-3">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <input type="text" name="" id="searchinput" class="form-control"
                            placeholder="search">
                    </div>
                </div>
                <div class="row table-responsive">
                    <!-- table -->
                    <table class="table datatables" id="">
                        <thead>
                            <tr>

                                <th>S.No</th>
                                <th>Modification</th>
                                <th>Comments</th>

                                <th>Timestamp</th>
                                <th>Updated By
                                </th>

                            </tr>
                        </thead>
                        <tbody id="searchtable">
                            <?php $i = 1; ?>
                            @foreach ($pricenotify as $notification)
                                <tr>


                                    <td>{{ $i }}</td>
                                    <td width="400px">{{ $notification->datas }}</td>
                                    <td>{{ $notification->message }}</td>
                                    <td>
                                        <!-- {{ $notification->created_at }} -->
                                        {{ date_format(date_create($notification->created_at), 'd/m/Y') }}-{{ date_format(date_create($notification->created_at), ' H:i:s') }}
                                    </td>

                                    @foreach ($admin as $ss)
                                        @if ($notification->modifiedBy == $ss->id)
                                            <td>{{ $ss->name }}-({{ $ss->id }})</td>
                                        @endif
                                    @endforeach



                                </tr>

                                <?php $i++; ?>
                            @endforeach
                            @foreach ($statusnotify as $ssn)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td width="400px">{{ $ssn->datas }} </td>
                                    <td>{{ $ssn->message }}</td>
                                    <td>

                                        {{ date_format(date_create($ssn->created_at), 'd/m/Y') }}-
                                        {{ date_format(date_create($ssn->created_at), ' H:i:s') }}
                                    </td>

                                    <td>
                                        @if ($ssn->modifiedBy == 'Payment Due ')
                                            {{ __('Auto Off Due To Payment Due') }}
                                        @else
                                            @foreach ($admin as $ss)
                                                @if ($ssn->modifiedBy == $ss->id)
                                                    {{ $ss->name }}-({{ $ss->id }})
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    <!-- {{ $ssn->modifiedBy == 'Payment Due' ? 'Auto Off Due To Payment Due' : $ssn->modifiedBy }} -->
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>

                </div>


            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
