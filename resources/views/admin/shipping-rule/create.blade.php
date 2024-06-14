@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.shipping-rule.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>Cost</label>
            <input type="text" name="cost" class="form-control" value="{{ old('cost') }}">
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-multiselect">Type</label>
                    <select class="custom-select shipping-type mb-3" name="type" value="{{ old('type') }}">
                        <option value="">Select</option>
                        <option value="flat_cost">Flat Cost</option>
                        <option value="min_cost">Minimum Order Amount</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-multiselect">Status</label>
                    <select class="custom-select mb-3" name="status" value="{{ old('status') }}">
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group d-none min-cost">
            <label>Minimum Amount</label>
            <input type="text" name="min_cost" class="form-control" value="{{ old('min_cost') }}">
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Create') }}</button>
                <a href="{{ route('admin.shipping-rule.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.shipping-type', function() {
                const value = $(this).val();
                if (value != 'min_cost') {
                    $('.min-cost').addClass('d-none');
                } else {
                    $('.min-cost').removeClass('d-none');
                }
            });
        });
    </script>
@endpush
