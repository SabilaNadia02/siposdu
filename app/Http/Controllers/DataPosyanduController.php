<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPosyandu;

class DataPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataposyandu = DataPosyandu::paginate(10);
        return view('data_master.posyandu.index', compact('dataposyandu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_master.posyandu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        DataPosyandu::create($request->all());
        return redirect()->route('data-master.posyandu.index')->with('success', 'Data posyandu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataPosyandu = DataPosyandu::findOrFail($id);
        return view('data_master.posyandu.show', compact('dataPosyandu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataPosyandu = DataPosyandu::findOrFail($id);
        return view('data_master.posyandu.edit', compact('dataPosyandu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $dataPosyandu = DataPosyandu::findOrFail($id);
        $dataPosyandu->update($request->all());
        return redirect()->route('data-master.posyandu.index')->with('success', 'Data posyandu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPosyandu = DataPosyandu::findOrFail($id);
        $dataPosyandu->delete();
        return redirect()->route('data-master.posyandu.index')->with('success', 'Data posyandu berhasil dihapus.');
    }
}
