<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemberianVitamin;
use App\Models\DataVitamin;
use App\Models\Pendaftaran;

class PemberianVitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pendaftarans = Pendaftaran::all();
        $dataVitamin = DataVitamin::all()->keyBy('id');

        $query = PemberianVitamin::with('pendaftaran')
            ->orderBy('waktu_pemberian', 'desc');

        $pemberianVitamin = $query->paginate(100);
        $totalPemberian = PemberianVitamin::count();

        $totalLaki = PemberianVitamin::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_kelamin', 1);
        })->count();

        $totalPerempuan = PemberianVitamin::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_kelamin', 2);
        })->count();

        return view('pemberian.vitamin.index', compact(
            'pemberianVitamin',
            'totalPemberian',
            'totalLaki',
            'totalPerempuan',
            'pendaftarans',
            'dataVitamin'
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
            'id_vitamin' => 'required|array',
            'id_vitamin.*' => 'exists:data_vitamins,id',
            'dosis' => 'required|array',
            'dosis.*' => 'string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $vitaminData = [];
            foreach ($request->id_vitamin as $index => $idVitamin) {
                $vitaminData[] = [
                    'id' => $index + 1,
                    'id_vitamin' => $idVitamin,
                    'dosis' => $request->dosis[$index],
                ];
            }

            $keterangan = $request->keterangan ? ucwords(strtolower($request->keterangan)) : null;

            PemberianVitamin::create([
                'no_pendaftaran' => $request->no_pendaftaran,
                'waktu_pemberian' => $request->waktu_pemberian,
                'data' => json_encode($vitaminData),
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('pemberian.vitamin.index')
                ->with('success', 'Data pemberian vitamin berhasil disimpan.');
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
        $pemberianVitamin = PemberianVitamin::with(['pendaftaran'])->findOrFail($id);
        return response()->json($pemberianVitamin);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemberianVitamin = PemberianVitamin::findOrFail($id);
        $pendaftarans = Pendaftaran::all();
        $dataVitamin = DataVitamin::all();

        return view('pemberian.vitamin.edit', compact('pemberianVitamin', 'pendaftarans', 'dataVitamin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'waktu_pemberian' => 'required|date',
            'id_vitamin' => 'required|array',
            'id_vitamin.*' => 'exists:data_vitamins,id',
            'dosis' => 'required|array',
            'dosis.*' => 'string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $pemberianVitamin = PemberianVitamin::findOrFail($id);

            $vitaminData = [];
            foreach ($request->id_vitamin as $index => $idVitamin) {
                $vitaminData[] = [
                    'id' => $index + 1,
                    'id_vitamin' => $idVitamin,
                    'dosis' => $request->dosis[$index],
                ];
            }

            $keterangan = $request->keterangan ? ucwords(strtolower($request->keterangan)) : null;

            $pemberianVitamin->update([
                'waktu_pemberian' => $request->waktu_pemberian,
                'data' => json_encode($vitaminData),
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('pemberian.vitamin.index')
                ->with('success', 'Data pemberian vitamin berhasil diperbarui.');
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
            $pemberianVitamin = PemberianVitamin::findOrFail($id);
            $pemberianVitamin->delete();

            return redirect()->route('pemberian.vitamin.index')
                ->with('success', 'Data pemberian vitamin berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
