@extends('admin.layouts.master')

@push('styles')
    <link href="{{ asset('backend/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <style>
        td.prod_name {
            width: 50%;
        }
    </style>
@endpush

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-content">
                            <!-- Invoice Logo-->
                            <div class="clearfix">
                                <div class="float-left mb-3">
                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                </div>
                                <div class="float-left">
                                    <h4 class="m-0 d-print-none">Invoice</h4>
                                </div>
                            </div>

                            <!-- Invoice Detail-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mt-3">
                                        <p class="font-13"><strong>Order Date: </strong>
                                            {{ date('d, F, Y', strtotime($order->created_at)) }}
                                        </p>
                                        <p class="font-13"><strong>Transaction ID: </strong>
                                            <span>{{ @$order->transaction->transaction_id }}</span>
                                        </p>
                                        <p class="font-13">
                                            <strong>Method: </strong> <span>{{ ucfirst($order->payment_method) }}</span>
                                        </p>
                                        <p class="font-13"><strong>Order ID: </strong>
                                            <span>#{{ $order->invoice_id }}</span>
                                        </p>
                                        <p class="font-13">
                                            <strong>Order Status: </strong>
                                            <span>{{ $order->payment_status === 1 ? 'Paid' : 'Pending' }}</span>
                                        </p>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <hr />
                            <!-- end row -->

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <h6>Billing Address</h6>
                                    <address>
                                        <b>Name: </b> {{ $address->name }}<br>
                                        <b>Email: </b> {{ $address->email }}<br>
                                        <b>Phone: </b> {{ $address->phone }}<br>
                                        <b>Address: </b> {{ $address->address }}<br>
                                        {{ $address->city }}, {{ $address->state }}, {{ $address->zipcode }}<br>
                                        {{ $address->country }}<br>
                                    </address>
                                </div> <!-- end col-->

                                <div class="col-sm-4">
                                    <h6>Shipping Address</h6>
                                    <address>
                                        <b>Name: </b> {{ $address->name }}<br>
                                        <b>Email: </b> {{ $address->email }}<br>
                                        <b>Phone: </b> {{ $address->phone }}<br>
                                        <b>Address: </b> {{ $address->address }}<br>
                                        {{ $address->city }}, {{ $address->state }}, {{ $address->zipcode }}<br>
                                        {{ $address->country }}<br>
                                    </address>
                                </div> <!-- end col-->

                                <div class="col-sm-4">
                                    <div class="text-sm-right">
                                        <img src="{{ asset('images/qrcode.svg') }}" alt="qrcode"
                                            class="img-fluid mr-2 w-25" />
                                    </div>
                                </div> <!-- end col-->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item</th>
                                                    <th>Variants</th>
                                                    <th>Vendor</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Cost</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderProducts as $product)
                                                    @php
                                                        $variants = json_decode($product->variants);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ ++$loop->index }}</td>
                                                        @if (isset($product->product->slug))
                                                            <td class="prod_name">
                                                                <a href="{{ route('product-details', $product->product->slug) }}"
                                                                    target="_blank">
                                                                    {{ $product->product_name }}
                                                                </a>
                                                            </td>
                                                        @else
                                                            <td>
                                                                {{ $product->product_name }}
                                                            </td>
                                                        @endif
                                                        <td>
                                                            @foreach ($variants as $key => $variant)
                                                                <strong>{{ $key }}: </strong>
                                                                <span>{{ $variant->name }}
                                                                    ({{ $settings->currency_icon }} {{ $variant->price }})
                                                                </span>
                                                                <br>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{ $product->vendor->shop_name }}
                                                        </td>
                                                        <td>{{ $product->quantity }}</td>
                                                        <td>{{ $settings->currency_icon }}{{ $product->unit_price }}</td>
                                                        <td class="text-right">
                                                            {{ $settings->currency_icon }}
                                                            {{ $product->unit_price * $product->quantity + $product->variant_total }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-12 d-flex">
                                    <div class="col-sm-8 d-flex">
                                        <div class="col-sm-4">
                                            <label>Payment Status</label>
                                            <select class="custom-select mb-3" name="payment_status"
                                                data-id="{{ $order->id }}" id="payment-status">
                                                <option {{ $order->payment_status == 0 ? 'selected' : '' }} value="0">
                                                    Pending
                                                </option>
                                                <option {{ $order->payment_status == 1 ? 'selected' : '' }} value="1">
                                                    Completed
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Order Status</label>
                                            <select class="custom-select mb-3" name="order_status"
                                                data-id="{{ $order->id }}" id="order-status">
                                                @foreach (config('order_status.order_status_admin') as $key => $status)
                                                    <option {{ $order->order_status === $key ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $status['status'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mt-3 mt-sm-0">
                                        <p>
                                            <b>Sub-total:</b>
                                            <span class="float-right">
                                                {{ $settings->currency_icon }}{{ $order->sub_total }}
                                            </span>
                                        </p>
                                        <p>
                                            <b>Shipping (+): </b>
                                            <span class="float-right">
                                                {{ $settings->currency_icon }}{{ $shipping->cost }}
                                            </span>
                                        </p>
                                        <p>
                                            <b>Coupon (-): </b>
                                            <span class="float-right">
                                                {{ $settings->currency_icon }}{{ $coupon->discount ?? 0 }}
                                            </span>
                                        </p>
                                        <hr>
                                        <p>
                                            <b class="me-2">Total Amount: </b>
                                            <span class="float-right">
                                                {{ $settings->currency_icon }}{{ $order->amount }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
                        </div>

                        <div class="row">
                            <div class="col-12 mt-4 d-flex justify-content-end">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mr-3">
                                    <i class="uil-arrow-left"></i> Back to Orders</a>
                                <a href="javascript: void(0);" class="btn btn-success invoice-print">
                                    <i class="uil-print"></i> Print</a>
                            </div>
                        </div>

                        <!-- end buttons -->
                    </div> <!-- end card-body-->
                </div> <!-- end card -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
    <!-- container -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#order-status').on('change', function() {
                const status = $(this).val();
                const id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        id: id,
                        status: status,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        }
                    }
                });
            });

            $('#payment-status').on('change', function() {
                const status = $(this).val();
                const id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url: "{{ route('admin.order.payment-status') }}",
                    data: {
                        id: id,
                        status: status,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        }
                    }
                });
            });

            $('.invoice-print').on('click', function() {
                const print = $('.invoice-content');
                const originalContents = $('body').html();

                $('body').html(print.html());
                window.print();

                $('body').html(originalContents);
            });

        });
    </script>
@endpush
