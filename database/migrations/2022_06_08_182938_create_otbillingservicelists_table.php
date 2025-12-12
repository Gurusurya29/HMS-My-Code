<?php

use App\Models\Admin\Billing\Otbilling\Otbilling;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Admin\Settings\Ipsetting\Ipservicemaster;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otbillingservicelists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Otbilling::class);
            $table->foreignIdFor(Otschedule::class);
            $table->foreignIdFor(Ipservicemaster::class)->nullable();

            $table->string('otservice_name');
            $table->integer('quantity');
            $table->double('otservice_fee', 10, 2);
            $table->double('otservice_selffee', 10, 2);
            $table->double('otservice_insurancefee', 10, 2);
            $table->double('final_amount', 10, 2);

            $table->text('note')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->uuid('uuid')->unique();
            $table->integer('sequence_id');
            $table->morphs('creatable');
            $table->nullableMorphs('updatable');
            $table->boolean('active', array(0, 1))->default(1);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otbillingservicelists');
    }
};
