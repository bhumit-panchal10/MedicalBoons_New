@extends('layouts.app')

@section('title', 'Add Lab Test Report Amount')
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
                        <a href="{{ route('lab_test_master.index') }}" class="text-slate-400 dark:text-zink-200">Lab Test
                            Lab Test Report Amount List</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Add Lab Test Report Amount
                    </li>
                </ul>
            </div>


            <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
                <div class="xl:col-span-12">
                    <div class="card" id="customerList">
                        <div class="">
                            <div class="grid grid-cols-1 gap-5 mb-5 ">

                                <div class="rtl:md:text-start">
                                    <div class="bg-white shadow rounded-md dark:bg-zink-600">
                                        <div
                                            class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                                            <h5 class="text-16" id="exampleModalLabel">Add Lab Test Report Amount</h5>
                                            <a href="{{ route('lab_test_report_amount.index') }}">
                                                <button type="button"
                                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                                    data-modal-target="AddModal">
                                                    <i class="ri-arrow-left-line"></i> Back
                                                </button>
                                            </a>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">

                                            <form onsubmit="return validateFile()" class="tablelist-form"
                                                action="{{ route('lab_test_report_amount.add') }}" method="POST"
                                                enctype="multipart/form-data">

                                                @csrf

                                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
                                                    {{--  <div class="grid grid-cols-3 gap-4">  --}}


                                                    <div class="">
                                                        <span style="color:red;"></span>Lab
                                                        <select name="Labmasid" id="Labmasid"
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Lab</option>
                                                            @foreach ($LabMaster as $LabMas)
                                                                <option value="{{ $LabMas->Lab_Master_id }}"
                                                                    @if (isset($Labmasid) && $Labmasid == $LabMas->Lab_Master_id) {{ 'selected' }} @endif>
                                                                    {{ $LabMas->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="">
                                                        <span style="color:red;"></span>Category
                                                        <select name="Labcatid" id="Labcatid"
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Category</option>
                                                            @foreach ($LabTestCategory as $LabTestCate)
                                                                <option value="{{ $LabTestCate->Lab_Test_Category_id }}"
                                                                    @if (isset($Labcatid) && $Labcatid == $LabTestCate->Lab_Test_Category_id) {{ 'selected' }} @endif>
                                                                    {{ $LabTestCate->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="">
                                                        <span style="color:red;"></span>Plan
                                                        <select name="planid" id="planid"
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Plan</option>
                                                            @foreach ($Plan as $Pla)
                                                                <option value="{{ $Pla->id }}"
                                                                    @if (isset($planid) && $planid == $Pla->id) {{ 'selected' }} @endif>
                                                                    {{ $Pla->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <div class="ltr:md:text-end mt-5">

                                                        <button type="submit"
                                                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Search
                                                        </button>

                                                        <a href="{{ route('lab_test_report_amount.add') }}">
                                                            <button type="button"
                                                                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                                Reset
                                                            </button>
                                                        </a>

                                                    </div>

                                                </div>

                                            </form>

                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                            <form class="tablelist-form"
                                                action="{{ route('lab_test_report_amount.store') }}" method="POST"
                                                enctype="multipart/form-data">

                                                @csrf
                                                @if ($Labmasid || $Labcatid || $planid)
                                                    @foreach ($results as $item)
                                                        <div
                                                            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-4">
                                                            <input type="hidden" name="Lab_Test_Master_id[]"
                                                                value="{{ $item->Lab_Test_Master_id }}">
                                                            <input type="hidden" name="Lab_Test_category_id[]"
                                                                value="{{ $item->lab_test_category_id }}">
                                                            <input type="hidden" name="Lab_Master_id[]"
                                                                value="{{ $Labmasid }}">
                                                            <input type="hidden" name="planId[]"
                                                                value="{{ $planid }}">

                                                            <div>
                                                                <label>Test Name</label>
                                                                <input type="text" name="Test_Name[]"
                                                                    value="{{ $item->Test_Name }}"
                                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                                    readonly />
                                                            </div>

                                                            <div>
                                                                <label>MRP</label>
                                                                <input type="number" name="MRP[]"
                                                                    value="{{ $item->master_mrp }}"
                                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" />
                                                            </div>

                                                            <div>
                                                                <label>Discount (%)</label>
                                                                <input type="number" name="Discount[]"
                                                                    value="{{ $item->Discount }}"
                                                                    class="discount-input form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" />
                                                            </div>

                                                            <div>
                                                                <label>Discount Amount</label>
                                                                <input type="number" name="DiscountAmount[]" readonly
                                                                    value="{{ $item->DiscountAmount }}"
                                                                    class="discount-amount-input form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" />
                                                            </div>

                                                            <div>
                                                                <label>Net Amount</label>
                                                                <input type="number" name="NetAmount[]"
                                                                    value="{{ $item->NetAmount ?? $item->master_mrp }}"
                                                                    readonly
                                                                    class="discount-amount-input form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" />
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if ($Labmasid || $Labcatid || $planid)
                                                    <div class="ltr:md:text-end mt-5">

                                                        <button type="submit"
                                                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Submit
                                                        </button>

                                                        <a href="{{ route('lab_test_report_amount.add') }}">
                                                            <button type="button"
                                                                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                                Reset
                                                            </button>
                                                        </a>

                                                    </div>
                                                @endif

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
        document.addEventListener('DOMContentLoaded', function() {
            const mrpInputs = document.querySelectorAll('[name="MRP[]"]');
            const discountInputs = document.querySelectorAll('[name="Discount[]"]');
            const discountAmountInputs = document.querySelectorAll('[name="DiscountAmount[]"]');
            const netAmountInputs = document.querySelectorAll('[name="NetAmount[]"]');

            mrpInputs.forEach((mrpInput, index) => {
                const mrp = parseFloat(mrpInput.value) || 0;
                const net = parseFloat(netAmountInputs[index].value);

                // If NetAmount is missing or 0, fallback to MRP
                if (isNaN(net) || net === 0) {
                    netAmountInputs[index].value = mrp.toFixed(0);
                }
            });

            discountInputs.forEach((discountInput, index) => {
                discountInput.addEventListener('input', function() {
                    const mrp = parseFloat(mrpInputs[index].value) || 0;
                    const discount = parseFloat(discountInput.value);

                    let discountAmount = 0;
                    let netAmount = mrp;

                    if (!isNaN(discount) && discount > 0) {
                        discountAmount = (mrp * discount) / 100;
                        netAmount = mrp - discountAmount;
                    }

                    discountAmountInputs[index].value = discountAmount.toFixed(0);

                    netAmountInputs[index].value = netAmount.toFixed(0);
                });
            });
        });
    </script>


@endsection
