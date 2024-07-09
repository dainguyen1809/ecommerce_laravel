@extends('vendor.layouts.master')

@push('styles')
    {{-- <link href="{{ asset('backend/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('content')
    <div class="row">
        <div class="wsus__dashboard_profile">
            <div class="wsus__dash_pro_area">
                <div class="text-end">
                    <div class="row mb-3">
                        <div class="text-end">
                            <a class="btn btn-primary" href="{{ route('vendor.products.create') }}">
                                <i class="fas fa-plus"></i>
                                Create New
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
    <script src="{{ asset('backend/js/vendor/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/vendor/dataTables.bootstrap4.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/js/vendor/dataTables.responsive.min.js') }}"></script> --}}
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                const checked = $(this).is(':checked');
                const id = $(this).data('id');

                $.ajax({
                    url: "{{ route('vendor.product.change-status') }}",
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
