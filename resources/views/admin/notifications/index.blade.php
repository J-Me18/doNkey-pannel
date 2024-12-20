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

        .truncate-text {
            max-width: 300px;
            /* Adjust to fit your layout */
            height: 4.8em;
            /* Adjust based on the number of lines you want to show */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            /* Number of lines to display */
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Push Notification</h2>
                    <div class="col ml-auto">
                        <div class="dropdown float-right">
                        </div>
                    </div>
                </div>
                <p class="card-text"> </p>
                @if (Session::has('success'))
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> </strong> {{ Session::get('success') }} <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif
                @if (Session::has('error'))
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" x-data="{ showMessage: true }"
                            x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                            <strong> </strong> {{ Session::get('error') }} <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="row my-4">

                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <form class="needs-validation" method="post" action="{{ route('pushnotification.store') }}"
                                    id="pushnotification" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="invalid-feedback">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="type">Type</label>
                                            <select class="form-control @error('type') is-invalid @enderror" id="type"
                                                name="type">
                                                <option value="">Choose Type
                                                </option>
                                                <option value=1 {{ old('type') == 1 ? 'selected' : '' }}>All
                                                </option>
                                                <option value=2 {{ old('type') == 2 ? 'selected' : '' }}>User
                                                </option>
                                                <option value=3 {{ old('type') == 3 ? 'selected' : '' }}>Driver
                                                </option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control  @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*">
                                            @error('image')
                                                <span class="invalid-feedback">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-6">
                                            <label for="content">Content</label>
                                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ old('content') }}</textarea>
                                            @error('content')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <center><button class="btn btn-primary mt-2" type="submit">Send &nbsp;<i
                                                class="fe fe-send fe-12"></i>
                                        </button></center>
                                </form>
                                <hr>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Type</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notifications as $notification)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                @if (isset($notification->image))
                                                    <td><img src="{{ url('public/pushnotification/' . $notification?->image) }}"
                                                            alt="Notif-IMG" style="height: 30px;width:30 px;"></td>
                                                @else
                                                    <td>
                                                        <img src="{{ url('public/pushnotification/ip.jpg') }}"
                                                            alt="default">
                                                    </td>
                                                @endif
                                                <td>{{ $notification->title }}</td>
                                                <td class="truncate-text">{{ $notification->content }}</td>
                                                <td>
                                                    <span class="badge badge-success">
                                                        @if ($notification->type == 1)
                                                            All
                                                        @elseif ($notification->type == 2)
                                                            User
                                                        @elseif ($notification->type == 3)
                                                            Driver
                                                        @else
                                                            Unknown
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>{{ $notification->created_at->format('d M,Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <script src="https://technext.github.io/tinydash/js/jquery.dataTables.min.js"></script>
    <script src='https://technext.github.io/tinydash/js/dataTables.bootstrap4.min.js'></script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pushnotification').validate({
                rules: {
                    title: "required",
                    content: "required",
                    type: "required",
                },
                messages: {
                    title: "The title is required",
                    content: "The content is required",
                    type: "Select a valid type",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
