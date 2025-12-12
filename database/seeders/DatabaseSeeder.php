<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(GeneralsettingSeeder::class);
        $this->call(ThemesettingSeeder::class);

        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(DoctorspecializationSeeder::class);

        //Please make sure Dev or Production .env's APP_ENV not set to local
        if (env('APP_ENV') == "local") {
            $this->call(CurrentcomplaintsSeeder::class);
            $this->call(AllergymasterSeeder::class);
            $this->call(InsurancecompanySeeder::class);
            $this->call(ReferenceSeeder::class);
            $this->call(DoctorSeeder::class);

            // OP Seeder
            $this->call(DiagnosismasterSeeder::class);
            $this->call(PhysicalexamSeeder::class);

            // Laboratory Seeder
            $this->call(LabinvestigationgroupSeeder::class);
            $this->call(LabinvestigationSeeder::class);
            $this->call(LabtestmethodSeeder::class);

            // Pharmacy Seeder
            $this->call(Pharmacycategoryseeder::class);
            $this->call(Pharmacyproductseeder::class);
            $this->call(Pharmbranchseeder::class);

            // Ward Seeder
            $this->call(WardtypeSeeder::class);
            $this->call(WardfloorSeeder::class);
            $this->call(BedorroomnumberSeeder::class);
        }
    }
}
