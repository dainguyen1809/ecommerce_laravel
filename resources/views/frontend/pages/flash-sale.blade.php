@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>offer detaila</h4>
                        <ul>
                            <li><a href="#">daily deals</a></li>
                            <li><a href="#">offer details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="images/offer_banner_2.png" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="images/offer_banner_3.png" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($flashSaleItems as $flashSaleItem)
                        @php
                            $product = \App\Models\Product::find($flashSaleItem->product_id);
                        @endphp
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ formatProductType($product->product_type) }}</span>
                                @if (checkDiscount($product))
                                    <span class="wsus__minus">
                                        -{{ calculateDiscountPercent($product->price, $product->offer_price) }}%
                                    </span>
                                @endif
                                <a class="wsus__pro_link" href="product_details.html">
                                    <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}"
                                        class="img-fluid w-100 img_1" />
                                    <img src="
                            @if (isset($product->productImageGalleries[0]->images)) {{ asset($product->productImageGalleries[0]->images) }} 
                            @else 
                            {{ asset($product->thumb_image) }} @endif"
                                        alt="{{ $product->name }}" class="img-fluid w-100 img_2" />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                                    <p class="wsus__pro_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(133 review)</span>
                                    </p>
                                    <a class="wsus__pro_name" href="#">{{ $product->name }}</a>
                                    @if (checkDiscount($product))
                                        <p class="wsus__price">
                                            ${{ $product->offer_price }}
                                            <del>${{ $product->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__price">${{ $product->price }}</p>
                                    @endif
                                    <a class="add_cart" href="#">add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        @if ($flashSaleItems->hasPages())
                            {{ $flashSaleItems->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            simplyCountdown(".simply-countdown-one", {
                year: {{ date('Y', strtotime($counterFlashSale->end_date)) }},
                month: {{ date('m', strtotime($counterFlashSale->end_date)) }},
                day: {{ date('d', strtotime($counterFlashSale->end_date)) }},
                enableUtc: true,
            });
        });
    </script>
@endpush
