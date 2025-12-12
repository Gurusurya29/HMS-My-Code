<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class InsurancecompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->insurancecompanycreatable()->create([
            'id' => 1,
            'name' => 'Star Healt Insurance',

        ]);

        User::find(1)->insurancecompanycreatable()->create([
            'id' => 2,
            'name' => 'United India Insurance',

        ]);
    }
}
