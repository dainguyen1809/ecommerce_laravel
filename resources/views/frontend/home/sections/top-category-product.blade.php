<section id="ts__monthly_top" class="ts__monthly_top_2">
    <div class="container">
        <div class="row">
            @if ($bannerOne->banner_one->status == 1)
                <div class="col-xl-12 col-lg-12">
                    <div class="ts__monthly_top_banner">
                        <div class="ts__monthly_top_banner_img">
                            <a href="{{ $bannerOne->banner_one->banner_url }}">
                                <img src="{{ asset($bannerOne->banner_one->banner_img) }}" alt=""
                                    class="img-fluid w-100">
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ts__section_header for_md">
                    <h3>Popular Categories</h3>
                    <div class="monthly_top_filter">
                        @php
                            $popularCategories = json_decode($popularCategory->value, true);
                            $products = [];
                        @endphp
                        @foreach ($popularCategories as $key => $popularCategory)
                            @php
                                $lastKey = [];
                                foreach ($popularCategory as $key => $category) {
                                    if ($category === null) {
                                        break;
                                    }
                                    $lastKey = [$key => $category];
                                }
                                // Kiểm tra nếu không có giá trị nào hợp lệ, bỏ qua lần lặp này
                                if (empty($lastKey)) {
                                    break;
                                }
                                // Xử lý loại category
                                $category = array_keys($lastKey)[0];
                                if ($category === 'category') {
                                    $category = \App\Models\Category::find($lastKey['category']);
                                    $products[] = \App\Models\Product::withAvg('reviews', 'rating') // => reviews_avg_rating method
                                        ->with(['productVariants', 'category', 'productImageGalleries'])
                                        ->where('category_id', $category->id)
                                        ->where('is_approved', 1)
                                        ->where('status', 1)
                                        ->orderBy('id', 'desc')
                                        ->take(12)
                                        ->get();
                                } elseif ($category === 'sub_category') {
                                    $category = \App\Models\SubCategory::find($lastKey['sub_category']);
                                    $products[] = \App\Models\Product::withAvg('reviews', 'rating') // => reviews_avg_rating method
                                        ->with(['productVariants', 'category', 'productImageGalleries'])
                                        ->where('sub_category_id', $category->id)
                                        ->where('is_approved', 1)
                                        ->where('status', 1)
                                        ->orderBy('id', 'desc')
                                        ->take(12)
                                        ->get();
                                } elseif ($category === 'child_category') {
                                    $category = \App\Models\ChildCategory::find($lastKey['child_category']);
                                    $products[] = \App\Models\Product::withAvg('reviews', 'rating') // => reviews_avg_rating method
                                        ->with(['productVariants', 'category', 'productImageGalleries'])
                                        ->where('child_category_id', $category->id)
                                        ->where('is_approved', 1)
                                        ->where('status', 1)
                                        ->orderBy('id', 'desc')
                                        ->take(12)
                                        ->get();
                                }
                            @endphp
                            <button class="{{ $loop->index === 0 ? 'auto_click active' : '' }}"
                                data-filter=".category-{{ $loop->index }}">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">
                    @foreach ($products as $key => $product)
                        @foreach ($product as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3 category-{{ $key }}">
                                <a class="ts__hot_deals__single" href="{{ route('product-details', $item->slug) }}">
                                    <div class="ts__hot_deals__single_img">
                                        <img src="{{ asset($item->thumb_image) }}" alt="{{ $item->name }}"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="ts__hot_deals__single_text">
                                        <h5>{!! limitText($item->name) !!}</h5>
                                        <p class="ts__rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $item->reviews_avg_rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span>({{ count($item->reviews) }} review)</span>
                                        </p>
                                        @if (checkDiscount($item))
                                            <p class="ts__tk">{{ $settings->currency_icon }}{{ $item->offer_price }}
                                                <del>{{ $settings->currency_icon }}{{ $item->price }}</del>
                                            </p>
                                        @else
                                            <p class="ts__tk">
                                                {{ $settings->currency_icon }}{{ $item->price }}
                                            </p>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
