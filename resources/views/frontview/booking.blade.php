@extends('layouts.front')

@section('content')
    <!-- Booking Section - Same layout as reference -->
    <section class="booking-section">
        <div class="container">
            <div class="booking-wrapper">

                <!-- Left Side - Book Now Form -->
                <div class="booking-form-side animate">
                    <h2 class="booking-title"><span class="title-dark">Book</span> <span class="title-accent">Now</span></h2>

                    <form action="#" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan->id ?? '' }}">

                        <div class="booking-form-grid">
                            <!-- Name -->
                            <div class="form-group">
                                <label>Name <span class="required">*</span></label>
                                <input type="text" name="name" class="form-input" placeholder="Enter Your name"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-input" placeholder="Enter Your email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mobile Number -->
                            <div class="form-group">
                                <label>Mobile Number <span class="required">*</span></label>
                                <input type="tel" name="mobile" class="form-input" placeholder="Enter Your number"
                                    value="{{ old('mobile') }}" maxlength="10" required>
                                @error('mobile')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="form-group">
                                <label>Address <span class="required">*</span></label>
                                <input type="text" name="address" class="form-input" placeholder="Enter Your Address"
                                    value="{{ old('address') }}" required>
                                @error('address')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="form-group">
                                <label>State <span class="required">*</span></label>
                                <input type="text" name="state" class="form-input" placeholder="Enter your State"
                                    value="{{ old('state') }}" required>
                                @error('state')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="form-group">
                                <label>City <span class="required">*</span></label>
                                <input type="text" name="city" class="form-input" placeholder="Enter Your City"
                                    value="{{ old('city') }}" required>
                                @error('city')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Pincode -->
                            <div class="form-group">
                                <label>Pincode <span class="required">*</span></label>
                                <input type="text" name="pincode" class="form-input" placeholder="Enter Your Pincode"
                                    value="{{ old('pincode') }}" maxlength="6" required>
                                @error('pincode')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="booking-submit">
                            <button type="submit" class="btn-book-now">Book Now</button>
                        </div>
                    </form>
                </div>

                <!-- Right Side - Plan Details Card -->
                <div class="plan-details-side animate">
                    <div class="plan-details-card">
                        <h2 class="booking-title"><span class="title-dark">Plan</span> <span
                                class="title-accent">Details</span></h2>

                        <div class="plan-details-grid">
                            <!-- Row 1: Plan Name / Plan Amount / Duration Days -->
                            <div class="form-group">
                                <label>Plan Name:</label>
                                <input type="text" id="plan_name" name="plan_name" class="form-input"
                                    value="{{ $plan->name ?? 'Gold Plan' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Plan Amount:</label>
                                <input type="text" id="plan_amount" name="plan_amount" class="form-input"
                                    value="{{ $plan->amount ?? '699' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Duration Days:</label>
                                <input type="text" id="duration_days" name="duration_days" class="form-input"
                                    value="{{ $plan->duration_days ?? '364' }}" readonly>
                            </div>
                        </div>

                        <div class="plan-details-grid two-col">
                            <!-- Row 2: Start Date / End Date -->
                            <div class="form-group">
                                <label>Start Date: <span class="required">*</span></label>
                                <input type="date" id="start_date" name="start_date" class="form-input"
                                    value="{{ old('start_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                                @error('start_date')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>End Date:</label>
                                <input type="text" id="end_date" name="end_date" class="form-input" readonly>
                            </div>

                            <!-- Row 3: Total Member Plan / Extra Member Amount -->
                            <div class="form-group">
                                <label>Total Member Plan:</label>
                                <input type="text" id="total_member" name="total_member" class="form-input"
                                    value="{{ $plan->total_member ?? '2' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Extra Member Amount Per Person:</label>
                                <input type="text" id="extra_member_amount" name="extra_member_amount"
                                    class="form-input" value="{{ $plan->extra_member_amount ?? '300' }}" readonly>
                            </div>

                            <!-- Row 4: Extra Member / Net Amount -->
                            <div class="form-group">
                                <label>Extra Member:</label>
                                <select id="extra_member" name="extra_member" class="form-input">
                                    <option value="">Please Select</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('extra_member') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Net Amount:</label>
                                <input type="text" id="net_amount" name="net_amount" class="form-input"
                                    value="{{ number_format($plan->amount ?? 699, 2, '.', '') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        /* ===== Booking Page - colors follow site header/footer theme ===== */
        :root {
            --booking-primary: #1e3a5f;
            /* dark navy (header / footer CTA) */
            --booking-accent: #2e9e8f;
            /* teal green (logo / phone button) */
            --booking-accent-dark: #23806f;
            /* hover state */
            --booking-bg: #f4f9f8;
            /* light teal-tinted background */
        }

        .booking-section {
            background: var(--booking-bg);
            padding: 50px 0 70px;
            min-height: 60vh;
        }

        .booking-wrapper {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 50px;
            align-items: start;
        }

        .booking-title {
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
        }

        .title-dark {
            color: var(--booking-primary);
        }

        .title-accent {
            color: var(--booking-accent);
        }

        /* --- Form layout --- */
        .booking-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 25px;
            row-gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 7px;
        }

        .required {
            color: #e53935;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d9d9d9;
            border-radius: 6px;
            background: #fff;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .form-input::placeholder {
            color: #9e9e9e;
        }

        .form-input:focus {
            border-color: var(--booking-accent);
        }

        .form-input[readonly] {
            background: #fff;
            cursor: default;
        }

        .error-text {
            color: #e53935;
            font-size: 12px;
            margin-top: 4px;
        }

        .booking-submit {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .btn-book-now {
            background: var(--booking-accent);
            color: #fff;
            border: none;
            padding: 12px 35px;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-book-now:hover {
            background: var(--booking-accent-dark);
        }

        /* --- Plan Details Card --- */
        .plan-details-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px 35px 35px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        }

        .plan-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            column-gap: 20px;
            row-gap: 18px;
            margin-bottom: 18px;
        }

        .plan-details-grid.two-col {
            grid-template-columns: 1fr 1fr;
            margin-bottom: 0;
        }

        /* --- Responsive --- */
        @media (max-width: 991px) {
            .booking-wrapper {
                grid-template-columns: 1fr;
            }

            .plan-details-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 575px) {

            .booking-form-grid,
            .plan-details-grid,
            .plan-details-grid.two-col {
                grid-template-columns: 1fr;
            }

            .booking-submit {
                justify-content: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const extraMemberSelect = document.getElementById('extra_member');
            const netAmountInput = document.getElementById('net_amount');

            const planAmount = parseFloat(document.getElementById('plan_amount').value) || 0;
            const durationDays = parseInt(document.getElementById('duration_days').value) || 0;
            const extraMemberAmount = parseFloat(document.getElementById('extra_member_amount').value) || 0;

            // Calculate End Date = Start Date + Duration Days
            function calculateEndDate() {
                if (!startDateInput.value) {
                    endDateInput.value = '';
                    return;
                }
                const start = new Date(startDateInput.value);
                start.setDate(start.getDate() + durationDays);

                const dd = String(start.getDate()).padStart(2, '0');
                const mm = String(start.getMonth() + 1).padStart(2, '0');
                const yyyy = start.getFullYear();
                endDateInput.value = dd + '/' + mm + '/' + yyyy;
            }

            // Calculate Net Amount = Plan Amount + (Extra Members x Per Person)
            function calculateNetAmount() {
                const extraMembers = parseInt(extraMemberSelect.value) || 0;
                const net = planAmount + (extraMembers * extraMemberAmount);
                netAmountInput.value = net.toFixed(2);
            }

            startDateInput.addEventListener('change', calculateEndDate);
            extraMemberSelect.addEventListener('change', calculateNetAmount);

            // Run on load
            calculateEndDate();
            calculateNetAmount();
        });
    </script>
@endsection
