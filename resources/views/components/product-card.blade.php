<div class="col-xl-3 col-sm-6 col-lg-4">
    <div class="ts__product_item">
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
        <a class="ts__pro_link" href="{{ route('product-details', $product->slug) }}">
            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_1" />
            <img src="
            @if (isset($product->productImageGalleries[0]->images)) {{ asset($product->productImageGalleries[0]->images) }} 
            @else 
            {{ asset($product->thumb_image) }} @endif"
                alt="{{ $product->name }}" class="img-fluid w-100 img_2" />
        </a>
        <ul class="ts__single_pro_icon">
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="show_product_modal"
                    data-id="{{ $product->id }}">
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
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $product->reviews_avg_rating)
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
                <span>({{ $product->reviews_count }}
                    {{ $product->reviews_count <= 1 ? 'review' : 'reviews' }})</span>
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
