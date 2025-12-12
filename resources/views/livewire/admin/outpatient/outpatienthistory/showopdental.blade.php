<div class="row text-dark shadow-sm rounded">
    {{-- theme_bg_color --}}
    @include('helper.formhelper.showlabel', [
        'name' => 'OP ID',
        'value' => $showdata->uniqid,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'DOCTOR',
        'value' => $showdata->doctor?->name,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    <hr>

    @include('helper.formhelper.showlabel', [
        'name' => 'DOCTOR NOTE',
        'value' => $showdata->specialable->doctor_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
</div>
