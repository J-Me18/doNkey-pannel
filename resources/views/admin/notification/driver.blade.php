@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
<style>
    .hand {
        cursor: pointer;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <h2 class="mb-2 page-title">Driver Notification </h2>




            </div>
            <p class="card-text"> </p>
            <div class="row">
                <span id="message" class="alert alert-success alert-dismissible fade show col-md-12" style="display: none;" role="alert">

                </span>
            </div>

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
                                        <th>Subscriber Id</th>
                                        <th>Subscriber Name</th>
                                        <th>Rider Name</th>
                                        <th>Date </th>
                                        <th>Read By</th>
                                        <th>Action </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($driver as $driver)
                                    <tr>
                                        <td>{{ $i}}</td>
                                        <td>{{$driver->subscriberid}}</td>
                                        <td>{{$driver->subscribername}}</td>
                                        <td>{{$driver->drivername}}</td>
                                        <td>{{$driver->created_at->format('d-m-Y h:i:s A')}}</td>
                                        <td>{{$driver->readBy ? App\Models\Admin::where('id',$driver->readBy)->first()?->emp_id : "Not Yet"}}</td>
                                        <td><a data-toggle="modal" data-target="#varyModal{{$driver->id}}"><span class="badge hand badge-danger">View</span></a>
                                            @if ($driver->readBy == NULL)
                                            &nbsp;&nbsp;<a class="badge hand badge-success" style="color:white" data-toggle="modal" data-target="#exampleModalCenter{{$driver->id}}">Mark As Read</a>
                                        </td>
                                        @endif

                                    </tr>
                                    <?php $i++; ?>
                                    <!-- large modal -->
                                    <div class="modal fade" id="varyModal{{$driver->id}}" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="varyModalLabel">New message</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">
                                                                    @php
                                                                    $userId = App\Models\Driver::where('id',$driver->modifiedId)?->first()?->userid;                                                                    
                                                                     $userid = App\Models\User::where('id',$userId )?->first()?->user_id;                                                                                                                                         
                                                                    @endphp
                                                                    Rider Id : <span class="text-success">{{$userid }}</span>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Rider
                                                                        Name : <span class="text-success">{{$driver->drivername}}</span></label>

                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Subscriber Id : <span class="text-warning">{{$driver->subscriberid}}</span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Subscriber Name : <span class="text-warning">{{$driver->subscribername}}</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Datas
                                                                Modified:</label>
                                                            <p>{{$driver->datas}}</p>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Comments:</label>
                                                            <p >{{$driver->message}}</p>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter{{$driver->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <form action="{{route('readBy',['readBy' => $driver->id])}}" method="Post">
                                            @csrf
                                            @method('Put')

                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Notification</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label" readonly>Rider
                                                                Name : <span class="text-success">{{$driver->drivername}}</span></label>

                                                        </div>

                                                        <div class="form-group">
                                                            @php
                                                            $datas = json_decode($driver->datas);
                                                            //dd($datas);
                                                            @endphp                            
                                                            <label for="recipient-name" class="col-form-label">Datas Modified:</label>
                                                            <pre style="color:black;">{{ json_encode($datas) }}</pre>

                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                        <button type="submit" class="btn btn-outline-success">Mark As Read</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
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
                url: "driverActivate",
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
