<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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
@php
    $site = App\Models\site::where('id', 1)->first();
@endphp
<link rel="icon" href="{{ url('public/site/' . $site->main_logo) }}" type="image/x-icon">

<nav class="topnav navbar navbar-light">

    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    {{-- <form class="form-inline mr-auto searchform text-muted">
          <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
        </form> --}}
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        @php
            $user = Session::get('subscribers');
            // dd($user);
        @endphp

        @if (isset($user->subscriberId))
            @if ($user->platform_fee != 0 && $user->need_to_pay == 1)
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
                </script>
                <script>
                    $(function() {
                        //$('.error-msg').text("{{ session('error') }}");
                        $('#platformfeemodal').modal('show');
                        $('#payCloseButton').click(function() {
                            $('#platformfeemodal').modal('hide'); // Manually close the modal
                        });
                    });
                </script>
            @endif
        @endif

        @if (isset($user?->subscriber_id))
            @php
                $subscriber = Subscriber::where('id', $user?->subscriber_id)?->first();
            @endphp
            @if ($subscriber->platform_fee != 0 && $subscriber->need_to_pay == 1)
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
                </script>
                <script>
                    $(function() {
                        //$('.error-msg').text("{{ session('error') }}");
                        $('#platformfeemodal').modal('show');
                        $('#payCloseButton').click(function() {
                            $('#platformfeemodal').modal('hide'); // Manually close the modal
                        });
                    });
                </script>
            @endif
        @endif

        @if (isset($user->subscriberId))
            @if ($user->activestatus == 0)
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
                </script>
                <script>
                    $(function() {
                        //$('.error-msg').text("{{ session('error') }}");
                        $('#inactivemodal').modal('show');
                        $('#closeButton').click(function() {
                            $('#inactivemodal').modal('hide'); // Manually close the modal
                        });
                    });
                </script>
            @endif
        @endif

        <div class="modal fade" id="inactivemodal" tabindex="-1" aria-labelledby="epinmodalLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content alert alert-danger" style="border-color: red;">
                    <div class="modal-body">
                        <div class="" role="alert">
                            Your account is not activated. Please contact admin to continue your business.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeButton" class="btn btn-danger"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="platformfeemodal" tabindex="-1" aria-labelledby="paymentModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Payment Required</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div role="alert">
                            <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.5em;"></i>
                            <strong>Important:</strong> Please complete your last subscription platform fee to access
                            your business.
                        </div>
                    </div>
                    @if (isset($user->subscriberId))
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" id="payCloseButton" data-bs-dismiss="modal">Close</button> --}}
                            <a type="button" href="{{ route('makePlatFormFee', ['Id' => $user->id]) }}"
                                class="btn btn-primary">Proceed to Payment</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    @if (isset($user->subscriberId))
                        @php
                            $employee = App\Models\Employee::where('email', $user->email)->first();
                        @endphp
                        <img src="{{ asset('admin/employee/profile/' . $employee?->profile) }}" alt="..."
                            class="avatar-img rounded-circle">
                    @else
                        @php
                            $employee = $user;
                        @endphp
                        <img src="{{ asset('admin/employee/profile/' . $employee?->profile) }}" alt="..."
                            class="avatar-img rounded-circle">
                    @endif

                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ url('subscribers/profile') }}">Profile</a>
                <a class="dropdown-item" href="{{ url('subscribers/logout') }}">
                    {{ __('Logout') }}
                </a>


            </div>
        </li>
    </ul>
</nav>
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 d-flex">
            <a class="navbar-brand mx-auto flex-fill text-center" href="#">
                <div class="w-100 d-flex flex-column align-items-center">
                    <a class="navbar-brand mx-auto flex-fill text-center" href="https://www.donkeydeliveries.com/">
                        <img src="{{ url('public/site/' . $site->main_logo) }}" height="40" alt="do Nk ey PBP Panel">
                        <h3><span class="mt-2 font-weight-bold">PBP Control Center</span></h3>
                    </a>
                </div>
            </a>
        </div>
        @php
            $auth = Auth::guard('subscriber')->user();
        @endphp
        @if (isset($auth))
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ url('subscribers/dashboard') }}">
                        <i class="fe fe-home fe-16"></i>
                        <span class="ml-3 item-text">Dashboard</span>
                        {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                    </a>
                </li>

                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ url('subscribers/price') }}">
                        <i class="fe fe-crosshair fe-16"></i>
                        <span class="ml-3 item-text">Category Price</span>
                        {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#driver" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-award fe-16"></i>
                        <span class="ml-3 item-text">Riders</span><span class="sr-only">(current)</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="driver">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="{{ url('subscribers/driver') }}"><span
                                    class="ml-1 item-text">List</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ url('subscribers/createDriver') }}"><span
                                    class="ml-1 item-text">Create New</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ url('subscribers/blockedDriver') }}"><span
                                    class="ml-1 item-text">Blocked </span></a>
                        </li>
                    </ul>
                </li>
                @php
                    $user = Session::get('subscribers');
                @endphp
                @if (isset($user->subscriberId))
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ url('subscriberchatwithadmin') }}">
                            <i class="fe fe-message-circle fe-16"></i>
                            <span class="ml-3 item-text">Chat Support <span
                                    class="dot{{ session('subscribers')['subscriberId'] }}" hidden><span
                                        style="font-size:20px;padding-left: 20px;">&#x2022<span></span></span>
                                    {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                        </a>
                    </li>
                @endif

                @php
                    $user = session()->get('subscribers');
                    // dd($user->subscriberId);
                @endphp

                <li class="nav-item dropdown">
                    <a href="#Report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-clipboard fe-16"></i>
                        <span class="ml-3 item-text">Report</span><span class="sr-only">(current)</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Report">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="{{ route('bookingReport.index') }}"><span
                                    class="ml-1 item-text">Booking Report</span></a>
                        </li>
                        {{-- {{ $driverReport }} --}}
                        {{-- today --}}
                        @if (isset($user->subscriberId))
                            <li class="nav-item">
                                <a class="nav-link pl-3"
                                    href="{{ route('driverReport.show', ['subscriber' => $user->id]) }}"><span
                                        class="ml-1 item-text">Active Drivers Report</span></a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link pl-3"
                                    href="{{ route('driverReport.show', ['subscriber' => $user->subscriber_id]) }}"><span
                                        class="ml-1 item-text">Active Drivers Report</span></a>
                            </li>
                        @endif

                        {{-- <li class="nav-item">
    <a class="nav-link pl-3" href="{{ url('subscribers/blockedDriver') }}"><span class="ml-1 item-text">Blocked </span></a>
    </li> --}}
                    </ul>
                </li>
                @if (isset($user->subscriberId))
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ url('subscribers/enquiry') }}">
                            <i class="fa fa-question-circle fe-16"></i>
                            <span class="ml-3 item-text">Enquiries</span>

                        </a>
                    </li>
                @else
                    {{-- @if ($user->hasPermissionTo('Enquiry and Complaints')) --}}
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ url('subscribers/enquiry') }}">
                            <i class="fa fa-question-circle fe-16"></i>
                            <span class="ml-3 item-text">Enquiries</span>

                        </a>
                    </li>
                    {{-- @endif --}}
                @endif
                {{-- @php

    @endphp --}}
                @if (isset($user->subscriberId))
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ route('subscribers.complaints') }}">
                            <i class="fe fe-thumbs-up fe-16"></i>
                            <span class="ml-3 item-text">Complaints</span>
                            {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                        </a>
                    </li>
                @else
                    {{-- @if ($user->hasPermissionTo('Enquiry and Complaints')) --}}
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ route('subscribers.complaints') }}">
                            <i class="fe fe-thumbs-up fe-16"></i>
                            <span class="ml-3 item-text">Complaints</span>
                            {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                        </a>
                    </li>
                    {{-- @endif --}}
                @endif

                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ url('subscribers/coupon') }}">
                        <i class="fe fe-gift fe-16"></i>
                        <span class="ml-3 item-text">Coupons</span>
                        {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                    </a>
                </li>

                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <i class="fa fa-user fe-16"></i>
                        <span class="ml-3 item-text">Roles</span>

                    </a>
                </li>

                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('subEmployee.index') }}">
                        <i class="fa fa-user fe-16"></i>
                        <span class="ml-3 item-text">Employees</span>

                    </a>
                </li>

            </ul>
        @else
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ url('subscribers/dashboard') }}">
                        <i class="fe fe-home fe-16"></i>
                        <span class="ml-3 item-text">Dashboard</span>
                        {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                    </a>
                </li>
                @if ($user->hasPermissionTo('category-price'))
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ url('subscribers/price') }}">
                            <i class="fe fe-crosshair fe-16"></i>
                            <span class="ml-3 item-text">Category Price</span>
                            {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                        </a>
                    </li>
                @endif



                @if (
                    $user->hasPermissionTo('rider-list') ||
                        $user->hasPermissionTo('rider-create') ||
                        $user->hasPermissionTo('rider-blocked'))
                    <li class="nav-item dropdown">
                        <a href="#driver" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-award fe-16"></i>
                            <span class="ml-3 item-text">Riders</span><span class="sr-only">(current)</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="driver">
                            @if ($user->hasPermissionTo('rider-list'))
                                <li class="nav-item active">
                                    <a class="nav-link pl-3" href="{{ url('subscribers/driver') }}"><span
                                            class="ml-1 item-text">List</span></a>
                                </li>
                            @endif

                            @if ($user->hasPermissionTo('rider-create'))
                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="{{ url('subscribers/createDriver') }}"><span
                                            class="ml-1 item-text">Create New</span></a>
                                </li>
                            @endif

                            @if ($user->hasPermissionTo('rider-blocked'))
                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="{{ url('subscribers/blockedDriver') }}"><span
                                            class="ml-1 item-text">Blocked </span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @php
                    $user = Session::get('subscribers');
                @endphp
                @if (isset($user->subscriberId))
                    @if ($user->hasPermissionTo('chat-support'))
                        <li class="nav-item w-100">
                            <a class="nav-link" href="{{ url('subscriberchatwithadmin') }}">
                                <i class="fe fe-message-circle fe-16"></i>
                                <span class="ml-3 item-text">Chat Support <span
                                        class="dot{{ session('subscribers')['subscriberId'] }}" hidden><span
                                            style="font-size:20px;padding-left: 20px;">&#x2022<span></span></span>
                                        {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                            </a>
                        </li>
                    @endif
                @endif

                @php
                    $user = session()->get('subscribers');
                    // dd($user->subscriberId);
                @endphp

                <li class="nav-item dropdown">
                    <a href="#Report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-clipboard fe-16"></i>
                        <span class="ml-3 item-text">Report</span><span class="sr-only">(current)</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Report">
                        @if ($user->hasPermissionTo('booking-report'))
                            <li class="nav-item active">
                                <a class="nav-link pl-3" href="{{ route('bookingReport.index') }}"><span
                                        class="ml-1 item-text">Booking Report</span></a>
                            </li>
                        @endif
                        {{-- {{ $driverReport }} --}}
                        {{-- today --}}
                        @if (isset($user->subscriberId))
                            @if ($user->hasPermissionTo('active-drivers'))
                                <li class="nav-item">
                                    <a class="nav-link pl-3"
                                        href="{{ route('driverReport.show', ['subscriber' => $user->id]) }}"><span
                                            class="ml-1 item-text">Active Drivers Report</span></a>
                                </li>
                            @endif
                        @else
                            @if ($user->hasPermissionTo('active-drivers'))
                                <li class="nav-item">
                                    <a class="nav-link pl-3"
                                        href="{{ route('driverReport.show', ['subscriber' => $user->subscriber_id]) }}"><span
                                            class="ml-1 item-text">Active Drivers Report</span></a>
                                </li>
                            @endif
                        @endif

                        {{-- <li class="nav-item">
<a class="nav-link pl-3" href="{{ url('subscribers/blockedDriver') }}"><span class="ml-1 item-text">Blocked </span></a>
</li> --}}
                    </ul>
                </li>
                @if (isset($user->subscriberId))
                    @if ($user->hasPermissionTo('enquiry-list'))
                        <li class="nav-item w-100">
                            <a class="nav-link" href="{{ url('subscribers/enquiry') }}">
                                <i class="fa fa-question-circle fe-16"></i>
                                <span class="ml-3 item-text">Enquiries</span>

                            </a>
                        </li>
                    @endif
                @else
                    {{-- @if ($user->hasPermissionTo('Enquiry and Complaints')) --}}
                    @if ($user->hasPermissionTo('enquiry-list'))
                        <li class="nav-item w-100">
                            <a class="nav-link" href="{{ url('subscribers/enquiry') }}">
                                <i class="fa fa-question-circle fe-16"></i>
                                <span class="ml-3 item-text">Enquiries</span>

                            </a>
                        </li>
                    @endif
                    {{-- @endif --}}
                @endif
                {{-- @php

@endphp --}}
                @if (isset($user->subscriberId))
                    @if ($user->hasPermissionTo('complaint-list'))
                        <li class="nav-item w-100">
                            <a class="nav-link" href="{{ route('subscribers.complaints') }}">
                                <i class="fe fe-thumbs-up fe-16"></i>
                                <span class="ml-3 item-text">Complaints</span>
                                {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                            </a>
                        </li>
                    @endif
                @else
                    @if ($user->hasPermissionTo('complaint-list'))
                        {{-- @if ($user->hasPermissionTo('Enquiry and Complaints')) --}}
                        <li class="nav-item w-100">
                            <a class="nav-link" href="{{ route('subscribers.complaints') }}">
                                <i class="fe fe-thumbs-up fe-16"></i>
                                <span class="ml-3 item-text">Complaints</span>
                                {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                            </a>
                        </li>
                    @endif
                @endif
                {{-- @endif --}}
                @if ($user->hasPermissionTo('coupon-list'))
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ url('subscribers/coupon') }}">
                            <i class="fe fe-gift fe-16"></i>
                            <span class="ml-3 item-text">Coupons</span>
                            {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                        </a>
                    </li>
                @endif
                @if ($user->hasPermissionTo('role-list'))
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ route('roles.index') }}">
                            <i class="fa fa-user fe-16"></i>
                            <span class="ml-3 item-text">Roles</span>

                        </a>
                    </li>
                @endif
                @if ($user->hasPermissionTo('employee-list'))
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ route('subEmployee.index') }}">
                            <i class="fa fa-user fe-16"></i>
                            <span class="ml-3 item-text">Employees</span>

                        </a>
                    </li>
                @endif

            </ul>

        @endif

    </nav>
</aside>
<div class="loader-container">
    <div class="loader"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        setInterval(() => {
            bookingComplete();
            subscriberWhatsappNotify();
        }, 360000);
        // setInterval(() => {
        //     getAccessTokenDriver();
        //     getAccessTokenUser();
        // }, 10000);
    });

    function bookingComplete() {
        $.ajax({
            url: "{{ route('automaticBookingComplete') }}",
            type: "get",
            //   data: {id : menuId},
            dataType: "json",
            success: function(result) {
                console.log(result);
            },
        });
    }

    function subscriberWhatsappNotify() {
        $.ajax({
            url: "{{ route('subscriberWhatsappNotify') }}",
            type: "get",
            //   data: {id : menuId},
            dataType: "json",
            success: function(result) {
                console.log(result);
            },
        });
    }

    function getAccessTokenUser() {
        $.ajax({
            url: "{{ route('getAccessTokenUser') }}",
            type: "get",
            dataType: "json",
            success: function(result) {
                console.log(result);
            },

        });
    }

    function getAccessTokenDriver() {
        $.ajax({
            url: "{{ route('getAccessTokenDriver') }}",
            type: "get",
            dataType: "json",
            success: function(result) {
                console.log(result);
            },

        });
    }
</script>

<script>
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
