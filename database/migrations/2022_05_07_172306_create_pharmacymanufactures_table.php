<?php

use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
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
        Schema::create('pharmacymanufactures', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('contact_no')->nullable();
            $table->text('address')->nullable();

            $table->foreignIdFor(Pharmacycategory::class)->nullable();

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
        Schema::dropIfExists('pharmacymanufactures');
    }
};
