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
        Paginator::useBootstrapFive();

         Livewire::component('admin.outpatient.opassessment.common.oppatient-lab-investigation', 
        \App\Http\Livewire\Admin\Outpatient\Opassessment\Common\OppatientLabInvestigation::class);
    }
}
