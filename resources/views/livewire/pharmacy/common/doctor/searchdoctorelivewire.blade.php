<div class="col-md-3 position-relative">
    <label for="doctor" class="form-label">DOCTOR</label>
    <span class="text-danger fw-bold">*</span>
    <input autocomplete="off" type="text" class="form-control" id="doctor" placeholder="Search Doctor ..."
        wire:model="doctor" wire:keydown.escape="resetData" wire:keydown.arrow-up=" docdecrementHighlight"
        wire:keydown.arrow-down="docincrementHighlight" wire:keydown.enter="selectDoctor" />
    @if (!empty($doctor))
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
        <div class="position-absolute bg-white rounded-t-none shadow-lg list-group" style="width:99%; z-index: 50;">
            @if ($isdoctorselected === false)
                @foreach ($pharmacydoctorlist as $i => $eachpharmacydoctor)
                    <div type="button"
                        wire:click='selecthisdoctor({{ $eachpharmacydoctor->id }},{{ "'" . $eachpharmacydoctor->name . "'" }})'
                        class="search-option-list list-item p-1 text-xs {{ $dochighlightIndex === $i ? 'theme_bg_color' : '' }}">
                        {{ $eachpharmacydoctor->phone }} - {{ $eachpharmacydoctor->name }}
                    </div>
                @endforeach
            @endif
        </div>
    @endif
</div>
