<?php

use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
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
        Schema::create('outpatients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Patientvisit::class);
            $table->foreignIdFor(Doctor::class)->nullable();
            $table->foreignIdFor(Doctorspecialization::class)->nullable();

            $table->timestamp('is_doctorattended')->nullable();
            // $table->timestamp('is_labarotary')->nullable();
            // $table->timestamp('is_labarotaryattended')->nullable();
            // $table->timestamp('is_pharmacy')->nullable();
            // $table->timestamp('is_pharmacyattended')->nullable();

            $table->nullableMorphs('specialable');
            $table->boolean('is_movetoip', array(0, 1))->default(0);

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
        Schema::dropIfExists('outpatients');
    }
};
