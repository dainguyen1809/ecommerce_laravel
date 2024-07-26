@extends('frontend.layouts.master')

@section('content')
    <section id="ts__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>login / register</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ route('login') }}">login / register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ts__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="ts__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                    aria-selected="true">login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">register</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                <div class="ts__login">
                                    <form method="post" action="{{ route('login') }}">
                                        @csrf
                                        <div class="ts__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="email" id="email" value="{{ old('email') }}" name="email"
                                                placeholder="Email address">
                                        </div>
                                        <div class="ts__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="ts__login_save">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember_me">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Remember
                                                    me</label>
                                            </div>
                                            <a class="forget_p" href="{{ route('password.request') }}">forget password ?</a>
                                        </div>
                                        <button class="common_btn" type="submit">login</button>
                                        <p class="social_text">Sign in with social account</p>
                                        <ul class="ts__login_link">
                                            <li><a href="#"><i class="fab fa-google"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                aria-labelledby="pills-profile-tab2">
                                <div class="ts__login">
                                    <form method="post" action="{{ route('register') }}">
                                        @csrf
                                        <div class="ts__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                placeholder="Name">
                                        </div>
                                        <div class="ts__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="text" name="username" id="name"
                                                value="{{ old('username') }}" placeholder="Username">
                                        </div>
                                        <div class="ts__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input type="email" name="email" id="email"
                                                value="{{ old('email') }}" placeholder="Email">
                                        </div>
                                        <div class="ts__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password" name="password"
                                                placeholder="Password">
                                        </div>
                                        <div class="ts__login_input mb-5">
                                            <i class="fas fa-key"></i>
                                            <input id="password_confirmation" type="password"
                                                name="password_confirmation">
                                        </div>
                                        <button class="common_btn" type="submit">signup</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
