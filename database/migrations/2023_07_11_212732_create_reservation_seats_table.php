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
        Schema::create('reservation_seats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("reservation_id", false, true);
            $table->int("seat_no", false, true);
            $table->timestamps();
            //FORIGN KEY CHECKS
            $table->foreign("reservation_id")->on("reservations")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_seats');
    }
};
