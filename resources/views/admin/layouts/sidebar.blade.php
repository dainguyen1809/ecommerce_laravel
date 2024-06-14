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
        <li class="side-nav-title side-nav-item">Managements</li>
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-web-section"></i>
                <span> Ecommerce </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.slider.index') }}">Sliders</a>
                </li>
                <li>
                    <a href="{{ route('admin.vendor-profile.index') }}"> Vendors Profile </a>
                </li>
                <li>
                    <a href="{{ route('admin.flash-sale.index') }}"> Flash Sales </a>
                </li>
                <li>
                    <a href="{{ route('admin.coupons.index') }}"> Coupons </a>
                </li>
                <li>
                    <a href="{{ route('admin.shipping-rule.index') }}"> Shipping Rule </a>
                </li>
            </ul>
        </li>
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-label"></i>
                <span> Categories </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.category.index') }}">Main Categories</a>
                </li>
                <li>
                    <a href="{{ route('admin.sub-category.index') }}">Sub Categories</a>
                </li>
                <li>
                    <a href="{{ route('admin.child-category.index') }}">Child Categories</a>
                </li>
            </ul>
        </li>
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil uil-pricetag-alt"></i>
                <span> Products </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.brand.index') }}"> Brands </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}"> Products </a>
                </li>
                <li>
                    <a href="{{ route('admin.seller-products.index') }}"> Seller Products </a>
                </li>
                <li>
                    <a href="{{ route('admin.seller-pending-products.index') }}"> Seller Pending Products </a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('admin.settings.index') }}" class="side-nav-link">
                <i class="mdi mdi-settings-outline"></i>
                <span> Settings </span>
            </a>
        </li>

    </ul>

    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->
</div>
