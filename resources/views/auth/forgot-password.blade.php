@extends('frontend.layouts.master')

@section('content')
    <section id="ts__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>forget password</h4>
                        <ul>
                            <li><a href="{{ route('login') }}">login</a></li>
                            <li><a href="{{ route('password.request') }}">forget password</a></li>
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
                    <div class="ts__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>forgot password ?</h4>
                        <p>enter the email address to register with <span>e-shop</span></p>
                        <div class="ts__login">
                            <form method="post" action="{{ route('password.email') }}">
                                @csrf
                                <div class="ts__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        placeholder="Your Email">
                                </div>
                                <button class="common_btn" type="submit">send</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{ route('login') }}">go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
