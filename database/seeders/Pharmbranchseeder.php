<?php

namespace Database\Seeders;

use App\Models\Pharmacy\Auth\Pharmacy;
use Illuminate\Database\Seeder;

class Pharmbranchseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pharmacy::find(1)
            ->pharmbranchcreatable()
            ->create([
                'contact_person' => 'Admin',
                'branch_name' => 'Ortho Pharmacy',
                'gstin' => 'GSTNO1234567890',
                'pan' => 'PAN1234567',
            ]);
    }
}
