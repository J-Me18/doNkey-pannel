@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Employee Details</h2>
                    </div>
                    {{-- {{ dd($Complaint); }} --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roles">Role:</label>
                                    @if (!empty($Complaint->getRoleNames()))
                                        <div>
                                            @foreach ($Complaint->getRoleNames() as $v)
                                                <span class="badge badge-success">{{ $v }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="badge badge-secondary">No Roles Assigned</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" value="{{ $Complaint->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emp_id">Employee Id:</label>
                                    <input type="email" class="form-control" value="{{ $Complaint?->emp_id }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile:</label>
                                    <input type="text" class="form-control" value="{{ $Complaint->mobile }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" value="{{ $Complaint->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="education">Education:</label>
                                    <input type="text" class="form-control" value="{{ $Complaint->education }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <input type="text" class="form-control" value="{{ $Complaint->gender }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profile">Profile Image:</label>
                                    <img src="{{ asset('public/admin/admin/profile/') }}/{{ $Complaint->profile }}"
                                        style="width: 40%" height="40%">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="roles">Role:</label>
                                    @if (!empty($Complaint->getRoleNames()))
                                        <div>
                                            @foreach ($Complaint->getRoleNames() as $v)
                                                <span class="badge badge-success">{{ $v }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="badge badge-secondary">No Roles Assigned</span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-primary" href="{{ route('complaints.index') }}">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
