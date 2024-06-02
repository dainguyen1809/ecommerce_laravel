@extends('admin.layouts.master')

@push('styles')
    <link href="{{ asset('backend/css/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="example-multiselect">Category</label>
                    <select class="custom-select mb-3 main-category" name="category">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="example-multiselect">Sub Category</label>
                    <select class="custom-select mb-3 sub-category" name="sub_category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="example-multiselect">Child Category</label>
                    <select class="custom-select mb-3 child-category" name="child_category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-multiselect">Vendor</label>
                    <select class="custom-select mb-3" name="vendor_id">
                        <option value="">Select</option>
                    </select>
                </div>
            </div> --}}
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-multiselect">Brand</label>
                    <select class="custom-select mb-3" name="brand">
                        <option value="">Select</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="form-group">
            <label>Offer Price</label>
            <input type="text" name="offer_price" class="form-control" value="{{ old('offer_price') }}">
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-date">Offer Start Date</label>
                    <input class="form-control" id="example-date" type="date" name="offer_start_date">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="example-date">Offer End Date</label>
                    <input class="form-control" id="example-date" type="date" name="offer_end_date">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Stock Quantity</label>
            <input type="number" min="0" name="quantity" class="form-control" value="{{ old('quantity') }}">
        </div>

        <div class="form-group">
            <label>Video Link</label>
            <input type="text" name="video_link" class="form-control" value="{{ old('video_link') }}">
        </div>

        <div class="form-group">
            <label>Short Description</label>
            <p class="text-muted font-13">
                Only contains 255 characters
            </p>
            <textarea name="short_description" data-toggle="maxlength" class="form-control" maxlength="225" rows="3">
                {{ old('short_description') }}
            </textarea>
        </div>

        <div class="form-group">
            <label for="example-textarea">Long Description</label>
            <textarea id="summernote-basic" name="long_description">
                {{ old('long_description') }}
            </textarea>
        </div>

        <div class="form-group">
            <label for="example-multiselect">Product Types</label>
            <select class="custom-select mb-3" name="product_type">
                <option value="">Select</option>
                <option value="new_arrival">New Arrival</option>
                <option value="featured_product">Featured</option>
                <option value="best_product">Top Product</option>
            </select>
        </div>
        <div class="form-group">
            <label>SEO Title</label>
            <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title') }}">
        </div>

        <div class="form-group">
            <label>SEO Description</label>
            <p class="text-muted font-13">
                Only contains 255 characters
            </p>
            <textarea name="seo_description" data-toggle="maxlength" class="form-control" maxlength="225" rows="3">
                {{ old('seo_description') }}
            </textarea>
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
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('backend/js/vendor/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/js/pages/demo.summernote.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(event) {
                const id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.product.get-sub-categories') }}",
                    data: {
                        id,
                    },
                    success: function(res) {
                        $('.sub-category').html('<option value="">Select</option>');
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
            });

            // child categories
            $('body').on('change', '.sub-category', function(event) {
                let id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.product.get-child-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.child-category').html('<option valude="">Select</option>');
                        $.each(data, function(i, item) {
                            $('.child-category').append(
                                `<option value="${item.id}">${item.name}</option>`
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            });
        });
    </script>
@endpush
