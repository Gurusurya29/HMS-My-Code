<?php

use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin\Inpatient\Inpatient;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Admin\Inpatient\Ipadmission;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipforeigners', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Inpatient::class);
            $table->foreignIdFor(Ipadmission::class);
            $table->string('passport')->nullable();
            $table->string('visa_details')->nullable();
            $table->date('visa_expirydate')->nullable();
            $table->string('indian_contactperson')->nullable();
            $table->string('indian_contactphone')->nullable();
            $table->string('foreign_contactperson')->nullable();
            $table->string('foreign_contactphone')->nullable();
            $table->string('lang_knowntopatient')->nullable();
            $table->string('lang_knowntocaretaker')->nullable();

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
        Schema::dropIfExists('ipforeigners');
    }
};
