@extends('frontend.dashboard.layouts.master')
@section('content')
    <div class="wsus__dashboard_add wsus__add_address">
        <form action="{{ route('user.address.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>name <b>*</b></label>
                        <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>email</label>
                        <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>phone <b>*</b></label>
                        <input type="text" placeholder="Phone" name="phone" value="{{ old('phone') }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>country <b>*</b></label>
                        <div class="wsus__topbar_select">
                            <select class="select_2" name="country">
                                <option>Select</option>
                                @foreach (config('settings.country_list') as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>State <b>*</b></label>
                        <input type="text" placeholder="State" name="state" value="{{ old('state') }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>City <b>*</b></label>
                        <input type="text" placeholder="City" name="city" value="{{ old('city') }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>zip code <b>*</b></label>
                        <input type="text" placeholder="Zip Code" name="zipcode" value="{{ old('zipcode') }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>address <b>*</b></label>
                        <input type="text" placeholder="Address" name="address" value="{{ old('address') }}" />
                    </div>
                </div>
                <div class="col-xl-6 d-flex">
                    <div class="col-xl-3">
                        <button type="submit" class="common_btn">Create</button>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('user.address.index') }}" class="common_btn">
                            <i class="fas fa-arrow-left"></i>
                            Back to home
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
