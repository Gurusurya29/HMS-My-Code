<?php

namespace Database\Seeders;

use App\Models\Laboratory\Auth\Laboratory;
use Illuminate\Database\Seeder;

class LabinvestigationgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Laboratory::find(1)->labinvestigationgroupcreatable()
            ->create([
                'name' => 'BIO CHEMISTRY',
                'labinvestigationtype' => 1,
                'note' => 'Test seeder',
            ]);

        Laboratory::find(1)->labinvestigationgroupcreatable()
            ->create([
                'name' => 'Scan',
                'labinvestigationtype' => 2,
                'note' => 'Test seeder',
            ]);

        Laboratory::find(1)->labinvestigationgroupcreatable()
            ->create([
                'name' => 'Xray',
                'labinvestigationtype' => 3,
                'note' => 'Test seeder',
            ]);
    }
}
