<?php

namespace App\Http\Controllers\Admin\Web\Settings\Documentsetting;

use App\Http\Controllers\Controller;

class MedicaldocumentController extends Controller
{
    public function medicaldocument()
    {
        return view('admin.settings.documentsetting.medicaldocument.medicaldocument');
    }
}
