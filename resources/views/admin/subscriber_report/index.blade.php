@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <h2 class="mb-2 page-title">Subscriber Work Report</h2>

                    <div class="col ml-auto">
                        {{-- <div class="dropdown float-right">
                        <a href="{{ url('createSubscriber') }}"><button class="btn btn-primary float-right ml-3" type="button">Add more +</button></a>

                    </div> --}}
                    </div>


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
                                <div class="m-section__content">
                            <form method="GET" class="search-form form-inline"
                                        action="{{ route('subscriberReport.index') }}">

                                        <div class="form-group for pl-2">
                                            <label class="mr-2">From Date:</label>
                                            <input value="{{ request('from_date') }}" type="date" class="form-control"
                                                name="from_date" autocomplete="off" placeholder="From Date"
                                                min="" />
                                        </div>
                                        <div class="form-group for pl-3">
                                            <label class="mr-2">To Date:</label>
                                            <input value="{{ request('to_date') }}" type="date" class="form-control"
                                                name="to_date" autocomplete="off" placeholder="To Date" min="" />
                                        </div>                                        
                                        <div class="form-group pl-3">
                                            <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                            <a class="btn btn-danger m-btn m-btn--air m-btn--custom"
                                                href="{{ route('subscriberReport.index') }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    </form>
                                </div>
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
                                            <th>Joining Date</th>
                                            <th>Mobile</th>
                                            {{-- <th>Status</th> --}}
                                            {{-- <th>Block</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($subscribers as $subscriber)
                                            <tr>


                                                <td>{{ $i }}</td>
                                                <td>{{ $subscriber->subscriberId }}</td>
                                                <td>{{ $roleName[0] }}</td>
                                                <td>{{ $subscriber->name }}</td>
                                                <td>{{ $subscriber->location }}</td>
                                                 
                                            <td>
    @php
        // Ensure $subscriber and $pincode are defined and contain valid data
        $subspin = json_decode($subscriber?->pincode);

        // Loop through each pincode and check if it's in the subscriber's pincode array
        foreach ($pincode as $pin) {
            // Ensure $pin->id exists and is a valid value
            if (in_array($pin->id, $subspin)) {
                // Output the pincode if it's found in the subscriber's pincode array
                echo $pin->pincode.'<br>';                
            }            
        }
    @endphp
</td>
                                                
                                                <td>{{ $subscriber->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $subscriber->mobile }}</td>
                                                {{-- @php
                                                    $status = [
                                                        1 => ['label' => 'Active', 'color' => 'green'],
                                                        0 => ['label' => 'Inactive', 'color' => 'red'],
                                                    ];
                                                @endphp
                                                <td style="color: {{ $status[$subscriber->activestatus]['color'] }}">
                                                    {{ $status[$subscriber->activestatus]['label'] }}
                                                </td> --}}

                                                <td>
                                                    <a href="{{ route('subscriberReport.show', $subscriber->id) }}"><span
                                                            class="fe fe-24 fe-eye text-white btn btn-success"> Full
                                                            Details</span></a>
                                                </td>
                                            </tr>

                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->

        <div class="modal fade" id="update-form" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verticalModalTitle">Unblock Subscriber</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" method="post" action="{{ url('subscriberunblock') }}"
                        enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}

                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="sub_id" id="sub_id" value=""
                                readonly>

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
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

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
            $('.js-switch').change(function() {
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
