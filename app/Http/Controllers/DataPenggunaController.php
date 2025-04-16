<?php

namespace App\Http\Controllers;

use App\Models\DataPengguna;
use Illuminate\Http\Request;

class DataPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penggunas = DataPengguna::paginate(10);
        return view('data_master.pengguna.index', compact('penggunas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_master.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'peran' => 'required|in:1,2,3',
        ]);

        DataPengguna::create($request->all());

        return redirect()->route('data-master.pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengguna = DataPengguna::findOrFail($id);
        return view('data_master.pengguna.show', compact('pengguna'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPengguna $pengguna)
    {
        return view('data_master.pengguna.edit', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, DataPengguna $pengguna)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'peran' => 'required|in:1,2,3',
        ]);

        $pengguna->update($validated);

        return redirect()->route('data-master.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPengguna $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('data-master.pengguna.index')
            ->with('success', 'Data pengguna berhasil dihapus.');
    }
}
