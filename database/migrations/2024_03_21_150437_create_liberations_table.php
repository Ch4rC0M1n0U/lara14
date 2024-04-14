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
        Schema::create('liberations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('liberationDateHour')->nullable();
            $table->boolean('dev_Before')->default(false);
            $table->boolean('avis_Before')->default(false);
            $table->boolean('mat_Before')->default(false);
            $table->boolean('libe_Before')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liberations');
    }
};
