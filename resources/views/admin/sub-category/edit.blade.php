@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.sub-category.update', $subCategory->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $subCategory->name }}">
        </div>
        <div class="form-group">
            <label for="example-multiselect">Category</label>
            <select class="custom-select mb-3" name="category_id">
                @foreach ($categories as $category)
                    <option {{ $subCategory->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="example-multiselect">Status</label>
            <select class="custom-select mb-3" name="status">
                <option {{ $subCategory->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                <option {{ $subCategory->status == 0 ? 'selected' : '' }} value="0">Disable</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('admin.sub-category.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
