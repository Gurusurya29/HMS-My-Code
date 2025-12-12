<?php

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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            $table->string('company_name');
            $table->string('company_person_name');
            $table->string('contact_mobile_no');
            $table->string('contact_phone_no')->nullable();
            $table->string('email')->nullable();

            $table->string('address');

            $table->foreignIdFor(Country::class)->nullable();
            $table->foreignIdFor(State::class)->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('gstin')->nullable();
            $table->string('pan')->nullable();

            $table->string('bank_name')->nullable();
            $table->string('bank_ifsc')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_ac_number')->nullable();

            $table->boolean('is_hms', array(0, 1))->default(0);
            $table->boolean('is_pharmacy', array(0, 1))->default(0);
            $table->boolean('is_laboratory', array(0, 1))->default(0);

            $table->boolean('is_equipment', array(0, 1))->default(0);
            $table->boolean('is_inventory', array(0, 1))->default(0);
            $table->boolean('is_canteen', array(0, 1))->default(0);

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
        Schema::dropIfExists('suppliers');
    }
};
