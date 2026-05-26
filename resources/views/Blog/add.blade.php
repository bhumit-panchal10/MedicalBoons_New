@extends('layouts.app')

@section('title', 'Add Blog')
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
                        <a href="{{ route('blog.index') }}" class="text-slate-400 dark:text-zink-200">Blog
                            List</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Add Blog
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
                                            <h5 class="text-16" id="exampleModalLabel">Add Blog</h5>
                                            <a href="{{ route('blog.index') }}">
                                                <button type="button"
                                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                                    data-modal-target="AddModal">
                                                    <i class="ri-arrow-left-line"></i> Back
                                                </button>
                                            </a>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                            <form onsubmit="return validateFile()" class="tablelist-form"
                                                action="{{ route('blog.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="grid grid-cols-3 gap-4">

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Title<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="strTitle" name="strTitle" maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Title" required autocomplete="off" autofocus
                                                            value="{{ old('strTitle') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Photo</label>
                                                        <input type="file" id="strPhoto" name="strPhoto"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            autocomplete="off" autofocus>

                                                        <div id="viewimg">
                                                            @error('strPhoto')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field"
                                                            class="inline-block mb-2 text-base font-medium">Meta
                                                            Title</label>
                                                        <textarea id="metaTitle" name="metaTitle" rows="4"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Meta Title" autocomplete="off" autofocus=""></textarea>
                                                        @error('metaTitle')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field"
                                                            class="inline-block mb-2 text-base font-medium">Meta
                                                            Keyword</label>
                                                        <textarea id="metaKeyword" name="metaKeyword" rows="4"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Meta Keyword" autocomplete="off" autofocus=""></textarea>
                                                        @error('metaKeyword')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field"
                                                            class="inline-block mb-2 text-base font-medium">Meta
                                                            Description</label>
                                                        <textarea id="metaDescription" name="metaDescription" rows="4"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Meta Description" autocomplete="off" autofocus=""></textarea>
                                                        @error('metaDescription')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field"
                                                            class="inline-block mb-2 text-base font-medium">Head
                                                        </label>
                                                        <textarea id="head" name="head" rows="4"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Meta Head" autocomplete="off" autofocus=""></textarea>
                                                        @error('head')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email-field"
                                                            class="inline-block mb-2 text-base font-medium">Body
                                                        </label>
                                                        <textarea id="body" name="body" rows="4"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Meta body" autocomplete="off" autofocus=""></textarea>
                                                        @error('body')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    Description <span style="color:red;">*</span>
                                                    <textarea id="strDescription" name="strDescription" class="ckeditor-classic text-slate-800"
                                                        style="height: 300px !important;"></textarea>
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

    <script src="{{ asset('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/pages/form-editor-classic.init.js') }}"></script> --}}
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
    </script>
    <script>
        function validateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp', ""];
            var fileExtension = document.getElementById('strPhoto').value.split('.').pop().toLowerCase();
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

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#hello').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#strPhoto").change(function() {
            html =
                '<img src="' + readURL(this) +
                '"   id="hello" width="70px" height = "70px" > ';
            $('#viewimg').html(html);

        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script>
        $.validator.addMethod("notEmptyHtml", function(value, element) {
            return value.replace(/<[^>]*>/g, '').trim() !== ''; // Removes all HTML tags and trims
        }, "This field is required.");

        $(document).ready(function() {
            $("#myForm").validate({
                rules: {
                    strTitle: {
                        required: true,
                    },
                    strDescription: {
                        required: true,
                        notEmptyHtml: true
                    },
                    strPhoto: {
                        required: true,
                    },

                },
                messages: {
                    strTitle: {
                        required: "Title is required",
                    },
                    strDescription: {
                        required: "Description is required",
                    },
                    strPhoto: {
                        required: "Photo is required",
                    },

                }
            });
        });
    </script>
@endsection
