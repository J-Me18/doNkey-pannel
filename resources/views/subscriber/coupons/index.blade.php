@extends('layouts.submaster')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
               <h2 class="mb-2 page-title">Coupons</h2>

              <div class="col ml-auto">
                <div class="dropdown float-right">
                  <a href="{{ url('subscribers/coupons/create') }}"><button class="btn btn-primary float-right ml-3" type="button">Add more +</button></a>

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
                            <th>Code</th>
                            <th>Valid From</th>
                            <th>Valid To</th>
                             <th>Limit</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            @foreach ($coupons as $coupons)
                          <tr>


                            <td>{{ $i}}</td>
                            <td>{{$coupons->name}}</td>
                            <td>{{$coupons->code}}</td>
                            <td>{{$coupons->valid_from}}</td>
                            <td>{{$coupons->valid_to}}</td>
                            <td>{{$coupons->user_limit}}</td>

                            <td>

                                <input type="checkbox" data-id="{{ $coupons->id }}" name="status" class="js-switch" {{ $coupons->active == 1 ? 'checked' : '' }}>

  </td>

<td>
{{-- <a href="{{ url('coupons/show/'.$coupons->id)}}"><span class="fe fe-24 fe-eye text-warning"></span></a> --}}
<a href="{{ url('subscribers/coupons/'.$coupons->id)}}"><span class="fe fe-24 fe-edit text-success"></span></a>
<a href="{{ url('subscribers/couponsdelete/'.$coupons->id)}}" class="button delete-confirm"><span class="fe fe-24 fe-trash text-danger"></span></a>


</td>

                          </tr>


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
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let Id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/couponsActivate",
            data: {'status': status, 'id': Id},
            success: function (data) {
               // console.log(data.success);
                $('#message').fadeIn().html(data.success);
                setTimeout(function() {
					$('#message').fadeOut("slow");
				}, 1000 );

            }
        });
    });
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
        @endsection
        @section('scripts')


          @endsection
