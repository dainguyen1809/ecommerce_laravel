<div class="tab-pane fade" id="v-pills-four" role="tabpanel" aria-labelledby="v-pills-four-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <form action="{{ route('admin.advertisement.banner-four') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row d-flex align-items-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="banner_four" class="btn btn-success w-100">Choose Image</label>
                                <input type="file" name="banner_img" class="file-input" id="banner_four" hidden>
                                <input type="hidden" name="banner_old_img" class="file-input" id="banner_four"
                                    value="{{ @$bannerFour->banner_one->banner_img }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="checkbox" id="switch7" data-switch="bool" name="status"
                                    {{ @$bannerFour->banner_one->status == 1 ? 'checked' : '' }} />
                                <label for="switch7" data-on-label="On" data-off-label="Off"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Banner Url</label>
                        <input type="text" name="banner_url" class="form-control"
                            value="{{ @$bannerFour->banner_one->banner_url }}">
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <button class="btn btn-primary col-sm-3">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <p>Preview Banner</p>
                            <img src="{{ asset(@$bannerFour->banner_one->banner_img) }}" class="w-50" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
