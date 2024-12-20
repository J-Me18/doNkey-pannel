@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Category</h2>




                </div>
                <p class="card-text"> </p>
                <div class="row">
                    <span id="message" class="alert alert-success alert-dismissible fade show col-md-12"
                        style="display: none;" role="alert">

                    </span>
                </div>
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

                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>

                                            <th>S.No</th>
                                            <th>Name</th>
                                            @can('category-update')
                                                <th>Status</th>
                                            @endcan


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($category as $category)
                                            <tr>


                                                <td>{{ $i }}</td>
                                                <td>{{ $category->category }}</td>
                                                @can('category-update')
                                                    <td>
                                                        <input type="checkbox" data-id="{{ $category->id }}" name="status"
                                                            class="js-switch" {{ $category->status == 1 ? 'checked' : '' }}>
                                                    </td>
                                                @endcan

                                            </tr>
                                            <?php $i++; ?>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html, {
                size: 'small'
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let Id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "categoryStatus",
                    data: {
                        'status': status,
                        'id': Id
                    },
                    success: function(data) {
                        //console.log(data.success);
                        $('#message').fadeIn().html(data.success);
                        setTimeout(function() {
                            $('#message').fadeOut("slow");
                        }, 1000);

                    }
                });
            });
        });
    </script>
@endsection
@section('scripts')
@endsection
