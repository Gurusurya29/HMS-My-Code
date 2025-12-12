<div>
    <div class="m-3 fw-bold">
        <h3>{{ $this->productname }}</h3>
    </div>
    <div class="card shadow-sm">
        <div class="card-header text-white bg-success">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">ALTERNATIVE PRODUCT</span></div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1"
                        href="{{ $this->currentuser()->usertype == 'ADMIN' ? route('adminpharmacyproduct') : route('pharmacyproduct') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($alternaiveproduct->isNotEmpty())
                <div class="table-responsive">
                    <table id="tableid" class="table table-striped table-hover w-100 text-center fw-bold">
                        <thead class="text-white bg-success">
                            <tr>
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'NAME',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'CATEGORY',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'VIEW',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'ALTERNATIVE',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternaiveproduct as $index => $eachalternaiveproduct)
                                <tr>
                                    <td>{{ $eachalternaiveproduct->alternativepharmacyproduct->name }}</td>
                                    <td>{{ $eachalternaiveproduct->alternativepharmacyproduct->pharmacycategoryname->name }}
                                    </td>
                                    <td>
                                        <button wire:click="show({{ $eachalternaiveproduct->alternativeproduct_id }})"
                                            class="btn btn-sm btn-primary"><i class="bi bi-eye-fill"></i></button>
                                    </td>
                                    <td>
                                        <button wire:click="edithisproduct({{ $eachalternaiveproduct->id }},'-')"
                                            class="btn btn-sm btn-danger"><i class="bi bi-dash-circle"></i></button>
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
                'name' => 'CATEGORY',
                'type' => 'sortby',
                'sortname' => 'pharmacycategory_id',
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
            @foreach ($nonalternativeproduct as $index => $eachnonalternativeproduct)
                <tr>
                    <td>{{ $nonalternativeproduct->firstItem() + $index }}</td>
                    <td>{{ $eachnonalternativeproduct->uniqid }}</td>
                    <td>{{ $eachnonalternativeproduct->product_sku }}</td>
                    <td>{{ $eachnonalternativeproduct->hsn }}</td>
                    <td>{{ $eachnonalternativeproduct->name }}</td>
                    <td>{{ $eachnonalternativeproduct->pharmacycategoryname->name }}</td>
                    <td>
                        @include('pharmacy.common.datatable.activestatus', [
                            'status' => $eachnonalternativeproduct->active,
                        ])
                    </td>
                    <td>
                        <button wire:click="show({{ $eachnonalternativeproduct->id }})"
                            class="btn btn-sm btn-primary"><i class="bi bi-eye-fill"></i></button>
                    </td>
                    <td>
                        <button wire:click="edithisproduct({{ $eachnonalternativeproduct->id }},'+')"
                            class="btn btn-sm btn-success"><i class="bi bi-plus-circle"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $nonalternativeproduct->firstItem() }} to {{ $nonalternativeproduct->lastItem() }} out of
            {{ $nonalternativeproduct->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $nonalternativeproduct->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>
    <!-- Show Modal -->
    @include('livewire.pharmacy.settings.product.pharmacyproduct.show')

</div>
