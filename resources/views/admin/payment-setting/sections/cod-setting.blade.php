<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <form action="{{ route('admin.cod-setting', 1) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="example-multiselect">COD Status</label>
                        <select class="custom-select mb-3" name="status">
                            <option {{ @$codSetting->status == 1 ? 'selected' : '' }} value="1">Enable
                            </option>
                            <option {{ @$codSetting->status == 0 ? 'selected' : '' }} value="0">Disable
                            </option>
                        </select>
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
