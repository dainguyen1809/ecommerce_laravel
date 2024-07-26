<script>
    $(document).ready(function() {
        $('.form-shopping-cart').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                method: "post",
                url: "{{ route('add-to-cart') }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        getCartCount();
                        fetchCartProducts();
                        $('.mini-cart-action').removeClass('d-none');
                        toastr.success(response.message)
                    } else if (response.status === 'error') {
                        toastr.error(response.message)
                    }
                },
                error: function(response) {
                    console.log(response.error);
                },
            });
        });

        function getCartCount() {
            $.ajax({
                method: "get",
                url: "{{ route('cart-count') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#cart-count').text(response);
                },
                error: function(response) {
                    console.log(response.error);
                },
            });
        }

        function fetchCartProducts() {
            $.ajax({
                type: "get",
                url: "{{ route('cart-products') }}",
                success: function(response) {
                    console.log(response);
                    $('.mini-cart-warpper').html("");
                    var html = '';
                    for (let item in response) {
                        const product = response[item];
                        html += `
                                <li id="mini-cart-${product.rowId}" class="d-flex align-items-center">
                                    <div class="ts__cart_img">
                                        <a href="{{ url('product-detais/') }}${product.options.slug}">
                                            <img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100">
                                        </a>
                                        <a class="wsis__del_icon sidebar-remove-item" data-rowId="${product.rowId}" href="#">
                                            <i class="fas fa-minus-circle"></i>
                                        </a>
                                    </div>
                                    <div class="ts__cart_text">
                                        <a class="ts__cart_title" href="{{ url('product-detais/') }}${product.options.slug}">${product.name}</a>
                                        <p>{{ $settings->currency_icon }} ${product.price}</p>
                                        <small>
                                            <strong>Varian Total:</strong>
                                            {{ $settings->currency_icon }}
                        ${product.options.variants_total}
                                        </small>
                                        <br>
                                        <small>
                                            <strong>Qty:</strong>
                                            ${product.qty}
                                        </small>
                                    </div>
                                </li>
                            `
                    }
                    $('.mini-cart-warpper').html(html);
                    getSubTotalSidebar();
                },
                error: function(response) {
                    console.log(response);
                },
            });
        }

        $('body').on('click', '.sidebar-remove-item', function(e) {
            e.preventDefault();
            const rowId = $(this).data('rowid')
            $.ajax({
                type: "post",
                url: "{{ route('cart.remove-sidebar-product') }}",
                data: {
                    rowId: rowId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    const productId = '#mini-cart-' + rowId;
                    $(productId).remove();
                    getSubTotalSidebar()
                    if ($('.mini-cart-warpper').find('li').length === 0) {
                        $('.mini-cart-action').addClass('d-none');
                        $('.mini-cart-warpper').html(
                            '<li class="text-center">Cart is empty!</li>'
                        );
                    }
                    toastr.success(response.message);
                },
                error: function(response) {
                    toastr.error(response.message);
                },
            });
        });

        function getSubTotalSidebar() {
            $.ajax({
                type: "get",
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(response) {
                    $('#mini-cart-subtotal').text("{{ $settings->currency_icon }}" + response);
                },
            });
        }

        $('.wishlist').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');

            $.ajax({
                type: "get",
                url: "{{ route('user.wishlist.store') }}",
                data: {
                    id,
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#wishlist-qty').text(response.count);
                        toastr.success(response.message);
                    } else if (response.status === 'warning') {
                        toastr.warning(response.message);
                    }
                },
                error: function(response) {
                    if (response.status === 401) {
                        toastr.error("You must be login to use this feature!");
                    }
                }
            });
        });

        $('#new_letter').on('submit', function(e) {
            e.preventDefault();
            const data = $(this).serialize()

            $.ajax({
                method: "POST",
                url: "{{ route('subscribe') }}",
                data: data,
                beforeSend() {
                    $('.subscribe').html('<i class="fas fa-circle-notch fa-spin"></i>');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('.subscribe').html('<i class="fas fa-check fa-fade"></i>');
                        $('.subscribe_field').val('');
                        toastr.success(response.message);
                    } else if (response.status === 'error') {
                        setTimeout(() => {
                            $('.subscribe').text('Subscribe');
                        }, 1500);
                        toastr.error(response.message);

                    }
                },
                error: function(response) {
                    if (response.status === 422) {
                        const errors = response.responseJSON.errors;
                        toastr.error(errors.email[0]);
                    }
                    setTimeout(() => {
                        $('.subscribe').text('Subscribe');
                    }, 1500);
                }
            });
        });
    });
</script>
