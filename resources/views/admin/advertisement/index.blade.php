@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-3 mb-2 mb-sm-0">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active show" id="v-pills-one-tab" data-toggle="pill" href="#v-pills-one" role="tab"
                    aria-controls="v-pills-one" aria-selected="true">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Homepage banner one</span>
                </a>
                <a class="nav-link" id="v-pills-two-tab" data-toggle="pill" href="#v-pills-two" role="tab"
                    aria-controls="v-pills-two" aria-selected="false">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Homepage banner two</span>
                </a>
                <a class="nav-link" id="v-pills-three-tab" data-toggle="pill" href="#v-pills-three" role="tab"
                    aria-controls="v-pills-three" aria-selected="false">
                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Homepage banner three</span>
                </a>
                <a class="nav-link" id="v-pills-four-tab" data-toggle="pill" href="#v-pills-four" role="tab"
                    aria-controls="v-pills-four" aria-selected="false">
                    <i class="mdi mdi-four-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Homepage banner four</span>
                </a>
                <a class="nav-link" id="v-pills-product-tab" data-toggle="pill" href="#v-pills-product" role="tab"
                    aria-controls="v-pills-product" aria-selected="false">
                    <i class="mdi mdi-product-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Product page banner</span>
                </a>
                <a class="nav-link" id="v-pills-cart-tab" data-toggle="pill" href="#v-pills-cart" role="tab"
                    aria-controls="v-pills-cart" aria-selected="false">
                    <i class="mdi mdi-cart-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Cart page banner</span>
                </a>
            </div>
        </div> <!-- end col-->

        <div class="col-sm-9">
            <div class="tab-content" id="v-pills-tabContent">
                @include('admin.advertisement.homepage-banner-one')
                @include('admin.advertisement.homepage-banner-two')
                @include('admin.advertisement.homepage-banner-three')
                @include('admin.advertisement.homepage-banner-four')
                @include('admin.advertisement.product-page-banner')
                @include('admin.advertisement.cart-page-banner')
            </div> <!-- end tab-content-->
        </div> <!-- end col-->
    </div>
@endsection
