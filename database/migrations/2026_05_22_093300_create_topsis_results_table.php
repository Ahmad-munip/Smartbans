<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('topsis_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('wargas')->onDelete('cascade');
            $table->double('nilai_d_plus');
            $table->double('nilai_d_minus');
            $table->double('nilai_preferensi');
            $table->integer('ranking');
            $table->string('status'); // layak, tidak_layak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topsis_results');
    }
};
