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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('assetid')->nullable();
            $table->string('location')->nullable();
            $table->string('location_comment')->nullable();
            $table->string('manufacture')->nullable();
            $table->string('model_no')->nullable();
            $table->string('serial_no')->nullable();
            $table->date('installation_date')->nullable();
            $table->date('supplied_date')->nullable();
            $table->string('asset_type')->nullable();
            $table->string('asset_description')->nullable();
            $table->string('supplied_by_vendor')->nullable();
            $table->string('asset_install_verifiedby')->nullable();
            $table->string('asset_comment')->nullable();
            $table->integer('asset_condition')->nullable();
            $table->date('warranty_exp_date')->nullable();
            $table->string('warranty_contact_person')->nullable();
            $table->string('asset_custodian')->nullable();

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
        Schema::dropIfExists('facilities');
    }
};
