@php
    $sliderSection = json_decode($sliderSectionTwo->value);
@endphp

<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <form action="{{ route('admin.product-slider-section-two') }}" method="post">
                    @csrf
                    @method('put')
                    <h4>Category 2</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <select class="custom-select main-category mb-3" name="cat_one">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $sliderSection->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                @php
                                    $subCategories = \App\Models\SubCategory::where(
                                        'category_id',
                                        $sliderSection->category,
                                    )->get();
                                @endphp
                                <select class="custom-select sub-category mb-3" name="sub_cat_one">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option {{ $subCategory->id == $sliderSection->sub_category ? 'selected' : '' }}
                                            value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                @php
                                    $childCategories = \App\Models\ChildCategory::where(
                                        'sub_category_id',
                                        $sliderSection->sub_category,
                                    )->get();
                                @endphp
                                <select class="custom-select child-category mb-3" name="child_cat_one">
                                    <option value="">Select</option>
                                    @foreach ($childCategories as $childCategory)
                                        <option
                                            {{ $childCategory->id == $sliderSection->child_category ? 'selected' : '' }}
                                            value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <button class="btn btn-primary col-sm-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(event) {
                const id = $(this).val();
                const row = $(this).closest('.row');
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.get-sub-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        const selector = row.find('.sub-category');
                        selector.html('<option value="">Select</option>');
                        $.each(res, function(index, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            })

            // child categories
            $('body').on('change', '.sub-category', function(event) {
                let id = $(this).val();
                const row = $(this).closest('.row');
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.product.get-child-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        const selector = row.find('.child-category');
                        selector.html('<option value="">Select</option>');
                        $.each(data, function(i, item) {
                            selector.append(
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
