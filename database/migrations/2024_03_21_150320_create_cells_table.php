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
        Schema::create('cells', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->Integer('CellNum')
            ->unsigned()
            ->unique();
            $table->string('CellType')
            ->nullable();
            $table->integer('CellMax')
            ->default(1)
            ->nullable();
            $table->boolean('CellMinor')
            ->default(false);
            $table->integer('CellRest')
            ->nullable(true);
            $table->string('CellStat')
            ->nullable();
            $table->string('created_by')
            ->nullable();
            $table->string('updated_by')
            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cells');
    }
};
