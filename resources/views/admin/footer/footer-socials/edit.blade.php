@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.footer-socials.update', $footerSocials->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label class="col-form-label">Icon</label>
            <button name="icon" class="btn btn-info" data-icon="{{ $footerSocials->icon }}" data-selected-class="btn-danger"
                data-unselected-class="btn-info" role="iconpicker"></button>
            <div class="mt-3 d-flex align-items-center">
                <span>Icon: </span>
                <i class="{{ @$footerSocials->icon }}" style="font-size: 30px; margin-left: 15px;"></i>
            </div>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $footerSocials->name }}">
        </div>
        <div class="form-group">
            <label>URL</label>
            <input type="text" name="link" class="form-control" value="{{ $footerSocials->link }}">
        </div>
        <div class="form-group">
            <label for="example-multiselects">Status</label>
            <select class="custom-select mb-3" name="status">
                <option {{ $footerSocials->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                <option {{ $footerSocials->status == 0 ? 'selected' : '' }} value="0">Disable</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('admin.footer-socials.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
