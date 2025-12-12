<?php

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;
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
        Schema::create('pharmpurchaseentries', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Pharmpurchaseorder::class);
            $table->foreignIdFor(Supplier::class);
            $table->string('purchaseorder_uniqid');

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
        Schema::dropIfExists('pharmpurchaseentries');
    }
};
