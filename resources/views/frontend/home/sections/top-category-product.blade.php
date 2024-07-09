<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="wsus__monthly_top_banner">
                    <div class="wsus__monthly_top_banner_img">
                        {{-- <img src="images/monthly_top_img3.jpg" alt="" class="img-fluid w-100"> --}}
                        <span></span>
                    </div>
                    <div class="wsus__monthly_top_banner_text">
                        <h4>Black Friday Sale</h4>
                        <h3>Up To <span>70% Off</span></h3>
                        <H6>Everything</H6>
                        <a class="shop_btn" href="#">shop now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
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
                                    $products[] = \App\Models\Product::where('category_id', $category->id)
                                        ->where('status', 1)
                                        ->orderBy('id', 'desc')
                                        ->take(12)
                                        ->get();
                                } elseif ($category === 'sub_category') {
                                    $category = \App\Models\SubCategory::find($lastKey['sub_category']);
                                    $products[] = \App\Models\Product::where('sub_category_id', $category->id)
                                        ->where('status', 1)
                                        ->orderBy('id', 'desc')
                                        ->take(12)
                                        ->get();
                                } elseif ($category === 'child_category') {
                                    $category = \App\Models\ChildCategory::find($lastKey['child_category']);
                                    $products[] = \App\Models\Product::where('child_category_id', $category->id)
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
                                <a class="wsus__hot_deals__single" href="{{ route('product-details', $item->slug) }}">
                                    <div class="wsus__hot_deals__single_img">
                                        <img src="{{ asset($item->thumb_image) }}" alt="{{ $item->name }}"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__hot_deals__single_text">
                                        <h5>{!! limitText($item->name) !!}</h5>
                                        <p class="wsus__rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </p>
                                        @if (checkDiscount($item))
                                            <p class="wsus__tk">{{ $settings->currency_icon }}{{ $item->offer_price }}
                                                <del>{{ $settings->currency_icon }}{{ $item->price }}</del>
                                            </p>
                                        @else
                                            <p class="wsus__tk">
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
