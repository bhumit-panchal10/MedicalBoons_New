@extends('layouts.appcorporateuser')

@section('title', 'Order List')
@section('content')

    {!! Toastr::message() !!}

    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Order List</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">

                    <li class="text-slate-700 dark:text-zink-100">
                        Order List
                    </li>
                </ul>
            </div>


            <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">


                <div class="xl:col-span-12">
                    <div class="card" id="CorporateOrderList">
                        <div class="card-body">




                            <div class="overflow-x-auto">
                                @if (!$B2Bordersusers->isEmpty())
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
                                                        data-sort="are_name">Buying Member Name</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="are_name">Plan</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="are_name">Main Parent</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="are_name">Parent</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="Plan Amount">Plan Amount</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="Extra Member">Extra Member</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="Extra Amount">Extra Amount</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="Net Amount">Net Amount</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="Start Date">Start Date</th>

                                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"
                                                        data-sort="End Date">End Date</th>

                                                    <!--<th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right"-->
                                                    <!--    data-sort="action">Action</th>-->
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <?php $i = 1; ?>
                                                @foreach ($B2Bordersusers as $BOrder)
                                                    <tr>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 id">
                                                            {{ $i + $B2Bordersusers->perPage() * ($B2Bordersusers->currentPage() - 1) }}
                                                        </td>
                                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 id"
                                                            style="display:none;"><a href="javascript:void(0);"
                                                                class="fw-medium link-primary id">#VZ2101</a></td>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $BOrder->member->name ?? '-' }}</td>


                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $BOrder->plan->name ?? '-' }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $BOrder->MainParent->contact_person ?? '-' }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            @if ($BOrder->Parent->Users_id == $sessionUsers_id)
                                                                -
                                                            @else
                                                                {{ $BOrder->Parent->contact_person ?? '-' }}
                                                            @endif
                                                        </td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $BOrder->PlanAmount }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $BOrder->iExtraMember }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $BOrder->iamountExtraMember }}</td>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ $BOrder->NetAmount }}</td>

                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ date('d-m-Y', strtotime($BOrder->start_date)) }}
                                                        </td>
                                                        <td
                                                            class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">
                                                            {{ date('d-m-Y', strtotime($BOrder->end_date)) }}</td>

                                                        <!--<td-->
                                                        <!--    class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">-->
                                                        <!--    @if ($BOrder->is_corporate == 1)-->
                                                        <!--        <div class="flex gap-2">-->
                                                        <!--            <div class="edit">-->
                                                        <!--                <a class="mx-1" title="Display Member"-->
                                                        <!--                    href="{{ route('Memberlist', $BOrder->Corporate_Order_id) }}">-->
                                                        <!--                    <i class="fas fa-user-friends"></i>-->

                                                        <!--                </a>-->

                                                        <!--            </div>-->
                                                        <!--        </div>-->
                                                        <!--    @endif-->
                                                        <!--</td>-->
                                                    </tr>

                                                    <?php $i++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                    <div class="flex items-center justify-between mt-5">
                                        {{ $B2Bordersusers->appends(request()->except('page'))->links() }}
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
@endsection
