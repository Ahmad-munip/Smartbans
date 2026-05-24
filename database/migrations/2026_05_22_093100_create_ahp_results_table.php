<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ahp_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')->constrained('kriterias')->onDelete('cascade');
            $table->double('bobot');
            $table->double('lambda_max')->nullable();
            $table->double('consistency_index')->nullable();
            $table->double('consistency_ratio')->nullable();
            $table->boolean('is_consistent');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ahp_results');
    }
};
