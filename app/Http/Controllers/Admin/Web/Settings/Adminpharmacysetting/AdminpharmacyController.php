<?php

namespace App\Http\Controllers\Admin\Web\Settings\Adminpharmacysetting;

use App\Http\Controllers\Controller;

class AdminpharmacyController extends Controller
{
    public function adminpharmacysettings()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Pharmacy') || !auth()->user()->can('Pharmacy-master')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.adminpharmacysettings.adminpharmacysettings');
    }

    public function adminpharmacycategory()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Pharmacy') && !auth()->user()->can('Pharmacy-master') || !auth()->user()->can('Pharmacy-category')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.adminpharmacysettings.pharmacycategory.adminpharmacycategory.adminpharmacycategory');
    }

    public function adminpharmacysubcategory()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Pharmacy') && !auth()->user()->can('Pharmacy-master') || !auth()->user()->can('Pharmacy-category')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.adminpharmacysettings.pharmacycategory.adminpharmacysubcategory.adminpharmacysubcategory');
    }

    public function adminpharmacygenaric()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Pharmacy') && !auth()->user()->can('Pharmacy-master') || !auth()->user()->can('Pharmacy-drugmaster')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.adminpharmacysettings.drugmaster.adminpharmacygenaric.adminpharmacygenaric');
    }

    public function adminpharmacymanufacture()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Pharmacy') && !auth()->user()->can('Pharmacy-master') || !auth()->user()->can('Pharmacy-drugmaster')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.adminpharmacysettings.drugmaster.adminpharmacymanufacture.adminpharmacymanufacture');
    }

    public function adminpharmacyproduct()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Pharmacy') && !auth()->user()->can('Pharmacy-master') || !auth()->user()->can('Pharmacy-product')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.adminpharmacysettings.pharmacyproduct.adminpharmacyproduct.adminpharmacyproduct');
    }

    public function adminalternativepharmacyproduct($productid)
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Pharmacy') && !auth()->user()->can('Pharmacy-master') || !auth()->user()->can('Pharmacy-product')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.adminpharmacysettings.pharmacyproduct.adminalternativepharmacyproduct.adminalternativepharmacyproduct', compact('productid'));
    }

}
