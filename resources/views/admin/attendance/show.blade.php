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
                <h2 class="h3 mb-4 page-title">Employee - {{ $employee->name }}(<span
                        class="">{{ $employee->emp_id }}</span>)</h2>
                <!-- ... existing code ... -->
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-danger">Employee Role</h6>
                        <p class="text-muted">
                            {{ $employee->roles[0]->name }}
                        </p>
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-danger" target="blank" href="{{ route('employeePdf', ['employee' => $employee->id, 'from_date' => request('from_date'), 'to_date' => request('to_date')]) }}">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                    <a class="btn btn-success" href="{{ route('employeeExcel', ['employee' => $employee->id, 'from_date' => request('from_date'), 'to_date' => request('to_date')]) }}">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-danger">Employee Attendance Details</h6>
                        <div class="m-section__content">
                            <form method="GET" class="search-form form-inline"
                                action="{{ route('employeeReport.show', $employee->id) }}">

                                <div class="form-group for">
                                    <label>From Date:</label>
                                    <input value="{{ request('from_date') }}" type="date" class="form-control"
                                        name="from_date" autocomplete="off" placeholder="From Date" min="" />
                                </div>
                                <div class="form-group for">
                                    <label>To Date:</label>
                                    <input value="{{ request('to_date') }}" type="date" class="form-control"
                                        name="to_date" autocomplete="off" placeholder="To Date" min="" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i
                                            class="fa fa-search"></i></button>
                                    <a class="btn btn-danger m-btn m-btn--air m-btn--custom"
                                        href="{{ route('employeeReport.show', $employee->id) }}"><i
                                            class="fa fa-times"></i></a>
                                </div>
                            </form>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table datatables" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Check In Date</th>
                                        <th>Check In Time</th>
                                        <th>Check Out Date</th>
                                        <th>Check Out Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datewise as $datewise)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $datewise->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $datewise->created_at->format('h:i:s A') }}</td>
                                            @if ($datewise->created_at == $datewise->updated_at)
                                                <td style="color: red">Not Yet</td>
                                                <td style="color: red">Not Yet</td>
                                            @else
                                                <td>{{ $datewise->updated_at->format('d-m-Y') }}</td>
                                                <td>{{ $datewise->updated_at->format('h:i:s A') }}</td>
                                            @endif
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
