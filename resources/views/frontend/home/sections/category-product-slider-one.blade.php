@php
    $productByCategory = json_decode($productByCategoryOne->value);
    $lastKey = [];
    foreach ($productByCategory as $key => $category) {
        if ($category === null) {
            break;
        }
        $lastKey = [$key => $category];
    }
    // Xử lý loại category
    $category = array_keys($lastKey)[0];
    if ($category === 'category') {
        $category = \App\Models\Category::find($lastKey['category']);
        $products = \App\Models\Product::where('category_id', $category->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();
    } elseif ($category === 'sub_category') {
        $category = \App\Models\SubCategory::find($lastKey['sub_category']);
        $products = \App\Models\Product::where('sub_category_id', $category->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();
    } elseif ($category === 'child_category') {
        $category = \App\Models\ChildCategory::find($lastKey['child_category']);
        $products = \App\Models\Product::where('child_category_id', $category->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();
    }

@endphp

<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{ $category->name }}</h3>
                    <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4">
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
                                        {{ $product->price }} {{ $settings->currency_icon }}
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
