@extends('layouts.front')
@section('content')
    <style>
        .plan-detail-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .plan-price {
            font-size: 48px;
            font-weight: 700;
            color: var(--primary-teal);
            margin: 20px 0;
        }

        .plan-price span {
            font-size: 24px;
            color: #666;
        }

        .benefits-list {
            list-style: none;
            padding: 0;
        }

        .benefits-list li {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .benefits-list li:last-child {
            border-bottom: none;
        }

        .benefits-list i {
            color: var(--primary-teal);
            font-size: 18px;
        }

        .value-box {
            background: linear-gradient(135deg, #e8f5f3, #d4ede9);
            padding: 25px;
            border-radius: 15px;
            margin-top: 25px;
        }

        .value-box h4 {
            color: var(--primary-teal);
            margin-bottom: 15px;
            font-size: 18px;
        }

        .comparison-table {
            width: 100%;
            margin-top: 30px;
        }

        .comparison-table th {
            background: var(--primary-teal);
            color: white;
            padding: 15px;
            text-align: center;
        }

        .comparison-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        .comparison-table tr:nth-child(even) {
            background: #f8f9fa;
        }
    </style>

    <style>
        /* ============================================
                   NEW PLAN CARDS DESIGN
                   ============================================ */

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 50px;
        }

        .plan-card-new {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 20px;
            padding: 30px 25px;
            position: relative;
            transition: all 0.3s ease;
        }

        .plan-card-new:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Featured Plan */
        .plan-card-new.featured-new {
            border-color: #f5a623;
            border-width: 3px;
        }

        /* Recommended Badge */
        .recommended-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #f5a623;
            color: white;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .recommended-badge i {
            font-size: 10px;
        }

        /* Plan Header */
        .plan-header-new {
            text-align: center;
            margin-bottom: 25px;
        }

        .plan-shield-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            position: relative;
        }

        .plan-shield-icon.silver {
            background: linear-gradient(135deg, #e8f5f3, #d4ede9);
        }

        .plan-shield-icon.gold {
            background: linear-gradient(135deg, #e8f5f3, #d4ede9);
        }

        .plan-shield-icon.platinum {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        }

        .plan-shield-icon i.fa-gem {
            font-size: 35px;
            color: #9b59b6;
        }

        .plan-shield-icon i.fa-star {
            font-size: 35px;
            color: #2d9d91;
        }

        .plan-shield-icon i.fa-crown {
            font-size: 35px;
            color: #f5a623;
        }

        .plan-shield-icon.platinum i.fa-shield-alt {
            color: #3498db;
        }

        .plan-plus-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            font-size: 16px !important;
            background: white;
            border-radius: 50%;
            padding: 3px;
            color: #2d9d91 !important;
        }

        .plan-name-new {
            font-size: 20px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 8px;
        }

        .plan-tagline {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
            margin: 0;
        }

        /* Plan Price */
        .plan-price-new {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #f0f0f0;
        }

        .plan-price-new .currency {
            font-size: 24px;
            font-weight: 700;
            color: #2d9d91;
            vertical-align: top;
        }

        .plan-price-new .amount {
            font-size: 42px;
            font-weight: 700;
            color: #2d9d91;
        }

        .plan-price-new .period {
            font-size: 16px;
            color: #666;
        }

        /* Best Suited Section */
        .best-suited-section {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .best-suited-icon {
            width: 35px;
            height: 35px;
            background: #e8f5f3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .best-suited-icon i {
            font-size: 16px;
            color: #2d9d91;
        }

        .best-suited-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e3a5f;
            margin: 0 0 8px 0;
        }

        .suited-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .suited-list li {
            font-size: 13px;
            color: #666;
            line-height: 1.8;
            position: relative;
            padding-left: 12px;
        }

        .suited-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #2d9d91;
        }

        /* Includes Section */
        .includes-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .includes-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e3a5f;
            margin: 0 0 12px 0;
        }

        .includes-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .includes-list li {
            font-size: 13px;
            color: #666;
            line-height: 2;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .includes-list i {
            color: #2d9d91;
            font-size: 14px;
            margin-top: 3px;
            flex-shrink: 0;
        }

        /* Healthcare Value Box */
        .healthcare-value-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .healthcare-value-box h4 {
            font-size: 13px;
            font-weight: 600;
            color: #666;
            margin: 0 0 8px 0;
        }

        .value-amount {
            font-size: 22px;
            font-weight: 700;
            color: #2d9d91;
            margin: 0;
        }

        .value-amount span {
            font-size: 14px;
            color: #666;
            font-weight: 400;
        }

        /* Add-On Member Box */
        .addon-member-box {
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .addon-icon {
            width: 35px;
            height: 35px;
            background: #2d9d91;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .addon-icon i {
            font-size: 16px;
            color: white;
        }

        .addon-text {
            flex: 1;
        }

        .addon-label {
            font-size: 12px;
            color: #666;
            margin: 0 0 3px 0;
        }

        .addon-price {
            font-size: 16px;
            font-weight: 700;
            color: #1e3a5f;
            margin: 0;
        }

        .addon-price span {
            font-size: 12px;
            font-weight: 400;
            color: #666;
        }

        /* Coverage Info */
        .coverage-info {
            background: #e0f7f4;
            padding: 12px 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            font-size: 12px;
            color: #1e3a5f;
            font-weight: 600;
        }

        .coverage-info i {
            color: #2d9d91;
            margin-right: 3px;
        }

        .coverage-info .separator {
            color: #ccc;
        }

        /* Plans Info Note */
        .plans-info-note {
            background: #e3f2fd;
            padding: 20px 25px;
            border-radius: 15px;
            margin-top: 40px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .plans-info-note i {
            font-size: 24px;
            color: #3498db;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .plans-info-note p {
            font-size: 14px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .plans-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }


        /* ============================================
                   FAQs SECTION - NEW DESIGN
                   ============================================ */

        /* FAQs Header */
        .faqs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .faqs-title {
            font-size: 32px;
            font-weight: 700;
            color: #1e3a5f;
            margin: 0;
        }

        .view-all-faqs {
            color: #2d9d91;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .view-all-faqs:hover {
            gap: 12px;
            color: #1e7d72;
        }

        .view-all-faqs i {
            font-size: 14px;
        }

        /* FAQs Grid - 2 Columns */
        .faqs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        /* FAQ Item */
        .faq-item-new {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 0;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .faq-item-new:hover {
            border-color: #2d9d91;
            box-shadow: 0 5px 20px rgba(45, 157, 145, 0.1);
        }

        /* FAQ Question */
        .faq-question-new {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .faq-item-new:hover .faq-question-new {
            background: #f8f9fa;
        }

        /* FAQ Icon Box */
        .faq-icon-box {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .faq-icon-box.teal {
            background: #e0f7f4;
        }

        .faq-icon-box i {
            font-size: 20px;
            color: #2d9d91;
        }

        /* FAQ Text */
        .faq-text {
            flex: 1;
            font-size: 16px;
            font-weight: 600;
            color: #1e3a5f;
            line-height: 1.5;
        }

        /* FAQ Toggle Button */
        .faq-toggle-btn {
            width: 32px;
            height: 32px;
            background: transparent;
            border: 2px solid #1e3a5f;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .faq-toggle-btn i {
            font-size: 14px;
            color: #1e3a5f;
            transition: all 0.3s ease;
        }

        .faq-toggle-btn:hover {
            background: #2d9d91;
            border-color: #2d9d91;
        }

        .faq-toggle-btn:hover i {
            color: white;
        }

        /* FAQ Answer (Hidden by default) */
        .faq-answer-new {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .faq-answer-new p {
            padding: 0 25px 25px 85px;
            margin: 0;
            font-size: 14px;
            color: #666;
            line-height: 1.8;
        }

        /* Active State */
        .faq-item-new.active .faq-answer-new {
            max-height: 500px;
        }

        .faq-item-new.active .faq-toggle-btn {
            background: #2d9d91;
            border-color: #2d9d91;
            transform: rotate(45deg);
        }

        .faq-item-new.active .faq-toggle-btn i {
            color: white;
        }

        .faq-item-new.active {
            border-color: #2d9d91;
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .faqs-grid {
                grid-template-columns: 1fr;
            }

            .faqs-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .faqs-title {
                font-size: 26px;
            }

            .faq-text {
                font-size: 15px;
            }

            .faq-answer-new p {
                padding: 0 20px 20px 20px;
                font-size: 13px;
            }
        }
    </style>

    <!-- Plans Hero -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left animate">
                    <p class="section-subtitle">OUR PLANS</p>
                    <h1 class="hero-title">
                        Healthcare Support Plans <span class="green">For Your Family</span>
                    </h1>
                    <p class="hero-text">
                        Choose the plan that's right for your family and enjoy priority support, savings and peace of
                        mind.
                    </p>
                    <div class="hero-features">
                        <div class="feature-box">
                            <i class="fas fa-shield-alt"></i>
                            <span>Trusted Guidance</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-hand-holding-heart"></i>
                            <span>Priority Support</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-gift"></i>
                            <span>Exclusive Benefits</span>
                        </div>
                        <div class="feature-box">
                            <i class="fas fa-medal"></i>
                            <span>Great Value</span>
                        </div>
                    </div>
                    <div
                        style="background: #f8f9fa; padding: 18px 20px; border-radius: 10px; margin-top: 20px; display: flex; align-items: center; gap: 15px;">
                        <div
                            style="width: 45px; height: 45px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-shield-alt" style="color: var(--primary-teal); font-size: 22px;"></i>
                        </div>
                        <p style="margin: 0; color: #666; font-size: 15px; line-height: 1.6;">
                            All plans include access to our complete ecosystem of healthcare services and support.
                        </p>
                    </div>
                </div>
                <div class="hero-right animate">
                    <img alt="Family Healthcare" class="hero-image"
                        src="{{ asset('Front/images/plans-hero-family.jpg') }}" />
                </div>
            </div>
        </div>
    </section>
    <!-- Choose Your Plan -->
    <section style="background: white; padding: 60px 0;">
        <div class="container">
            <div class="section-header animate">
                <h2 class="section-title">CHOOSE THE PLAN THAT SUITS YOU BEST</h2>
            </div>

            <div class="plans-grid">
                <!-- Silver Plan -->
                <div class="plan-card-new animate" data-delay="0">
                    <!-- Plan Header with Shield Icon -->
                    <div class="plan-header-new">
                        <div class="plan-shield-icon silver">
                            <i class="fas fa-star"></i>
                            <!-- <i class="fas fa-plus plan-plus-icon"></i> -->
                        </div>
                        <h3 class="plan-name-new">SILVER CARE</h3>
                        <p class="plan-tagline">For preventive and everyday healthcare support.</p>
                    </div>

                    <!-- Plan Price -->
                    <div class="plan-price-new">
                        <span class="currency">₹</span>
                        <span class="amount">499</span>
                        <span class="period">/ year</span>
                    </div>

                    <!-- Best Suited For -->
                    <div class="best-suited-section">
                        <div class="best-suited-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h4 class="best-suited-title">Best suited for</h4>
                            <ul class="suited-list">
                                <li>Young families</li>
                                <li>Healthy individuals</li>
                                <li>Preventive healthcare focus</li>
                                <li>Routine healthcare seekers</li>
                                <li>All Services Accessible</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Includes Section -->
                    <div class="includes-section">
                        <h4 class="includes-title">Includes</h4>
                        <ul class="includes-list">
                            <li><i class="fas fa-check-circle"></i> Access to all Medical Boons services</li>
                            <li><i class="fas fa-check-circle"></i> Consultation & diagnostics support</li>
                            <li><i class="fas fa-check-circle"></i> Preventive healthcare assistance</li>
                            <li><i class="fas fa-check-circle"></i> Wellness support access</li>
                            <li><i class="fas fa-check-circle"></i> Standard care coordination</li>
                        </ul>
                    </div>

                    <!-- Healthcare Value Support -->
                    <div class="healthcare-value-box">
                        <h4>Healthcare Value Support</h4>
                        <p class="value-amount">Up to ₹10,000 <span>/ year</span></p>
                    </div>

                    <!-- Add-On Member -->
                    <div class="addon-member-box">
                        <div class="addon-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="addon-text">
                            <p class="addon-label">Add-On Member</p>
                            <p class="addon-price">₹100 <span>per additional member</span></p>
                        </div>
                    </div>

                    <!-- Coverage Info -->
                    <div class="coverage-info">
                        <span><i class="fas fa-users"></i> Covers up to 4 members</span>
                        <span class="separator">|</span>
                        <span><i class="fas fa-calendar-check"></i> 1 Year validity</span>
                    </div>
                </div>

                <!-- Gold Plan -->
                <div class="plan-card-new featured-new animate" data-delay="100">
                    <!-- Recommended Badge -->
                    <div class="recommended-badge">
                        <i class="fas fa-star"></i> RECOMMENDED
                    </div>

                    <!-- Plan Header with Shield Icon -->
                    <div class="plan-header-new">
                        <div class="plan-shield-icon gold">
                            <i class="fas  fa-crown"></i>
                            <!-- <i class="fas fa-plus plan-plus-icon"></i> -->
                        </div>
                        <h3 class="plan-name-new">GOLD CARE</h3>
                        <p class="plan-tagline">Enhanced healthcare coordination with personalized preventive healthcare
                            support.</p>
                    </div>

                    <!-- Plan Price -->
                    <div class="plan-price-new">
                        <span class="currency">₹</span>
                        <span class="amount">999</span>
                        <span class="period">/ year</span>
                    </div>

                    <!-- Best Suited For -->
                    <div class="best-suited-section">
                        <div class="best-suited-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h4 class="best-suited-title">Best suited for</h4>
                            <ul class="suited-list">
                                <li>Families with elderly members</li>
                                <li>Diabetes, BP, thyroid, heart-risk monitoring</li>
                                <li>Regular medication follow-up</li>
                                <li>Frequent health check requirements</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Includes Section -->
                    <div class="includes-section">
                        <h4 class="includes-title">Includes</h4>
                        <ul class="includes-list">
                            <li><i class="fas fa-check-circle"></i> Access to all Medical Boons services</li>
                            <li><i class="fas fa-check-circle"></i> Priority healthcare coordination</li>
                            <li><i class="fas fa-check-circle"></i> Personalized preventive health profiles</li>
                            <li><i class="fas fa-check-circle"></i> Regular diagnostics & wellness support</li>
                            <li><i class="fas fa-check-circle"></i> Enhanced healthcare assistance</li>
                        </ul>
                    </div>

                    <!-- Healthcare Value Support -->
                    <div class="healthcare-value-box">
                        <h4>Healthcare Value Support</h4>
                        <p class="value-amount">Up to ₹20,000 <span>/ year</span></p>
                    </div>

                    <!-- Add-On Member -->
                    <div class="addon-member-box">
                        <div class="addon-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="addon-text">
                            <p class="addon-label">Add-On Member</p>
                            <p class="addon-price">₹200 <span>per additional member</span></p>
                        </div>
                    </div>

                    <!-- Coverage Info -->
                    <div class="coverage-info">
                        <span><i class="fas fa-users"></i> Covers upto 4 members</span>
                        <span class="separator">|</span>
                        <span><i class="fas fa-calendar-check"></i> 1 Year validity</span>
                    </div>
                </div>

                <!-- Platinum Plan -->
                <div class="plan-card-new animate" data-delay="200">
                    <!-- Plan Header with Shield Icon -->
                    <div class="plan-header-new">
                        <div class="plan-shield-icon platinum">
                            <i class="fas fa-gem"></i>
                            <!-- <i class="fas fa-plus plan-plus-icon"></i> -->
                        </div>
                        <h3 class="plan-name-new">PLATINUM CARE</h3>
                        <p class="plan-tagline">Advanced healthcare monitoring & coordinated family support.</p>
                    </div>

                    <!-- Plan Price -->
                    <div class="plan-price-new">
                        <span class="currency">₹</span>
                        <span class="amount">1,499</span>
                        <span class="period">/ year</span>
                    </div>

                    <!-- Best Suited For -->
                    <div class="best-suited-section">
                        <div class="best-suited-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h4 class="best-suited-title">Best suited for</h4>
                            <ul class="suited-list">
                                <li>Families needing regular health monitoring</li>
                                <li>Chronic illness-based testing</li>
                                <li>Continuous healthcare tracking</li>
                                <li>Coordinated care scheduling support</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Includes Section -->
                    <div class="includes-section">
                        <h4 class="includes-title">Includes</h4>
                        <ul class="includes-list">
                            <li><i class="fas fa-check-circle"></i> Access to all Medical Boons services</li>
                            <li><i class="fas fa-check-circle"></i> Dedicated support coordination</li>
                            <li><i class="fas fa-check-circle"></i> Personalized preventive health profiles</li>
                            <li><i class="fas fa-check-circle"></i> Advanced wellness & monitoring support</li>
                            <li><i class="fas fa-check-circle"></i> Priority healthcare assistance</li>
                        </ul>
                    </div>

                    <!-- Healthcare Value Support -->
                    <div class="healthcare-value-box">
                        <h4>Healthcare Value Support</h4>
                        <p class="value-amount">Up to ₹30,000 <span>/ year</span></p>
                    </div>

                    <!-- Add-On Member -->
                    <div class="addon-member-box">
                        <div class="addon-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="addon-text">
                            <p class="addon-label">Add-On Member</p>
                            <p class="addon-price">₹300 <span>per additional member</span></p>
                        </div>
                    </div>

                    <!-- Coverage Info -->
                    <div class="coverage-info">
                        <span><i class="fas fa-users"></i> Covers up to 4 members</span>
                        <span class="separator">|</span>
                        <span><i class="fas fa-calendar-check"></i> 1 Year validity</span>
                    </div>
                </div>
            </div>

            <!-- Info Note -->
            <div class="plans-info-note">
                <i class="fas fa-info-circle"></i>
                <p>Healthcare Value Support can be utilized across eligible healthcare benefits, wellness support
                    services, and applicable Lab Wallet benefits as per plan eligibility.</p>
            </div>
        </div>
    </section>

    <!-- FAQs Section -->
    <section style="background: #f8f9fa; padding: 80px 0;">
        <div class="container">
            <!-- Header with View All Link -->
            <div class="faqs-header">
                <h2 class="faqs-title">Frequently Asked Questions</h2>
                <!-- <a href="#" class="view-all-faqs">
                                    View all FAQs <i class="fas fa-arrow-right"></i>
                                </a> -->
            </div>

            <!-- FAQs Grid (2 columns) -->
            <div class="faqs-grid">
                <!-- FAQ Item 1 -->
                <div class="faq-item-new">
                    <div class="faq-question-new">
                        <div class="faq-icon-box teal">
                            <i class="fas fa-hand-holding-medical"></i>
                        </div>
                        <span class="faq-text">What is Healthcare Value Support?</span>
                        <button class="faq-toggle-btn">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="faq-answer-new">
                        <p>Healthcare Value Support is the cumulative annual value of complementary healthcare benefits,
                            wellness support services, and Lab Wallet benefits you receive as per your plan eligibility.
                            This support can be utilized across eligible services throughout the year.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item-new">
                    <div class="faq-question-new">
                        <div class="faq-icon-box teal">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="faq-text">How many members are covered?</span>
                        <button class="faq-toggle-btn">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="faq-answer-new">
                        <p>All plans cover up to 4 family members by default. You can add additional members by paying
                            the Add-On Member fee specified in your plan. Each plan has different pricing for add-on
                            members.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item-new">
                    <div class="faq-question-new">
                        <div class="faq-icon-box teal">
                            <i class="fas fa-flask"></i>
                        </div>
                        <span class="faq-text">How are Lab Wallet benefits utilized?</span>
                        <button class="faq-toggle-btn">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="faq-answer-new">
                        <p>Lab Wallet benefits are part of your Healthcare Value Support and can be used for eligible
                            diagnostic tests, lab tests, and health checkups at our partner facilities. The benefits are
                            automatically applied when you book services through Medical Boons.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item-new">
                    <div class="faq-question-new">
                        <div class="faq-icon-box teal">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <span class="faq-text">Can additional family members be added to the plan?</span>
                        <button class="faq-toggle-btn">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="faq-answer-new">
                        <p>Yes. All Medical Boons plans cover up to 4 family members. Additional family members can be added
                            to the membership plan at applicable add-on charges based on the selected plan category.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Plan Comparison -->

    <!-- Testimonials Section -->
    <section class="testimonials-section" style="padding:50px 0">
        <div class="container">
            <div class="section-header mb-2 animate">
                <p class="section-subtitle">THE TRUST OF THOUSANDS OF FAMILIES</p>
                <h2 class="section-title">We're Rated 4.9/5</h2>
                <p style="color: #666; margin-bottom: 20px;">By Our Members</p>
            </div>

            <!-- Testimonials Slider -->
            <div class="testimonials-slider">
                <div class="testimonial-track">
                    <!-- Testimonial 1 -->
                    <div class="testimonial-card animate" data-delay="0">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Medical Boons has been a lifesaving for our family. Their team guided us at every step.
                            Highly reliable and trustworthy service."
                        </p>
                        <div class="testimonial-author">
                            <img src="https://i.pravatar.cc/60?img=1" alt="Ravi Sharma" class="author-image">
                            <div class="author-info">
                                <p class="author-name">— Ravi Sharma</p>
                                <p class="author-title">Family Plan Member</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="testimonial-card animate" data-delay="100">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Excellent support during my father's hospitalization. The care coordinator was with us
                            throughout. Very professional service."
                        </p>
                        <div class="testimonial-author">
                            <img src="https://i.pravatar.cc/60?img=5" alt="Priya Mehta" class="author-image">
                            <div class="author-info">
                                <p class="author-name">— Priya Mehta</p>
                                <p class="author-title">Gold Plan Member</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="testimonial-card animate" data-delay="200">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Their insurance claim support saved us so much hassle. The team handled everything
                            professionally. Highly recommended!"
                        </p>
                        <div class="testimonial-author">
                            <img src="https://i.pravatar.cc/60?img=8" alt="Amit Patel" class="author-image">
                            <div class="author-info">
                                <p class="author-name">— Amit Patel</p>
                                <p class="author-title">Platinum Plan Member</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="testimonial-card animate" data-delay="0">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Best healthcare support service! Their 24/7 helpline is very responsive. My entire family
                            is covered under their plan."
                        </p>
                        <div class="testimonial-author">
                            <img src="https://i.pravatar.cc/60?img=12" alt="Sunita Kapoor" class="author-image">
                            <div class="author-info">
                                <p class="author-name">— Sunita Kapoor</p>
                                <p class="author-title">Silver Plan Member</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 5 -->
                    <div class="testimonial-card animate" data-delay="100">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Medical Boons made finding the right doctors so easy. Their network is excellent and staff
                            is very helpful. Great experience!"
                        </p>
                        <div class="testimonial-author">
                            <img src="https://i.pravatar.cc/60?img=15" alt="Rajesh Kumar" class="author-image">
                            <div class="author-info">
                                <p class="author-name">— Rajesh Kumar</p>
                                <p class="author-title">Gold Plan Member</p>
                            </div>
                        </div>
                    </div>
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

            <!-- Overall Rating -->

        </div>
    </section>
    <!-- Why Choose Membership -->
    <!-- CTA -->
    <section class="footer-cta">
        <div class="container">
            <h2>Start Your Healthcare Journey Today</h2>
            <p>Choose your plan and get expert guidance and support.</p>
            <div class="footer-cta-buttons">
                <a class="btn-primary" href="contact.html" style="background: white; color: #1e3a5f;">
                    <i class="fas fa-gift"></i>
                    Choose Your Plan
                </a>
                <a class="btn-secondary" href="tel:+918655774949">
                    <i class="fas fa-phone"></i>
                    Talk to Expert
                </a>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        // FAQ Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item-new');

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question-new');

                question.addEventListener('click', function() {
                    // Close all other FAQs
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                        }
                    });

                    // Toggle current FAQ
                    item.classList.toggle('active');
                });
            });
        });
    </script>
@endsection
