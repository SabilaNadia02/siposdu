<?php

namespace App\Http\Controllers;

use App\Models\DataPertanyaan;
use App\Models\DataSkrining;
use App\Models\PertanyaanSkrining;
use Illuminate\Http\Request;

class DataPertanyaanSkriningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSkrining = DataSkrining::all();
        $dataPertanyaan = DataPertanyaan::all();
        $pertanyaanskrining = PertanyaanSkrining::with(['dataSkrining', 'dataPertanyaan'])->paginate(10);
        return view('data_master.pertanyaan_skrining.index', compact('dataSkrining', 'dataPertanyaan', 'pertanyaanskrining'));
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
            'id_skrining' => 'required|exists:data_skrinings,id',
            'id_pertanyaan' => 'required|exists:data_pertanyaans,id',
        ]);

        PertanyaanSkrining::create($request->all());
        return redirect()->route('data-master.pertanyaan-skrining.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PertanyaanSkrining $pertanyaanSkrining)
    {
        return view('data_master.pertanyaan_skrining.show', compact('pertanyaanSkrining'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PertanyaanSkrining $pertanyaanSkrining)
    {
        $dataSkrining = DataSkrining::all();
        $dataPertanyaan = DataPertanyaan::all();
        return view('data_master.pertanyaan_skrining.edit', compact('pertanyaanSkrining', 'dataSkrining', 'dataPertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PertanyaanSkrining $pertanyaanSkrining)
    {
        $validated = $request->validate([
            'id_skrining' => 'required|exists:data_skrinings,id',
            'id_pertanyaan' => 'required|exists:data_pertanyaans,id',
        ]);

        $pertanyaanSkrining->update($validated);

        return redirect()->route('data-master.pertanyaan-skrining.index')
            ->with('success', 'Data pertanyaan skrining berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PertanyaanSkrining $pertanyaanSkrining)
    {
        $pertanyaanSkrining->delete();

        return redirect()->route('data-master.pertanyaan-skrining.index')
            ->with('success', 'Data pertanyaan skrining berhasil dihapus.');
    }
}
