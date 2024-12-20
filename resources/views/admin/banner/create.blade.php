@extends('layouts.master')
@section('content')
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Banner</h2>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Add Banner</strong>
                        </div>
                        <div class="card-body">

                            <form class="needs-validation" method="post" action="{{route('admin.banner.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                                        @error('title')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="link">Link</label>
                                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" required>
                                        @error('link')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-6">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*,video/*">
                                        @error('image')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <center><button class="btn btn-primary mt-2" type="submit">Submit</button></center>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->

            </div> <!-- end section -->
        </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->


@endsection