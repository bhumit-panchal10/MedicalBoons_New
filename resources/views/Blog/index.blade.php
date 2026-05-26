@extends('layouts.app')

@section('title', 'Blogs List')
@section('content')

    {!! Toastr::message() !!}

    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Blogs List</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Master Entry</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Blogs List
                    </li>
                </ul>
            </div>


            <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">


                <div class="xl:col-span-12">
                    <div class="card" id="customerList">
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-5 mb-5 xl:grid-cols-0">

                                <div class="rtl:md:text-start">
                                    @if (!$Blogs->isEmpty())
                                        <button type="button" onclick="confirmBulkDelete()"
                                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            Delete Selected
                                        </button>
                                    @endif
                                    <a class="mx-1 ltr:md:text-end" title="Add New Career" href="{{ route('blog.create') }}"
                                        style="float: inline-end;">
                                        <button type="submit"
                                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            <i class="ri-add-box-fill"></i> Add Blog
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">


                            </div>

                            <div class="overflow-x-auto">
                                @if (!$Blogs->isEmpty())
                                    <form id="bulkDeleteForm" method="POST" action="">
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
                                                        data-sort="are_name">Title</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="are_name">Description</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="are_name">Photo</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <?php $i = 1; ?>
                                                @foreach ($Blogs as $Blog)
                                                    <tr>
                                                        <th class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"
                                                            scope="row">
                                                            <input
                                                                class="border rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                                                type="checkbox" name="blogIds[]"
                                                                value="{{ $Blog->blogId }}">
                                                        </th>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 id">
                                                            {{ $i + $Blogs->perPage() * ($Blogs->currentPage() - 1) }}
                                                        </td>
                                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 id"
                                                            style="display:none;"><a href="javascript:void(0);"
                                                                class="fw-medium link-primary id">#VZ2101</a></td>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $Blog->strTitle }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ strip_tags(Str::limit($Blog->strDescription, 200, '.....')) }}
                                                        </td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 Categories_img">
                                                            @if ($Blog->strPhoto)
                                                                <img class="img-fluid"
                                                                    src="{{ asset('upload/Blog') . '/' . $Blog->strPhoto }}"
                                                                    alt="" height="50" width="50">
                                                            @else
                                                                <img class="img-fluid"
                                                                    src="{{ asset('assets/images/noimage.png') }}"
                                                                    alt="" height="50" width="50">
                                                            @endif
                                                        </td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                            <div class="flex gap-2">
                                                                <div class="edit">
                                                                    <a class="mx-1" title="Edit"
                                                                        href="{{ route('blog.edit', $Blog->blogId) }}">
                                                                        <i class="ri-edit-2-fill"></i>
                                                                    </a>

                                                                    <a class="mx-1" title="Delete" href="#"
                                                                        onclick="confirmSingleDelete({{ $Blog->blogId }})">
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
                                        {{ $Blogs->appends(request()->except('page'))->links() }}
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
                if (result.value) {
                    fetch('{{ route('blog.delete', ['id' => '__id__']) }}'.replace('__id__', id), {
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
                                    window.location.href = `{{ route('blog.index') }}`;
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
