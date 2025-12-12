<?php

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Admin\Patient\Patientvisit;
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
        Schema::create('otbillings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Patientvisit::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Otschedule::class);
            $table->double('sub_total', 10, 2);
            $table->double('discount', 10, 2);
            $table->double('total', 10, 2);
            $table->integer('billdiscount_type')->nullable();
            $table->double('billdiscount_amount', 10, 2)->nullable();
            $table->double('grand_total', 10, 2);

            $table->text('discount_note')->nullable();
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
        Schema::dropIfExists('otbillings');
    }
};
