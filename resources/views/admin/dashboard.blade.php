@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- jQuery -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezFMOgKl3zV5dA1lBcULjxAOfcOV6u3yG5B12Wg/uDlWVfddWxl5e5z1dN2t8l95" crossorigin="anonymous"> -->


    <!-- jQuery UI (Date Picker) -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->

    <!-- Include Chart.js and Chart.js Zoom Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    <style>
        @media only screen and (max-width: 565px) {
            .subscribe {
                margin-left: 1px !important;
            }

            .conten {
                display: contents !important;
                /* margin-left: 22px !important; */
            }

            .oval {
                margin-left: 16px !important;
            }

            .rrr {
                margin-left: 22px !important;
                margin-bottom: 15px !important;
            }

            .serv {
                margin-left: 16px !important;
                display: inline-block !important;
                width: 275px !important;
            }

            .earn {
                margin-left: 30px !important;
                margin-top: 30px !important;
            }

            .categories {
                border-radius: 3px !important;
                margin-bottom: 10px !important;
            }

            .ride {
                display: contents !important;

            }

            .newss {

                display: inline-grid !important;
            }

            .first {
                margin-left: 25px !important;
            }

            .second {
                margin-left: 25px !important;
                margin-bottom: 15px !important;
            }

            .rr {
                display: contents !important;
            }

            .headingg {
                margin-top: 30px !important;
            }

            .ro {
                display: contents !important;
            }
        }

        .sections {
            background: rgba(255, 255, 255, 0.1);
            /* 3D glass background color */
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cardb {
            width: 200px;
            padding: 20px;
            border-radius: 15px;
            background: #f0f0f0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .cardb.highlighted {
            background: #ffcc00;
            /* Highlighted background color */
        }

        .cardb:nth-child(1) {
            /* Custom styling for the first card */

            color: #ffcc00;
            /* Text color */
            border: 2px solid #ffcc00;
            /* Border color */
        }

        .cardb:nth-child(2) {
            /* Custom styling for the second card */
            margin-left: 50px;
            color: #ff5733;
            /* Text color */
            border: 2px solid #ff5733;
            /* Border color */
        }

        .cardb:nth-child(3) {
            /* Custom styling for the second card */
            margin-left: 50px;


            color: #000000;
            /* Text color */
            border: 2px solid #000000;
            /* Border color */
        }

        .cardb:nth-child(4) {
            /* Custom styling for the second card */
            margin-left: 40px;

            color: #ff5733;
            /* Text color */
            border: 2px solid #ff5733;
            /* Border color */
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend+Deca&family=Poppins:wght@400;600&display=swap');

        .username-container {
            background-color: #16161a;
            width: 280px;
            display: flex;
            border-radius: 50px;
            padding: 10px;
            justify-content: space-between;
        }

        .profile-container {
            display: flex;
            gap: 0.5em;
            justify-content: space-between;
            align-items: center;
        }

        .profile-description {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .profile-img {
            border-radius: 50%;
            width: 70px;
            height: 70px;
            overflow: hidden;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-title {
            color: white;
            font-weight: bold;
            font-size: 1.2em;
        }

        .username {
            color: #fff;
        }

        .menu-bar {
            display: flex;
            align-items: center;
        }

        .menu-bar i {
            font-size: 25px;
            color: white;
        }

        .menu-bar i:hover {
            cursor: pointer;
        }
    </style>


    <style>
        .ridess {
            background-color: #423e3e !important;
        }

        .cardd {
            font-family: sans-serif;
            padding: 1rem;
            width: 250px;
            height: 10rem;
            float: left;
            margin: 1.5rem;
            background: white;
            box-shadow: 0 0 6px 2px rgba(0, 0, 0, .1);
            transition: all .2s ease;
            border-bottom: 2px solid transparent;
        }

        .cardd:hover {
            border-bottom: 2px solid #008571;
        }

        .cardd.selected {
            transform: scale(1.075);
            box-shadow: 0 0 16px 1px rgba(0, 0, 0, .3);
        }

        .cardds {
            font-family: sans-serif;
            padding: 1rem;
            width: 270px;
            height: 11rem;
            float: left;
            margin: 1.5rem;
            background: white;
            box-shadow: 0 0 6px 2px rgba(0, 0, 0, .1);
            transition: all .2s ease;
            border-bottom: 2px solid transparent;
        }

        .cardds:hover {
            border-bottom: 2px solid blue;
        }

        .cardds.selected {
            transform: scale(1.075);
            box-shadow: 0 0 16px 1px rgba(0, 0, 0, .3);
        }
    </style>

    <style>
        .card-small-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.05);

        }

        .circle-sm {
            width: 80px !important;
            height: 80px !important;
        }

        .circle {
            display: inline-flex;
            border-radius: 0%;
            align-items: center !important;
            text-align: center;
        }

        @media screen and (min-width: 1440px) {
            .cards {
                width: 306px !important;
            }

        }
    </style>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    @if ($checking == '')
                        <div class="col-md-4 col-xl-3 mb-4">
                            <div class="card cards shadow border-0" style="background-color:#423e3e; width:300px;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-primary">
                                                <i class="fas fa-sign-in-alt"
                                                    style="padding-left:31.5px; color:white !important;"></i>
                                            </span>
                                        </div>
                                        <div class="col pr-0">
                                            <form action="{{ route('checking.store') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-light"
                                                    style="margin-bottom: 30px; margin-left:30px; color:black;">Check
                                                    In</button>
                                            </form>
                                            <span class="h6 mb-0 mt-3" style="font-size:15px; color:white;">You Currently
                                                Check Out</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($checking->notes == 1)
                        <div class="col-md-4 col-xl-3 mb-4">
                            <div class="card cards shadow border-0" style="background-color:#423e3e; width:300px;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-primary">
                                                <i class="fas fa-sign-in-alt"
                                                    style="padding-left:31.5px; color:white !important;"></i>
                                            </span>
                                        </div>
                                        <div class="col pr-0">
                                            <form action="{{ route('checking.store') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-light"
                                                    style="margin-bottom: 30px; margin-left:30px; color:black;">Check
                                                    In</button>
                                            </form>
                                            <span class="h6 mb-0 mt-3"
                                                style="font-size:15px; color:white; margin-left:20px;">You Currently Check
                                                Out</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($checking != '')
                        @if ($checking->notes == 0)
                            <div class="col-md-4 col-xl-3 mb-4">
                                <div class="card cards shadow border-0" style="background-color:lightgray; width:300px;">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-center">
                                                <span class="circle circle-sm bg-primary">
                                                    <i class="fas fa-sign-out-alt"
                                                        style="padding-left:31.5px; color:white !important;"></i>
                                                </span>
                                            </div>

                                            <div class="col pr-0">
                                                <form action="{{ route('checking.update', $checking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-dark"
                                                        style="margin-bottom: 30px; margin-left:30px; color:white;">Check
                                                        Out</button>
                                                </form>
                                                <span class="h6 mb-0 mt-3"
                                                    style="color:black; margin-left:30px;">{{ $checking->created_at->format('d:m:Y h:i:s A') }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="col-md-4 col-xl-3 mb-4 subscribe" style="margin-left: 100px;">
                        <a href="{{ route('subscriber') }}">
                            <div class="card cards shadow border-0" style="background-color:#423e3e; width:300px;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-success">
                                                <i class="fas fa-user"
                                                    style="padding-left:31.5px; color:white !important;"></i>
                                            </span>
                                        </div>
                                        <div class="col pr-0">
                                            <p class=""
                                                style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                                Subscribers</p>
                                            <span class="h3 mb-0"
                                                style="margin-left:30px; color:white;">{{ $subscriberCount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4 subscribe" style="margin-left: 100px;">
                        <a href="{{ route('enduser') }}">
                            <div class="card cards shadow border-0" style="background-color:#423e3e; width:300px;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-secondary"
                                                style="background-color: #0456ae !important;">
                                                <i class="fas fa-users"
                                                    style="padding-left:31.5px; color:white !important;"></i>
                                            </span>
                                        </div>
                                        <div class="col pr-0">
                                            <p class=""
                                                style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                                End Users</p>
                                            <span class="h3 mb-0"
                                                style="margin-left:30px; color:white;">{{ $enduser }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4">
                        <a href="{{ route('category') }}">
                            <div class="card cards shadow border-0" style="background-color:#423e3e; width:300px;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-danger">
                                                <i class="fas fa-bars"
                                                    style="padding-left:31.5px;color:white !important;"></i>
                                            </span>
                                        </div>
                                        <div class="col pr-0">
                                            <p class=""
                                                style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                                Category</p>
                                            <span class="h3 mb-0"
                                                style="margin-left:30px; color:white;">{{ $category }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4 subscribe" style="margin-left: 100px;">
                        <a href="{{ route('drivers') }}">
                            <div class="card cards shadow border-0" style="background-color:#423e3e; width:300px;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-warning">
                                                <i class="fas fa-biking"
                                                    style="padding-left:31.5px;color:white !important;"></i>
                                            </span>
                                        </div>
                                        <div class="col pr-0">
                                            <p class=""
                                                style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                                Drivers</p>
                                            <span class="h3 mb-0"
                                                style="margin-left:30px; color:white;">{{ $driversCount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4 subscribe" style="margin-left: 100px;">
                        <a href="{{ route('bookingReport') }}">
                            <div class="card cards shadow border-0" style="background-color:#423e3e; width:300px;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-light"
                                                style="background-color:orangered !important;">
                                                <i class="fas fa-clipboard-check"
                                                    style="padding-left:31.5px;color:white !important;"></i>
                                            </span>
                                        </div>
                                        <div class="col pr-0">
                                            <p class=""
                                                style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                                Bookings</p>
                                            <span class="h3 mb-0"
                                                style="margin-left:30px; color:white;">{{ $bookingCount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>




            <script>
                // Static values for the line chart
                const days = @json(range(1, 30)); // Generate an array from 1 to 30
                const salesCount = @json($salesCount); // Assuming $salesCount is a dynamic variable

                // Create the line chart
                const ctx = document.getElementById('lineChart').getContext('2d');
                const lineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: days, // Array of labels for the x-axis
                        datasets: [{
                            label: 'Sales',
                            data: salesCount, // Array of values for the y-axis
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            fill: false, // Do not fill the area under the line
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Days',
                                    color: 'rgba(75, 192, 192, 1)',
                                    font: {
                                        weight: 'bold',
                                    },
                                },
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Sales',
                                    color: 'rgba(75, 192, 192, 1)',
                                    font: {
                                        weight: 'bold',
                                    },
                                },
                                stepSize: 1, // Specify the step size to ensure integer values
                            },
                        },
                    },
                });
            </script>


        </div>
    </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-4">
            <div class="col-md-4 col-xl-3 mb-4" style="margin-top: 30px;">
                <div class="card cards shadow border-0" style="background-color:#423e3e; width:300px;">
                    <div class="card-body">




                        <div class="row align-items-center" style="margin-top: 10px; ">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                    <i class="fas fa-users" style="padding-left:31.5px; color:white !important;"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class=""
                                    style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                    Total Complaints</p>
                                <span class="h3 mb-0" style="margin-left:30px; color:white;">{{ $complaintCount }}</span>
                            </div>
                        </div>
                        <hr style="color:#f0f0f0;">
                        <div class="row align-items-center" style="margin-top: 25px; ">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-success">
                                    <i class="fas fa-users" style="padding-left:31.5px; color:white !important;"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class=""
                                    style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                    Solved Complaints</p>
                                <span class="h3 mb-0"
                                    style="margin-left:30px; color:white;">{{ $solvedComplaints }}</span>
                            </div>
                        </div>
                        <hr style="color:#f0f0f0;">
                        <div class="row align-items-center" style="margin-top: 20px; ">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-danger">
                                    <i class="fas fa-users" style="padding-left:31.5px; color:white !important;"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class=""
                                    style="margin-bottom: 30px; margin-left:35px; color:white; font-weight:700; font-size:19px;">
                                    Total Enquiries</p>
                                <span class="h3 mb-0" style="margin-left:35px; color:white;">{{ $enquiryCount }}</span>
                            </div>
                        </div>
                        <hr style="color:#f0f0f0;">
                        <div class="row align-items-center" style="margin-top: 30px; margin-bottom:10px ">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-warning">
                                    <i class="fas fa-users" style="padding-left:31.5px; color:white !important;"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class=""
                                    style="margin-bottom: 30px; margin-left:35px; color:white; font-weight:700; font-size:19px;">
                                    Total Employee</p>
                                <span class="h3 mb-0" style="margin-left:35px; color:white;">{{ $employeeCount }}</span>
                            </div>
                        </div>
                    </div>








                </div>






            </div>

        </div>
        <div class="col-4 conten">
            <div class="col-md-4 col-xl-3 mb-4" style="margin-top: 30px;">
                <div class="card cards shadow border-0 oval" style="background-color:#423e3e; width:300px;">
                    <div class="card-body">




                        <div class="row align-items-center" style="margin-top: 10px; ">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                    <i class="fas fa-rupee-sign" style="padding-left:31.5px; color:white !important;"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class=""
                                    style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                    Overall Booking</p>
                                <span class="h3 mb-0" style="margin-left:30px; color:white;">{{ $bookingCost }}</span>
                            </div>
                        </div>
                        <hr style="color:#f0f0f0;">
                        <div class="row align-items-center" style="margin-top: 25px; ">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-success">
                                    <i class="fas fa-rupee-sign" style="padding-left:31.5px; color:white !important;"></i>
                                </span>
                            </div>
                            <?php
                            // Calculate GST amount
                            $gstAmount = ($completedBookingTotal * 23) / 100;
                            
                            // Calculate total amount including GST
                            $totalAmountWithGst = $completedBookingTotal + $gstAmount;
                            ?>
                            <div class="col pr-0">
                                <p class=""
                                    style="margin-bottom: 30px; margin-left:30px; color:white; font-weight:700; font-size:19px;">
                                    Completed Amount</p>
                                <span class="h3 mb-0" style="margin-left:30px; color:white;">{{ $completedBookingTotal }}
                                    &nbsp; <small>(23%) &nbsp; {{ $totalAmountWithGst }}</small> </span>

                            </div>
                        </div>
                        <hr style="color:#f0f0f0;">
                        <div class="row align-items-center" style="margin-top: 20px; ">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-danger">
                                    <i class="fas fa-rupee-sign" style="padding-left:31.5px; color:white !important;"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class=""
                                    style="margin-bottom: 30px; margin-left:35px; color:white; font-weight:700; font-size:19px;">
                                    Cancelled Amount</p>
                                <span class="h3 mb-0"
                                    style="margin-left:35px; color:white;">{{ $cancelledBookingTotal }}</span>
                            </div>
                        </div>
                        <hr style="color:#f0f0f0;">
                        <div class="row align-items-center" style="margin-top: 30px; margin-bottom:10px ">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-warning">
                                    <i class="fas fa-rupee-sign" style="padding-left:31.5px; color:white !important;"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class=""
                                    style="margin-bottom: 30px; margin-left:35px; color:white; font-weight:700; font-size:19px;">
                                    Inprocess Amount</p>
                                <span class="h3 mb-0"
                                    style="margin-left:35px; color:white;">{{ $inprocessBookingTotal }}</span>
                            </div>
                        </div>
                    </div>








                </div>






            </div>

        </div>
        <div class="col-4">
            <h3 style="text-align: center; margin-top:30px;" class="serv">Total Service Cost</h3>
            <!--  <h3 style="text-align: center;margin-top:50px;">Services</h3>-->
            <div class="username-container" style="margin-top:20px;margin-left:70px;">
                <div class="profile-container">
                    <div class="profile-img">
                        <i class="fas fa-biking"
                            style=" color:white !important;margin-top:8px;font-size:31px;margin-left:10px;"></i>

                    </div>
                    <div class="profile-description">
                        <p class="user-title">{{ $totalServiceAmount }} </p>
                        <p class="username">Total Service Cost</p>
                    </div>
                </div>

            </div>
            <!--  <h3 style="text-align: center;margin-top:50px;">Services</h3>-->
            <div>
                <h3 style="text-align: center; margin-top:30px;" class="serv">Expired Subscribers</h3>
                <div class="username-container" style="margin-top:20px;margin-left:70px;">
                    <div class="profile-container">
                        <div class="profile-img">

                            <i class="fas fa-users"
                                style=" color:white !important;margin-top:8px;font-size:31px;margin-left:10px;"></i>

                        </div>
                        <div class="profile-description">
                            <p class="user-title">{{ $expiredSubscriberCount }}</p>
                            <p class="username">Subscribers</p>
                        </div>
                    </div>

                </div>
                <div class="username-container" style="margin-left:70px; margin-top:50px;">
                    <div class="profile-container">
                        <div class="profile-img">
                            <i class="fas fa-money-check-alt"
                                style=" color:white !important;margin-top:12px !important;font-size:31px;margin-left:10px;"></i>
                        </div>
                        <div class="profile-description">
                            <p class="user-title">{{ $expiredSubscriptionPrice }}</p>
                            <p class="username">Subscription Price</p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var myColor = ["#007bff", "#dc3545", "#28a745"];
                var myData = [
                    {{ $bikeTaxiTotal }},
                    {{ $pickupTotal }},
                    {{ $dropAndDeliveryTotal }}
                ];
                var myLabel = ["Bike Taxi", "Pick Up", "Buy And Delivery"];

                var ctx = document.getElementById('pieChart').getContext('2d');
                var pieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: myLabel,
                        datasets: [{
                            data: myData,
                            backgroundColor: myColor,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                    var total = dataset.data.reduce(function(previousValue, currentValue) {
                                        return previousValue + currentValue;
                                    });
                                    var currentValue = dataset.data[tooltipItem.index];
                                    var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                    return myLabel[tooltipItem.index] + ': ' + percentage + '%';
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    </div>
    </div>


    </div>
    <div class="col-12" style="margin-top:60px; ">
        <div class="row">



            <div class="card shadow border-0"
                style="width:480px;background-color:tomato;margin-left:30px;border-radius:0px !important;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="icon icon-shape  text-white text-lg "
                                style="font-size: 50px !important;justify-content:center;margin-left:20px;">
                                <i class="fas fa-money-check-alt"></i>
                            </div>
                        </div>

                        <div class="col-8">
                            <span class="h6 font-semibold text-muted text-sm d-block mb-2"
                                style="font-size: 20px !important; color:white !important;">Subscription Price</span>
                            <span class="h3 font-bold mb-0 amount" style="color:white;">₹
                                {{ $subscriptionAmount }}</span>

                            {{-- Calculate and display GST --}}
                            @php
                                $gstRate = 18; // GST rate in percentage
                                $gstAmount = ($subscriptionAmount * $gstRate) / 100; // Calculate GST amount
                                $totalAmountWithGST = $subscriptionAmount + $gstAmount; // Add GST to the original amount
                            @endphp

                            <span class="h6 font-semibold text-muted text-sm d-block mt-2"
                                style="font-size: 18px !important; color:white !important;">GST (18%)</span>
                            <span class="h3 font-bold mb-0 amount" style="color:white;">₹
                                {{ number_format($gstAmount, 2) }}</span>

                            {{-- Display total amount with GST --}}
                            <span class="h6 font-semibold text-muted text-sm d-block mt-2"
                                style="font-size: 18px !important; color:white !important;">Total Amount (including
                                GST)</span>
                            <span class="h3 font-bold mb-0 amount" style="color:white;">₹
                                {{ number_format($totalAmountWithGST, 2) }}</span>
                        </div>


                    </div>

                </div>
            </div>
            <div class="card earn shadow border-0"
                style="width:480px; background-color:#423e3e;margin-left:90px;border-radius:0px !important;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="icon icon-shape  text-white text-lg "
                                style="font-size: 50px !important;justify-content:center;margin-left:20px;">
                                <i class="fas fa-money-check-alt"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <span class="h6 font-semibold text-muted text-sm d-block mb-2"
                                style="font-size: 20px !important; color:white !important;">PBP Total Earnings</span>
                            <span class="h3 font-bold mb-0 amount" style="color:white;">₹
                                {{ $totalServiceAmount }}</span>

                            {{-- Calculate and display GST --}}
                            @php
                                $gstRate = 23; // GST rate in percentage
                                $gstAmount = ($totalServiceAmount * $gstRate) / 100;
                                $totalAmountWithGST = $totalServiceAmount + $gstAmount;
                            @endphp

                            <span class="h6 font-semibold text-muted text-sm d-block mt-2"
                                style="font-size: 18px !important; color:white !important;">GST (23%)</span>
                            <span class="h3 font-bold mb-0 amount" style="color:white;">₹
                                {{ number_format($gstAmount, 2) }}</span>

                            {{-- Display total amount with GST --}}
                            <span class="h6 font-semibold text-muted text-sm d-block mt-2"
                                style="font-size: 18px !important; color:white !important;">Total Amount (including
                                GST)</span>
                            <span class="h3 font-bold mb-0 amount" style="color:white;">₹
                                {{ number_format($totalAmountWithGST, 2) }}</span>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    <center>
        <center>
            <h3 style="margin-top:50px;margin-bottom:-30px;font-weight:900; font-family:'Times New Roman', Times, serif">
                <u class="shadow lg"> SERVICES WITH CATEGORY TYPE </u>
            </h3>
        </center><br>

        <div class="row" style="margin-top: 50px;">
            <div class="col-md-4">

                <div class="card cards shadow categories shadow-lg"
                    style="border:none;background-color:#007bff !important;width:330px; height:100px; border-radius:0;">
                    <div class="card-body">
                        <h5 style="font-weight:800;margin-bottom:20px; color:white;"> Bike Taxi</h5>
                        <h6 style="font-weight:500; color:white;"><b> Amount:</b>₹ {{ $bikeTaxiTotal }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cards categories shadow shadow-lg"
                    style="border:none; width:330px; height:100px; background-color:#dc3545; border-radius:0;">
                    <div class="card-body">
                        <h5 style="font-weight:800;margin-bottom:20px; color:white;"> Pick Up</h5>
                        <h6 style="font-weight:500; color:white;"> <b> Amount:</b>₹ {{ $pickupTotal }} </h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cards categories shadow shadow-lg"
                    style="border:none; width:330px; height:100px;background-color:#28a745; border-radius:0;">
                    <div class="card-body">
                        <h5 style="font-weight:800;margin-bottom:20px; color:white;">Buy and Delivery</h5>
                        <h6 style="font-weight:500; color:white;"><b>Amount:</b> ₹{{ $dropAndDeliveryTotal }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="card cards categories shadow shadow-lg"
                    style="border:none; width:330px; height:100px;background-color:#f1e20c; border-radius:0;">
                    <div class="card-body">
                        <h5 style="font-weight:800;margin-bottom:20px; color:rgb(0, 0, 0);">Auto</h5>
                        <h6 style="font-weight:500; color:rgb(0, 0, 0);"><b>Amount:</b> ₹{{ $autoTotal }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>

        <h3 style="text-align: center;font-weight:800;margin-top:50px;">RIDES</h3><br>

        <div class="sections ride" style="margin-top: 10px;">
            <div class="card cardd first" style="margin-left: 90px;">
                <i class="fas fa-biking" style="color:black;"></i>
                <h4 style="margin-top: 10px;color:black;">Complete Rides</h4>
                <h6 style="margin-top: 10px;color:black;">{{ $completeRides }}</h6>
            </div>
            <div class="card cardd">
                <i class="fas fa-biking" style="color:black;"></i>
                <h4 style="margin-top: 10px;color:black;">Cancelled Rides</h4>
                <h6 style="margin-top: 10px;color:black;">{{ $cancelledRides }}</h6>
            </div>
            <div class="card cardd">
                <i class="fas fa-biking" style="color:black;"></i>
                <h4 style="margin-top: 10px;color:black;">Inprocess Rides</h4>
                <h6 style="margin-top: 10px;color:black;">{{ $inprocessRides }} </h6>
            </div>
        </div>


        </div>
        <div class="row newss" style="margin-top: 50px;">
            <div class="col-3">
                <div class="cardb second" style="width: 250px;height:100px">
                    <h3 style="color:black;">Newsletter</h3>
                    <p class="highlighted"> <b>Count :</b> <b style="color: #000000;"> {{ $newsletterCount }} </b></p>
                    {{-- <h3 style="color:black;">Feedback</h3> --}}
                    {{-- <p class="highlighted"> <b> Count : </b> <b style="color: #000000;">{{ $feedbackCount }} </b></p> --}}
                </div>

            </div>
            <div class="col-3">
                <div class="cardb second" style="width: 250px;height:100px">
                    {{-- <h3 style="color:black;">Newsletter</h3> --}}
                    {{-- <p class="highlighted"> <b>Count :</b> <b style="color: #000000;"> {{ $newsletterCount }} </b></p> --}}
                    <h3 style="color:black;">Feedback</h3>
                    <p class="highlighted"> <b> Count : </b> <b style="color: #000000;">{{ $feedbackCount }} </b></p>
                </div>

            </div>

            <div class="col-6">
                <div class="card" style="background-color: #423e3e;height:180px; width:390px;">
                    <div class="card-header" style="font-weight: 900;background-color: #423e3e; color:aliceblue">Total
                        Blocked</div>
                    <h5 style="text-align: start; margin-left:30px;margin-top:30px; color:white">Riders :
                        <b>{{ $blockedRiders }}</b>
                    </h5>
                    <h5 style="text-align: start; margin-left:30px;color:white">Subscribers :
                        <b>{{ $blockedSubscribers }}</b>
                    </h5>
                </div>
            </div>

        </div>
        <br>
        <h4 style="font-weight:800;color:black;" class="headingg"> Remaining Days of Expired Subscriber
        </h4>
        <div class="col">

            <div class="card-body row ro">
                <div class="col-1"></div>
                @foreach ($counts as $day)
                    <div class="col-2 mb-3 rr">
                        <div class="card rrr" style="border:2px solid blue;border-radius:6px;background-color: #dbebfd;">
                            <div class="card-body">
                                <i class="fas fa-users" style="color:#343436  ;margin-bottom:10px; font-size:20px;"></i>
                                <h6 style="color: #16161a;font-weight:800;">{{ $day['days_left'] }} Member: <br><span
                                        style="color: rgb(0, 153, 255)">{{ $day['count'] }}</span> </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-1"></div>
            </div>

        </div>





        <!-- Bootstrap 4 requires Popper.js and Bootstrap JS -->


        <script>
            // Initialize popover
            $(function() {
                $('[data-toggle="popover"]').popover()
            })
        </script>
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-6">

            </div>
            <div class="col-md-6"></div>

        </div>

        <script>
            $(".cardd").click(function() {
                $(this).toggleClass("selected");
            });
        </script>
        <script>
            $(".cardds").click(function() {
                $(this).toggleClass("selected");
            });
        </script>
        </div>
        </div>
        </div>
        </div>

        </div>
    </center>




    </div>
    </div>



    </div> <!-- end section -->


    </div>
    </div> <!-- .row -->

    </div> <!-- .container-fluid -->

    </div>
    <script>
        $(document).ready(function() {
            // Initialize date pickers
            $("#from-date").datepicker();
            $("#to-date").datepicker();

            // Initialize filter dropdown with Select2
            $("#filter").select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            // ...

            // Handle filter button click
            $("#apply-filter").click(function() {
                // Get selected filter and date range
                const selectedFilter = $("#filter").val();
                const fromDate = $("#from-date").val();
                const toDate = $("#to-date").val();

                // Perform filtering based on selectedFilter, fromDate, and toDate
                // Implement your filtering logic here and update the displayed data accordingly
                console.log("Selected Filter:", selectedFilter);
                console.log("From Date:", fromDate);
                console.log("To Date:", toDate);
            });
        });
    </script>
@endsection

