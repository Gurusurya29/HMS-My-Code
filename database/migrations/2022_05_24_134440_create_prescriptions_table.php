<?php

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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Doctor::class);
            $table->nullableMorphs('prescriptionable');
            // for Speciality
            $table->bigInteger('subprescriptionable_id')->nullable();
            $table->string('subprescriptionable_type')->nullable();

            $table->string('maintype')->nullable();
            $table->string('subtype')->nullable();
            $table->boolean('is_emergency', array(0, 1))->default(0);
            $table->boolean('ispharm_proccessed', array(0, 1))->default(0);

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
        Schema::dropIfExists('prescriptions');
    }
};
