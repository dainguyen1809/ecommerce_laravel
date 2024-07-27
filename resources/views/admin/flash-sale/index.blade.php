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
            <div class="row mb-3">
                <div class="col-12">
                    <form action="{{ route('admin.flash-sale.update') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Sale end date</label>
                            <input class="form-control" id="" type="date" name="end_date"
                                value="{{ @$flashSale->end_date }}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary col-sm-3">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.flash-sale.add-product') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Add flash sale product</label>
                            <select class="form-control select2" data-toggle="select2" name="product">
                                <option>Select</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Show at home?</label>
                                        <select class="form-control" name="show_at_home">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select</option>
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary col-sm-3">Save</button>
                            </div>
                        </div>
                    </form>
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
            // show at home
            $('body').on('click', '.show_at_home', function() {
                const checked = $(this).is(':checked');
                const id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.flash-sale.show-at-home.change-status') }}",
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
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                });
            })

            $('body').on('click', '.change-status', function() {
                const checked = $(this).is(':checked');
                const id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.flash-sale.change-status') }}",
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
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                });
            })
        });
    </script>
@endpush
