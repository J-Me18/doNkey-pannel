@extends('layouts.master')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- In the <head> section of your layout file -->
    <!-- jQuery CDN link -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employees Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Employee</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- <div class="row p-3">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <input type="text" name="" id="searchinput" class="form-control" placeholder="search">
        </div>
    </div> --}}
    <div id="dataContainer">
        <table class="table datatables" id="dataTable-1">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name & Employee Id</th>
                    <th>Company Mail</th>
                    <th>Company Mobile</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $key => $employee)
             
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->name . ' & ' . $employee->emp_id }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->mobile }}</td>
                      <td>{{ optional($employee->roles->first())->name }}</td>


                        <td>
                            <a href="{{ route('users.show', $employee->id) }}"><span
                                    class="fe fe-24 fe-eye text-warning"></span></a>
                            {{-- @can('employee-edit') --}}
                            <a href="{{ route('users.edit', $employee->id) }}"><span
                                    class="fe fe-24 fe-edit text-success"></span></a>
                            {{-- @endcan --}}


                          

<form id="delete-form-{{ $employee->id }}" action="{{ route('users.destroy', $employee->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this User?')) { document.getElementById('delete-form-{{ $employee->id }}').submit(); }">
    <span class="fe fe-24 fe-trash text-danger"></span>
</a>




                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- {!! $data->render() !!} --}}

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
