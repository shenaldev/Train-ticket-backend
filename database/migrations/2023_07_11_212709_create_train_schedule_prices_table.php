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
        Schema::create('train_schedule_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("schedule_id", false, true);
            $table->bigInteger("class_id", false, true);
            $table->double("price", 8, 2, true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('train_schedule_prices');
    }
};
