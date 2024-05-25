@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.category.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label class="col-form-label">Icon</label>
            <button name="icon" class="btn btn-info" data-selected-class="btn-danger" data-unselected-class="btn-info"
                role="iconpicker"></button>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
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
                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
