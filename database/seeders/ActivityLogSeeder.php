<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $petugas = User::where('role', 'petugas')->first();
        $operator = User::where('role', 'operator')->first();

        if ($admin) {
            ActivityLog::create([
                'user_id' => $admin->id,
                'aktivitas' => 'Input Bobot Kriteria AHP',
                'deskripsi' => 'Admin memperbarui perbandingan berpasangan AHP dan melakukan validasi konsistensi.',
                'created_at' => now()->subMinutes(15),
            ]);
            ActivityLog::create([
                'user_id' => $admin->id,
                'aktivitas' => 'Melakukan Perhitungan TOPSIS',
                'deskripsi' => 'Admin melakukan pemrosesan data warga melalui metode TOPSIS untuk mendapatkan ranking.',
                'created_at' => now()->subHours(2),
            ]);
        }

        if ($petugas) {
            ActivityLog::create([
                'user_id' => $petugas->id,
                'aktivitas' => 'Menambahkan Warga Baru',
                'deskripsi' => 'Menambahkan data warga a.n. Budi Santoso (Desa Ringinarum).',
                'created_at' => now()->subMinutes(45),
            ]);
            ActivityLog::create([
                'user_id' => $petugas->id,
                'aktivitas' => 'Verifikasi Berkas Warga',
                'deskripsi' => 'Melakukan verifikasi kelengkapan berkas KTP/KK untuk warga di Desa Caruban.',
                'created_at' => now()->subHours(4),
            ]);
        }

        if ($operator) {
            ActivityLog::create([
                'user_id' => $operator->id,
                'aktivitas' => 'Input Data Warga',
                'deskripsi' => 'Memasukkan data kuesioner kelayakan warga a.n. Siti Aminah.',
                'created_at' => now()->subHours(5),
            ]);
        }
    }
}
