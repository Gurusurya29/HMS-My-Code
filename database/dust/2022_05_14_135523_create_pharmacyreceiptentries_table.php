<?php

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
        Schema::create('pharmacyreceiptentries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->string('patient_name');
            $table->string('payment_value');
            $table->string('mobile_number');
            $table->integer('payment_mode');
            $table->text('referance_notes')->nullable();
            $table->timestamp('payment_date');
            $table->string('payment_ref_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('reference')->nullable();
            $table->date('payment_date1')->nullable();

            $table->text('note')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->uuid('uuid')->unique();
            $table->integer('sequence_id');
            $table->boolean('active', array(0, 1))->default(1);
            $table->morphs('creatable');
            $table->nullableMorphs('updatable');

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
        Schema::dropIfExists('pharmacyreceiptentries');
    }
};
