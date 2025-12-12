<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class PhysicalexamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->physicalexamcreatable()->create([
            'id' => 1,
            'name' => 'Physical Exam one',
        ]);

        User::find(1)->physicalexamcreatable()->create([
            'id' => 2,
            'name' => 'Physical Exam two',
        ]);

        User::find(1)->physicalexamcreatable()->create([
            'id' => 3,
            'name' => 'Physical Exam three',
        ]);
    }
}
