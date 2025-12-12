<?php

namespace App\Models\Pharmacy\Purchase\Purchaseentry;

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;
use Illuminate\Database\Eloquent\Model;

class Pharmpurchaseentry extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'PE'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function pharmpurchaseorder()
    {
        return $this->belongsTo(Pharmpurchaseorder::class);
    }

    public function nonpoitems()
    {
        return Pharmpurchaseentryitem::where('pharmpurchaseentry_id', $this->id)
            ->whereNull('pharmpurchaseorderitem_id')
            ->get();
    }

    public function pharmpurchaseentryitem()
    {
        return $this->hasMany(Pharmpurchaseentryitem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
