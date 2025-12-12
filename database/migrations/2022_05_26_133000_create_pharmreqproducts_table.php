<?php

use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use App\Models\Pharmacy\Settings\Category\Pharmacysubcategory;
use App\Models\Pharmacy\Settings\Drugmaster\Genaric\Pharmacygenaric;
use App\Models\Pharmacy\Settings\Drugmaster\Manufacture\Pharmacymanufacture;
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
        Schema::create('pharmreqproducts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pharmacygenaric::class)->nullable();
            $table->foreignIdFor(Pharmacymanufacture::class)->nullable();
            $table->foreignIdFor(Pharmacycategory::class)->nullable();
            $table->foreignIdFor(Pharmacysubcategory::class)->nullable();
            $table->string('name');

            $table->string('product_code')->nullable();
            $table->string('product_sku')->nullable();

            $table->string('hsn')->nullable();
            $table->double('min_stock', 10, 2)->nullable();

            $table->double('mrp', 10, 2)->nullable();
            $table->double('purchase_rate', 10, 2)->nullable();

            $table->double('sgst', 10, 2)->nullable();
            $table->double('cgst', 10, 2)->nullable();
            $table->double('igst', 10, 2)->nullable();
            $table->double('cess', 10, 2)->nullable();

            $table->boolean('stock_required', array(0, 1))->default(0);
            $table->boolean('is_schedule', array(0, 1))->default(0);
            $table->boolean('active', array(0, 1))->default(1);

            $table->bigInteger('stock')->default(0);

            $table->text('note')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->uuid('uuid')->unique();
            $table->integer('sequence_id');
            $table->morphs('creatable');
            $table->nullableMorphs('updatable');

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
        Schema::dropIfExists('pharmreqproducts');
    }
};
