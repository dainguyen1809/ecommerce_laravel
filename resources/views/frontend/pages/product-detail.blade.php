@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>products details</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">product details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__product_details">
        <div class="container">
            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5" style="z-index: 9999 !important;">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    @if ($product->video_link)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif
                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" alt="{{ $product->name }}"
                                                src="{{ asset($product->thumb_image) }}"></li>
                                        @foreach ($product->productImageGalleries as $imageGallery)
                                            <li>
                                                <img class="zoom ing-fluid w-100" alt="{{ $product->name }}"
                                                    src="{{ asset($imageGallery->images) }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-7 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="#">{{ $product->name }}</a>
                            @if ($product->quantity > 0)
                                <p class="wsus__stock_area">
                                    <span class="in_stock">in stock</span>
                                    <code class="fs-5">
                                        ({{ $product->quantity }}
                                        {{ $product->quantity <= 1 ? 'item' : 'items' }})
                                    </code>
                                </p>
                            @else
                                <p class="wsus__stock_area">
                                    <span class="in_stock bg-danger">stock out</span>
                                    <code class="fs-5">
                                        ({{ $product->quantity }}
                                        {{ $product->quantity <= 1 ? 'item' : 'items' }})
                                    </code>
                                </p>
                            @endif

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
                            @if (!empty($flashSaleItems[0]->flashSale->end_date))
                                <div class="wsus_pro_hot_deals">
                                    <h5>offer ending time: </h5>
                                    <div class="simply-countdown simply-countdown-one"></div>
                                </div>
                            @endif
                            <form class="form-shopping-cart">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="wsus__selectbox">
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
                                <div class="wsus__quentity">
                                    <h5>quantity :</h5>
                                    <div class="select_number">
                                        <input class="number_area" name="quantity" type="text" min="1"
                                            max="100" value="1" />
                                    </div>
                                </div>
                                <ul class="wsus__button_area">
                                    <li><button type="submit" class="add_cart">add to cart</button></li>
                                    <li>
                                        <a href="#" class="wishlist" data-id="{{ $product->id }}">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </form>
                            <p class="brand_model"><span class="text-info">SKU :</span> {{ $product->sku }}</p>
                            <p class="brand_model"><span class="text-info">brand :</span> {{ $product->brand->name }}
                            </p>
                            <div class="row">

                                <p>
                                    {{ $product->short_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                        <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                            <ul>
                                <li>
                                    <span><i class="fal fa-truck"></i></span>
                                    <div class="text">
                                        <h4>Return Available</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="far fa-shield-check"></i></span>
                                    <div class="text">
                                        <h4>Secure Payment</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="fal fa-envelope-open-dollar"></i></span>
                                    <div class="text">
                                        <h4>Warranty Available</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                <h1>Heading</h1>
                                                <p>{!! $product->long_description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="wsus__vebdor_img">
                                                    <img src="{{ asset($product->vendor->banner) }}"
                                                        alt="{{ $product->vendor->shop_name }}" class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4 class="text-info">{{ $product->vendor->user->name }}</h4>
                                                    <p><span>Store Name:</span> {{ $product->vendor->shop_name }}</p>
                                                    <p><span>Address:</span> {{ $product->vendor->address }}</p>
                                                    <p><span>Phone:</span> {{ $product->vendor->phone }}</p>
                                                    <p><span>mail:</span> {{ $product->vendor->email }}</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__vendor_details">
                                                    <p>
                                                        {!! $product->vendor->description !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="wsus__comment_area">
                                                        <h4>Reviews <span>{{ count($reviews) }}</span></h4>
                                                        @foreach ($reviews as $review)
                                                            <div class="wsus__main_comment">
                                                                <div class="wsus__comment_img">
                                                                    <img src="{{ $review->user->avatar }}" alt="user"
                                                                        class="img-fluid w-100">
                                                                </div>
                                                                <div class="wsus__comment_text reply">
                                                                    <h6> {{ $review->user->name }}
                                                                        <span>
                                                                            {{ $review->rating }}
                                                                            <i class="fas fa-star"></i>
                                                                        </span>
                                                                    </h6>
                                                                    <span>{{ date('d-m-Y', strtotime($review->created_at)) }}</span>
                                                                    <p>{{ $review->review }}</p>
                                                                    <ul class="">
                                                                        @if (count($review->productReviewGalleries) > 0)
                                                                            @foreach ($review->productReviewGalleries as $image)
                                                                                <li>
                                                                                    <img src="{{ asset($image->image) }}"
                                                                                        alt="{{ $product->name }}"
                                                                                        class="img-fluid">
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="row mt-5">
                                                            <div class="col-12 d-flex justify-content-center">
                                                                @if ($reviews->hasPages())
                                                                    {{ $reviews->withQueryString()->links() }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                    @php
                                                        $isBought = false;
                                                        $orders = \App\Models\Order::where([
                                                            'user_id' => auth()->user()->id,
                                                            'order_status' => 'delivered',
                                                        ])->get();
                                                        foreach ($orders as $key => $order) {
                                                            $checkItem = $order
                                                                ->orderProducts()
                                                                ->where('product_id', $product->id)
                                                                ->first();
                                                            if ($checkItem) {
                                                                $isBought = true;
                                                            }
                                                        }
                                                    @endphp
                                                    @if ($isBought === true)
                                                        <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                            <h4>write a Review</h4>
                                                            <form action="{{ route('user.review.create') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="wsus__selectbox">
                                                                            <select name="rating" class="form-control">
                                                                                <option value="">Select</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </p>
                                                                <div class="row">
                                                                    <div class="col-xl-12">
                                                                        <div class="col-xl-12">
                                                                            <div class="wsus__single_com">
                                                                                <textarea cols="3" rows="3" name="review" placeholder="Write your review"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="img_upload">
                                                                    <div class="gallery">
                                                                        <label for="img_review" class="btn_upload">Upload
                                                                            Image Reivew</label>
                                                                        <input type="file" name="images[]"
                                                                            id="img_review" hidden multiple>
                                                                        <input type="hidden" name="product_id"
                                                                            value="{{ $product->id }}">
                                                                        <input type="hidden" name="vendor_id"
                                                                            value="{{ $product->vendor_id }}">
                                                                    </div>
                                                                </div>
                                                                <button class="common_btn" type="submit">submit
                                                                    review</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            simplyCountdown(".simply-countdown-one", {
                year: {{ date('Y', strtotime($counterFlashSale->end_date)) }},
                month: {{ date('m', strtotime($counterFlashSale->end_date)) }},
                day: {{ date('d', strtotime($counterFlashSale->end_date)) }},
                enableUtc: true,
            });
        });
    </script>
@endpush
