@extends('layouts.app')

@section('title', 'Retail Customer Registration')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Retail Customer Registration (Admin)</h5>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Corporate_Order.RetailRegistrationStore') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" class="form-input" value="{{ old('name') }}"
                                    required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Email <span
                                        class="text-red-500">*</span></label>
                                <input type="email" name="email" class="form-input" value="{{ old('email') }}"
                                    required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Mobile <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="mobile" class="form-input" value="{{ old('mobile') }}"
                                    maxlength="10" required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Address <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="address" class="form-input" value="{{ old('address') }}"
                                    required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">State <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="state" class="form-input" value="{{ old('state') }}"
                                    required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">City <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="city" class="form-input" value="{{ old('city') }}"
                                    required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Pincode <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="pincode" class="form-input" value="{{ old('pincode') }}"
                                    required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Plan <span
                                        class="text-red-500">*</span></label>
                                <select name="plan_id" id="plan_id" class="form-input" required>
                                    <option value="">Select Plan</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}" data-amount="{{ $plan->amount }}"
                                            data-member="{{ $plan->no_of_members }}"
                                            data-extra="{{ $plan->extra_amount_per_person }}"
                                            data-duration="{{ $plan->duration_in_days }}"
                                            {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Plan Amount <span
                                        class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="plan_amount" id="plan_amount" class="form-input"
                                    value="{{ old('plan_amount') }}" required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Total Member Plan <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="plan_member" id="plan_member" class="form-input"
                                    value="{{ old('plan_member') }}" required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Extra Member Amount/Person <span
                                        class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="extra_amount_per_person"
                                    id="extra_amount_per_person" class="form-input"
                                    value="{{ old('extra_amount_per_person') }}" required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Extra Member</label>
                                <input type="number" min="0" name="extra_memeber" id="extra_memeber"
                                    class="form-input" value="{{ old('extra_memeber', 0) }}">
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Net Amount <span
                                        class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="net_amount" id="net_amount" class="form-input"
                                    value="{{ old('net_amount') }}" required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">Start Date <span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="start_date" id="start_date" class="form-input"
                                    value="{{ old('start_date') }}" required>
                            </div>
                            <div>
                                <label class="inline-block mb-2 text-base font-medium">End Date <span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="end_date" id="end_date" class="form-input"
                                    value="{{ old('end_date') }}" required>
                            </div>
                        </div>

                        <div class="mt-5 flex gap-2">
                            <button type="submit"
                                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600">
                                Save Registration
                            </button>
                            <a href="{{ route('Corporate_Order.RetailOrderlist') }}"
                                class="text-white transition-all duration-200 ease-linear btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const planSelect = document.getElementById('plan_id');
            const planAmount = document.getElementById('plan_amount');
            const planMember = document.getElementById('plan_member');
            const extraAmount = document.getElementById('extra_amount_per_person');
            const extraMember = document.getElementById('extra_memeber');
            const netAmount = document.getElementById('net_amount');
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');

            const toNumber = (value) => {
                const parsed = parseFloat(value);
                return isNaN(parsed) ? 0 : parsed;
            };

            function updateNetAmount() {
                const base = toNumber(planAmount.value);
                const extra = toNumber(extraAmount.value);
                const count = parseInt(extraMember.value || '0', 10);
                netAmount.value = (base + (extra * count)).toFixed(2);
            }

            function updateEndDateByDuration() {
                const selected = planSelect.options[planSelect.selectedIndex];
                const duration = parseInt(selected?.dataset?.duration || '0', 10);
                if (!startDate.value || duration <= 0) return;

                const start = new Date(startDate.value);
                const end = new Date(start);
                end.setDate(start.getDate() + duration - 1);
                endDate.value = end.toISOString().split('T')[0];
            }

            planSelect.addEventListener('change', function() {
                const selected = planSelect.options[planSelect.selectedIndex];
                if (!selected || !selected.value) return;
                planAmount.value = selected.dataset.amount || 0;
                planMember.value = selected.dataset.member || 0;
                extraAmount.value = selected.dataset.extra || 0;
                updateNetAmount();
                updateEndDateByDuration();
            });

            extraMember.addEventListener('input', updateNetAmount);
            planAmount.addEventListener('input', updateNetAmount);
            extraAmount.addEventListener('input', updateNetAmount);
            startDate.addEventListener('change', updateEndDateByDuration);
        });
    </script>
@endsection
