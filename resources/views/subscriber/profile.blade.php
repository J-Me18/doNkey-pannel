@extends('layouts.submaster')
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
                <form class="needs-validation" method="post" action="{{url('subscribers/updateProfile')}}" enctype="multipart/form-data" novalidate>
                    {{csrf_field()}}
                    <div class="row mt-5 align-items-center">
                        <div class="col-md-3 text-center mb-5">
                            <div class="card border-0 bg-transparent">
                                <img src="{{ asset('admin/employee/profile/'.$employee->profile) }}" class="card-img-top img-fluid rounded">
                            </div>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                @php
                                $user = Session::get('subscribers');
                                @endphp

                                <div class="col-md-6">
                                    <h4 class="mb-1">{{ $employee->name }}</h4>
                                    @if (isset($user->subscriberId))                                    
                                    <p class="small mb-2"><span class="badge badge-dark">{{$subscriber->subscriberId}}</span></p>
                                    @else
                                    <p class="small mb-2"><span class="badge badge-dark">{{$user->emp_id}}</span></p>
                                    @endif
                                    @if (isset($user->subscriberId))                                    
                                      @if($user->activestatus == 1)                                  
                                        <p class="small mb-2"><span class="badge badge-success text-light">Active</span></p>
                                      @else
                                        <p class="small mb-2"><span class="badge badge-danger text-light">In-Active</span></p>
                                      @endif                                   
                                    @endif                                   

                                </div>
                            </div>
                            @if (isset($user->subscriberId))
                       
                            <div class="row mb-4">
                                <div class="col">
                                    <p class="small mb-0  text-primary ">{{ $employee->emp_id }} </p>
                                    <p class="small mb-0  text-success ">Subscription validity </p>
                                    <p class="small mb-0 text-muted">From -
                                        {{ $subscriber->subscriptionDate->format('d-m-Y') }}
                                    </p>
                                    <p class="small mb-0 text-muted">To - {{$subscriber->expiryDate->format('d-m-Y')}}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">Name</label>
                            <input type="text" id="firstname" name="name" class="form-control" placeholder="" value="{{old('name',$employee->name) }}">
                            @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="official_mobile">Official Mobile</label>
                            <input type="text" name="official_mobile" class="form-control" placeholder="" value="{{ old('official_mobile',$employee->official_mobile) }}">
                            @error('official_mobile')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">Official Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="" name="official_mail" value="{{old('official_mail',$employee->official_mail) }}">
                        @error('official_mail')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="inputAddress5" placeholder="" name="location" value="{{ old('location',$employee->location) }}">
                        @error('location')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     @if (isset($user->subscriberId))                    
                     <div class="form-group">
                        <label for="location">GSTIN/UIN</label>
                        <input type="text" class="form-control" id="inputAddress9" placeholder="" name="gst" value="{{ old('gst',$subscriber?->gst) }}">
                        @error('gst')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @else
                    
                    @php
                    $gst= App\Models\Subscriber::where('id',$employee->subscriber_id)->first();
                    @endphp
                    
                    <div class="form-group">
                        <label for="location">GSTIN/UIN</label>
                        <input type="text" class="form-control" id="inputAddress9" placeholder="" name="gst" value="{{ old('gst',$gst?->gst) }}" readonly>
                        @error('gst')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="inputAddress5">Profile</label>
                        <input type="file" class="form-control" id="profile" placeholder="" accept="image/gif, image/jpeg, image/png, image/jpg" name="profile" value="">
                        <small id="image" class="form-text text-muted">Note:Please upload jpg,png,jpeg format
                            </span></small>

                        @error('profile')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save Change</button>
                </form>
            </div> <!-- /.card-body -->
        </div> <!-- /.col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->


@endsection
