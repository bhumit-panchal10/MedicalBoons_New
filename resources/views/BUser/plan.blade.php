@extends('layouts.appcorporateuser')

@section('title', 'Plan List')
@section('content')

    {!! Toastr::message() !!}

    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Plan List</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">

                    <li class="text-slate-700 dark:text-zink-100">
                        Plan List
                    </li>
                </ul>
            </div>

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow flex">
                    <h5 class="text-16">All Plan Link:</h5>
                    <p class="pl-5">{{ 'https://medicalboons.com/Plan/' . $GUid }}</p>
                </div>

            </div>


            <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">


                <div class="xl:col-span-12">
                    <div class="card" id="CorporateOrderList">
                        <div class="card-body">




                            <div class="overflow-x-auto">
                                @if (!$Plans->isEmpty())
                                    <form id="bulkDeleteForm" method="POST"
                                        action="{{ route('Corporate_Order.deleteselected') }}">
                                        @csrf
                                        @method('DELETE')

                                        <table class="w-full whitespace-nowrap" id="customerTable">
                                            <thead class="bg-slate-100 dark:bg-zink-600">
                                                <tr>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="state_name">Sr.no </th>


                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="are_name">Plan Name</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="Plan Amount">Plan Amount</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="action">Link</th>
                                                        
                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <?php $i = 1; ?>
                                              
                                                @foreach ($Plans as $plan)
                                                  @php
                                                    $link = $plan->slugname && $GUid ? url('Plan/Detail/' . $plan->slugname . '/' . $GUid) : '-';
                                                @endphp
                                                    <tr>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 id">
                                                            {{ $i + $Plans->perPage() * ($Plans->currentPage() - 1) }}
                                                        </td>
                                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 id"
                                                            style="display:none;"><a href="javascript:void(0);"
                                                                class="fw-medium link-primary id">#VZ2101</a></td>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $plan->name ?? '-' }}</td>


                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $plan->amount ?? '-' }}</td>
                                                            
                                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                            @if ($link != '-')
                                                                <span id="link-{{ $plan->id }}">{{ $link }}</span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>

                                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 text-center">
    
                                                            <!-- Copy Icon -->
                                                            <span onclick="copyToClipboard('link-{{ $plan->id }}')"
                                                                  class="inline-block cursor-pointer"
                                                                  title="Copy Link">
                                                        
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     width="20"
                                                                     height="20"
                                                                     viewBox="0 0 24 24"
                                                                     fill="currentColor"
                                                                     class="text-blue-600 dark:text-blue-400 hover:text-blue-800">
                                                                    <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                                                                </svg>
                                                        
                                                            </span>
                                                        
                                                        </td>




                                                        

                                                    </tr>

                                                    <?php $i++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                    <div class="flex items-center justify-between mt-5">
                                        {{ $Plans->appends(request()->except('page'))->links() }}
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


@endsection
@section('script')
<script>
function copyToClipboard(elementId) {
    
    let text = document.getElementById(elementId).innerText;

    navigator.clipboard.writeText(text)
        .then(() => {
            alert("Link copied to clipboard!");
            window.location.reload();
        })
        .catch(err => {
            console.error("Failed to copy: ", err);
        });
}
</script>

@endsection
