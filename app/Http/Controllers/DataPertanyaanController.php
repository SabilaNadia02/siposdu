<?php

namespace App\Http\Controllers;

use App\Models\DataPertanyaan;
use Illuminate\Http\Request;

class DataPertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datapertanyaan = DataPertanyaan::paginate(10);
        return view('data_master.pertanyaan.index', compact('datapertanyaan'));
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
        $validated = $request->validate([
            'nama_pertanyaan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if (!empty($validated['keterangan'])) {
            $validated['keterangan'] = ucfirst(strtolower($validated['keterangan']));
        }

        DataPertanyaan::create($validated);

        return redirect()->route('data-master.pertanyaan.index')
            ->with('success', 'Data pertanyaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $datapertanyaan = DataPertanyaan::findOrFail($id);
        return view('data_master.pertanyaan.show', compact('datapertanyaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPertanyaan $pertanyaan)
    {
        return view('data_master.pertanyaan.edit', compact('pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataPertanyaan $pertanyaan)
    {
        $validated = $request->validate([
            'nama_pertanyaan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if (!empty($validated['keterangan'])) {
            $validated['keterangan'] = ucfirst(strtolower($validated['keterangan']));
        }

        $pertanyaan->update($validated);

        return redirect()->route('data-master.pertanyaan.index')
            ->with('success', 'Data pertanyaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPertanyaan $pertanyaan)
    {
        $pertanyaan->delete();

        return redirect()->route('data-master.pertanyaan.index')
            ->with('success', 'Data pertanyaan berhasil dihapus.');
    }
}
