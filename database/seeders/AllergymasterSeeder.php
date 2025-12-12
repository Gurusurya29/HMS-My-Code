<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class AllergymasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->allergymastercreatable()->create([
            'id' => 1,
            'name' => 'allergy one',
        ]);

        User::find(1)->allergymastercreatable()->create([
            'id' => 2,
            'name' => 'allergy two',
        ]);

        User::find(1)->allergymastercreatable()->create([
            'id' => 3,
            'name' => 'allergy three',
        ]);
    }
}
