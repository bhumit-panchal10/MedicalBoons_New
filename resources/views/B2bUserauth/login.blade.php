@extends('layouts.front')
@section('content')
    <div class="login-container last-admin-section BackGroundColor">
        <div class="login-box text-center">
            <h4 class="login-title">Associated Login</h4>

            <form action="{{ route('B2BUloginstore') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label for="adminEmail" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10"
                        placeholder="Enter Mobile" />
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" />
                </div>

                <!--<div class="mb-3 text-end">-->
                <!--    <a href="#" class="forgot-link">Forgot password?</a>-->
                <!--</div>-->

                <button type="submit" class="btn btn-custom w-100 mb-3">Login</button>

                {{-- <p class="mb-0">
                    Don’t have an account?
                    <a href="#" class="signup-link">Sign up</a>
                </p> --}}
            </form>
        </div>
    </div>
@endsection
