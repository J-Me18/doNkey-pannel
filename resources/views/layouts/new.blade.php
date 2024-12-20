@include('user/section/header')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        height: 100%;
    }

    body {
        min-height: 100%;
        background: #eee;
        font-family: 'Lato', sans-serif;
        font-weight: 400;
        color: #222;
        font-size: 14px;
        line-height: 26px;
        padding-bottom: 50px;
    }

    .container {
        max-width: 700px;
        background: #fff;
        margin: 0px auto 0px;
        box-shadow: 1px 1px 2px #DAD7D7;
        border-radius: 3px;
        padding: 40px;
        margin-top: 50px;
    }

    .header {
        margin-bottom: 30px;

        .full-name {
            font-size: 40px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .first-name {
            font-weight: 700;
        }

        .last-name {
            font-weight: 300;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .email,
        .phone {
            color: #999;
            font-weight: 300;
        }

        .separator {
            height: 10px;
            display: inline-block;
            border-left: 2px solid #999;
            margin: 0px 10px;
        }

        .position {
            font-weight: bold;
            display: inline-block;
            margin-right: 10px;
            text-decoration: underline;
        }
    }


    .details {
        line-height: 20px;

        .section {
            margin-bottom: 40px;
        }

        .section:last-of-type {
            margin-bottom: 0px;
        }

        .section__title {
            letter-spacing: 2px;
            color: #54AFE4;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .section__list-item {
            margin-bottom: 40px;
        }

        .section__list-item:last-of-type {
            margin-bottom: 0;
        }

        .left,
        .right {
            vertical-align: top;
            display: inline-block;
        }

        .left {
            width: 60%;
        }

        .right {
            tex-align: right;
            width: 39%;
        }

        .name {
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: #000;
            font-style: italic;
        }

        a:hover {
            text-decoration: underline;
            color: #000;
        }

        .skills {}

        .skills__item {
            margin-bottom: 10px;
        }

        .skills__item .right {
            input {
                display: none;
            }

            label {
                display: inline-block;
                width: 20px;
                height: 20px;
                background: #C3DEF3;
                border-radius: 20px;
                margin-right: 3px;
            }

            input:checked+label {
                background: #79A9CE;
            }
        }
    }
</style>

@if (session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('
        success ') }}',
        showConfirmButton: false,
        timer: 2500
    })
</script>
@endif




<center><img src="{{ asset('public/admin/assets/img/logo.jpg') }}" alt="logo" style="height:25px;width:25px; margin-bottom:-70px;"></center>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="card-title" >Booking Details</div>
            <div class="row">
                <div class="col-6">
                    <h4>Personal Details</h4>
                    <label for="name">Name:</label><br>
                    <label for="age">Age:</label><br>
                    <label for="mobile">Mobile:</label><br>
                    <label for="address">Address:</label><br>
                    <label for="state">State:</label><br>
                    <label for="area">Area:</label><br>
                    <label for="city">City:</label><br>
                    <label for="gender">Gender:</label><br>
                </div>
                <div class="col-6">
                    <h4>Health Details</h4>
                    <label for="pressure">Pressure:</label><br>
                    <label for="sugar">Sugar:</label><br>
                    <label for="consultingmode">Consulting mode:</label><br>


                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <center> <label for="physioname">Physio Name:</label><br>
                        <label for="status">Status:</label><br>
                        <label for="bookedat">Booked at:</label><br>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <div class="details">



    </div>


</div>

{{-- @include('user/section/footer') --}}
