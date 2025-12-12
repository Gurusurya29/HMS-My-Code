<div class="d-flex flex-column gap-3">
    @livewire('pharmacy.purchase.purchaseplanning.purchaseproductlistlivewire', ['type' => 'outofstock'], key(str()->random(20)))

    @livewire('pharmacy.purchase.purchaseplanning.purchaseproductlistlivewire', ['type' => 'aboutto'], key(str()->random(20)))

    @livewire('pharmacy.purchase.purchaseplanning.purchaseproductlistlivewire', ['type' => 'required'], key(str()->random(20)))
</div>
