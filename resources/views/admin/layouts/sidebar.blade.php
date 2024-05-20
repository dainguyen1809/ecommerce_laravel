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
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-home-alt"></i>
                <span class="badge badge-success float-right">4</span>
                <span> Dashboards </span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="#">Analytics</a>
                </li>
                <li>
                    <a href="#">CRM</a>
                </li>
                <li>
                    <a href="#">Ecommerce</a>
                </li>
                <li>
                    <a href="#">Projects</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-title side-nav-item">Apps</li>
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-store"></i>
                <span> Ecommerce </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="#">Products</a>
                </li>
                <li>
                    <a href="#">Products Details</a>
                </li>
                <li>
                    <a href="#">Orders</a>
                </li>
                <li>
                    <a href="#">Order Details</a>
                </li>
                <li>
                    <a href="#">Customers</a>
                </li>
                <li>
                    <a href="#">Shopping Cart</a>
                </li>
                <li>
                    <a href="#">Checkout</a>
                </li>
                <li>
                    <a href="#">Sellers</a>
                </li>
            </ul>
        </li>

    </ul>

    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->
</div>
