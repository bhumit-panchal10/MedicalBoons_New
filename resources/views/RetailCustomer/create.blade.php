@extends('layouts.app')

@section('title', 'Add Member Plan')

@section('content')

    {!! Toastr::message() !!}

    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Add Member Plan</h5>
                </div>

                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Master Entry</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Add Member Plan
                    </li>
                </ul>
            </div>

            <div class="card" id="customerList">
                <div class="card-body">

                    <div class="bg-white shadow rounded-md dark:bg-zink-600">
                        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                            <h5 class="text-16">Add Member Plan</h5>

                            <a href="{{ route('Retail_Customer.index') }}"
                                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                Back
                            </a>
                        </div>

                        <div class="p-4">
                            <form class="tablelist-form" action="{{ route('Retail_Customer.store') }}" method="POST">
                                @csrf

                                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                                    <div class="xl:col-span-6">
                                        <label>Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="name" maxlength="150"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter Name" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="xl:col-span-6">
                                        <label>Email</label>
                                        <input type="email" name="email"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter Email" value="{{ old('email') }}">
                                    </div>

                                    <div class="xl:col-span-6">
                                        <label>Mobile <span class="text-red-500">*</span></label>
                                        <input type="text" name="mobile" maxlength="10"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter Mobile" value="{{ old('mobile') }}" required>
                                    </div>

                                    <div class="xl:col-span-6">
                                        <label>Address <span class="text-red-500">*</span></label>
                                        <input type="text" name="address"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter Address" value="{{ old('address') }}" required>
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>State <span class="text-red-500">*</span></label>
                                        <input type="text" name="state"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter State" value="{{ old('state') }}" required>
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>City <span class="text-red-500">*</span></label>
                                        <input type="text" name="city"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter City" value="{{ old('city') }}" required>
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>Pincode <span class="text-red-500">*</span></label>
                                        <input type="text" name="pincode" maxlength="6"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Enter Pincode" value="{{ old('pincode') }}" required>
                                    </div>

                                    <div class="xl:col-span-6">
                                        <label>Plan <span class="text-red-500">*</span></label>
                                        <select name="plan_id" id="plan_id"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            required>
                                            <option value="">Select Plan</option>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="xl:col-span-6">
                                        <label>Plan Amount</label>
                                        <input type="text" id="plan_amount" readonly
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>Duration Days</label>
                                        <input type="text" id="duration_days" readonly
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>Total Member Plan</label>
                                        <input type="text" id="plan_member" readonly
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>Extra Member Amount Per Person</label>
                                        <input type="text" id="extra_amount_per_person" readonly
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>Extra Member</label>
                                        <select name="extra_member" id="extra_member"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                            <option value="0">0</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>Expiry Date <span class="text-red-500">*</span></label>
                                        <input type="date" name="expiry_date" id="expiry_date"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            required>
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>Start Date</label>
                                        <input type="date" id="start_date" readonly
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>

                                    <div class="xl:col-span-4">
                                        <label>Net Amount</label>
                                        <input type="text" id="net_amount" readonly
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>

                                </div>

                                <div class="ltr:md:text-end mt-10">
                                    <button type="submit"
                                        class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        Submit
                                    </button>

                                    <button type="reset"
                                        class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        Clear
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        let selectedPlan = {
            amount: 0,
            duration_in_days: 0,
            no_of_members: 0,
            extra_amount_per_person: 0
        };

        function toNumber(value) {
            const n = parseFloat(String(value || 0).replace(/,/g, ''));
            return isNaN(n) ? 0 : n;
        }

        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        function calculateStartDate() {
            const expiryDateInput = document.getElementById('expiry_date');
            const startDateInput = document.getElementById('start_date');

            const expiryDate = expiryDateInput.value;
            const duration = parseInt(selectedPlan.duration_in_days || 0);

            if (!expiryDate || duration <= 0) {
                startDateInput.value = '';
                return;
            }

            const endDate = new Date(expiryDate);
            endDate.setDate(endDate.getDate() - duration + 1);

            startDateInput.value = formatDate(endDate);
        }

        function calculateNetAmount() {
            const planAmount = toNumber(selectedPlan.amount);
            const extraAmount = toNumber(selectedPlan.extra_amount_per_person);
            const extraMember = parseInt(document.getElementById('extra_member').value || 0);

            const netAmount = planAmount + (extraAmount * extraMember);

            document.getElementById('net_amount').value = netAmount.toFixed(2);
        }

        function setPlanData(plan) {
            selectedPlan = plan;

            document.getElementById('plan_amount').value = toNumber(plan.amount).toFixed(2);
            document.getElementById('duration_days').value = plan.duration_in_days || 0;
            document.getElementById('plan_member').value = plan.no_of_members || 0;
            document.getElementById('extra_amount_per_person').value = toNumber(plan.extra_amount_per_person).toFixed(2);

            calculateStartDate();
            calculateNetAmount();
        }

        function loadPlanDetails(planId) {
            if (!planId) {
                setPlanData({
                    amount: 0,
                    duration_in_days: 0,
                    no_of_members: 0,
                    extra_amount_per_person: 0
                });
                return;
            }

            var url = "{{ route('Retail_Customer.planDetails', ':id') }}";
            url = url.replace(':id', planId);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    setPlanData(data);
                })
                .catch(error => {
                    console.log(error);
                    alert('Failed to load plan details');
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('plan_id').addEventListener('change', function() {
                loadPlanDetails(this.value);
            });

            document.getElementById('expiry_date').addEventListener('change', calculateStartDate);

            document.getElementById('extra_member').addEventListener('change', calculateNetAmount);
        });
    </script>
@endsection
