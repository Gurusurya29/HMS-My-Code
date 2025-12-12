<?php

use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
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
        Schema::create('ipadmissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Patientvisit::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Ipbilling::class)->nullable();
            $table->foreignIdFor(Wardtype::class)->nullable();
            $table->foreignIdFor(Bedorroomnumber::class)->nullable();
            $table->foreignIdFor(Doctorspecialization::class);
            $table->integer('salutation')->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('age');
            $table->integer('gender');
            $table->string('parentorguardian')->nullable();
            $table->integer('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('door_no')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('aadharid')->nullable();
            $table->string('aadhar_doc')->nullable();
            $table->boolean('aadhar_submitted')->nullable();
            $table->date('dob')->nullable();
            $table->string('attender_name');
            $table->integer('attender_relationship');
            $table->string('attender_phone');
            $table->integer('referedby')->nullable();
            $table->string('refered_comp_or_doctor')->nullable();
            $table->boolean('is_hospitalemployee', array(0, 1))->default(1);
            $table->string('hospitalemployee_uniqid')->nullable();
            $table->boolean('is_foreigner', array(0, 1))->default(0);
            $table->boolean('is_insurance', array(0, 1))->default(0);
            $table->integer('billing_type')->nullable(); // 1-SELF BILLING  2- INSURANCE BILLING 3- CORPORATE BILLING

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
        Schema::dropIfExists('ipadmissions');
    }
};
