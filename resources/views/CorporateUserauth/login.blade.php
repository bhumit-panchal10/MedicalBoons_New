@extends('layouts.front')
@section('content')
    <div class="adminBodySec adminstyle">

        <div class="admin-login-card text-center last-admin-section ">
            <h3>Corporate Login</h3>
            {{-- <p class="mb-4">Secure access to your admin dashboard</p> --}}

            <form action="{{ route('loginstore') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label for="adminEmail" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10"
                        placeholder="Enter Mobile" />
                </div>

                <div class="mb-4 text-start">
                    <label for="adminPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" />
                </div>

                <!--<div class="mb-3 text-end">-->
                <!--    <a href="#" class="forgot-password">Forgot password?</a>-->
                <!--</div>-->

                <button type="submit" class="btn btn-admin w-100">Login</button>
            </form>
        </div>
    </div>
@endsection
