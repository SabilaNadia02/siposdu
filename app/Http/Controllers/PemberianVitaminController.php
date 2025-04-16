<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemberianVitamin;
use App\Models\DataVitamin;
use App\Models\Pendaftaran;

class PemberianVitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemberianVitamins = PemberianVitamin::with(['pendaftaran', 'vitamin'])
            ->orderBy('id', 'desc') 
            ->paginate(10);

        $totalPemberian = PemberianVitamin::count();

        return view('pemberian.vitamin.index', compact('pemberianVitamins', 'totalPemberian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vitamins = DataVitamin::all();
        return view('pemberian.vitamin.create', compact('vitamins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'id_vitamin' => 'required|exists:data_vitamins,id',
            'dosis' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        PemberianVitamin::create([
            'no_pendaftaran' => $request->no_pendaftaran,
            'id_vitamin' => $request->id_vitamin,
            'waktu_pemberian' => now(),
            'dosis' => $request->dosis,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pemberian.vitamin.index')
            ->with('success', 'Pemberian vitamin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pemberianVitamin = PemberianVitamin::with(['pendaftaran', 'vitamin'])->findOrFail($id);
        return view('pemberian.vitamin.show', compact('pemberianVitamin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pemberianVitamin = PemberianVitamin::findOrFail($id);
        $vitamins = DataVitamin::all();
        return view('pemberian.vitamin.edit', compact('pemberianVitamin', 'vitamins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_vitamin' => 'required|exists:data_vitamins,id',
            'dosis' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $pemberianVitamin = PemberianVitamin::findOrFail($id);
        $pemberianVitamin->update([
            'id_vitamin' => $request->id_vitamin,
            'dosis' => $request->dosis,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pemberian.vitamin.index')
            ->with('success', 'Data pemberian vitamin berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemberianVitamin = PemberianVitamin::findOrFail($id);
        $pemberianVitamin->delete();

        return redirect()->route('pemberian.vitamin.index')
            ->with('success', 'Data pemberian vitamin berhasil dihapus');
    }
}
