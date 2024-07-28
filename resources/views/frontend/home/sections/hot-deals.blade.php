<section id="ts__hot_deals" class="ts__hot_deals_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="ts__section_header">
                    <h3>hot deals of the day</h3>
                </div>
            </div>
        </div>
        <div class="ts__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="ts__section_header justify-content-start">
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
                        <x-product-card :product="$product" :key="$key" />
                    @endforeach
                @endforeach
            </div>
        </div>

        <section id="ts__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    @if ($bannerThree->banner_one->status == 1)
                        <div class="col-xl-6 col-lg-6">
                            <div class="ts__single_banner_content banner_1">
                                <div class="ts__single_banner_img">
                                    <a href="{{ $bannerThree->banner_one->banner_url }}">
                                        <img src="{{ asset($bannerThree->banner_one->banner_img) }}" alt="banner"
                                            class="img-fluid w-100">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            @if ($bannerThree->banner_two->status == 1)
                                <div class="col-12">
                                    <div class="ts__single_banner_content single_banner_2 single_banner_2_top">
                                        <div class="ts__single_banner_img">
                                            <a href="{{ $bannerThree->banner_two->banner_url }}">
                                                <img src="{{ asset($bannerThree->banner_two->banner_img) }}"
                                                    alt="banner" class="img-fluid w-100">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($bannerThree->banner_three->status == 1)
                                <div class="col-12 mt-lg-4">
                                    <div class="ts__single_banner_content single_banner_2_bottom">
                                        <div class="ts__single_banner_img">
                                            <a href="{{ $bannerThree->banner_three->banner_url }}">
                                                <img src="{{ asset($bannerThree->banner_three->banner_img) }}"
                                                    alt="banner" class="img-fluid w-100">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
