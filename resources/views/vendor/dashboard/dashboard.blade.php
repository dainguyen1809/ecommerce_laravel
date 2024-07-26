@extends('vendor.layouts.master')

@section('content')
    <div class="row">
        <div class="row mb-4">
            <h4 class="text-info">Statistics Daily</h4>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item red" href="{{ route('vendor.order.index') }}">
                <i class="fas fa-cart-plus"></i>
                <p>order</p>
                <h5 class="text-light">{{ $todayOrder }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item green" href="{{ route('vendor.order.index') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <p>Pending Order</p>
                <h5 class="text-light">{{ $todayPendingOrder }}</h5>
            </a>
        </div>


        <div class="row mb-4">
            <h4 class="text-info">Revenue Statistics</h4>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item gold" href="#">
                <i class="fas fa-dollar-sign"></i>
                <p>Daily Earning</p>
                <h5 class="text-light">{{ $settings->currency_icon }}{{ $todayEarning }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item gold" href="#">
                <i class="fas fa-dollar-sign"></i>
                <p>Monthly Earning</p>
                <h5 class="text-light">{{ $settings->currency_icon }}{{ $monthEarning }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item gold" href="#">
                <i class="fas fa-dollar-sign"></i>
                <p>Yearly Earning</p>
                <h5 class="text-light">{{ $settings->currency_icon }}{{ $monthEarning }}</h5>
            </a>
        </div>
        <div class="row mb-4">
            <h4 class="text-info">Totals</h4>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item red" href="{{ route('vendor.order.index') }}">
                <i class="fas fa-cart-plus"></i>
                <p>Total Orders</p>
                <h5 class="text-light">{{ $totalOrder }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item green" href="{{ route('vendor.order.index') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <p>Pending Orders</p>
                <h5 class="text-light">{{ $pendingOrder }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item sky" href="{{ route('vendor.order.index') }}">
                <i class="fas fa-clipboard-check"></i>
                <p>Completed Order</p>
                <h5 class="text-light">{{ $completedOrder }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item blue" href="{{ route('vendor.products.index') }}">
                <i class="fas fa-box-archive"></i>
                <p>Total Products</p>
                <h5 class="text-light">{{ $totalProduct }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item gold" href="#">
                <i class="fas fa-sack-dollar"></i>
                <p>Earning</p>
                <h5 class="text-light">{{ $settings->currency_icon }}{{ $totalEarning }}</h5>
            </a>
        </div>
        <div class="col-xl-2 col-6 col-md-4">
            <a class="ts__dashboard_item sky" href="{{ route('vendor.products.index') }}">
                <i class="fas fa-star"></i>
                <p>Reviews</p>
                <h5 class="text-light">{{ $reviews }}</h5>
            </a>
        </div>
    </div>
@endsection
