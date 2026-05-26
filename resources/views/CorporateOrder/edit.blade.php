@extends('layouts.app')

@section('title', 'Edit Corporate Order')
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
                        <a href="{{ route('Corporate_Order.index') }}" class="text-slate-400 dark:text-zink-200">B2B
                            List</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Edit Corporate Order
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
                                            <h5 class="text-16" id="exampleModalLabel">Edit Corporate Order</h5>
                                            <a href="{{ route('Corporate_Order.index') }}">
                                                <button type="button"
                                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                                    data-modal-target="AddModal">
                                                    <i class="ri-arrow-left-line"></i> Back
                                                </button>
                                            </a>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                            <form onsubmit="return validateFile()" class="tablelist-form"
                                                action="{{ route('Corporate_Order.update') }}" method="POST">
                                                @csrf

                                                <div class="grid grid-cols-3 gap-4">
                                                    <input type="hidden" name="Corporate_Order_id"
                                                        value="{{ $data->Corporate_Order_id }}">

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Company name</label>
                                                        <select name="User_id" id="User_id"
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Comapny name
                                                            </option>
                                                            @foreach ($Companyname as $Companynam)
                                                                <option
                                                                    value="{{ $Companynam->Users_id }}"@if ($data->iUserId == $Companynam->Users_id) selected @endif>
                                                                    {{ $Companynam->company_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Plan</label>
                                                        <select name="Plan_id" id="Plan_id"
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Plan
                                                            </option>
                                                            @foreach ($Plans as $Plan)
                                                                <option value="{{ $Plan->id }}"
                                                                    @if ($data->iPlanId == $Plan->id) selected @endif
                                                                    data-amount="{{ $Plan->amount }}"
                                                                    data-extra-cost="{{ $Plan->extra_amount_per_person }}"
                                                                    data-days="{{ $Plan->duration_in_days }}"
                                                                    data-no_of_member="{{ $Plan->no_of_members }}">
                                                                    {{ $Plan->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="no_of_member" id="no_of_member"
                                                        value="{{ $data->iPlanMembers }}">
                                                    <input type="hidden" name="extra_amount_of_extra_member"
                                                        id="extra_amount_of_extra_member" value="">
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">No of Employee Join</label>
                                                        <input type="text" id="iExtraMember" name="iExtraMember"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Extra Member" autocomplete="off" autofocus
                                                            value="{{ $data->iExtraMember }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Amount of Extra Member</label>
                                                        <input type="text" id="iamountExtraMember"
                                                            name="iamountExtraMember" maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Amount of Extra Member"
                                                            autocomplete="off" autofocus
                                                            value="{{ $data->iamountExtraMember }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Plan Amount<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="PlanAmount" name="PlanAmount"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Plan Amount" required autocomplete="off"
                                                            autofocus value="{{ $data->PlanAmount }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Net Amount<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="NetAmount" name="NetAmount"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Net Amount" required autocomplete="off"
                                                            autofocus value="{{ $data->NetAmount }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Start Date<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="date" id="StartDate" name="start_date"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Start Date" required autocomplete="off"
                                                            autofocus value="{{ $data->start_date }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">End Date<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="date" id="EndDate" name="end_date"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Start Date" required autocomplete="off"
                                                            autofocus value="{{ $data->end_date }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Main Parent</label>
                                                        <select name="Main_parent_id" id="Main_parent_id"
                                                            onchange="getsearchparentid();"
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Main Parent
                                                            </option>
                                                            @foreach ($Mainparentids as $Mainparentid)
                                                                <option value="{{ $Mainparentid->Users_id }}"
                                                                    {{ $data->Main_parent_id == $Mainparentid->Users_id ? 'selected' : '' }}>
                                                                    {{ $Mainparentid->contact_person }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Parent</label>
                                                        <select name="parent_id" id="parent_id"
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Parent
                                                            </option>

                                                        </select>
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

    <script>
        function getsearchparentid(selectedParentId = null) {
            var Main_parent_id = $("#Main_parent_id").val();
            var url = "{{ route('Corporate_Order.parentid_mapping', ':Main_parent_id') }}";
            url = url.replace(":Main_parent_id", Main_parent_id);

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    Main_parent_id: Main_parent_id,
                    selectedParentId: selectedParentId
                },
                success: function(data) {
                    $("#parent_id").html('');
                    $("#parent_id").append(data);
                }
            });
        }


        $(document).ready(function() {
            let selectedMainParentId = "{{ $data->main_parent_id ?? '' }}";
            let selectedParentId = "{{ $data->parent_id ?? '' }}";

            if (selectedMainParentId) {
                $('#Main_parent_id').val(selectedMainParentId);
                getsearchparentid(selectedParentId);
            }
        });
    </script>


@endsection
