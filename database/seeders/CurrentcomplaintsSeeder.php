<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class CurrentcomplaintsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->currentcomplaintscreatable()->create([
            'id' => 1,
            'name' => 'Current Complaints one',
        ]);

        User::find(1)->currentcomplaintscreatable()->create([
            'id' => 2,
            'name' => 'Current Complaints two',
        ]);

        User::find(1)->currentcomplaintscreatable()->create([
            'id' => 3,
            'name' => 'Current Complaints three',
        ]);

    }
}
