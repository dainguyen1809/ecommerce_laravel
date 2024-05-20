@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="tab-pane" id="settings">
            <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Profile </h5>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="col-sm-2">
                                <img src="{{ asset(Auth::user()->avatar) }}" style="height: 150px;" alt=""
                                    class="rounded-circle img-thumbnail">
                            </div>
                            <div class="col-sm-10">
                                <label for="example-fileinput">Upload Avatar</label>
                                <input type="file" id="example-fileinput" name="avatar" class="form-control-file">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ Auth::user()->name }}" placeholder="Enter your name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ Auth::user()->email }}" placeholder="Enter your email">
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    <div class="mb-3">

                    </div>

                    <form action="{{ route('admin.password.update') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Current Password</label>
                                    <input type="password" class="form-control" id="pasword" name="current_password"
                                        placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lastname">New Password</label>
                                    <input type="password" class="form-control" id="email" name="password"
                                        placeholder="Enter your new password">
                                </div>
                            </div> <!-- end col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lastname">Comfirm Password</label>
                                    <input type="password" class="form-control" id="password" name="password_confirmation"
                                        placeholder="Confirm password">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-primary">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
