@extends('vendor.layouts.master')

@section('content')
    <form action="{{ route('vendor.products-variant-item.store', $variant->id) }}" method="post">
        @csrf
        <div class="wsus__add_address_single">
            <label>Variant Name</label>
            <input type="text" name="variant_name" class="form-control" value="{{ $variant->name }}" readonly>
            <input type="hidden" name="product_id" class="form-control" value="{{ $product->id }}">
            <input type="hidden" name="variant_id" class="form-control" value="{{ $variant->id }}">
        </div>
        <div class="wsus__add_address_single">
            <label>Item Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="wsus__add_address_single">
            <label>Price <code>(Set 0 for make it free)</code></label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}">
        </div>
        <div class="wsus__add_address_single">
            <label for="">Is Default</label>
            <div class="wsus__topbar_select">
                <select class="select_2" name="is_default">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="wsus__add_address_single">
            <label>Status</label>
            <div class="wsus__topbar_select">
                <select class="select_2" name="status">
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Create') }}</button>
                <a href="{{ route('vendor.products-variant-item.index', [
                    'productId' => $product->id,
                    'variantId' => $variant->id,
                ]) }}"
                    class="btn btn-secondary col-sm-2">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
