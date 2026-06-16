@extends('layouts.app')

@section('title', 'Member Plan List')

@section('content')

    {!! Toastr::message() !!}

    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Member Plan List</h5>
                </div>

                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Master Entry</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Member Plan List
                    </li>
                </ul>
            </div>

            <div class="card" id="customerList">
                <div class="card-body">

                    <div class="grid grid-cols-1 gap-5 mb-5 xl:grid-cols-0">
                        <div class="rtl:md:text-start">
                            <a href="{{ route('Retail_Customer.add') }}"
                                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                Add Member Plan
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        @if (!$members->isEmpty())

                            <table class="w-full whitespace-nowrap" id="customerTable">
                                <thead class="bg-slate-100 dark:bg-zink-600">
                                    <tr>
                                        <th
                                            class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right">
                                            Sr.no
                                        </th>
                                        <th
                                            class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right">
                                            Member
                                        </th>
                                        <th
                                            class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right">
                                            Mobile
                                        </th>
                                        <th
                                            class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right">
                                            Plan
                                        </th>
                                        <th
                                            class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right">
                                            Start Date
                                        </th>
                                        <th
                                            class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right">
                                            Expiry Date
                                        </th>
                                        <th
                                            class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right">
                                            Amount
                                        </th>
                                        <th
                                            class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="list form-check-all">
                                    <?php $i = 1; ?>

                                    @foreach ($members as $member)
                                        <tr>
                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                {{ $i + $members->perPage() * ($members->currentPage() - 1) }}
                                            </td>

                                            <td
                                                class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                {{ $member->name ?? '' }}<br>
                                                <small>{{ $member->email ?? '' }}</small>
                                            </td>

                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                {{ $member->mobile ?? '' }}
                                            </td>

                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                {{ $member->plan_name ?? '' }}
                                            </td>

                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                {{ $member->start_date ? date('d-m-Y', strtotime($member->start_date)) : '' }}
                                            </td>

                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                {{ $member->end_date ? date('d-m-Y', strtotime($member->end_date)) : '' }}
                                            </td>

                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                {{ number_format($member->NetAmount ?? 0, 2) }}
                                            </td>

                                            <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                <div class="flex gap-2">
                                                    <div class="edit">
                                                        {{-- <a class="mx-1" title="Edit"
                                                            href="{{ route('Retail_Customer.edit', $member->id) }}">
                                                            <i class="ri-edit-2-fill"></i>
                                                        </a> --}}

                                                        <a class="mx-1" title="Delete" href="#"
                                                            onclick="confirmSingleDelete({{ $member->id }})">
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

                            <div class="flex items-center justify-between mt-5">
                                {!! $members->links() !!}
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

    <script>
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

                if (result.isConfirmed) {

                    let deleteUrl = "{{ route('Retail_Customer.delete', ':id') }}";
                    deleteUrl = deleteUrl.replace(':id', id);

                    fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {

                            console.log(data);

                            if (data.success === true) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Record has been deleted.',
                                    icon: 'success',
                                    customClass: {
                                        confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20',
                                    },
                                    buttonsStyling: false
                                }).then(() => {
                                    window.location.href = "{{ route('Retail_Customer.index') }}";
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Record not deleted.',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20',
                                    },
                                    buttonsStyling: false
                                });
                            }
                        })
                        .catch(error => {
                            console.log(error);

                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong while deleting.',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20',
                                },
                                buttonsStyling: false
                            });
                        });
                }
            });
        }
    </script>

@endsection
