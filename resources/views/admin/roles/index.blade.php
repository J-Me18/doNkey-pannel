@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
            @can('role-create')
                <a class="btn btn-success" href="{{ route('role.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table datatables" id="dataTable-1">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('role.show', $role->id) }}">Show</a>
                    @can('role-edit')
                    <a class="btn btn-primary" href="{{ route('role.edit', $role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                    {!! Form::open(['method' => 'DELETE', 'route' => ['role.destroy', $role->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endcan

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="https://technext.github.io/tinydash/js/jquery.dataTables.min.js"></script>
<script src='https://technext.github.io/tinydash/js/dataTables.bootstrap4.min.js'></script>
<script>
    $(document).ready(function() {
        $('#dataTable-1').DataTable({
            autoWidth: true,
            lengthMenu: [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ],
            searching: true, // Enable search bar
            paging: true // Enable pagination
        });
    });
</script>
@endsection
