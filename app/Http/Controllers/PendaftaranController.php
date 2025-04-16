<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::paginate(10);
        $totalPendaftaran = Pendaftaran::count();

        $totalIbuHamil = Pendaftaran::where('jenis_sasaran', 1)->count();
        $totalBayiBalita = Pendaftaran::where('jenis_sasaran', 2)->count();
        $totalUsiaSuburLansia = Pendaftaran::where('jenis_sasaran', 3)->count();

        $posyandus = DataPosyandu::all();

        return view('pendaftaran.index', compact(
            'pendaftaran',
            'totalPendaftaran',
            'totalIbuHamil',
            'totalBayiBalita',
            'totalUsiaSuburLansia',
            'posyandus'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:pendaftarans,nik|digits:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:1,2',
            'status_perkawinan' => 'required|in:1,2',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required|in:1,2,3,4,5,6',
            'pekerjaan' => 'required|in:1,2,3,4,5,6,7',
            'alamat' => 'required|string',
            'no_hp' => 'required|digits_between:10,13',
            'no_jkn' => 'nullable|digits_between:13,16',
            'jenis_sasaran' => 'required|in:1,2,3',
            'data_posyandu_id' => 'required|exists:data_posyandus,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Ambil ID terakhir dan tambahkan 1
        $lastId = Pendaftaran::max('id');
        $newId = $lastId ? $lastId + 1 : 1;

        // Tambahkan ID baru ke data request
        $data = $request->all();
        $data['id'] = $newId;

        // Simpan data pendaftaran
        $pendaftaran = Pendaftaran::create($data);

        return response()->json([
            'success' => 'Pendaftaran berhasil ditambahkan',
            'redirect' => route('pendaftaran.show', $pendaftaran->id)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            abort(404);
        }

        return view('pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $posyandus = DataPosyandu::all();
        return view('pendaftaran.edit', compact('pendaftaran', 'posyandus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:1,2',
            'status_perkawinan' => 'required|in:1,2',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required|in:1,2,3,4,5,6',
            'pekerjaan' => 'required|in:1,2,3,4,5,6,7',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'no_jkn' => 'nullable|string|max:20',
            'jenis_sasaran' => 'required|in:1,2,3',
            'data_posyandu_id' => 'required|exists:data_posyandus,id',
        ]);

        // Cari data berdasarkan ID
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Update data
        $pendaftaran->update($request->all());

        // Redirect kembali dengan pesan sukses
        return redirect()->route('pendaftaran.show', $pendaftaran->id)->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return response()->json(['success' => 'Data pendaftaran berhasil dihapus']);
    }
}
