@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('type') }}">
        </div>
        <div class="form-group">
            <label for="example-multiselect">Is Featured</label>
            <select class="custom-select mb-3" name="is_featured">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="example-multiselect">Status</label>
            <select class="custom-select mb-3" name="status">
                <option value="1">Enable</option>
                <option value="0">Disable</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Create') }}</button>
                <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
