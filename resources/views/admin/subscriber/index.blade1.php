@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
              <h2 class="mb-2 page-title">Subscriber</h2>

                <div class="col ml-auto">
                    <div class="dropdown float-right">
                      <a href="{{ url('createSubscriber') }}"><button class="btn btn-primary float-right ml-3" type="button">Add more +</button></a>

                    </div>
                  </div>


            </div>
              <p class="card-text"> </p>
              <div class="row" >
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
                  <div class="alert alert-warning alert-dismissible fade show" role="alert"  x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
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
                            <th>Name</th>
                            <th>Location</th>

                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Block</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            @foreach ($subscriber as $subscriber)
                          <tr>


                            <td>{{ $i}}</td>
                            <td>{{$subscriber->name}}</td>
                            <td>{{$subscriber->location}}</td>

                            <td>{{$subscriber->mobile}}</td>

                            <td>

                                <input type="checkbox" data-id="{{ $subscriber->id }}" name="status" class="js-switch" {{ $subscriber->status == 1 ? 'checked' : '' }}>

                            </td>
                                <td>
                                    @if($subscriber->status == 2)
                                    <span class="badge badge-danger">Blocked</span>
                                    @else
                                    <button type="button" class="btn mb-2 btn-outline-danger" data-toggle="modal" data-target="#verticalModal{{ $subscriber->id }}">Block</button>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ url('subscriber/show/'.$subscriber->id)}}"><span class="fe fe-24 fe-eye text-warning"></span></a>

                                <a href="{{ url('subscriber/'.$subscriber->id)}}"><span class="fe fe-24 fe-edit text-success"></span></a>

                                <a href="{{ url('subscriberdelete/'.$subscriber->id)}}" class="button delete-confirm"><span class="fe fe-24 fe-trash text-danger"></span></a>
                            </td>
                          </tr>

                          <!--Modal-->
                          <div class="modal fade" id="verticalModal{{ $subscriber->id }}" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="verticalModalTitle">Block Subscriber</h5>
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
                          <!--End modal-->
                          <?php $i++;?>
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
<script>
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

  </script>
        @endsection
        @section('scripts')


          @endsection
