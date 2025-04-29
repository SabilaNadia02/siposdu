<?php

namespace App\Http\Controllers;

use App\Models\DataVaksin;
use Illuminate\Http\Request;

class DataVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataVaksin = DataVaksin::paginate(10);
        return view('data_master.vaksin.index', compact('dataVaksin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_master.vaksin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if (!empty($validated['keterangan'])) {
            $validated['keterangan'] = ucfirst(strtolower($validated['keterangan']));
        }

        DataVaksin::create($validated);

        return redirect()->route('data-master.vaksin.index')->with('success', 'Data vaksin berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataVaksin = DataVaksin::findOrFail($id);
        return view('data_master.vaksin.show', compact('dataVaksin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataVaksin $vaksin)
    {
        return view('data_master.vaksin.edit', compact('vaksin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataVaksin $vaksin)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if (!empty($validated['keterangan'])) {
            $validated['keterangan'] = ucfirst(strtolower($validated['keterangan']));
        }

        $vaksin->update($validated);

        return redirect()->route('data-master.vaksin.index')
            ->with('success', 'Data vaksin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataVaksin $vaksin)
    {
        $vaksin->delete();

        return redirect()->route('data-master.vaksin.index')
            ->with('success', 'Data vaksin berhasil dihapus.');
    }
}
