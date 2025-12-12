<?php

use App\Models\Admin\Settings\Ipsetting\Ipservicecategory;
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
        Schema::create('ipservicemasters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipservicecategory::class);
            $table->string('name')->index()->unique();
            $table->double('insurancefee', 10, 2);
            $table->double('selffee', 10, 2);
            $table->boolean('is_package', array(0, 1))->default(0);
            $table->boolean('is_otservice', array(0, 1))->default(0);

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
        Schema::dropIfExists('ipservicemasters');
    }
};
