<div class="card shadow-sm {{ $width }} mx-auto">
    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">PURCHASE ENTRY -
                    {{ $pe->purchaseorder_uniqid }}</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @include('helper.formhelper.showlabel', [
                'name' => 'UNIQID',
                'value' => $pe->uniqid,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'PURCHASE UNIQID',
                'value' => $pe->purchaseorder_uniqid,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'ENTRY BY',
                'value' => $pe->creatable->name,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'ENTRY DATE',
                'value' => $pe->created_at->format('d-m-Y h:i A'),
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
        </div>
    </div>
</div>
