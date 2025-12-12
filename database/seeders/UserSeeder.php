<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'phone' => '1234567890',
            'password' => '12345678',
            'usertype' => 'ADMIN',
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user->pharmacycreatable()
            ->create([
                'name' => 'Pharmacy',
                'username' => 'pharmacy',
                'email' => 'admin@gmail.com',
                'phone' => '1234567890',
                'password' => '12345678',
                'usertype' => 'PHARMACY',
                'role' => 'superadmin',
            ]);

        $user->laboratorycreatable()
            ->create([
                'name' => 'Laboratory',
                'username' => 'laboratory',
                'email' => 'admin@gmail.com',
                'phone' => '1234567890',
                'password' => '12345678',
                'usertype' => 'LABORATORY',
                'role' => 'superadmin',
                'access_lab' => true,
                'access_scan' => true,
                'access_xray' => true,
            ]);

        if (env('APP_ENV') == "local") {
            $user->suppliercreatable()
                ->create([
                    'company_name' => 'Testing Company',
                    'company_person_name' => 'Mukhilan',
                    'contact_mobile_no' => '1234567890',
                    'contact_phone_no' => '1234567890',
                    'email' => '1234567890@gmail.com',
                    'address' => 'Supplier 1 Address',
                    'city' => 'Chennai',
                    'pincode' => '600032',
                    'gstin' => '123456789012345',
                    'pan' => '1234567890',
                    'bank_name' => 'Supplier Bank',
                    'bank_ifsc' => '1234567890',
                    'bank_branch' => 'Swiss',
                    'bank_ac_number' => '1234567890',
                    'is_pharmacy' => true,
                ]);

            $user->suppliercreatable()
                ->create([
                    'company_name' => 'Tech 4',
                    'company_person_name' => 'Muhudhan',
                    'contact_mobile_no' => '1234567890',
                    'contact_phone_no' => '1234567890',
                    'email' => '1234567890@gmail.com',
                    'address' => 'Supplier 1 Address',
                    'city' => 'Chennai',
                    'pincode' => '600032',
                    'gstin' => '123456789012345',
                    'pan' => '1234567890',
                    'bank_name' => 'Supplier Bank',
                    'bank_ifsc' => '1234567890',
                    'bank_branch' => 'Swiss',
                    'bank_ac_number' => '1234567890',
                    'is_pharmacy' => true,
                ]);
            $user->suppliercreatable()
                ->create([
                    'company_name' => '8Queens',
                    'company_person_name' => 'Sabari',
                    'contact_mobile_no' => '1234567890',
                    'contact_phone_no' => '1234567890',
                    'email' => '1234567890@gmail.com',
                    'address' => 'Supplier 1 Address',
                    'city' => 'Chennai',
                    'pincode' => '600032',
                    'gstin' => '123456789012345',
                    'pan' => '1234567890',
                    'bank_name' => 'Supplier Bank',
                    'bank_ifsc' => '1234567890',
                    'bank_branch' => 'Swiss',
                    'bank_ac_number' => '1234567890',
                    'is_pharmacy' => true,
                ]);
        }
    }
}
