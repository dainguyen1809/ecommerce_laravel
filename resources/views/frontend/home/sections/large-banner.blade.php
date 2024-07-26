<section id="ts__large_banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                @if ($bannerFour->banner_one->status == 1)
                    <a href="{{ $bannerFour->banner_one->banner_url }}">
                        <img src="{{ asset($bannerFour->banner_one->banner_img) }}" alt="banner" class="img-fluid w-100">
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
