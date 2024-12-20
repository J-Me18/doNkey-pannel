@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <h2 class="mb-2 page-title">Rider Block List (By Subscriber)</h2>

                <div class="col ml-auto">
                    <div class="dropdown float-right">
                        <a href="{{ route('drivers') }}"><button class="btn btn-dark float-right ml-3" type="button"><i class="fe fe-arrow-left-circle"></i> Rider</button></a>

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
                                        <th>Rider Name</th>
                                        <th>Rider Id</th>
                                        <th>Subscriber Name</th>
                                        <th>Subscriber Id</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>Current Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($blocklist as $blocklist)
                                    <tr>


                                        <td>{{ $i }}</td>
                                        <td>{{ $blocklist->driver[0]->name }}</td>
                                        <td>{{ App\Models\Enduser::where('id', $blocklist->driver[0]->userid)->first()?->user_id }}</td>
                                        <td>{{ $blocklist->subscriber[0]->name }}</td>
                                        <td>{{ $blocklist->subscriber[0]->subscriberId }}</td>
                                        <td>{{ $blocklist->comments }}</td>
                                        <td>{{ $blocklist->created_at->format('d-m-Y h:i:s') }}</td>
                                        <td>
                                            @if ($blocklist->driver[0]->status == 2)
                                            <p class="badge badge-danger">Blocked</p>
                                            @elseif ($blocklist->driver[0]->status == 1)
                                            <p class="badge badge-success">Active</p>
                                            @else
                                            <p class="badge badge-warning">Pending</p>
                                            @endif
                                        </td>


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
@endsection
@section('scripts')
@endsection
