<?php

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
        Schema::create('paymentvouchers', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('paymentable');
            $table->double('paid_amount', 10, 2);
            $table->integer('modeofpayment');
            $table->string('payment_ref_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->date('payment_date')->nullable();
            $table->integer('payment_type')->nullable();
            $table->integer('payment_to')->nullable();
            $table->string('others_name')->nullable();
            $table->integer('payment_reason')->nullable();

            $table->integer('hms_sequence_id')->nullable();
            $table->string('hms_uniqid')->unique()->nullable();
            $table->integer('pharm_sequence_id')->nullable();
            $table->string('pharm_uniqid')->unique()->nullable();
            $table->integer('lab_sequence_id')->nullable();
            $table->string('lab_uniqid')->unique()->nullable();
            $table->integer('scan_sequence_id')->nullable();
            $table->string('scan_uniqid')->unique()->nullable();
            $table->integer('xray_sequence_id')->nullable();
            $table->string('xray_uniqid')->unique()->nullable();

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
        Schema::dropIfExists('paymentvouchers');
    }
};
