<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(strval(config("filament_user_activity.table.name")), function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("user_id")->nullable();
            $table->string("url");

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(strval(config("filament_user_activity.table.name")));
    }
};
