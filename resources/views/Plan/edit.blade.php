@extends('layouts.app')

@section('title', 'Edit Plan')
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
                        <a href="{{ route('plan.index') }}" class="text-slate-400 dark:text-zink-200">Plan
                            List</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Edit Plan
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
                                            <h5 class="text-16" id="exampleModalLabel">Edit Plan</h5>
                                            <a href="{{ route('plan.index') }}">
                                                <button type="button"
                                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                                    data-modal-target="AddModal">
                                                    <i class="ri-arrow-left-line"></i> Back
                                                </button>
                                            </a>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                            <form onsubmit="return validateFile()" class="tablelist-form"
                                                enctype="multipart/form-data" action="{{ route('plan.update', $plan->id) }}"
                                                method="POST">
                                                @csrf

                                                <div class="grid grid-cols-3 gap-4">
                                                    <input type="hidden" name="plan_id" value="{{ $plan->plan_id }}">

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Name<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="name"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Doctor Name" required autocomplete="off"
                                                            autofocus value="{{ $plan->name }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Amount<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="amount"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Amount" required autocomplete="off" autofocus
                                                            value="{{ $plan->amount }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Is Corporate<span
                                                                class="text-red-500">*</span></label>
                                                        <select name="is_corporate" id="is_corporate" required
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option value="0" @if($plan->is_corporate == 0) selected @endif>No</option>
                                                            <option value="1" @if($plan->is_corporate == 1) selected @endif>Yes</option>
                                                        </select>
                                                    </div>
                                                   <div class="mb-3">
                                                        <label for="email-field" class="">Duration in Days<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="duration_in_days"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Duration in Days" required autocomplete="off"
                                                            autofocus value="{{ $plan->duration_in_days }}">
                                                    </div>

                                                    <div class="mb-3 ">
                                                        Image
                                                        <input type="file" id="editplan_img" name="editplan_img"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            autocomplete="off">
                                                        <div id="viewimg">
                                                            <img src="{{ asset('upload/plan-images/') . '/' . $plan->plan_image }}"
                                                                height="70" width="70" alt="">

                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="hiddenPhoto" class="form-control"
                                                        value="{{ old('editplan_img') ? old('editplan_img') : $plan->plan_image }}"
                                                        id="hiddenPhoto">

                                                      <div class="mb-3 ">
                                                        PDF
                                                        <input type="file" id="editplan_pdf" name="editplan_pdf"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            autocomplete="off">
                                                        <div id="viewpdf">
                                                            <a href="{{ asset('upload/plan-detail-pdf/') . '/' . $plan->plan_detail_pdf }}">View PDF</a>
                                                           

                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="hiddenPdf" class="form-control"
                                                        value="{{ old('editplan_pdf') ? old('editplan_pdf') : $plan->plan_detail_pdf }}"
                                                        id="hiddenPdf">     

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Number of Members<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="no_of_members"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Number of Members" required
                                                            autocomplete="off" autofocus
                                                            value="{{ $plan->no_of_members }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Wallet Balance<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="wallet_balance"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Wallet Balance" required autocomplete="off"
                                                            autofocus value="{{ $plan->wallet_balance }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Extra Amount Per
                                                            Person<span class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field"
                                                            name="extra_amount_per_person" maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Extra Amount Per Person" required
                                                            autocomplete="off" autofocus
                                                            value="{{ $plan->extra_amount_per_person }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Extra Amount Per
                                                            Person in wallet<span class="text-red-500">*</span></label>
                                                        <input type="text" name="extra_amount_per_person_in_wallet"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Extra Amount Per Person in wallet" required
                                                            autocomplete="off" autofocus
                                                            value="{{ $plan->extra_amount_per_person_in_wallet }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Lab Max Applicable amount
                                                            each time<span class="text-red-500">*</span></label>
                                                        <input type="text" name="lab_max_applicable_amount_each_time"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Extra Amount Per Person in wallet" required
                                                            autocomplete="off" autofocus
                                                            value="{{ $plan->lab_max_applicable_amount_each_time }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Lab Minimum Order
                                                            Value<span class="text-red-500">*</span></label>
                                                        <input type="text" name="lab_minimum_order_value"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Lab Minimum Order Value" required
                                                            autocomplete="off" autofocus
                                                            value="{{ $plan->lab_minimum_order_value }}">
                                                    </div>





                                                </div>

                                                <div class="mb-3">
                                                    Terms & Condition <span style="color:red;">*</span>
                                                    <textarea id="strDescription" name="terms_and_condition" class="ckeditor text-slate-800"
                                                        style="height: 300px !important;">{{ $plan->terms_and_condition }}</textarea>
                                                </div>

                                                <div class="mb-6">
                                                    Lab Special Terms & Condition <span style="color:red;">*</span>
                                                    <textarea id="lab_special" name="lab_special_terms_and_condition" class="ckeditor text-slate-800"
                                                        style="height: 100px !important;">{{ $plan->lab_special_terms_and_condition }}</textarea>
                                                </div>
                                                 <div class="mb-6">
                                                    Plan Detail Description<span style="color:red;">*</span>
                                                    <textarea id="plan_detail_description" name="plan_detail_description" class="ckeditor text-slate-800"
                                                        style="height: 100px !important;">{{ $plan->plan_detail_image }}</textarea>
                                                </div>

                                                <div class="ltr:md:text-end  mt-10">
                                                    <button type="submit"
                                                        class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update</button>
                                                    <a href="{{ route('plan.index') }}">
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

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#strDescription'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#lab_special'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#plan_detail_description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        function validateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp', ""];
            var fileExtension = document.getElementById('editplan_img').value.split('.').pop().toLowerCase();
            var isValidFile = false;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }

            if (!isValidFile) {
                alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
            }

            return isValidFile;
        }
    </script>

@endsection
