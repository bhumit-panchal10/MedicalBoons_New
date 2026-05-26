@extends('layouts.front')

@section('content')
<style>
    .color{
        color:red;
    }
</style>

         
        <section class="py-2 bg-light BackGroundColor" id="contact-us">
            <div class="container">
                 <h2 class="fw-bold text-center mb-5">
                <span class="text-forest">Registration for</span>
                <span class="text-pink">
                    {{ $Companyname->companyname->company_name ?? '' }} Members Only</span>
            </h2>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

    
                <div class="row align-items-center justify-content-center">
                    <!-- Contact Form -->
                    <div class="col-md-9">    
                        <form action="{{ route('Corporate_Order.Memberstore', $guid) }}" class="mt-10" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="username-field" class="inline-block mb-2 text-base font-medium">Name <span
                                class="color"> *</span></label>
                        <input type="text" name="name" id="username-field"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter name" required>
                        @error('name')
                             <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">Email <span
                                class="color"> *</span></label>
                        <input type="text" name="email" id="email-field"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter email" required>
                        @error('email')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
    
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">Mobile No <span
                                class="color"> *</span></label>
                        <input type="text" name="mobile_no" id="email-field"
                            class="form-control @error('mobile_no') is-invalid @enderror"
                            placeholder="Enter Mobile No" maxlength="10" required>
                         @error('mobile_no')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
    
                    <div class="col-md-6 mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">State<span
                                class="color"> *</span></label>
                        <input type="text" name="state" id="email-field"
                            class="form-control @error('state') is-invalid @enderror"
                            placeholder="Enter State" maxlength="10" required>
                        @error('state')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
    
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">City <span
                                class="color"> *</span></label>
                        <input type="text" name="city" id="email-field"
                            class="form-control @error('city') is-invalid @enderror"
                            placeholder="Enter City" required>
                        @error('city')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">Pincode <span
                                class="color"> *</span></label>
                        <input type="number" name="pincode" id="email-field"
                            class="form-control @error('pincode') is-invalid @enderror"
                            placeholder="Enter Pincode" required>
                        @error('pincode')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
    
                    <div class="mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">Address <span
                                class="color"> *</span></label>
                        <input type="text" name="address" id="email-field"
                            class="form-control @error('address') is-invalid @enderror"
                            placeholder="Enter Address" required>
                        @error('address')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    
                    
                     <button type="submit" class="btn btn-success text-white rounded-pill px-4 py-2">
                            Sign In
                     </button>
    
    
                </form>
                    </div>
                </div>
            </div>
        </section>
        

@endsection
