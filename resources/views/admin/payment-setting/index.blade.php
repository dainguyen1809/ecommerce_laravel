@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-3 mb-2 mb-sm-0">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Paypal Settings</span>
                </a>
                <a class="nav-link" id="v-pills-stripe-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                    aria-controls="v-pills-stripe" aria-selected="false">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Stripe</span>
                </a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                    aria-controls="v-pills-settings" aria-selected="false">
                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">COD</span>
                </a>
            </div>
        </div> <!-- end col-->

        <div class="col-sm-9">
            <div class="tab-content" id="v-pills-tabContent">
                @include('admin.payment-setting.sections.paypal-setting')
                @include('admin.payment-setting.sections.stripe-setting')
                @include('admin.payment-setting.sections.cod-setting')
            </div> <!-- end tab-content-->
        </div> <!-- end col-->
    </div>
@endsection
