@extends('layouts.front')
@section('content')
    <section class="py-2 bg-light AccesibleServiceBody" id="partner-with-us">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">
                <span class="text-1">Partner</span>
                <span class="text-2">With Us</span>
            </h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <form action="{{ route('Front.Partner_sendmail') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required
                                placeholder="Enter your name" value="{{ old('name') }}" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control" required id="email" name="email"
                                placeholder="Enter your email" value="{{ old('email') }}" />
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number <span
                                    class="text-danger">*</span></label>
                            <input type="tel" class="form-control" required id="mobile" name="mobile" maxlength="10"
                                placeholder="Enter your number" value="{{ old('mobile') }}" />
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                            <select class="form-select" id="subject" name="subject" required>
                                <option selected value="1">
                                    Lab Partnership
                                </option>
                                <option value="2">
                                    Corporate Collaboration
                                </option>
                                <option value="3">Pharmacy Collation</option>
                                <option value="4">
                                    Investment Opportunities
                                </option>
                                <option value="5">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Type your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success text-white rounded-pill px-4 py-2">
                            Send Message
                        </button>
                    </form>
                </div>

                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/images/Front/contactUs.jpg') }}" alt="Partner With Us Illustration"
                        class="img-fluid rounded-3 contact-img" />
                    <div class="mt-4">
                        <h5 class="mb-2">Follow us on</h5>
                        <div class="d-flex justify-content-center gap-4">
                            <a href="#" class="text-dark"><img src="{{ 'assets/images/Front/facebook.png' }}"
                                    alt="Facebook" class="social" /></a>
                            <a href="#" class="text-dark"><img src="{{ 'assets/images/Front/instagram.png' }}"
                                    alt="Instagram" class="social" /></a>
                            <a href="#" class="text-dark"><img src="{{ 'assets/images/Front/twitter.png' }}"
                                    alt="Twitter" class="social" /></a>
                            <a href="#" class="text-dark"><img src="{{ 'assets/images/Front/linkeidn.png' }}"
                                    alt="Linkeidn" class="social" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
