<?php

use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentryitem;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturn;
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
        Schema::create('pharmsalesreturnitems', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Pharmsalesentryitem::class);
            $table->foreignIdFor(Pharmacyproduct::class);
            $table->foreignIdFor(Pharmsalesreturn::class);

            $table->string('return_quantity');

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
        Schema::dropIfExists('pharmsalesreturnitems');
    }
};
