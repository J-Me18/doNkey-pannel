<!doctype html>
<html lang="en">

<head>
    @php
        $site = App\Models\site::where('id', 1)->first();
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('public/site/' . $site->main_logo) }}" type="image/x-icon">
    <title>do N key PBP Panel</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/feather.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('admin/css/app-dark.css') }}" id="darkTheme" disabled>
    <style>
        /* Loader styles */
        .loader {
            width: 40px;
            height: 20px;
            --c: no-repeat radial-gradient(farthest-side, #000 93%, #0000);
            background: var(--c) 0 0, var(--c) 50% 0, var(--c) 100% 0;
            background-size: 8px 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: l4-0 1s linear infinite alternate;
            z-index: 9999;
            /* Ensure loader is on top */
        }

        .loader:before {
            content: "";
            position: absolute;
            width: 8px;
            height: 12px;
            background: #000;
            left: 0;
            top: 0;
            animation: l4-1 1s linear infinite alternate, l4-2 0.5s cubic-bezier(0, 200, .8, 200) infinite;
        }

        @keyframes l4-0 {
            0% {
                background-position: 0 100%, 50% 0, 100% 0
            }

            8%,
            42% {
                background-position: 0 0, 50% 0, 100% 0
            }

            50% {
                background-position: 0 0, 50% 100%, 100% 0
            }

            58%,
            92% {
                background-position: 0 0, 50% 0, 100% 0
            }

            100% {
                background-position: 0 0, 50% 0, 100% 100%
            }
        }

        @keyframes l4-1 {
            100% {
                left: calc(100% - 8px)
            }
        }

        @keyframes l4-2 {
            100% {
                top: -0.1px
            }
        }

        /* Blur effect */
        .blur {
            filter: blur(5px);
            transition: filter 0.3s ease;
        }

        /* Hide loader initially */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            /* Light background for loader */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
</head>

<body class="light ">
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="wrapper vh-100">
        <button type="button" class="btn btn-primary al" data-toggle="modal" style="display:none"
            data-target="#exampleModal">
            PBP Subacription Amount
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">PBP Subscription Amount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('makepayment') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <span for="exampleInputEmail1" style="left:0px !important">User Id </span>
                                <input type="text" class="form-control" required id="subscriberId"
                                    aria-describedby="emailHelp" name="user_id" oninput="validId(this.value)">

                            </div>
                            <div class="form-group">
                                <span for="exampleInputPassword1">Amount</span>
                                <input type="text" class="form-control" readonly value="0" read id="subamount"
                                    name="amount">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary renew-disable" disabled>Renew</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row align-items-center h-100">
            <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="post"
                action="{{ url('subscribers/loginaction') }}">
                @csrf

                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="">
                    <img src="{{ url('public/site/' . $site->main_logo) }}" height="50" alt="do N key PBP Panel">
                    {{-- <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                        <g>
                            <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                            <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                            <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                        </g>
                    </svg> --}}
                </a>
                <h1 class="h6 mb-3">Sign in</h1>
                @if (Session::has('success'))
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                            <strong> </strong> {{ Session::get('success') }} <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif
                @if (Session::has('error'))
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert"
                            x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                            <strong> </strong> {{ Session::get('error') }} <button type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>

                    @if (Session::get('error') == 'Your not activated (Your Account Expiried ).Please Contact admin!')
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                            swal({
                                    title: "Payment Due Is over",
                                    text: "{{ Session::get('error') }}",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        // window.location = "https://rzp.io/l/qrQYctwmo";
                                        $('.al').trigger("click");


                                    } else {
                                        swal("Payment Pending You Cannot Login Please Contact Admin");
                                    }
                                });
                        </script>
                    @endif
                @endif
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email') }}" placeholder="Email Address"
                        required>
                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="Password" name="password" required="">
                    @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="checkbox mb-3">
                    <label>
                        {{-- <input type="checkbox" value="remember-me"> Stay logged in </label> --}}
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Let me in</button><br><br>
                <a href="{{ route('subscriberForgotPassword') }}">Forgot Password?</a>
                <!--<p class="mt-5 mb-3 text-muted">© 2020</p>-->
                <!-- Button trigger modal -->
                <!-- Button trigger modal -->


            </form>
        </div>
    </div>
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ asset('admin/js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('admin/js/config.js') }}"></script>
    <script src="{{ asset('admin/js/apps.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');

        function validId(value) {
            $.ajax({
                url: "{{ route('validId') }}",
                type: "GET",
                data: {
                    subscriberId: value
                },
                dataType: "json",
                success: function(result) {
                    //alert(result);
                    $('#subamount').val(result);
                    if (result > 0) {
                        $('.renew-disable').prop('disabled', false);
                    } else {
                        $('.renew-disable').prop('disabled', true);
                    }
                }
            });
        }

        $(document).ready(function() {
            // Hide the loader when the page is fully loaded
            $('.loader-container').hide();
            $('.wrapper').removeClass('blur');
        });

        // Function to show the loader
        function showLoader() {
            $('.loader-container').show();
            $('.wrapper').addClass('blur');
        }

        // Function to hide the loader
        function hideLoader() {
            $('.loader-container').hide();
            $('.wrapper').removeClass('blur');
        }
    </script>
</body>

</html>
</body>

</html>
