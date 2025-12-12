<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Database\Seeders\ReferenceSeeder;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->referencecreatable()->create([
            'id' => 1,
            'name' => 'Ref One',
        ]);

        User::find(1)->referencecreatable()->create([
            'id' => 2,
            'name' => 'Ref Two',
        ]);
    }
}
