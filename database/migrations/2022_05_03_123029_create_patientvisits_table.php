<?php

use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientregisterationsetting\Reference;
use App\Models\Admin\Settings\Patientvisitsetting\Allergymaster;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Admin\Settings\Patientvisitsetting\Insurancecompany;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
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
        Schema::create('patientvisits', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Patient::class);
            $table->nullableMorphs('visitable');
            //Vitals
            $table->string('temperature')->nullable();
            $table->string('bloodpressure')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('pulserate')->nullable();
            $table->string('respiratoryrate')->nullable();
            $table->string('spo_two')->nullable();
            $table->integer('painscaleone')->nullable();
            $table->integer('painscaletwo')->nullable();
            $table->integer('visit_category_id')->nullable();
            $table->integer('patient_visittype')->nullable();
            $table->string('character')->nullable();

            // Psychosocial History
            $table->boolean('alcohol')->nullable();
            $table->boolean('tobacco')->nullable();
            $table->boolean('smoking')->nullable();
            $table->string('others')->nullable();

            // Doctor
            $table->foreignIdFor(Doctor::class)->nullable();
            $table->foreignIdFor(Doctorspecialization::class)->nullable();
            $table->text('complaint_note')->nullable();
            $table->foreignIdFor(Reference::class)->nullable();

            // Ward
            $table->foreignIdFor(Wardtype::class)->nullable();

            // Token Id
            $table->string('token_id');
            $table->date('nextvisit')->nullable();
            $table->string('nextvisit_time')->nullable();

            $table->string('referral')->nullable();
            $table->integer('billing_type')->nullable(); // 1-SELF BILLING  2- INSURANCE BILLING 3- CORPORATE BILLING
            $table->foreignIdFor(Insurancecompany::class)->nullable();
            $table->unsignedBigInteger('tpaname_id')->nullable();
            $table->string('tpaidno')->nullable();
            $table->string('policyno')->nullable();

            $table->text('visit_note')->nullable();
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

        Schema::create('currentcomplaints_patientvisit', function (Blueprint $table) {
            $table->foreignIdFor(Currentcomplaints::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Patientvisit::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('allergymaster_patientvisit', function (Blueprint $table) {
            $table->foreignIdFor(Allergymaster::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Patientvisit::class)
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
        Schema::dropIfExists('patientvisits');
        // Schema::dropIfExists('currentcomplaintss_patientvisits');
        Schema::dropIfExists('allergymasters_patientvisits');
    }

};
