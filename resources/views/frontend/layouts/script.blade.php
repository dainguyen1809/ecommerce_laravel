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
                                    <div class="wsus__cart_img">
                                        <a href="{{ url('product-detais/') }}${product.options.slug}">
                                            <img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100">
                                        </a>
                                        <a class="wsis__del_icon sidebar-remove-item" data-rowId="${product.rowId}" href="#">
                                            <i class="fas fa-minus-circle"></i>
                                        </a>
                                    </div>
                                    <div class="wsus__cart_text">
                                        <a class="wsus__cart_title" href="{{ url('product-detais/') }}${product.options.slug}">${product.name}</a>
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
                error: function(response) {

                },
            });
        }

    });
</script>
