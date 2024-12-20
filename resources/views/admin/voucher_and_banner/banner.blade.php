
@extends('layouts.master')
@section('content')


<div class="container  ">
@error('banner')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
  @if(session('success')!="")
  <div class="alert alert-success">{{ session('success')}}</div>
  @endif
  <form action="{{url('bannersubmit')}}" method="post" enctype="multipart/form-data">
    @csrf
<div class="col-md-12">
  banner Image
<div class="input-group mb-3">
  <input type="file" class="form-control" name="banner" aria-label="Recipient's username" aria-describedby="basic-addon2">
  
  <div class="input-group-append">
    <!-- <span class="input-group-text" id="basic-addon2">@example.com</span> -->
    <input type="submit" value="Upload" class="btn btn-primary">
  </div>
</div>
</div>
</form>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Edit Voucher</h5>
        <button type="button" class="btn  close1" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form action="{{url('bannereditsubmit')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <input type="file" name="image" class="form-control" id="">
        <input type="text" class="inputid" name="id" hidden>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close1" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
@foreach($banner as $v)

<div class="row container" style="margin-top:10px">
<div class="col-md-4">
  <img src="{{url('admin/banner/').'/'.$v->images}}" alt="" style="height:200px;width:200px;border-radius:10px">
</div>
<div class="col-md-4 d-flex align-items-center "  >
<a class="btn btn-primary mr-4" onclick="showmodal('{{$v->id}}')" href="#" >Edit</a>
<a class="btn btn-danger" href="{{url('bannerdelete').'/'.$v->id}}">Delete</a>
</div>
    </div>
@endforeach

@if(count($banner)==0)
<div class="row container">
No Data
</div>
@endif
</div>

<script>
  function showmodal(val)
    {
      $("#myModal").modal('show');
      $(".inputid").val(val);
    }
  setTimeout(function(){
    $(".alert").hide();
  },2000);
  $(document).ready(function(){
    $('.editbutton').on("click",function(){

      $("#myModal").modal('show');
    })
    
    $('.close1').on("click",function(){

$("#myModal").modal('hide');
})
  })
</script>
@endsection