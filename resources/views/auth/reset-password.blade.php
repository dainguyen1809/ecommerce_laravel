@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>change password</h4>
                        <ul>
                            <li><a href="#">login</a></li>
                            <li><a href="#">change password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="post" action="{{ route('password.store') }}">
                        @csrf
                        <div class="wsus__change_password">
                            <h4>change password</h4>
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="wsus__single_pass">
                                <label>Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $request->email) }}" placeholder="Email address">
                            </div>
                            <div class="wsus__single_pass">
                                <label>Password</label>
                                <input type="password" id="password" name="password" placeholder="New Password">
                            </div>
                            <div class="wsus__single_pass">
                                <label>Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    placeholder="Confirm Password">
                            </div>
                            <button class="common_btn" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
