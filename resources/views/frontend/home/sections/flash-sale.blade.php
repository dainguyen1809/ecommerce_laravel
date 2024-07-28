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
            @php
                $products = \App\Models\Product::withAvg('reviews', 'rating') // => reviews_avg_rating method
                    ->withCount('reviews') // => reviews_count method
                    ->with(['productVariants', 'category', 'productImageGalleries'])
                    ->whereIn('id', $flashSaleItems)
                    ->get();
            @endphp
            @foreach ($products as $product)
                <x-product-card :product='$product' />
            @endforeach
        </div>
    </div>
</section>

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
