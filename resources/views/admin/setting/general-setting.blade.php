<div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <form action="{{ route('admin.general-setting-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" name="site_name" class="form-control"
                            value="{{ @$generalSetting->site_name }}">
                    </div>
                    <div class="form-group">
                        <label for="example-multiselect">Layouts</label>
                        <select class="custom-select mb-3" name="layouts">
                            <option {{ @$generalSetting->layouts == 'LTR' ? 'selected' : '' }} value="LTR">
                                LTR
                            </option>
                            <option {{ @$generalSetting->layouts == 'RTL' ? 'selected' : '' }} value="RTL">
                                RTL
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="text" name="contact_email" class="form-control"
                            value="{{ @$generalSetting->contact_email }}">
                    </div>
                    <div class="form-group">
                        <label>Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control"
                            value="{{ @$generalSetting->contact_phone }}">
                    </div>
                    <div class="form-group">
                        <label>Contact Address</label>
                        <input type="text" name="contact_address" class="form-control"
                            value="{{ @$generalSetting->contact_address }}">
                    </div>
                    <div class="form-group">
                        <label>URL Google Map
                            <code>
                                (Open Google Map -> Click to share -> Embed a map -> Copy HTML)
                            </code>
                        </label>
                        <input type="text" name="map" class="form-control" value="{{ @$generalSetting->map }}">
                    </div>
                    <div class="form-group">
                        <label for="example-multiselect">Default Currency Name</label>
                        <select class="form-control select2" name="currency_name" data-toggle="select2">
                            <option>Select</option>
                            @foreach (config('settings.currency_list') as $currency)
                                <option {{ @$generalSetting->currency_name == $currency ? 'selected' : '' }}
                                    value="{{ @$currency }}">{{ @$currency }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Currency Icon</label>
                        <input type="text" name="currency_icon" class="form-control"
                            value="{{ @$generalSetting->currency_icon }}">
                    </div>
                    <div class="form-group">
                        <label for="example-multiselect">Default Currency Name</label>
                        <select class="form-control select2" data-toggle="select2" name="timezone">
                            <option>Select</option>
                            @foreach (config('settings.timezones') as $key => $timezone)
                                <option {{ @$generalSetting->timezone == $key ? 'selected' : '' }}
                                    value="{{ @$key }}">{{ @$key }}</option>
                            @endforeach
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
