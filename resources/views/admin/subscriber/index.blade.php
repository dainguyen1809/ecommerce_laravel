@extends('admin.layouts.master')

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <!-- Datatables css -->
    {{-- <link href="{{ asset('backend/css/vendor/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('backend/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap4.css">
    <link href="{{ asset('backend/css/summernote-bs4.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12 mb-3">
                    <h4 class="text-info mb-3">Send Email to all subscribers</h4>
                    <form action="{{route('admin.subscriber.sendEmail')}}">
                        <div class="form-group">
                            <label for="example-textarea">Subject</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="example-textarea">Message</label>
                            <textarea id="summernote-basic" name="message"></textarea>
                        </div>
                        <button class="btn btn-primary px-4">Send</button>
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
    <script src="{{ asset('backend/js/vendor/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/js/pages/demo.summernote.js') }}"></script>
@endpush
