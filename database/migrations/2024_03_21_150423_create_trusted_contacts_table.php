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
        Schema::create('trusted_contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email');
            $table->string('relationType');
            $table->string('cypeOfContact');
            $table->dateTime('contact_DateHour');
            $table->boolean('contactOk')->default(false);
            $table->boolean('contactRefused')->default(false);
            $table->string('motivation_Refusal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trusted_contacts');
    }
};
