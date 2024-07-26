@extends('vendor.layouts.master')

@push('styles')
    <link href="{{ asset('backend/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <!-- Datatables css -->
    {{-- <link href="{{ asset('backend/css/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('backend/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap4.css">
@endpush

@section('content')
    <div class="row mb-5">
        <div class="ts__dashboard_profile">
            <div class="ts__dash_pro_area">
                <div class="row">
                    <h4 class="text-info">Product: {{ $product->name }}</h4>
                </div>
                <form action="{{ route('vendor.products-image-gallery.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">
                            Image
                            <code>(Multiple image supported)</code>
                        </label>
                        <input type="file" class="form-control" name="images[]" multiple>
                        <input type="hidden" name="product" value="{{ $product->id }}">
                    </div>
                    <div class="row">
                        <button class="btn btn-primary col-sm-2 mx-2">Upload</button>
                        <a class="btn btn-secondary col-sm-2" href="{{ route('vendor.products.index') }}">
                            <i class="fas fa-arrow-left"></i>
                            Back to Products
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="ts__dashboard_profile">
            <div class="ts__dash_pro_area">
                <div class="row">
                    <h4 class="text-primary">
                        <i class="far fa-image"></i>
                        Product Images
                    </h4>
                </div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Datatables js -->
    <script src="{{ asset('backend/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap4.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
