@extends('frontend.dashboard.layouts.master')
@section('content')
    <div class="dashboard_content">
        <h3><i class="fal fa-gift-card"></i> address</h3>
        <div class="wsus__dashboard_add">
            <div class="row">
                @foreach ($userAddress as $address)
                    <div class="col-xl-6">
                        <div class="wsus__dash_add_single">
                            <h4>Billing Address <span>office</span></h4>
                            <ul>
                                <li><span>name :</span> {{ $address->name }}</li>
                                <li><span>Phone :</span> {{ $address->phone }}</li>
                                <li><span>email :</span> {{ $address->email }}</li>
                                <li><span>country :</span> {{ $address->country }}</li>
                                <li><span>state :</span> {{ $address->state }}</li>
                                <li><span>city :</span> {{ $address->city }}</li>
                                <li><span>zip code :</span> {{ $address->zipcode }}</li>
                                <li><span>address :</span> {{ $address->address }}</li>
                            </ul>
                            <div class="wsus__address_btn">
                                <div class="col-12 d-flex align-items-center">
                                    <div class="col-sm-6">
                                        <a href="{{ route('user.address.edit', $address->id) }}" class="edit">
                                            <i class="fal fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 ms-2">
                                        <a href="{{ route('user.address.destroy', $address->id) }}" class="del delete-item">
                                            <i class="fal fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12">
                    <a href="{{ route('user.address.create') }}" class="add_address_btn common_btn"><i
                            class="far fa-plus"></i>
                        add new address</a>
                </div>
            </div>
        </div>
    </div>
@endsection
