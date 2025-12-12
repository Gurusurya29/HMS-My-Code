<?php

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
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
        Schema::create('dsorthopedics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Ipadmission::class);
            $table->foreignIdFor(Doctor::class);
            $table->boolean('is_billpaid', array(0, 1))->default(1);
            $table->text('dischargeinitiate_note')->nullable();

            $table->text('primary_consultants')->nullable();
            $table->text('consultant')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('drug_allergy')->nullable();
            $table->text('procedures')->nullable();
            $table->text('historyofpastillness')->nullable();
            $table->text('generalexamination')->nullable();
            $table->text('localexamination')->nullable();
            $table->text('investigations')->nullable();
            $table->text('courseduringstay')->nullable();
            $table->json('patientowndrug')->nullable();
            $table->text('physioadvice')->nullable();
            $table->text('adviceondischarge')->nullable();
            $table->text('others')->nullable();
            $table->text('operativesummary')->nullable();
            $table->text('conditionatdischarge')->nullable();
            $table->string('casesheet_file')->nullable();

            $table->string('written_by')->nullable();
            $table->string('checked_by')->nullable();

            $table->text('prescription_note')->nullable();
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
        Schema::dropIfExists('dsorthopedics');
    }
};
