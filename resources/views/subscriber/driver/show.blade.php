@extends('layouts.submaster')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Driver - {{ $driver->name }}({{ $driver->id }})</h2>
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <h4 class="mb-1">{{ $driver->name }}</h4>
                        <p class="small mb-3">Location : <span
                                class="badge badge-dark">{{ ucfirst($driver->location) }}</span></p>
                        {{-- <div class="avatar avatar-xl">
                   </div> --}}
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-7">


                            </div>
                        </div>
                        <div class="row mb-4">

                            <div class="col">
                                <h6 class="text-danger">Personal Details </h6>
                                <p class="small mb-0 text-muted">Mobile : {{ $driver->mobile }}</p>
                                <p class="small mb-0 text-muted">Email : {{ $driver->email }}</p>
                                <p class="small mb-0 text-muted">Gender : {{ $user[0]->gender }}</p>
                                <p class="small mb-0 text-muted">Date Of Birth: {{ $user[0]->dop }}</p>

                                <p class="small mb-0 text-muted">Language : {{ $driver->language }}</p>
                                <p class="small mb-0 text-muted">Aadhar : {{ $driver->aadharNo }}</p>

                                <p class="small mb-0 text-muted">Account No : {{ $driver->bankacno }}</p>
                                <p class="small mb-0 text-muted">IFSC code : {{ $driver->ifsccode }}</p>



                            </div>
                            <div class="col-md-4">
                                <h6 class="text-danger">Vehicle Details </h6>
                                <p class="small mb-0 text-muted">Vehicle No : {{ $driver->vehicleNo }}</p>

                                <p class="small mb-0 text-muted">Vehicle Model : {{ $driver->vehicleModelNo }}</p>
                                <p class="small mb-0 text-muted">Licence Expiry : {{ $driver->licenceexpiry }}</p>


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
                            <p class="small mb-0 text-muted"> {{ $driver->description }}</p>
                        </div>

                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow">
                            <div class="card-body my-n3">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-lg bg-light">
                                            <i class="fe fe-user fe-24 text-primary"></i>
                                        </span>
                                    </div> <!-- .col -->
                                    <div class="col">

                                        <h3 class="h5 mt-4 mb-1">Aadhar Front Image</h3>

                                        <embed src="{{ asset('subscriber/driver/aadhar/' . $driver->aadharFrontImage) }}"
                                            width="100%;" height="150px;" alt="{{ $driver->name }}" class="avatar-img ">
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
                                        <span class="circle circle-lg bg-light">
                                            <i class="fe fe-user fe-24 text-primary"></i>
                                        </span>
                                    </div> <!-- .col -->
                                    <div class="col">

                                        <h3 class="h5 mt-4 mb-1">Aadhar Back Image</h3>

                                        <embed
                                            src="{{ asset('subscriber/driver/aadhar/back/' . $driver->aadharBackImage) }}"
                                            width="100%;" height="150px;" alt="{{ $driver->name }}" class="avatar-img ">
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
                                        <span class="circle circle-lg bg-light">
                                            <i class="fe fe-info fe-24 text-primary"></i>
                                        </span>
                                    </div> <!-- .col -->
                                    <div class="col">

                                        <h3 class="h5 mt-4 mb-1">Driving Licence Image</h3>

                                        <p class="text-muted"><embed
                                                src="{{ asset('subscriber/driver/drivingLicence/' . $driver->drivingLicence) }}"
                                                width="100%;" height="150px;" alt="{{ $driver->name }}"
                                                class="avatar-img ">
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

                                        <h3 class="h5 mt-4 mb-1">Rcbook Image</h3>

                                        <p class="text-muted"><embed
                                                src="{{ asset('subscriber/driver/rcbook/' . $driver->rcbook) }}"
                                                width="100%;" height="150px;" alt="{{ $driver->name }}"
                                                class="avatar-img ">
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

                                        <h3 class="h5 mt-4 mb-1">Insurance Image</h3>

                                        <p class="text-muted"><embed
                                                src="{{ asset('subscriber/driver/insurance/' . $driver->insurance) }}"
                                                width="100%;" height="150px;" alt="{{ $driver->name }}"
                                                class="avatar-img ">
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

                                        <h3 class="h5 mt-4 mb-1">Bike Image</h3>

                                        <p class="text-muted"><embed
                                                src="{{ asset('subscriber/driver/bike/' . $driver->bike) }}"
                                                width="100%;" height="150px;" alt="{{ $driver->name }}"
                                                class="avatar-img ">
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
                                                src="{{ asset('subscriber/driver/document/' . $driver->customerdocument) }}"
                                                width="100%;" height="150px;" alt="{{ $driver->name }}"
                                                class="avatar-img ">
                                    </div> <!-- .col -->
                                </div> <!-- .row -->
                            </div> <!-- .card-body -->

                        </div> <!-- .card -->
                    </div> <!-- .col-md-->

                </div> <!-- .row-->


            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <div class="row">
        <!-- table -->
        <div class="col-12">
            <table class="table datatables" id="dataTable-1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Comments</th>
                        <th>Timestamp</th>
                        <th>Updated By</th>
                        <!-- <p style="font-size:8px !important">(Admin/SubscriberId)</p> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    {{-- {{ dd($notification) }} --}}

                    @foreach ($notification as $notification)
                        <tr>


                            <td>{{ $i }}</td>
                            <td>{{ $notification->message }}</td>
                            <td>
                                <!-- {{ $notification->created_at }} -->
                                {{ date_format(date_create($notification->created_at), 'd/m/Y h:i:s') }}
                            </td>
                            {{-- <td>{{ App\Models\Employee::where('id', $notification->modifiedBy)->first()?->emp_id }}</td> --}}

                            <?php $r = explode(',', $notification->modifiedBy); ?>
                            @if ($r[0] != 'Admin')         
                                    @php
                                    $subMail = App\Models\Subscriber::where('id',$notification->modifiedBy)->first()->email
                                    @endphp
                                        <td>{{ App\Models\Employee::where('email', $subMail)->first()->emp_id }}
                                        </td>                          
                            @else
                                <td>Employee
                                </td>
                            @endif

                        </tr>

                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
    <script src="https://technext.github.io/tinydash/js/jquery.dataTables.min.js"></script>
    <script src='https://technext.github.io/tinydash/js/dataTables.bootstrap4.min.js'></script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
@endsection
