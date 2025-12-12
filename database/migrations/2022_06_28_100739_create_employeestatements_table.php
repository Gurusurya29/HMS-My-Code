<?php

use App\Models\Admin\Employee\Employee;
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
        Schema::create('employeestatements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->double('credit', 12, 2)->nullable();
            $table->double('debit', 12, 2)->nullable();

            $table->double('self_fee', 12, 2)->nullable();
            $table->double('insurance_fee', 12, 2)->nullable();
            $table->text('note')->nullable();

            $table->integer('entity_type')->nullable(); // 1-HMS,2-Investigation,3-Pharmacy
            $table->char('transaction_type');

            $table->string('statement_ref_id')->nullable();

            $table->nullableMorphs('statementable');
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
        Schema::dropIfExists('employeestatements');
    }
};
