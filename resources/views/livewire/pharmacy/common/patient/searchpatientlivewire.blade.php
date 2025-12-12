<div class="position-relative">
    <label for="patient" class="form-label">Search Patient UHID/ Name / Mobile no.</label>
    @if ($required)
        <span class="text-danger fw-bold">*</span>
    @endif
    <input autocomplete="off" type="text" class="form-control" id="patient" placeholder="Search Patient ..."
           wire:model="patient" wire:keydown.escape="resetData" wire:keydown.arrow-up=" decrementHighlight"
           wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter="selectPatient" />
    @if (!empty($patient))
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
        <div class="position-absolute bg-white rounded-t-none shadow-lg list-group" style="width:99%; z-index: 50;">
            @if ($ispatientselected === false)
                @if (!empty($patientlist))
                    @foreach ($patientlist as $i => $eachpatient)
                        <div type="button"
                             wire:click='selecthispatient({{ $eachpatient->id }},{{ "'" . $eachpatient->phone . "'" }},{{ "'" . $eachpatient->name . "'" }},{{ "'" . $eachpatient->uhid . "'" }})'
                             class="d-flex gap-4 justify-content-center search-option-list list-item p-1 text-xs {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
                            <span>
                                {{ $eachpatient->phone }}
                            </span>
                            <span>
                                {{ $eachpatient->uhid }}
                            </span>
                            <span>
                                {{ $eachpatient->name }}
                            </span>
                        </div>
                    @endforeach
                @else
                    <div class="list-item p-1">No results!</div>
                @endif
            @endif
        </div>
    @endif
</div>
