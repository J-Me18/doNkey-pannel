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
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="#" id="navbarDropdownNotification" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fe fe-bell fe-16"></span>
                @if(App\Models\Pricenotify::where('read', '0')->where('pricenotify.datas', 'LIKE', '%price%')->count() >
                0)
                <span class="dot dot-md bg-success"></span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownNotification">
                <a class="dropdown-item" href="{{ url('priceNotification') }}">Unread Notification -
                    {{ App\Models\Pricenotify::where('read', '0')->where('pricenotify.datas', 'LIKE', '%price%')->count(); }}</a>


            </div>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset('admin/assets/avatars/face-1.jpg')}}" alt="..."
                        class="avatar-img rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
                <!-- <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg> -->
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
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('category') }}">
                    <i class="fe fe-briefcase fe-16"></i>
                    <span class="ml-3 item-text">Category</span>
                    {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#subscriber" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-award fe-16"></i>
                    <span class="ml-3 item-text">Subscriber</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="subscriber">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ url('subscriberList') }}"><span
                                class="ml-1 item-text">List</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('createSubscriber') }}"><span
                                class="ml-1 item-text">Create New</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('expiredsubscriber') }}"><span
                                class="ml-1 item-text">Expired List</span></a>
                    </li>



                </ul>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('driver') }}">
                    <i class="fe fe-truck fe-16"></i>
                    <span class="ml-3 item-text">Driver</span>

                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('driverNotification') }}">
                    <i class="fe fe-bell fe-16"></i>
                    <span class="ml-3 item-text">Notification</span>
                    {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('enduser') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="ml-3 item-text">End User</span>
                    {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                </a>
            </li>
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
            <li class="nav-item dropdown">
                <a href="#blocklist" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-user-x fe-16"></i>
                    <span class="ml-3 item-text">Block List</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="blocklist">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ url('subscriberblockList') }}"><span
                                class="ml-1 item-text">Subscriber Block List</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('driverblockList') }}"><span class="ml-1 item-text">Driver
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('adminBlocked') }}"><span class="ml-1 item-text">Driver
                                (Admin)</span></a>
                    </li>



                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#unblocklist" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-user-check fe-16"></i>
                    <span class="ml-3 item-text">Unblock List</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="unblocklist">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ url('subscriberunblockList') }}"><span
                                class="ml-1 item-text">Subscriber Unblock List</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('driverunblockList') }}"><span
                                class="ml-1 item-text">Driver </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('adminUnblocked') }}"><span class="ml-1 item-text">Driver
                                (Admin)</span></a>
                    </li>



                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#site" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-briefcase fe-16"></i>
                    <span class="ml-3 item-text">Site Manage</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="site">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ url('admin/details') }}"><span class="ml-1 item-text">Details
                                Manage</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('admin/slider') }}"><span class="ml-1 item-text">Slider
                                Manage </span></a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link pl-3" href="{{ url('admin/about') }}"><span class="ml-1 item-text">About
                                Manage </span></a> -->
                    </li>




                </ul>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('users') }}">
                    <i class="fa fa-user fe-16"></i>
                    <span class="ml-3 item-text">Users</span>

                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('roles') }}">
                    <i class="fa fa-user fe-16"></i>
                    <span class="ml-3 item-text">Roles</span>

                </a>
            </li>

        </ul>


    </nav>
</aside>