@extends('layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <h2 class="h3 mb-4 page-title">Profile</h2>
            @if(Session::has('success'))
            <!-- Small table -->
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> </strong> {{ Session::get('success') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif
            @if($errors->any())
            <!-- Small table -->
            @foreach($errors->all() as $e)
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong> </strong> {{ $e }} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endforeach
            @endif
            <div class="my-4">
                {{-- <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Security</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Notifications</a>
              </li>
            </ul> --}}
                <form class="needs-validation" method="post" action="{{ route('profile.update',$admin->id) }}" enctype="multipart/form-data" novalidate>
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="row mt-5 align-items-center">
                        <div class="col-md-3 text-center mb-5">
                            <div class="card border-0 bg-transparent">
                                <img src="{{ asset('admin/admin/profile/'.$admin->profile) }}" class="card-img-top img-fluid rounded">
                            </div>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4 class="mb-1">{{ $admin->name }}</h4>
                                    <p class="small mb-3"><span class="badge badge-dark">{{ $admin->emp_id }}</span></p>
                                </div>
                               
                            </div>

                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">Name</label>
                            <input type="text" id="firstname" name="name" class="form-control" placeholder="" value="{{ $admin->name }}">
                            @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="official_mobile">Official Mobile</label>
                            <input type="text" name="official_mobile" class="form-control" placeholder="" value="{{ $admin->official_mobile }}">
                            @error('official_mobile')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">Official Email</label>
                        <input type="official_mail" class="form-control" id="inputEmail4" placeholder="" name="official_mail" value="{{ $admin->official_mail }}">
                        @error('official_mail')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputAddress5">Address</label>
                        <input type="text" class="form-control" id="inputAddress5" placeholder="" name="address" value="{{ $admin->address }}">
                        @error('address')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="profile">Profile</label>
                        <input type="file" name="profile" class="form-control" placeholder="" value="{{ $admin->profile }}">
                        @error('profile')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- <input type="hidden" id="id" class="form-control" placeholder="" name="id" value="{{ $admin->id }}"> -->


                    <button type="submit" class="btn btn-primary">Save Change</button>
                </form>
            </div> <!-- /.card-body -->
        </div> <!-- /.col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->


@endsection
