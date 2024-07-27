@extends('admin.layouts.master')

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <!-- Datatables css -->
    {{-- <link href="{{ asset('backend/css/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('backend/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap4.css">
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.footer-grid-three.change-title') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ @$title->footer_grid_three_title }}">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end mb-3">
                    <a class="btn btn-primary" href="{{ route('admin.footer-grid-three.create') }}">
                        <i class="uil-plus"></i>
                        {{ __('Create New') }}</a>
                </div>
            </div>
        </div>
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
                    url: "{{ route('admin.footer-grid-three.change-status') }}",
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
