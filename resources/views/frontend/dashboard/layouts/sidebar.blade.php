<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ url('/') }}" class="dash_logo"><img src="{{ asset($logoSetting->logo) }}" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
        @if (auth()->user()->role === 'vendor')
            <li><a href="{{ route('vendor.dashboard') }}"><i class="fas fa-store"></i>Go to Store Dashboard</a></li>
        @endif
        <li><a href="{{ route('user.order.index') }}"><i class="fas fa-list-ul"></i> Orders</a></li>
        <li><a href="{{ route('user.review.index') }}"><i class="far fa-star"></i> Reviews</a></li>
        <li><a href="{{ route('user.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
        <li><a href="{{ route('user.address.index') }}"><i class="fal fa-gift-card"></i> Addresses</a></li>
        @if (auth()->user()->role !== 'vendor')
            <li>
                <a href="{{ route('user.vendor-register.index') }}">
                    <i class="fas fa-store"></i>
                    Vendor Registration
                </a>
            </li>
        @endif
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i> {{ __('Log Out') }} </a>
            </form>
        </li>
    </ul>
</div>
