@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.child-category.update', $childCategory->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="example-multiselect">Category</label>
            <select class="custom-select mb-3 main-category" name="category">
                <option value="">Select</option>
                @foreach ($categories as $category)
                    <option {{ $childCategory->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="example-multiselect">Sub Category</label>
            <select class="custom-select mb-3 sub-category" name="sub_category">
                <option value="">Select</option>
                @foreach ($subCategories as $subCategory)
                    <option {{ $childCategory->sub_category_id == $subCategory->id ? 'selected' : '' }}
                        value="{{ $subCategory->id }}">
                        {{ $subCategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $childCategory->name }}">
        </div>
        <div class="form-group">
            <label for="example-multiselect">Status</label>
            <select class="custom-select mb-3" name="status">
                <option {{ $childCategory->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                <option {{ $childCategory->status == 0 ? 'selected' : '' }} value="0">Disable</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary col-sm-2 mr-3">{{ __('Update') }}</button>
                <a href="{{ route('admin.child-category.index') }}" class="btn btn-secondary col-sm-2">
                    <i class="uil-arrow-left"></i>
                    {{ __('Back to dashboard') }}
                </a>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(event) {
                const id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.get-sub-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        $('.sub-category').html('<option value="select">Select</option>');
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
            })
        });
    </script>
@endpush
