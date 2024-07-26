@extends('frontend.layouts.master')

@section('content')
    <section id="ts__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>contact us</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ route('contact') }}">contact us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ts__contact">
        <div class="container">
            <div class="ts__contact_area">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="ts__contact_single">
                                    <i class="fal fa-envelope"></i>
                                    <h5>mail address</h5>
                                    <a href="mailto:{{ $settings->contact_email }}">
                                        {{ $settings->contact_email }}
                                    </a>
                                    <span><i class="fal fa-envelope"></i></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="ts__contact_single">
                                    <i class="far fa-phone-alt"></i>
                                    <h5>phone number</h5>
                                    <a href="macallto:{{ $settings->contact_phone }}">
                                        {{ $settings->contact_phone }}
                                    </a>
                                    <span><i class="far fa-phone-alt"></i></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="ts__contact_single">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <h5>contact address</h5>
                                    <p>
                                        {{ $settings->contact_address }}
                                    </p>
                                    <span><i class="fal fa-map-marker-alt"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="ts__contact_question">
                            <h5>Send Us a Message</h5>
                            <form id="contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="ts__con_form_single">
                                            <input type="text" placeholder="Your Name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="ts__con_form_single">
                                            <input type="email" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="ts__con_form_single">
                                            <input type="text" placeholder="Subject" name="subject">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="ts__con_form_single">
                                            <textarea cols="3" rows="5" placeholder="Message" name="message"></textarea>
                                        </div>
                                        <button type="submit" class="common_btn send_msg">send now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="ts__con_map">
                            {!! $settings->map !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#contact-form').on('submit', function(e) {
                e.preventDefault();
                const data = $(this).serialize();

                function resetBtn() {
                    setTimeout(() => {
                        $('.send_msg').text('Send Now');
                        $('.send_msg').attr('disabled', false);
                    }, 1500);
                }

                $.ajax({
                    method: "post",
                    url: "{{ route('contact-form') }}",
                    data: data,
                    beforeSend() {
                        $('.send_msg').html('<i class="fas fa-circle-notch fa-spin"></i>');
                        $('.send_msg').attr('disabled', true);
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('.send_msg').html('<i class="fas fa-check fa-fade"></i>');
                            toastr.success(response.message);
                            resetBtn();
                        } else if (response.status === 'error') {
                            setTimeout(() => {
                                $('.send_msg').text('Send Now');
                            }, 1500);
                            toastr.error(response.message);
                            resetBtn();
                        }
                    },
                    error: function(response) {
                        const err = response.responseJSON.errors;
                        $.each(err, function(ket, value) {
                            toastr.error(value);
                        });
                        resetBtn();
                    },
                });
            });
        });
    </script>
@endpush
