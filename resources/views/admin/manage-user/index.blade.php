@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.manage-user.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="example-multiselect">Role</label>
                    <select class="custom-select mb-3" name="role">
                        <option value="">Select</option>
                        <option value="user">User</option>
                        <option value="vendor">Vendor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Create') }}</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection
