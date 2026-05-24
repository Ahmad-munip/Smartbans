# PLAN.md — Project BanSmart

## 1. Identitas Project

**Nama Aplikasi:** BanSmart  
**Jenis Aplikasi:** Sistem Pendukung Keputusan berbasis web responsive  
**Judul Skripsi:** Sistem Pendukung Keputusan Penentuan Prioritas Bantuan Sosial Menggunakan Metode AHP dan TOPSIS di Kecamatan Ringinarum  
**Target Pengguna:** Admin Kecamatan, Petugas Kecamatan, Operator Data Bantuan Sosial  
**Platform:** Web responsive, nyaman digunakan di desktop dan mobile  

---

## 2. Deskripsi Singkat

BanSmart adalah aplikasi Sistem Pendukung Keputusan untuk membantu Kecamatan Ringinarum menentukan prioritas penerima bantuan sosial secara lebih objektif, cepat, dan terukur.

Aplikasi menggunakan dua metode utama:

1. **AHP (Analytical Hierarchy Process)**  
   Digunakan untuk menentukan bobot prioritas tiap kriteria melalui matriks perbandingan berpasangan dan validasi konsistensi.

2. **TOPSIS (Technique for Order Preference by Similarity to Ideal Solution)**  
   Digunakan untuk menentukan ranking warga berdasarkan nilai preferensi akhir.

Aplikasi harus memiliki tampilan modern seperti aplikasi QRIS/e-wallet: clean, card-based, responsive, warna dominan biru dan hijau emerald, mudah dipresentasikan saat sidang skripsi.

---

## 3. Tujuan Aplikasi

Aplikasi BanSmart dibuat untuk:

- Membantu proses seleksi penerima bantuan sosial.
- Mengurangi subjektivitas dalam penentuan penerima bantuan.
- Mengotomatisasi proses perhitungan AHP dan TOPSIS.
- Menyediakan ranking prioritas penerima bantuan.
- Menyediakan laporan PDF, Excel, dan print.
- Memudahkan petugas kecamatan dalam mengelola data warga dan hasil seleksi.

---

## 4. Stack Teknologi yang Direkomendasikan

Gunakan stack yang sederhana, stabil, dan cocok untuk skripsi.

### Backend

- Laravel 11/12
- PHP 8.2+
- MySQL

### Frontend

- Blade Template
- Tailwind CSS atau Bootstrap 5
- JavaScript dasar
- Chart.js untuk grafik dashboard

### Library Tambahan Laravel

- Laravel Breeze untuk authentication
- Laravel Excel untuk export Excel
- DomPDF atau Snappy PDF untuk export PDF
- SweetAlert2 untuk notifikasi interaktif
- DataTables atau tabel custom untuk pencarian/filter

---

## 5. Role Pengguna

### 5.1 Admin

Admin memiliki akses penuh terhadap sistem.

Fitur Admin:

- Login/logout
- Mengelola data warga
- Mengelola data kriteria
- Mengelola subkriteria atau skala penilaian
- Menginput matriks perbandingan AHP
- Melihat hasil bobot AHP
- Mengecek Consistency Ratio
- Melakukan perhitungan TOPSIS
- Melihat hasil ranking
- Export PDF/Excel
- Melihat dashboard statistik
- Mengelola data petugas/operator

### 5.2 Petugas

Petugas fokus pada pengelolaan data warga.

Fitur Petugas:

- Login/logout
- Tambah data warga
- Edit data warga
- Lihat detail data warga
- Melihat hasil seleksi
- Cetak laporan tertentu jika diizinkan

### 5.3 Operator

Operator berfokus pada input dan validasi data bantuan sosial.

Fitur Operator:

- Login/logout
- Input data warga
- Validasi kelengkapan data warga
- Melihat status hasil seleksi

---

## 6. Modul Utama Aplikasi

### 6.1 Authentication

Halaman dan fitur:

- Login
- Logout
- Session login
- Role-based access
- Forgot password opsional

Catatan UI:

- Login dibuat modern seperti fintech/e-wallet.
- Gunakan gradient biru-hijau.
- Ada logo BanSmart.
- Ada tagline: “Sistem Pendukung Keputusan Bantuan Sosial”.

---

### 6.2 Dashboard

Dashboard menjadi halaman utama setelah login.

Komponen dashboard:

- Card total data warga
- Card total kriteria
- Card total penerima layak
- Card total warga tidak layak
- Card ranking tertinggi
- Grafik penerima bantuan
- Grafik status kelayakan
- Aktivitas terbaru
- Shortcut ke menu penting

Gaya visual:

- Modern seperti QRIS/e-wallet.
- Rounded card.
- Soft shadow.
- Gradient header.
- Icon flat modern.
- Mobile responsive.

---

### 6.3 Data Warga

Modul CRUD data warga.

Fitur:

- Tambah data warga
- Edit data warga
- Hapus data warga
- Detail data warga
- Search data warga
- Filter berdasarkan desa, RT/RW, status bantuan, hasil seleksi
- Upload foto KTP/KK opsional

Field data warga:

- NIK
- Nama lengkap
- Alamat
- RT
- RW
- Desa
- No HP
- Pekerjaan
- Penghasilan
- Jumlah tanggungan
- Kondisi rumah
- Status bantuan sebelumnya
- Kepemilikan aset
- Foto KTP opsional
- Foto KK opsional

Validasi penting:

- NIK wajib unik.
- Nama wajib diisi.
- Penghasilan harus numerik.
- Jumlah tanggungan harus numerik.
- Desa wajib diisi.

---

### 6.4 Data Kriteria

Modul untuk mengatur kriteria penilaian.

Fitur:

- Tambah kriteria
- Edit kriteria
- Hapus kriteria
- Atur jenis kriteria Benefit/Cost
- Melihat bobot hasil AHP

Contoh kriteria:

| Kode | Nama Kriteria | Jenis | Penjelasan |
|---|---|---|---|
| C1 | Penghasilan | Cost | Semakin rendah semakin prioritas |
| C2 | Jumlah Tanggungan | Benefit | Semakin banyak semakin prioritas |
| C3 | Kondisi Rumah | Benefit | Semakin buruk semakin prioritas |
| C4 | Status Pekerjaan | Benefit | Semakin tidak tetap semakin prioritas |
| C5 | Kepemilikan Aset | Cost | Semakin sedikit aset semakin prioritas |

Catatan:

- Bobot tidak diinput manual sebagai hasil akhir.
- Bobot utama dihitung dari AHP.
- Field bobot boleh ada di database untuk menyimpan hasil perhitungan AHP.

---

### 6.5 Skala Penilaian / Subkriteria

Agar data kualitatif bisa dihitung, setiap nilai harus dikonversi ke angka.

Contoh skala:

#### Kondisi Rumah

| Kondisi | Nilai |
|---|---:|
| Sangat Buruk | 5 |
| Buruk | 4 |
| Cukup | 3 |
| Baik | 2 |
| Sangat Baik | 1 |

#### Status Pekerjaan

| Status | Nilai |
|---|---:|
| Tidak Bekerja | 5 |
| Buruh Harian | 4 |
| Petani/Nelayan Kecil | 3 |
| Karyawan Tidak Tetap | 2 |
| PNS/Karyawan Tetap | 1 |

#### Kepemilikan Aset

| Aset | Nilai |
|---|---:|
| Tidak Memiliki Aset | 5 |
| Memiliki Aset Kecil | 4 |
| Memiliki Motor | 3 |
| Memiliki Mobil | 2 |
| Memiliki Banyak Aset | 1 |

Catatan:

- Pastikan semua data yang masuk TOPSIS sudah berbentuk angka.
- Skala harus konsisten dengan jenis Benefit/Cost.

---

### 6.6 Perbandingan Berpasangan AHP

Modul ini digunakan untuk input matriks perbandingan antar kriteria.

Fitur:

- Menampilkan daftar kriteria dalam bentuk matriks.
- Admin memilih nilai perbandingan skala Saaty 1 sampai 9.
- Sistem otomatis mengisi nilai kebalikan.
- Sistem menghitung total kolom.
- Sistem melakukan normalisasi matriks.
- Sistem menghitung bobot prioritas.
- Sistem menghitung nilai eigen.
- Sistem menghitung Consistency Index.
- Sistem menghitung Consistency Ratio.
- Sistem menampilkan status konsistensi.

Skala Saaty:

| Nilai | Keterangan |
|---:|---|
| 1 | Sama penting |
| 3 | Sedikit lebih penting |
| 5 | Lebih penting |
| 7 | Sangat penting |
| 9 | Mutlak lebih penting |
| 2,4,6,8 | Nilai antara |

Validasi:

- Jika CR <= 0.1, matriks konsisten.
- Jika CR > 0.1, tampilkan alert bahwa perbandingan perlu diperbaiki.

Output AHP:

- Matriks perbandingan
- Matriks normalisasi
- Bobot prioritas kriteria
- Lambda max
- Consistency Index
- Consistency Ratio
- Status konsistensi

---

### 6.7 Perhitungan TOPSIS

TOPSIS digunakan untuk menentukan ranking warga.

Input TOPSIS:

- Data warga sebagai alternatif.
- Nilai setiap warga terhadap setiap kriteria.
- Bobot kriteria dari hasil AHP.
- Jenis kriteria Benefit/Cost.

Tahapan perhitungan TOPSIS:

1. Membentuk matriks keputusan.
2. Melakukan normalisasi matriks keputusan.
3. Membentuk matriks normalisasi terbobot.
4. Menentukan solusi ideal positif.
5. Menentukan solusi ideal negatif.
6. Menghitung jarak ke solusi ideal positif.
7. Menghitung jarak ke solusi ideal negatif.
8. Menghitung nilai preferensi.
9. Mengurutkan ranking dari nilai tertinggi ke terendah.

Output TOPSIS:

- Nilai normalisasi
- Nilai terbobot
- Solusi ideal positif
- Solusi ideal negatif
- Jarak D+ dan D-
- Nilai preferensi
- Ranking warga
- Status layak/tidak layak

Catatan status layak:

- Bisa berdasarkan kuota, misalnya top 50 warga dinyatakan layak.
- Bisa berdasarkan threshold nilai preferensi, misalnya nilai >= 0.6 layak.
- Untuk skripsi, lebih mudah menggunakan kuota penerima bantuan agar jelas saat presentasi.

---

### 6.8 Hasil Seleksi

Halaman hasil seleksi menampilkan ranking akhir penerima bantuan.

Fitur:

- Tabel ranking warga
- Nama warga
- NIK
- Desa
- Nilai preferensi
- Ranking
- Status layak/tidak layak
- Tombol detail perhitungan
- Filter status layak/tidak layak
- Search nama/NIK
- Export PDF
- Export Excel
- Print laporan

Tampilan detail:

- Data warga
- Nilai tiap kriteria
- Bobot AHP
- Nilai TOPSIS
- Ranking akhir
- Status rekomendasi

---

### 6.9 Laporan

Jenis laporan:

- Laporan data warga
- Laporan kriteria
- Laporan hasil AHP
- Laporan hasil TOPSIS
- Laporan penerima bantuan
- Laporan statistik bantuan sosial

Format export:

- PDF
- Excel
- Print

Isi laporan hasil seleksi:

- Kop Kecamatan Ringinarum
- Judul laporan
- Periode seleksi
- Tabel ranking
- Nilai preferensi
- Status kelayakan
- Tanggal cetak
- Kolom tanda tangan pejabat/petugas

---

### 6.10 Notifikasi

Notifikasi internal aplikasi:

- Data warga berhasil ditambahkan.
- Data warga berhasil diperbarui.
- Data warga belum lengkap.
- Matriks AHP tidak konsisten.
- Perhitungan TOPSIS berhasil.
- Laporan berhasil diexport.

Gunakan:

- Toast notification
- Alert card
- Badge status

---

## 7. Struktur Menu Sidebar

Menu utama aplikasi:

1. Dashboard
2. Data Warga
3. Data Kriteria
4. Skala Penilaian
5. Perbandingan AHP
6. Perhitungan TOPSIS
7. Hasil Ranking
8. Laporan
9. Pengguna
10. Profil Admin
11. Logout

Untuk role Petugas, menu bisa dibatasi:

1. Dashboard
2. Data Warga
3. Hasil Ranking
4. Laporan
5. Profil
6. Logout

---

## 8. Halaman Aplikasi

### 8.1 Splash Screen

Tujuan:

- Memberi kesan aplikasi mobile modern.
- Cocok untuk demo sidang.

Elemen:

- Logo BanSmart
- Gradient biru-hijau
- Tagline
- Loading animation sederhana

### 8.2 Login

Elemen:

- Logo
- Email/username
- Password
- Tombol login
- Forgot password opsional

### 8.3 Dashboard

Elemen:

- Greeting user
- Statistik card
- Grafik
- Activity terbaru
- Shortcut action

### 8.4 Data Warga

Elemen:

- Tabel responsive
- Search
- Filter
- Button tambah
- Button edit/detail/hapus

### 8.5 Data Kriteria

Elemen:

- Tabel kriteria
- Jenis Benefit/Cost
- Bobot AHP
- Button tambah/edit/hapus

### 8.6 Perbandingan AHP

Elemen:

- Matriks input
- Dropdown nilai skala Saaty
- Button hitung
- Hasil bobot
- Hasil CR
- Alert konsistensi

### 8.7 Perhitungan TOPSIS

Elemen:

- Button proses hitung
- Preview matriks keputusan
- Hasil normalisasi
- Hasil preferensi
- Button simpan ranking

### 8.8 Hasil Ranking

Elemen:

- Tabel ranking
- Badge layak/tidak layak
- Filter
- Detail
- Export

### 8.9 Laporan

Elemen:

- Pilih jenis laporan
- Filter periode/desa
- Export PDF
- Export Excel
- Print

### 8.10 Profile Admin

Elemen:

- Nama
- Email
- Role
- Ubah password
- Foto profil opsional

---

## 9. Rancangan Database Awal

Gunakan database MySQL.

### 9.1 users

Menyimpan data akun login.

Field:

- id
- name
- email
- password
- role: admin, petugas, operator
- phone nullable
- photo nullable
- created_at
- updated_at

### 9.2 warga

Menyimpan data warga calon penerima bantuan.

Field:

- id
- nik unique
- nama_lengkap
- alamat
- rt
- rw
- desa
- no_hp nullable
- pekerjaan
- penghasilan
- jumlah_tanggungan
- kondisi_rumah
- status_bantuan_sebelumnya
- kepemilikan_aset
- foto_ktp nullable
- foto_kk nullable
- created_by nullable
- created_at
- updated_at

### 9.3 kriterias

Menyimpan data kriteria penilaian.

Field:

- id
- kode
- nama_kriteria
- jenis: benefit/cost
- bobot nullable
- deskripsi nullable
- created_at
- updated_at

### 9.4 sub_kriterias / skala_penilaians

Menyimpan skala nilai untuk data kualitatif.

Field:

- id
- kriteria_id
- nama_subkriteria
- nilai
- deskripsi nullable
- created_at
- updated_at

### 9.5 ahp_comparisons

Menyimpan nilai perbandingan berpasangan AHP.

Field:

- id
- kriteria_pertama_id
- kriteria_kedua_id
- nilai
- created_at
- updated_at

### 9.6 ahp_results

Menyimpan hasil perhitungan AHP.

Field:

- id
- kriteria_id
- bobot
- lambda_max nullable
- consistency_index nullable
- consistency_ratio nullable
- is_consistent boolean
- created_at
- updated_at

### 9.7 nilai_wargas

Menyimpan nilai warga terhadap tiap kriteria.

Field:

- id
- warga_id
- kriteria_id
- nilai
- created_at
- updated_at

### 9.8 topsis_results

Menyimpan hasil ranking TOPSIS.

Field:

- id
- warga_id
- nilai_d_plus
- nilai_d_minus
- nilai_preferensi
- ranking
- status: layak/tidak_layak
- created_at
- updated_at

### 9.9 activity_logs

Menyimpan aktivitas terbaru untuk dashboard.

Field:

- id
- user_id nullable
- aktivitas
- deskripsi nullable
- created_at
- updated_at

---

## 10. Relasi Database

Relasi utama:

- User has many Warga.
- Kriteria has many SubKriteria.
- Warga has many NilaiWarga.
- Kriteria has many NilaiWarga.
- Warga has one TopsisResult.
- Kriteria has one AhpResult.

---

## 11. Alur Sistem dari Awal sampai Akhir

1. Admin login ke sistem.
2. Admin/petugas menginput data warga.
3. Admin menginput atau mengecek data kriteria.
4. Admin mengatur skala penilaian.
5. Admin mengisi matriks perbandingan AHP.
6. Sistem menghitung bobot AHP.
7. Sistem mengecek Consistency Ratio.
8. Jika CR tidak konsisten, admin memperbaiki perbandingan.
9. Jika CR konsisten, bobot disimpan.
10. Sistem mengambil nilai warga untuk setiap kriteria.
11. Sistem menjalankan perhitungan TOPSIS.
12. Sistem menghasilkan nilai preferensi.
13. Sistem mengurutkan ranking warga.
14. Sistem menentukan status layak/tidak layak.
15. Admin/petugas melihat hasil ranking.
16. Admin mengekspor laporan PDF/Excel.
17. Hasil digunakan sebagai rekomendasi prioritas penerima bantuan sosial.

---

## 12. Rumus dan Logika Metode

### 12.1 AHP

Langkah AHP:

1. Membuat matriks perbandingan berpasangan.
2. Menjumlahkan setiap kolom matriks.
3. Melakukan normalisasi dengan membagi setiap nilai dengan total kolom.
4. Menghitung rata-rata setiap baris sebagai bobot prioritas.
5. Menghitung lambda max.
6. Menghitung Consistency Index:

```text
CI = (lambda_max - n) / (n - 1)
```

7. Menghitung Consistency Ratio:

```text
CR = CI / RI
```

8. Jika CR <= 0.1, matriks dianggap konsisten.

Nilai Random Index:

| n | RI |
|---:|---:|
| 1 | 0.00 |
| 2 | 0.00 |
| 3 | 0.58 |
| 4 | 0.90 |
| 5 | 1.12 |
| 6 | 1.24 |
| 7 | 1.32 |
| 8 | 1.41 |
| 9 | 1.45 |
| 10 | 1.49 |

### 12.2 TOPSIS

Langkah TOPSIS:

1. Matriks keputusan:

```text
X = nilai alternatif terhadap kriteria
```

2. Normalisasi:

```text
Rij = Xij / sqrt(sum(Xij^2))
```

3. Matriks terbobot:

```text
Yij = Rij * Wj
```

4. Solusi ideal positif dan negatif:

Untuk Benefit:

```text
A+ = nilai maksimum
A- = nilai minimum
```

Untuk Cost:

```text
A+ = nilai minimum
A- = nilai maksimum
```

5. Jarak solusi ideal:

```text
D+ = sqrt(sum((Yij - A+)^2))
D- = sqrt(sum((Yij - A-)^2))
```

6. Nilai preferensi:

```text
V = D- / (D+ + D-)
```

7. Ranking:

```text
Nilai V tertinggi = prioritas tertinggi
```

---

## 13. Konsep UI/UX

### Tema Visual

- Modern
- Minimalis
- Clean
- Premium
- Mirip QRIS/e-wallet
- Cocok untuk demo sidang

### Warna Utama

- Biru gradient
- Hijau emerald
- Putih
- Abu muda

### Komponen UI

- Rounded card
- Soft shadow
- Gradient header
- Sidebar modern
- Bottom navigation opsional untuk mobile
- Badge status
- Icon modern
- Tabel responsive
- Empty state yang rapi

### Gaya Dashboard

Dashboard harus terlihat seperti aplikasi finansial modern:

- Header berisi sapaan user.
- Card statistik besar.
- Grafik ringkas.
- Menu shortcut.
- Activity terbaru.

---

## 14. Prioritas Pengerjaan

Kerjakan aplikasi secara bertahap agar mudah dikontrol.

### Tahap 1 — Setup Project

- Buat project Laravel.
- Setup database MySQL.
- Setup authentication.
- Setup layout utama.
- Setup role user.

### Tahap 2 — UI Dasar

- Buat splash screen.
- Buat login page modern.
- Buat dashboard layout.
- Buat sidebar/navbar responsive.
- Buat komponen card statistik.

### Tahap 3 — CRUD Data Master

- CRUD data warga.
- CRUD data kriteria.
- CRUD skala penilaian.
- CRUD user/petugas.

### Tahap 4 — AHP

- Buat halaman matriks perbandingan.
- Buat input skala Saaty.
- Buat perhitungan bobot AHP.
- Buat validasi CR.
- Simpan bobot hasil AHP.

### Tahap 5 — TOPSIS

- Buat matriks keputusan.
- Ambil nilai warga terhadap kriteria.
- Gunakan bobot AHP.
- Hitung TOPSIS.
- Simpan hasil ranking.

### Tahap 6 — Hasil & Laporan

- Buat halaman hasil ranking.
- Buat detail hasil perhitungan.
- Buat status layak/tidak layak.
- Export PDF.
- Export Excel.
- Print laporan.

### Tahap 7 — Finishing

- Rapikan UI.
- Tambahkan grafik.
- Tambahkan notifikasi.
- Tambahkan validasi data.
- Tambahkan seed data demo.
- Uji alur presentasi.

---

## 15. Seed Data Demo untuk Sidang

Siapkan data dummy agar aplikasi siap dipresentasikan.

Minimal:

- 1 akun admin
- 1 akun petugas
- 5 kriteria
- 20 sampai 50 data warga dummy
- Nilai skala tiap warga
- Hasil AHP konsisten
- Hasil TOPSIS sudah bisa ranking

Contoh akun:

```text
Admin
email: admin@bansmart.test
password: password

Petugas
email: petugas@bansmart.test
password: password
```

---

## 16. Catatan Penting untuk Vibe Coding di Antigravity

Saat membuat aplikasi dengan Antigravity, jangan langsung generate semua fitur sekaligus.

Gunakan pendekatan bertahap:

1. Minta Antigravity memahami file `plan.md` ini.
2. Minta buat struktur project Laravel terlebih dahulu.
3. Minta buat database migration sesuai rancangan.
4. Minta buat auth dan role.
5. Minta buat layout UI modern.
6. Minta buat CRUD satu modul dulu, mulai dari Data Warga.
7. Setelah stabil, lanjut Data Kriteria.
8. Setelah CRUD aman, baru masuk AHP.
9. Setelah AHP benar, baru masuk TOPSIS.
10. Setelah ranking benar, baru export laporan.

Hindari perintah seperti:

```text
Buatkan semua aplikasi lengkap sekarang.
```

Gunakan perintah bertahap seperti:

```text
Baca plan.md ini. Kita akan membuat aplikasi Laravel BanSmart. Jangan coding dulu. Pahami struktur project, fitur, database, dan metode AHP-TOPSIS. Setelah paham, jelaskan kembali arsitektur yang akan dibuat.
```

Lalu lanjut:

```text
Sekarang buatkan migration database untuk tabel users, warga, kriterias, sub_kriterias, ahp_comparisons, ahp_results, nilai_wargas, topsis_results, dan activity_logs sesuai plan.md.
```

---

## 17. Prompt Awal untuk Antigravity

Gunakan prompt ini sebagai pembuka:

```text
Saya ingin membuat aplikasi skripsi bernama BanSmart menggunakan Laravel dan MySQL.

Baca dan pahami file plan.md terlebih dahulu. Jangan langsung membuat semua kode.

Tugas awal kamu:
1. Pahami tujuan aplikasi.
2. Pahami fitur utama.
3. Pahami role pengguna.
4. Pahami struktur database.
5. Pahami alur metode AHP dan TOPSIS.
6. Berikan rencana implementasi Laravel secara bertahap.
7. Jangan membuat kode sebelum saya minta.

Aplikasi ini harus responsive, modern, clean, dengan konsep UI seperti QRIS/e-wallet menggunakan warna biru gradient dan hijau emerald.
```

---

## 18. Prompt Lanjutan Setelah Antigravity Paham

Setelah Antigravity menjelaskan ulang, gunakan prompt ini:

```text
Sekarang mulai tahap pertama.

Buat setup awal Laravel untuk aplikasi BanSmart:
1. Authentication login/logout.
2. Role user: admin, petugas, operator.
3. Layout utama dashboard dengan sidebar responsive.
4. Tema UI modern warna biru-hijau.
5. Struktur folder Blade yang rapi.
6. Jangan buat modul AHP dan TOPSIS dulu.

Pastikan hasilnya stabil sebelum lanjut ke modul data warga.
```

---

## 19. Hal yang Harus Dihindari

- Jangan mencampur AHP dan TOPSIS dalam satu controller besar.
- Jangan membuat UI terlalu ramai.
- Jangan hardcode semua nilai kriteria.
- Jangan membuat perhitungan tanpa menyimpan hasilnya.
- Jangan membuat export laporan sebelum data dan ranking stabil.
- Jangan membuat React/Vue jika belum perlu.
- Jangan menggunakan terlalu banyak library yang menyulitkan saat sidang.

---

## 20. Struktur Controller yang Disarankan

Controller yang disarankan:

- DashboardController
- WargaController
- KriteriaController
- SubKriteriaController
- AhpController
- TopsisController
- HasilSeleksiController
- LaporanController
- UserController
- ProfileController

Service class yang disarankan:

- AhpService
- TopsisService
- ReportService

Tujuan service class:

- Memisahkan logika perhitungan dari controller.
- Membuat kode lebih rapi.
- Memudahkan penjelasan saat sidang.

---

## 21. Target Akhir Aplikasi

Aplikasi dianggap selesai jika sudah memiliki:

- Login role admin/petugas/operator.
- Dashboard modern.
- CRUD data warga.
- CRUD kriteria.
- Skala penilaian.
- Input perbandingan AHP.
- Perhitungan bobot AHP.
- Validasi Consistency Ratio.
- Perhitungan TOPSIS.
- Ranking prioritas warga.
- Status layak/tidak layak.
- Detail perhitungan.
- Export PDF.
- Export Excel.
- Tampilan responsive.
- Data dummy untuk demo sidang.

---

## 22. Catatan Presentasi Sidang

Saat presentasi, jelaskan alur seperti ini:

1. Masalah: Seleksi bantuan sosial sering subjektif dan memakan waktu.
2. Solusi: BanSmart membantu seleksi berbasis SPK.
3. Metode: AHP menentukan bobot, TOPSIS menentukan ranking.
4. Data: Warga dinilai berdasarkan kriteria sosial ekonomi.
5. Output: Ranking prioritas penerima bantuan.
6. Manfaat: Seleksi lebih cepat, objektif, dan transparan.

---

## 23. Kesimpulan Project

BanSmart adalah aplikasi SPK yang menggabungkan AHP dan TOPSIS untuk membantu Kecamatan Ringinarum menentukan prioritas penerima bantuan sosial.

Aplikasi harus dibuat stabil, mudah digunakan, rapi secara UI, dan mudah dijelaskan secara akademik.

Fokus utama bukan hanya tampilan, tetapi juga:

- Kejelasan alur data.
- Ketepatan metode AHP.
- Ketepatan metode TOPSIS.
- Laporan hasil seleksi.
- Kemudahan presentasi sidang.
