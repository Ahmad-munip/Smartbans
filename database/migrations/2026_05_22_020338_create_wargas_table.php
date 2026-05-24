<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('desa');
            $table->string('no_hp')->nullable();
            $table->string('pekerjaan');
            $table->decimal('penghasilan', 15, 2);
            $table->integer('jumlah_tanggungan');
            $table->string('kondisi_rumah');
            $table->string('status_bantuan_sebelumnya');
            $table->string('kepemilikan_aset')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
