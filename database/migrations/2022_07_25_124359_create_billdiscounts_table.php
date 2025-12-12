<?php

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
        Schema::create('billdiscounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->nullableMorphs('billdiscountable');
            $table->integer('bill_type')->nullable(); // Eg: OP,IP,OT,LAB,PHARM-refer archive
            $table->integer('discount_type')->nullable(); // Eg: Discount,cancel-refer archive
            $table->double('discount_amount', 10, 2);

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
        Schema::dropIfExists('billdiscounts');
    }
};
