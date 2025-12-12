<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;

class BedorroomnumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 1,
                'name' => '101',
                'wardtype_id' => 1,
                'wardfloor_id' => 1,
                'is_available' => 0,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 2,
                'name' => '102',
                'wardtype_id' => 1,
                'wardfloor_id' => 1,
                'is_available' => 0,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);
        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 3,
                'name' => '103',
                'wardtype_id' => 2,
                'wardfloor_id' => 1,
                'is_available' => 0,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 4,
                'name' => '104',
                'wardtype_id' => 2,
                'wardfloor_id' => 1,
                'is_available' => 2,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 5,
                'name' => '201',
                'wardtype_id' => 1,
                'wardfloor_id' => 2,
                'is_available' => 2,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 6,
                'name' => '202',
                'wardtype_id' => 1,
                'wardfloor_id' => 2,
                'is_available' => 2,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 7,
                'name' => '203',
                'wardtype_id' => 2,
                'wardfloor_id' => 2,
                'is_available' => false,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 8,
                'name' => '301',
                'wardtype_id' => 5,
                'wardfloor_id' => 3,
                'is_available' => 0,
                'is_ot' => 1,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);

        User::find(1)->bedorroomnumbercreatable()
            ->create([
                'id' => 9,
                'name' => '1001',
                'wardtype_id' => 6,
                'wardfloor_id' => 3,
                'is_available' => 0,
                'insurancefee' => 1500,
                'selffee' => 1300,
            ]);
    }
}
