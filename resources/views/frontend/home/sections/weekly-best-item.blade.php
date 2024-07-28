@php
    $weeklyProductCategories = json_decode($weeklyProduct->value, true);

@endphp

<section id="ts__weekly_best" class="home2_ts__weekly_best_2 ">
    <div class="container">
        <div class="row">
            @foreach ($weeklyProductCategories as $weeklyProductCategory)
                @php

                    $lastKey = [];
                    foreach ($weeklyProductCategory as $key => $category) {
                        if ($category === null) {
                            break;
                        }
                        $lastKey = [$key => $category];
                    }
                    // Xử lý loại category
                    $category = array_keys($lastKey)[0];
                    if ($category === 'category') {
                        $category = \App\Models\Category::find($lastKey['category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating') // => reviews_avg_rating method
                            ->withCount('reviews')
                            ->with(['productVariants', 'category'])
                            ->where('category_id', $category->id)
                            ->where('is_approved', 1)
                            ->where('status', 1)
                            ->orderBy('id', 'desc')
                            ->take(6)
                            ->get();
                    } elseif ($category === 'sub_category') {
                        $category = \App\Models\SubCategory::find($lastKey['sub_category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating') // => reviews_avg_rating method
                            ->withCount('reviews')
                            ->with(['productVariants', 'category'])
                            ->where('sub_category_id', $category->id)
                            ->where('is_approved', 1)
                            ->where('status', 1)
                            ->orderBy('id', 'desc')
                            ->take(6)
                            ->get();
                    } elseif ($category === 'child_category') {
                        $category = \App\Models\ChildCategory::find($lastKey['child_category']);
                        $products = \App\Models\Product::withAvg('reviews', 'rating') // => reviews_avg_rating method
                            ->withCount('reviews')
                            ->with(['productVariants', 'category'])
                            ->where('child_category_id', $category->id)
                            ->where('is_approved', 1)
                            ->where('status', 1)
                            ->orderBy('id', 'desc')
                            ->take(6)
                            ->get();
                    }
                @endphp

                <div class="col-xl-6 col-sm-6">
                    <div class="ts__section_header">
                        <h3>{{ $category->name }}</h3>
                    </div>
                    <div class="row weekly_best2">
                        @foreach ($products as $item)
                            <div class="col-xl-4 col-lg-4">
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
                                            <span>({{ $item->reviews_count }} review)</span>
                                        </p>
                                        @if (checkDiscount($item))
                                            <p class="ts__tk">
                                                {{ $settings->currency_icon }}{{ $item->offer_price }}
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
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
