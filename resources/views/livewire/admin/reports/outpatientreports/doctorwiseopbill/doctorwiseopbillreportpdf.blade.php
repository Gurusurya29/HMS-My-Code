<div>
    <div style="text-align:center;">
        <h3>Doctor Wise OP Bill Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">UNIQID</th>
                <th style="border: 1px solid;">DOCTOR NAME</th>
                <th style="border: 1px solid;">PATIENT COUNT</th>
                <th style="border: 1px solid;">BILL VALUE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctorlist as $key => $item)
                <tr style="text-align:center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->name }}</td>
                    <td style="border: 1px solid;">{{ $item->visit_count }}</td>
                    @php
                        
                        $opbill_total = App\Models\Admin\Billing\Opbilling\Opbillinglist::whereBetween('created_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59'])
                            ->whereHas('opbilling', fn($q) => $q->whereIn('patientvisit_id', $item->patientvisit->pluck('id')))
                            ->sum('grand_total');
                        
                    @endphp
                    <td style="border: 1px solid;">
                        {{ $opbill_total }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
