<?php

use App\Models\Laboratory\Laboratory\Labpatient;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
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
        Schema::create('labpatientlists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Labpatient::class);
            $table->foreignIdFor(Labinvestigation::class);

            $table->double('fee', 10, 2);

            $table->double('selffee', 10, 2);
            $table->double('insurancefee', 10, 2);
            $table->string('labinvestigation_name');
            $table->string('labinvestigationgroup_name');
            $table->string('units')->nullable();
            $table->string('testmethod')->nullable();
            $table->text('range')->nullable();
            $table->text('sample_note')->nullable();
            $table->text('result_note')->nullable();
            $table->text('delivery_note')->nullable();
            $table->text('senttoexternal_note')->nullable();
            $table->timestamp('is_movedtobill')->nullable();
            $table->timestamp('is_sampletaken')->nullable();
            $table->timestamp('is_resultupdated')->nullable();
            $table->timestamp('is_reportdelivered')->nullable();
            $table->timestamp('is_senttoexternallab')->nullable();

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
        Schema::dropIfExists('labpatientlists');
    }
};
