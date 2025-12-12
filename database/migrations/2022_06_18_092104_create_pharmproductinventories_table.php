<?php

use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Purchase\Purchasereturn\Purchasereturnitem;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentryitem;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturnitem;
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
        Schema::create('pharmproductinventories', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Pharmpurchaseentryitem::class)->nullable();
            $table->foreignIdFor(Purchasereturnitem::class)->nullable();
            $table->foreignIdFor(Pharmsalesentryitem::class)->nullable();
            $table->foreignIdFor(Pharmsalesreturnitem::class)->nullable();

            $table->foreignIdFor(Pharmacyproduct::class);

            $table->integer('quantity');
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
        Schema::dropIfExists('pharmproductinventories');
    }
};
