<div class="left-side-menu left-side-menu-detached">
    <div class="leftbar-user">
        <a href="{{ route('admin.profile') }}">
            <img src="{{ asset(Auth::user()->avatar) }}" alt="user-image" height="42" class="rounded-circle shadow-sm" />
            <span class="leftbar-user-name">{{ Auth::user()->name }}</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="metismenu side-nav">
        <li class="side-nav-title side-nav-item">Navigation</li>

        <li class="side-nav-item">
            <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                <i class="uil-home-alt"></i>
                <span> Dashboards </span>
            </a>
        <li class="side-nav-title side-nav-item">Apps</li>
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-web-section"></i>
                <span> Layout </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.slider.index') }}">Slider</a>
                </li>
            </ul>
        </li>

    </ul>

    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->
</div>
