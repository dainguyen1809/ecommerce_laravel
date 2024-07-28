<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <h1 class="text-center">Updating...</h1>
                {{-- <form action="{{ route('admin.paypal-settings.update', 1) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="example-multiselect">Paypal Status</label>
                        <select class="custom-select mb-3" name="status">
                            <option {{ @$paypalSetting->status == 1 ? 'selected' : '' }} value="1">Enable
                            </option>
                            <option {{ @$paypalSetting->status == 0 ? 'selected' : '' }} value="0">Disable
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="example-multiselect">Account Mode</label>
                        <select class="custom-select" name="mode">
                            <option {{ @$paypalSetting->mode == 0 ? 'selected' : '' }} value="0">Sandbox
                            </option>
                            <option {{ @$paypalSetting->mode == 1 ? 'selected' : '' }} value="1">Live</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Country Name</label>
                        <select class="form-control select2" name="country_name" data-toggle="select2">
                            <option>Select</option>
                            @foreach (config('settings.country_list') as $country)
                                <option {{ @$paypalSetting->country_name == $country ? 'selected' : '' }}
                                    value="{{ $country }}">{{ $country }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="example-multiselect">Currency Name</label>
                        <select class="form-control select2" name="currency_name" data-toggle="select2">
                            <option>Select</option>
                            @foreach (config('settings.currency_list') as $key => $currency)
                                <option {{ @$paypalSetting->currency_name == $currency ? 'selected' : '' }}
                                    value="{{ $currency }}">{{ $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Currency rate (USD)</label>
                        <input type="text" name="currency_rate" class="form-control"
                            value="{{ @$paypalSetting->currency_rate }}">
                    </div>
                    <div class="form-group">
                        <label>Client ID</label>
                        <input type="text" name="client_id" class="form-control"
                            value="{{ @$paypalSetting->client_id }}">
                    </div>
                    <div class="form-group">
                        <label>Paypal Secret Key</label>
                        <input type="text" name="secret_key" class="form-control"
                            value="{{ @$paypalSetting->secret_key }}">
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <button class="btn btn-primary col-sm-3">Submit</button>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
</div>
