<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteria;
use App\Models\Kriteria;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::with(['subKriterias' => function($q) {
            $q->orderBy('nilai', 'desc');
        }])->orderBy('kode', 'asc')->get();

        return view('sub_kriteria.index', compact('kriterias'));
    }

    public function create(Request $request)
    {
        // Restrict creation to admin and petugas
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return redirect()->route('sub-kriteria.index')->with('error', 'Hanya administrator dan petugas yang dapat mengelola skala penilaian.');
        }

        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $selectedKriteriaId = $request->query('kriteria_id');

        return view('sub_kriteria.create', compact('kriterias', 'selectedKriteriaId'));
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return redirect()->route('sub-kriteria.index')->with('error', 'Hanya administrator dan petugas yang dapat mengelola skala penilaian.');
        }

        $validated = $request->validate([
            'kriteria_id' => ['required', 'exists:kriterias,id'],
            'nama_subkriteria' => ['required', 'string', 'max:255'],
            'nilai' => ['required', 'integer', 'min:1', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
        ], [
            'kriteria_id.required' => 'Kriteria induk wajib dipilih.',
            'kriteria_id.exists' => 'Kriteria yang dipilih tidak valid.',
            'nama_subkriteria.required' => 'Nama subkriteria / deskripsi skala wajib diisi.',
            'nilai.required' => 'Nilai skor bobot skala wajib diisi.',
            'nilai.integer' => 'Nilai skor bobot skala harus berupa bilangan bulat.',
            'nilai.min' => 'Nilai skor minimal adalah 1.',
            'nilai.max' => 'Nilai skor maksimal adalah 100.',
        ]);

        $sub = SubKriteria::create($validated);
        $kriteria = Kriteria::find($sub->kriteria_id);

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Tambah Subkriteria',
            'deskripsi' => 'Berhasil menambahkan skala "' . $sub->nama_subkriteria . '" dengan skor ' . $sub->nilai . ' pada kriteria ' . $kriteria->nama_kriteria . ' (' . $kriteria->kode . ').',
        ]);

        return redirect()->route('sub-kriteria.index')->with('success', 'Skala penilaian baru berhasil ditambahkan.');
    }

    public function edit(SubKriteria $subKriterium)
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        return view('sub_kriteria.edit', compact('subKriterium', 'kriterias'));
    }

    public function update(Request $request, SubKriteria $subKriterium)
    {
        $validated = $request->validate([
            'kriteria_id' => ['required', 'exists:kriterias,id'],
            'nama_subkriteria' => ['required', 'string', 'max:255'],
            'nilai' => ['required', 'integer', 'min:1', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
        ], [
            'kriteria_id.required' => 'Kriteria induk wajib dipilih.',
            'kriteria_id.exists' => 'Kriteria yang dipilih tidak valid.',
            'nama_subkriteria.required' => 'Nama subkriteria / deskripsi skala wajib diisi.',
            'nilai.required' => 'Nilai skor bobot skala wajib diisi.',
            'nilai.integer' => 'Nilai skor bobot skala harus berupa bilangan bulat.',
            'nilai.min' => 'Nilai skor minimal adalah 1.',
            'nilai.max' => 'Nilai skor maksimal adalah 100.',
        ]);

        $subKriterium->update($validated);
        $kriteria = Kriteria::find($subKriterium->kriteria_id);

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Ubah Subkriteria',
            'deskripsi' => 'Berhasil memperbarui skala "' . $subKriterium->nama_subkriteria . '" menjadi skor ' . $subKriterium->nilai . ' pada kriteria ' . $kriteria->nama_kriteria . ' (' . $kriteria->kode . ').',
        ]);

        return redirect()->route('sub-kriteria.index')->with('success', 'Skala penilaian berhasil diperbarui.');
    }

    public function destroy(SubKriteria $subKriterium)
    {
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return redirect()->route('sub-kriteria.index')->with('error', 'Hanya administrator dan petugas yang dapat mengelola skala penilaian.');
        }

        $nama = $subKriterium->nama_subkriteria;
        $nilai = $subKriterium->nilai;
        $kriteria = Kriteria::find($subKriterium->kriteria_id);

        $subKriterium->delete();

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Hapus Subkriteria',
            'deskripsi' => 'Berhasil menghapus skala "' . $nama . '" (Skor: ' . $nilai . ') dari kriteria ' . $kriteria->nama_kriteria . ' (' . $kriteria->kode . ').',
        ]);

        return redirect()->route('sub-kriteria.index')->with('success', 'Skala penilaian berhasil dihapus.');
    }
}
