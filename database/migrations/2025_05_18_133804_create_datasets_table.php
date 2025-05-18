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
        Schema::create('prediksi_curah_hujan', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->string('month');
            $table->decimal('curah_hujan', 15,5);
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('cuaca_histories', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->string('month');
            $table->decimal('curah_hujan', 15,5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuaca_histories');
        Schema::dropIfExists('prediksi_curah_hujan');
    }
};
