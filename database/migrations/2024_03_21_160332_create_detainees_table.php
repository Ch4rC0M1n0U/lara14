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
        Schema::create('detainees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthdate');
            $table->string('sexe');
            $table->foreignId('cell_id')
                ->constrained('cells')
                ->unique()
                ->NoActionOnUpdate()
                ->NoActionOnDelete()
                ->required();
            $table->foreignId('service_id')
                ->constrained('services')
                ->NoActionOnUpdate()
                ->NoActionOnDelete()
                ->required();
            $table->foreignId('priv_lib_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->cascadeOnDelete()
                ->required();
            $table->string('SSType')
                ->nullable();
            $table->foreignId('liberation_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->NoActionOnDelete()
                ->nullable();
            $table->foreignId('trusted_contact_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->cascadeOnDelete()
                ->nullable();
            $table->boolean('isolement')
                ->default(false);
            $table->string('RplNum')
            ->required();
            $table->string('Salduz')
                ->nullable();
            $table->string('DevRest')
                ->nullable();
            $table->foreignId('notice_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->cascadeOnDelete()
                ->nullable();
            $table->string('user_created')
                ->nullable();
            $table->string('Audition')
                ->nullable();
            $table->string('PrintTrypt')
                ->nullable();
            $table->foreignId('contention_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->cascadeOnDelete()
                ->nullable();
            $table->string('bac')
                ->nullable();
            $table->string('Prohibe')
                ->nullable();
            $table->foreignId('incident_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->cascadeOnDelete()
                ->nullable();
            $table->string('EqCharge')
                ->nullable();
            $table->boolean('Avocate')
                ->default(false);
            $table->boolean('ProhiValImp')
                ->default(false);
            $table->string('SurvCam')
                ->nullable();
            $table->foreignId('medical_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->cascadeOnDelete()
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detainees');
    }
};
