@extends('vendor.layouts.master')

@section('content')
    <div class="row">
        <div class="wsus__dashboard_profile">
            <div class="wsus__invoice_area">
                <div class="invoice-content">
                    <div class="wsus__invoice_header">
                        <div class="wsus__invoice_content">
                            <div class="row">
                                <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                    <div class="wsus__invoice_single">
                                        <h5>Invoice To</h5>
                                        <h6>{{ $address->name }}</h6>
                                        <p>{{ $address->email }}</p>
                                        <p>{{ $address->phone }}</p>
                                        <p>
                                            {{ $address->address }},
                                            {{ $address->city }},
                                            {{ $address->state }},
                                            {{ $address->country }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                    <div class="wsus__invoice_single text-md-center">
                                        <h5>Shipping Information</h5>
                                        <h6>{{ $address->name }}</h6>
                                        <p>{{ $address->email }}</p>
                                        <p>{{ $address->phone }}</p>
                                        <p>
                                            {{ $address->address }},
                                            {{ $address->city }},
                                            {{ $address->state }},
                                            {{ $address->country }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="wsus__invoice_single text-md-end">
                                        <h5>Order ID # {{ $order->invoice_id }}</h5>
                                        <h6>Order Status:
                                            {{ config('order_status.order_status_admin')[$order->order_status]['status'] }}
                                        </h6>
                                        <p>Payment Method: {{ $order->payment_method }}</p>
                                        <p>Payment Status: {{ $order->payment_status === 1 ? 'Completed' : 'Pending' }}</p>
                                        <p>Transaction ID: {{ $order->transaction->transaction_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__invoice_description">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="name">
                                            product
                                        </th>

                                        <th class="name">
                                            Vendor
                                        </th>

                                        <th class="amount">
                                            amount
                                        </th>

                                        <th class="quentity">
                                            quentity
                                        </th>
                                        <th class="total">
                                            total
                                        </th>
                                    </tr>
                                    @foreach ($order->orderProducts as $product)
                                        @php
                                            $variants = json_decode($product->variants);
                                        @endphp
                                        <tr>
                                            <td class="name">
                                                <p>{{ $product->product_name }}</p>
                                                @foreach ($variants as $key => $variant)
                                                    <span>
                                                        {{ $key }}: {{ $variant->name }}
                                                        ({{ $settings->currency_icon }} {{ $variant->price }})
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td class="name">
                                                {{ $product->vendor->shop_name }}
                                            </td>

                                            <td class="amount">
                                                {{ $settings->currency_icon }} {{ $product->unit_price }}
                                            </td>

                                            <td class="quentity">
                                                {{ $product->quantity }}
                                            </td>
                                            <td class="total">
                                                {{ $settings->currency_icon }}
                                                {{ ($product->unit_price + $product->variant_total) * $product->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="wsus__invoice_footer">
                        <p>
                            <span>Sub Amount:</span> {{ $settings->currency_icon }}{{ $order->sub_total }}
                        </p>
                        <p>
                            <span>Shipping Fee (+):</span> {{ $settings->currency_icon }}{{ $shipping->cost }}
                        </p>
                        <p>
                            <span>Coupon(-):</span> {{ $settings->currency_icon }}{{ $coupon->discount }}
                        </p>
                        <p>
                            <span>Total Amount:</span> {{ $settings->currency_icon }}{{ $order->amount }}
                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-3">
                        <a href="javascript: void(0);" class="btn btn-info w-100 invoice-print">
                            <i class="fas fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.invoice-print').on('click', function() {
            const print = $('.invoice-content');
            const originalContents = $('body').html();

            $('body').html(print.html());
            window.print();

            $('body').html(originalContents);
        });
    </script>
@endpush
