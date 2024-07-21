@extends('admin.layouts.master')

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <!-- Datatables css -->
    {{-- <link href="{{ asset('backend/css/vendor/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('backend/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap4.css">

    <style>
        img.avt_user {
            border: 2px solid #3ca0ff;
            border-radius: 50%;
            width: 100px;
            height: 100px
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
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
                console.log(id);

                $.ajax({
                    url: "{{ route('admin.customer.change-status') }}",
                    method: "PUT",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: checked,
                        id: id,
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(response) {
                        console.log(response);
                    },
                });

            })
        });
    </script>
@endpush
