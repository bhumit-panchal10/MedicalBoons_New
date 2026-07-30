@extends('layouts.app')

@section('title', 'Add Associated Clinic')
@section('content')
    {!! Toastr::message() !!}

    <style>
        #sub_service_container {
            scrollbar-width: thin;
            scrollbar-color: #64748b transparent;
        }

        #sub_service_container::-webkit-scrollbar {
            width: 6px;
        }

        #sub_service_container::-webkit-scrollbar-track {
            background: transparent;
        }

        #sub_service_container::-webkit-scrollbar-thumb {
            background: #64748b;
            border-radius: 10px;
        }

        #sub_service_container::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    {{--  <h5 class="text-16">Associated List</h5>  --}}
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Master Entry</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Add Associated Clinic
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
                                            <h5 class="text-16" id="exampleModalLabel">Add Associated Clinic</h5>
                                            <a href="{{ route('AssocitedMemberClinic.index', $id) }}">
                                                <button type="button"
                                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                                                    data-modal-target="AddModal">
                                                    <i class="ri-arrow-left-line"></i> Back
                                                </button>
                                            </a>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                                            <form onsubmit="return validateFile()" class="tablelist-form"
                                                action="{{ route('AssocitedMemberClinic.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="grid grid-cols-3 gap-4">

                                                    <div class=" mb-3">
                                                        <label for="email-field" class="">Service<span
                                                                class="text-red-500"> *</span></label>
                                                        <select name="service_id" id="service_id"
                                                            onchange="getsubservice();" required
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Service</option>
                                                            @foreach ($Services as $Service)
                                                                <option value="{{ $Service->id }}"
                                                                    {{ old('service_id') == $Service->id ? 'selected' : '' }}>
                                                                    {{ $Service->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!--<div class="mb-3">-->
                                                    <!--    <label for="email-field" class="">Sub Service</label>-->
                                                    <!--    <select name="sub_service_id" id="sub_service_id"-->
                                                    <!--        class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">-->
                                                    <!--        <option selected="" value="">Select Sub Service-->
                                                    <!--        </option>-->
                                                    <!--        @foreach ($SubService as $SubSer)
    -->
                                                    <!--            <option value="{{ $SubSer->sub_service_id }}"-->
                                                    <!--                {{ old('sub_service_id') == $SubSer->sub_service_id ? 'selected' : '' }}>-->
                                                    <!--                {{ $SubSer->subservice_name }}-->
                                                    <!--            </option>-->
                                                    <!--
    @endforeach-->
                                                    <!--    </select>-->
                                                    <!--</div>-->

                                                    <div class="mb-3">
                                                        <div class="flex items-center justify-between mb-2">
                                                            <label>Sub Service</label>

                                                            <label id="select-all-wrapper"
                                                                class="hidden items-center gap-2 text-sm cursor-pointer">
                                                                <input type="checkbox" id="select_all_sub_services"
                                                                    class="w-4 h-4 rounded border-slate-300 text-custom-500">
                                                                <span>Select All</span>
                                                            </label>
                                                        </div>

                                                        <div id="sub_service_container"
                                                            class="grid grid-cols-1 gap-2 p-3 border rounded-md
                                                                       border-slate-200 dark:border-zink-500 dark:bg-zink-700"
                                                            style="height: 220px; overflow-y: auto; overflow-x: hidden;">
                                                            <p class="text-sm text-slate-500">
                                                                Select a service to load sub services.
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Associated Member<span
                                                                class="text-red-500"> *</span></label>
                                                        <select name="assoc_member_id" id="assoc_member_id" required
                                                            class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                            <option selected="" value="">Select Associated Member
                                                            </option>
                                                            @foreach ($AssociatedMember as $asscomember)
                                                                <option value="{{ $asscomember->id }}">
                                                                    {{ $asscomember->dr_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Clinic Name<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="clinic_name"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Clinic Name" required autocomplete="off"
                                                            autofocus value="{{ old('clinic_name') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Address<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="email-field" name="address"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Address" required autocomplete="off"
                                                            autofocus value="{{ old('address') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Time<span
                                                                class="text-red-500">*</span></label>
                                                        <input type="text" id="time" name="time"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Time" required autocomplete="off" autofocus
                                                            value="{{ old('time') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">Work Day<span
                                                                class="text-red-500"> *</span></label>
                                                        <input type="text" id="email-field" name="work_day"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter Work Day" required autocomplete="off"
                                                            autofocus value="{{ old('work_day') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="">photo</label>
                                                        <input type="file" id="photo" name="photo"
                                                            maxlength="150"
                                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                            placeholder="Enter photo" autocomplete="off" autofocus
                                                            value="{{ old('photo') }}">
                                                    </div>
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

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#strDescription'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        // function getsubservice() {
        //     var service = $("#service_id").val();
        //     var url = "{{ route('associated_member.service_subservice_mapping', ':service') }}";
        //     url = url.replace(":service", service);
        //     $.ajax({
        //         url: url,
        //         type: 'GET',
        //         data: {
        //             service: service,
        //         },
        //         success: function(data) {
        //             $("#sub_service_id").html('');
        //             $("#sub_service_id").append(data);
        //         }
        //     });
        // }
    </script>

    <script>
        function getsubservice() {
            const service = $("#service_id").val();
            const container = $("#sub_service_container");
            const selectAllWrapper = $("#select-all-wrapper");

            $("#select_all_sub_services").prop("checked", false);
            selectAllWrapper.addClass("hidden").removeClass("flex");

            if (!service) {
                container.html(`
                <p class="text-sm text-slate-500">
                    Select a service to load sub services.
                </p>
            `);
                return;
            }

            container.html(`
            <p class="text-sm text-slate-500">
                Loading sub services...
            </p>
        `);

            let url = "{{ route('associated_member.service_subservice_mapping', ':service') }}";
            url = url.replace(":service", service);

            $.ajax({
                url: url,
                type: "GET",
                data: {
                    service: service
                },

                success: function(response) {
                    const options = $("<select>")
                        .html(response)
                        .find("option");

                    let checkboxHtml = "";

                    options.each(function() {
                        const value = $(this).val();
                        const name = $(this).text();

                        if (value) {
                            checkboxHtml += `
                            <label class="flex items-center gap-2 p-2 border rounded-md cursor-pointer
                                border-slate-200 dark:border-zink-500
                                hover:bg-slate-50 dark:hover:bg-zink-600">

                                <input
                                    type="checkbox"
                                    name="sub_service_id[]"
                                    value="${value}"
                                    class="sub-service-checkbox w-4 h-4 rounded
                                    border-slate-300 text-custom-500"
                                >

                                <span class="text-sm text-slate-700 dark:text-zink-100">
                                    ${name}
                                </span>
                            </label>
                        `;
                        }
                    });

                    if (checkboxHtml) {
                        container.html(checkboxHtml);

                        selectAllWrapper
                            .removeClass("hidden")
                            .addClass("flex");
                    } else {
                        container.html(`
                        <p class="text-sm text-slate-500">
                            No sub services found.
                        </p>
                    `);
                    }
                },

                error: function(xhr) {
                    console.log(xhr.responseText);

                    container.html(`
                    <p class="text-sm text-red-500">
                        Unable to load sub services.
                    </p>
                `);
                }
            });
        }
    </script>

@endsection
