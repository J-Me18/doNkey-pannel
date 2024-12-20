@extends('layouts.master')
<style>
    .text-light-red {
  color: #fc8585; /* Replace with your desired light red color */
}

.text-light-green {
  color: rgb(90, 217, 90); /* Replace with your desired light gray color */
}

.text-light-blue {
  color: #7dcbfe; /* Replace with your desired light blue color */
}
.text-red{
    color:red;
}
.text-green{
    color: green;
}
.text-blue{
    color:blue;
}
</style>

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Employee Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Profile Image:</strong>
                    <a href="{{ asset('public/admin/admin/profile/') }}/{{ $user->profile }}" download=""><img
                            src="{{ asset('public/admin/admin/profile/') }}/{{ $user->profile }}" width="40%"
                            height="40%">
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Employee ID:</strong>
                    {{ $user->emp_id }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company Mail:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Official Mail:</strong>
                    {{ $user->official_mail }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Gender:</strong>
                    {{ $user->gender }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company Mobile:</strong>
                    {{ $user->mobile }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Official Mobile:</strong>
                    {{ $user->official_mobile }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Eduactional Qualification:</strong>
                    {{ $user->education }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Blood Group:</strong>
                    {{ $user->blood_group }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    {{ $user->address }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Current Address:</strong>
                    {{ $user->current_address }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Aadhar Number:</strong>
                    {{ $user->aadhar }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pan Number:</strong>
                    {{ $user->pan }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Joining date:</strong>
                    {{ $user->joining_date->format('d-m-Y') }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Payment Type:</strong>
                    {{ $user->payment }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Other Document:</strong>
                    {{-- <a href="{{ asset('public/admin/admin/otherDocument/'  ) }}/{{ $user->other }}" download=""><img src="{{ asset('public/admin/admin/otherDocument/'  ) }}/{{ $user->other }}" width="40%" height="40%">
                    </a> </div> --}}
                    <a href="{{ asset('public/admin/admin/otherDocument/') }}/{{ $user->other }}" download="">
                        Click To Download Document
                    </a>
                </div>
            </div>
        </div>
        @php
    $theme = 'dark'; // Replace with the actual variable or logic determining the theme
@endphp
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Performance</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <h6 class="card-title"><strong>Subscriber Count</strong></h6>
                                    <p class="card-text {{ $theme == 'dark' ? 'text-light-green' : 'text-green' }}">{{ $subscriberCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-6">
                                <div class="card-body text-center">
                                    <h6 class="card-title"><strong>Complaint Taken</strong></h6>
                                    <p class="card-text {{ $theme == 'dark' ? 'text-light-red' : 'text-red' }}">{{ $complaintTakenCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-6">
                                <div class="card-body text-center">
                                    <h6 class="card-title"><strong>Complaint Solved</strong></h6>
                                    <p class="card-text {{ $theme == 'dark' ? 'text-light-blue' : 'text-blue' }}">{{ $complaintsolvedCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

