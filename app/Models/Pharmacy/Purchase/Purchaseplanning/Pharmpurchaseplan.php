<?php

namespace App\Models\Pharmacy\Purchase\Purchaseplanning;

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Pharmacy\Purchase\Purchaseplanning\Pharmpurchaseplanitem;
use Illuminate\Database\Eloquent\Model;

class Pharmpurchaseplan extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'PLAN'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function outofstock()
    {
        return $this->hasMany(Pharmpurchaseplanitem::class)
            ->where('type', 1)
            ->get();
    }

    public function abt2beoutofstock()
    {
        return $this->hasMany(Pharmpurchaseplanitem::class)
            ->where('type', 2)
            ->get();
    }

    public function extstock()
    {
        return $this->hasMany(Pharmpurchaseplanitem::class)
            ->where('type', 3)
            ->get();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function deleteitems()
    {
        Pharmpurchaseplanitem::where('pharmpurchaseplan_id', $this->id)
            ->delete();
    }
}
