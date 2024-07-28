@extends('frontend.layouts.master')

@section('content')
    <section id="ts__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Sales</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">daily deals</a></li>
                            <li><a href="{{ route('flash-sale') }}">offer details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ts__daily_deals">
        <div class="container">
            <div class="ts__offer_details_area">
                <div class="row mb-5">
                    @if ($bannerTwo->banner_one->status == 1)
                        <div class="col-xl-6 col-lg-6">
                            <div class="ts__single_banner_content">
                                <div class="ts__single_banner_img">
                                    <a href="{{ $bannerTwo->banner_one->banner_url }}">
                                        <img src="{{ $bannerTwo->banner_one->banner_img }}" alt="banner"
                                            class="img-fluid w-100">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($bannerTwo->banner_two->status == 1)
                        <div class="col-xl-6 col-lg-6">
                            <div class="ts__single_banner_content">
                                <div class="ts__single_banner_img">
                                    <a href="{{ $bannerTwo->banner_two->banner_url }}">
                                        <img src="{{ $bannerTwo->banner_two->banner_img }}" alt="banner"
                                            class="img-fluid w-100">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xl-12 mt-4">
                        <div class="ts__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="ts__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @php
                        $products = \App\Models\Product::withAvg('reviews', 'rating') // => reviews_avg_rating method
                            ->withCount('reviews') // => reviews_count method
                            ->with(['productVariants', 'category', 'productImageGalleries'])
                            ->whereIn('id', $flashSaleItems)
                            ->get();
                    @endphp
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
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
