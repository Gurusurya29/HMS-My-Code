<?php

namespace App\Models\Pharmacy\Purchase\Purchaseorder;

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorderitem;
use Illuminate\Database\Eloquent\Model;

class Pharmpurchaseorder extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'PO'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function poitems()
    {
        return $this->hasMany(Pharmpurchaseorderitem::class);
    }

    public function showpoitems()
    {
        return Pharmpurchaseorderitem::where('pharmpurchaseorder_id', $this->id)
            ->get();
    }
}
