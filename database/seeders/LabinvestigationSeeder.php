<?php

namespace Database\Seeders;

use App\Models\Laboratory\Auth\Laboratory;
use Illuminate\Database\Seeder;

class LabinvestigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Laboratory::find(1);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Bl.Sugar Fasting',
                'labinvestigationgroup_id' => 1,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,

            ]);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Bl.Sugar P.P',
                'labinvestigationgroup_id' => 1,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Bl.Sugar Random',
                'labinvestigationgroup_id' => 1,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Scan 1',
                'labinvestigationgroup_id' => 2,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Scan 2',
                'labinvestigationgroup_id' => 2,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Scan 3',
                'labinvestigationgroup_id' => 2,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Xray 1',
                'labinvestigationgroup_id' => 3,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Xray 2',
                'labinvestigationgroup_id' => 3,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        $user->labinvestigationcreatable()
            ->create([
                'name' => 'Xray 3',
                'labinvestigationgroup_id' => 3,
                'note' => 'test Seeder',
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);
    }
}
