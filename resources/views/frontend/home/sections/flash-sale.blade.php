<section id="ts__flash_sell" class="ts__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time">
                    <div class="ts__flash_coundown">
                        <span class=" end_text">flash sale</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{ route('flash-sale') }}">see more <i
                                class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($flashSaleItems as $flashSaleItem)
                @php
                    $product = \App\Models\Product::with('reviews')->find($flashSaleItem->product_id);
                @endphp
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="ts__product_item">
                        <span class="ts__new">{{ formatProductType($product->product_type) }}</span>
                        @if (checkDiscount($product))
                            <span class="ts__minus">
                                -{{ calculateDiscountPercent($product->price, $product->offer_price) }}%
                            </span>
                        @endif
                        <a class="ts__pro_link" href="{{ route('product-details', $product->slug) }}">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}"
                                class="img-fluid w-100 img_1" />
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
                            <a class="ts__category" href="#">{{ $product->category->name }} </a>
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
                                href="{{ route('product-details', $product->slug) }}">{{ limitText($product->name, 65) }}</a>
                            @if (checkDiscount($product))
                                <p class="ts__price">
                                    {{ $product->offer_price }}
                                    {{ $settings->currency_icon }}
                                    <del>
                                        {{ $product->price }} {{ $settings->currency_icon }}
                                    </del>
                                </p>
                            @else
                                <p class="ts__price">{{ $product->price }}
                                    {{ $settings->currency_icon }}
                                </p>
                            @endif
                            <form class="form-shopping-cart">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                                <input name="quantity" type="hidden" min="1" max="100" value="1" />
                                <button type="submit" class="add_cart" style="border: none !important;">
                                    add to cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@foreach ($flashSaleItems as $flashSaleItem)
    @php
        $product = \App\Models\Product::find($flashSaleItem->product_id);
    @endphp
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
                                        ({{ $product->quantity }} item)</p>
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

                                    @if (!empty($flashSaleItems[0]->flashSale->end_date))
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
                                            <li>
                                                <a href="#" class="wishlist" data-id="{{ $product->id }}">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </li>
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
