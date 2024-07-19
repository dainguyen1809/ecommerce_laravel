@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                        <th class="wsus__pro_tk">
                                            unit price
                                        </th>

                                        <th class="wsus__pro_status">
                                            total
                                        </th>
                                        @if (Cart::content()->count() === 0)
                                            <th class="wsus__pro_icon"></th>
                                        @else
                                            <th class="wsus__pro_icon">
                                                <a href="#" class="common_btn clear-cart">clear cart</a>
                                            </th>
                                        @endif
                                    </tr>

                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ $item->options->image }}" alt="product"
                                                    class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{!! $item->name !!}</p>
                                                @foreach ($item->options->variants as $key => $variant)
                                                    <span>{{ $key }}: {{ $variant['name'] }}
                                                        ({{ $settings->currency_icon . $variant['price'] }})
                                                    </span>
                                                @endforeach
                                            </td>

                                            <td class="wsus__pro_select">
                                                <button class="btn btn-secondary decrease">-</button>
                                                <input class="product-quantity" data-rowId="{{ $item->rowId }}"
                                                    type="text" min="1" max="100" readonly
                                                    value="{{ $item->qty }}">
                                                <button class="btn btn-secondary increase">+</button>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>{{ $settings->currency_icon . $item->price }}</h6>
                                            </td>

                                            <td class="wsus__pro_status">
                                                <h6 id="{{ $item->rowId }}">
                                                    {{ $settings->currency_icon . ($item->price + $item->options->variants_total) * $item->qty }}
                                                </h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('cart-remove-item', $item->rowId) }}">
                                                    <i class="far fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($cartItems) === 0)
                                        <tr class="d-flex justify-content-center">
                                            <td class="wsus__pro_name">
                                                <h4>Cart is empty!</h4>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="sub-total">{{ $settings->currency_icon }}{{ getCartTotalAmount() }}</span>
                        </p>
                        <p>coupon: <span id="discount">{{ $settings->currency_icon }}{{ getCartDiscount() }}</span></p>
                        <p class="total"><span>total: </span>
                            <span id="cart-total">{{ $settings->currency_icon }}{{ getMainCartTotal() }}</span>
                        </p>

                        <form id="form-coupon">
                            <input type="text" placeholder="Coupon Code" name="coupon_code"
                                value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{ route('user.checkout') }}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{ route('home') }}"><i
                                class="fab fa-shopify"></i> keep shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            @if ($cartBanner->banner_one->status == 1)
                                <a href="{{ $cartBanner->banner_one->banner_url }}">
                                    <img src="{{ asset($cartBanner->banner_one->banner_img) }}" alt="banner"
                                        class="img-fluid w-100">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            @if ($cartBanner->banner_two->status == 1)
                                <a href="{{ $cartBanner->banner_two->banner_url }}">
                                    <img src="{{ asset($cartBanner->banner_two->banner_img) }}" alt="banner"
                                        class="img-fluid w-100">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // increment qty product
            $('.increase').on('click', function() {
                const input = $(this).siblings('.product-quantity');
                const quantity = parseInt(input.val()) + 1;
                const rowId = input.data('rowid');
                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            const productId = '#' + rowId;
                            const totalAmount = "{{ $settings->currency_icon }}" + response
                                .product_total;
                            $(productId).text(totalAmount);
                            renderCartSubTotal();
                            calculateCouponDiscount();
                            toastr.success(response.message);
                        } else if (response.status === 'error') {
                            toastr.error(response.message);
                        }
                    },
                    error: function(response) {
                        toastr.error(response.message);
                    }
                })
            })

            // decrement qty product
            $('.decrease').on('click', function() {
                const input = $(this).siblings('.product-quantity');
                const quantity = parseInt(input.val()) - 1;
                const rowId = input.data('rowid');

                if (quantity < 1) {
                    quantity = 1;
                }

                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            const productId = '#' + rowId;
                            const totalAmount = "{{ $settings->currency_icon }}" + response
                                .product_total;
                            $(productId).text(totalAmount);
                            renderCartSubTotal();
                            calculateCouponDiscount();
                            toastr.success(response.message);
                        } else if (response.status === 'error') {
                            toastr.error(response.message);
                        }
                    },
                    error: function(response) {
                        toastr.error(response.message)
                    }
                })
            })

            // clear cart
            $('.clear-cart').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action will be clear your cart!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, clear it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'get',
                            url: "{{ route('clear-cart') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    Swal.fire({
                                        icon: "success",
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        location.reload();
                                    })
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Cant Delete',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                });
            });

            function renderCartSubTotal() {
                $.ajax({
                    type: "get",
                    url: "{{ route('cart.sidebar-product-total') }}",
                    success: function(response) {
                        $('#sub-total').text("{{ $settings->currency_icon }}" + response);
                    },
                    error: function(response) {
                        console.log(response);
                    },
                });
            }

            $('#form-coupon').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                $.ajax({
                    type: "get",
                    url: "{{ route('apply-coupon') }}",
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            calculateCouponDiscount();
                            toastr.success(response.message);
                        } else if (response.status === 'error') {
                            toastr.error(response.message);
                        }
                    },
                });
            });

            function couponDiscount() {
                $.ajax({
                    type: "get",
                    url: "{{ route('apply-coupon') }}",
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        } else if (response.status === 'error') {
                            toastr.error(response.message);
                        }
                    },
                });
            }

            function calculateCouponDiscount() {
                $.ajax({
                    type: "get",
                    url: "{{ route('coupon-calculation') }}",
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#discount').text("{{ $settings->currency_icon }}" + response.discount);
                            $('#cart-total').text("{{ $settings->currency_icon }}" + response
                                .cart_total);
                        }
                    },
                });
            }


        });
    </script>
@endpush
