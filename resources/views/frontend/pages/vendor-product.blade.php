@extends('frontend.layouts.master')

@section('content')
    <section id="ts__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>products</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ route('vendor.index') }}">vendors</a></li>
                            <li><a href="{{ route('vendor.products', $vendor->id) }}">vendor products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ts__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="ts__pro_page_bammer vendor_det_banner">
                        <img src="{{ asset($vendor->banner) }}" alt="banner" class="img-fluid w-100">
                        <div class="ts__pro_page_bammer_text ts__vendor_det_banner_text">
                            <div class="ts__vendor_text_center">
                                <h4>{{ $vendor->shop_name }}</h4>
                                <a href="callto:{{ $vendor->phone }}">
                                    <i class="far fa-phone-alt"></i>
                                    {{ $vendor->phone }}
                                </a>
                                <a href="mailto:{{ $vendor->email }}">
                                    <i class="far fa-envelope"></i>
                                    {{ $vendor->email }}
                                </a>
                                <p class="ts__vendor_location">
                                    <i class="fal fa-map-marker-alt"></i>
                                    {{ $vendor->address }}
                                </p>
                                <ul class="d-flex">
                                    <li>
                                        <a class="facebook" href="{{ $vendor->fb_link }}">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li>
                                        <a class="instagram" href="{{ $vendor->ins_link ? $vendor->ins_link : '#' }}">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="ts__product_topbar">
                                <div class="ts__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button
                                            class="nav-link 
                                            {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'active' : '' }}
                                            {{ !session()->has('product_list_style') ? 'active' : '' }}
                                            list-view"
                                            data-id="grid" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        <button
                                            class="nav-link 
                                        {{ session()->has('product_list_style') && session()->get('product_list_style') === 'list' ? 'active' : '' }}
                                        list-view"
                                            data-id="list" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade 
                             {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'show active' : '' }}
                              {{ !session()->has('product_list_style') ? 'show active' : '' }}"
                                id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="ts__product_item">
                                                <span
                                                    class="ts__new">{{ formatProductType($product->product_type) }}</span>
                                                @if (checkDiscount($product))
                                                    <span class="ts__minus">
                                                        -{{ calculateDiscountPercent($product->price, $product->offer_price) }}%
                                                    </span>
                                                @endif
                                                <a class="ts__pro_link"
                                                    href="{{ route('product-details', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}"
                                                        alt="{{ $product->name }}" class="img-fluid w-100 img_1" />
                                                    <img src="
                                            @if (isset($product->productImageGalleries[0]->images)) {{ asset($product->productImageGalleries[0]->images) }} 
                                            @else 
                                            {{ asset($product->thumb_image) }} @endif"
                                                        alt="{{ $product->name }}" class="img-fluid w-100 img_2" />
                                                </a>
                                                <ul class="ts__single_pro_icon">
                                                    <li>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal-{{ $product->id }}">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="wishlist" data-id="{{ $product->id }}">
                                                            <i class="far fa-heart"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                                <div class="ts__product_details">
                                                    <a class="ts__category" href="#">{{ $product->category->name }}
                                                    </a>
                                                    <p class="ts__pro_rating">
                                                        @php
                                                            $avgRating = round($product->reviews()->avg('rating'));
                                                        @endphp
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $avgRating)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                        <span>({{ count($product->reviews) }} review)</span>
                                                    </p>
                                                    <a class="ts__pro_name"
                                                        href="{{ route('product-details', $product->slug) }}">{{ limitText($product->name, 50) }}</a>
                                                    @if (checkDiscount($product))
                                                        <p class="ts__price">
                                                            {{ $product->offer_price }}
                                                            {{ $settings->currency_icon }}
                                                            <del>
                                                                {{ $product->price }}
                                                                {{ $settings->currency_icon }}
                                                            </del>
                                                        </p>
                                                    @else
                                                        <p class="ts__price">{{ $product->price }}
                                                            {{ $settings->currency_icon }}
                                                        </p>
                                                    @endif
                                                    <form class="form-shopping-cart">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        @foreach ($product->productVariants as $variant)
                                                            @if ($variant->status != 0)
                                                                <select class="d-none" name="variant_items[]">
                                                                    <option>default select</option>
                                                                    @foreach ($variant->productVariantItems as $item)
                                                                        @if ($item->status != 0)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $item->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $item->name }}
                                                                                <code>($ {{ $item->price }} )</code>
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        @endforeach
                                                        <input name="quantity" type="hidden" min="1"
                                                            max="100" value="1" />
                                                        <button type="submit" class="add_cart"
                                                            style="border: none !important;">
                                                            add to cart
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade
                            {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'show active' : '' }}
                            {{ empty(session()->has('product_list_style')) ? 'active' : '' }}
                            "
                                id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-12">
                                            <div class="ts__product_item ts__list_view">
                                                @if (isset($product->product_type))
                                                    <span class="ts__new">
                                                        {{ formatProductType($product->product_type) }}
                                                    </span>
                                                @endif
                                                @if (checkDiscount($product))
                                                    <span class="ts__minus">
                                                        -{{ calculateDiscountPercent($product->price, $product->offer_price) }}%
                                                    </span>
                                                @endif
                                                <a class="ts__pro_link"
                                                    href="{{ route('product-details', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}"
                                                        alt="{{ $product->name }}" class="img-fluid w-100 img_1" />
                                                    <img src="
                                            @if (isset($product->productImageGalleries[0]->images)) {{ asset($product->productImageGalleries[0]->images) }} 
                                            @else 
                                            {{ asset($product->thumb_image) }} @endif"
                                                        alt="{{ $product->name }}" class="img-fluid w-100 img_2" />
                                                </a>
                                                <div class="ts__product_details">
                                                    <a class="ts__category" href="#">{{ $product->category->name }}
                                                    </a>
                                                    <p class="ts__pro_rating">
                                                        @php
                                                            $avgRating = round($product->reviews()->avg('rating'));
                                                        @endphp
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $avgRating)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                        <span>({{ count($product->reviews) }} review)</span>
                                                    </p>
                                                    <a class="ts__pro_name"
                                                        href="{{ route('product-details', $product->slug) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                    @if (checkDiscount($product))
                                                        <p class="ts__price">
                                                            {{ $product->offer_price }}
                                                            {{ $settings->currency_icon }}
                                                            <del>
                                                                {{ $product->price }}
                                                                {{ $settings->currency_icon }}
                                                            </del>
                                                        </p>
                                                    @else
                                                        <p class="ts__price">{{ $product->price }}
                                                            {{ $settings->currency_icon }}
                                                        </p>
                                                    @endif
                                                    <p class="list_description">{!! $product->short_description !!}</p>
                                                    <ul class="ts__single_pro_icon">
                                                        <li>
                                                            <form class="form-shopping-cart me-2">
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                @foreach ($product->productVariants as $variant)
                                                                    @if ($variant->status != 0)
                                                                        <select class="d-none" name="variant_items[]">
                                                                            <option>default select</option>
                                                                            @foreach ($variant->productVariantItems as $item)
                                                                                @if ($item->status != 0)
                                                                                    <option value="{{ $item->id }}"
                                                                                        {{ $item->is_default == 1 ? 'selected' : '' }}>
                                                                                        {{ $item->name }}
                                                                                        <code>($ {{ $item->price }}
                                                                                            )</code>
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    @endif
                                                                @endforeach
                                                                <input name="quantity" type="hidden" min="1"
                                                                    max="100" value="1" />
                                                                <button type="submit" class="add_cart"
                                                                    style="border: none !important;">
                                                                    add to cart
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li><a href="#"><i class="far fa-heart"></i></a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($products) === 0)
                        <div class="row">
                            <h3 class="text-center">Product Not Found !!!</h3>
                        </div>
                    @endif
                </div>

                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        @if ($products->hasPages())
                            {{ $products->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($products as $product)
        <section class="product_popup_modal">
            <div class="modal fade" id="exampleModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="far fa-times"></i></button>
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                    <div class="ts__quick_view_img">
                                        @if ($product->video_link)
                                            <a class="venobox ts__pro_det_video" data-autoplay="true" data-vbtype="video"
                                                href="{{ $product->video_link }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        @endif
                                        <div class="row modal_slider">
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($product->thumb_image) }}"
                                                        alt="{{ $product->name }}" class="img-fluid w-100">
                                                </div>
                                            </div>

                                            @if (count($product->productImageGalleries) === 0)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($product->thumb_image) }}"
                                                            alt="{{ $product->name }}" class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @endif

                                            @foreach ($product->productImageGalleries as $imageGallery)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($imageGallery->images) }}"
                                                            alt="{{ $product->name }}" class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="ts__pro_details_text">
                                        <a class="title"
                                            href="{{ route('product-details', $product->slug) }}">{{ $product->name }}</a>
                                        <p class="ts__stock_area"><span class="in_stock">in stock</span>
                                            ({{ $product->quantity }} item)
                                        </p>
                                        @if (checkDiscount($product))
                                            <h4>{{ $product->offer_price }}<span>{{ $settings->currency_icon }}</span>
                                                <del>{{ $product->price }} {{ $settings->currency_icon }}</del>
                                            </h4>
                                        @else
                                            <h4>${{ $product->price }}</h4>
                                        @endif
                                        <p class="review">
                                            @php
                                                $avgRating = round($product->reviews()->avg('rating'));
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $avgRating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span>({{ count($product->reviews) }} review)</span>
                                        </p>
                                        <p class="description">{!! $product->short_description !!}</p>

                                        @if (!empty($products[0]->flashSale->end_date))
                                            <div class="wsus_pro_hot_deals">
                                                <h5>offer ending time: </h5>
                                                <div class="simply-countdown simply-countdown-one"></div>
                                            </div>
                                        @endif
                                        <form class="form-shopping-cart">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="ts__selectbox">
                                                <div class="row">
                                                    @foreach ($product->productVariants as $variant)
                                                        @if ($variant->status != 0)
                                                            <div class="col-xl-6 col-sm-6 mt-3">
                                                                <h5 class="mb-2">{{ $variant->name }}</h5>
                                                                <select class="select_2" name="variant_items[]">
                                                                    <option>default select</option>
                                                                    @foreach ($variant->productVariantItems as $item)
                                                                        @if ($item->status != 0)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $item->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $item->name }}
                                                                                <code>($ {{ $item->price }} )</code>
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="ts__quentity">
                                                <h5>quantity :</h5>
                                                <div class="select_number">
                                                    <input class="number_area" name="quantity" type="text"
                                                        min="1" max="100" value="1" />
                                                </div>
                                            </div>
                                            <ul class="ts__button_area">
                                                <li>
                                                    <button type="submit" class="add_cart">
                                                        add to cart
                                                    </button>
                                                </li>
                                                <li><a class="buy_now" href="#">buy now</a></li>
                                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                                </li>
                                            </ul>
                                        </form>
                                        <p class="brand_model">
                                            <span class="text-info">SKU :</span>
                                            {{ $product->sku }}
                                        </p>
                                        <p class="brand_model">
                                            <span class="text-info">brand :</span>
                                            {{ $product->brand->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.list-view').on('click', function() {
                const style = $(this).data('id');
                $.ajax({
                    method: "get",
                    url: "{{ route('change-product-view') }}",
                    data: {
                        style,
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
        @php
            if (request()->has('price_range') && request()->price_range != '') {
                $price = explode(';', request()->price_range);
                $from = $price[0];
                $to = $price[1];
            } else {
                $from = 0;
                $to = 10000;
            }
        @endphp
        jQuery(function() {
            jQuery("#slider_range").flatslider({
                min: 0,
                max: 10000,
                step: 100,
                values: [{{ $from }}, {{ $to }}],
                range: true,
                einheit: "{{ $settings->currency_icon }}",
            });
        });
    </script>
@endpush
