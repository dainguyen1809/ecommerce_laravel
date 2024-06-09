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
    <div class="wsus__dashboard_profile">
        <div class="wsus__dash_pro_area">
            <div class="text-start">
                <h4 class="text-info">Product: {{ $product->name }}</h4>
            </div>
            <div class="text-end">
                <div class="row mb-3">
                    <div class="text-end">
                        <a class="btn btn-primary"
                            href="{{ route('vendor.products-variant.create', ['product' => $product->id]) }}">
                            <i class="fas fa-plus"></i>
                            Create New
                        </a>
                        <a class="btn btn-secondary" href="{{ route('vendor.products.index') }}">
                            <i class="fas fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
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
    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                const checked = $(this).is(':checked');
                const id = $(this).data('id');

                $.ajax({
                    url: "{{ route('vendor.products-variant.change-status') }}",
                    method: "PUT",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: checked,
                        id: id,
                    },
                    success: function(res) {
                        toastr.success(res.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                });

            })
        });
    </script>
@endpush
