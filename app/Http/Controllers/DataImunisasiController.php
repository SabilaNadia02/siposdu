<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataImunisasi;

class DataImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataImunisasi = DataImunisasi::paginate(10);
        return view('data_master.imunisasi.index', compact('dataImunisasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_master.imunisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'dari_umur' => 'required|integer|min:0',
            'sampai_umur' => 'required|integer|min:0|gte:dari_umur',
            'keterangan' => 'nullable|string',
        ]);
        
        if (!empty($validated['keterangan'])) {
            $validated['keterangan'] = ucfirst(strtolower($validated['keterangan']));
        }
        
        DataImunisasi::create($validated);

        return redirect()->route('data-master.imunisasi.index')
            ->with('success', 'Data imunisasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataImunisasi $imunisasi)
    {
        return view('data_master.imunisasi.show', compact('imunisasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataImunisasi $imunisasi)
    {
        return view('data_master.imunisasi.edit', compact('imunisasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataImunisasi $imunisasi)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'dari_umur' => 'required|integer|min:0',
            'sampai_umur' => 'required|integer|min:0|gte:dari_umur',
            'keterangan' => 'nullable|string',
        ]);
     
        if (!empty($validated['keterangan'])) {
            $validated['keterangan'] = ucfirst(strtolower($validated['keterangan']));
        }
        
        $imunisasi->update($validated);        

        return redirect()->route('data-master.imunisasi.index')
            ->with('success', 'Data imunisasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataImunisasi $imunisasi)
    {
        $imunisasi->delete();

        return redirect()->route('data-master.imunisasi.index')
            ->with('success', 'Data imunisasi berhasil dihapus.');
    }
}
