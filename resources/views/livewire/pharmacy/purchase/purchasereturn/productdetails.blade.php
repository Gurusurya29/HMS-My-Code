<div class="card shadow-sm w-100 mx-auto">
    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">PRODUCT -
                    {{ $product->pharmproduct->name }}</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @include('helper.formhelper.showlabel', [
                'name' => 'MRP',
                'value' => $product->mrp,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'SELLING PRICE',
                'value' => $product->selling_price,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'EXPIRY DATE',
                'value' => $product->expiry_date,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'CURRENT QUANITY',
                'value' => $product->quantity,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'RECEIVED QUANTITY',
                'value' => $product->received_quantity,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
            @include('helper.formhelper.showlabel', [
                'name' => 'SOLED QUANTITY',
                'value' => $product->saled_quantity,
                'columnone' => 'col-md-6',
                'columntwo' => 'col-5',
                'columnthree' => 'col-7',
            ])
        </div>
    </div>
</div>
