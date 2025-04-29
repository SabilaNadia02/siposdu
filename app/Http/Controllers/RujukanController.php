<?php

namespace App\Http\Controllers;

use App\Models\Rujukan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RujukanController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::all();
        $rujukan = Rujukan::with('pendaftaran')
            ->orderBy('waktu_rujukan', 'desc')
            ->paginate(10);

        $totalRujukan = Rujukan::count();
        $totalLaki = Rujukan::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_kelamin', '1');
        })->count();
        $totalPerempuan = Rujukan::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_kelamin', '2');
        })->count();

        return view('rujukan.index', compact(
            'rujukan',
            'totalRujukan',
            'totalLaki',
            'totalPerempuan',
            'pendaftarans',
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'waktu_rujukan' => 'required|date',
            'jenis_rujukan' => 'required',
            'keterangan' => 'nullable|string|max:255'
        ]);

        try {
            $keterangan = $request->keterangan ? ucwords(strtolower($request->keterangan)) : null;

            Rujukan::create([
                'no_pendaftaran' => $request->no_pendaftaran,
                'waktu_rujukan' => $request->waktu_rujukan,
                'jenis_rujukan' => $request->jenis_rujukan,
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('rujukan.index')
                ->with('success', 'Data rujukan berhasil disimpan');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show(Rujukan $rujukan)
    {
        return view('rujukan.show', compact('rujukan'));
    }

    public function edit(Rujukan $rujukan)
    {
        $pendaftarans = Pendaftaran::all();
        return view('rujukan.edit', compact('rujukan', 'pendaftarans'));
    }

    public function update(Request $request, Rujukan $rujukan)
    {
        $request->validate([
            'jenis_rujukan' => 'nullable',
            'keterangan' => 'nullable|string|max:255'
        ]);

        try {
            $keterangan = $request->keterangan ? ucwords(strtolower($request->keterangan)) : null;

            $rujukan->update([
                'jenis_rujukan' => $request->jenis_rujukan,
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('rujukan.index')
                ->with('success', 'Data rujukan berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Rujukan $rujukan)
    {
        try {
            $rujukan->delete();
            return redirect()->route('rujukan.index')
                ->with('success', 'Data rujukan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
