@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.footer-grid-two.update', $footer->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $footer->name }}">
        </div>
        <div class="form-group">
            <label>URL</label>
            <input type="text" name="url" class="form-control" value="{{ $footer->url }}">
        </div>
        <div class="form-group">
            <label for="example-multiselects">Status</label>
            <select class="custom-select mb-3" name="status">
                <option {{$footer->status === 1 ? 'selected' : ''}} value="1">Enable</option>
                <option {{$footer->status === 0 ? 'selected' : ''}} value="0">Disable</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('admin.footer-grid-two.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
