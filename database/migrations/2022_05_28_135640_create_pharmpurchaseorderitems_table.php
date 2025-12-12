<?php

use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;
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
        Schema::create('pharmpurchaseorderitems', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Pharmpurchaseorder::class);
            $table->foreignIdFor(Pharmacyproduct::class);

            $table->string('pharmacyproduct_name');

            $table->string('pharmacyproduct_code')->nullable();
            $table->string('pharmacyproduct_hsn')->nullable();

            $table->string('genaric_name')->nullable();
            $table->string('manufacture_name')->nullable();

            $table->double('price', 10, 2);
            $table->integer('quantity');

            $table->integer('received_quantity')->default(0);

            $table->double('sgst', 10, 2);
            $table->double('sgst_amt', 10, 2);
            $table->double('cgst', 10, 2);
            $table->double('cgst_amt', 10, 2);
            $table->double('igst', 10, 2)->nullable();
            $table->double('igst_amt', 10, 2)->nullable();
            $table->double('cess', 10, 2)->nullable();
            $table->double('cess_amt', 10, 2)->nullable();

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
        Schema::dropIfExists('pharmpurchaseorderitems');
    }
};
