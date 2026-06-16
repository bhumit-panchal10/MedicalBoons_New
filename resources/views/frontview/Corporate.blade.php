@extends('layouts.front')
@section('content')
    <style>
        .hero-text {
            font-size: 16px;
            color: var(--text-light);
            line-height: 1.4;
            margin-bottom: 10px;
        }

        /* ============================================
                                                                   CORPORATE - WHY PARTNER SECTION
                                                                   ============================================ */

        .corporate-why-partner-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.2fr 0.8fr;
            gap: 20px;
            align-items: center;
            /* background: white; */
            /* padding: 50px; */
            border-radius: 20px;
            /* box-shadow: 0 5px 25px rgba(0,0,0,0.08); */
        }

        /* Left Content */
        .corporate-why-left {
            padding-right: 20px;
        }

        .corporate-why-title {
            font-size: 26px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .corporate-title-underline {
            width: 60px;
            height: 3px;
            background: #2d9d91;
            margin-bottom: 20px;
        }

        .corporate-why-description {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin-bottom: 10px;
        }

        /* Benefits List */
        .corporate-benefits-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .corporate-benefit-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .corporate-check-icon {
            width: 28px;
            height: 28px;
            background: #27ae60;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .corporate-check-icon i {
            font-size: 14px;
            color: white;
        }

        .corporate-benefit-item span {
            font-size: 15px;
            color: #333;
            line-height: 1.5;
        }

        /* Center - Corporate Image */
        .corporate-why-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .corporate-meeting-img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        /* Right - Stats Grid (2x2) */
        .corporate-why-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .corporate-stat-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px 15px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .corporate-stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .corporate-stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .corporate-stat-icon.green {
            background: #e8f8f1;
        }

        .corporate-stat-icon.teal {
            background: #e0f7f4;
        }

        .corporate-stat-icon.blue {
            background: #e3f2fd;
        }

        .corporate-stat-icon.purple {
            background: #f3e5f5;
        }

        .corporate-stat-icon i {
            font-size: 26px;
        }

        .corporate-stat-icon.green i {
            color: #27ae60;
        }

        .corporate-stat-icon.teal i {
            color: #2d9d91;
        }

        .corporate-stat-icon.blue i {
            color: #3498db;
        }

        .corporate-stat-icon.purple i {
            color: #9b59b6;
        }

        .corporate-stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 5px;
        }

        .corporate-stat-label {
            font-size: 12px;
            color: #666;
            line-height: 1.3;
        }

        /* Mobile Responsive */
        @media (max-width: 1200px) {
            .corporate-why-partner-wrapper {
                grid-template-columns: 1fr;
                padding: 40px 30px;
            }

            .corporate-why-left {
                padding-right: 0;
            }

            .corporate-why-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .corporate-why-title {
                font-size: 22px;
            }

            .corporate-why-description {
                font-size: 14px;
            }

            .corporate-why-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <!-- Corporate Hero -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left animate">
                    <p class="section-subtitle">CORPORATE PARTNERSHIP</p>
                    <h1 class="hero-title">
                        Better Health.<br />
                        Stronger <span class="green">Workplaces.</span>
                    </h1>
                    <p class="hero-text">
                        Partner with Medical Boons to build a healthier, happier and more productive workforce through
                        our comprehensive healthcare solutions and support programs.
                    </p>
                    <div class="hero-features">
                        <div class="feature-box">
                            <i class="fas fa-shield-alt"></i>
                            <span>Trusted Healthcare Partner</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-users"></i>
                            <span>Employee Well-being First</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-chart-line"></i>
                            <span>Measurable Impact</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-handshake"></i>
                            <span>End-to-End Support</span>
                        </div>
                    </div>
                </div>
                <div class="hero-right animate">
                    <img alt="Corporate Healthcare" class="hero-image"
                        src="{{ asset('Front/images/corporate-hero-handshake.jpg') }}" />
                </div>
            </div>
        </div>
    </section>

    <section class="footer-cta">
        <div class="container">
            <h2>Ready to Transform Employee Healthcare?</h2>
            <p>Let's discuss how we can support your organization.</p>
            <div class="footer-cta-buttons">
                <a class="btn-primary" href="{{ route('B2B.login') }}" style="background: white; color: #1e3a5f;">
                    <i class="fas fa-sign-in-alt"></i>
                    Associate Login
                </a>
                <a class="btn-secondary" href="{{ route('corporate.login') }}">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Corporate Login
                </a>
            </div>
        </div>
    </section>
    <!-- Corporate Solutions -->
    <section style="background: white; padding: 60px 0;">
        <div class="container">
            <div class="section-header animate">
                <!-- <p class="section-subtitle">Corporate Healthcare Solutions</p> -->
                <h2 class="section-title">Corporate Healthcare Solutions</h2>
            </div>
            <div class="services-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
                <div class="service-card animate" data-delay="0">
                    <div class="service-icon-plain blue">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Employee Health Programs</h3>
                    <p>Annual health checkups, wellness programs and preventive care initiatives.</p>
                </div>
                <div class="service-card animate" data-delay="100">
                    <div class="service-icon-plain green">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Doctor Consultation </h3>
                    <p>Easy access to certified doctors for consultations anytime, anywhere.</p>
                </div>
                <div class="service-card animate" data-delay="200">
                    <div class="service-icon-plain purple">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3>Diagnostics &amp; Lab Partnership</h3>
                    <p>Discounted lab tests and home sample collection for employees.</p>
                </div>
                <div class="service-card animate" data-delay="300">
                    <div class="service-icon-plain green-light">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Health Insurance Support</h3>
                    <p>Expert guidance for insurance selection, claims and renewals.</p>
                </div>
                <div class="service-card animate" data-delay="400">
                    <div class="service-icon-plain pink">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>Wellness &amp; Mental Well-being</h3>
                    <p>Ergonomics sessions, healing programs and mental wellness support.</p>
                </div>
                <div class="service-card animate" data-delay="500">
                    <div class="service-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3>Homecare &amp; IPD Assistance</h3>
                    <p>Home healthcare, hospital coordination and end-to-IPD support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Partner With Medical Boons Section -->
    <section style="background: #f8f9fa; padding: 50px 0;">
        <div class="container">
            <div class="corporate-why-partner-wrapper">
                <!-- Left Side - Content -->
                <div class="corporate-why-left">
                    <h2 class="corporate-why-title">Why Partner With Medical Boons?</h2>
                    <div class="corporate-title-underline"></div>

                    <p class="corporate-why-description">
                        We help organizations create a supportive work environment where employees and their families
                        feel cared for.
                    </p>

                    <!-- Benefits List with Green Checkmarks -->
                    <div class="corporate-benefits-list">
                        <div class="corporate-benefit-item">
                            <div class="corporate-check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Improve employee health & productivity</span>
                        </div>

                        <div class="corporate-benefit-item">
                            <div class="corporate-check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Reduce absenteeism and healthcare costs</span>
                        </div>

                        <div class="corporate-benefit-item">
                            <div class="corporate-check-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Increase employee satisfaction and retention</span>
                        </div>

                        <!-- <div class="corporate-benefit-item">
                                                                                        <div class="corporate-check-icon">
                                                                                            <i class="fas fa-check"></i>
                                                                                        </div>
                                                                                        <span>Trusted by 50,000+ families across India</span>
                                                                                    </div> -->
                    </div>
                </div>

                <!-- Center - Corporate Meeting Image -->
                <div class="corporate-why-center">
                    <img src="{{ asset('Front/images/corporate-team-meeting.jpg') }}" alt="Corporate Team Meeting"
                        class="corporate-meeting-img">
                </div>

                <!-- Right Side - Stats Grid (2x2) -->
                <div class="corporate-why-stats">
                    <div class="corporate-stat-box">
                        <div class="corporate-stat-icon green">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="corporate-stat-number">15,000+</div>
                        <div class="corporate-stat-label">Paitents Trust Us</div>
                    </div>

                    <div class="corporate-stat-box">
                        <div class="corporate-stat-icon teal">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="corporate-stat-number">100+</div>
                        <div class="corporate-stat-label">Corporate Partners</div>
                    </div>

                    <div class="corporate-stat-box">
                        <div class="corporate-stat-icon blue">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="corporate-stat-number">24/7</div>
                        <div class="corporate-stat-label">Dedicated Support</div>
                    </div>

                    <div class="corporate-stat-box">
                        <div class="corporate-stat-icon purple">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="corporate-stat-number">8+ Years</div>
                        <div class="corporate-stat-label">of Healthcare Trust</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- How We Work -->
    <section style="background: white; padding: 60px 0;">
        <div class="container">
            <div class="section-header animate">
                <!-- <p class="section-subtitle">How We Work With Your Organization</p> -->
                <h2 class="section-title">How We Work With Your Organization</h2>
            </div>
            <div class="steps-grid">
                <div class="step-box animate" data-delay="0">
                    <!-- <div class="step-number">1</div> -->
                    <i class="fas fa-handshake" style="color: #27ae60;"></i>
                    <h3>Understand</h3>
                    <p>We understand your organization's unique needs and goals.</p>
                </div>
                <div class="step-box animate" data-delay="100">
                    <!-- <div class="step-number">2</div> -->
                    <i class="fas fa-clipboard-check" style="color: #3498db;"></i>
                    <h3>Customize</h3>
                    <p>We design a customized healthcare program for your employees.</p>
                </div>
                <div class="step-box animate" data-delay="200">
                    <!-- <div class="step-number">3</div> -->
                    <i class="fas fa-cogs" style="color: #9b59b6;"></i>
                    <h3>Implement</h3>
                    <p>Smooth onboarding and seamless implementation with full support.</p>
                </div>
                <div class="step-box animate" data-delay="300">
                    <!-- <div class="step-number">4</div> -->
                    <i class="fas fa-users" style="color: #f39c12;"></i>
                    <h3>Engage</h3>
                    <p>We engage employees with regular programs and support.</p>
                </div>
                <div class="step-box animate" data-delay="400">
                    <!-- <div class="step-number">5</div> -->
                    <i class="fas fa-chart-bar" style="color: #1abc9c;"></i>
                    <h3>Measure &amp; Improve</h3>
                    <p>We measure impact and continuously improve for better results.</p>
                </div>
            </div>

        </div>
    </section>
    <!-- Trusted By -->
    <section class="services-section">
        <div class="container">
            <div class="section-header animate">
                <!-- <p class="section-subtitle">Trusted By Leading Organizations</p> -->
                <h2 class="section-title">Trusted By Leading Organizations</h2>
            </div>
            <div class="partners-logos" style="margin-bottom: 30px;">
                @foreach ($Ourclients as $Ourclient)
                    <img alt="Client" src="{{ asset('/upload/OurClient-images/' . $Ourclient->image) }}" />
                @endforeach
            </div>
            <p style="text-align: center; color: #666; font-style: italic;">And many more growing teams across
                industries</p>
        </div>
    </section>
    <!-- Stats -->
    <!-- <section style="background: linear-gradient(135deg, #1e3a5f, var(--primary-teal)); padding: 60px 0;">
                                                                        <div class="container">
                                                                            <div class="stats-grid">
                                                                                <div class="stat-box animate">
                                                                                    <i class="fas fa-users" style="color: white;"></i>
                                                                                    <div class="stat-number" style="color: white;">50000</div>
                                                                                    <div class="stat-label" style="color: rgba(255,255,255,0.9);">Families Trust Us</div>
                                                                                </div>
                                                                                <div class="stat-box animate">
                                                                                    <i class="fas fa-building" style="color: white;"></i>
                                                                                    <div class="stat-number" style="color: white;">500</div>
                                                                                    <div class="stat-label" style="color: rgba(255,255,255,0.9);">Corporate Partners</div>
                                                                                </div>
                                                                                <div class="stat-box animate">
                                                                                    <i class="fas fa-headset" style="color: white;"></i>
                                                                                    <div class="stat-number" style="color: white;">24</div>
                                                                                    <div class="stat-label" style="color: rgba(255,255,255,0.9);">Dedicated Support 24/7</div>
                                                                                </div>
                                                                                <div class="stat-box animate">
                                                                                    <i class="fas fa-calendar" style="color: white;"></i>
                                                                                    <div class="stat-number" style="color: white;">10</div>
                                                                                    <div class="stat-label" style="color: rgba(255,255,255,0.9);">Years of Healthcare Trust</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </section> -->
    <!-- Get Started -->
    <section style="background: white; padding: 80px 0;">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left animate">
                    <img alt="Corporate Team" class="hero-image"
                        src="{{ asset('Front/images/corporate-team-collaboration.jpg') }}" />
                </div>
                <div class="hero-right animate">
                    <h2 class="section-title">Let's Build A Healthier Workplace Together</h2>
                    <p style="color: #666; line-height: 1.8; margin: 20px 0;">
                        Partner with Medical Boons and give your employees the healthcare support they deserve.
                    </p>
                    <div class="hero-buttons">
                        <a class="btn-secondary" href="https://wa.me/918655774949" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp Us
                        </a>
                        <a class="btn-primary" href="tel:+918655774949">
                            <i class="fas fa-phone"></i>
                            Call Now
                        </a>
                        <a class="btn-secondary" href="contact.html">
                            <i class="fas fa-envelope"></i>
                            Corporate Enquiry
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA -->
    <section class="footer-cta">
        <div class="container">
            <h2>Ready to Transform Employee Healthcare?</h2>
            <p>Let's discuss how we can support your organization.</p>
            <div class="footer-cta-buttons">
                <a class="btn-primary" href="contact.html" style="background: white; color: #1e3a5f;">
                    <i class="fas fa-briefcase"></i>
                    Partner With Us
                </a>
                <a class="btn-secondary" href="tel:+918655774949">
                    <i class="fas fa-phone"></i>
                    Call: +91 86557 74949
                </a>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
