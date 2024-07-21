@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>vendors</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">vendors</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__product_page" class="wsus__vendors">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <div class="row">
                        @foreach ($vendors as $vendor)
                            <div class="col-xl-6 col-md-6">
                                <div class="wsus__vendor_single">
                                    <img src="{{ asset($vendor->banner) }}" alt="{{ $vendor->shop_name }}"
                                        class="img-fluid w-100">
                                    <div class="wsus__vendor_text">
                                        <div class="wsus__vendor_text_center">
                                            <h4>{{ $vendor->shop_name }}</h4>
                                            <a href="callto:{{ $vendor->phone }}">
                                                <i class="far fa-phone-alt"></i>
                                                {{ $vendor->phone }}
                                            </a>
                                            <a href="mailto:{{ $vendor->email }}">
                                                <i class="fal fa-envelope"></i>
                                                {{ $vendor->email }}
                                            </a>
                                            <a href="{{ route('vendor.products', $vendor->id) }}" class="common_btn">
                                                visit store
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        @if ($vendors->hasPages())
                            {{ $vendors->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
