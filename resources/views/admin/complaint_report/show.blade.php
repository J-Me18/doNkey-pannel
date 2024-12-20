@extends('layouts.master')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('employeePerformance.index') }}">Back</a>
                </div>
                <h2 class="h3 mb-4 page-title">Employee - {{ $admin->name }}(<span
                        class="">{{ $admin->emp_id }}</span>)</h2>
                <!-- ... existing code ... -->
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-danger">Employee Role</h6>
                        <p class="text-muted">
                            {{ $admin->roles[0]->name }}
                        </p>
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-danger" target="blank" href="{{ route('complaintPdf', ['admin' => $admin->id, 'from_date' => request('from_date'), 'to_date' => request('to_date'), 'search' => request('search')]) }}">
    <i class="fas fa-file-pdf"></i>
</a>

<a class="btn btn-success" href="{{ route('complaintExcel', ['admin' => $admin->id, 'from_date' => request('from_date'), 'to_date' => request('to_date'), 'search' => request('search')]) }}">
    <i class="fas fa-file-excel"></i>
</a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-danger">Employee Complaint Report</h6>
                        <div class="m-section__content">
                            <form method="GET" class="search-form form-inline"
                                action="{{ route('complaintReport.show', $admin->id) }}">

                                <div class="form-group for pl-3">
                                    <div class="pr-2">
                                        <label>From Date:</label>
                                    </div>
                                    <input value="{{ request('from_date') }}" type="date" class="form-control"
                                        name="from_date" autocomplete="off" placeholder="From Date" min="" />
                                </div>
                                <div class="form-group for pl-3">
                                    <div class="pr-2">
                                        <label>To Date:</label>
                                    </div>
                                    <input value="{{ request('to_date') }}" type="date" class="form-control"
                                        name="to_date" autocomplete="off" placeholder="To Date" min="" />
                                </div>
                                <div class="form-group for pl-3">
                                    <label class="mr-2">Search:</label>
                                    <input value="{{ request('search') }}" type="text" class="form-control"
                                        name="search" autocomplete="off" placeholder="Search..." min="" />
                                </div>
                                <div class="form-group pl-3">
                                    <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i
                                            class="fa fa-search"></i></button>
                                    <a class="btn btn-danger m-btn m-btn--air m-btn--custom"
                                        href="{{ route('complaintReport.show', $admin->id) }}"><i
                                            class="fa fa-times"></i></a>
                                </div>
                            </form>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Complaint ID</th>
                                        <th>Status</th>
                                        <th>complained By</th>
                                        <th>complained At</th>
                                        <th>Solved By</th>
                                        <th>Solved At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($complaints as $complaint)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $complaint->complaintID }}</td>
                                            <td>{{ $complaint->status ? $complaint->status : '-' }}</td>
                                            <td>{{ $complaint->complained_by }}</td>
                                            <td>{{ $complaint->created_at->format('d-m-Y h:i A') }}</td>
                                            <td>{{ $complaint->solved_by }}</td>
                                            <td>{{ $complaint->updated_at->format('d-m-Y h:i A') }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ... rest of your code ... -->
            </div> <!-- /.col-12 -->
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
            setInterval(() => {
                $total = 0;
                $('.amounts').each(function() {
                    $total = $total + parseInt($(this).val());
                })
                $('.showtotal').text($total);
            }, 500);
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
