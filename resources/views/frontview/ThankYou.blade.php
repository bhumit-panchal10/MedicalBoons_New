@extends('layouts.front')

@section('content')
    <style>
        .thankyou-section {
            min-height: calc(100vh - 110px);
            padding: 90px 0;
            background: linear-gradient(135deg, #eefaf8 0%, #ffffff 55%, #f6fbff 100%);
            display: flex;
            align-items: center;
        }

        .thankyou-section .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .thankyou-card {
            max-width: 760px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 28px;
            padding: 55px 45px;
            text-align: center;
            box-shadow: 0 18px 45px rgba(34, 52, 91, 0.12);
            position: relative;
            overflow: hidden;
        }

        .thankyou-card::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            background: rgba(68, 166, 151, 0.12);
            border-radius: 50%;
            top: -80px;
            right: -80px;
        }

        .thankyou-card::after {
            content: "";
            position: absolute;
            width: 170px;
            height: 170px;
            background: rgba(37, 63, 111, 0.08);
            border-radius: 50%;
            bottom: -70px;
            left: -70px;
        }

        .thankyou-icon {
            width: 92px;
            height: 92px;
            background: #44a697;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            font-size: 40px;
            box-shadow: 0 12px 28px rgba(68, 166, 151, 0.35);
            position: relative;
            z-index: 1;
        }

        .thankyou-badge {
            display: inline-block;
            background: #f4fbfa;
            color: #44a697;
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .thankyou-card h1 {
            color: #253f6f;
            font-size: 46px;
            font-weight: 800;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .thankyou-card p {
            color: #666666;
            font-size: 18px;
            line-height: 1.8;
            max-width: 620px;
            margin: 0 auto 32px;
            position: relative;
            z-index: 1;
        }

        .thankyou-card p strong {
            color: #253f6f;
        }

        .thankyou-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 34px;
            position: relative;
            z-index: 1;
        }

        .thankyou-info-box {
            background: #f8fbfc;
            border: 1px solid #edf2f4;
            border-radius: 18px;
            padding: 20px;
            display: flex;
            align-items: center;
            text-align: left;
            gap: 15px;
        }

        .thankyou-info-box i {
            width: 48px;
            height: 48px;
            background: #44a697;
            color: #ffffff;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .thankyou-info-box h4 {
            color: #253f6f;
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .thankyou-info-box a,
        .thankyou-info-box span {
            color: #666666;
            font-size: 14px;
            text-decoration: none;
        }

        .thankyou-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            position: relative;
            z-index: 1;
        }

        .btn-home,
        .btn-services {
            padding: 14px 30px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-home {
            background: #253f6f;
            color: #ffffff;
        }

        .btn-services {
            background: #44a697;
            color: #ffffff;
        }

        .btn-home:hover,
        .btn-services:hover {
            transform: translateY(-3px);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(37, 63, 111, 0.18);
        }

        @media (max-width: 767px) {
            .thankyou-section {
                padding: 55px 0;
                min-height: auto;
            }

            .thankyou-card {
                padding: 40px 22px;
                border-radius: 22px;
            }

            .thankyou-card h1 {
                font-size: 34px;
            }

            .thankyou-card p {
                font-size: 16px;
            }

            .thankyou-info {
                grid-template-columns: 1fr;
            }

            .thankyou-buttons {
                flex-direction: column;
            }

            .btn-home,
            .btn-services {
                width: 100%;
                display: block;
            }
        }
    </style>
    <section class="thankyou-section">
        <div class="container">
            <div class="thankyou-card">

                <div class="thankyou-icon">
                    <i class="fas fa-check"></i>
                </div>

                <span class="thankyou-badge">Request Submitted Successfully</span>

                <h1>Thank You!</h1>

                <p>
                    Thank you for contacting <strong>Medical Boons</strong>.
                    Our healthcare support team has received your request and will connect with you shortly.
                </p>

                <div class="thankyou-info">
                    <div class="thankyou-info-box">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <h4>Need Immediate Help?</h4>
                            <a href="tel:+919974660451">+91 99746 60451</a>
                        </div>
                    </div>

                    <div class="thankyou-info-box">
                        <i class="fas fa-user-md"></i>
                        <div>
                            <h4>Healthcare Assistance</h4>
                            <span>Doctor, Lab, Scan, Homecare & More</span>
                        </div>
                    </div>
                </div>

                <div class="thankyou-buttons">
                    <a href="{{ route('Front.index') }}" class="btn-home">
                        Back to Home
                    </a>

                    <a href="{{ route('Front.Service') }}" class="btn-services">
                        Explore Services
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection
