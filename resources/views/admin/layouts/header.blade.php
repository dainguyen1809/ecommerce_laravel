<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="">
            <span class="topnav-logo-lg">
                <img src="{{ asset($logoSetting->logo) }}" alt="logo"
                    style="position: relative; left: 150px; width: 135px">
            </span>
        </a>
        <ul class="list-unstyled topbar-right-menu float-right mb-0">

            <li class="dropdown notification-list topbar-dropdown d-none d-lg-block">
                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" id="topbar-languagedrop"
                    href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('images/flags/vn.svg') }}" alt="user-image" class="mr-1" height="12" />
                    <span class="align-middle">Vietnamese</span>
                    <i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu"
                    aria-labelledby="topbar-languagedrop">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ asset('images/flags/us.svg') }}" alt="user-image" class="mr-1" height="12" />
                        <span class="align-middle">English</span>
                    </a>
                </div>
            </li>
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop"
                    href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="{{ asset(Auth::user()->avatar) }}" alt="user-image" class="rounded-circle" />
                    </span>
                    <span>
                        <span class="account-user-name">{{ Auth::user()->name }}</span>
                        <span class="account-position">{{ Auth::user()->role }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                    aria-labelledby="topbar-userdrop">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('admin.profile') }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-circle mr-1"></i>
                        <span>Profile</span>
                    </a>

                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); 
                            this.closest('form').submit();"
                            class="dropdown-item notify-item">
                            <i class="mdi mdi-logout mr-1"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </div>
            </li>
        </ul>
        <a class="button-menu-mobile disable-btn">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
    </div>
</div>
