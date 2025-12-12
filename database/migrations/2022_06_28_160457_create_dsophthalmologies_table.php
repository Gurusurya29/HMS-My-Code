<?php

use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin\Inpatient\Inpatient;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Admin\Inpatient\Ipadmission;
use Illuminate\Database\Migrations\Migration;
use App\Models\Admin\Settings\Doctorsetting\Doctor;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsophthalmologies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Ipadmission::class);
            $table->foreignIdFor(Doctor::class);
            $table->boolean('is_billpaid', array(0, 1))->default(1);
            $table->text('dischargeinitiate_note')->nullable();
            $table->text('principaldiagnosis')->nullable();
            $table->text('riskfactor')->nullable();
            $table->text('cheifcomplaint')->nullable();
            $table->text('historyofpresentillness')->nullable();
            $table->text('historyofpastillness')->nullable();
            $table->text('others')->nullable();
            $table->text('hospitalizationcourse')->nullable();
            $table->text('operativesummary')->nullable();
            $table->text('conditionatdischarge')->nullable();
            $table->string('casesheet_file')->nullable();
            $table->text('specialinstruction')->nullable();
            $table->text('prescription_note')->nullable();
            $table->text('physicalexamination')->nullable();
            $table->date('discharge_date')->nullable();
            $table->json('followupvisit')->nullable();
            $table->boolean('is_patientdischarged', array(0, 1))->default(0);

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
        Schema::dropIfExists('dsophthalmologies');
    }
};
