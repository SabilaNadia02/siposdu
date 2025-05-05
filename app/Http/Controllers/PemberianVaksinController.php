<?php

namespace App\Http\Controllers;

use App\Models\DataVaksin;
use App\Models\PemberianVaksin;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PemberianVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pendaftarans = Pendaftaran::all();
        $dataVaksin = DataVaksin::all()->keyBy('id');

        $query = PemberianVaksin::with('pendaftaran')
            ->orderBy('waktu_pemberian', 'desc');

        $pemberianVaksin = $query->paginate(10);
        $totalPemberian = PemberianVaksin::count();

        $totalLaki = PemberianVaksin::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_kelamin', 1);
        })->count();

        $totalPerempuan = PemberianVaksin::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_kelamin', 2);
        })->count();

        return view('pemberian.vaksin.index', compact(
            'pemberianVaksin',
            'totalPemberian',
            'totalLaki',
            'totalPerempuan',
            'pendaftarans',
            'dataVaksin'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'waktu_pemberian' => 'required|date',
            'id_vaksin' => 'required|array',
            'id_vaksin.*' => 'exists:data_vaksins,id',
            'dosis' => 'required|array',
            'dosis.*' => 'string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $vaksinData = [];
            foreach ($request->id_vaksin as $index => $idVaksin) {
                $vaksinData[] = [
                    'id' => $index + 1,
                    'id_vaksin' => $idVaksin,
                    'dosis' => $request->dosis[$index],
                ];
            }

            $keterangan = $request->keterangan ? ucfirst(strtolower($request->keterangan)) : null;

            PemberianVaksin::create([
                'no_pendaftaran' => $request->no_pendaftaran,
                'waktu_pemberian' => $request->waktu_pemberian,
                'data' => json_encode($vaksinData),
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('pemberian.vaksin.index')
                ->with('success', 'Data pemberian vaksin berhasil disimpan.');
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
        $pemberianVaksin = PemberianVaksin::with(['pendaftaran'])->findOrFail($id);
        return response()->json($pemberianVaksin);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemberianVaksin = PemberianVaksin::findOrFail($id);
        $pendaftarans = Pendaftaran::all();
        $dataVaksin = DataVaksin::all();

        return view('pemberian.vaksin.edit', compact('pemberianVaksin', 'pendaftarans', 'dataVaksin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'waktu_pemberian' => 'required|date',
            'id_vaksin' => 'required|array',
            'id_vaksin.*' => 'exists:data_vaksins,id',
            'dosis' => 'required|array',
            'dosis.*' => 'string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $pemberianVaksin = PemberianVaksin::findOrFail($id);

            $vaksinData = [];
            foreach ($request->id_vaksin as $index => $idVaksin) {
                $vaksinData[] = [
                    'id' => $index + 1,
                    'id_vaksin' => $idVaksin,
                    'dosis' => $request->dosis[$index],
                ];
            }

            $keterangan = $request->keterangan ? ucfirst(strtolower($request->keterangan)) : null;

            $pemberianVaksin->update([
                'waktu_pemberian' => $request->waktu_pemberian,
                'data' => json_encode($vaksinData),
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('pemberian.vaksin.index')
                ->with('success', 'Data pemberian vaksin berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pemberianVaksin = PemberianVaksin::findOrFail($id);
            $pemberianVaksin->delete();

            return redirect()->route('pemberian.vaksin.index')
                ->with('success', 'Data pemberian vaksin berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
