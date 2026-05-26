<table class="w-full whitespace-nowrap" id="customerTable">
    <thead class="bg-slate-100 dark:bg-zink-600">
        <tr>
            <th class="px-3.5 py-2.5 font-semibold border-b">Sr.no</th>
            <th class="px-3.5 py-2.5 font-semibold border-b">Lab Test Category Name</th>
            <th class="px-3.5 py-2.5 font-semibold border-b">Lab Test Name</th>
            <th class="px-3.5 py-2.5 font-semibold border-b">Family Member Name</th>
            <th class="px-3.5 py-2.5 font-semibold border-b">Net Amount</th>
        </tr>
    </thead>

    <tbody class="list">
        @php
            $i = 1;
            $netamount = 0;
            $reportCount = $LabReportdetail->count();
        @endphp

        @foreach ($LabReportdetail as $labreport)
            @php
                $netamount += $labreport->LabTestRportAmount->NetAmount ?? 0;
                $dis = $labreport->master->discount_amount ?? 0;

                // Calculate special discount (100 rs after first test)
                $specialDiscount = $reportCount > 1 ? ($reportCount - 1) * 100 : 0;

                $afterSpecial = $netamount - $specialDiscount;
                $mainamount = $afterSpecial - $dis;
            @endphp

            <tr class="border-b">
                <td class="px-3.5 py-2.5 border-y">
                    {{ $i + $LabReportdetail->perPage() * ($LabReportdetail->currentPage() - 1) }}
                </td>

                <td class="px-3.5 py-2.5 border-y">
                    {{ $labreport->LabTest_Catgory_Name->name ?? '' }}
                </td>

                <td class="px-3.5 py-2.5 border-y">
                    {{ $labreport->Test_Name->Test_Name ?? '' }}
                </td>

                <td class="px-3.5 py-2.5 border-y">
                    {{ $labreport->family_member->member_name ?? '' }}
                </td>

                <td class="px-3.5 py-2.5 border-y">
                    {{ number_format($labreport->Test_Name->NetAmount ?? 0, 2) }}
                </td>
            </tr>

            @php $i++; @endphp
        @endforeach

        <!-- SUMMARY ROWS -->
        <tr class="border-t">
            <td colspan="4" class="px-3.5 py-2.5 text-right font-semibold">Total Net Amount</td>
            <td class="px-3.5 py-2.5 font-semibold">{{ number_format($netamount, 2) }}</td>
        </tr>

        <tr>
            <td colspan="4" class="px-3.5 py-2.5 text-right font-semibold">Special Discount</td>
            <td class="px-3.5 py-2.5">{{ number_format($specialDiscount, 2) }}</td>
        </tr>

        <tr>
            <td colspan="4" class="px-3.5 py-2.5 text-right font-semibold">After Special Discount</td>
            <td class="px-3.5 py-2.5">{{ number_format($afterSpecial, 2) }}</td>
        </tr>

        <tr>
            <td colspan="4" class="px-3.5 py-2.5 text-right font-semibold">Discount %</td>
            <td class="px-3.5 py-2.5">{{ number_format($dis, 2) }}</td>
        </tr>

        <tr class="bg-slate-100">
            <td colspan="4" class="px-3.5 py-2.5 text-right font-semibold">Total Payable Amount</td>
            <td class="px-3.5 py-2.5 font-bold text-green-700">
                {{ number_format($mainamount, 2) }}
            </td>
        </tr>

    </tbody>
</table>
