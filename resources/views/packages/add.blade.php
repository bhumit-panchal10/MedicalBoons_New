@extends('layouts.app')

@section('title', 'Add Package')
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
                        <a href="{{ route('packages.index') }}" class="text-slate-400 dark:text-zink-200">Package
                            List</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Add Package
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
                                            <h5 class="text-16" id="exampleModalLabel">Add Package</h5>
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
                                                action="{{ route('packages.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="grid grid-cols-3 gap-4">

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Name<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="name"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Name" required autocomplete="off" autofocus
                                                            value="{{ old('name') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Price<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="price"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Amount" required autocomplete="off" autofocus
                                                            value="{{ old('amount') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">MRP Price<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="mrp_price"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter MRP Price" required autocomplete="off"
                                                            autofocus value="{{ old('mrp_price') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Tests<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="tests"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Tests" required autocomplete="off" autofocus
                                                            value="{{ old('tests') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Fasting Required<span
                                                                class="text-red-500">*</span></label>
                                                        <select name="fasting_required" id="fasting_required" required
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option value="0">No</option>
                                                            <option value="1">Yes</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Logo</label>
                                                        <input type="file" id="logo" name="logo"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            autocomplete="off" autofocus>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">PDF</label>
                                                        <input type="file" id="plan_detail_pdf" name="plan_detail_pdf"
                                                            accept=".pdf"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            autocomplete="off" autofocus>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    Include Test Breadbown <span style="color:red;">*</span>
                                                    <textarea id="strDescription" name="description" class="ckeditor text-slate-800" style="height: 300px !important;"></textarea>
                                                </div>
                                                <div class="ltr:md:text-end  mt-10">
                                                    <button type="submit"
                                                        class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Submit</button>

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
                </div>

            </div>
            <!-- End Page-content -->

        </div>
    </div>

    <!-- <script src="{{ asset('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script> -->
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
            var fileExtension = document.getElementById('plan_image').value.split('.').pop().toLowerCase();
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
