<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class WardfloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->wardfloorcreatable()->create([
            'id' => 1,
            'name' => 'Floor one',
        ]);

        User::find(1)->wardfloorcreatable()->create([
            'id' => 2,
            'name' => 'Floor two',
        ]);

        User::find(1)->wardfloorcreatable()->create([
            'id' => 3,
            'name' => 'Floor three',
        ]);
    }
}
