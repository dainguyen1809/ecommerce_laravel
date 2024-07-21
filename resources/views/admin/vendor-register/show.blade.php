@extends('admin.layouts.master')

@push('styles')
    <link href="{{ asset('backend/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 text-center">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>{{ $vendor->id }}</td>
                                            </tr>
                                            <tr>
                                                <td>User Name</td>
                                                <td>{{ $vendor->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Shop Name</td>
                                                <td>{{ $vendor->shop_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $vendor->shop_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td>{{ $vendor->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>{{ $vendor->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{!! $vendor->description !!}</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="col-md-6">
                                    <form action="{{ route('admin.vendor-register.change-status', $vendor->id) }}"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <select name="status" class="form-control">
                                            <option {{ @$vendor->status == 0 ? 'selected' : '' }} value="0">Pending
                                            </option>
                                            <option {{ @$vendor->status == 1 ? 'selected' : '' }} value="1">Approved
                                            </option>
                                        </select>
                                        <div class="row mt-4">
                                            <div class="col-md-12 d-flex">
                                                <a href="{{ route('admin.vendor-register.index') }}"
                                                    class="btn btn-secondary mr-3">
                                                    <i class="uil-arrow-left"></i>
                                                    Back to Vendor Registers
                                                </a>
                                                <button type="submit" class="btn btn-primary w-25">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#order-status').on('change', function() {
                const status = $(this).val();
                const id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        id: id,
                        status: status,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        }
                    }
                });
            });

            $('#payment-status').on('change', function() {
                const status = $(this).val();
                const id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url: "{{ route('admin.order.payment-status') }}",
                    data: {
                        id: id,
                        status: status,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        }
                    }
                });
            });

            $('.invoice-print').on('click', function() {
                const print = $('.invoice-content');
                const originalContents = $('body').html();

                $('body').html(print.html());
                window.print();

                $('body').html(originalContents);
            });

        });
    </script>
@endpush
