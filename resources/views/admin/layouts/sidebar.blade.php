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
        </li>

        <li class="side-nav-title side-nav-item">Managements</li>
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-store"></i>
                <span> Ecommerce </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
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
                <li>
                    <a href="{{ route('admin.payment-settings.index') }}"> Payments </a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-web-section"></i>
                <span> Website </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.slider.index') }}">Sliders</a>
                </li>
                <li>
                    <a href="{{ route('admin.home-page-setting') }}">Home Page Setting</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-web-section"></i>
                <span> Footer </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.footer-info.index') }}">Footer Info</a>
                </li>
                <li>
                    <a href="{{ route('admin.footer-socials.index') }}">Footer Socials</a>
                </li>
                <li>
                    <a href="{{ route('admin.footer-grid-two.index') }}">Footer Grid Two</a>
                </li>
                <li>
                    <a href="{{ route('admin.footer-grid-three.index') }}">Footer Grid Three</a>
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
                <li>
                    <a href="{{ route('admin.review.index') }}"> Product Reviews </a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-user-check"></i>
                <span> Users </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.customer.index') }}">Customers</a>
                </li>
                <li>
                    <a href="{{ route('admin.vendor.index') }}">Vendors</a>
                </li>
                <li>
                    <a href="{{ route('admin.vendor-register.index') }}">Pending Vendors</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-bill"></i>
                <span> Orders </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.orders.index') }}">All Orders</a>
                </li>
                <li>
                    <a href="{{ route('admin.order.pending') }}">Pending Orders</a>
                </li>
                <li>
                    <a href="{{ route('admin.order.dropped-off') }}">Dropped Off Orders</a>
                </li>
                <li>
                    <a href="{{ route('admin.order.shipped') }}">Shipped Orders</a>
                </li>
                <li>
                    <a href="{{ route('admin.order.processed') }}">Processed Orders</a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('admin.transaction.index') }}" class="side-nav-link">
                <i class="uil-money-bill"></i>
                <span> Transaction </span>
            </a>
        </li>


        <li class="side-nav-item">
            <a href="{{ route('admin.subscriber.index') }}" class="side-nav-link">
                <i class="mdi mdi-bell-outline"></i>
                <span> Subscribers </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('admin.advertisement.index') }}" class="side-nav-link">
                <i class="mdi mdi-bell-alert"></i>
                <span> Advertisement </span>
            </a>
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
