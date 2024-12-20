@extends('layouts.master')
@section('content')

<style>
        .firstrow {
            color: #0a335c !important;
        }

        .secondrow {
            color: #1a1a2c !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card card-fill timeline">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('complaints.index') }}"> Back</a>
                    </div>
                    <div class="card-header">
                        <h5 class="text-center "><strong class="text-danger">COMPLAINT DETAILS -
                                [{{ $complaints->complaintID }} ]</strong></h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped  table-bordered ">

                            <tbody>
                                <tr class="table-secondary">
                                    <td class="text-center " style="color:black;"> <strong class="firstrow">Name </strong></td>
                                    <td><span class="secondrow"  style="color:black;">{{ $complaints->name }} </span> </td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center "><strong class="firstrow"> Email ID</strong></td>
                                    <td><span class="secondrow"> {{ $complaints->mailId }} </span>
                                    </td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center"><strong class="firstrow"> Mobile</strong> </td>
                                    <td> <span class="secondrow">{{ $complaints->mobile }} </span></td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center"> <strong class="firstrow">Area </strong></td>
                                    <td><span class="secondrow"> {{ $complaints->area }}</span></td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center"><strong class="firstrow"> Category </strong></td>
                                    <td><span class="secondrow"> {{ $complaints->category }}</span></td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center"><strong class="firstrow"> Pincode</strong> </td>
                                    <td><span class="secondrow">


                                            @foreach ($pincode as $pin)
                                                @if (in_array($pin->id, $complaints->pincode))
                                                    {{ $pin->pincode }}
                                                @endif
                                            @endforeach


                                        </span>
                                    </td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center"><strong class="firstrow"> Pirority </strong></td>
                                    <td><span class="secondrow">
                                            @if ($complaints->ficon == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </span>
                                    </td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center"> <strong class="firstrow">Submitted On </strong></td>
                                    <td><span class="secondrow">{{ $complaints->created_at }}</span></td>

                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center"><strong class="firstrow"> Description</strong> </td>
                                    <td><span class="secondrow"> {{ $complaints->description }}</span></td>

                                </tr>
                                <tr class="table-danger">
                                    <td class="text-center"><strong class="firstrow"> Complaints</strong> </td>
                                    <td> <span class="secondrow">{{ $complaints->complaint }}</span></td>

                                </tr>
                                <tr class="table-danger">
                                    <td class="text-center"><strong class="firstrow"> Complained By</strong> </td>
                                    <td> <span class="secondrow">{{ $complaints->complained_by }}</span></td>

                                </tr>

                            </tbody>

                        </table>







                    </div> <!-- / .card-body -->
                </div> <!-- / .card -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
@endsection
@section('scripts')
@endsection
