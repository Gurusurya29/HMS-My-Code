<?php

use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentry;
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
        Schema::create('pharmsalesentryitems', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Pharmacyproduct::class);
            $table->foreignIdFor(Pharmpurchaseentryitem::class);
            $table->foreignIdFor(Pharmsalesentry::class);

            $table->string('batch');

            $table->date('expiry_date');
            $table->integer('quantity');
            $table->integer('return_quantity')->default(0);
            $table->double('selling_price', 10, 2);

            $table->double('disc', 10, 2)->default(0);
            $table->double('disc_amt', 10, 2);
            $table->double('taxable', 10, 2);
            $table->double('total', 10, 2);

            $table->boolean('is_schedule', array(0, 1))->default(0);

            $table->double('cgst', 10, 2);
            $table->double('cgstamt', 10, 2);
            $table->double('sgst', 10, 2);
            $table->double('sgstamt', 10, 2);
            $table->double('igst', 10, 2)->nullable();
            $table->double('igst_amt', 10, 2)->nullable();
            $table->double('cess', 10, 2)->nullable();
            $table->double('cess_amt', 10, 2)->nullable();

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
        Schema::dropIfExists('pharmsalesentryitems');
    }
};
