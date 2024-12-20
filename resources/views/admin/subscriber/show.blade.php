@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <script src="https://cdn.datatables.net/searchpanes/1.2.1/js/dataTables.searchPanes.min.js"></script>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('subscriber') }}"> Back</a>
            </div>
            <h2 class="h3 mb-4 page-title">Subscriber - {{ $subscriber->name }}&nbsp;
                    ({{ $subscriber->subscriberId }})</h2>
            <div class="row mt-5 align-items-center">
                <div class="col-md-3 text-center mb-5">
                    <div class="avatar avatar-xl">
                        <img src="{{ asset('public/admin/subscriber/profile/' . $subscriber->image) }}" alt="{{ $subscriber->name }}" height="110px;" class="avatar-img rounded-circle">
                    </div>
                </div>
                <div class="col">
                    <div class="row align-items-center">
                        <div class="col-md-7">

                            <h4 class="mb-1">{{ $subscriber->name }}</h4>
                            <p class="small mb-3"><span class="badge badge-dark">{{ ucfirst($subscriber->location) }}</span></p>
                        </div>
                    </div>
                    <div class="row mb-4">

                        <div class="col">
                        <p class="small mb-0 text-muted">Employee Id : {{ $empolyee_id }}</p>
                            <p class="small mb-0 text-muted">Mobile : {{ $subscriber->mobile }}</p>
                            <p class="small mb-0 text-muted">Email : {{ $subscriber->email }}</p>
                            <p class="small mb-0 text-muted">Aadhar : {{ $subscriber->aadharNo }}</p>

                            <p class="small mb-0 text-muted">Account No : {{ $subscriber->bankacno }}</p>
                            <p class="small mb-0 text-muted">IFSC code : {{ $subscriber->ifsccode }}</p>
                            <p class="small mb-0 text-muted">Account Type :
                                {{ $subscriber->account_type ? $subscriber->account_type : '-' }}
                            </p>




                        </div>
                        <div class="col-md-4">
                            <h6 class="text-danger"> Subscription Details </h6>
                            <p class="small mb-0 text-muted">Subscription Date : {{ $subscriber->subscriptionDate->format('d-m-Y h:i:s') }}
                            </p>

                            <p class="small mb-0 text-muted">Expiry Date : {{ $subscriber->expiryDate->format('d-m-Y h:i:s') }}</p>

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


                        <div class="col-md-3">
                            <h6>Biketaxi price </h6>
                            <p class="small mb-0 text-muted">Service price : ₹{{ $subscriber->biketaxi_price }}</p>
                            <p class="small mb-0 text-muted"> (0 to 5 km): ₹{{ $subscriber->bt_price1 }}</p>
                            <p class="small mb-0 text-muted"> (5 to 8 km): ₹{{ $subscriber->bt_price2 }}</p>
                            <p class="small mb-0 text-muted"> (8 to 10 km): ₹{{ $subscriber->bt_price3 }}</p>
                            <p class="small mb-0 text-muted"> (above 10 km): ₹{{ $subscriber->bt_price4 }}</p>
                        </div>
                        <div class="col-md-3">
                            <h6>Pickup price</h6>
                            <p class="small mb-0 text-muted">Service price : ₹{{ $subscriber->pickup_price }}</p>
                            <p class="small mb-0 text-muted"> (0 to 5 km): ₹{{ $subscriber->pk_price1 }}</p>
                            <p class="small mb-0 text-muted"> (5 to 8 km): ₹{{ $subscriber->pk_price2 }}</p>
                            <p class="small mb-0 text-muted"> (8 to 10 km): ₹{{ $subscriber->pk_price3 }}</p>
                            <p class="small mb-0 text-muted"> (above 10 km): ₹{{ $subscriber->pk_price4 }}</p>
                        </div>
                        <div class="col-md-3">
                            <h6>Buy and Delivery price</h6>
                            <p class="small mb-0 text-muted">Service price : ₹{{ $subscriber->buy_price }}</p>

                            <p class="small mb-0 text-muted"> (0 to 5 km): ₹{{ $subscriber->bd_price1 }}</p>
                            <p class="small mb-0 text-muted"> (5 to 8 km): ₹{{ $subscriber->bd_price2 }}</p>
                            <p class="small mb-0 text-muted"> (8 to 10 km): ₹{{ $subscriber->bd_price3 }}</p>
                            <p class="small mb-0 text-muted"> (above 10 km): ₹{{ $subscriber->bd_price4 }}</p>
                        </div>
                        <div class="col-md-3">
                            <h6>Auto price</h6>
                            <p class="small mb-0 text-muted">Service price : ₹{{ $subscriber->auto_price }}</p>

                            <p class="small mb-0 text-muted"> (0 to 5 km): ₹{{ $subscriber->at_price1 }}</p>
                            <p class="small mb-0 text-muted"> (5 to 8 km): ₹{{ $subscriber->at_price2 }}</p>
                            <p class="small mb-0 text-muted"> (8 to 10 km): ₹{{ $subscriber->at_price3 }}</p>
                            <p class="small mb-0 text-muted"> (above 10 km): ₹{{ $subscriber->at_price4 }}</p>
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
                                    <a href="{{ asset('public/admin/subscriber/aadhar/' . $subscriber->aadharImage) }}" target="_blank" download><span class="circle circle-lg bg-light">
                                            <i class="fe fe-download fe-24 text-primary"></i>

                                        </span></a>
                                </div> <!-- .col -->
                                <div class="col">

                                    <h3 class="h5 mt-4 mb-1">Aadhar Front Image</h3>
                                    <embed src="{{ asset('public/admin/subscriber/aadhar/' . $subscriber->aadharImage) }}" width="100%;" height="150px;" alt="{{ $subscriber->name }}" class="avatar-img ">
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
                                    <a href="{{ asset('public/admin/subscriber/aadhar/back/' . $subscriber->aadharBackImage) }}" target="_blank" download><span class="circle circle-lg bg-light">
                                            <i class="fe fe-download fe-24 text-primary"></i>
                                        </span></a>
                                </div> <!-- .col -->
                                <div class="col">

                                    <h3 class="h5 mt-4 mb-1">Aadhar Back Image</h3>
                                    <embed src="{{ asset('public/admin/subscriber/aadhar/back/' . $subscriber->aadharBackImage) }}" width="100%;" height="150px;" alt="{{ $subscriber->name }}" class="avatar-img ">
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
                                    <a href="{{ asset('public/admin/subscriber/pan/' . $subscriber->pancardImage) }}" target="_blank" download> <span class="circle circle-lg bg-light">
                                            <i class="fe fe-download fe-24 text-primary"></i>
                                        </span></a>
                                </div> <!-- .col -->
                                <div class="col">

                                    <h3 class="h5 mt-4 mb-1">Pancard Image</h3>

                                    <p class="text-muted">
                                        <embed src="{{ asset('public/admin/subscriber/pan/' . $subscriber->pancardImage) }}" width="100%;" height="150px;" alt="{{ $subscriber->name }}" class="avatar-img ">
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
                                 <a href="{{ asset('public/admin/subscriber/document/' . $subscriber->customerdocument) }}" target="_blank" download> <span class="circle circle-lg bg-light">
                                    <span class="circle circle-lg bg-light">
                                      <i class="fe fe-download fe-24 text-primary"></i>
                                    </span></a>
                                </div> <!-- .col -->
                                <div class="col">

                                    <h3 class="h5 mt-4 mb-1">Document</h3>

                                    <p class="text-muted"><embed src="{{ asset('public/admin/subscriber/document/' . $subscriber->customerdocument) }}" width="100%;" height="150px;" alt="{{ $subscriber->name }}" class="avatar-img " >
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

                                    <embed src="{{ asset('public/admin/subscriber/bankstatement/' . $subscriber->bankstatement) }}" width="100%" height="290px" />

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
                                        <a target="_blank" download href="{{ asset('public/admin/subscriber/video/' . $subscriber->video) }}">
                                            <i class="fe fe-download fe-24 text-primary ml-3"></i>
                                        </a>

                                    </span>
                                    <span class="circle circle-lg bg-light">
                                        <!-- <i class="fe fe-trello fe-24 text-primary"></i> -->
                                        <!-- <a target="_blank" download
                                                            href="{{ asset('public/admin/subscriber/video/' . $subscriber->video) }}">
                                                            <i class="fe fe-download fe-24 text-primary ml-3"></i>
                                                        </a> -->
                                        @can('Video delete')
                                        <a href="{{ url('deletesubscribervideo/' . $subscriber->id) }}">
                                            <i class="fe fe-trash fe-24 text-danger ml-3"></i>
                                        </a>
                                        @endcan
                                    </span>
                                </div> <!-- .col -->

                                <div class="col">

                                    <h3 class="h5 mt-4 mb-1">Video</h3>

                                    <embed src="{{ asset('public/admin/subscriber/video/' . $subscriber->video) }}" width="100%" height="290px" />

                                </div> <!-- .col -->


                            </div> <!-- .row -->
                        </div> <!-- .card-body -->

                    </div> <!-- .card -->
                </div> <!-- .col-md-->
                @endif
            </div> <!-- .row-->

            <!-- <div class="row p-3">
                <div class="col-md-8"></div>
                {{-- <div class="col-md-4">
                        <input type="text" name="" id="searchinput" class="form-control"
                            placeholder="search">
                    </div> --}}
            </div> -->
        </div> <!-- /.col-12 -->
    </div> <!-- .row -->
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Modification</th>
                            <th>Comments</th>
                            <th>Timestamp</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>                        
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
                                {{ App\Models\Admin::where('id',$ss->id)->first()->emp_id }}
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
        </div>
    </div>

    <script src="https://technext.github.io/tinydash/js/jquery.dataTables.min.js"></script>
    <script src="https://technext.github.io/tinydash/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable-1').DataTable({
                autoWidth: true,
                lengthMenu: [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ]
            });
        });
    </script>
    @endsection
