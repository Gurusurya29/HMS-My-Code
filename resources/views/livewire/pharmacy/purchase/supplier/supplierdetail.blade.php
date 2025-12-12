<div class="card shadow-sm {{ $width }} mx-auto">
    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">SUPPLIER -
                    {{ $supplier->company_name }}</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @include('helper.formhelper.showlabel', [
                'name' => 'UNIQID',
                'value' => $supplier->uniqid,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'CONTACT NAME',
                'value' => $supplier->company_person_name,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'CONTACT MOBILE NO.',
                'value' => $supplier->contact_mobile_no,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'CONTACT PHONE NO.',
                'value' => $supplier->contact_phone_no,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'GSTIN',
                'value' => $supplier->gstin,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'PAN',
                'value' => $supplier->pan,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'ADDRESS',
                'value' => $supplier->address,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
        </div>
    </div>
</div>
