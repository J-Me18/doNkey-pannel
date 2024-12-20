@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

@section('content')
<div class="card p-3">
    <form action="{{route('siteupdate')}}" method="post" autocomplete="off">
        {{csrf_field()}}
        @foreach($site_details as $site)
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Site Name</label>
                    <input type="text" class="form-control" placeholder="Site Name" required name="sitename"
                        value="{{$site->sitename}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                    <input type="text" class="form-control" placeholder="Email" required name="email"
                        value="{{$site->email}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" placeholder="Phone Number" required name="phone"
                        value="{{$site->phone}}">
                </div>


            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                    <textarea class="form-control form-control-lg" name="address" required
                        id="exampleFormControlTextarea1" rows="3"> {{$site->address}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Map Link</label>
                    <textarea class="form-control form-control-lg" name="map" required id="exampleFormControlTextarea1"
                        rows="3"> {{$site->map}}</textarea>
                </div>
                <div class="mb-3 float-end">

                    <input type="submit" value="Update" class="btn btn-primary btn-sm">
                    <input type="reset" value="Reset" class="btn btn-danger btn-sm">
                </div>
            </div>

        </div>
        @endforeach

    </form>
</div>
@endsection