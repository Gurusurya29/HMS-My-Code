<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Generalsettings\Generalsetting;
use Illuminate\Database\Seeder;

class GeneralsettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Generalsetting::create([
            'companyfullname' => 'Hospital Management System',
            'companyshortname' => 'HMS',
            'address' => 'No. 9/3, 3rd Floor, VK Road, Chennai-600028',
            'phone' => '+91 4423 2265',
            'email' => 'hms@8queens.com',
            'language' => 1,

            'logo' => '',
            'favicon' => '',
        ]);
    }
}
