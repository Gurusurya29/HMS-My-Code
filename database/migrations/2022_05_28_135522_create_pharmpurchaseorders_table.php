<?php

use App\Models\Admin\Settings\Supplier\Supplier;
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
        Schema::create('pharmpurchaseorders', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Supplier::class);
            $table->string('supplier_companyname');
            $table->string('supplier_mobile_no');
            $table->string('supplier_contact_name');
            $table->string('planning_date');

            $table->double('grand_total', 10, 2);
            $table->double('round_off', 10, 2);
            $table->double('taxamt', 10, 2);
            $table->double('taxableamt', 10, 2);

            $table->double('cgst', 10, 2);
            $table->double('sgst', 10, 2);

            $table->text('note')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->uuid('uuid')->unique();
            $table->integer('sequence_id');
            $table->morphs('creatable');
            $table->nullableMorphs('updatable');
            $table->boolean('active', array(0, 1))->default(1);

            $table->boolean('po_status', array(0, 1))->default(0);
            //Quantity Mangement
            //0 - PO Not Fully Completed
            //1 - PO Completed

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
        Schema::dropIfExists('pharmpurchaseorders');
    }
};
