<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataObat;

class DataObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataObat = DataObat::paginate(10);
        return view('data_master.obat.index', compact('dataObat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_master.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        DataObat::create($request->all());
        return redirect()->route('data-master.obat.index')->with('success', 'Data obat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataObat = DataObat::findOrFail($id);
        return view('data_master.obat.show', compact('dataObat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataObat $obat)
    {
        return view('data_master.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataObat $obat)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $obat->update($validated);

        return redirect()->route('data-master.obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataObat $obat)
    {
        $obat->delete();

        return redirect()->route('data-master.obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }
}
