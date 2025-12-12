<?php

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipassesment;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
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
        Schema::create('ipassesments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Patientvisit::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Doctor::class);
            // $table->foreignIdFor(Doctorspecialization::class);

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
            $table->string('dietadvice_note')->nullable();
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

        Schema::create('currentcomplaints_ipassesment', function (Blueprint $table) {
            $table->foreignIdFor(Currentcomplaints::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Ipassesment::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('ipassesment_physicalexam', function (Blueprint $table) {
            $table->foreignIdFor(Physicalexam::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Ipassesment::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('diagnosismaster_ipassesment', function (Blueprint $table) {
            $table->foreignIdFor(Diagnosismaster::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Ipassesment::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('ipassesment_labinvestigation', function (Blueprint $table) {
            $table->foreignIdFor(Labinvestigation::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Ipassesment::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('scaninvestigation_ipassesment', function (Blueprint $table) {
            $table->foreignIdFor(Labinvestigation::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Ipassesment::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('xrayinvestigation_ipassesment', function (Blueprint $table) {
            $table->foreignIdFor(Labinvestigation::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Ipassesment::class)
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
        Schema::dropIfExists('ipassesments');
    }
};
