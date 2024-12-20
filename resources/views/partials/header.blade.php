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
    $admin = Auth::user();
    $site = App\Models\site::where('id', 1)->first();
@endphp
<link rel="icon" href="{{ url('public/site/' . $site->favicon) }}" type="image/x-icon">

<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="#" id="navbarDropdownNotification" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fe fe-bell fe-16"></span>
                @if (App\Models\Pricenotify::where('read', '0')->where(function ($q) {
                            $q->where('pricenotify.datas', 'LIKE', '%price%')->orWhere('pricenotify.datas', 'LIKE', '%bankacno%')->orWhere('pricenotify.datas', 'LIKE', '%ifsccode%');
                        })->count() > 0)
                    <span class="dot dot-md bg-success"></span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownNotification">
                <a class="dropdown-item" href="{{ url('priceNotification') }}">Unread Notification -
                    {{ App\Models\Pricenotify::where('read', '0')->where(function ($q) {
                            $q->where('pricenotify.datas', 'LIKE', '%price%')->orWhere('pricenotify.datas', 'LIKE', '%bankacno%')->orWhere('pricenotify.datas', 'LIKE', '%ifsccode%');
                        })->count() }}</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <div style="width: 30px; height: 30px; overflow: hidden; border-radius: 50%;">
                        <img src="{{ asset('admin/admin/profile/' . $admin->profile) }}" alt="..."
                            class="avatar-img rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('profile.edit', $admin->id) }}">Profile</a>
                @if ($admin->roles[0]->name == 'Admin')
                    <a class="dropdown-item" href="{{ route('getAppVerision', ['site' => 1]) }}">General Settings</a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">

        <div class="w-100 d-flex flex-column align-items-center">
            <a class="navbar-brand mx-auto flex-fill text-center" href="https://www.donkeydeliveries.com/">
                <img src="{{ url('public/site/' . $site->main_logo) }}" style="height: 60px;width:60px;"
                    alt="do N key Admin Panel">
                <h3><span class="mt-2 font-weight-bold">Control Center</span></h3>
            </a>
        </div>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                    {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#pincode" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Pincode</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="pincode">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ url('pincode') }}"><span
                                class="ml-1 item-text">List</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('createpincode') }}"><span class="ml-1 item-text">Create
                                New</span></a>
                    </li>



                </ul>
            </li>
            @can('category-list')
                <li class="nav-item dropdown">
                    <a href="#category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-briefcase fe-16"></i>
                        <span class="ml-3 item-text">Categories</span><span class="sr-only">(Pincode)</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="category">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="{{ url('category') }}"><span style="margin-left: 40px;"
                                    class="ml-1 item-text">Category List</span></a>
                        </li>
                        <!-- <li class="nav-item active">
                                                                <a class="nav-link pl-3" href="{{ route('usedPincodes') }}"><span style="margin-left: 40px;"
                                                                        class="ml-1 item-text">Category Settings</span><span style="font-size: 8px;">(Pincode
                                                                        Wise)</span></a>
                                                            </li> -->
                    </ul>
                </li>
            @endcan

            <li class="nav-item dropdown">
                <a href="#subscriber" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-award fe-16"></i>
                    <span class="ml-3 item-text">Subscriber</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="subscriber">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ url('subscriberList') }}"><span style="margin-left: 40px;"
                                class="ml-1 item-text">Subscribers List</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('createSubscriber') }}"><span
                                style="margin-left: 40px;" class="ml-1 item-text">Create New</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('expiredsubscriber') }}"><span
                                style="margin-left: 40px;" class="ml-1 item-text">Subscription Queue</span></a>
                    </li>



                </ul>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('driver') }}">
                    <i class="fe fe-truck fe-16"></i>
                    <span class="ml-3 item-text">Riders</span>

                </a>
            </li>
            @can('Chat')
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('chatwithadmin') }}">

                        <i class="fe fe-message-circle fe-16"></i>
                        <span class="ml-3 item-text">Team Chat</span>
                        <span class="dotadmin" hidden><span
                                style="font-size:20px;padding-left: 20px;">&#x2022<span></span>
                    </a>
                </li>
            @endcan


            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('chatsupport') }}">

                    <i class="fe fe-message-circle fe-16"></i>
                    <span class="ml-3 item-text">Customer Support </span>
                    <span class="dotadminsupport" hidden><span
                            style="font-size:20px;padding-left: 20px;">&#x2022<span></span>

                </a>
            </li>
            @can('push-notification')
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('pushnotification.index') }}">
                        <i class="fe fe-bell fe-16"></i>
                        <span class="ml-3 item-text ">Push Notification</span>
                    </a>
                </li>
            @endcan
            @can('notification-list')
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ url('driverNotification') }}">
                        <i class="fe fe-bell fe-16 new-notification-dot"></i>
                        <span class="ml-3 item-text dot">Driver Notification</span>
                        <!-- <div class="new-notification-dot"></div> -->
                        {{-- <span class="badge badge-pill badge-primary"></span> --}}
                    </a>
                </li>
            @endcan
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('subscriberNotification') }}">
                    <i class="fe fe-bell fe-16 new-sub-dot"></i>
                    <span class="ml-3 item-text ">Subscriber Notification</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('report.index') }}">
                    <i class="fe fe-alert-circle fe-16"></i>
                    <span class="ml-3 item-text ">Booking Issue</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-clipboard fe-16"></i>
                    <span class="ml-3 item-text">Reports</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="report">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ route('bookingReport') }}"><span
                                class="ml-1 item-text">Booking Report</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('subscriberReport.index') }}"><span
                                class="ml-1 item-text">Subscriber Work Report</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('subscriberExpiry') }}"><span
                                class="ml-1 item-text">Expired Subscriptions</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('employeePerformance.index') }}"><span
                                class="ml-1 item-text">Employee Report</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('paymenthistory.index') }}"><span
                                class="ml-1 item-text">Payment History</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('employeeReport.index') }}"><span class="ml-1 item-text">Employee Attendance Report</span></a>
            </li> --}}
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#blocklist" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-user-x fe-16"></i>
                    <span class="ml-3 item-text">Block List</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="blocklist">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ url('subscriberblockList') }}"><span
                                class="ml-1 item-text">Subscribers</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('driverblockList') }}"><span
                                class="ml-1 item-text">Riders
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('adminBlocked') }}"><span
                                class="ml-1 item-text">Riders
                                (Admin)</span></a>
                    </li>



                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#unblocklist" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle nav-link">
                    <i class="fe fe-user-check fe-16"></i>
                    <span class="ml-3 item-text">Unblock List</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="unblocklist">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ url('subscriberunblockList') }}"><span
                                class="ml-1 item-text">Subscribers</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('driverunblockList') }}"><span
                                class="ml-1 item-text">Riders</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('adminUnblocked') }}"><span
                                class="ml-1 item-text">Riders
                                (Admin)</span></a>
                    </li>



                </ul>
            </li>
            @can('Enquiry and Complaints')
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('enquiry.index') }}">
                        <i class="fa fa-question-circle fe-16"></i>
                        <span class="ml-3 item-text">Enquiries</span>

                    </a>
                </li>
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('complaints.index') }}">
                        <i class="fe fe-thumbs-up fe-16"></i>
                        <span class="ml-3 item-text">Complaints</span>

                    </a>
                </li>
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('feed.index') }}">
                        <i class="fe fe-message-circle fe-16"></i>

                        <span class="ml-3 item-text">Feedback</span>

                    </a>
                </li>
                @can('pricing-list')
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ route('excelpincode.index') }}">
                            <i class="fe fe-grid fe-16"></i>

                            <span class="ml-3 item-text">Pricing</span>

                        </a>
                    </li>
                @endcan

                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('newsletter') }}">
                        <i class="fe fe-message-circle fe-16"></i>

                        <span class="ml-3 item-text">News Letters</span>

                    </a>
                </li>
            @endcan
            @can('site-manage')
                <li class="nav-item dropdown">
                    <a href="#site" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-briefcase fe-16"></i>
                        <span class="ml-3 item-text">Site Manage</span><span class="sr-only">(current)</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="site">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="{{ url('admin/details') }}"><span
                                    class="ml-1 item-text">Details
                                    Manage</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ url('admin/slider') }}"><span
                                    class="ml-1 item-text">Slider
                                    Manage </span></a>
                        </li>
                        <li class="nav-item">
                            <!-- <a class="nav-link pl-3" href="{{ url('admin/about') }}"><span class="ml-1 item-text">About
                                                                    Manage </span></a> -->
                        </li>




                    </ul>
                </li>
            @endcan
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('users') }}">
                    <i class="fa fa-user fe-16"></i>
                    <span class="ml-3 item-text">Employees</span>

                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('role.index') }}">
                    <i class="fa fa-user fe-16"></i>
                    <span class="ml-3 item-text">Roles</span>

                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('enduser') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">End User</span>
                    {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                </a>
            </li>
            @can('Banner and voucher')
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ url('admin/banner') }}">
                        <i class="fa fa-user fe-16"></i>
                        <span class="ml-3 item-text">Banner</span>

                    </a>
                </li>

                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ url('Voucher') }}">
                        <i class="fa fa-user fe-16"></i>
                        <span class="ml-3 item-text">Voucher</span>

                    </a>
                </li>
            @endcan
            @can('coupon-index')
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('coupon.index') }}">
                        <i class="fa fa-ticket fe-16"></i>
                        <span class="ml-3 item-text">coupon</span>
                    </a>
                </li>
            @endcan

            {{-- @can('coupon-index') --}}
            <li class="nav-item dropdown">
                <a href="#site" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-briefcase fe-16"></i>
                    <span class="ml-3 item-text">App</span><span class="sr-only">(settings)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="site">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ route('admin.info.index') }}"><span
                                class="ml-1 item-text">Info</span></a>
                    </li>                                       
                </ul>
            </li>
            {{-- @endcan --}}
        </ul>


    </nav>
</aside>
<div class="loader-container">
    <div class="loader"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        function load() {
            setTimeout(function() {
                $.ajax({
                    url: "{{ route('dot-notify') }}",
                    type: "get",
                    //   data: {id : menuId},
                    dataType: "json",
                    success: function(result) {
                        console.log(result);
                        if (result.noti == true || result.noti == 'true') {
                            $('.new-notification-dot').html(
                                '<span class="dot dot-md bg-success"></span>');
                        }
                        if (result.sub == true || result.sub == 'true') {
                            $('.new-sub-dot').html(
                                '<span class="dot dot-md bg-success"></span>');
                        }

                    },
                    complete: load
                });
            }, 1000);
        }
        load();
    });
    $(document).ready(function() {
        setInterval(() => {
            bookingComplete();
        }, 3600000);
        // setInterval(() => {
        //     getAccessTokenUser();
        //     getAccessTokenDriver();
        // }, 900000); //900000
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
