<?php

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Admin\Settings\Patientvisitsetting\Insurancecompany;
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
        Schema::create('patientinsurances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->foreignIdFor(Inpatient::class)->nullable();
            $table->foreignIdFor(Ipadmission::class)->nullable();
            $table->foreignIdFor(Insurancecompany::class)->nullable();
            $table->unsignedBigInteger('tpaname_id')->nullable();
            $table->string('tpaidno')->nullable();
            $table->string('policyno')->nullable();

            $table->integer('stage'); // Initially 0
            // pa - Principal approval Sent
            $table->string('pa_sentby')->nullable();
            $table->string('pa_sentdatetime')->nullable();
            $table->string('pa_sentmailid')->nullable();
            $table->double('pa_estimatedamount', 10, 2)->nullable();
            $table->text('pa_sentnote')->nullable();
            $table->string('ins_contactname')->nullable();
            $table->string('ins_contactphone')->nullable();
            // pa - Principal approval Reply
            $table->integer('pa_approvalstatus')->nullable();
            $table->double('pa_approvedamount', 10, 2)->nullable();
            $table->string('pa_rec_mailid')->nullable();
            $table->string('pa_rec_name')->nullable();
            // da - Discharge approval Sent
            $table->string('da_sentby')->nullable();
            $table->string('proposeddischarge_datetime')->nullable();
            $table->string('da_treatmentstatus')->nullable();
            $table->double('da_finalbillamount', 10, 2)->nullable();
            $table->text('da_sentnote')->nullable();
            // da - Discharge approval Reply
            $table->integer('da_approvalstatus')->nullable();
            $table->double('da_approvedamount', 10, 2)->nullable();
            // final bill details
            $table->timestamp('actualdischarge_datetime')->nullable();
            $table->text('doc_listsumbitted')->nullable();
            $table->string('actualbill_datetime')->nullable();
            // payment details
            $table->double('received_amount', 10, 2)->nullable();
            $table->integer('modeofpayment')->nullable();
            $table->string('payment_ref_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->date('payment_date')->nullable();
            $table->text('payment_note')->nullable();
            $table->string('hospital_receiptnumb')->nullable();

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
        Schema::dropIfExists('patientinsurances');
    }
};
