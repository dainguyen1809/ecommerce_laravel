<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Hyper - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App css -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('backend/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />

</head>

<body class="authentication-bg" data-layout-config='{"darkMode":false}'>

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary"></div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
                                <p class="text-muted mb-4">Enter your email address and password to access admin panel.
                                </p>
                            </div>

                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="emailaddress">{{ __('Email') }}</label>
                                    <input class="form-control" type="email" id="email"
                                        value="{{ old('email') }}" name="email" placeholder="Enter your email"
                                        required>

                                    @if ($errors->has('email'))
                                        <code class="text-danger">{{ $errors->first('email') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <a href="#" class="text-muted float-right"><small>Forgot your
                                            password?</small></a>
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control"
                                            placeholder="Enter your password" name="password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('password'))
                                            <code class="text-danger">{{ $errors->first('password') }}</code>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin"
                                            checked>
                                        <label class="custom-control-label"
                                            for="checkbox-signin">{{ __('Remember me') }}</label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        {{ date('Y') }}
    </footer>

    <!-- bundle -->
    <script src="{{ asset('backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('backend/js/app.min.js') }}"></script>

</body>

</html>
