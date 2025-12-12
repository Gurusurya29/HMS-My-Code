@switch($type)
@case('text')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <input wire:model="{{ $fieldname }}" type="text" class="form-control" id="{{ $labelidname }}"
        @if (isset($readonly)) readonly @endif>
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('number')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <input wire:model="{{ $fieldname }}" type="number" class="form-control" id="{{ $labelidname }}">
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('select')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <!-- <select wire:model="{{ $fieldname }}" class="form-select" id="{{ $labelidname }}"> -->
    <select wire:model.lazy="{{ $fieldname }}" class="form-select" id="{{ $labelidname }}">
        <option value>{{ $default_option ? $default_option : 'Select a Option' }}</option>
        @foreach ($option as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('textarea')
<div class="{{ $col }} mb-3">
    @if ($labelname)
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @endif
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <textarea wire:model="{{ $fieldname }}" class="form-control" id="{{ $labelidname }}"
        @if (isset($rows)) rows="{{ $rows }}" @else rows="2" @endif
        @if (isset($placeholder)) placeholder="{{ $placeholder }}" @endif></textarea>
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('formswitch')
<div class="{{ $col }} mb-3">
    @if ($labelname)
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @endif
    <div class="form-check form-switch">
        <input wire:model="{{ $fieldname }}" class="form-check-input border-primary" type="checkbox"
            id="{{ $labelidname }}"  {{ isset($checked) && $checked ? 'checked' : '' }}>
    </div>
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('file')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <input wire:model="{{ $fieldname }}" type="file"
        class="form-control {{ isset($is_uploaded) && $is_uploaded ? 'is-valid' : '' }}" id="{{ $labelidname }}">
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('password')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <input wire:model="{{ $fieldname }}" type="password" class="form-control" id="{{ $labelidname }}">
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('date')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <input wire:model="{{ $fieldname }}" type="date" class="form-control" id="{{ $labelidname }}">
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('time')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <input wire:model="{{ $fieldname }}" type="time" class="form-control" id="{{ $labelidname }}">
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('email')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <input wire:model="{{ $fieldname }}" type="email" class="form-control" id="{{ $labelidname }}">
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('toggle')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}</label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <div class="form-check form-switch">
        <input wire:model="{{ $fieldname }}" class="form-check-input" id="{{ $labelidname }}" type="checkbox"
            role="switch" id="flexSwitchCheckDefault" />
    </div>
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@case('sup')
<div class="{{ $col }} mb-3">
    <label for="{{ $labelidname }}" class="form-label">{{ $labelname }}<sup>{{ $sup }}</sup></label>
    @if ($required)
    <span class="text-danger fw-bold">*</span>
    @endif
    <input wire:model="{{ $fieldname }}" type="text" class="form-control" id="{{ $labelidname }}"
        @if (isset($readonly)) readonly @endif>
    @error($fieldname)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
@break

@default
<span>Something went wrong, please try again</span>
@endswitch