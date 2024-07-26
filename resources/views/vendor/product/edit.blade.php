@extends('vendor.layouts.master')

@push('styles')
    <link href="{{ asset('backend/css/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row">
        <div class="ts__dashboard_profile">
            <div class="ts__dash_pro_area">
                <form action="{{ route('vendor.products.update', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <h4>Preview</h4>
                        <img src="{{ asset($product->thumb_image) }}" width="150" alt="{{ $product->name }}">
                    </div>
                    <div class="ts__add_address_single">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <div class="ts__add_address_single">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="ts__add_address_single">
                                <label>Category</label>
                                <div class="ts__topbar_select">
                                    <select class="select_2 main-category" name="category">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $product->category_id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="ts__add_address_single">
                                <label>Sub Category</label>
                                <div class="ts__topbar_select">
                                    <select class="select_2 sub-category" name="sub_category">
                                        <option value="">Select</option>
                                        @foreach ($subCategories as $subCategory)
                                            <option {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}
                                                value="{{ $subCategory->id }}">
                                                {{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="ts__add_address_single">
                                <label>Child Category</label>
                                <div class="ts__topbar_select">
                                    <select class="select_2 child-category" name="child_category">
                                        <option value="">Select</option>
                                        @foreach ($childCategories as $childCategory)
                                            <option
                                                {{ $childCategory->id == $product->child_category_id ? 'selected' : '' }}
                                                value="{{ $childCategory->id }}">
                                                {{ $childCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ts__add_address_single">
                                <label>Product Types</label>
                                <div class="ts__topbar_select">
                                    <select class="select_2" name="product_type">
                                        <option value="">Select</option>
                                        <option {{ $product->product_type == 'new_arrival' ? 'selected' : '' }}
                                            value="new_arrival">
                                            New Arrival
                                        </option>
                                        <option {{ $product->product_type == 'featured_product' ? 'selected' : '' }}
                                            value="featured_product">
                                            Featured
                                        </option>
                                        <option {{ $product->product_type == 'best_product' ? 'selected' : '' }}
                                            value="best_product">
                                            Best Product
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="ts__add_address_single">
                                <label>Brand</label>
                                <div class="ts__topbar_select">
                                    <select class="select_2" name="brand">
                                        <option value="">Select</option>
                                        @foreach ($brands as $brand)
                                            <option {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                                                value="{{ $brand->id }}">
                                                {{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ts__add_address_single">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control" value="{{ $product->sku }}">
                    </div>

                    <div class="ts__add_address_single">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                    </div>

                    <div class="ts__add_address_single">
                        <label>Offer Price</label>
                        <input type="text" name="offer_price" class="form-control" value="{{ $product->offer_price }}">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ts__add_address_single">
                                <label for="example-date">Offer Start Date</label>
                                <input class="form-control" id="example-date" type="date" name="offer_start_date"
                                    value="{{ $product->offer_start_date }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="ts__add_address_single">
                                <label for="example-date">Offer End Date</label>
                                <input class="form-control" id="example-date" type="date"
                                    name="offer_end_date"value="{{ $product->offer_end_date }}">
                            </div>
                        </div>
                    </div>

                    <div class="ts__add_address_single">
                        <label>Stock Quantity</label>
                        <input type="number" min="0" name="quantity" class="form-control"
                            value="{{ $product->quantity }}">
                    </div>

                    <div class="ts__add_address_single">
                        <label>Video Link</label>
                        <input type="text" name="video_link" class="form-control" value="{{ $product->video_link }}">
                    </div>

                    <div class="ts__add_address_single">
                        <label>Short Description</label>
                        <p class="text-muted font-13">
                            Only contains 255 characters
                        </p>
                        <textarea name="short_description" data-toggle="maxlength" class="form-control" maxlength="225" rows="3">
                            {{ $product->short_description }}
                        </textarea>
                    </div>

                    <div class="ts__add_address_single">
                        <label for="example-textarea">Long Description</label>
                        <textarea id="summernote-basic" name="long_description">
                            {{ $product->long_description }}
                        </textarea>
                    </div>

                    <div class="ts__add_address_single">
                        <label>SEO Title</label>
                        <input type="text" name="seo_title" class="form-control" value="{{ $product->seo_title }}">
                    </div>

                    <div class="ts__add_address_single">
                        <label>SEO Description</label>
                        <p class="text-muted font-13">
                            Only contains 255 characters
                        </p>
                        <textarea name="seo_description" data-toggle="maxlength" class="form-control" maxlength="225" rows="3">
                            {{ $product->seo_description }}
                        </textarea>
                    </div>

                    <div class="ts__add_address_single">
                        <label>Status</label>
                        <div class="ts__topbar_select">
                            <select class="select_2" name="status">
                                <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                                <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Disable</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                            <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary col-sm-2">
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

    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(event) {
                $('.child-category').html('<option value="">Select</option>');
                const id = $(this).val();
                console.log(id);
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
                        $('.child-category').html('<option value="">Select</option>');
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
