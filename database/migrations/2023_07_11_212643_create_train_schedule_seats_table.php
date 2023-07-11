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
        Schema::create('train_schedule_seats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("schedule_id", false, true);
            $table->bigInteger("class_id", false, true);
            $table->integer("available_count", false, true);
            $table->timestamps();
            //FORIGN KEY CHECKS
            $table->foreign("schedule_id")->on("train_schedules")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("class_id")->on("classes")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('train_schedule_seats');
    }
};
