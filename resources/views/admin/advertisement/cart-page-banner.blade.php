<div class="tab-pane fade" id="v-pills-cart" role="tabpanel" aria-labelledby="v-pills-cart-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <form action="{{ route('admin.advertisement.cart-banner') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <h4 class="text-info">Banner One</h4>
                        <div class="col-md-12">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cart_banner_one" class="btn btn-success w-100">Choose Image</label>
                                        <input type="file" name="banner_one_img" class="file-input"
                                            id="cart_banner_one" hidden>
                                        <input type="hidden" name="cart_banner_one_old_img" class="file-input"
                                            value="{{ @$cartBanner->banner_one->banner_img }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" id="switch_cart_one" data-switch="bool"
                                            name="banner_one_status"
                                            {{ @$cartBanner->banner_one->status == 1 ? 'checked' : '' }} />
                                        <label for="switch_cart_one" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Banner Url</label>
                                <input type="text" name="banner_one_url" class="form-control"
                                    value="{{ @$cartBanner->banner_one->banner_url }}">
                            </div>
                        </div>
                    </div>
                    <hr class="border">
                    <div class="row">
                        <h4 class="text-info">Banner Two</h4>
                        <div class="col-md-12">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cart_banner_two" class="btn btn-success w-100">Choose Image</label>
                                        <input type="file" name="banner_two_img" class="file-input"
                                            id="cart_banner_two" hidden>
                                        <input type="hidden" name="cart_banner_two_old_img" class="file-input"
                                            value="{{ @$cartBanner->banner_two->banner_img }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" id="switch_cart_two" data-switch="bool"
                                            name="banner_two_status"
                                            {{ @$cartBanner->banner_two->status == 1 ? 'checked' : '' }} />
                                        <label for="switch_cart_two" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Banner Url</label>
                                <input type="text" name="banner_two_url" class="form-control"
                                    value="{{ @$cartBanner->banner_two->banner_url }}">
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <button class="btn btn-primary col-sm-3">Submit</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center">
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <p>Preview Banner One</p>
                                            <img src="{{ asset(@$cartBanner->banner_one->banner_img) }}" class="w-50"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <p>Preview Banner Two</p>
                                            <img src="{{ asset(@$cartBanner->banner_two->banner_img) }}" class="w-50"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
