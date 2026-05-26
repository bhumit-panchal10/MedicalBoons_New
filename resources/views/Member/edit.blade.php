@extends('layouts.app')

@section('title', 'Edit Member')
@section('content')
    {!! Toastr::message() !!}

    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    {{--  <h5 class="text-16">State List</h5>  --}}
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Master Entry</a>
                    </li>
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="{{ route('Member.index') }}" class="text-slate-400 dark:text-zink-200">Member
                            List</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Edit Member
                    </li>
                </ul>
            </div>


            <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
                <div class="xl:col-span-12">
                    <div class="card" id="CorporateList">
                        <div class="">
                            <div class="grid grid-cols-1 gap-5 mb-5 ">

                                <div class="rtl:md:text-start">
                                    <div class="bg-white shadow rounded-md dark:bg-zink-600">
                                        <div
                                            class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                                            <h5 class="text-16" id="exampleModalLabel">Edit Member</h5>
                                            <a href="{{ route('Member.index', $orderid) }}">
                                                <button type="button"
                                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                                    data-modal-target="AddModal">
                                                    <i class="ri-arrow-left-line"></i> Back
                                                </button>
                                            </a>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                            <form onsubmit="return validateFile()" class="tablelist-form"
                                                action="{{ route('Member.update') }}" method="POST">
                                                @csrf

                                                <div class="grid grid-cols-3 gap-4">
                                                    <input type="hidden" name="Memberid" value="{{ $data->id }}">
                                                    <input type="hidden" name="orderid" value="{{ $data->Order_id }}">


                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Name</label>
                                                        <input type="text" id="name" name="name" maxlength="30"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Name" autocomplete="off" autofocus
                                                            value="{{ $data->name }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Email<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="email" id="email" name="email" maxlength="50"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Email" required autocomplete="off" autofocus
                                                            value="{{ $data->email }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Mobile<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="number" id="mobile" name="mobile" maxlength="10"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Mobile" required autocomplete="off" autofocus
                                                            value="{{ $data->mobile }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Address<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="address" name="address" maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Address" required autocomplete="off"
                                                            autofocus value="{{ $data->address }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">State<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="state" name="state" maxlength="30"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter State" required autocomplete="off" autofocus
                                                            value="{{ $data->state }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">City<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="city" name="city"
                                                            maxlength="30"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter City" required autocomplete="off" autofocus
                                                            value="{{ $data->city }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Pincode<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="number" id="pincode" name="pincode"
                                                            maxlength="30"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Pincode" required autocomplete="off"
                                                            autofocus value="{{ $data->pincode }}">
                                                    </div>


                                                </div>

                                                <div class="ltr:md:text-end  mt-10">
                                                    <button type="submit"
                                                        class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update</button>
                                                    <a href="{{ route('associated_member.index') }}">
                                                        <button type="button"
                                                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                            Cancel
                                                        </button>
                                                    </a>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- End Page-content -->

        </div>
    </div>

    <script>
        function calculateAmounts() {
            const selectedPlan = $('#Plan_id option:selected');

            const planAmount = parseFloat(selectedPlan.data('amount')) || 0;
            const extraCost = parseFloat(selectedPlan.data('extra-cost')) || 0;
            const days = parseInt(selectedPlan.data('days')) || 0;
            const no_of_member = parseInt(selectedPlan.data('no_of_member')) || 0;

            const extraMembers = parseInt($('#iExtraMember').val()) || 0;
            let netAmount = 0;
            if (extraMembers === 0) {
                netAmount = planAmount;
            } else {
                netAmount = planAmount * extraMembers;
            }

            const amountOfExtra = extraCost * extraMembers;
            // const netAmount = planAmount + amountOfExtra;

            $('#iamountExtraMember').val(extraCost.toFixed());
            $('#PlanAmount').val(planAmount.toFixed());
            $('#NetAmount').val(netAmount.toFixed());
            $('#no_of_member').val(no_of_member);
            $('#extra_amount_of_extra_member').val(amountOfExtra);

            const startDateStr = $('#StartDate').val();
            if (startDateStr && days > 0) {
                const startDate = new Date(startDateStr);
                startDate.setDate(startDate.getDate() + days);
                const endDateStr = startDate.toISOString().split('T')[0];
                $('#EndDate').val(endDateStr);
            }
        }

        $('#Plan_id').on('change', calculateAmounts);
        $('#iExtraMember, #StartDate').on('input change', calculateAmounts);
    </script>


@endsection
