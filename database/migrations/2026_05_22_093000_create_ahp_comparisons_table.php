<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ahp_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_pertama_id')->constrained('kriterias')->onDelete('cascade');
            $table->foreignId('kriteria_kedua_id')->constrained('kriterias')->onDelete('cascade');
            $table->double('nilai');
            $table->timestamps();

            // Prevent duplicate pairs
            $table->unique(['kriteria_pertama_id', 'kriteria_kedua_id'], 'comparison_pair_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ahp_comparisons');
    }
};
