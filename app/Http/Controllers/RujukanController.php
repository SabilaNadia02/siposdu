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
        $totalLaki = Rujukan::whereHas('pendaftaran', function($query) {
            $query->where('jenis_kelamin', '1');
        })->count();
        $totalPerempuan = Rujukan::whereHas('pendaftaran', function($query) {
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
            Rujukan::create($request->all());
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
            $rujukan->update($request->all());
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

    // public function filter(Request $request)
    // {
    //     $query = Rujukan::with('pendaftaran');

    //     if ($request->tahun) {
    //         $query->whereYear('waktu_rujukan', $request->tahun);
    //     }

    //     if ($request->bulan) {
    //         $query->whereMonth('waktu_rujukan', $request->bulan);
    //     }

    //     if ($request->posyandu) {
    //         $query->whereHas('pendaftaran', function($q) use ($request) {
    //             $q->where('posyandu', $request->posyandu);
    //         });
    //     }

    //     if ($request->sasaran) {
    //         $query->whereHas('pendaftaran', function($q) use ($request) {
    //             $q->where('jenis_peserta', $request->sasaran);
    //         });
    //     }

    //     $rujukan = $query->orderBy('waktu_rujukan', 'desc')->paginate(10);

    //     return view('rujukan.partials.table', compact('rujukan'));
    // }
}
