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
        Schema::create('train_schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('train_id', false, true);
            $table->bigInteger("from", false, true);
            $table->bigInteger("to", false, true);
            $table->dateTime("departure_time");
            $table->dateTime("arrival_time");
            $table->timestamps();
            //FORIGN KEY CHEKS
            $table->foreign("train_id")->on("trains")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("from")->on("locations")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("to")->on("locations")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('train_schedules');
    }
};
