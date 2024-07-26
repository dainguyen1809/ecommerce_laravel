@extends('frontend.layouts.master')

@section('content')
    <section id="ts__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Terms and Conditions</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ route('terms-and-conditions') }}">terms and conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h1 class="text-center">{!! @$term->content !!}</h1>
            </div>
        </div>
    </div>
@endsection
