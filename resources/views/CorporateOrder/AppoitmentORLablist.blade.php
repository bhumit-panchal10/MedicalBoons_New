<div class="space-y-8">

    {{-- Appointment List --}}
    @if ($appointments->count() > 0)
        <div>
            <h5 class="text-lg font-semibold mb-3 text-blue-700">Appointment List</h5>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-3 text-left">Sr. No</th>
                            <th class="p-3 text-left">Member Name</th>
                            <th class="p-3 text-left">Preference Date</th>
                            <th class="p-3 text-left">Preference Time</th>
                            <th class="p-3 text-left">Doctor Name</th>
                            <th class="p-3 text-left">Family Member Name</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($appointments as $a)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $i++ }}</td>
                                <td class="p-3">{{ $a->member->name ?? '-' }}</td>
                                <td class="p-3">{{ date('d-m-Y', strtotime($a->preference_date)) }}</td>
                                <td class="p-3">{{ $a->preference_time }}</td>
                                <td class="p-3">{{ $a->AssociatedMember->dr_name ?? '-' }}</td>
                                <td class="p-3">
                                    {{ optional($a->labreqmasterdetail->first()?->family_member)->member_name ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


    {{-- Lab Request List --}}
    @if ($LabReportinquirys->count() > 0)
        <div>
            <h5 class="text-lg font-semibold mb-3 text-purple-700">Lab Request List</h5>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-3 text-left">Sr. No</th>
                            <th class="p-3 text-left">Member</th>
                            <th class="p-3 text-left">Lab Name</th>
                            <th class="p-3 text-left">Net Amount Payable</th>
                            <th class="p-3 text-left">Visit</th>
                            <th class="p-3 text-left">Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($LabReportinquirys as $l)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $i++ }}</td>
                                <td class="p-3">{{ $l->member->name ?? '-' }}</td>
                                <td class="p-3">{{ $l->lab->name ?? '-' }}</td>
                                <td class="p-3">{{ number_format($l->NetAmount, 2) }}</td>
                                <td class="p-3">
                                    {{ $l->visit == 1 ? 'Home' : ($l->visit == 2 ? 'Center' : '-') }}
                                </td>
                                <td class="p-3">
                                    {{ $l->date && $l->date != '0000-00-00' ? date('d-m-Y', strtotime($l->date)) : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


    {{-- Empty State --}}
    @if ($appointments->count() == 0 && $LabReportinquirys->count() == 0)
        <p class="text-center text-red-500 py-6 text-lg font-medium">
            No Appointment or Lab Request Found
        </p>
    @endif

</div>
