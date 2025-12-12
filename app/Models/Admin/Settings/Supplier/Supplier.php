<?php

namespace App\Models\Admin\Settings\Supplier;

use Illuminate\Database\Eloquent\Model;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Pharmacy\Settings\Supplier\Supplierpharmacyproduct;

class Supplier extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'S'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function gettotalproductunderthem()
    {
        return Supplierpharmacyproduct::where('supplier_id', $this->id)
            ->where('active', true)
            ->count();
    }

    public function supplierproduct()
    {
        return Supplierpharmacyproduct::where('supplier_id', $this->id)
            ->get();
    }

    public function stocklessproducts()
    {
        $supplierproductids = Supplierpharmacyproduct::where('supplier_id', $this->id)
            ->where('active', true)
            ->pluck('pharmacyproduct_id');

        return Pharmacyproduct::where('active', true)
            ->whereIn('id', $supplierproductids)
            ->where('stock_required', false)
            ->where('stock', 0)
            ->get();
    }

    public function abouttobestockless()
    {
        $supplierproductids = Supplierpharmacyproduct::where('supplier_id', $this->id)
            ->where('active', true)
            ->pluck('pharmacyproduct_id');

        return Pharmacyproduct::where('active', true)
            ->whereIn('id', $supplierproductids)
            ->where('stock_required', true)
            ->whereRaw('min_stock >= stock')
            ->get();
    }

    public function normalproduct()
    {
        $supplierproductids = Supplierpharmacyproduct::where('supplier_id', $this->id)
            ->where('active', true)
            ->pluck('pharmacyproduct_id');

        return Pharmacyproduct::where('active', true)
            ->whereIn('id', $supplierproductids)
            ->where('stock_required', false)
            ->where('stock', '!=', 0)
            ->get();

    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function paymentable()
    {
        return $this->morphMany(Paymentvoucher::class, 'paymentable');
    }
}
