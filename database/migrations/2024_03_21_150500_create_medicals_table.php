<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('medtype')->default(false);
            $table->boolean('hospital_transfert')->default(false);
            $table->boolean('medecin')->default(false);
            $table->boolean('surveillance')->default(false);
            $table->dateTime('datehour_transfert');
            $table->dateTime('datehour_return');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicals');
    }
};
