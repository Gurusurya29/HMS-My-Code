<?php

use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Purchase\Purchasereturn\Pharmpurchasereturn;
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
        Schema::create('purchasereturnitems', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Pharmpurchasereturn::class);
            $table->foreignIdFor(Pharmpurchaseentryitem::class);
            $table->foreignIdFor(Pharmacyproduct::class);

            $table->integer('return_quantity');

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
        Schema::dropIfExists('purchasereturnitems');
    }
};
