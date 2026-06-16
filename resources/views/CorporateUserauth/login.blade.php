@extends('layouts.front')

@section('content')
    <style>
        .corporate-login-section {
            background: #f8f9fa;
            padding: 80px 0;
            min-height: 70vh;
            display: flex;
            align-items: center;
        }

        .corporate-login-wrapper {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 50px;
            align-items: center;
        }

        .corporate-login-info {
            background: #fff;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .corporate-login-info .hero-text {
            color: #666;
            margin-bottom: 22px;
        }

        .corporate-login-features {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .corporate-login-features .feature-box {
            justify-content: flex-start;
        }

        .corporate-login-card {
            background: #fff;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .corporate-login-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 8px;
            text-align: center;
        }

        .corporate-login-subtitle {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-bottom: 28px;
        }

        .corporate-form-label {
            font-size: 14px;
            font-weight: 600;
            color: #1e3a5f;
            margin-bottom: 7px;
        }

        .corporate-form-control {
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

        .corporate-form-control:focus {
            border-color: #2d9d91;
            box-shadow: 0 0 0 3px rgba(45, 157, 145, 0.12);
        }

        @media (max-width: 991px) {
            .corporate-login-wrapper {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 575px) {
            .corporate-login-section {
                padding: 50px 0;
            }

            .corporate-login-card,
            .corporate-login-info {
                padding: 25px 20px;
            }

            .corporate-login-title {
                font-size: 24px;
            }
        }
    </style>

    <section class="corporate-login-section">
        <div class="container">
            <div class="corporate-login-wrapper">

                <div class="corporate-login-info animate">
                    <p class="section-subtitle">CORPORATE PORTAL</p>

                    <h1 class="hero-title">
                        Welcome Back,<br>
                        <span class="green">Corporate Partner.</span>
                    </h1>

                    <p class="hero-text">
                        Login to access your corporate account and manage healthcare benefits for your organization.
                    </p>

                    <div class="corporate-login-features">
                        <div class="feature-box">
                            <i class="fas fa-building"></i>
                            <span>Corporate Healthcare Dashboard</span>
                        </div>

                        <div class="feature-box">
                            <i class="fas fa-users"></i>
                            <span>Manage Employee Benefits</span>
                        </div>

                        <div class="feature-box">
                            <i class="fas fa-shield-alt"></i>
                            <span>Secure Organization Access</span>
                        </div>
                    </div>
                </div>

                <div class="corporate-login-card animate">
                    <h3 class="corporate-login-title">Corporate Login</h3>
                    <p class="corporate-login-subtitle">Enter your mobile number and password to continue.</p>

                    <form action="{{ route('loginstore') }}" method="POST">
                        @csrf

                        <div class="mb-3 text-start">
                            <label for="mobile" class="form-label corporate-form-label">Mobile</label>
                            <input type="text" class="form-control corporate-form-control" id="mobile" name="mobile"
                                maxlength="10" placeholder="Enter Mobile" />
                        </div>

                        <div class="mb-4 text-start">
                            <label for="password" class="form-label corporate-form-label">Password</label>
                            <input type="password" class="form-control corporate-form-control" id="password"
                                name="password" placeholder="Enter your password" />
                        </div>

                        <button type="submit" class="btn-primary w-100">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
