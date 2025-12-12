<?php

use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->date('doj')->nullable();
            $table->integer('doctor_type')->nullable();
            $table->integer('registration_validdays')->nullable();
            $table->integer('no_of_freevisit')->nullable();
            $table->boolean('is_surgeon', array(0, 1))->default(0);
            $table->string('door_no')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->integer('pincode')->nullable();
            $table->foreignIdFor(Country::class)->nullable();
            $table->foreignIdFor(State::class)->nullable();
            $table->foreignIdFor(Doctorspecialization::class)->nullable();
            $table->string('showinchargememos')->nullable();
            $table->double('consultation_fee', 10, 2)->nullable();

            $table->string('created_source');

            $table->string('emergency_number')->nullable();
            $table->text('note')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->uuid('uuid')->unique();
            $table->integer('sequence_id');
            $table->nullableMorphs('creatable');
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
        Schema::dropIfExists('doctors');
    }
};
