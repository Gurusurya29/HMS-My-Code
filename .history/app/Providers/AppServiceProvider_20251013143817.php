<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Admin\Settings\Generalsettings\Generalsetting;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton('generalsetting', function () {
            return Generalsetting::first();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component(
    // Your exact Blade alias
    'admin.inpatient.inpatientadmission.inpatientadmissiongeneral.inpatientadmissiongenerallivewire', 
    // The exact, corrected PHP class path
    \App\Http\Livewire\Admin\Inpatient\InpatientAdmission\InpatientAdmissionGeneral\InpatientAdmissionGeneralLivewire::class
);
        Paginator::useBootstrapFive();
    }
}
