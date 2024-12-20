@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script> --}}
<style>
    .check-box {
	transform: scale(.5);
}

input[type="checkbox"] {
    position: relative;
    appearance: none;
    width: 100px;
    height: 50px;
    background: red;
    border-radius: 50px;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: 0.4s;
}

input:checked[type="checkbox"] {
    background-color: rgb(100, 189, 99);

}

input[type="checkbox"]::after {
    position: absolute;
    content: "";
    width: 50px;
    height: 50px;
    top: 0;
    left: 0;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    transform: scale(1.1);
    transition: 0.4s;
}

input:checked[type="checkbox"]::after {
    left: 50%;
}

</style>

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <h2 class="mb-2 page-title">Subscribers List</h2>
@can('subscriber-create')
<div class="col ml-auto">
    <div class="dropdown float-right">
        <a href="{{ url('createSubscriber') }}"><button class="btn btn-primary float-right ml-3" type="button">Add more +</button></a>

    </div>
</div>
@endcan



            </div>
            <p class="card-text"> </p>
            <div class="row">
                <span id="message" class="alert alert-success alert-dismissible fade show col-md-12" style="display: none;" role="alert">

                </span>
            </div>
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
            @if(Session::has('error'))
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

                        <div class="card-body table-responsive">

                            <!-- table -->
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>

                                        <th>S.No</th>
                                        <th>Subscriber ID</th>
                                        <th>Created By</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Pincode</th>
                                        <th>Account Type</th>
                                        <th>Subscriber Number</th>
@can('Status on')

                                        <th>Status</th>
                                        @endcan
                                        <th>Block</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($subscriber as $subscriber)
                                    <tr>


                                        <td>{{ $i}}</td>
                                        <td>{{$subscriber->subscriberId}}</td>
                                        <td>{{App\Models\Admin::where('id',$subscriber->created_by)?->first()?->emp_id}}</td>
                                        <td>{{$subscriber->name}}</td>
                                        <td>{{$subscriber->location}}</td>
                                        <td>
                                            @php $subspin=json_decode($subscriber->pincode);
                                            foreach($pincode as $pin) { @endphp
                                            @if(in_array($pin->id, $subspin))
                                            {{ $pin->pincode }}
                                            @endif
                                            @php } @endphp
                                        </td>
                                        <td>{{$subscriber->account_type?$subscriber->account_type:"N/A"}}</td>
                                        <td>{{$subscriber->mobile}}</td>
@can('Status on')
<td>
    @if($subscriber->blockedstatus == 0)
    <span class="badge badge-danger">Blocked</span>
    @else
<div class="check-box text-left">

    <input type="checkbox" data-id="{{ $subscriber->id }}" name="status" class="js-switchs " {{ $subscriber->activestatus == 1 ? 'checked' : '' }}>
</div>
    @endif
</td>
@endcan

                                        <td>
                                            @if($subscriber->blockedstatus == 0)
                                            <button id="update_user" data-payer_id="{{$subscriber->id}}" class="btn mb-2 btn-outline-success update_user">Unblock</button>

                                            @else
                                            <button type="button" class="btn mb-2 btn-outline-danger" data-toggle="modal" data-target="#verticalModal{{ $subscriber->id }}">Block</button>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ url('subscriber/show/'.$subscriber->id)}}"><span class="fe fe-24 fe-eye text-warning"></span></a>
@can('subscriber-edit')
<a href="{{ url('subscriber/'.$subscriber->id)}}"><span class="fe fe-24 fe-edit text-success"></span></a>

@endcan

@can('subscriber-delete')
<a href="{{ url('subscriberdelete/'.$subscriber->id)}}" class="button delete-confirm"><span class="fe fe-24 fe-trash text-danger"></span></a>

@endcan

                                        </td>
                                    </tr>

                                    <!--Modal-->
                                    <div class="modal fade" id="verticalModal{{ $subscriber->id }}" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verticalModalTitle">Block Subscriber
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{url('subscriberblock/'.$subscriber->id)}}">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Subscriber Name:</label>
                                                            <input type="text" class="form-control" id="recipient-name" value="{{$subscriber->name}}" readonly>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Reason:</label>
                                                            <textarea class="form-control" id="message-text" name="reason" required></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn mb-2 btn-danger">Block</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="verticalModalone{{ $subscriber->id }}" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verticalModalTitle">Status Change Subscriber
                                                    </h5>
                                                    <button type="button" class="close close1" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{route('subscriberstatuschange')}}">
                                                    {{csrf_field()}}
                                                    <!-- @method('PUT') -->
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Subscriber Name:</label>
                                                            <input type="text" class="form-control" id="recipient-name" value="{{$subscriber->name}}" readonly>
                                                            <input type="hidden" class="form-control" id="recipient-name" name='id' value="{{$subscriber->id}}" readonly>
                                                            <input type="hidden" class="form-control" id="recipient-name" name='status' value="0" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Reason:</label>
                                                            <!-- <textarea class="form-control" id="message-text"
                                                                name="reason" required></textarea> -->
                                                            <select name="message" id="" required class="form-control  mb-4" onchange="showtextarea(this.value)">
                                                                <option value="">Select A Reason</option>
                                                                <option value="Price Changes  Are Not Reasonable">Price Changes Are Not Reasonable</option>
                                                                <option value="Newly Uploaded Document Are Not Matching">Newly Uploaded Document Are Not Matching</option>
                                                                <option value="Subscription Amount Not Paid">Subscription Amount Not Paid</option>
                                                                <option value="Other">Other</option>


                                                            </select>
                                                            <textarea name="message1" id="" cols="10" placeholder="Description" class="form-control statuschangeselecttextarea" rows="3"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary close1" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn mb-2 btn-warning">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="verticalModaltwo{{ $subscriber->id }}" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verticalModalTitle">Status Change Subscriber
                                                    </h5>
                                                    <button type="button" class="close close1" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{route('subscriberstatuschange')}}">
                                                    {{csrf_field()}}
                                                    <!-- @method('PUT') -->
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Subscriber Name:</label>
                                                            <input type="text" class="form-control" id="recipient-name" value="{{$subscriber->name}}" readonly>
                                                            <input type="hidden" class="form-control" id="recipient-name" name='id' value="{{$subscriber->id}}" readonly>
                                                            <input type="hidden" class="form-control" id="recipient-name" name='status' value="1" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Reason:</label>
                                                            <!-- <textarea class="form-control" id="message-text"
                                                                name="reason" required></textarea> -->
                                                            <select name="message" id="" required class="form-control  mb-4" onchange="showtextarea(this.value)">
                                                                <option value="">Select A Reason</option>
                                                                <option value="Price Changes Are Validated">Price Changes Are Validated</option>
                                                                <option value="Document Are Validated"> Document Are Validated</option>
                                                                <option value="Subscription Amount  Paid Lately">Subscription Amount Paid Lately</option>
                                                                <option value="Other">Other</option>


                                                            </select>
                                                            <textarea name="message1" id="" cols="10" placeholder="Description" class="form-control statuschangeselecttextarea" rows="3"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary close1" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn mb-2 btn-warning">Update</button>
                                                    </div>
                                                </form>
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

    <div class="modal fade" id="update-form" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalModalTitle">Unblock Subscriber</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" method="post" action="{{url('subscriberunblock')}}" enctype="multipart/form-data" novalidate>
                    {{csrf_field()}}

                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="sub_id" id="sub_id" value="" readonly>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Comments:</label>
                            <textarea class="form-control" id="message-text" name="comments" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn mb-2 btn-success">Unblock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switchs'));

    elems.forEach(function(html) {
        let switchery = new Switchery(html, {
            size: 'small'
        });
    });
</script>
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
<script>
    $(document).ready(function() {
        $('.statuschangeselecttextarea').slideUp()
        $('.close1').click(function() {
            window.location.reload();
        });
        // $('.statuschangeselect').on('change', function() {
        //     console.log($('.statuschangeselect').val())
        //     if ($('.statuschangeselect').val() == "4") {
        //         $('.statuschangeselecttextarea').show()
        //     } else {
        //         $('.statuschangeselecttextarea').hide()
        //     }
        // })
        $('.js-switchs').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let userId = $(this).data('id');
            // $.ajax({
            //     type: "GET",
            //     dataType: "json",
            //     url: "changeStatus",
            //     data: {
            //         'status': status,
            //         'user_id': userId
            //     },
            //     success: function(data) {
            //         console.log(data.success);
            //         $('#message').fadeIn().html(data.success);
            //         setTimeout(function() {
            //             $('#message').fadeOut("slow");
            //         }, 1000);

            //     }
            // });
            if (status == 0) {
                $('#verticalModalone' + userId).modal('show');
            } else {
                $('#verticalModaltwo' + userId).modal('show');
            }
        });
    });
</script>
<script>
    $(".update_user").click(function() {

        var player_id = $(this).attr('data-payer_id');

        $("#update-form").find("#sub_id").val(player_id);
        $('#update-form').modal('show');
        //$("#update-form").dialog("open");
    });

    function showtextarea(value) {
        if (value == "Other") {
            $('.statuschangeselecttextarea').slideDown()
        } else {
            $('.statuschangeselecttextarea').slideUp()
        }
    }
</script>
@endsection
@section('scripts')


@endsection
