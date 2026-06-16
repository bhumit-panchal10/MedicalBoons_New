@extends('layouts.front')

@section('content')
    <style>
        .associated-login-section {
            background: #f8f9fa;
            padding: 80px 0;
            min-height: 70vh;
            display: flex;
            align-items: center;
        }

        .associated-login-wrapper {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 50px;
            align-items: center;
        }

        .associated-login-card {
            background: #fff;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .associated-login-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 8px;
            text-align: center;
        }

        .associated-login-subtitle {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-bottom: 28px;
        }

        .associated-form-label {
            font-size: 14px;
            font-weight: 600;
            color: #1e3a5f;
            margin-bottom: 7px;
        }

        .associated-form-control {
            width: 100%;
            height: 46px;
            border: 1px solid #d9e3e0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            color: #333;
            background: #fff;
            outline: none;
            transition: all 0.2s ease;
        }

        .associated-form-control:focus {
            border-color: #2d9d91;
            box-shadow: 0 0 0 3px rgba(45, 157, 145, 0.12);
        }

        .associated-login-info {
            background: #fff;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .associated-login-info .hero-text {
            color: #666;
            margin-bottom: 22px;
        }

        .associated-login-features {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .associated-login-features .feature-box {
            justify-content: flex-start;
        }

        @media (max-width: 991px) {
            .associated-login-wrapper {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 575px) {
            .associated-login-section {
                padding: 50px 0;
            }

            .associated-login-card,
            .associated-login-info {
                padding: 25px 20px;
            }

            .associated-login-title {
                font-size: 24px;
            }
        }
    </style>

    <section class="associated-login-section">
        <div class="container">
            <div class="associated-login-wrapper">

                <div class="associated-login-info animate">
                    <p class="section-subtitle">ASSOCIATE PORTAL</p>

                    <h1 class="hero-title">
                        Welcome Back,<br>
                        <span class="green">Associate Partner.</span>
                    </h1>

                    <p class="hero-text">
                        Login to access your associate account and manage your connected members with Medical Boons.
                    </p>

                    <div class="associated-login-features">
                        <div class="feature-box">
                            <i class="fas fa-shield-alt"></i>
                            <span>Secure Login Access</span>
                        </div>

                        <div class="feature-box">
                            <i class="fas fa-users"></i>
                            <span>Manage Associated Members</span>
                        </div>

                        <div class="feature-box">
                            <i class="fas fa-handshake"></i>
                            <span>Trusted Healthcare Partnership</span>
                        </div>
                    </div>
                </div>

                <div class="associated-login-card animate">
                    <h4 class="associated-login-title">Associated Login</h4>
                    <p class="associated-login-subtitle">Enter your mobile number and password to continue.</p>

                    <form action="{{ route('B2BUloginstore') }}" method="POST">
                        @csrf

                        <div class="mb-3 text-start">
                            <label for="mobile" class="form-label associated-form-label">Mobile</label>
                            <input type="text" class="form-control associated-form-control" id="mobile" name="mobile"
                                maxlength="10" placeholder="Enter Mobile" />
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label associated-form-label">Password</label>
                            <input type="password" class="form-control associated-form-control" id="password"
                                name="password" placeholder="Enter your password" />
                        </div>

                        <button type="submit" class="btn-primary w-100 mt-2">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
