<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVitamin;

class DataVitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataVitamin = DataVitamin::paginate(10);
        return view('data_master.vitamin.index', compact('dataVitamin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_master.vitamin.create');
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

        DataVitamin::create($validated);

        return redirect()->route('data-master.vitamin.index')
            ->with('success', 'Data vitamin berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataVitamin = DataVitamin::findOrFail($id);
        return view('data_master.vitamin.show', compact('dataVitamin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataVitamin $vitamin)
    {
        return view('data_master.vitamin.edit', compact('vitamin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataVitamin $vitamin)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if (!empty($validated['keterangan'])) {
            $validated['keterangan'] = ucfirst(strtolower($validated['keterangan']));
        }

        $vitamin->update($validated);

        return redirect()->route('data-master.vitamin.index')
            ->with('success', 'Data vitamin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataVitamin $vitamin)
    {
        $vitamin->delete();

        return redirect()->route('data-master.vitamin.index')
            ->with('success', 'Data vitamin berhasil dihapus.');
    }
}
