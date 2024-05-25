@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Banner</label>
            <input type="file" name="banner" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="{{ old('type') }}">
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label>Starting Price</label>
            <input type="text" name="starting_price" class="form-control" value="{{ old('starting_price') }}">
        </div>
        <div class="form-group">
            <label>Button URL</label>
            <input type="text" name="btn_url" class="form-control" value="{{ old('btn_url') }}">
        </div>
        <div class="form-group">
            <label>Serial</label>
            <input type="text" name="serial" class="form-control" value="{{ old('serial') }}">
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
                <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
