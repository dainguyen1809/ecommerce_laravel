@extends('frontend.layouts.master')

@section('content')
    <section id="ts__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>wishlist</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ route('product.index') }}">products</a></li>
                            <li><a href="{{ route('user.wishlist') }}">wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ts__cart_view">
        <div class="container">
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Product Item</th>
                            <th scope="col">Product Details</th>
                            <th scope="col">Remaining Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($wishlists as $item)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ asset($item->product->thumb_image) }}" height="150"
                                        alt="{{ $item->product->name }}">

                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->product->quantity }}</td>
                                <td>{{ $settings->currency_icon }} {{ $item->product->price }}</td>
                                <td>
                                    <a href="{{ route('product-details', $item->product->slug) }}"
                                        class="btn btn-info text-light">View
                                        Product</a>
                                    <a href="{{ route('user.wishlist.destroy', $item->id) }}"
                                        class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($wishlists) <= 0)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4 class="text-center">Wishlist is empty!</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
