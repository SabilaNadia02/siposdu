<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVaksin;

class DataVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datavaksin = DataVaksin::paginate(10);
        return view('data_master.vaksin.index', compact('datavaksin'));
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        DataVaksin::create($request->all());
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
    public function edit($id)
    {
        $dataVaksin = DataVaksin::findOrFail($id);
        return view('data_master.vaksin.edit', compact('dataVaksin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $dataVaksin = DataVaksin::findOrFail($id);
        $dataVaksin->update($request->all());
        return redirect()->route('data-master.vaksin.index')->with('success', 'Data vaksin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataVaksin = DataVaksin::findOrFail($id);
        $dataVaksin->delete();
        return redirect()->route('data-master.vaksin.index')->with('success', 'Data vaksin berhasil dihapus.');
    }
}
