@extends('layouts.app')

@section('title', 'Edit Package')
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
                        <a href="{{ route('packages.index') }}" class="text-slate-400 dark:text-zink-200">package
                            List</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Edit Package
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
                                            <h5 class="text-16" id="exampleModalLabel">Edit Package</h5>
                                            <a href="{{ route('packages.index') }}">
                                                <button type="button"
                                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                                    data-modal-target="AddModal">
                                                    <i class="ri-arrow-left-line"></i> Back
                                                </button>
                                            </a>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                            <form onsubmit="return validateFile()" class="tablelist-form"
                                                enctype="multipart/form-data"
                                                action="{{ route('packages.update', $plan->id) }}" method="POST">
                                                @csrf

                                                <div class="grid grid-cols-3 gap-4">
                                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Name<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="name"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Name" required autocomplete="off" autofocus
                                                            value="{{ $plan->name }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Price<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="price"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Price" required autocomplete="off" autofocus
                                                            value="{{ $plan->Price }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">MRP Price<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="mrp_price"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter MRP Price" required autocomplete="off"
                                                            autofocus value="{{ $plan->MRP_Price }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Tests<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="tests"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Tests" required autocomplete="off" autofocus
                                                            value="{{ $plan->Tests }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Fasting Required<span
                                                                class="text-red-500">*</span></label>
                                                        <select name="fasting_required" id="fasting_required" required
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option value="0"
                                                                @if ($plan->fasting_required == 0) selected @endif>No
                                                            </option>
                                                            <option value="1"
                                                                @if ($plan->fasting_required == 1) selected @endif>Yes
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 ">
                                                        Logo
                                                        <input type="file" id="editplan_logo" name="editplan_logo"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            autocomplete="off">
                                                        <div id="viewimg">
                                                            <img src="{{ asset('upload/logo/') . '/' . $plan->logo }}"
                                                                height="70" width="70" alt="">
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="hiddenlogo" class="form-control"
                                                        value="{{ old('editplan_logo') ? old('editplan_logo') : $plan->logo }}"
                                                        id="hiddenLogo">

                                                    <div class="mb-3 ">
                                                        PDF
                                                        <input type="file" id="editplan_pdf" name="editplan_pdf"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            autocomplete="off">
                                                        <div id="viewpdf">
                                                            <a
                                                                href="{{ asset('upload/package-detail-pdf/') . '/' . $plan->pdf }}">View
                                                                PDF</a>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="hiddenPdf" class="form-control"
                                                        value="{{ old('editplan_pdf') ? old('editplan_pdf') : $plan->pdf }}"
                                                        id="hiddenPdf">

                                                </div>

                                                <div class="mb-3">
                                                    Include Test Breadbown <span style="color:red;">*</span>
                                                    <textarea id="strDescription" name="description" class="ckeditor text-slate-800" style="height: 300px !important;">{{ $plan->description }}</textarea>
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
