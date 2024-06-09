@extends('vendor.layouts.master')

@section('content')
    <form action="{{ route('vendor.products-variant.update', $productVariant->id) }}" method="post">
        @csrf
        @method('put')
        <div class="wsus__add_address_single">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $productVariant->name }}">
        </div>
        <div class="wsus__add_address_single">
            <label>Status</label>
            <div class="wsus__topbar_select">
                <select class="select_2" name="status">
                    <option {{ $productVariant->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                    <option {{ $productVariant->status == 0 ? 'selected' : '' }} value="0">Disable</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('vendor.products-variant.index', ['product' => $productVariant->product_id]) }}"
                    class="btn btn-secondary col-sm-2">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
