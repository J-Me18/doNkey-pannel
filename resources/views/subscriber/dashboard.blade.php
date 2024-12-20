@extends('layouts.submaster')
@section('content')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </body>



    <style>
        @media only screen and (max-width: 565px) {
            /* Your styles for mobile devices with a width of 565px or less go here */

            /* Add more styles as needed */
            .complaints {
                display: contents !important;
            }

            .coupon {
                margin-left: 23px !important;
            }

            .coupons {
                margin-left: 11px !important;
            }
        }

        .card {
            width: 330px;
        }

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

        .color {
            background-color: #423e3e;
            color: #fff;
        }

        .color1 {
            color: #fff;
        }
    </style>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);



        h1 {
            font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
            color: #BBB;
            font-weight: 500;

            font-size: 40px;
        }

        .piechartWrapper {
            padding: 10px 50px;
            text-align: center;
        }

        .piechart {
            position: relative;
            display: inline-block;
            margin: 20px 10px;
            color: #BBB;
            font-family: 'Open Sans', sans-serif;
            font-size: 18px;
            text-align: center;
        }

        .piechart canvas {
            position: absolute;
            top: 0;
            left: 0;
        }


        .progresss {
            background: rgb(221 210 210 / 90%);
            justify-content: flex-start;
            border-radius: 100px;
            align-items: center;
            position: relative;
            padding: 0 5px;
            display: flex;
            height: 30px;
            width: 300px;
        }

        .progress-valuee {
            animation: loadd 3s normal forwards;
            box-shadow: 0 10px 40px -10px #fff;
            border-radius: 100px;
            background: #990347;
            height: 20px;
            width: 0;
        }

        @keyframes loadd {
            0% {
                width: 0;
            }

            100% {
                width: {{ $inactiveCoupons ? $inactiveCoupons : 0 }}%;
            }
        }

        .progressss {
            background: rgb(221 210 210 / 90%);
            justify-content: flex-start;
            border-radius: 100px;
            align-items: center;
            position: relative;
            padding: 0 5px;
            display: flex;
            height: 30px;
            width: 300px;
        }

        .progress-valueee {
            animation: loaddd 3s normal forwards;
            box-shadow: 0 10px 40px -10px #fff;
            border-radius: 100px;
            background: #0953b3;
            height: 20px;
            width: 0;
        }

        @keyframes loaddd {
            0% {
                width: 0;
            }

            100% {
                width: {{ $activeCoupons }}%;
            }
        }

        .cardss {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 20px auto;
            text-align: start;
            margin-left: -12px;
        }

        .cards {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 20px auto;
            text-align: center;
            margin-left: -5px;
        }

        .icon {
            font-size: 28px;
        }



        .topic {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>




    <body style="background-color: lightgray;">
        <div class="container mt-4">

            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="card color
                    " id="drivers-card">
                            <div class="card-body">
                                <h5 class="card-title color1">Drivers</h5>
                                <p class="card-text" id="drivers-content" style="display: none;">Total drivers:
                                    {{ $driversCount }}</p>
                            </div>

                        </div>

                        <div class="card color mt-4" id="riders-card">
                            <div class="card-body">

                                <h5 class="card-title color1">Riders</h5>
                                <p class="card-text" id="riders-content" style="display: none;"><b>Online count: </b>
                                    {{ $rideronlineCount }} <br> <b> Offline count: </b> {{ $riderofflineCount }}
                                </p>
                            </div>
                        </div>

                        <div class="card color mt-4" id="booking-card">
                            <div class="card-body">
                                <h5 class="card-title color1">Booking</h5>
                                <p class="card-text" id="booking-content" style="display: none;"> <b>New booking:</b>
                                    {{ $todaynewBookings }}
                                    <br> <b>Completed booking: </b>{{ $completedBookings }}
                                    <br> <b>Inprogress booking: </b>{{ $inprogressBooking }}
                                </p>
                            </div>
                        </div>
                        <div class="card color mt-4" id="enquiries-card">
                            <div class="card-body">
                                <h5 class="card-title color1">Total Enquiries</h5>
                                <p class="card-text" id="enquiries-content" style="display: none;"> <b> Total Enquiries:
                                    </b> {{ $enquiryCount }}</p>
                            </div>
                        </div>
                        <div class="card color  mt-4" id="employee-card">
                            <div class="card-body">
                                <h5 class="card-title color1">Total Employee</h5>
                                <p class="card-text" id="employee-content" style="display: none;"> <b> Total Employee: </b>
                                    {{ $employeeCount }}</p>
                            </div>
                        </div>


                    </div>


                    <div class="col-3 complaints">

                        <div class="card cards" style="margin-left:-11px;color:#fff;">
                            <h2>Complaints</h2>
                            <div class="col-12">
                                <div class="row">

                                    <div class=" col-6 column">
                                        <i class="fas fa-bars icon" style="color: green;"></i>
                                        <div class="topic" style="color: grey;"><b> Taken: </b>{{ $complaintTaken }}</div>
                                    </div>
                                    <div class="col-6 column">
                                        <i class="fas fa-check-circle icon" style="color: green;"></i>
                                        <div class="topic" style="color: grey;"> <b> Solved: </b>{{ $complaintSolved }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card cardss">
                            <div class="card-body">
                                <h5 class="card-title" style="color:black">Remember to Subscription</h5>
                                @if ($subscriptionDate)
                                    <p class="card-text" style="color:black">
                                        <strong style="color:black">Due Date:</strong>
                                        {{ $subscriptionDate->format('d-m-Y') }}
                                        <span style="color:red;font-weight:800;margin-left:120px;">
                                            <small style="font-weight:700; font-size:10px;">
                                                @if ($subscriptionDateCount === 0)
                                                    Today Expiring
                                                @elseif($subscriptionDateCount === 1)
                                                    Tomorrow Expiring
                                                @else
                                                    upto {{ $subscriptionDateCount }}
                                                    {{ $subscriptionDateCount > 1 ? 'Days' : 'Day' }}
                                                @endif
                                            </small>
                                        </span>
                                    </p>
                                @else
                                    <p class="card-text" style="color:black">Subscription date not available</p>
                                @endif
                            </div>


                        </div>
                        <div class="card cards" style="background-color: #423e3e;margin-left:-14px;">
                            <div class="card-header" style="font-weight: 900;background-color: #423e3e; color:aliceblue">
                                Total Blocked</div>
                            <h5 style="text-align: start; margin-left:30px;margin-top:30px; color:white">Riders :
                                <b>{{ $blockedRiders }}</b></h5>

                        </div>
                    </div>

                </div>
            </div>
        </div>



        </div>




        </div>
        </div>
        </div>
        <div class="row">
            <div class="col-6 complaints">

                <div class="card cards coupons " style="margin-left:35px;margin-top:50px;">
                    <h3>Coupons</h3>
                    <div class="col-4">
                        <h3 style="margin-top:35px ;  width:200px;">Active </h3>
                        <div class="progressss" style="margin-left:29px;">
                            <div class="progress-valueee"></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <h3 style="margin-top:50px ;  width:200px;">Inactive </h3>
                        <div class="progresss" style="margin-left:29px;">
                            <div class="progress-valuee"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-6 complaints">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card" style="margin-top: 30px;">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fas fa-rupee-sign float-left" style="width: 100px;"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ $totalServiceAmount }}</h3>
                                        <span>Total Cost</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card" style="margin-top: 20px; margin-left:-15px;">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fas fa-rupee-sign success font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{ $bikeTaxiTotal }}</h3>
                                            <span>Bike Taxi</span>
                                            <h3>{{ $pickupTotal }}</h3>
                                            <span>Pick Up</span>
                                            <h3>{{ $dropAndDeliveryTotal }}</h3>
                                            <span>Buy and Delivery</span>
                                            <h3>{{ $autoTotal }}</h3>
                                            <span>Auto</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div>
                <div class="sections">
                    <h3 style="text-align: center;font-weight:800;margin-top:30px;color:black;">RIDES</h3><br>
                    <div class="card cardd coupon" style="margin-left: 90px;">
                        <i class="fas fa-biking" style="color:black"></i>
                        <h4 style="margin-top: 10px;color:black;">Complete Rides</h4>
                        <h6 style="margin-top: 10px;color:black;">{{ $completeRides }}</h6>
                    </div>
                    <div class="card cardd">
                        <i class="fas fa-biking" style="color:black"></i>
                        <h4 style="margin-top: 10px;color:black;">Cancelled Rides</h4>
                        <h6 style="margin-top: 10px;color:black;">{{ $cancelledRides }}</h6>
                    </div>
                    <div class="card cardd">
                        <i class="fas fa-biking" style="color:black"></i>
                        <h4 style="margin-top: 10px;color:black;">Inprocess Rides</h4>
                        <h6 style="margin-top: 10px;color:black;">{{ $inprocessRides }}</h6>
                    </div>
                </div>
            </div>




        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Fetch the chart data from your Laravel route
                fetch("{{ route('getChartData') }}")
                    .then(response => response.json(console.log(response)))

                    .then(data => {
                        console.log(data);
                        // Create and update the charts using Chart.js
                        createDoughnutChart('chart1', data.chart1);
                        createDoughnutChart('chart2', data.chart2);
                        createDoughnutChart('chart3', data.chart3);
                        createDoughnutChart('chart4', data.chart4);
                    });
            });

            function createDoughnutChart(chartId, chartData) {
                var ctx = document.getElementById(chartId).getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: [chartData.label, 'Other'],
                        datasets: [{
                            data: [chartData.value, 100 - chartData.value],
                            backgroundColor: ['#03045e', '#0077b6'],
                        }, ],
                    },
                    options: {
                        cutoutPercentage: 70,
                    },
                });
            }
        </script>



        <script type="text/javascript" src="https://cdnjs.com/libraries/Chart.js"></script>
        <script>
            var bars = document.querySelectorAll('.progressss > div');
            console.clear();

            setInterval(function() {
                bars.forEach(function(bar) {
                    var getWidth = parseFloat(bar.dataset.progress);

                    for (var i = 0; i < getWidth; i++) {
                        bar.style.width = i + '%';
                    }
                });
            }, 500);
        </script>
        <script>
            var bars = document.querySelectorAll('.progresss > div');
            console.clear();

            setInterval(function() {
                bars.forEach(function(bar) {
                    var getWidth = parseFloat(bar.dataset.progress);

                    for (var i = 0; i < getWidth; i++) {
                        bar.style.width = i + '%';
                    }
                });
            }, 500);
        </script>



        <script>
            // JavaScript to toggle card content visibility on click
            function toggleCard(cardId, contentId) {
                var content = document.getElementById(contentId);
                if (content.style.display === 'none' || content.style.display === '') {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            }

            document.getElementById('drivers-card').addEventListener('click', function() {
                toggleCard('drivers-card', 'drivers-content');
            });

            document.getElementById('riders-card').addEventListener('click', function() {
                toggleCard('riders-card', 'riders-content');
            });

            document.getElementById('booking-card').addEventListener('click', function() {
                toggleCard('booking-card', 'booking-content');
            });

            document.getElementById('enquiries-card').addEventListener('click', function() {
                toggleCard('enquiries-card', 'enquiries-content');
            });

            document.getElementById('employee-card').addEventListener('click', function() {
                toggleCard('employee-card', 'employee-content');
            });
        </script>

    @endsection

