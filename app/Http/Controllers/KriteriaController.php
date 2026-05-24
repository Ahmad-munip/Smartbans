<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        return view('kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        // Restrict creation to admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('kriteria.index')->with('error', 'Hanya administrator yang dapat menambah kriteria baru.');
        }
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('kriteria.index')->with('error', 'Hanya administrator yang dapat menambah kriteria baru.');
        }

        $validated = $request->validate([
            'kode' => ['required', 'string', 'unique:kriterias,kode', 'max:10'],
            'nama_kriteria' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'in:benefit,cost'],
            'bobot' => ['required', 'numeric', 'min:0', 'max:1'],
            'deskripsi' => ['nullable', 'string'],
        ], [
            'kode.required' => 'Kode kriteria wajib diisi.',
            'kode.unique' => 'Kode kriteria sudah digunakan.',
            'nama_kriteria.required' => 'Nama kriteria wajib diisi.',
            'jenis.required' => 'Jenis kriteria wajib diisi.',
            'bobot.required' => 'Bobot kriteria wajib diisi.',
            'bobot.numeric' => 'Bobot kriteria harus berupa angka pecahan.',
            'bobot.min' => 'Bobot minimal adalah 0.',
            'bobot.max' => 'Bobot maksimal adalah 1.',
        ]);

        $kriteria = Kriteria::create($validated);

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Tambah Kriteria',
            'deskripsi' => 'Berhasil menambahkan kriteria baru: ' . $kriteria->nama_kriteria . ' (' . $kriteria->kode . ').',
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriterium)
    {
        $kriteria = $kriterium; // laravel model binding maps route {kriteria} to variable $kriterium.
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriterium)
    {
        $kriteria = $kriterium;
        
        $validated = $request->validate([
            'kode' => ['required', 'string', Rule::unique('kriterias', 'kode')->ignore($kriteria->id), 'max:10'],
            'nama_kriteria' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'in:benefit,cost'],
            'bobot' => ['required', 'numeric', 'min:0', 'max:1'],
            'deskripsi' => ['nullable', 'string'],
        ], [
            'kode.required' => 'Kode kriteria wajib diisi.',
            'kode.unique' => 'Kode kriteria sudah digunakan.',
            'nama_kriteria.required' => 'Nama kriteria wajib diisi.',
            'jenis.required' => 'Jenis kriteria wajib diisi.',
            'bobot.required' => 'Bobot kriteria wajib diisi.',
            'bobot.numeric' => 'Bobot kriteria harus berupa angka pecahan.',
            'bobot.min' => 'Bobot minimal adalah 0.',
            'bobot.max' => 'Bobot maksimal adalah 1.',
        ]);

        $kriteria->update($validated);

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Ubah Kriteria',
            'deskripsi' => 'Berhasil memperbarui kriteria ' . $kriteria->nama_kriteria . ' (' . $kriteria->kode . ').',
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriterium)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('kriteria.index')->with('error', 'Hanya administrator yang dapat menghapus kriteria.');
        }

        $nama = $kriterium->nama_kriteria;
        $kode = $kriterium->kode;

        $kriterium->delete();

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Hapus Kriteria',
            'deskripsi' => 'Berhasil menghapus kriteria ' . $nama . ' (' . $kode . ').',
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
