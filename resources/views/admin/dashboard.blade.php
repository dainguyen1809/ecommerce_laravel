@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <h3 class="text-info">Daily</h3>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.orders.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cart widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Today Orders</h5>
                        <h3 class="mt-3 mb-3">{{ $todayOrder }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.order.pending') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cart-plus widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Today Orders Pending</h5>
                        <h3 class="mt-3 mb-3">{{ $todayOrder }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <h3 class="text-info">Revenue</h3>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.dashboard') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cash widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Today Earning</h5>
                        <h3 class="mt-3 mb-3">{{ $settings->currency_icon }}{{ $todayEarning }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.dashboard') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cash widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Month Earning</h5>
                        <h3 class="mt-3 mb-3">{{ $settings->currency_icon }}{{ $monthEarning }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.dashboard') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cash widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Year Earning</h5>
                        <h3 class="mt-3 mb-3">{{ $settings->currency_icon }}{{ $yearEarning }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <h3 class="text-info">Personals</h3>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.subscriber.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-bell-check widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Subscribers</h5>
                        <h3 class="mt-3 mb-3">{{ $subscribers }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.admin-list.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-face widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Admin</h5>
                        <h3 class="mt-3 mb-3">{{ $admins }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.vendor.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-face widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Vendors</h5>
                        <h3 class="mt-3 mb-3">{{ $vendors }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.customer.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-face widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Customers</h5>
                        <h3 class="mt-3 mb-3">{{ $customers }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <h3 class="text-info">Total</h3>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.orders.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cart widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Total Orders</h5>
                        <h3 class="mt-3 mb-3">{{ $totalOrders }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.order.pending') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cart-plus widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Total Pending Orders</h5>
                        <h3 class="mt-3 mb-3">{{ $totalPendingOrders }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="#" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cart-plus widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Total Completed Orders</h5>
                        <h3 class="mt-3 mb-3">{{ $totalPendingOrders }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="#" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-cart-off widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Total Canceled Orders</h5>
                        <h3 class="mt-3 mb-3">{{ $totalCanceledOrders }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.review.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-star widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Total Reviews</h5>
                        <h3 class="mt-3 mb-3">{{ $totalReviews }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.brand.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-contact-mail widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Brands</h5>
                        <h3 class="mt-3 mb-3">{{ $totalBrands }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-3">
            <a href="{{ route('admin.category.index') }}" class="text-muted">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-format-list-bulleted-square widget-icon bg-info-lighten text-info"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Average Revenue">Categories</h5>
                        <h3 class="mt-3 mb-3">{{ $totalCategories }}</h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
