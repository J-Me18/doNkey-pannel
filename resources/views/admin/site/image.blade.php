@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

@section('content')
<div class="card p-3">
    <form action="{{route('siteupdateimage')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="row">
            <div class="col-md-6">

                <div class="mb-3">
                    <input type="button" value="Add Another Image" onclick="add()" required
                        class=" float-right btn btn-primary btn-sm">
                </div>


                <div class="mb-3 image">
                    <label for="exampleFormControlInput1" class="form-label">Slider Image</label>
                    <input type="file" class="form-control mt-3" placeholder="Site Name" name="image[]">
                </div>

                <div class="mb-3 mt-3 float-end">

                    <input type="submit" value="Add" class="btn btn-primary btn-sm">
                    <input type="reset" value="Reset" class="btn btn-danger btn-sm">
                </div>

            </div>
            <div class="col-md-6">
                <?php $ii=0; ?>
                @foreach($site_details as $site)
                <?php $image=explode(',',$site->image);?>

                @foreach($image as $i)

                <?php $ii=$ii+1;?>
                <div class="row mt-4 justify-content-center align-items-center">
                    <!-- <div class="col-md-3"> -->
                    <img src="{{url('public/admin/upload')}}/{{$i}}" style="height:200px;width:200px" alt="">
                    <!-- </div> -->
                    <a href="{{url('admin/delete')}}/{{$ii}}" style="text-decoration:none"><span
                            class="fe fe-24 fe-trash text-danger"></span></a>
                </div>
                @endforeach

                @endforeach
            </div>
        </div>

        <script>
        function add() {
            $('.image').append(
                '<input type="file" required  class="form-control mt-3" placeholder="Site Name" name="image[]">');
        }
        </script>
    </form>
</div>
@endsection