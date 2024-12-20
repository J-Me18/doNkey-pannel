@extends('layouts.submaster')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Employee - {{ $employee->name }}({{ $employee->emp_id }})</h2>
                <div class="row mt-5 align-items-center">
                    {{-- <div class="col-md-3 text-center mb-5">
                        <h4 class="mb-1">{{ $driver->name }}</h4>
                        <p class="small mb-3">Location : <span
                                class="badge badge-dark">{{ ucfirst($driver->location) }}</span></p>
                        
                    </div> --}}
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-7">


                            </div>
                        </div>
                        <div class="row mb-4">

                            <div class="col">
                                <h6 class="text-danger">Employee Details </h6>
                                <p class="small mb-0 text-muted">Education : {{ $employee->education }}</p>
                                <p class="small mb-0 text-muted">Blood Group : {{ $employee->blood_group }}</p>

                                <p class="small mb-0 text-muted">Mobile : {{ $employee->mobile }}</p>
                                <p class="small mb-0 text-muted">Official Mobile : {{ $employee->official_mobile }}</p>

                                <p class="small mb-0 text-muted">Email : {{ $employee->email }}</p>
                                <p class="small mb-0 text-muted">Official Email : {{ $employee->official_mail}}</p>

                                <p class="small mb-0 text-muted">Gender : {{ $employee->gender }}</p>
                                <p class="small mb-0 text-muted">Joining Date: {{ $employee->joining_date->format('d-m-Y') }}</p>

                                <p class="small mb-0 text-muted">PAN : {{ $employee->pan }}</p>
                                <p class="small mb-0 text-muted">Aadhar : {{ $employee->aadhar }}</p>

                                <p class="small mb-0 text-muted">Address : {{ $employee->address }}</p>
                                <p class="small mb-0 text-muted">Current Address : {{ $employee->current_address }}</p>


                            </div>


                        </div>


                    </div> <!-- /.col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
        @endsection
