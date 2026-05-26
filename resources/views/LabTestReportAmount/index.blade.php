@extends('layouts.app')

@section('title', 'Lab Test Report Amount List')
@section('content')

    {!! Toastr::message() !!}

    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Lab Test Report Amount List</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Master Entry</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Lab Test Report Amount List
                    </li>
                </ul>
            </div>


            <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">


                <div class="xl:col-span-12">
                    <div class="card" id="customerList">
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-5 mb-5 xl:grid-cols-0">

                                <div class="rtl:md:text-start">
                                    @if (!$LabTestRportAmount->isEmpty())
                                        <button type="button" onclick="confirmBulkDelete()"
                                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            Delete Selected
                                        </button>
                                    @endif
                                    <a class="mx-1 ltr:md:text-end" title="Add Lab Test"
                                        href="{{ route('lab_test_report_amount.add') }}" style="float: inline-end;">
                                        <button type="submit"
                                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            <i class="ri-add-box-fill"></i> Add Lab Test Report Amount
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">

                                <form onsubmit="return validateFile()" class="tablelist-form"
                                    action="{{ route('lab_test_report_amount.index') }}" method="GET"
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

                                            <a href="{{ route('lab_test_report_amount.index') }}">
                                                <button type="button"
                                                    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                    Reset
                                                </button>
                                            </a>

                                        </div>

                                    </div>

                                </form>

                            </div>

                            <div class="overflow-x-auto">
                                @if (!$LabTestRportAmount->isEmpty())
                                    <form id="bulkDeleteForm" method="POST"
                                        action="{{ route('lab_test_report_amount.deleteselected') }}">
                                        @csrf
                                        @method('DELETE')

                                        <table class="w-full whitespace-nowrap" id="customerTable">
                                            <thead class="bg-slate-100 dark:bg-zink-600">
                                                <tr>
                                                    <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500"
                                                        scope="col" style="width: 50px;">
                                                        <input
                                                            class="border rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                                            type="checkbox" onclick="checkAll(this);" id="check_all">
                                                    </th>
                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="state_name">Sr.no </th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="are_name">Category Name</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="are_name">Lab Name</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="state_name">Plan</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="state_name">Test Name</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="state_name">MRP</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="state_name">Discount</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="state_name">Discount Amount</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="net_amount">Net Amount</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <?php $i = 1; ?>
                                                @foreach ($LabTestRportAmount as $LabTestRport)
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"
                                                            scope="row">
                                                            <input
                                                                class="border rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                                                type="checkbox" name="Lab_Test_Report_Amount_ids[]"
                                                                value="{{ $LabTestRport->Lab_Test_Report_Amount_id }}">
                                                        </th>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 id">
                                                            {{ $i + $LabTestRportAmount->perPage() * ($LabTestRportAmount->currentPage() - 1) }}
                                                        </td>
                                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 id"
                                                            style="display:none;"><a href="javascript:void(0);"
                                                                class="fw-medium link-primary id">#VZ2101</a></td>


                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $LabTestRport->labcategory->name ?? '' }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $LabTestRport->labmaster->name ?? '' }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $LabTestRport->plan->name ?? '' }}</td>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $LabTestRport->labtestmaster->Test_Name ?? '' }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $LabTestRport->labtestmaster->MRP ?? '' }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ number_format($LabTestRport->Discount) }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $LabTestRport->DiscountAmount }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $LabTestRport->NetAmount }}</td>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                            <div class="flex gap-2">
                                                                <div class="edit">

                                                                    <a class="mx-1" title="Edit" href="#"
                                                                        data-modal-target="EditModal"
                                                                        onclick="getEditData(<?= $LabTestRport->Lab_Test_Report_Amount_id ?>)">
                                                                        <i class="ri-edit-2-fill"></i>
                                                                    </a>

                                                                    <a class="mx-1" title="Delete" href="#"
                                                                        onclick="confirmSingleDelete({{ $LabTestRport->Lab_Test_Report_Amount_id }})">
                                                                        <i class="ri-delete-bin-5-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                    <div class="flex items-center justify-between mt-5">
                                        {{ $LabTestRportAmount->appends(request()->except('page'))->links() }}
                                    </div>
                                @else
                                    <div class="noresult">
                                        <div class="text-center p-7">
                                            <h5 class="mb-2">Sorry! No Result Found</h5>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- End Page-content -->
        </div>
    </div>

    <div id="EditModal" modal-center=""
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16" id="exampleModalLabel">Edit Lab Test Report Amount</h5>
                <button data-modal-close="EditModal"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-slate-500"><i data-lucide="x"
                        class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                <form class="tablelist-form" onsubmit="return EditvalidateFile()"
                    action="{{ route('lab_test_report_amount.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="Lab_Test_Report_Amount_id" name="Lab_Test_Report_Amount_id" />
                    <div class="mb-3">
                        <label for="Countryname-field" class="inline-block mb-2 text-base font-medium">Service
                            MRP
                            <span class="text-red-500"> *</span>
                        </label>
                        <input type="text" name="MRP" id="Edit_MRP" maxlength="50"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Enter MRP" required autocomplete="off" autofocus readonly>
                    </div>


                    <div class="mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">Display
                            Discount<span class="text-red-500"> *</span> </label>
                        <input type="number" id="Edit_Discount" name="Edit_Discount" maxlength="50"
                            class="discount-input form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Enter Discount" required autocomplete="off" autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email-field" class="inline-block mb-2 text-base font-medium">Display
                            Discount Amount<span class="text-red-500"> *</span> </label>
                        <input type="number" id="Edit_Discount_Amount" name="Edit_Discount_Amount" maxlength="50"
                            class="discount-amount-input form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Enter Discount Amount" required autocomplete="off" autofocus>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="submit"
                            class="text-white bg-custom-500 border-custom-500 btn hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/10"
                            id="add-btn">Update</button>
                        <a href="{{ route('lab_test_report_amount.index') }}">
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

    <script>
        function getEditData(id) {
            var url = "{{ route('lab_test_report_amount.edit', ':id') }}";
            url = url.replace(":id", id);
            if (id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id
                    },
                    success: function(data) {
                        var obj = JSON.parse(data);
                        $("#Edit_MRP").val(obj.MRP);
                        $("#Edit_Discount").val(parseFloat(obj.Discount).toFixed());
                        $("#Edit_Discount_Amount").val(parseFloat(obj.DiscountAmount).toFixed());
                        $('#Lab_Test_Report_Amount_id').val(obj.Lab_Test_Report_Amount_id);
                    },
                    error: function(xhr) {
                        alert('Failed to load data');
                    }
                });
            }
        }
    </script>


    <script>
        document.getElementById('Edit_Discount').addEventListener('input', function() {
            const mrp = parseFloat(document.getElementById('Edit_MRP').value) || 0;
            const discount = parseFloat(this.value) || 0;
            const discountAmount = (mrp * discount) / 100;
            document.getElementById('Edit_Discount_Amount').value = discountAmount.toFixed();
        });
    </script>


    <script>
        function checkAll(source) {
            checkboxes = document.querySelectorAll('input[name="Lab_Test_Report_Amount_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = source.checked);
        }

        function confirmBulkDelete() {
            const selected = document.querySelectorAll('input[name="Lab_Test_Report_Amount_ids[]"]:checked');
            const ids = Array.from(selected).map(checkbox => checkbox.value);

            if (ids.length === 0) {
                Swal.fire({
                    title: 'No Selection',
                    text: 'Please select at least one area to delete.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ltr:mr-1 rtl:ml-1',
                    cancelButton: 'text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20',
                },
                confirmButtonText: 'Yes, delete it!',
                buttonsStyling: false,
                showCloseButton: true
            }).then(function(result) {
                if (result.value) {
                    document.getElementById('bulkDeleteForm').submit();
                }
            });
        }

        function confirmSingleDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                customClass: {
                    confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 ltr:mr-1 rtl:ml-1',
                    cancelButton: 'text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20',
                },
                confirmButtonText: "Yes, delete it!",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function(result) {
                if (result.value) {
                    fetch('{{ route('lab_test_report_amount.delete', ['id' => '__id__']) }}'.replace('__id__',
                            id), {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    icon: 'success',
                                    customClass: {
                                        confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20',
                                    },
                                    buttonsStyling: false
                                }).then(() => {
                                    // Redirect to state.index after successful deletion
                                    window.location.href =
                                        `{{ route('lab_test_report_amount.index') }}`;
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'There was an issue deleting the state.',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20',
                                    },
                                    buttonsStyling: false
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        }
    </script>


@endsection
@section('script')
@endsection
