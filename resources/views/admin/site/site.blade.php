@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h2 class="mb-2 page-title">General Settings</h2>
                    </div>
                    <div class="col-12">
                        <div class="card p-3">
                            <form action="{{ route('updateAppVerision', $site->id) }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="main_logo" class="form-label">Main Logo</label>
                                            <input type="file" id="main_logo" class="form-control" name="main_logo">
                                            <img style="height:50px;width:50px;"
                                                src="{{ url('public/site/' . $site->main_logo) }}" alt="Logo-Img">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="sidebar_logo" class="form-label">Sidebar Logo</label>
                                            <input type="file" id="sidebar_logo" class="form-control"
                                                name="sidebar_logo">
                                            <img style="height:50px;width:50px;"
                                                src="{{ url('public/site/' . $site->sidebar_logo) }}"
                                                alt="Sidebar-Logo-Img">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="sidebar_small_logo" class="form-label">Sidebar Logo
                                                <small>small</small>
                                            </label>
                                            <input type="file" id="sidebar_small_logo" class="form-control"
                                                name="sidebar_small_logo">
                                            <img style="height:50px;width:50px;"
                                                src="{{ url('public/site/' . $site->sidebar_small_logo) }}"
                                                alt="Sidebar-Logo-Img">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="favicon" class="form-label">Favicon
                                            </label>
                                            <input type="file" id="favicon" class="form-control"
                                                name="favicon">
                                            <img style="height:50px;width:50px;"
                                                src="{{ url('public/site/' . $site->favicon) }}"
                                                alt="Sidebar-Logo-Img">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="sitename" class="form-label">Site Name</label>
                                            <input type="text" id="sitename" class="form-control"
                                                placeholder="Site Name" required name="sitename"
                                                value="{{ old('sitename', $site->sitename) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" id="phone" class="form-control" placeholder="Phone"
                                                required name="phone" value="{{ old('phone', $site->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" class="form-control" placeholder="Email"
                                                required name="email" value="{{ old('email', $site->email) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea id="address" class="form-control" placeholder="Enter address" name="address">{{ old('address', $site->address) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="driver_app" class="form-label">Rider App Version</label>
                                            <input type="text" id="driver_app" class="form-control"
                                                placeholder="Rider App Version" required name="driver_app"
                                                value="{{ old('driver_app', $site->driver_app) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="user_app" class="form-label">User App Version</label>
                                            <input type="text" id="user_app" class="form-control"
                                                placeholder="User App Version" required name="user_app"
                                                value="{{ old('user_app', $site->user_app) }}">
                                        </div>
                                    </div>
                                </div>
                                <center>
                                    <div class="mb-3 text-end">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
