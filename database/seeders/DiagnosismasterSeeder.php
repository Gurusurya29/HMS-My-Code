<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class DiagnosismasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->diagnosismastercreatable()->create([
            'id' => 1,
            'name' => 'Diagnosis one',
        ]);

        User::find(1)->diagnosismastercreatable()->create([
            'id' => 2,
            'name' => 'Diagnosis two',
        ]);

        User::find(1)->diagnosismastercreatable()->create([
            'id' => 3,
            'name' => 'Diagnosis three',
        ]);
    }
}
