<?php

namespace App\Http\Controllers\Admin\Web\Settings\Doctorsetting;

use App\Http\Controllers\Controller;

class DoctorconsultationfeeController extends Controller
{
    public function doctorconsultationfee()
    {
        return view('admin.settings.doctorsetting.doctorconsultationfee.doctorconsultationfee');
    }
}
