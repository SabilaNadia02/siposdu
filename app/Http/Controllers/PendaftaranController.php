<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::paginate(10);
        $totalPendaftaran = Pendaftaran::count();
        $totalLaki = Pendaftaran::where('jenis_kelamin', 1)->count();
        $totalPerempuan = Pendaftaran::where('jenis_kelamin', 2)->count();

        return view('pendaftaran.index', compact('pendaftaran', 'totalPendaftaran', 'totalLaki', 'totalPerempuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendaftaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:pendaftarans,nik|digits:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:1,2',
            'status_perkawinan' => 'required|in:1,2',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required|in:1,2,3,4,5,6',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|regex:/^08[0-9]{9,11}$/',
            'no_jkn' => 'nullable|digits_between:13,16',
        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Konversi angka ke teks untuk tampilan
        $jenis_kelamin = $pendaftaran->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan';
        $status_perkawinan = $pendaftaran->status_perkawinan == 1 ? 'Tidak Menikah' : 'Menikah';
        $pendidikan_labels = [
            1 => 'Tidak Sekolah',
            2 => 'SD',
            3 => 'SMP',
            4 => 'SMU',
            5 => 'Akademi',
            6 => 'Perguruan Tinggi',
        ];
        $pendidikan = $pendidikan_labels[$pendaftaran->pendidikan] ?? 'Tidak Diketahui';

        return view('pendaftaran.show', compact('pendaftaran', 'jenis_kelamin', 'status_perkawinan', 'pendidikan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('pendaftaran.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'nik' => 'required|digits:16|unique:pendaftarans,nik,' . $id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:1,2',
            'status_perkawinan' => 'required|in:1,2',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required|in:1,2,3,4,5,6',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|regex:/^08[0-9]{9,11}$/',
            'no_jkn' => 'nullable|digits_between:13,16',
        ]);

        $pendaftaran->update($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil dihapus');
    }
}
