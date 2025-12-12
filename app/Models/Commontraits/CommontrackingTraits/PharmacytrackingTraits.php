<?php

namespace App\Models\Commontraits\CommontrackingTraits;

use App\Models\Pharmacy\Auth\Pharmacy;
use App\Models\Pharmacy\Expense\Pharmacyexpenseentry;
use App\Models\Pharmacy\Payment\Pharmacypaymententry;
use App\Models\Pharmacy\Purchase\Pharmacypurchaseentry;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentry;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;
use App\Models\Pharmacy\Purchase\Purchaseplanning\Pharmpurchaseplan;
use App\Models\Pharmacy\Purchase\Purchasereturn\Pharmpurchasereturn;
use App\Models\Pharmacy\Receipt\Pharmacyreceiptentry;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentry;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturn;
use App\Models\Pharmacy\Settings\Branch\Pharmbranch;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use App\Models\Pharmacy\Settings\Category\Pharmacysubcategory;
use App\Models\Pharmacy\Settings\Drugmaster\Genaric\Pharmacygenaric;
use App\Models\Pharmacy\Settings\Drugmaster\Manufacture\Pharmacymanufacture;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Product\Pharmreqproduct;

trait PharmacytrackingTraits
{
    public function pharmacycreatable()
    {
        return $this->morphMany(Pharmacy::class, 'creatable');
    }

    public function pharmacyupdatable()
    {
        return $this->morphMany(Pharmacy::class, 'updatable');
    }

    // Pharmacy Manufacture
    public function pharmacymanufacturecreatable()
    {
        return $this->morphMany(Pharmacymanufacture::class, 'creatable');
    }

    public function pharmacymanufactureupdatable()
    {
        return $this->morphMany(Pharmacymanufacture::class, 'updatable');
    }

    // Pharmacy Genaric
    public function pharmacygenariccreatable()
    {
        return $this->morphMany(Pharmacygenaric::class, 'creatable');
    }

    public function pharmacygenaricupdatable()
    {
        return $this->morphMany(Pharmacygenaric::class, 'updatable');
    }

    // Pharmacy Purchase Entry
    public function pharmacypurchaseentrycreatable()
    {
        return $this->morphMany(Pharmacypurchaseentry::class, 'creatable');
    }

    public function pharmacypurchaseentryupdatable()
    {
        return $this->morphMany(Pharmacypurchaseentry::class, 'updatable');
    }

    // Pharmacy Payment Entry
    public function pharmacypaymentcreatable()
    {
        return $this->morphMany(Pharmacypaymententry::class, 'creatable');
    }

    public function pharmacypaymentupdatable()
    {
        return $this->morphMany(Pharmacypaymententry::class, 'updatable');
    }

    // Pharmacy Receipt Entry
    public function pharmacyreceiptcreatable()
    {
        return $this->morphMany(Pharmacyreceiptentry::class, 'creatable');
    }

    public function pharmacyreceiptupdatable()
    {
        return $this->morphMany(Pharmacyreceiptentry::class, 'updatable');
    }

    // Pharmacy Expense Entry
    public function pharmacyexpensecreatable()
    {
        return $this->morphMany(Pharmacyexpenseentry::class, 'creatable');
    }

    public function pharmacyexpenseupdatable()
    {
        return $this->morphMany(Pharmacyexpenseentry::class, 'updatable');
    }

    // Pharmacy Category
    public function pharmacycategorycreatable()
    {
        return $this->morphMany(Pharmacycategory::class, 'creatable');
    }

    public function pharmacycategoryupdatable()
    {
        return $this->morphMany(Pharmacycategory::class, 'updatable');
    }

    // Pharmacy Sub Category
    public function pharmacysubcategorycreatable()
    {
        return $this->morphMany(Pharmacysubcategory::class, 'creatable');
    }

    public function pharmacysubcategoryupdatable()
    {
        return $this->morphMany(Pharmacysubcategory::class, 'updatable');
    }

    //Product
    public function pharmacyproductcreatable()
    {
        return $this->morphMany(Pharmacyproduct::class, 'creatable');
    }

    public function pharmacyproductupdatable()
    {
        return $this->morphMany(Pharmacyproduct::class, 'updatable');
    }

    //Pharmacy branch
    public function pharmbranchcreatable()
    {
        return $this->morphMany(Pharmbranch::class, 'creatable');
    }

    public function pharmbranchupdatable()
    {
        return $this->morphMany(Pharmbranch::class, 'updatable');
    }

    //Pharmacy Request Product
    public function pharmreqproductcreatable()
    {
        return $this->morphMany(Pharmreqproduct::class, 'creatable');
    }

    public function pharmreqproductupdatable()
    {
        return $this->morphMany(Pharmreqproduct::class, 'updatable');
    }

    //Pharmacy Purchase Plannings
    public function pharmpurchaseplancreatable()
    {
        return $this->morphMany(Pharmpurchaseplan::class, 'creatable');
    }

    public function pharmpurchaseplanupdatable()
    {
        return $this->morphMany(Pharmpurchaseplan::class, 'updatable');
    }

    //Pharmacy Purchase Order
    public function pharmpurchaseordercreatable()
    {
        return $this->morphMany(Pharmpurchaseorder::class, 'creatable');
    }

    public function pharmpurchaseorderupdatable()
    {
        return $this->morphMany(Pharmpurchaseorder::class, 'updatable');
    }

    //Pharmacy Purchase Order
    public function pharmpurchaseentrycreatable()
    {
        return $this->morphMany(Pharmpurchaseentry::class, 'creatable');
    }

    public function pharmpurchaseentryupdatable()
    {
        return $this->morphMany(Pharmpurchaseentry::class, 'updatable');
    }

    //Pharmacy Purchase Return
    public function pharmpurchaseitemreturncreatable()
    {
        return $this->morphMany(Pharmpurchasereturn::class, 'creatable');
    }

    public function pharmpurchaseitemreturnupdatable()
    {
        return $this->morphMany(Pharmpurchasereturn::class, 'updatable');
    }

    // Pharmacy Sales Entry
    public function pharmsalesentrycreatable()
    {
        return $this->morphMany(Pharmsalesentry::class, 'creatable');
    }

    public function pharmsalesentryupdatable()
    {
        return $this->morphMany(Pharmsalesentry::class, 'updatable');
    }

    public function pharmsalesreturncreatable()
    {
        return $this->morphMany(Pharmsalesreturn::class, 'creatable');
    }

}
