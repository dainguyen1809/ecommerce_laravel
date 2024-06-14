@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.coupons.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>Coupon Code</label>
            <input type="text" name="code" class="form-control" value="{{ old('code') }}">
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}">
        </div>
        <div class="form-group">
            <label>Max Use Per Person</label>
            <input type="text" name="max_use" class="form-control" value="{{ old('max_use') }}">
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-date">Start Date</label>
                    <input class="form-control" id="example-date" type="date" name="start_date"
                        value="{{ old('start_date') }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-date">End Date</label>
                    <input class="form-control" id="example-date" type="date" name="end_date"
                        value="{{ old('end_date') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="example-multiselect">Discount Type</label>
                    <select class="custom-select mb-3" name="discount_type" value="{{ old('discount_type') }}">
                        <option value="percent">Percentage (%)</option>
                        <option value="amount">Amount ({{ $settings->currency_icon }})</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="example-multiselect">Discount Value</label>
                    <input type="text" name="discount" class="form-control" value="{{ old('discount') }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="example-multiselect">Status</label>
            <select class="custom-select mb-3" name="status" value="{{ old('status') }}">
                <option value="1">Enable</option>
                <option value="0">Disable</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Create') }}</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary col-sm-2">
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
            $('body').on('change', '.main-category', function(event) {
                const id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.get-sub-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        $('.sub-category').html('<option value="select">Select</option>');
                        $.each(res, function(index, item) {
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            })
        });
    </script>
@endpush
