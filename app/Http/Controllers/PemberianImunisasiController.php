<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemberianImunisasi;
use App\Models\Pendaftaran;
use App\Models\DataImunisasi;
use Carbon\Carbon;

class PemberianImunisasiController extends Controller
{
    public function index()
    {
        $pemberianImunisasi = PemberianImunisasi::with(['pendaftaran', 'imunisasi'])
            ->whereHas('pendaftaran', function ($query) {
                $query->where('jenis_sasaran', 2);
            })
            ->orderBy('waktu_pemberian', 'desc')
            ->paginate(10);

        return view('pemberian.imunisasi.index', compact('pemberianImunisasi'));
    }

    public function create()
    {
        $pendaftaran = Pendaftaran::where('jenis_sasaran', 2)
            ->orderBy('nama', 'asc')
            ->get();

        // Tidak perlu load default imunisasi lagi
        return view('pemberian.imunisasi.create', compact('pendaftaran'));
    }

    public function getImunisasiByUsia(Request $request)
    {
        $request->validate([
            'usia_bulan' => 'required|integer|min:0'
        ]);

        $usiaBulan = $request->usia_bulan;

        // Query untuk mendapatkan imunisasi yang sesuai dengan rentang usia
        $imunisasi = DataImunisasi::where('dari_umur', '<=', $usiaBulan)
            ->where('sampai_umur', '>=', $usiaBulan)
            ->orderBy('dari_umur')
            ->get();

        return response()->json($imunisasi);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftaran,no_pendaftaran',
            'id_imunisasi' => 'required|exists:data_imunisasi,id',
            'waktu_pemberian' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            PemberianImunisasi::create([
                'no_pendaftaran' => $validated['no_pendaftaran'],
                'data_imunisasi_id' => $validated['id_imunisasi'],
                'waktu_pemberian' => $validated['waktu_pemberian'],
                'keterangan' => $validated['keterangan'],
            ]);

            return redirect()->route('pemberian.imunisasi.index')
                ->with('success', 'Data pemberian imunisasi berhasil disimpan');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pemberianImunisasi = PemberianImunisasi::with(['pendaftaran', 'imunisasi'])->findOrFail($id);
        return view('pemberian.imunisasi.show', compact('pemberianImunisasi'));
    }

    public function edit($id)
    {
        $pemberianImunisasi = PemberianImunisasi::findOrFail($id);
        $pendaftaran = Pendaftaran::whereIn('jenis_sasaran', ['bayi', 'balita'])
            ->orderBy('nama', 'asc')
            ->get();
        $dataImunisasi = DataImunisasi::all();

        return view('pemberian.imunisasi.edit', compact('pemberianImunisasi', 'pendaftaran', 'dataImunisasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftaran,no_pendaftaran',
            'data_imunisasi_id' => 'required|exists:data_imunisasi,id',
            'waktu_pemberian' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $pemberianImunisasi = PemberianImunisasi::findOrFail($id);
        $pemberianImunisasi->update([
            'no_pendaftaran' => $request->no_pendaftaran,
            'data_imunisasi_id' => $request->data_imunisasi_id,
            'waktu_pemberian' => $request->waktu_pemberian,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pemberian.imunisasi.index')
            ->with('success', 'Data pemberian imunisasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pemberianImunisasi = PemberianImunisasi::findOrFail($id);
        $pemberianImunisasi->delete();

        return redirect()->route('pemberian.imunisasi.index')
            ->with('success', 'Data pemberian imunisasi berhasil dihapus');
    }
}
