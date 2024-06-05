@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.products-variant-item.update', $variantItem->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Variant Name</label>
            <input type="text" name="variant_name" class="form-control" value="{{ $variantItem->productVariant->name }}"
                readonly>
        </div>
        <div class="form-group">
            <label>Item Name</label>
            <input type="text" name="name" class="form-control" value="{{ $variantItem->name }}">
        </div>
        <div class="form-group">
            <label>Price <code>(Set 0 for make it free)</code></label>
            <input type="text" name="price" class="form-control" value="{{ $variantItem->price }}">
        </div>
        <div class="form-group">
            <label for="example-multiselect">Is Default</label>
            <select class="custom-select mb-3" name="is_default">
                <option value="">Select</option>
                <option {{ $variantItem->is_default == 1 ? 'selected' : '' }} value="1">Yes</option>
                <option {{ $variantItem->is_default == 0 ? 'selected' : '' }} value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="example-multiselect">Status</label>
            <select class="custom-select mb-3" name="status">
                <option {{ $variantItem->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                <option {{ $variantItem->status == 0 ? 'selected' : '' }} value="0">Disable</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
