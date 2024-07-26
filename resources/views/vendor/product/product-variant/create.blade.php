@extends('vendor.layouts.master')

@section('content')
    <form action="{{ route('vendor.products-variant.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            <input type="hidden" name="product" class="form-control" value="{{ request()->product }}">
        </div>
        <div class="ts__add_address_single">
            <label>Status</label>
            <div class="ts__topbar_select">
                <select class="select_2" name="status">
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Create') }}</button>
                <a href="{{ route('vendor.products-variant.index', ['product' => request()->product]) }}"
                    class="btn btn-secondary col-sm-2">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
