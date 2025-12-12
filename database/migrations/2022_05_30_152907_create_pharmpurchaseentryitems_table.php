<?php

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentry;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorderitem;
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
        Schema::create('pharmpurchaseentryitems', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Pharmpurchaseentry::class);
            $table->foreignIdFor(Pharmacyproduct::class);
            $table->foreignIdFor(Pharmpurchaseorderitem::class)->nullable();
            $table->foreignIdFor(Supplier::class);

            $table->string('batch');
            $table->date('expiry_date');
            $table->integer('quantity');

            $table->double('disc', 10, 2)->default(0);
            $table->double('sgst', 10, 2);
            $table->double('sgst_amt', 10, 2);
            $table->double('cgst', 10, 2);
            $table->double('cgst_amt', 10, 2);
            $table->double('igst', 10, 2)->nullable();
            $table->double('igst_amt', 10, 2)->nullable();
            $table->double('cess', 10, 2)->nullable();
            $table->double('cess_amt', 10, 2)->nullable();

            $table->integer('received_quantity');
            $table->integer('saled_quantity')->default(0);
            $table->integer('fromsalereturn_quant')->default(0);
            $table->integer('tosupplierreturn_quant')->default(0);

            $table->double('purchase_price', 10, 2);
            $table->double('selling_price', 10, 2);
            $table->double('total', 10, 2);

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
        Schema::dropIfExists('pharmpurchaseentryitems');
    }
};
