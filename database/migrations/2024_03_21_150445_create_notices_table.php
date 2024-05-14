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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('person_noticed')
                ->nullable(true);
            $table->string('typePerson')
                ->nullable(true);
            $table->dateTime('Notice_DateHour')
                ->nullable(true);
            $table->string('Canal_Notice')
                ->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
