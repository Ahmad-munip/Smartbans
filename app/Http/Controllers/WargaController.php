<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::query();

        // 1. Search Filter
        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('pekerjaan', 'like', "%{$search}%");
            });
        }

        // 2. Village Filter
        if ($request->filled('desa')) {
            $query->where('desa', $request->query('desa'));
        }

        // 3. Sorting
        $sortBy = $request->query('sort_by', 'created_at');
        $sortDir = $request->query('sort_dir', 'desc');
        
        $allowedSortFields = ['nama_lengkap', 'penghasilan', 'jumlah_tanggungan', 'created_at'];
        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Get paginated results
        $wargas = $query->paginate(10)->withQueryString();

        // Get unique villages for filter dropdown
        $villages = Warga::select('desa')->distinct()->pluck('desa')->toArray();

        return view('warga.index', compact('wargas', 'villages'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'numeric', 'digits:16', 'unique:wargas,nik'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'rt' => ['required', 'string', 'max:5'],
            'rw' => ['required', 'string', 'max:5'],
            'desa' => ['required', 'string', 'max:100'],
            'no_hp' => ['nullable', 'numeric', 'digits_between:10,15'],
            'pekerjaan' => ['required', 'string', 'max:100'],
            'penghasilan' => ['required', 'numeric', 'min:0'],
            'jumlah_tanggungan' => ['required', 'integer', 'min:0'],
            'kondisi_rumah' => ['required', 'string'],
            'status_bantuan_sebelumnya' => ['required', 'string'],
            'kepemilikan_aset' => ['required', 'string'],
            'foto_ktp' => ['nullable', 'image', 'max:2048'], // Max 2MB
            'foto_kk' => ['nullable', 'image', 'max:2048'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus berukuran 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar dalam sistem.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'desa.required' => 'Desa wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'penghasilan.required' => 'Penghasilan wajib diisi.',
            'penghasilan.numeric' => 'Penghasilan harus berupa nominal angka.',
            'jumlah_tanggungan.required' => 'Jumlah tanggungan wajib diisi.',
            'kondisi_rumah.required' => 'Kondisi rumah wajib diisi.',
            'status_bantuan_sebelumnya.required' => 'Status bantuan sebelumnya wajib diisi.',
            'kepemilikan_aset.required' => 'Kepemilikan aset wajib diisi.',
            'foto_ktp.image' => 'File foto KTP harus berupa gambar.',
            'foto_ktp.max' => 'Ukuran foto KTP tidak boleh melebihi 2MB.',
            'foto_kk.image' => 'File foto KK harus berupa gambar.',
            'foto_kk.max' => 'Ukuran foto KK tidak boleh melebihi 2MB.',
        ]);

        // Handles photo uploads
        if ($request->hasFile('foto_ktp')) {
            $ktpPath = $request->file('foto_ktp')->store('public/uploads/ktp');
            $validated['foto_ktp'] = Storage::url($ktpPath);
        }
        if ($request->hasFile('foto_kk')) {
            $kkPath = $request->file('foto_kk')->store('public/uploads/kk');
            $validated['foto_kk'] = Storage::url($kkPath);
        }

        $validated['created_by'] = Auth::id();

        $warga = Warga::create($validated);

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Tambah Warga',
            'deskripsi' => 'Berhasil menambahkan data warga baru a.n. ' . $warga->nama_lengkap . ' (NIK: ' . $warga->nik . ').',
        ]);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        return response()->json($warga);
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'nik' => ['required', 'numeric', 'digits:16', Rule::unique('wargas', 'nik')->ignore($warga->id)],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'rt' => ['required', 'string', 'max:5'],
            'rw' => ['required', 'string', 'max:5'],
            'desa' => ['required', 'string', 'max:100'],
            'no_hp' => ['nullable', 'numeric', 'digits_between:10,15'],
            'pekerjaan' => ['required', 'string', 'max:100'],
            'penghasilan' => ['required', 'numeric', 'min:0'],
            'jumlah_tanggungan' => ['required', 'integer', 'min:0'],
            'kondisi_rumah' => ['required', 'string'],
            'status_bantuan_sebelumnya' => ['required', 'string'],
            'kepemilikan_aset' => ['required', 'string'],
            'foto_ktp' => ['nullable', 'image', 'max:2048'],
            'foto_kk' => ['nullable', 'image', 'max:2048'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus berukuran 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar dalam sistem.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'desa.required' => 'Desa wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'penghasilan.required' => 'Penghasilan wajib diisi.',
            'penghasilan.numeric' => 'Penghasilan harus berupa nominal angka.',
            'jumlah_tanggungan.required' => 'Jumlah tanggungan wajib diisi.',
            'kondisi_rumah.required' => 'Kondisi rumah wajib diisi.',
            'status_bantuan_sebelumnya.required' => 'Status bantuan sebelumnya wajib diisi.',
            'kepemilikan_aset.required' => 'Kepemilikan aset wajib diisi.',
            'foto_ktp.image' => 'File foto KTP harus berupa gambar.',
            'foto_ktp.max' => 'Ukuran foto KTP tidak boleh melebihi 2MB.',
            'foto_kk.image' => 'File foto KK harus berupa gambar.',
            'foto_kk.max' => 'Ukuran foto KK tidak boleh melebihi 2MB.',
        ]);

        // Handles photo uploads
        if ($request->hasFile('foto_ktp')) {
            // Delete old file
            if ($warga->foto_ktp) {
                $oldPath = str_replace('/storage/', 'public/', $warga->foto_ktp);
                Storage::delete($oldPath);
            }
            $ktpPath = $request->file('foto_ktp')->store('public/uploads/ktp');
            $validated['foto_ktp'] = Storage::url($ktpPath);
        }
        if ($request->hasFile('foto_kk')) {
            // Delete old file
            if ($warga->foto_kk) {
                $oldPath = str_replace('/storage/', 'public/', $warga->foto_kk);
                Storage::delete($oldPath);
            }
            $kkPath = $request->file('foto_kk')->store('public/uploads/kk');
            $validated['foto_kk'] = Storage::url($kkPath);
        }

        $warga->update($validated);

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Ubah Warga',
            'deskripsi' => 'Berhasil memperbarui data warga a.n. ' . $warga->nama_lengkap . ' (NIK: ' . $warga->nik . ').',
        ]);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        // Deletions are restricted to admin and petugas
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return back()->with('error', 'Anda tidak memiliki hak akses untuk menghapus data warga.');
        }

        $nama = $warga->nama_lengkap;
        $nik = $warga->nik;

        // Delete files
        if ($warga->foto_ktp) {
            $ktpPath = str_replace('/storage/', 'public/', $warga->foto_ktp);
            Storage::delete($ktpPath);
        }
        if ($warga->foto_kk) {
            $kkPath = str_replace('/storage/', 'public/', $warga->foto_kk);
            Storage::delete($kkPath);
        }

        $warga->delete();

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Hapus Warga',
            'deskripsi' => 'Berhasil menghapus data warga a.n. ' . $nama . ' (NIK: ' . $nik . ').',
        ]);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
