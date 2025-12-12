<?php

use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigationgroup\Labinvestigationgroup;
use App\Models\Laboratory\Settings\Laboratorymaster\Labtestmethod\Labtestmethod;
use App\Models\Laboratory\Settings\Laboratorymaster\Labunit\Labunit;
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
        Schema::create('labinvestigations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Labinvestigationgroup::class);
            $table->string('name');

            $table->double('selffee', 10, 2);
            $table->double('insurancefee', 10, 2);

            $table->foreignIdFor(Labunit::class)->nullable();
            $table->foreignIdFor(Labtestmethod::class)->nullable();

            $table->text('range')->nullable();

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
        Schema::dropIfExists('labinvestigations');
    }
};
