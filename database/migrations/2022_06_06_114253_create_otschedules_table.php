<?php

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
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
        Schema::create('otschedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Doctor::class);
            $table->foreignIdFor(Bedorroomnumber::class);
            $table->string('surgery_name')->nullable();
            $table->string('surgery_startdate')->nullable();
            $table->string('surgery_enddate')->nullable();
            $table->text('schedule_note')->nullable();
            $table->boolean('is_otactive', array(0, 1))->default(1);

            $table->string('chief_surgeon')->nullable();
            $table->string('senior_surgeon')->nullable();
            $table->string('asst_surgeon')->nullable();
            $table->string('nursing_asst')->nullable();
            $table->string('anaesthetist')->nullable();
            $table->string('others')->nullable();
            $table->text('surgery_details')->nullable();
            $table->string('writtenconsent_file')->nullable();

            $table->timestamp('is_movetoip')->nullable();
            $table->text('movetoip_note')->nullable();

            $table->timestamp('is_movedto_ot')->nullable();

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
        Schema::dropIfExists('otschedules');
    }
};
