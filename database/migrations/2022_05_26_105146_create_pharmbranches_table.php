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
        Schema::create('pharmbranches', function (Blueprint $table) {
            $table->id();

            $table->string('contact_person');
            $table->string('branch_name');

            $table->string('gstin')->nullable();
            $table->string('pan')->nullable();

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
        Schema::dropIfExists('pharmbranches');
    }
};
