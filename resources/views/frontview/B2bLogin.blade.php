@extends('layouts.front')
@section('content')
    <div class="login-container last-admin-section BackGroundColor">
        <div class="login-box text-center">
            <h4 class="login-title">Welcome Back</h4>

            <form>
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" />
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" />
                </div>

                <div class="mb-3 text-end">
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-custom w-100 mb-3">Login</button>

                <p class="mb-0">
                    Don’t have an account?
                    <a href="#" class="signup-link">Sign up</a>
                </p>
            </form>
        </div>
    </div>
@endsection
