@extends('layouts.front')
@section('content')
    <style>
        .contact-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-teal), var(--dark-teal));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .contact-icon i {
            font-size: 28px;
            color: white;
        }

        .form-control {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-teal);
            box-shadow: 0 0 0 0.2rem rgba(45, 157, 145, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #1e3a5f;
            margin-bottom: 8px;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary-teal), var(--dark-teal));
            border: none;
            padding: 14px 40px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(45, 157, 145, 0.3);
        }

        .map-container {
            width: 100%;
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        .faq-item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .faq-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #1e3a5f;
        }

        .faq-answer {
            margin-top: 15px;
            color: #666;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .contact-hero-section {
            background: #ffffff;
            padding: 0;
            overflow: hidden;
        }

        /* Left Content Padding */
        .contact-hero-content {
            padding: 80px 45px 80px 53px;
        }

        /* Contact Hero Subtitle */
        .contact-hero-subtitle {
            font-size: 13px;
            font-weight: 700;
            color: #2d9d91;
            letter-spacing: 1px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        /* Contact Hero Title */
        .contact-hero-title {
            font-size: 42px;
            font-weight: 700;
            color: #1e3a5f;
            line-height: 1.2;
            margin-bottom: 25px;
        }

        .contact-hero-title .text-green {
            color: #2d9d91;
        }

        /* Contact Hero Description */
        .contact-hero-description {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        /* Contact Features Row - All 4 Icons in One Row */
        .contact-features-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* gap: 20px; */
        }

        .contact-feature-item {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: center;
        }

        .contact-feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .contact-feature-icon.teal {
            background: #e0f7f4;
        }

        .contact-feature-icon.blue {
            background: #e3f2fd;
        }

        .contact-feature-icon.purple {
            background: #f3e5f5;
        }

        .contact-feature-icon.orange {
            background: #fff3e0;
        }

        .contact-feature-icon i {
            font-size: 22px;
        }

        .contact-feature-icon.teal i {
            color: #2d9d91;
        }

        .contact-feature-icon.blue i {
            color: #3498db;
        }

        .contact-feature-icon.purple i {
            color: #9b59b6;
        }

        .contact-feature-icon.orange i {
            color: #f39c12;
        }

        .contact-feature-text {
            font-size: 12px;
            color: #666;
            line-height: 1;
        }

        .contact-feature-text strong {
            color: #1e3a5f;
            font-weight: 600;
            display: block;
        }

        /* Contact Hero Image - Full Width, No Crop */
        .contact-hero-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 525px;
        }

        .contact-hero-img {
            width: 100%;
            height: 450px;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        /* Call Card Overlay - Bottom Right */
        .contact-call-card {
            position: absolute;
            bottom: 40px;
            right: 40px;
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
            min-width: 320px;
            z-index: 10;
        }

        .call-card-label {
            font-size: 14px;
            font-weight: 600;
            color: #2d9d91;
            margin: 0 0 15px 0;
        }

        .call-card-phone {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .call-card-icon {
            width: 50px;
            height: 50px;
            background: #e8f5f3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .call-card-icon i {
            font-size: 22px;
            color: #2d9d91;
        }

        .call-card-text {
            font-size: 13px;
            color: #666;
            margin: 0 0 5px 0;
        }

        .call-card-number {
            font-size: 26px;
            font-weight: 700;
            color: #3498db;
            text-decoration: none;
            display: block;
            margin: 0;
        }

        .call-card-number:hover {
            color: #2d9d91;
        }

        .call-card-hours {
            font-size: 12px;
            color: #999;
            margin: 0;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        /* Mobile Responsive */
        @media (max-width: 1200px) {
            .contact-hero-content {
                padding: 60px 40px;
            }

            .contact-features-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .contact-call-card {
                right: 20px;
                bottom: 20px;
                min-width: 280px;
            }
        }

        @media (max-width: 992px) {
            .contact-hero-content {
                padding: 50px 30px;
            }

            .contact-hero-title {
                font-size: 36px;
            }

            .contact-hero-image-wrapper {
                min-height: 500px;
            }

            .contact-call-card {
                position: static;
                margin: 30px;
                min-width: auto;
            }
        }

        @media (max-width: 768px) {
            .contact-hero-title {
                font-size: 32px;
            }

            .contact-features-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .contact-hero-image-wrapper {
                min-height: 400px;
            }

            .call-card-number {
                font-size: 22px;
            }
        }

        @media (max-width: 576px) {
            .contact-features-row {
                grid-template-columns: 1fr;
            }
        }

        /* ============================================
                                                                                       GET IN TOUCH SECTION - PDF EXACT MATCH
                                                                                       ============================================ */

        /* Title Underline Center */
        .title-underline-center {
            width: 60px;
            height: 3px;
            background: #2d9d91;
            margin: 15px auto 0;
        }

        /* Contact Method Card */
        .contact-method-card {
            background: white;
            padding: 35px 25px;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
            min-height: 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-method-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        /* Contact Method Icon */
        .contact-method-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .contact-method-icon.green {
            background: #e0f7f4;
        }

        .contact-method-icon.whatsapp {
            background: #e8f8f1;
        }

        .contact-method-icon.blue {
            background: #e3f2fd;
        }

        .contact-method-icon.purple {
            background: #f3e5f5;
        }

        .contact-method-icon i {
            font-size: 32px;
        }

        .contact-method-icon.green i {
            color: #2d9d91;
        }

        .contact-method-icon.whatsapp i {
            color: #25d366;
        }

        .contact-method-icon.blue i {
            color: #3498db;
        }

        .contact-method-icon.purple i {
            color: #9b59b6;
        }

        /* Contact Method Title */
        .contact-method-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 12px;
        }

        /* Contact Method Number/Email */
        .contact-method-number,
        .contact-method-email {
            font-size: 18px;
            font-weight: 700;
            color: #3498db;
            margin-bottom: 8px;
        }

        /* Contact Method Description */
        .contact-method-desc {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
            line-height: 1.5;
        }

        /* Contact Method Address */
        .contact-method-address {
            font-size: 14px;
            color: #666;
            margin-bottom: 12px;
            line-height: 1.6;
        }

        /* Contact Method Time */
        .contact-method-time {
            font-size: 13px;
            color: #999;
            margin: 0;
            line-height: 1.5;
        }

        /* WhatsApp Button */
        .contact-method-btn {
            display: inline-block;
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .whatsapp-btn {
            background: #25d366;
            color: white;
        }

        .whatsapp-btn:hover {
            background: #20ba5a;
            color: white;
            transform: scale(1.05);
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .contact-method-card {
                min-height: auto;
            }
        }

        /* ============================================
                                                                                       SUPPORT BANNER SECTION - NEW UNIQUE CLASSES
                                                                                       ============================================ */

        .support-banner-container {
            display: flex;
            align-items: center;
            gap: 30px;
            background: white;
            padding: 40px 50px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        /* Clock Icon Section */
        .support-banner-clock {
            position: relative;
            flex-shrink: 0;
        }

        .support-clock-circle {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #e0f7f4, #c8ede7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .support-clock-circle i {
            font-size: 45px;
            color: #2d9d91;
        }

        .support-badge-247 {
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            background: #2d9d91;
            color: white;
            font-size: 16px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 20px;
            box-shadow: 0 3px 10px rgba(45, 157, 145, 0.3);
        }

        /* Text Section */
        .support-banner-text {
            flex: 0 0 280px;
        }

        .support-banner-text h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .support-banner-text p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        /* Stats Section - 3 Columns Horizontal */
        .support-banner-stats {
            display: flex;
            gap: 40px;
            flex: 1;
            justify-content: center;
        }

        .support-stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .support-stat-icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .support-stat-item:nth-child(1) .support-stat-icon-circle {
            background: #e0f7f4;
        }

        .support-stat-item:nth-child(2) .support-stat-icon-circle {
            background: #e8f8f1;
        }

        .support-stat-item:nth-child(3) .support-stat-icon-circle {
            background: #e3f2fd;
        }

        .support-stat-icon-circle i {
            font-size: 28px;
        }

        .support-stat-item:nth-child(1) .support-stat-icon-circle i {
            color: #2d9d91;
        }

        .support-stat-item:nth-child(2) .support-stat-icon-circle i {
            color: #27ae60;
        }

        .support-stat-item:nth-child(3) .support-stat-icon-circle i {
            color: #3498db;
        }

        .support-stat-num {
            font-size: 32px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 5px;
            line-height: 1;
        }

        .support-stat-text {
            font-size: 13px;
            color: #666;
            line-height: 1.4;
            max-width: 125px;
        }

        /* Doctor Image */
        .support-banner-doctor {
            flex-shrink: 0;
        }

        .support-banner-doctor img {
            height: 150px;
            width: auto;
            display: block;
        }

        /* Mobile Responsive */
        @media (max-width: 1200px) {
            .support-banner-container {
                flex-wrap: wrap;
                padding: 30px;
            }

            .support-banner-text {
                flex: 0 0 100%;
                text-align: center;
                margin-top: 20px;
            }

            .support-banner-stats {
                flex: 0 0 100%;
                justify-content: center;
                margin-top: 20px;
            }
        }

        @media (max-width: 768px) {
            .support-banner-container {
                flex-direction: column;
                text-align: center;
            }

            .support-banner-stats {
                flex-direction: column;
                gap: 20px;
            }

            .support-banner-doctor img {
                height: 120px;
            }
        }
    </style>
    <!-- Contact Hero Section -->
    <section class="contact-hero-section">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-top">
                <!-- Left Content -->
                <div class="col-lg-6">
                    <div class="contact-hero-content">
                        <p class="contact-hero-subtitle">CONTACT US</p>
                        <h1 class="contact-hero-title">
                            We're Here to Help You<br>
                            <span class="text-green">Every Step of the Way</span>
                        </h1>

                        <p class="contact-hero-description">
                            Have questions, need guidance, or want to know more about our services and plans? Our care
                            team is ready to assist you.
                        </p>

                        <!-- Feature Icons Row - All 4 in One Row -->
                        <div class="contact-features-row">
                            <div class="contact-feature-item">
                                <div class="contact-feature-icon teal">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="contact-feature-text">
                                    <strong>Quick</strong><br>Response
                                </div>
                            </div>

                            <div class="contact-feature-item">
                                <div class="contact-feature-icon blue">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="contact-feature-text">
                                    <strong>Trusted</strong><br>Support
                                </div>
                            </div>

                            <div class="contact-feature-item">
                                <div class="contact-feature-icon purple">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="contact-feature-text">
                                    <strong>Human</strong><br>Connection
                                </div>
                            </div>

                            <div class="contact-feature-item">
                                <div class="contact-feature-icon orange">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                                <div class="contact-feature-text">
                                    <strong>Care You</strong><br>Can Count On
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Image - Full Width, No Cropping -->
                <div class="col-lg-6 position-relative">
                    <div class="contact-hero-image-wrapper">
                        <img src="{{ asset('Front/images/contact-hero-support.jpg') }}" alt="Customer Support"
                            class="contact-hero-img">

                        <!-- Call Card Overlay -->
                        <!-- <div class="contact-call-card">
                                                                                                                                <p class="call-card-label">Need Immediate Help?</p>
                                                                                                                                <div class="call-card-phone">
                                                                                                                                    <div class="call-card-icon">
                                                                                                                                        <i class="fas fa-phone-alt"></i>
                                                                                                                                    </div>
                                                                                                                                    <div>
                                                                                                                                        <p class="call-card-text">Call our support team</p>
                                                                                                                                        <a href="tel:+918655774949" class="call-card-number">+91 86557 74949</a>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <p class="call-card-hours">7:00 AM – 10:00 PM (All Days)</p>
                                                                                                                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Get In Touch Section -->
    <section style="background: #f8f9fa; padding: 50px 0;">
        <div class="container">
            <div class="section-header animate text-center" style="margin-bottom: 25px !important;">
                <h2 class="section-title">Get In Touch</h2>
                <div class="title-underline-center"></div>
            </div>

            <div class="row justify-content-center" style="margin-top: 50px;">
                <!-- Call Us -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="contact-method-card animate" data-delay="0">
                        <div class="contact-method-icon green">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3 class="contact-method-title">Call Us</h3>
                        <p class="contact-method-number">+91 86557 74949</p>
                        <p class="contact-method-time">7:00 AM - 10:00 PM (All Days)</p>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="contact-method-card animate" data-delay="100">
                        <div class="contact-method-icon whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h3 class="contact-method-title">WhatsApp</h3>
                        <p class="contact-method-desc">Chat with our care team on WhatsApp</p>
                        <!-- <p class="contact-method-time">We typically reply within a few hours</p> -->
                        <a href="https://wa.me/918655774949" class="contact-method-btn whatsapp-btn" target="_blank">
                            Chat on WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Email Us -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="contact-method-card animate" data-delay="200">
                        <div class="contact-method-icon blue">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="contact-method-title">Email Us</h3>
                        <p class="contact-method-email">info@medicalboons.com</p>
                        <p class="contact-method-time">We typically reply within a few hours</p>
                    </div>
                </div>

                <!-- Visit Us -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="contact-method-card animate" data-delay="300">
                        <div class="contact-method-icon purple">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="contact-method-title">Visit Us</h3>
                        <p class="contact-method-address">SCO 372, Sector 44D,<br>Chandigarh 160047</p>
                        <p class="contact-method-time">Our office is open<br>Mon – Sat | 9 AM – 6 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form -->
    <section style="background: white; padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 animate">
                    <h2 class="section-title" style="margin-bottom: 20px;">Send Us a Message</h2>
                    <p style="color: #666; margin-bottom: 30px;">Fill out the form and our team will get back to you
                        shortly.</p>
                    <form action="{{ route('Front.ContactUs_sendmail') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name*</label>
                                <input class="form-control" name="name" placeholder="Your Name" required=""
                                    type="text" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number*</label>
                                <input class="form-control" name="mobile" placeholder="+91" required=""
                                    type="tel" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address*</label>
                            <input class="form-control" name="email" placeholder="your@email.com" required=""
                                type="email" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Subject*</label>
                            <select class="form-control" name="subject" required="">
                                <option value="">Choose a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="services">Services Information</option>
                                <option value="plans">Membership Plans</option>
                                <option value="corporate">Corporate Partnership</option>
                                <option value="support">Support &amp; Assistance</option>
                                <option value="feedback">Feedback</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Message*</label>
                            <textarea class="form-control" name="message" placeholder="Type your message here..." required=""
                                rows="5"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" id="privacyCheck" name="terms" value="1" required
                                type="checkbox" />

                            <label class="form-check-label" for="privacyCheck" style="font-weight: normal;">
                                I agree to the
                                <a href="{{ url('privacy-policy') }}" style="color: var(--primary-teal);">
                                    Privacy Policy
                                </a>
                                and
                                <a href="{{ url('terms-and-conditions') }}" style="color: var(--primary-teal);">
                                    Terms & Conditions
                                </a>
                            </label>
                        </div>
                        <button class="submit-btn" type="submit">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 animate">
                    <div class="contact-card">
                        <iframe allowfullscreen="" height="550" loading="lazy"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.4076584469586!2d76.7169!3d30.7046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDQyJzE2LjYiTiA3NsKwNDMnMDYuOCJF!5e0!3m2!1sen!2sin!4v1234567890"
                            style="border:0;" width="100%">
                        </iframe>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- We're Always Here for You Section -->
    <section style="background: #f8f9fa; padding: 50px 0;">
        <div class="container">
            <div class="support-banner-container">
                <!-- Left - Clock Icon with 24/7 Badge -->
                <div class="support-banner-clock">
                    <div class="support-clock-circle">
                        <i class="fas fa-clock"></i>
                    </div>
                    <span class="support-badge-247">24/7</span>
                </div>

                <!-- Center Left - Title and Description -->
                <div class="support-banner-text">
                    <h2>We're Always Here for You</h2>
                    <p>Our dedicated support team is available 24/7 to guide you and your family with all your
                        healthcare needs.</p>
                </div>

                <!-- Center Right - Stats (3 columns) -->
                <div class="support-banner-stats">
                    <div class="support-stat-item">
                        <div class="support-stat-icon-circle">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="support-stat-num">24/7</div>
                        <div class="support-stat-text">Support Available</div>
                    </div>

                    <div class="support-stat-item">
                        <div class="support-stat-icon-circle">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="support-stat-num">15,000+</div>
                        <div class="support-stat-text">Patients Trust Us</div>
                    </div>

                    <div class="support-stat-item">
                        <div class="support-stat-icon-circle">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="support-stat-num">8+ Years</div>
                        <div class="support-stat-text">of Healthcare Trust</div>
                    </div>
                </div>

                <!-- Right - Doctor Image -->
                <!-- <div class="support-banner-doctor">
                                                                                                            <img src="../images/doctor-support.png" alt="Doctor">
                                                                                                        </div> -->
            </div>
        </div>
    </section>

    <!-- FAQs -->
    <section style="background: white; padding: 60px 0;">
        <div class="container">
            <div class="section-header animate">
                <!-- <p class="section-subtitle"></p> -->
                <h2 class="section-title">Frequently Asked Questions</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 ">
                    @foreach ($faqs->take(3) as $faq)
                        <div class="faq-item animate" data-delay="0">
                            <div class="faq-question">
                                <span>{{ $faq->question ?? '' }}</span>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="faq-answer">
                                {{ $faq->answer ?? '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    @foreach ($faqs->skip(3)->take(3) as $faq)
                        <div class="faq-item animate" data-delay="300">
                            <div class="faq-question">
                                <span>{{ $faq->question ?? '' }}</span>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="faq-answer">
                                {{ $faq->answer ?? '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center mt-5">
                <p style="color: #666;">
                    <i class="fas fa-question-circle" style="color: var(--primary-teal);"></i>
                    Still have questions? Call us or send us a message. We're happy to help!
                </p>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.faq-item').click(function() {
                $(this).toggleClass('active');
                $(this).find('.faq-question i').toggleClass('fa-plus fa-minus');
            });
        });
    </script>
@endsection
