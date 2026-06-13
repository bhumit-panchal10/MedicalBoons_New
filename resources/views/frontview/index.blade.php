@extends('layouts.front')

@section('content')
    <!-- Hero Section - Exact from PDF -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left animate">
                    <div class="trusted-badge">
                        <i class="fas fa-shield-check"></i>
                        <span>Trusted by thousands of families</span>
                    </div>
                    <h1 class="hero-title">Healthcare Guidance<br />
                        <span class="green">Beyond Appointments</span>
                    </h1>
                    <p class="hero-text">
                        Medical Boons connects you to the right doctors, diagnostics, treatments, homecare, insurance
                        support and more – through one trusted ecosystem. From symptoms to settlement, we are with you
                        at every step.

                    </p>
                    <div class="hero-features">
                        <div class="feature-box">
                            <i class="fas fa-user-md"></i>
                            <span>Expert Guidance</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Affordable Care</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-headset"></i>
                            <span>Coordinated Support</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-universal-access"></i>
                            <span>Always Accessible</span>
                        </div>
                    </div>
                    <div class="hero-buttons">
                        <a class="btn-primary" href="tel:+919974660451">
                            <i class="fas fa-phone"></i>
                            Talk to Us
                        </a>
                        <a class="btn-secondary" href="https://wa.me/919974660451" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp Us
                        </a>
                        <a class="btn-secondary" href="{{ route('Front.Service') }}">Explore Services

                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="hero-right animate">
                    <div class="hero-image-wrapper">
                        <img alt="Happy Family" class="hero-image" src="{{ asset('Front/images/home-hero-family.jpg') }}" />
                        <div class="floating-icons">
                            <div class="float-icon icon-1">
                                <i class="fas fa-user-md"></i>
                                <span>Doctor Consultation</span>
                            </div>
                            <div class="float-icon icon-2">
                                <i class="fas fa-flask"></i>
                                <span>Lab Testing</span>
                            </div>
                            <div class="float-icon icon-3">
                                <i class="fas fa-x-ray"></i>
                                <span>Radiology/Scan</span>
                            </div>
                            <div class="float-icon icon-4">
                                <i class="fas fa-hospital"></i>
                                <span>IPD Support</span>
                            </div>
                            <div class="float-icon icon-5">
                                <i class="fas fa-home"></i>
                                <span>Homecare</span>
                            </div>
                            <div class="float-icon icon-6">
                                <i class="fas fa-shield-alt"></i>
                                <span>Insurance Support</span>
                            </div>
                            <div class="float-icon icon-7">
                                <i class="fas fa-spa"></i>
                                <span>Wellness &amp; Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partners Section - Exact from PDF -->
    <section class="partners-section">
        <div class="container">
            <p class="partners-title">OUR TRUSTED HEALTHCARE NETWORK</p>

            <div class="partners-logos">
                @foreach ($Ourclients as $Ourclient)
                    <img alt="Client" src="{{ asset('/upload/OurClient-images/' . $Ourclient->image) }}" />
                @endforeach
            </div>
            <div class="view-all" style="float:right;">
                <a href="#partners">View All Partners
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- Stats Section - Exact from PDF -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-box animate">
                    <i class="fas fa-users"></i>
                    <div class="stat-number">15000+</div>
                    <div class="stat-label">Patients Supported</div>
                </div>
                <div class="stat-box animate">
                    <i class="fas fa-hospital"></i>
                    <div class="stat-number">100</div>
                    <div class="stat-label">Healthcare Partners</div>
                </div>
                <div class="stat-box animate">
                    <i class="fas fa-award"></i>
                    <div class="stat-number">8</div>
                    <div class="stat-label">Years of Trust</div>
                </div>
                <div class="stat-box animate">
                    <i class="fas fa-clock"></i>
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Assistance Available </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="section-header animate">
                <p class="section-subtitle">OUR HEALTHCARE SERVICES</p>
                <h2 class="section-title">Complete Healthcare Solutions Under One Roof</h2>
            </div>

            <div class="services-grid-plain">
                <!-- Service 1 - Doctor Consultation -->
                @php
                    $i = 1;
                @endphp
                @foreach ($Services as $service)
                    <div class="service-item-plain animate" data-delay="0">
                        <div class="service-icon-plain {{ $service->color }}">
                            {!! $service->icon !!}
                        </div>
                        <h3 class="service-title-plain">{{ $i++ }}. {{ $service->name ?? '' }}</h3>
                        <p class="service-desc-plain">
                            {{ $service->description ?? '' }}
                        </p>
                        {{-- <a href="#" class="service-link-plain">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a> --}}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <div class="section-header animate">
                <p class="section-subtitle">HOW MEDICAL BOONS WORKS</p>
                <h2 class="section-title">Simple Steps. Complete Support.</h2>
            </div>

            <div class="steps-horizontal">
                <!-- Step 1 -->
                <div class="step-item-horizontal animate" data-delay="0">

                    <div class="step-icon-horizontal">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="step-title-horizontal">Connect With Us</h3>
                    <p class="step-desc-horizontal">Reach out to us via call, WhatsApp or CAREEZ App.</p>
                </div>

                <!-- Dotted Line -->
                <div class="step-connector"></div>

                <!-- Step 2 -->
                <div class="step-item-horizontal animate" data-delay="100">

                    <div class="step-icon-horizontal">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="step-title-horizontal">Share Your Concern</h3>
                    <p class="step-desc-horizontal">Tell us your health concern or requirement.</p>
                </div>

                <!-- Dotted Line -->
                <div class="step-connector"></div>

                <!-- Step 3 -->
                <div class="step-item-horizontal animate" data-delay="200">

                    <div class="step-icon-horizontal">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3 class="step-title-horizontal">Get Guided</h3>
                    <p class="step-desc-horizontal">Our experts guide you to the right service & partner.</p>
                </div>

                <!-- Dotted Line -->
                <div class="step-connector"></div>

                <!-- Step 4 -->
                <div class="step-item-horizontal animate" data-delay="300">

                    <div class="step-icon-horizontal">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="step-title-horizontal">Receive Support</h3>
                    <p class="step-desc-horizontal">We coordinate and help you access the best care.</p>
                </div>

                <!-- Dotted Line -->
                <div class="step-connector"></div>

                <!-- Step 5 -->
                <div class="step-item-horizontal animate" data-delay="400">

                    <div class="step-icon-horizontal">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="step-title-horizontal">Ongoing Assistance</h3>
                    <p class="step-desc-horizontal">From follow-up to settlement, we are with you at every step.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="app-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side - Why Choose Medical Boons -->
                <div class="col-lg-3 animate" data-animation="fadeInLeft">
                    <div class="why-choose-box">
                        <h3 class="why-choose-title">WHY CHOOSE MEDICAL BOONS?</h3>
                        <ul class="why-choose-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>End-to-end healthcare guidance from symptoms to settlement</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Trusted network of doctors, hospitals & labs</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Coordinated support for a seamless experience</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Affordable care with transparent pricing</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Insurance claim assistance and documentation support</span>
                            </li>
                            <!-- <li>
                                                                                                                                                                                                                <i class="fas fa-check-circle"></i>
                                                                                                                                                                                                                <span>24/7 support for you and your family</span>
                                                                                                                                                                                                            </li> -->
                        </ul>
                    </div>
                </div>

                <!-- Center - Doctor Image -->
                <!-- <div class="col-lg-3 text-center animate" data-animation="fadeInUp">
                                                                                                                                                                                                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=600&fit=crop" alt="Doctor" class="doctor-image">
                                                                                                                                                                                                </div> -->

                <!-- Center Right - CAREEZ Content -->
                <div class="col-lg-6 animate" data-animation="fadeInUp">
                    <div class="careez-content">
                        <h2 class="careez-title">CAREZY – Convenience In Your Hands</h2>
                        <p class="careez-subtitle">Your Healthcare Made Easy</p>
                        <p class="careez-description">
                            CAREZY is the official app of Medical Boons. It helps you request services, book
                            appointments, track support, access reports and stay connected.
                        </p>

                        <div class="careez-features">
                            <div class="careez-feature-item">
                                <i class="fas fa-calendar-check"></i>
                                <span>Easy Booking</span>
                            </div>
                            <div class="careez-feature-item">
                                <i class="fas fa-clock"></i>
                                <span>Real-time Updates</span>
                            </div>
                            <div class="careez-feature-item">
                                <i class="fas fa-file-medical"></i>
                                <span>Reports & Records</span>
                            </div>
                            <div class="careez-feature-item">
                                <i class="fas fa-headset"></i>
                                <span>Dedicated Support</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Phone Mockup & Downloads -->
                <div class="col-lg-3 text-center animate" data-animation="fadeInRight">
                    <div class="app-mockup-section">
                        <img src="{{ asset('Front/images/home-about-new.png') }}" alt="CAREEZ App"
                            class="app-phone-mockup">

                        <div class="app-store-badges">
                            <a href="#" target="_blank">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                                    alt="Google Play" class="store-badge">
                            </a>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="membership-section" id="plans">
        <div class="container">
            <div class="membership-header animate">
                <p class="section-subtitle">MEMBERSHIP PLANS</p>
                <h2 class="section-title">Healthcare Support Plans For You & Your Family</h2>
            </div>

            <div class="row">
                <!-- Left Sidebar - Plan Benefits -->
                <div class="col-lg-3">
                    <div class="plan-benefits-sidebar animate" data-delay="0">
                        <h3>All plans include:</h3>
                        <ul class="sidebar-benefits-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Save on consultations, tests & treatments</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Access to trusted network & coordination</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Insurance claim guidance & support</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Care for the entire family</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Affordable plans with maximum benefits</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Side - Plans Grid -->
                <div class="col-lg-9">
                    <div class="plans-grid">
                        <!-- Silver Plan -->
                        @foreach ($plans as $plan)
                            @php
                                $color = '';

                                if ($plans == 'Gold Plan') {
                                    $color = 'gold';
                                } elseif ($plans == 'Platinum Plan') {
                                    $color = 'platinum';
                                }
                            @endphp
                            <div class="plan-card animate" data-delay="0">
                                <div class="plan-icon {{ $color }}">
                                    <i class="{{ $plan->icon ?? '' }}"></i>
                                </div>
                                <h3 class="plan-name">{{ $plan->name ?? '' }}</h3>
                                <p class="plan-description">{{ $plan->title ?? '' }}</p>
                                <p class="plan-description"><strong>Best for </strong>{{ $plan->sub_title ?? '' }}.
                                </p>
                                <a href="{{ route('Front.Plan') }}" class="plan-btn">View Benefits <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        @endforeach
                        <!-- Gold Plan - Featured -->
                        {{-- <div class="plan-card featured animate" data-delay="100">
                            <span class="best-choice">MOST POPULAR</span>
                            <div class="plan-icon gold">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h3 class="plan-name">Gold Plan</h3>
                            <p class="plan-description">Complete family care support.</p>
                            <p class="plan-description"><strong>Best for </strong>Family seeking complete healthcare
                                assistance.</p>
                            <a href="pages/plans.html" class="plan-btn">View Benefits <i
                                    class="fas fa-arrow-right"></i></a>
                        </div> --}}

                        <!-- Platinum Plan -->
                        {{-- <div class="plan-card animate" data-delay="200">
                            <div class="plan-icon platinum">
                                <i class="fas fa-gem"></i>
                            </div>
                            <h3 class="plan-name">Platinum Plan</h3>
                            <p class="plan-description">Primium proirity healthcare experience !</p>
                            <p class="plan-description"><strong>Best for </strong> Frequent healthcare assistance.</p>
                            <a href="pages/plans.html" class="plan-btn">View Benefits <i
                                    class="fas fa-arrow-right"></i></a>
                        </div> --}}
                    </div>

                    <!-- View All Plans Link -->
                    <div class="view-all-plans animate" data-delay="300">
                        <a href="{{ route('Front.Plan') }}">
                            View All Plans & Benefits
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">

            <div class="section-header animate">
                <p class="section-subtitle">
                    THE TRUST OF THOUSANDS OF FAMILIES
                </p>

                <h2 class="section-title">
                    We're Rated 4.9/5
                </h2>

                <p style="color: #666; margin-bottom: 20px;">
                    By Our Members
                </p>
            </div>

            <!-- Testimonials Slider -->
            <div class="testimonials-slider">
                <div class="testimonial-track">

                    @foreach ($testimonials as $key => $testimonial)
                        <div class="testimonial-card animate" data-delay="{{ $key * 100 }}">

                            <!-- Dynamic Rating -->
                            <div class="stars">

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimonial->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor

                            </div>

                            <!-- Description -->
                            <p class="testimonial-text">
                                "{{ $testimonial->comment ?? '' }}"
                            </p>

                            <!-- Author -->
                            <div class="testimonial-author">
                                @if (!empty($testimonial->photo))
                                    <img src="{{ asset('upload/testimonial/' . $testimonial->photo) }}"
                                        alt="{{ $testimonial->name }}" class="author-image">
                                @else
                                    <img src="{{ asset('assets/images/noimage.png') }}" alt="{{ $testimonial->name }}"
                                        class="author-image">
                                @endif

                                <div class="author-info">
                                    <p class="author-name">
                                        — {{ $testimonial->name ?? '' }}
                                    </p>

                                    <p class="author-title">
                                        Member
                                    </p>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

            <!-- Slider Navigation -->
            <div class="slider-navigation">

                <button class="slider-btn prev-btn">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="slider-dots"></div>

                <button class="slider-btn next-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>

            </div>

        </div>
    </section>

    <!-- Footer CTA Section - Exact from PDF -->
    <section class="footer-cta">
        <div class="container">
            <h2>We Are Just a Call or Message Away!</h2>
            <p>Your health is our priority. Let us take care of the rest.</p>
            <div class="footer-cta-buttons">
                <a class="btn-secondary" href="https://wa.me/919974660451" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp Us
                </a>
                <a class="btn-primary" href="tel:+919974660451" style="background: white; color: #1e3a5f;">
                    <i class="fas fa-phone"></i>
                    Call Now
                </a>
            </div>
        </div>
    </section>
@endsection
