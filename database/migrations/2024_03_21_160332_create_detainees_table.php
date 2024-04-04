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
                ->NoActionOnDelete();
            $table->foreignId('service_id')
                ->constrained('services')
                ->NoActionOnUpdate()
                ->NoActionOnDelete();
            $table->foreignId('priv_lib_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->NoActionOnDelete();
            $table->string('SSType');
            $table->string('MaxPL');
            $table->foreignId('liberation_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->NoActionOnDelete();
            $table->foreignId('trusted_contact_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->NoActionOnDelete();
            $table->boolean('isolement')
                ->default(false);
            $table->string('RplNum');
            $table->boolean('Salduz')
                ->default(false);
            $table->string('DevRest');
            $table->foreignId('notice_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->NoActionOnDelete();
            $table->string('user_created')
                ->get_current_user();
            $table->boolean('Audition')->default(false);
            $table->boolean('PrintTrypt')->default(false);
            $table->foreignId('contention_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->NoActionOnDelete();
            $table->string('bac');
            $table->string('Prohibe');
            $table->foreignId('incident_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->NoActionOnDelete();
            $table->string('EqCharge');
            $table->string('Avocate');
            $table->string('ProhiValImp');
            $table->string('SurvCam');
            $table->foreignId('medical_id')
                ->constrained()
                ->NoActionOnUpdate()
                ->NoActionOnDelete();
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
