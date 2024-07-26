<section id="ts__single_banner" class="ts__single_banner_2">
    <div class="container">
        <div class="row">
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
    </div>
</section>
