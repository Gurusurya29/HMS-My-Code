<?php

namespace App\Http\Controllers\Admin\Web\Settings\Suppliersetting;

use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function supplier()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Supplier-Menu') || !auth()->user()->can('Supplier')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.suppliersetting.supplier.supplier');
    }
}
