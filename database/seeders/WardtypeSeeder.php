<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class WardtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->wardtypecreatable()->create([
            'id' => 1,
            'name' => 'General Ward',
            'ward_category' => 1,
        ]);

        User::find(1)->wardtypecreatable()->create([
            'id' => 2,
            'name' => 'Premium Ward',
            'ward_category' => 1,
        ]);

        User::find(1)->wardtypecreatable()->create([
            'id' => 3,
            'name' => 'Elite Ward',
            'ward_category' => 1,
        ]);

        User::find(1)->wardtypecreatable()->create([
            'id' => 4,
            'name' => 'ICU Ward',
            'ward_category' => 1,
        ]);

        User::find(1)->wardtypecreatable()->create([
            'id' => 5,
            'name' => 'Operation Theatre',
            'ward_category' => 2,
        ]);

        User::find(1)->wardtypecreatable()->create([
            'id' => 6,
            'name' => 'Casuality Ward',
            'ward_category' => 3,
        ]);
    }
}
