<?php

use App\Models\Admin\Settings\Supplier\Supplier;
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
        Schema::create('supplierpharmacyproducts', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Supplier::class);
            $table->foreignIdFor(Pharmacyproduct::class);

            $table->boolean('active');

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
        Schema::dropIfExists('supplierpharmacyproducts');
    }
};
