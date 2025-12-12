<?php

namespace Database\Seeders;

use App\Models\Pharmacy\Auth\Pharmacy;
use Illuminate\Database\Seeder;

class Pharmacycategoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Pharmacy::find(1);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Implant',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Injection',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Joints',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Knee',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Medicines',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Tablet',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Cream',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Face Wash',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Gel',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Lotion',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Serum',
        ]);

        $user->pharmacycategorycreatable()->create([
            'name' => 'Shampo',
        ]);

        $user->pharmacysubcategorycreatable()->create([
            'name' => 'Attune',
            'pharmacycategory_id' => 1,
        ]);

        $user->pharmacysubcategorycreatable()->create([
            'name' => 'C Stam',
            'pharmacycategory_id' => 1,
        ]);
    }
}
