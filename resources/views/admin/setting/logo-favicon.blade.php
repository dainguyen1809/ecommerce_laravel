<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <form action="{{ route('admin.logo-setting-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @if (isset($logoSetting->logo))
                        <img src="{{ asset($logoSetting->logo) }}" height="150" alt="logo">
                    @endif
                    <div class="form-group">
                        <label for="upload_logo" class="btn btn-info px-3">Upload Logo</label>
                        <input type="file" name="logo" id="upload_logo" class="form-control" hidden />
                        <input type="hidden" name="old_logo" class="form-control" value="{{ @$logoSetting->logo }}" />
                    </div>

                    <div class="form-group">
                        <label for="favicon" class="btn btn-info px-3">Favicon</label>
                        <input type="file" name="favicon" id="favicon" class="form-control" hidden />
                        <input type="hidden" name="old_favicon" class="form-control"
                            value="{{ @$logoSetting->favicon }}" />
                    </div>
                    @if (isset($logoSetting->favicon))
                        <img src="{{ asset($logoSetting->favicon) }}" height="150" alt="favicon">
                    @endif

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
