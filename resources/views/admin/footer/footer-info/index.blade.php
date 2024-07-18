@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.footer-info.update', 1) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="logo" class="btn btn-info"> <i class="uil-upload-alt"></i> Footer Logo</label>
            <input type="file" name="logo" id="logo" class="form-control" value="{{ old('logo') }}" hidden>
        </div>

        @if (isset($footerInfo->logo))
            <div class="row mb-3">
                <img src="{{ asset(@$footerInfo->logo) }}" height="200" alt="logo">
            </div>
        @endif

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="{{ @$footerInfo->email }}">
            </div>
            <div class="form-group col-md-4">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ @$footerInfo->phone }}">
            </div>
            <div class="form-group col-md-4">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ @$footerInfo->address }}">
            </div>
        </div>

        <div class="form-group col-md-4">
            <label>Copyright</label>
            <input type="text" name="copyright" class="form-control" value="{{ @$footerInfo->copyright }}">
        </div>

        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
