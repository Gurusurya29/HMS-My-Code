<?php

use App\Models\Admin\Settings\Wardsetting\Wardfloor;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
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
        Schema::create('bedorroomnumbers', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique()->index();
            $table->foreignIdFor(Wardtype::class);
            $table->foreignIdFor(Wardfloor::class);
            $table->integer('is_available'); // 0-avialable 1-occupied 2 -Cleaning 3-is_blocked
            // $table->boolean('is_blocked', array(0, 1))->default(0);
            $table->double('insurancefee', 10, 2);
            $table->double('selffee', 10, 2);
            $table->integer('action_by')->nullable();
            $table->date('action_at')->nullable();

            $table->nullableMorphs('bedoccupiable');
            $table->boolean('is_ot', array(0, 1))->default(0);

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
        Schema::dropIfExists('bedorroomnumbers');
    }
};
