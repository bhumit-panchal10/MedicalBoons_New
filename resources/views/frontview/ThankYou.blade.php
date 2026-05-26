@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="thank row">
            <div class="thank-img col-lg-5 align-items-center">
                <img class="img-fluid" src="{{ asset('assets/images/thankyouimg.png') }}">
            </div>
            <div class="thank-info col-lg-7  align-items-center pt-5">

                <h3 style="margin-bottom: 30px; padding-top:5%">
                    Thank you for reaching out to us!
                </h3>
                <h3 style="">
                    Our healthcare team will review your request and connect with you shortly to assist you further.
                </h3>

            </div>
        </div>
    </div>
@endsection
