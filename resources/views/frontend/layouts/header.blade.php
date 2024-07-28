<header>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1 d-lg-none">
                <div class="ts__mobile_menu_area">
                    <span class="ts__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                <div class="wsus_logo_area">
                    <a class="ts__header_logo" href="{{ url('/') }}">
                        <img src="{{ asset($logoSetting->logo) }}" alt="logo" class="img-fluid w-100"
                            style="position: relative; bottom: 20px">
                    </a>
                </div>
            </div>
            <div class="col-xl-7 col-md-6 col-lg-4 d-none d-lg-block">
                <div class="ts__search">
                    <form action="{{ route('product.index') }}" method="get">
                        <input type="text" name="search" placeholder="Search...">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-xl-3 col-3 col-md-3 col-lg-6">
                <div class="ts__call_icon_area">
                    <ul class="ts__icon_area">
                        <li>
                            <a href="{{ route('user.wishlist') }}"><i class="fal fa-heart"></i>
                                @if (isset(auth()->user()->id))
                                    <span id="wishlist-qty">
                                        {{ \App\Models\Wishlist::where('user_id', auth()->user()->id)->count() }}
                                    </span>
                                @else
                                    <span id="wishlist-qty">
                                        0
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li><a class="ts__cart_icon" href="#"><i class="fal fa-shopping-bag"></i><span
                                    id="cart-count">{{ Cart::content()->count() }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="ts__mini_cart">
        <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
        <ul class="mini-cart-warpper">
            @foreach (Cart::content() as $item)
                <li id="mini-cart-{{ $item->rowId }}" class="d-flex align-items-center">
                    <div class="ts__cart_img mb-3">
                        <a href="{{ route('product-details', $item->options->slug) }}">
                            <img src="{{ asset($item->options->image) }}" alt="product" class="img-fluid w-100">
                        </a>
                        <a class="wsis__del_icon sidebar-remove-item" data-rowId="{{ $item->rowId }}" href="#">
                            <i class="fas fa-minus-circle"></i>
                        </a>
                    </div>
                    <div class="ts__cart_text">
                        <a class="ts__cart_title"
                            href="{{ route('product-details', $item->options->slug) }}">{{ $item->name }}</a>
                        <p>
                            {{ $settings->currency_icon }}
                            {{ $item->price }}
                        </p>
                        <small>
                            <strong>Varian Total:</strong>
                            {{ $settings->currency_icon }}
                            {{ $item->options->variants_total }}
                        </small>
                        <br>
                        <small>
                            <strong>Qty:</strong>
                            {{ $item->qty }}
                        </small>
                    </div>
                </li>
            @endforeach
            @if (Cart::content()->count() === 0)
                <li class="text-center">Cart is empty!</li>
            @endif
        </ul>
        <div class="row mini-cart-action {{ Cart::content()->count() === 0 ? 'd-none' : '' }}">
            <h5>sub total
                <span id="mini-cart-subtotal">
                    {{ $settings->currency_icon }}
                    {{ getCartTotalAmount() }}
                </span>
            </h5>
            <div class="ts__minicart_btn_area">
                <a class="common_btn" href="{{ route('cart-details') }}">view cart</a>
                <a class="common_btn" href="{{ route('user.checkout') }}">checkout</a>
            </div>
        </div>
    </div>

</header>
