<?php

use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Admin\Patient\Patientvisit;
use Illuminate\Database\Migrations\Migration;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Admin\Outpatient\Paediatric\Oppaediatric;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oppaediatrics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Patientvisit::class);
            $table->foreignIdFor(Doctor::class);
            $table->foreignIdFor(Doctorspecialization::class);

            $table->string('physicalexam_note')->nullable();
            $table->string('diagnosis_note')->nullable();
            $table->string('prescription_note')->nullable();
            $table->string('prescription_file')->nullable();
            $table->string('labinvestigation_note')->nullable();
            $table->string('labinvestigation_file')->nullable();
            $table->string('scaninvestigation_note')->nullable();
            $table->string('scaninvestigation_file')->nullable();
            $table->string('xrayinvestigation_note')->nullable();
            $table->string('xrayinvestigation_file')->nullable();
            $table->string('currentcomplaint_note')->nullable();

            $table->string('pasthistory_note')->nullable();
            $table->string('nutritionalscreening_note')->nullable();
            $table->string('provisionaldiagnosis_note')->nullable();
            $table->string('planofcare_note')->nullable();
            $table->string('systemicexamfinding_note')->nullable();
            $table->string('dietadvice_note')->nullable();

            $table->date('nextvisit_date')->nullable();
            $table->text('doctor_note')->nullable();

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

        Schema::create('currentcomplaints_oppaediatric', function (Blueprint $table) {
            $table->foreignIdFor(Currentcomplaints::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Oppaediatric::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('oppaediatric_physicalexam', function (Blueprint $table) {
            $table->foreignIdFor(Physicalexam::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Oppaediatric::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('diagnosismaster_oppaediatric', function (Blueprint $table) {
            $table->foreignIdFor(Diagnosismaster::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Oppaediatric::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('labinvestigation_oppaediatric', function (Blueprint $table) {
            $table->foreignIdFor(Labinvestigation::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Oppaediatric::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('scaninvestigation_oppaediatric', function (Blueprint $table) {
            $table->foreignIdFor(Labinvestigation::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Oppaediatric::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('xrayinvestigation_oppaediatric', function (Blueprint $table) {
            $table->foreignIdFor(Labinvestigation::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Oppaediatric::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('oppaediatrics');
    }
};
