@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <h4>Preview</h4>
            <img src="{{ asset($brand->logo) }}" width="250" alt="logo">
        </div>
        <div class="form-group">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $brand->name }}">
        </div>
        <div class="form-group">
            <label for="example-multiselect">Is Featured</label>
            <select class="custom-select mb-3" name="is_featured">
                <option {{ $brand->is_featured == 1 ? 'selected' : '' }} value="1">Yes</option>
                <option {{ $brand->is_featured == 0 ? 'selected' : '' }} value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="example-multiselect">Status</label>
            <select class="custom-select mb-3" name="status">
                <option {{ $brand->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                <option {{ $brand->status == 0 ? 'selected' : '' }} value="0">Disable</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
