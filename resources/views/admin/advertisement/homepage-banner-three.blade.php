<div class="tab-pane fade" id="v-pills-three" role="tabpanel" aria-labelledby="v-pills-three-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <form action="{{ route('admin.advertisement.banner-three') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-info">Banner One</h4>
                            <div class="row d-flex align-items-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="file_upload_one" class="btn btn-success w-100">Choose Image</label>
                                        <input type="file" class="form-control" name="banner_one_img"
                                            id="file_upload_one" hidden>
                                        <input type="hidden" class="form-control" name="banner_one_old_img"
                                            value="{{ @$bannerThree->banner_one->banner_img }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" id="switch4" data-switch="bool"
                                            name="banner_one_status"
                                            {{ @$bannerThree->banner_one->status == 1 ? 'checked' : '' }} />
                                        <label for="switch4" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Banner Url</label>
                                <input type="text" name="banner_one_url" class="form-control"
                                    value="{{ @$bannerThree->banner_one->banner_url }}">
                            </div>
                        </div>
                    </div>
                    <hr class="border">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-info">Banner Two</h4>
                            <div class="row d-flex align-items-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="file_upload_two" class="btn btn-success w-100">Choose Image</label>
                                        <input type="file" class="form-control" name="banner_two_img"
                                            id="file_upload_two" hidden>
                                        <input type="hidden" class="form-control" name="banner_two_old_img"
                                            value="{{ @$bannerThree->banner_two->banner_img }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" id="switch5" data-switch="bool"
                                            name="banner_two_status"
                                            {{ @$bannerThree->banner_two->status == 1 ? 'checked' : '' }} />
                                        <label for="switch5" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Banner Url</label>
                                <input type="text" name="banner_two_url" class="form-control"
                                    value="{{ @$bannerThree->banner_two->banner_url }}">
                            </div>
                        </div>
                    </div>
                    <hr class="border">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-info">Banner Three</h4>
                            <div class="row d-flex align-items-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="file_upload_three" class="btn btn-success w-100">Choose
                                            Image</label>
                                        <input type="file" class="form-control" name="banner_three_img"
                                            id="file_upload_three" hidden>
                                        <input type="hidden" class="form-control" name="banner_three_old_img"
                                            value="{{ @$bannerThree->banner_three->banner_img }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" id="switch6" data-switch="bool"
                                            name="banner_three_status"
                                            {{ @$bannerThree->banner_three->status == 1 ? 'checked' : '' }} />
                                        <label for="switch6" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Banner Url</label>
                                <input type="text" name="banner_three_url" class="form-control"
                                    value="{{ @$bannerThree->banner_three->banner_url }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

                <div class="row">
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="col-md-4">
                            <div class="text-center">
                                <p>Preview Banner One</p>
                                <img src="{{ asset(@$bannerThree->banner_one->banner_img) }}" class="w-50"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <p>Preview Banner Two</p>
                                <img src="{{ asset(@$bannerThree->banner_two->banner_img) }}" class="w-50"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <p>Preview Banner Three</p>
                                <img src="{{ asset(@$bannerThree->banner_three->banner_img) }}" class="w-50"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
