@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <h4>Preview</h4>
            <img src="{{ asset($slider->banner) }}" width="150" alt="banner">
        </div>
        <div class="form-group">
            <label>Banner</label>
            <input type="file" name="banner" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="{{ $slider->type }}">
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
        </div>
        <div class="form-group">
            <label>Starting Price</label>
            <input type="text" name="starting_price" class="form-control" value="{{ $slider->starting_price }}">
        </div>
        <div class="form-group">
            <label>Button URL</label>
            <input type="text" name="btn_url" class="form-control" value="{{ $slider->btn_url }}">
        </div>
        <div class="form-group">
            <label>Serial</label>
            <input type="text" name="serial" class="form-control" value="{{ $slider->serial }}">
        </div>
        <div class="form-group">
            <label for="example-multiselect">Status</label>
            <select class="custom-select mb-3" name="status">
                <option {{ $slider->status == 1 ? 'selected' : '' }} value="1">Active</option>
                <option {{ $slider->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
