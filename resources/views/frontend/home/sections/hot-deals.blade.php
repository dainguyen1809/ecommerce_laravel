<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>hot deals of the day</h3>
                </div>
            </div>
        </div>
        {{-- <div class="row hot_deals_slider_2">
            <div class="col-xl-4 col-lg-6">
                <div class="wsus__hot_deals_offer">
                    <div class="wsus__hot_deals_img">
                        <img src="images/pro0010.jpg" alt="mobile" class="img-fluid w-100">
                    </div>
                    <div class="wsus__hot_deals_text">
                        <a class="wsus__hot_title" href="product_details.html">apple smart watch</a>
                        <p class="wsus__rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(127 review)</span>
                        </p>
                        <p class="wsus__hot_deals_proce">$160 <del>$200</del></p>
                        <P class="wsus__details">
                            Lorem ipsum dolor sit amet, cons
                            ectetur incid duut labore et dol.
                            Re magna atellus in metus.
                        </P>
                        <ul>
                            <li><a class="add_cart" href="#">add to cart</a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a></li>
                        </ul>
                        <div class="simply-countdown simply-countdown-one"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="wsus__hot_deals_offer">
                    <div class="wsus__hot_deals_img">
                        <img src="images/pro0011.jpg" alt="mobile" class="img-fluid w-100">
                    </div>
                    <div class="wsus__hot_deals_text">
                        <a class="wsus__hot_title" href="product_details.html">portable mobile Speaker</a>
                        <p class="wsus__rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(176 review)</span>
                        </p>
                        <p class="wsus__hot_deals_proce">$200 <del>$220</del></p>
                        <P class="wsus__details">
                            Lorem ipsum dolor sit amet, cons
                            ectetur incid duut labore et dol.
                            Re magna atellus in metus.
                        </P>
                        <ul>
                            <li><a class="add_cart" href="#">add to cart</a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a></li>
                        </ul>
                        <div class="simply-countdown simply-countdown-one"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="wsus__hot_deals_offer">
                    <div class="wsus__hot_deals_img">
                        <img src="images/pro0012.jpg" alt="mobile" class="img-fluid w-100">
                    </div>
                    <div class="wsus__hot_deals_text">
                        <a class="wsus__hot_title" href="product_details.html">apple smart watch</a>
                        <p class="wsus__rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(127 review)</span>
                        </p>
                        <p class="wsus__hot_deals_proce">$160 <del>$200</del></p>
                        <P class="wsus__details">
                            Lorem ipsum dolor sit amet, cons
                            ectetur incid duut labore et dol.
                            Re magna atellus in metus.
                        </P>
                        <ul>
                            <li><a class="add_cart" href="#">add to cart</a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a></li>
                        </ul>
                        <div class="simply-countdown simply-countdown-one"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="wsus__hot_deals_offer">
                    <div class="wsus__hot_deals_img">
                        <img src="images/pro0013.jpg" alt="mobile" class="img-fluid w-100">
                    </div>
                    <div class="wsus__hot_deals_text">
                        <a class="wsus__hot_title" href="product_details.html">portable mobile Speaker</a>
                        <p class="wsus__rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(176 review)</span>
                        </p>
                        <p class="wsus__hot_deals_proce">$200 <del>$220</del></p>
                        <P class="wsus__details">
                            Lorem ipsum dolor sit amet, cons
                            ectetur incid duut labore et dol.
                            Re magna atellus in metus vulpue
                            te eu sceleri que felis.
                        </P>
                        <ul>
                            <li><a class="add_cart" href="#">add to cart</a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a></li>
                        </ul>
                        <div class="simply-countdown simply-countdown-one"></div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">
                            <button class="active auto_click" data-filter=".new_arrival">New Arrival</button>
                            <button data-filter=".featured_product">Featured</button>
                            <button data-filter=".best_product">Best Product</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                @foreach ($typeProducts as $key => $products)
                    @foreach ($products as $product)
                        <div class="col-xl-3 col-sm-6 col-lg-4 {{ $key }}">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ formatProductType($product->product_type) }}</span>
                                @if (checkDiscount($product))
                                    <span class="wsus__minus">
                                        -{{ calculateDiscountPercent($product->price, $product->offer_price) }}%
                                    </span>
                                @endif
                                <a class="wsus__pro_link" href="{{ route('product-details', $product->slug) }}">
                                    <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}"
                                        class="img-fluid w-100 img_1" />
                                    <img src="
                        @if (isset($product->productImageGalleries[0]->images)) {{ asset($product->productImageGalleries[0]->images) }} 
                        @else 
                        {{ asset($product->thumb_image) }} @endif"
                                        alt="{{ $product->name }}" class="img-fluid w-100 img_2" />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $product->id }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
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
                                    <a class="wsus__pro_name"
                                        href="{{ route('product-details', $product->slug) }}">{{ $product->name }}</a>
                                    @if (checkDiscount($product))
                                        <p class="wsus__price">
                                            {{ $product->offer_price }}
                                            {{ $settings->currency_icon }}
                                            <del>
                                                {{ $product->price }}
                                                {{ $settings->currency_icon }}
                                            </del>
                                        </p>
                                    @else
                                        <p class="wsus__price">{{ $product->price }}
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
                                        <input name="quantity" type="hidden" min="1" max="100"
                                            value="1" />
                                        <button type="submit" class="add_cart" style="border: none !important;">
                                            add to cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="wsus__single_banner_content banner_1">
                            <div class="wsus__single_banner_img">
                                <img src="images/single_banner_44.jpg" alt="banner" class="img-fluid w-100">
                            </div>
                            <div class="wsus__single_banner_text">
                                <h6>sell on <span>35% off</span></h6>
                                <h3>smart watch</h3>
                                <a class="shop_btn" href="#">shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="wsus__single_banner_content single_banner_2">
                                    <div class="wsus__single_banner_img">
                                        <img src="images/single_banner_55.jpg" alt="banner" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_banner_text">
                                        <h6>New Collection</h6>
                                        <h3>kid's fashion</h3>
                                        <a class="shop_btn" href="#">shop now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-lg-4">
                                <div class="wsus__single_banner_content">
                                    <div class="wsus__single_banner_img">
                                        <img src="images/single_banner_66.jpg" alt="banner" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_banner_text">
                                        <h6>sell on <span>42% off</span></h6>
                                        <h3>winter collection</h3>
                                        <a class="shop_btn" href="#">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
