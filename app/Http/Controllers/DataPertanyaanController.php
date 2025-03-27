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
        $request->validate([
            'nama_pertanyaan' => 'required|string|max:255',
        ]);

        DataPertanyaan::create($request->all());
        return redirect()->route('data-master.pertanyaan.index')->with('success', 'Data pertanyaan berhasil ditambahkan.');
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
    public function edit($id)
    {
        $datapertanyaan = DataPertanyaan::findOrFail($id);
        return view('data_master.pertanyaan.edit', compact('datapertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pertanyaan' => 'required|string|max:255',
        ]);

        $datapertanyaan = DataPertanyaan::findOrFail($id);
        $datapertanyaan->update($request->all());
        return redirect()->route('data-master.pertanyaan.index')->with('success', 'Data pertanyaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $datapertanyaan = DataPertanyaan::findOrFail($id);
        $datapertanyaan->delete();
        return redirect()->route('data-master.pertanyaan.index')->with('success', 'Data pertanyaan berhasil dihapus.');
    }
}
