<?php

namespace App\Http\Controllers;

use App\Models\DataObat;
use App\Models\PemberianObat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PemberianObatController extends Controller
{
    public function index(Request $request)
    {
        $pendaftarans = Pendaftaran::all();
        $dataObat = DataObat::all()->keyBy('id');

        $query = PemberianObat::with('pendaftaran')
            ->orderBy('waktu_pemberian', 'desc');

        $pemberianObat = $query->paginate(10);
        $totalPemberian = PemberianObat::count();

        return view('pemberian.obat.index', compact(
            'pemberianObat',
            'totalPemberian',
            'pendaftarans',
            'dataObat'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'waktu_pemberian' => 'required|date',
            'id_obat' => 'required|array',
            'id_obat.*' => 'exists:data_obats,id',
            'dosis' => 'required|array',
            'dosis.*' => 'string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $keterangan = $request->keterangan ? ucfirst(strtolower($request->keterangan)) : null;

            $obatData = [];
            foreach ($request->id_obat as $index => $idObat) {
                $obatData[] = [
                    'id' => $index + 1,
                    'id_obat' => $idObat,
                    'dosis' => $request->dosis[$index],
                ];
            }

            PemberianObat::create([
                'no_pendaftaran' => $request->no_pendaftaran,
                'waktu_pemberian' => $request->waktu_pemberian,
                'data' => json_encode($obatData),
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('pemberian.obat.index')
                ->with('success', 'Data pemberian obat berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $pemberianObat = PemberianObat::with(['pendaftaran'])->findOrFail($id);
        return response()->json($pemberianObat);
    }

    public function edit($id)
    {
        $pemberianObat = PemberianObat::findOrFail($id);

        // @dd($pemberianObat);

        $pendaftarans = Pendaftaran::all();
        $dataObat = DataObat::all();

        return view('pemberian.obat.edit', compact('pemberianObat', 'pendaftarans', 'dataObat'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'waktu_pemberian' => 'required|date',
            'id_obat' => 'required|array',
            'id_obat.*' => 'exists:data_obats,id',
            'dosis' => 'required|array',
            'dosis.*' => 'string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $pemberianObat = PemberianObat::findOrFail($id);

            $keterangan = $request->keterangan ? ucfirst(strtolower($request->keterangan)) : null;

            $obatData = [];
            foreach ($request->id_obat as $index => $idObat) {
                $obatData[] = [
                    'id' => $index + 1,
                    'id_obat' => $idObat,
                    'dosis' => $request->dosis[$index],
                ];
            }

            $pemberianObat->update([
                'waktu_pemberian' => $request->waktu_pemberian,
                'data' => json_encode($obatData),
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('pemberian.obat.index')
                ->with('success', 'Data pemberian obat berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
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
}
