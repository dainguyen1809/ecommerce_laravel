@php
    $categories = \App\Models\Category::where('status', 1)
        ->with([
            'subCategories' => function ($active) {
                $active->where('status', 1)->with([
                    'childCategories' => function ($active) {
                        $active->where('status', 1);
                    },
                ]);
            },
        ])
        ->get();
@endphp


<nav class="ts__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        @foreach ($categories as $category)
                            <li>
                                <a class="{{ count($category->subCategories) > 0 ? 'ts__droap_arrow' : '' }}"
                                    href="{{ route('product.index', ['category' => $category->slug]) }}">
                                    <i class="{{ $category->icon }}"></i>
                                    {{ $category->name }}
                                </a>
                                @if (count($category->subCategories) > 0)
                                    <ul class="wsus_menu_cat_droapdown">
                                        @foreach ($category->subCategories as $subCategory)
                                            <li>
                                                <a href="{{ route('product.index', ['prod' => $subCategory->slug]) }}">{{ $subCategory->name }}
                                                    <i
                                                        class="{{ count($subCategory->childCategories) > 0 ? 'fas fa-angle-right' : '' }}">
                                                    </i>
                                                </a>
                                                @if (count($subCategory->childCategories) > 0)
                                                    <ul class="ts__sub_category">
                                                        @foreach ($subCategory->childCategories as $childCategory)
                                                            <li>
                                                                <a
                                                                    href="{{ route('product.index', ['type' => $childCategory->slug]) }}">
                                                                    {{ $childCategory->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <ul class="ts__menu_item">
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="{{ route('product.index') }}">Products</a></li>
                        <li><a href="{{ route('flash-sale') }}">Flash Sale</a></li>
                        <li><a href="{{ route('vendor.index') }}">vendor</a></li>
                        <li><a href="{{ route('about') }}">about</a></li>
                        <li><a href="{{ route('contact') }}">contact</a></li>
                        <li><a href="{{ route('terms-and-conditions') }}">terms and conditions</a></li>
                    </ul>
                    <ul class="ts__menu_item ts__menu_item_right">
                        <li><a href="{{ route('order-tracking.index') }}">track order</a></li>
                        @if (auth()->check())
                            @if (auth()->user()->role === 'admin')
                                <li><a href="{{ route('admin.dashboard') }}">Go to Admin Panel</a></li>
                            @else
                                <li><a href="{{ route('user.dashboard') }}">my account</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}">login</a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- <section id="ts__mobile_menu">
    <span class="ts__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="ts__mobile_menu_header_icon d-inline-flex">

        <li><a href="wishlist.html"><i class="far fa-heart"></i> <span>2</span></a></li>

        <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li>
    </ul>
    <form>
        <input type="text" placeholder="Search">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="ts__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">
                        @foreach ($categories as $category)
                            <li>
                                <a href="#"
                                    class="{{ count($category->subCategories) > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $loop->index }}">
                                    <i class="{{ $category->icon }}"></i>
                                    {{ $category->name }}
                                </a>
                                @if (count($category->subCategories) > 0)
                                    <div id="flush-collapseThreew-{{ $loop->index }}"
                                        class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            @foreach ($category->subCategories as $subCategory)
                                                <ul>
                                                    <li><a href="#">{{ $subCategory->name }}</a></li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="ts__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">shop</a>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">men's</a></li>
                                        <li><a href="#">wemen's</a></li>
                                        <li><a href="#">kid's</a></li>
                                        <li><a href="#">others</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="vendor.html">vendor</a></li>
                        <li><a href="blog.html">blog</a></li>
                        <li><a href="daily_deals.html">campain</a></li>
                        <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree101" aria-expanded="false"
                                aria-controls="flush-collapseThree101">pages</a>
                            <div id="flush-collapseThree101" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="404.html">404</a></li>
                                        <li><a href="faqs.html">faq</a></li>
                                        <li><a href="invoice.html">invoice</a></li>
                                        <li><a href="about_us.html">about</a></li>
                                        <li><a href="team.html">team</a></li>
                                        <li><a href="product_grid_view.html">product grid view</a></li>
                                        <li><a href="product_grid_view.html">product list view</a></li>
                                        <li><a href="team_details.html">team details</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="track_order.html">track order</a></li>
                        <li><a href="daily_deals.html">daily deals</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> --}}
