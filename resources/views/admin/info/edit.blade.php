@extends('layouts.master')
@section('content')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <style>
        .error {
            color: red;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Info</h2>
                <p class="text-muted"></p>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Edit Info</strong>
                            </div>
                            <div class="card-body">

                                <form class="needs-validation" method="post" id="editForm"
                                    action="{{ route('admin.info.update', $info->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row" style="align-items: center !important;">
                                        <div class="col-md-12 mb-3">
                                            <label for="content">Content</label>
                                            <input type="text"
                                                class="form-control @error('content') is-invalid @enderror " id="content"
                                                name="content" value="{{ old('content', $info->content) }}">
                                            @error('content')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="description">description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $info->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
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
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editForm').validate({
                rules: {
                    content: "required",
                    description: "required"
                },
                messages: {
                    content: "The content is required",
                    description: "The description is required",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
