<?php

namespace App\Http\Controllers;

use App\Models\DataSkrining;
use Illuminate\Http\Request;

class DataSkriningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataskrining = DataSkrining::paginate(10);
        return view('data_master.skrining.index', compact('dataskrining'));
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
            'nama_skrining' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        DataSkrining::create($request->all());
        return redirect()->route('data-master.skrining.index')->with('success', 'Data skrining berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataskrining = DataSkrining::findOrFail($id);
        return view('data_master.skrining.show', compact('dataskrining'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataSkrining $skrining)
    {
        return view('data_master.skrining.edit', compact('skrining'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSkrining $skrining)
    {
        $validated = $request->validate([
            'nama_skrining' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $skrining->update($validated);

        return redirect()->route('data-master.skrining.index')
            ->with('success', 'Data skrining berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSkrining $skrining)
    {
        $skrining->delete();

        return redirect()->route('data-master.skrining.index')
            ->with('success', 'Data skrining berhasil dihapus.');
    }
}
