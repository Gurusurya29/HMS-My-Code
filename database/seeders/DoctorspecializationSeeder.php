<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class DoctorspecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 1,
            'name' => 'General Medicine',
            'active' => 1,
        ]);

        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 2,
            'name' => 'Obstetrics & Gynecology',
            'active' => 0,
        ]);

        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 3,
            'name' => 'Orthopedic',
            'active' => 0,
        ]);

        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 4,
            'name' => 'Dermatology',
            'active' => 0,
        ]);

        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 5,
            'name' => 'Urology',
            'active' => 1,
        ]);

        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 6,
            'name' => 'Diabetology',
            'active' => 0,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 7,
            'name' => 'Cardiology',
            'active' => 0,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 8,
            'name' => 'Paediatric',
            'active' => 0,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 9,
            'name' => 'Opthalmology',
            'active' => 0,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 10,
            'name' => 'Neurology',
            'active' => 0,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 11,
            'name' => 'Nephrology',
            'active' => 1,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 12,
            'name' => 'Anesthesiology & Pain Medicine',
            'active' => 0,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 13,
            'name' => 'General Practitioner & Sonology',
            'active' => 0,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 14,
            'name' => 'Gastroenterology',
            'active' => 1,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 15,
            'name' => 'Dental',
            'active' => 0,
        ]);
        User::find(1)->doctorspecializationcreatable()->create([
            'id' => 16,
            'name' => 'General Surgeon',
            'active' => 1,
        ]);
    }
}
