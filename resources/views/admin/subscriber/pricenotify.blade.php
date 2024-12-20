@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <h2 class="mb-2 page-title">Price change List</h2>

                <div class="col ml-auto">
                    <div class="dropdown float-right">
                        {{-- <a href="{{ url('subscriber') }}"><button class="btn btn-dark float-right ml-3" type="button"><i class="fe fe-arrow-left-circle"></i> Subscriber</button></a> --}}
                    </div>
                </div>


            </div>
            <p class="card-text"> </p>
            <div class="row">
                <span id="message" class="alert alert-success alert-dismissible fade show col-md-12" style="display: none;" role="alert">

                </span>
            </div>
            @if (Session::has('success'))
            <!-- Small table -->
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> </strong> {{ Session::get('success') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif
            @if (Session::has('error'))
            <!-- Small table -->
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                    <strong> </strong> {{ Session::get('error') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                                        <th>Subscriber ID</th>
                                        <th>Subscriber Name</th>
                                        <th>Viewed By</th>
                                        <th>Date</th>
                                        <th>Content</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($notify as $notify)
                                    <tr>
                                        @php
                                        $data = json_decode($notify->datas);
                                        @endphp

                                        <td>{{ $i }}</td>
                                        <td>{{ $notify->subscriberId }}</td>
                                        <td>{{ $notify->subscribername }}</td>
                                        <!--<td>{{ $notify->datas }}</td>-->
                                        <td>{{ $notify->adminname }}</td>

                                        <td>{{ date_format(date_create($notify->created_at), 'd/m/Y h:i:s') }}</td>
                                        <td>
                                            <button type="button" class="btn mb-2 btn-outline-warning" data-toggle="modal" data-target="#verticalModal{{ $notify->id }}"><span class="fe fe-24 fe-eye "></span></button>

                                            @if ($notify->read == 0)
                                            <button class="btn mb-2 btn-outline-primary read_confirm" id="read_confirm" name="read_confirm" data-toggle="modal" data-target="#verticalModala{{ $notify->id }}">Mark as
                                                read</button>
                                            <div class="modal fade" id="verticalModala{{ $notify->id }}" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                                                <form action="{{ url('markasread') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="verticalModalTitle">
                                                                    Modified
                                                                    Price
                                                                    List
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Subscriber
                                                                        Name:</label>
                                                                    <input type="text" class="form-control" id="recipient-name" value="{{ $notify->subscribername }}" readonly>
                                                                    <input type="text" class="form-control" id="recipient-name" value="{{ $notify->id }}" readonly name='id' style="display:none">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <h3 class="h5 mt-4 mb-1">Data Modified</h3>
                                                                    <p class="text-muted mb-4"></p>
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($data as $k => $v)
                                                                        <li class="my-1"><i class="fe fe-file-text mr-2 text-muted"></i>{{ $k }}
                                                                            - {{ $v }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn mb-2 btn-success">Mark
                                                                    As
                                                                    Read</button>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            @else
                                            @endif
                                        </td>
                                    </tr>

                                    <!--Modal-->
                                    <div class="modal fade" id="verticalModal{{ $notify->id }}" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verticalModalTitle">Modified Price
                                                        List
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>


                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Subscriber
                                                            Name:</label>
                                                        <input type="text" class="form-control" id="recipient-name" value="{{ $notify->subscribername }}" readonly>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h3 class="h5 mt-4 mb-1">Data Modified</h3>
                                                        <p class="text-muted mb-4"></p>
                                                        <ul class="list-unstyled">
                                                            @foreach ($data as $k => $v)
                                                            <li class="my-1"><i class="fe fe-file-text mr-2 text-muted"></i>{{ $k }}
                                                                - {{ $v }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!--End modal-->
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
@endsection
@section('scripts')
<!-- <script>
        $(document).ready(function() {

            $(".read_confirm").click(function() {
                var id = $(this).attr('data-payer_id');
                //console.log(id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "markread",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        //console.log(data.success);
                        $('#message').fadeIn().html(data.success);
                        $("#dataTable-1").load(location.href + " #dataTable-1");
                        setTimeout(function() {
                            $('#message').fadeOut("slow");
                        }, 1000);

                    }
                });

            });
        })
    </script> -->
@endsection