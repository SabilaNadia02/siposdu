<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pendaftaran.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran = (object) [
            'id' => $id,
            'nama' => 'Sabila Nadia Islamia',
            'nik' => '3201123456789012',
            'jenis_kelamin' => 'Perempuan',
            'status_perkawinan' => 'Tidak Menikah',
            'pendidikan' => 'Sarjana',
            'pekerjaan' => 'Pegawai',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2002-09-02',
            'no_hp' => '081234567890',
            'no_jkn' => '1234567890123',
            'alamat' => 'Dusun Jambean RT 2 / RW 1'
        ];

        $peserta = [
            'id' => $id,
            'nama' => 'Aulia Risty',
            'alamat' => 'Desa Jambean, Dusun Jambean, RT 02 RW 01, Kecamatan Kras, Kabupaten Kediri',
        ];

        return view('pendaftaran.show', compact('pendaftaran', 'peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
