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
        Schema::create('references', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            // $table->integer('type');
            // $table->string('email')->unique();
            // $table->string('phone')->unique();
            // $table->text('address')->nullable();

            // $table->string('bank_name')->nullable();
            // $table->string('account_no')->nullable();
            // $table->string('ifsc_code')->nullable();
            // $table->string('branch')->nullable();
            // $table->string('pan_no')->nullable();
            // $table->string('aadhar_no')->nullable();
            // $table->string('avatar')->nullable();

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
        Schema::dropIfExists('references');
    }
};
