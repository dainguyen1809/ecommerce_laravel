@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="{{ route('user.order.index') }}">
                <i class="fas fa-cart-plus"></i>
                <p>Total Orders</p>
                <h5 class="text-light">{{ $totalOrder }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item green" href="{{ route('user.order.index') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <p>Pending Orders</p>
                <h5 class="text-light">{{ $pendingOrder }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item sky" href="{{ route('user.order.index') }}">
                <i class="fas fa-clipboard-check"></i>
                <p>Completed Orders</p>
                <h5 class="text-light">{{ $completedOrder }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item blue" href="{{ route('user.review.index') }}">
                <i class="fas fa-star"></i>
                <p>Reviews</p>
                <h5 class="text-light">{{ $review }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item orange" href="{{ route('user.wishlist') }}">
                <i class="fas fa-heart"></i>
                <p>wishlist</p>
                <h5 class="text-light">{{ $wishlist }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item purple" href="{{ route('user.address.index') }}">
                <i class="fal fa-map-marker-alt"></i>
                <p>Address</p>
                <h5 class="text-light">{{ $address }}</h5>
            </a>
        </div>
    </div>
@endsection
