<?php

use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Billing\Opbilling\Opbilling;
use App\Models\Admin\Billing\Otbilling\Otbilling;
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
        Schema::create('hospitalstatements', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('userable');
            $table->integer('user_type')->default(0); // 1-Patient,2-Employee,3-Supplier, 4-others
            $table->foreignIdFor(Opbilling::class)->nullable();
            $table->foreignIdFor(Ipbilling::class)->nullable();
            $table->foreignIdFor(Otbilling::class)->nullable();
            $table->double('credit', 12, 2)->nullable();
            $table->double('debit', 12, 2)->nullable();

            $table->double('self_fee', 12, 2)->nullable();
            $table->double('insurance_fee', 12, 2)->nullable();
            $table->integer('type')->default(0); // 0-None,1-Discount,2-Advance
            $table->text('note')->nullable();

            $table->integer('entity_type')->nullable(); // 1-HMS,2-Investigation,3-Pharmacy
            $table->char('transaction_type');

            $table->string('statement_ref_id')->nullable();

            $table->nullableMorphs('hstatementable');
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
        Schema::dropIfExists('hospitalstatements');
    }
};
