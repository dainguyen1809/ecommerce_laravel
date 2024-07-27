@extends('frontend.layouts.master')

@section('content')
    <section id="ts__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ route('product.index') }}">products</a></li>
                            <li><a href="{{ route('user.payment') }}">payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ts__cart_view">
        <div class="container">
            <div class="ts__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="ts__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-paypal" type="button" role="tab"
                                    aria-controls="v-pills-paypal" aria-selected="true">Paypal</button>

                                <button class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-stripe" type="button" role="tab"
                                    aria-controls="v-pills-stripe" aria-selected="false">Stripe</button>

                                <button class="nav-link common_btn" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-momo" type="button" role="tab"
                                    aria-controls="v-pills-momo" aria-selected="false">Momo</button>

                                <button class="nav-link common_btn" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-cod" type="button" role="tab" aria-controls="v-pills-cod"
                                    aria-selected="false">COD</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="ts__payment_area text-center">
                                            <a href="{{ route('user.paypal.payment') }}" class="nav-link common_btn">Pay
                                                with
                                                Paypal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="v-pills-stripe" role="tabpanel"
                                aria-labelledby="v-pills-stripe-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="ts__payment_area">
                                            <button class="nav-link common_btn">Pay with Stripe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="v-pills-momo" role="tabpanel"
                                aria-labelledby="v-pills-momo-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="ts__payment_area">
                                            <button class="nav-link common_btn">Pay with Momo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('frontend.pages.cod')
                        </div>

                        {{-- <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora cum optio
                                    cumque rerum dolor impedit exercitationem? Eveniet suscipit repellat, quae natus hic
                                    assumenda consequatur excepturi ducimus.</p>
                                <ul>
                                    <li>Natus hic assumenda consequatur excepturi ducimu.</li>
                                    <li>Cumque rerum dolor impedit exercitationem Eveniet suscipit repellat.</li>
                                    <li>Dolor sit amet consectetur adipisicing elit tempora cum .</li>
                                    <li>Orem ipsum dolor sit amet consectetur adipisicing elit asperiores.</li>
                                </ul>
                                <form class="ts__input_area">
                                    <input type="text" placeholder="Enter Something">
                                    <textarea cols="3" rows="4" placeholder="Enter Something"></textarea>
                                    <select class="select_2" name="state">
                                        <option>default select</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                    <button type="submit" class="common_btn mt-4">confirm</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora cum optio
                                    cumque rerum dolor impedit exercitationem? Eveniet suscipit repellat, quae natus hic
                                    assumenda consequatur excepturi ducimus.</p>
                                <ul>
                                    <li>Natus hic assumenda consequatur excepturi ducimu.</li>
                                    <li>Cumque rerum dolor impedit exercitationem Eveniet suscipit repellat.</li>
                                    <li>Dolor sit amet consectetur adipisicing elit tempora cum .</li>
                                    <li>Orem ipsum dolor sit amet consectetur adipisicing elit asperiores.</li>
                                </ul>
                                <form class="ts__input_area">
                                    <input type="text" placeholder="Enter Something">
                                    <textarea cols="3" rows="4" placeholder="Enter Something"></textarea>
                                    <select class="select_2" name="state">
                                        <option>default select</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                    <button type="submit" class="common_btn mt-4">confirm</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                aria-labelledby="v-pills-settings-tab">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora cum optio
                                    cumque rerum dolor impedit exercitationem? Eveniet suscipit repellat, quae natus hic
                                    assumenda consequatur excepturi ducimus.</p>
                                <ul>
                                    <li>Natus hic assumenda consequatur excepturi ducimu.</li>
                                    <li>Cumque rerum dolor impedit exercitationem Eveniet suscipit repellat.</li>
                                    <li>Dolor sit amet consectetur adipisicing elit tempora cum .</li>
                                    <li>Orem ipsum dolor sit amet consectetur adipisicing elit asperiores.</li>
                                </ul>
                                <form class="ts__input_area">
                                    <input type="text" placeholder="Enter Something">
                                    <textarea cols="3" rows="4" placeholder="Enter Something"></textarea>
                                    <select class="select_2" name="state">
                                        <option>default select</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                    <button type="submit" class="common_btn mt-4">confirm</button>
                                </form>
                            </div>
                        </div> --}}

                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="ts__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Booking Summary</h5>
                            <p>subtotal: <span>{{ $settings->currency_icon }}{{ getCartTotalAmount() }}</span></p>
                            <p>shipping fee(+): <span>{{ $settings->currency_icon }}{{ getShippingFee() }}</span></p>
                            <p>
                                coupon(-):
                                <span>
                                    {{ $settings->currency_icon }}{{ getCartDiscount() }}
                                </span>
                            </p>
                            <h6>total <span>{{ $settings->currency_icon }}{{ totalAmount() }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
