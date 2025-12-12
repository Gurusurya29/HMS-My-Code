<?php

use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\Reference;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->integer('salutation')->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->integer('blood_group')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->boolean('is_accountactive', array(0, 1))->default(1);
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('slack', 100)->nullable();

            $table->string('avatar')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('last_sessionid')->nullable();
            $table->string('usertype')->nullable();
            $table->double('age', 6, 2)->nullable();
            $table->integer('gender')->nullable();

            $table->string('parentorguardian')->nullable();
            $table->integer('marital_status')->nullable();
            $table->string('occupation')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('door_no')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->integer('pincode')->nullable();

            $table->date('dob')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('aadharid')->nullable();
            $table->string('uhid')->unique();
            $table->string('patient_sys_id')->unique();
            $table->string('patient_hospital_id')->unique()->nullable();
            $table->foreignIdFor(Reference::class)->nullable();
            $table->foreignIdFor(Country::class)->nullable();
            $table->foreignIdFor(State::class)->nullable();

            $table->text('note')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->uuid('uuid')->unique();
            $table->integer('sequence_id');
            $table->morphs('creatable');
            $table->nullableMorphs('updatable');
            $table->boolean('active', array(0, 1))->default(1);

            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('patients');
    }
};
