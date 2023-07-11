<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id", false, true);
            $table->bigInteger("schedule_id", false, true);
            $table->bigInteger("class_id", false, true);
            $table->timestamps();
            //FORIGN KEY CHEKS
            $table->foreign("user_id")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("schedule_id")->on("train_schedules")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("class_id")->on("class")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
