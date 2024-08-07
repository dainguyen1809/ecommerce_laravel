@extends('vendor.layouts.master')

@push('styles')
    <link href="{{ asset('backend/css/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row">
        <div class="ts__dashboard_profile">
            <div class="ts__dash_pro_area">
                <h4 class="text-info">Hi! {{ Auth::user()->name }}</h4>
                <form action="{{ route('vendor.vendor-profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <h4>Preview</h4>
                        <img src="{{ asset($profile->banner) }}" width="150" alt="banner">
                    </div>
                    <div class="form-group mb-3">
                        <label>Banner</label>
                        <input type="file" name="banner" class="form-control-file">
                    </div>
                    <div class="form-group mb-3">
                        <label>Shop Name</label>
                        <input type="text" name="shop_name" class="form-control" value="{{ $profile->shop_name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $profile->phone }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $profile->email }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $profile->address }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="example-textarea">Description</label>
                        <textarea id="summernote-basic" name="description">{{ $profile->description }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Facebook</label>
                        <input type="text" name="fb_link" class="form-control" value="{{ $profile->fb_link }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Instagram</label>
                        <input type="text" name="ins_link" class="form-control" value="{{ $profile->ins_link }}">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                            <a href="{{ route('admin.vendor-profile.index') }}" class="btn btn-secondary col-sm-2">
                                <i class="fas fa-arrow-left"></i>
                                {{ __('Back to dashboard') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/js/pages/demo.summernote.js') }}"></script>
@endpush
