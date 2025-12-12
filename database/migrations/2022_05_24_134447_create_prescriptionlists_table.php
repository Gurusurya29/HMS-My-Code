<?php

use App\Models\Admin\Prescription\Prescription;
use App\Models\Patient\Auth\Patient;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
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
        Schema::create('prescriptionlists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Prescription::class);
            $table->foreignIdFor(Pharmacyproduct::class);
            $table->string('drug_name');
            $table->string('drug_sku');
            $table->boolean('morning', array(0, 1))->default(0);
            $table->boolean('afternoon', array(0, 1))->default(0);
            $table->boolean('evening', array(0, 1))->default(0);
            $table->boolean('night', array(0, 1))->default(0);
            $table->boolean('before_food', array(0, 1))->default(0);
            $table->boolean('after_food', array(0, 1))->default(0);
            $table->string('count');

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
        Schema::dropIfExists('prescriptionlists');
    }
};
