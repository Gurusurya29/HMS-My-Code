<?php

use App\Models\Admin\Settings\Patientregisterationsetting\Country;
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
        Schema::create('states', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Country::class);
            $table->string('name');
            $table->string('code')->nullable();
            $table->boolean('union_territories')->nullable();

            $table->text('note')->nullable();
            $table->uuid('uuid')->unique();
            $table->nullableMorphs('creatable');
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
        Schema::dropIfExists('states');
    }
};
