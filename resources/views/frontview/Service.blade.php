@extends('layouts.front')

@section('content')
    <style>
        .healthcare-promise-section {
            background: #fff;
            padding: 40px 0;
        }

        .healthcare-promise-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #ececec;
            border-radius: 10px;
            padding: 30px 35px;
            gap: 37px;
            background: #fff;
        }

        /* LEFT SIDE */
        .healthcare-promise-left {
            display: flex;
            align-items: center;
            gap: 20px;
            max-width: 500px;
            width: 100%;
        }

        .healthcare-promise-icon {
            width: 75px;
            height: 75px;
            min-width: 75px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-teal), var(--dark-teal));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .healthcare-promise-icon i {
            font-size: 30px;
            color: #fff;
        }

        .healthcare-promise-content h2 {
            font-size: 23px;
            font-weight: 700;
            color: #1f3763;
            margin-bottom: 10px;
        }

        .healthcare-promise-content p {
            font-size: 14px;
            line-height: 1.5;
            color: #666;
            margin: 0;
        }

        /* RIGHT SIDE */
        .healthcare-promise-stats {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex: 1;
        }

        .healthcare-stat-item {
            text-align: center;
            padding: 0 7px;
            border-right: 1px solid #e9e9e9;
        }

        .healthcare-stat-item i {
            font-size: 30px;
            color: #5a67a5;
            margin-bottom: 10px;
        }

        .healthcare-stat-number {
            font-size: 25px;
            font-weight: 700;
            color: #1f3763;
            line-height: 1.2;
        }

        .healthcare-stat-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .healthcare-border-remove {
            border-right: 0 !important;
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {

            .healthcare-promise-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }

            .healthcare-promise-left {
                max-width: 100%;
            }

            .healthcare-promise-stats {
                width: 100%;
                flex-wrap: wrap;
                gap: 30px;
            }

            .healthcare-stat-item {
                width: calc(50% - 15px);
                border-right: 0;
                padding: 0;
            }
        }

        @media (max-width: 576px) {

            .healthcare-promise-left {
                flex-direction: column;
                text-align: center;
            }

            .healthcare-promise-content h2 {
                font-size: 24px;
            }

            .healthcare-promise-stats {
                flex-direction: column;
            }

            .healthcare-stat-item {
                width: 100%;
            }
        }

        /* healthcare services */
        .service-card {
            background: white;
            padding: 30px 20px;
            border-radius: 15px;
            text-align: start;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #e8f5f3, #d4ede9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            margin-bottom: 10px;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
    </style>
    <!-- Services Hero -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left animate">
                    <p class="section-subtitle">OUR SERVICES</p>
                    <h1 class="hero-title">
                        Complete Healthcare Solutions <span class="green">Under One Roof</span>
                    </h1>
                    <p class="hero-text">
                        From consultations to treatment, diagnostics to recovery – we guide and support you at every
                        step of your healthcare journey.
                    </p>
                    <div class="hero-features">
                        <div class="feature-box">
                            <i class="fas fa-user-md"></i>
                            <span>Expert Guidance</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-headset"></i>
                            <span>Coordinated Support</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-shield-alt"></i>
                            <span>Quality Care</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-universal-access"></i>
                            <span>Always Accessible</span>
                        </div>
                    </div>
                </div>
                <div class="hero-right animate">
                    <img alt="Healthcare Services" class="hero-image"
                        src="{{ asset('Front/images/services-hero-healthcare.jpg') }}" />
                </div>
            </div>
        </div>
    </section>
    <!-- Service Promise -->
    <section class="healthcare-promise-section">
        <div class="container">

            <div class="healthcare-promise-wrapper animate">

                <!-- Left Side -->
                <div class="healthcare-promise-left">

                    <div class="healthcare-promise-icon">
                        <i class="fas fa-heart-pulse"></i>
                    </div>

                    <div class="healthcare-promise-content">
                        <h2>Every Service. One Promise.</h2>

                        <p>
                            We combine trusted healthcare partners, experienced professionals
                            and compassionate support to deliver seamless and stress-free care
                            for you and your family.
                        </p>
                    </div>

                </div>

                <!-- Right Side -->
                <div class="healthcare-promise-stats">

                    <div class="healthcare-stat-item">
                        <i class="fas fa-users" style="color:#2d9d91 ;"></i>
                        <div class="healthcare-stat-number">15,000+</div>
                        <div class="healthcare-stat-label">Patients Supported</div>
                    </div>

                    <div class="healthcare-stat-item">
                        <i class="fas fa-hospital" style="color: #1e3a5f;"></i>
                        <div class="healthcare-stat-number">100+</div>
                        <div class="healthcare-stat-label">Healthcare Partners</div>
                    </div>

                    <div class="healthcare-stat-item">
                        <i class="fas fa-headset" style="color:#2d9d91 ;"></i>
                        <div class="healthcare-stat-number">24/7</div>
                        <div class="healthcare-stat-label">Support Available</div>
                    </div>

                    <div class="healthcare-stat-item healthcare-border-remove">
                        <i class="fas fa-shield-alt" style="color: #1e3a5f;"></i>
                        <div class="healthcare-stat-number">8+</div>
                        <div class="healthcare-stat-label">Years of Trust</div>
                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- All Services Grid -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="section-header animate">
                <!-- <p class="section-subtitle">OUR HEALTHCARE SERVICES</p> -->
                <h2 class="section-title">Our Healthcare Services</h2>
            </div>
            <div class="services-grid">
                <!-- 1. Doctor Consultation -->
                @php
                    $i = 1;
                @endphp
                @foreach ($Services as $service)
                    <div class="service-card animate" data-delay="0" id="doctor">
                        <div class="service-icon">
                            {!! $service->icon !!}
                        </div>
                        <h3>{{ $i++ }}. {{ $service->name ?? '' }}</h3>
                        <p>{{ $service->description ?? '' }}</p>
                        <ul style="text-align: left; padding-left: 16px; color: #666; font-size: 14px; line-height: 2;">
                            {!! $service->detail ?? '' !!}
                        </ul>
                        <!-- <a class="btn-secondary" href="contact.html" style="margin-top: 15px;">Book Now <i
                                                            class="fas fa-arrow-right"></i></a> -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- How Services Work -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-header animate">
                <p class="section-subtitle">HOW OUR SERVICES WORK</p>
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
    <!-- CTA -->
    <section class="footer-cta">
        <div class="container">
            <h2>Your Health. Our Priority.</h2>
            <p>Let us take care of the rest.</p>
            <div class="footer-cta-buttons">
                <a class="btn-secondary" href="https://wa.me/918655774949" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp Us
                </a>
                <a class="btn-primary" href="tel:+918655774949" style="background: white; color: #1e3a5f;">
                    <i class="fas fa-phone"></i>
                    Request Callback
                </a>
            </div>
        </div>
    </section>
@endsection
