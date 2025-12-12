<?php

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
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
        Schema::create('otsurgerypreops', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Otschedule::class);

            $table->text('preop_note')->nullable();
            $table->text('preopadditional_note')->nullable();
            $table->text('preop_remarks')->nullable();
            $table->boolean('is_writtenconsent', array(0, 1))->default(1);
            $table->boolean('is_betadine', array(0, 1))->default(1);
            $table->date('niloral_date')->nullable();
            $table->time('niloral_time')->nullable();
            $table->integer('res_bloodunits')->nullable();
            $table->integer('res_bloodgroup')->nullable();
            $table->date('res_blooddate')->nullable();
            $table->time('res_bloodtime')->nullable();
            $table->date('patientsent_date')->nullable();
            $table->time('patientsent_time')->nullable();
            $table->string('anaesthetist')->nullable();

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
        Schema::dropIfExists('otsurgerypreops');
    }
};
