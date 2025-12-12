<?php

namespace Database\Seeders;

use App\Models\Laboratory\Auth\Laboratory;
use Illuminate\Database\Seeder;

class LabtestmethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Laboratory::find(1);

        $user->find(1)->labtestmethodcreatable()
            ->create([
                'name' => 'Test method 1',
                'note' => 'Test seeder',
            ]);

        $user->find(1)->labtestmethodcreatable()
            ->create([
                'name' => 'Test method 2',
                'note' => 'Test seeder',
            ]);

        $user->find(1)->labtestmethodcreatable()
            ->create([
                'name' => 'Test method 3',
                'note' => 'Test seeder',
            ]);
    }
}
