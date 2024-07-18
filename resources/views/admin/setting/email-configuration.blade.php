<div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="card border">
        <div class="row m-2">
            <div class="col-12">
                <form action="{{ route('admin.email-setting-update') }}" method="post">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{@ $emailConfiguration->email}}"/>
                    </div>

                    <div class="form-group">
                        <label>Mail Host</label>
                        <input type="text" name="host" class="form-control" value="{{@ $emailConfiguration->host}}"/>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SMTP Username</label>
                                <input type="text" name="username" class="form-control"
                                       value="{{@$emailConfiguration->username}}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SMTP Password</label>
                                <input type="text" name="password" class="form-control"
                                       value="{{@ $emailConfiguration->password}}" placeholder="********"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mail Port</label>
                                <input type="text" name="port" class="form-control"
                                       value="{{@$emailConfiguration->port}}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mail Encryption</label>
                                <select class="form-control select2" name="encryption" data-toggle="select2"
                                        name="timezone">
                                    <option
                                        {{@$emailConfiguration->encryption === 'tls' ? 'selected' : ''}} value="tls">
                                        TLS
                                    </option>
                                    <option
                                        {{@$emailConfiguration->encryption === 'ssl' ? 'selected' : ''}} value="ssl">
                                        SSL
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" row mb-3
                                    ">
                        <div class="col-12">
                            <button class="btn btn-primary col-sm-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
