@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>check out</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">check out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <h5>Billing Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                new address</a></h5>

                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping-address" data-id="{{ $address->id }}"
                                                type="radio" name="flexRadioDefault"
                                                id="{{ 'flexRadioDefault' . $address->id }}">
                                            <label class="form-check-label" for="{{ 'flexRadioDefault' . $address->id }}">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span> {{ $address->name }}</li>
                                            <li><span>Phone :</span> {{ $address->phone }}</li>
                                            <li><span>Email :</span> {{ $address->email }} </li>
                                            <li><span>Country :</span> {{ $address->country }}</li>
                                            <li><span>City :</span> {{ $address->city }}</li>
                                            <li><span>State :</span> {{ $address->state }}</li>
                                            <li><span>Zip Code :</span> {{ $address->zipcode }}</li>
                                            <li><span>Address :</span> {{ $address->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">shipping Methods</p>
                        @foreach ($shippingMethods as $shippingMethod)
                            @if ($shippingMethod->type === 'min_cost' && getCartTotalAmount() >= $shippingMethod->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping-method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $shippingMethod->id }}"
                                        data-id="{{ $shippingMethod->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $shippingMethod->name }}
                                        <span>Cost: ({{ $settings->currency_icon }}{{ $shippingMethod->cost }})</span>
                                    </label>
                                </div>
                            @elseif($shippingMethod->type === 'flat_cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping-method" type="radio" name="exampleRadios"
                                        id="exampleRadios2" value="{{ $shippingMethod->id }}"
                                        data-id="{{ $shippingMethod->cost }}">
                                    <label class="form-check-label" for="exampleRadios2">
                                        {{ $shippingMethod->name }}
                                        <span>Cost: ({{ $settings->currency_icon }}{{ $shippingMethod->cost }})</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                        <div class="wsus__order_details_summery">
                            <p>subtotal: <span>{{ $settings->currency_icon }}{{ getCartTotalAmount() }}</span></p>
                            <p>shipping fee: <span id="shipping-fee">{{ $settings->currency_icon }}0</span></p>
                            <p>coupon: <span>{{ $settings->currency_icon }}{{ getCartDiscount() }}</span></p>
                            <p>
                                <b>total:</b>
                                <span>
                                    <b id="total-amount" data-id="{{ getMainCartTotal() }}">
                                        {{ $settings->currency_icon }}{{ getMainCartTotal() }}
                                    </b>
                                </span>
                            </p>
                        </div>
                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input agree-term" type="checkbox" value=""
                                    id="flexCheckChecked3">
                                <label class="form-check-label" for="flexCheckChecked3">
                                    I have read and agree to the website <a href="#">terms and conditions *</a>
                                </label>
                            </div>
                        </div>
                        <form action="" id="checkout-form">
                            <input type="hidden" name="shipping_method_id" id="shipping-method-id" value="">
                            <input type="hidden" name="shipping_address_id" id="shipping-address-id" value="">
                        </form>
                        <a href="" id="checkout-submit" class="common_btn">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{ route('user.checkout.address-create') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Fullname" name="name"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Phone *" name="phone"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" placeholder="Email *" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <select class="select_2" name="country">
                                                <option value="">Country / Region *</option>
                                                @foreach (config('settings.country_list') as $country)
                                                    <option {{ $country === old('country') ? 'selected' : '' }}
                                                        value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="State *" name="state"
                                                value="{{ old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Town / City *" name="city"
                                                value="{{ old('city') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Zipcode *" name="zipcode"
                                                value="{{ old('zipcode') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Address *" name="address"
                                                value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.shipping-method').on('click', function() {
                const shippingFee = $(this).data('id');
                const currentTotalAmount = $('#total-amount').data('id');
                const totalAmount = currentTotalAmount + shippingFee;

                $('#shipping-method-id').val($(this).val());
                $('#shipping-fee').text("{{ $settings->currency_icon }}" + shippingFee);
                $('#total-amount').text("{{ $settings->currency_icon }}" + totalAmount);
            });
            $('.shipping-address').on('click', function() {
                $('#shipping-address-id').val($(this).data('id'));
            });

            $('#checkout-submit').on('click', function(e) {
                e.preventDefault();
                if ($('#shipping-method-id').val() == "" && $('#shipping-address-id').val() == "") {
                    toastr.error('Please click choose address method and shipping method!');
                } else if ($('#shipping-method-id').val() == "") {
                    toastr.error('Shipping method is required!');
                } else if ($('#shipping-address-id').val() == "") {
                    toastr.error('Address method is required!');
                } else if (!$('.agree-term').prop('checked')) {
                    toastr.error('Please Read And Agree Terms And Conditions!');
                }

                $.ajax({
                    type: "post",
                    url: "{{ route('user.checkout.form-submit') }}",
                    data: $('#checkout-form').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#checkout-submit').html(
                            '<i class="fas fa-circle-notch fa-spin fa-1x"></i>'
                        );
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            setTimeout(() => {
                                $('#checkout-submit').html(
                                    '<i class="fas fa-check fa-fade fa-1x"></i>'
                                );
                                window.location.href = response.redirect_url;
                            }, 1500);
                        }
                    },
                });
            });
        });
    </script>
@endpush
