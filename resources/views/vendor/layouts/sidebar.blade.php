<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="#" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li>
            <a href="{{ route('vendor.vendor-profile.index') }}">
                <i class="fas fa-store"></i>
                {{ __('Shop Profile') }}
            </a>
        </li>
        <li>
            <a href="{{ route('vendor.products.index') }}">
                <i class="fas fa-cube"></i>
                {{ __('Products') }}
            </a>
        </li>
        <li>
            <a href="{{ route('vendor.review.index') }}">
                <i class="fas fa-star"></i>
                {{ __('Reivews') }}
            </a>
        </li>
        <li>
            <a href="{{ route('vendor.order.index') }}">
                <i class="fas fa-file-invoice-dollar"></i> {{ __('Orders') }}
            </a>
        </li>
        <li>
            <a href="{{ route('vendor.profile') }}">
                <i class="far fa-user"></i>
                {{ __('My Profile') }}
            </a>
        </li>
        <li><a href="#"><i class="fal fa-gift-card"></i> {{ __('Addresses') }}</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                this.closest('form').submit();">
                    <i class="far fa-sign-out-alt"></i> {{ __('Log Out') }} </a>
            </form>
        </li>
    </ul>
</div>
