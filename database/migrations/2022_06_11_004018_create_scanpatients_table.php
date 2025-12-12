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
        Schema::create('scanpatients', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Doctor::class);
            $table->string('maintype');
            $table->string('subtype');
            $table->nullableMorphs('scanable');
            $table->double('total', 10, 2);
            $table->float('discount_percentage', 6, 2);
            $table->double('discount_value', 10, 2);
            $table->double('grand_total', 10, 2);

            $table->boolean('is_emergency', array(0, 1))->default(0);
            $table->boolean('is_billgenerated', array(0, 1))->default(0);

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
        Schema::dropIfExists('scanpatients');
    }
};
