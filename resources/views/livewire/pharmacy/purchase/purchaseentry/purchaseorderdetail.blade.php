<div class="card shadow-sm {{ $width }} mx-auto">
    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">PURCHASE ORDER -
                    {{ $po->uniqid }}</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row fs-6">
            @include('helper.formhelper.showlabel', [
                'name' => 'EXPECTED DATE',
                'value' => Carbon\Carbon::parse($po->planning_date)->format('d-m-Y'),
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'GRAND TOTAL',
                'value' => $po->grand_total,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'TAX AMOUNT',
                'value' => $po->taxamt,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'TAXABLE AMOUNT',
                'value' => $po->taxableamt,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'ORDER PLACED BY',
                'value' => $po->creatable->name,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'ORDER CREATED AT',
                'value' => $po->created_at,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
        </div>
    </div>
</div>
