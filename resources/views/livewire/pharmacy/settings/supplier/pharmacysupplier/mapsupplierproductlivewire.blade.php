<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">SUPPLIER PRODUCT</span></div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1"
                        href="{{ route('pharmacysupplierproduct') }}" role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card shadow-sm col-md-8 mx-auto">
                <div class="card-header text-white theme_bg_color">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="flex-grow-1 bd-highlight mt-1"><span
                                class="h5">{{ $supplier->company_name }}</span>
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
                    </div>
                </div>
            </div>
            <br>
            <div class="card shadow-sm">
                <div class="card-header text-white bg-success">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">SUPPLIER PRODUCT</span></div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($pharmacysupplierproduct->isNotEmpty())
                        <div class="table-responsive">
                            <table id="tableid" class="table table-striped table-hover w-100 text-center fw-bold">
                                <thead class="text-white bg-success">
                                    <tr>
                                        @include('helper.tablehelper.tableheader', [
                                            'name' => 'NAME',
                                            'type' => 'normal',
                                            'sortname' => 'name',
                                        ])
                                        @include('helper.tablehelper.tableheader', [
                                            'name' => 'VIEW',
                                            'type' => 'normal',
                                            'sortname' => '',
                                        ])
                                        @include('helper.tablehelper.tableheader', [
                                            'name' => 'ACTION',
                                            'type' => 'normal',
                                            'sortname' => '',
                                        ])
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pharmacysupplierproduct as $index => $eachpharmacysupplierproduct)
                                        <tr>
                                            <td>{{ $eachpharmacysupplierproduct->pharmacyproduct->name }}</td>
                                            <td>
                                                <button
                                                    wire:click="show({{ $eachpharmacysupplierproduct->pharmacyproduct->id }})"
                                                    class="btn btn-sm btn-primary"><i class="bi bi-eye-fill"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button
                                                    wire:click="edithisproduct({{ $eachpharmacysupplierproduct->id }},'-')"
                                                    class="btn btn-sm btn-danger"><i
                                                        class="bi bi-dash-circle"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center fw-bold">
                            No results..
                        </div>
                    @endif
                </div>
            </div>
            <br>
            <x-pharmacy.layouts.pharmacyindex>

                <x-slot name="title">
                    PRODUCT LIST
                </x-slot>

                <x-slot name="action">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1"
                        href="{{ route('pharmacysupplierproduct') }}" role="button">Back</a>
                </x-slot>

                <x-slot name="tableheader">
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'S.NO',
                        'type' => 'normal',
                        'sortname' => '',
                    ])
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'UNIQID',
                        'type' => 'sortby',
                        'sortname' => 'uniqid',
                    ])
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'SKU',
                        'type' => 'sortby',
                        'sortname' => 'product_sku',
                    ])
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'HSN',
                        'type' => 'sortby',
                        'sortname' => 'hsn',
                    ])
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'NAME',
                        'type' => 'sortby',
                        'sortname' => 'name',
                    ])
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'STATUS',
                        'type' => 'normal',
                        'sortname' => '',
                    ])
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'VIEW',
                        'type' => 'normal',
                        'sortname' => '',
                    ])
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'ADD',
                        'type' => 'normal',
                        'sortname' => '',
                    ])
                </x-slot>

                <x-slot name="tablebody">
                    @foreach ($nonsupplierproducts as $index => $eachnonsupplierproducts)
                        <tr>
                            <td>{{ $nonsupplierproducts->firstItem() + $index }}</td>
                            <td>{{ $eachnonsupplierproducts->uniqid }}</td>
                            <td>{{ $eachnonsupplierproducts->product_sku }}</td>
                            <td>{{ $eachnonsupplierproducts->hsn }}</td>
                            <td>{{ $eachnonsupplierproducts->name }}</td>
                            <td>
                                @include('pharmacy.common.datatable.activestatus', [
                                    'status' => $eachnonsupplierproducts->active,
                                ])
                            </td>
                            <td>
                                <button wire:click="show({{ $eachnonsupplierproducts->id }})"
                                    class="btn btn-sm btn-primary"><i class="bi bi-eye-fill"></i></button>
                            </td>
                            <td>
                                <button wire:click="edithisproduct({{ $eachnonsupplierproducts->id }},'+')"
                                    class="btn btn-sm btn-success"><i class="bi bi-plus-circle"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>

                <x-slot name="tablerecordtotal">
                    Showing {{ $nonsupplierproducts->firstItem() }} to {{ $nonsupplierproducts->lastItem() }} out
                    of
                    {{ $nonsupplierproducts->total() }} items
                </x-slot>

                <x-slot name="pagination">
                    {{ $nonsupplierproducts->links() }}
                </x-slot>

            </x-pharmacy.layouts.pharmacyindex>

            <!-- Show Modal -->
            @include('livewire.pharmacy.settings.product.pharmacyproduct.show')
        </div>
    </div>
</div>
