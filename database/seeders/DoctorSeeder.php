<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->adddoctorcreatable()->create([
            'id' => 1,
            'name' => 'DOCTOR 1',
            'created_source' => 'HMS',
        ]);

        User::find(1)->adddoctorcreatable()->create([
            'id' => 2,
            'name' => 'DOCTOR 2',
            'created_source' => 'HMS',
        ]);

        User::find(1)->adddoctorcreatable()->create([
            'id' => 3,
            'name' => 'DOCTOR 3',
            'created_source' => 'HMS',
        ]);

    }
}
