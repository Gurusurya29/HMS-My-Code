<x-laboratory.layouts.laboratoryindex>

    <x-slot name="title">
        LABORATORY INVESTIGATION PATIENT LIST
    </x-slot>

    <x-slot name="action">
        {{-- Action buttons here --}}
    </x-slot>

    <x-slot name="tableheader">
        {{-- Your table header includes --}}
    </x-slot>

    <x-slot name="tablebody">
        {{-- Your foreach loop for patients --}}
    </x-slot>

    <x-slot name="tablerecordtotal">
        Showing {{ $labpatient->firstItem() }} to {{ $labpatient->lastItem() }} out of
        {{ $labpatient->total() }} items
    </x-slot>

    <x-slot name="pagination">
        {{ $labpatient->links() }}
    </x-slot>

    {{-- 👇 Move modal include inside the same layout component --}}
    @include('livewire.laboratory.laboratory.patientlist.show')

</x-laboratory.layouts.laboratoryindex>
