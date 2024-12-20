@extends('layouts.master')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <h2 class="mb-2 page-title">Pricing List</h2>

                <div class="col ml-auto">
                    <div class="dropdown float-right">
                    @can('pricing-create')
                        <a href="{{ route('excelpincode.create') }}">
                            <button class="btn btn-primary float-right ml-3" type="button">Add more +</button>
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            @if(Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif

            @if(Session::has('error'))
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                    <strong>Error:</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif
<style>
  
   
</style>


<div class="row my-4">
    <!-- Small table -->
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
            <form method="GET" class="search-form form-inline"
                action="">

                <div class="form-group for pl-3">
                    <label class="mr-2">Search:</label>
                    <input value="{{ request('search') }}" type="text" class="form-control"
                        name="search" autocomplete="off" placeholder="Search..." min="" />
                </div>

                <div class="form-group pl-3">
                    <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i
                            class="fa fa-search "></i></button>
                    <a class="btn btn-danger m-btn m-btn--air m-btn--custom"
                        href="{{ route('excelpincode.index') }}"><i class="fa fa-times"></i></a>
                </div>
                </form>
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Circular Name</th>
                            <th>Region Name</th>
                            <th>District</th>
                            <th>Pincode</th>
                            <th>State Name</th>
                            <th>Tier</th>
                            @canany(['pricing-edit','pricing-destroy'])
                            <th>Action</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($excelPincodes as $excelPincode)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $excelPincode->circlename }}</td>
                                <td>{{ $excelPincode->regionname }}</td>
                                <td>{{ $excelPincode->district }}</td>
                                <td>{{ $excelPincode->pincode }}</td>
                                <td>{{ $excelPincode->statename }}</td>
                                <td>{{ $excelPincode->tier }}</td>
                                <td>
                                 <!--   <a href="{{ route('excelpincode.show', $excelPincode->id) }}">
                                        <span class="fe fe-24 fe-eye text-warning"></span>
                                    </a>-->
                                    @can('pricing-edit')
                                    <a href="{{ route('excelpincode.edit', $excelPincode->id) }}">
                                        <span class="fe fe-24 fe-edit text-success"></span>
                                    </a>
                                    @endcan
                                    @can('pricing-destroy')
                                    <form action="{{ route('excelpincode.destroy', $excelPincode->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none;background:white">
                                            <span class="fe fe-24 fe-trash text-danger"></span>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="custom-pagination"style="height:30px;" >
    {{ $excelPincodes->links() }}
</div>

@endsection

