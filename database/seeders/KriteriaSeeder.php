<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use App\Models\SubKriteria;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Penghasilan (C1, Cost)
        $c1 = Kriteria::create([
            'kode' => 'C1',
            'nama_kriteria' => 'Penghasilan Bulanan',
            'jenis' => 'cost',
            'bobot' => 0.30,
            'deskripsi' => 'Rata-rata pendapatan bulanan kepala keluarga. Semakin rendah semakin berhak mendapat bantuan.',
        ]);
        SubKriteria::create(['kriteria_id' => $c1->id, 'nama_subkriteria' => '< Rp 1.000.000', 'nilai' => 5]);
        SubKriteria::create(['kriteria_id' => $c1->id, 'nama_subkriteria' => 'Rp 1.000.000 - Rp 2.000.000', 'nilai' => 4]);
        SubKriteria::create(['kriteria_id' => $c1->id, 'nama_subkriteria' => 'Rp 2.000.001 - Rp 3.000.000', 'nilai' => 3]);
        SubKriteria::create(['kriteria_id' => $c1->id, 'nama_subkriteria' => 'Rp 3.000.001 - Rp 5.000.000', 'nilai' => 2]);
        SubKriteria::create(['kriteria_id' => $c1->id, 'nama_subkriteria' => '> Rp 5.000.000', 'nilai' => 1]);

        // 2. Jumlah Tanggungan (C2, Benefit)
        $c2 = Kriteria::create([
            'kode' => 'C2',
            'nama_kriteria' => 'Jumlah Tanggungan',
            'jenis' => 'benefit',
            'bobot' => 0.25,
            'deskripsi' => 'Jumlah anggota keluarga yang menjadi tanggungan hidup.',
        ]);
        SubKriteria::create(['kriteria_id' => $c2->id, 'nama_subkriteria' => '>= 5 Orang', 'nilai' => 5]);
        SubKriteria::create(['kriteria_id' => $c2->id, 'nama_subkriteria' => '4 Orang', 'nilai' => 4]);
        SubKriteria::create(['kriteria_id' => $c2->id, 'nama_subkriteria' => '3 Orang', 'nilai' => 3]);
        SubKriteria::create(['kriteria_id' => $c2->id, 'nama_subkriteria' => '2 Orang', 'nilai' => 2]);
        SubKriteria::create(['kriteria_id' => $c2->id, 'nama_subkriteria' => '1 Orang', 'nilai' => 1]);

        // 3. Kondisi Rumah (C3, Benefit)
        $c3 = Kriteria::create([
            'kode' => 'C3',
            'nama_kriteria' => 'Kondisi Rumah',
            'jenis' => 'benefit',
            'bobot' => 0.20,
            'deskripsi' => 'Tingkat kelayakan kondisi fisik tempat tinggal.',
        ]);
        SubKriteria::create(['kriteria_id' => $c3->id, 'nama_subkriteria' => 'Sangat Buruk (Lantai tanah, dinding bambu, reyot)', 'nilai' => 5]);
        SubKriteria::create(['kriteria_id' => $c3->id, 'nama_subkriteria' => 'Buruk (Dinding kayu/bata tanpa plester, atap bocor)', 'nilai' => 4]);
        SubKriteria::create(['kriteria_id' => $c3->id, 'nama_subkriteria' => 'Cukup (Dinding bata permanen sederhana, semi permanen)', 'nilai' => 3]);
        SubKriteria::create(['kriteria_id' => $c3->id, 'nama_subkriteria' => 'Baik (Rumah permanen, bersih, lantai keramik)', 'nilai' => 2]);
        SubKriteria::create(['kriteria_id' => $c3->id, 'nama_subkriteria' => 'Sangat Baik (Rumah mewah/besar, bertingkat)', 'nilai' => 1]);

        // 4. Status Pekerjaan (C4, Benefit)
        $c4 = Kriteria::create([
            'kode' => 'C4',
            'nama_kriteria' => 'Status Pekerjaan',
            'jenis' => 'benefit',
            'bobot' => 0.15,
            'deskripsi' => 'Jenis pekerjaan atau mata pencaharian kepala keluarga.',
        ]);
        SubKriteria::create(['kriteria_id' => $c4->id, 'nama_subkriteria' => 'Tidak Bekerja / Pengangguran', 'nilai' => 5]);
        SubKriteria::create(['kriteria_id' => $c4->id, 'nama_subkriteria' => 'Buruh Harian Lepas', 'nilai' => 4]);
        SubKriteria::create(['kriteria_id' => $c4->id, 'nama_subkriteria' => 'Petani Kecil / Nelayan Kecil', 'nilai' => 3]);
        SubKriteria::create(['kriteria_id' => $c4->id, 'nama_subkriteria' => 'Karyawan Swasta Tidak Tetap / Wiraswasta Mikro', 'nilai' => 2]);
        SubKriteria::create(['kriteria_id' => $c4->id, 'nama_subkriteria' => 'PNS / Karyawan BUMN / Karyawan Tetap Swasta', 'nilai' => 1]);

        // 5. Kepemilikan Aset (C5, Cost)
        $c5 = Kriteria::create([
            'kode' => 'C5',
            'nama_kriteria' => 'Kepemilikan Aset',
            'jenis' => 'cost',
            'bobot' => 0.10,
            'deskripsi' => 'Jumlah barang berharga atau aset bernilai ekonomis yang dimiliki.',
        ]);
        SubKriteria::create(['kriteria_id' => $c5->id, 'nama_subkriteria' => 'Tidak Memiliki Aset Apapun', 'nilai' => 5]);
        SubKriteria::create(['kriteria_id' => $c5->id, 'nama_subkriteria' => 'Memiliki Aset Kecil (Elektronik murah, sepeda)', 'nilai' => 4]);
        SubKriteria::create(['kriteria_id' => $c5->id, 'nama_subkriteria' => 'Memiliki Motor (1 unit kendaraan roda dua)', 'nilai' => 3]);
        SubKriteria::create(['kriteria_id' => $c5->id, 'nama_subkriteria' => 'Memiliki Mobil / Tanah (Aset produktif/bernilai tinggi)', 'nilai' => 2]);
        SubKriteria::create(['kriteria_id' => $c5->id, 'nama_subkriteria' => 'Memiliki Banyak Aset Mewah', 'nilai' => 1]);
    }
}
