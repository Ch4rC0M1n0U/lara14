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
        Schema::create('contentions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('autorisedBy');
            $table->dateTime('autorised_DateHour');
            $table->dateTime('contention_DateHour');
            $table->string('motivation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contentions');
    }
};
