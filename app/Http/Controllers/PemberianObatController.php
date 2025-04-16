<?php

namespace App\Http\Controllers;

use App\Models\DataObat;
use App\Models\DataPosyandu;
use App\Models\PemberianObat;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemberianObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posyandus = DataPosyandu::all();
        $pendaftarans = Pendaftaran::all();
        $dataObat = DataObat::all();
        $query = PemberianObat::with(['pendaftaran', 'obat'])
            ->orderBy('id', 'desc');
            
        // Apply filters
        // if ($request->has('tahun') && $request->tahun != '') {
        //     $query->whereYear('waktu_pemberian', $request->tahun);
        // }

        // if ($request->has('bulan') && $request->bulan != '') {
        //     $query->whereMonth('waktu_pemberian', $request->bulan);
        // }

        // if ($request->has('posyandu') && $request->posyandu != '') {
        //     $query->whereHas('pendaftaran', function($q) use ($request) {
        //         $q->where('data_posyandu_id', $request->posyandu);
        //     });
        // }

        // if ($request->has('sasaran') && $request->sasaran != '') {
        //     $query->whereHas('pendaftaran', function($q) use ($request) {
        //         $q->where('jenis_sasaran', $request->sasaran);
        //     });
        // }

        $pemberianObat = $query->paginate(10);
        $totalPemberian = PemberianObat::count();

        return view('pemberian.obat.index', compact('pemberianObat', 'totalPemberian', 'posyandus', 'pendaftarans', 'dataObat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'id_obat' => 'required|exists:data_obats,id',
            'dosis' => 'required|string|max:100',
            'waktu_pemberian' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            PemberianObat::create([
                'no_pendaftaran' => $request->no_pendaftaran,
                'id_obat' => $request->id_obat,
                'dosis' => $request->dosis,
                'waktu_pemberian' => $request->waktu_pemberian,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('pemberian.obat.index')
                ->with('success', 'Data pemberian obat berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pemberianObat = PemberianObat::with(['pendaftaran', 'obat'])->findOrFail($id);
        return response()->json($pemberianObat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_obat' => 'required|exists:data_obats,id',
            'dosis' => 'required|string|max:100',
            'waktu_pemberian' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $pemberianObat = PemberianObat::findOrFail($id);
            $pemberianObat->update([
                'id_obat' => $request->id_obat,
                'dosis' => $request->dosis,
                'waktu_pemberian' => $request->waktu_pemberian,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('pemberian.obat.index')
                ->with('success', 'Data pemberian obat berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pemberianObat = PemberianObat::findOrFail($id);
            $pemberianObat->delete();

            return redirect()->route('pemberian.obat.index')
                ->with('success', 'Data pemberian obat berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Get medicine data for select options
     */
    public function getObatOptions()
    {
        $obat = DataObat::all();
        return response()->json($obat);
    }
}
