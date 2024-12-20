@extends('layouts.master')
@section('content')
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
                            <strong class="card-title">Edit Banner</strong>
                        </div>
                        <div class="card-body">

                            <form class="needs-validation" method="post" action="{{route('admin.banner.update',$banner->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-row" style="align-items: center !important;">
                                    <div class="col-md-6 mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title',$banner->title) }}">
                                        @error('title')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="link">Link</label>
                                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link',$banner->link) }}" required>
                                        @error('link')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-10 mb-4">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*,video/*">
                                        @error('image')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    @if(isset($banner->image))
                                    @php
                                    $extension = pathinfo($banner->image, PATHINFO_EXTENSION); // Get the file extension
                                    $extension = strtolower($extension); // Convert to lowercase for case insensitivity
                                    @endphp

                                    @if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif')
                                    <div class="col-md-2 mb-2">
                                        <img src="{{url('public/banner/'.$banner->image)}}" style="height:60px;width: 60px;" alt="Banner-Ct">
                                    </div>
                                    @else
                                    <div class="col-md-2 mb-2">
                                        <video controls style="height: 100px; width: 100px;">
                                            <source src="{{ url('public/banner/'.$banner->image) }}" type="video/mp4">
                                        </video>
                                    </div>
                                    @endif
                                    @endif
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