@extends('layouts.master')
<style>
     .hand {
        cursor: pointer;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
              <h2 class="mb-2 page-title">Subscriber Notification</h2>

                        </div>
              <p class="card-text"> </p>
              <div class="row" >
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
                            <th >Employee Id</th>
                            <th >Employee Name</th>
                            <th >Subscriber Name</th>
                            <th >Date</th>
                            <th >Read By</th>
                            <th >Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($notify as $new)
                          <tr>


                            <td>{{ $loop->iteration }}</td>
                            <td>{{ App\Models\Admin::where('id',$new->modifiedBy)?->first()?->emp_id }}</td>
                            <td>{{ App\Models\Admin::where('id',$new->modifiedBy)?->first()?->name }}</td>
                            <td >{{ App\Models\Subscriber::where('id',$new->modifiedId)?->first()?->name }}</td>
                            <td >{{ $new->created_at }}</td>
                            @if ($new->readBy == NULL)
                            <td >NOT YET</td>
                            @else
                            <td >{{ App\Models\Admin::where('id',$new->modifiedBy)?->first()?->emp_id }}</td>
                            @endif
                            <td>
                                <a data-toggle="modal" data-target="#viewModal{{$new->id}}">
                                    <span class="badge hand badge-danger">View</span>
                                </a>
                                @if ($new->readBy == NULL)
                                &nbsp;&nbsp;
                                <a class="badge hand badge-success" style="color:white" data-toggle="modal" data-target="#readModal{{$new->id}}">
                                    Mark As Read
                                </a>
                                @endif
                            </td>
                          </tr>
                          <div class="modal fade" id="viewModal{{$new->id}}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{$new->id}}" aria-hidden="true">
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
                                                <div class="form-group">
                                                    <label for="subscriber-id" class="col-form-label">Subscriber Id:</label>
                                                    <span class="text-success">{{ App\Models\Subscriber::where('id', $new->modifiedId)->first()->subscriberId }}</span>
                                                </div>

                                                <div class="form-group">
                                                    <label for="subscriber-name" class="col-form-label">Subscriber Name:</label>
                                                    <span class="text-success">{{ App\Models\Subscriber::where('id', $new->modifiedId)->first()->name }}</span>
                                                </div>

                                                <div class="form-group">
                                                    <label for="datas-modified" class="col-form-label">Datas Modified:</label>
                                                    <p>{{ $new->datas }}</p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="comments" class="col-form-label">Comments:</label>
                                                    <p>{{ $new->message }}</p>
                                                </div>
                                            </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="readModal{{$new->id}}" tabindex="-1" role="dialog" aria-labelledby="readModalLabel{{$new->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ url('markasread') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verticalModalTitle">
                                                        Modified List
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Subscriber
                                                            Name:</label>
                                                        <input type="text" class="form-control" id="recipient-name" value="{{App\Models\Subscriber::where('id',$new->modifiedId)?->first()?->name }}" readonly>
                                                        <input type="text" class="form-control" id="recipient-name" value="{{ $new->id }}" readonly name='id' style="display:none">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h3 class="h5 mt-4 mb-1">Data Modified</h3>
                                                        <p class="text-muted mb-4"></p>
                                                        <ul class="list-unstyled">
                                                            @if (is_array($new->datas))
                                                            @foreach ($new->datas as $k => $v)
                                                            <li class="my-1"><i class="fe fe-file-text mr-2 text-muted"></i>{{ $k }} - {{ $v }}</li>
                                                            @endforeach
                                                            @elseif (is_string($new->datas))
                                                            <li class="my-1"><i class="fe fe-file-text mr-2 text-muted"></i>{{ $new->datas }}
                                                                @endif
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn mb-2 btn-success">Mark As Read</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
        <script src="https://technext.github.io/tinydash/js/jquery.dataTables.min.js"></script>
        <script src='https://technext.github.io/tinydash/js/dataTables.bootstrap4.min.js'></script>
        <script>
            $('#dataTable-1').DataTable(
            {
              autoWidth: true,
              "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
              ]
            });
          </script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <script>let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function(html) {
                let switchery = new Switchery(html,  { size: 'small' });
            });</script>
        <script>
          $('.delete-confirm').on('click', function (event) {
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
{{-- <script>
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "changeStatus",
            data: {'status': status, 'user_id': userId},
            success: function (data) {
                console.log(data.success);
                $('#message').fadeIn().html(data.success);
                setTimeout(function() {
					$('#message').fadeOut("slow");
				}, 1000 );

            }
        });
    });
});

  </script> --}}
        @endsection
        @section('scripts')


          @endsection





