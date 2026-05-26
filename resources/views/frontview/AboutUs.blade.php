@extends('layouts.front')
@section('content')
    <!-- About Hero Section -->
    <section class="hero-section" style="padding: 40px 0; padding-bottom: 20px;">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left animate">
                    <p class="section-subtitle">ABOUT US</p>
                    <h1 class="hero-title">We exist to make healthcare <span class="green">simple, human and
                            stress-free.</span>
                    </h1>
                    <p class="hero-text" style="font-size: 18px; margin-bottom: 30px;">
                        Medical Boons was created to simplify healthcare journeys for families through trusted guidance,
                        coordinated support and accessible healthcare solutions.

                    </p>
                    <div
                        style="background: #e8f5f3; padding: 25px; border-radius: 15px; border-left: 4px solid var(--primary-teal); margin-bottom: 30px;">
                        <p style="font-size: 18px; color: #1e3a5f; margin: 0; font-style: italic;">
                            <i class="fas fa-quote-left" style="color: var(--primary-teal); margin-right: 10px;"></i>
                            We don't just connect you to services,<br />
                            we walk with you – from symptoms to settlement.

                        </p>
                    </div>
                </div>
                <div class="hero-right animate">
                    <img alt="Family with Doctor" class="hero-image"
                        src="{{ asset('Front/images/about-hero-family-doctor.jpg') }}" />
                </div>
            </div>
        </div>
    </section>
    <!-- Our Story -->
    <section class="services-section" style="padding: 20px 0;">
        <div class="container">
            <div class="hero-content">
                <div class="col-md-2">
                    <div
                        style="width: 150px; height: 150px; background: linear-gradient(135deg, #e8f5f3, #d4ede9); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 30px;">
                        <!-- <i class="fas fa-handshake" style="font-size: 70px; color: var(--primary-teal);"></i>-->
                        <img src="{{ asset('Front/images/aboutus_hand.png') }}" width="200px;" />
                    </div>
                </div>
                <div class="col-md-4">
                    <p class="section-subtitle">OUR STORY</p>
                    <h2 class="section-title">Born from a Real Need.
                        Built with Purpose.</h2>
                </div>
                <div class="col-md-6">
                    <p style="color: #666; line-height: 1.8; margin-top: 20px;">
                        We saw families struggling at every step – finding the right doctor, getting the right tests,
                        understanding treatments, managing costs and handling claims. The healthcare system was confusing,
                        fragmented and often unaffordable. Support was missing.

                    </p>
                    <p style="color: var(--primary-teal); font-weight: 600; font-size: 18px; margin-top: 20px;">
                        Medical Boons was built to bridge this gap.

                    </p>
                    <p style="color: #666; line-height: 1.8; margin-top: 15px;">
                        We combine technology, trusted networks and human support to make quality healthcare simple,
                        transparent and stress-free for every family.

                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Mission & Vision -->
    <section style="background: white; padding: 60px 0; padding-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-2 animate" data-delay="0">
                    <div
                        style="padding: 40px; background: #f8f9fa; border-radius: 20px; height: 100%; margin-bottom: 20px;">
                        <div class
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-teal), var(--dark-teal)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                            <i class="fas fa-bullseye" style="font-size: 40px; color: white;"></i>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 animate" data-delay="0">
                    <p class="section-subtitle">OUR MISSION</p>
                    <h3 style="font-size: 22px; color: #1e3a5f; margin-bottom: 20px;">To simplify healthcare and improve
                        lives through trusted guidance, coordinated support and reliable resources.</h3>
                </div>
                <div class="col-md-2 animate" data-delay="100">
                    <div
                        style="padding: 40px; background: #f8f9fa; border-radius: 20px; height: 100%; margin-bottom: 20px;">
                        <div
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-teal), var(--dark-teal)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 25px;">
                            <i class="fas fa-eye" style="font-size: 40px; color: white;"></i>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 animate" data-delay="0">
                    <p class="section-subtitle">OUR VISION</p>
                    <h3 style="font-size: 22px; color: #1e3a5f; margin-bottom: 20px;">To be India's most trusted healthcare
                        guidance and support ecosystem for every family.</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Values -->
    <section class="services-section">
        <div class="container">
            <div class="section-header animate">
                <p class="section-subtitle">WHAT WE BELIEVE</p>
                <h2 class="section-title">Our Core Values</h2>
            </div>
            <div class="services-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                <div class="service-card animate" data-delay="0">
                    <div class="service-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>People First</h3>
                    <p>Every family deserves care, respect and understanding.</p>
                </div>
                <div class="service-card animate" data-delay="100">
                    <div class="service-icon">
                        <i class="fas fa-compass"></i>
                    </div>
                    <h3>Guidance Matters</h3>
                    <p>The right guidance at the right time leads to better outcomes.</p>
                </div>
                <div class="service-card animate" data-delay="200">
                    <div class="service-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Care with Integrity</h3>
                    <p>We act with honesty, transparency and responsibility.</p>
                </div>
                <div class="service-card animate" data-delay="300">
                    <div class="service-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3>Together for Better</h3>
                    <p>Coordination and collaboration create a seamless experience.</p>
                </div>

            </div>
        </div>
    </section>
    <!-- What Makes Us Different -->
    <section style="background: white; padding: 60px 0;">
        <div class="container">
            <div class="section-header animate">
                <p class="section-subtitle">WHAT MAKES MEDICAL BOONS DIFFERENT</p>
                <h2 class="section-title">Why Choose Us</h2>
            </div>
            <div class="services-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
                <div class="service-card animate" data-delay="0">
                    <div class="service-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h3>End-to-End Guidance</h3>
                    <p>From symptoms to settlement, we support you at every step.</p>
                </div>
                <div class="service-card animate" data-delay="100">
                    <div class="service-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3>Coordinated Ecosystem</h3>
                    <p>A strong network of doctors, labs, hospitals, homecare &amp; insurers.</p>
                </div>
                <div class="service-card animate" data-delay="200">
                    <div class="service-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3>Affordable &amp; Transparent</h3>
                    <p>Quality care at the right price with complete clarity.</p>
                </div>
                <div class="service-card animate" data-delay="300">
                    <div class="service-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Insurance Assistance</h3>
                    <p>From claim initiation to settlement, we are with you.</p>
                </div>
                <div class="service-card animate" data-delay="400">
                    <div class="service-icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3>Human Support</h3>
                    <p>Real people, real support, always.</p>
                </div>
                <div class="service-card animate" data-delay="500">
                    <div class="service-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Family First Approach</h3>
                    <p>Plans and services designed for your family's well-being.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Journey -->
    <section class="services-section">
        <div class="container">
            <div class="section-header animate">
                <p class="section-subtitle">Growing Together</p>
                <h2 class="section-title">OUR JOURNEY</h2>
            </div>
            <div class="steps-grid">
                <div class="step-box animate" data-delay="0">
                    <!-- <div class="step-icon">
                            <i class="fas fa-flag"></i>
                        </div> -->
                    <h3 style="font-size: 24px; color: var(--primary-teal); margin-bottom: 10px;">2018 – 2020</h3>
                    <h4 style="font-size: 18px; color: #1e3a5f; margin-bottom: 10px;">Trusted Healthcare Guidance</h4>
                    <p>Medical Boons started with a simple mission — helping families navigate healthcare with trusted
                        support and better guidance.</p>
                </div>
                <div class="step-box animate" data-delay="100">
                    <!-- <div class="step-icon">
                            <i class="fas fa-heart-pulse"></i>
                        </div> -->
                    <h3 style="font-size: 24px; color: var(--primary-teal); margin-bottom: 10px;">2021 – 2022</h3>
                    <h4 style="font-size: 18px; color: #1e3a5f; margin-bottom: 10px;">Expanding Diagnostic Services</h4>
                    <p>We strengthened our diagnostic network to provide reliable lab testing, radiology services and
                        smoother patient coordination.</p>
                </div>
                <div class="step-box animate" data-delay="200">
                    <h3 style="font-size: 24px; color: var(--primary-teal); margin-bottom: 10px;">2023 – 2025</h3>
                    <h4 style="font-size: 18px; color: #1e3a5f; margin-bottom: 10px;">Building Offline Healthcare Support
                    </h4>
                    <p>We integrated doctors, diagnostics, hospitals, homecare and insurance support into a more connected
                        healthcare experience.</p>
                </div>
                <div class="step-box animate" data-delay="300">
                    <!-- <div class="step-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div> -->
                    <h3 style="font-size: 24px; color: var(--primary-teal); margin-bottom: 10px;">2026....</h3>
                    <h4 style="font-size: 18px; color: #1e3a5f; margin-bottom: 10px;">Digital Expansion with Carezy</h4>
                    <p>With Carezy, we are moving towards smarter digital healthcare with seamless support, coordination and
                        patient-first care.</p>
                </div>
                <!-- <div class="step-box animate" data-delay="400">
                        
                        <h3 style="font-size: 24px; color: var(--primary-teal); margin-bottom: 10px;">2024 &amp; Beyond</h3>
                        <h4 style="font-size: 18px; color: #1e3a5f; margin-bottom: 10px;">Growing Together</h4>
                        <p>Continues to expand our network and impact more families across India.</p>
                    </div> -->
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section style="padding: 60px 0;">
        <div class="container">
            <div class="section-header animate">
                <p class="section-subtitle">REAL PEOPLE. REAL SUPPORT.</p>
                <h2 class="section-title">Meet Our Care Team</h2>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('Front/images/about-real-support-team.jpg') }}" width="100%" />
                </div>
                <div class="col-md-4">
                    <p style="text-align: justify; color: #666; max-width: 800px; margin: 0 auto 50px;">
                        Behind every service is a team that truly cares. Our care coordinators, support partners and
                        partners work together to ensure you receive the right care, at the right time.

                    </p>
                </div>
                <div class="col-md-4">

                    <p style="margin: 0; color: #666; font-size: 14px; "><i class="fas fa-check-circle"
                            style="color: var(--primary-teal);padding:5px;"></i>Trained care coordinators</p>
                    <p style="margin: 0; color: #666; font-size: 14px;"><i class="fas fa-check-circle"
                            style="color: var(--primary-teal);padding:5px;"></i>Available 24/7 for assistance</p>
                    <p style="margin: 0; color: #666; font-size: 14px;"><i class="fas fa-check-circle"
                            style="color: var(--primary-teal);padding:5px;"></i>Compassionate &amp; confidential support
                    </p>
                    <p style="margin: 0; color: #666; font-size: 14px;"><i class="fas fa-check-circle"
                            style="color: var(--primary-teal);padding:5px;"></i>Committed to your well-being</p>
                </div>
                <!-- <div class="col-md-3 col-6 mb-4">
                                                            <div class="service-card animate" data-delay="0" style="padding: 20px;">
                                                                <div style="width: 100%; padding-bottom: 100%; background: linear-gradient(135deg, #e8f5f3, #d4ede9); border-radius: 50%; margin-bottom: 15px;"></div>
                                                                <p style="margin: 0; color: #666; font-size: 14px;"><i class="fas fa-check-circle" style="color: var(--primary-teal);"></i>Trained care coordinators</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6 mb-4">
                                                            <div class="service-card animate" data-delay="100" style="padding: 20px;">
                                                                <div style="width: 100%; padding-bottom: 100%; background: linear-gradient(135deg, #e8f5f3, #d4ede9); border-radius: 50%; margin-bottom: 15px;"></div>
                                                                <p style="margin: 0; color: #666; font-size: 14px;"><i class="fas fa-check-circle" style="color: var(--primary-teal);"></i>Available 24/7 for assistance</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6 mb-4">
                                                            <div class="service-card animate" data-delay="200" style="padding: 20px;">
                                                                <div style="width: 100%; padding-bottom: 100%; background: linear-gradient(135deg, #e8f5f3, #d4ede9); border-radius: 50%; margin-bottom: 15px;"></div>
                                                                <p style="margin: 0; color: #666; font-size: 14px;"><i class="fas fa-check-circle" style="color: var(--primary-teal);"></i>Compassionate &amp; confidential support</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6 mb-4">
                                                            <div class="service-card animate" data-delay="300" style="padding: 20px;">
                                                                <div style="width: 100%; padding-bottom: 100%; background: linear-gradient(135deg, #e8f5f3, #d4ede9); border-radius: 50%; margin-bottom: 15px;"></div>
                                                                <p style="margin: 0; color: #666; font-size: 14px;"><i class="fas fa-check-circle" style="color: var(--primary-teal);"></i>Committed to your well-being</p>
                                                            </div>
                                                        </div>-->
            </div>
        </div>
    </section>
    <!-- Trust Stats -->

    <!-- CTA Section -->
    <section class="footer-cta">
        <div class="container">
            <h2>Let's Simplify Healthcare Together</h2>
            <p>We are here to guide, support and stand by you – every step of the way.</p>
            <div class="footer-cta-buttons">
                <a class="btn-secondary" href="https://wa.me/918655774949" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp Us
                </a>
                <a class="btn-primary" href="tel:+918655774949" style="background: white; color: #1e3a5f;">
                    <i class="fas fa-phone"></i>
                    Call Now: +91 86557 74949
                </a>
            </div>
        </div>
    </section>
@endsection
