@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="row">
        <h3><i class="far fa-user"></i> profile</h3>
        <div class="wsus__dashboard_profile">
            <div class="wsus__dash_pro_area">
                <h4 class="text-info">Hi! {{ Auth::user()->name }}</h4>
                <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="text" name="name" placeholder="Name"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="text" name="username" placeholder="Username"
                                            value="{{ Auth::user()->username }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="wsus__dash_pro_single">
                                        <i class="far fa-phone-alt"></i>
                                        <input type="text" name="phone" placeholder="Phone"
                                            value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="wsus__dash_pro_single">
                                        <i class="fal fa-envelope-open"></i>
                                        <input type="email" name="email" placeholder="Email"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-md-6">
                            <div class="wsus__dash_pro_img">
                                <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('images/users/image.png') }}"
                                    class="img-fluid w-100" alt="img">
                                <input type="file" name="avatar">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <button class="common_btn mb-4 mt-2" type="submit">upload</button>
                        </div>
                </form>

                <form action="{{ route('user.profile.update.password') }}" method="post">
                    @csrf
                    <div class="wsus__dash_pass_change mt-2">
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-unlock-alt"></i>
                                    <input type="password" placeholder="Current Password" name="current_password">
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-lock-alt"></i>
                                    <input type="password" placeholder="New Password" name="password">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-lock-alt"></i>
                                    <input type="password" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <button class="common_btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
