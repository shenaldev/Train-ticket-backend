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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id', false, true);
            $table->bigInteger("reservation_id", false, true);
            $table->integer('discount', false, true)->nullable();
            $table->double("amount", 8, 2);
            $table->timestamps();
            //FORIGN KEY CHECKS
            $table->foreign("reservation_id")->on("reservations")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("user_id")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
