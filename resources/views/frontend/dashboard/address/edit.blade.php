@extends('frontend.dashboard.layouts.master')
@section('content')
    <div class="ts__dashboard_add ts__add_address">
        <form action="{{ route('user.address.update', $address->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="ts__add_address_single">
                        <label>name <b>*</b></label>
                        <input type="text" placeholder="Name" name="name" value="{{ $address->name }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="ts__add_address_single">
                        <label>email</label>
                        <input type="email" placeholder="Email" name="email" value="{{ $address->email }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="ts__add_address_single">
                        <label>phone <b>*</b></label>
                        <input type="text" placeholder="Phone" name="phone" value="{{ $address->phone }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="ts__add_address_single">
                        <label>country <b>*</b></label>
                        <div class="ts__topbar_select">
                            <select class="select_2" name="country">
                                <option>Select</option>
                                @foreach (config('settings.country_list') as $country)
                                    <option {{ $address->country == $country ? 'selected' : '' }}
                                        value="{{ $country }}">
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="ts__add_address_single">
                        <label>State <b>*</b></label>
                        <input type="text" placeholder="State" name="state" value="{{ $address->state }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="ts__add_address_single">
                        <label>City <b>*</b></label>
                        <input type="text" placeholder="City" name="city" value="{{ $address->city }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="ts__add_address_single">
                        <label>zip code <b>*</b></label>
                        <input type="text" placeholder="Zip Code" name="zipcode" value="{{ $address->zipcode }}" />
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="ts__add_address_single">
                        <label>address <b>*</b></label>
                        <input type="text" placeholder="Address" name="address" value="{{ $address->address }}" />
                    </div>
                </div>
                <div class="col-xl-6">
                    <button type="submit" class="common_btn">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
