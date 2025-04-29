<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use App\Models\PencatatanAwal;
use App\Models\PencatatanKunjungan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PencatatanBalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::where('jenis_sasaran', 2)->get();
        $posyandus = DataPosyandu::all();
        $jumlahPencatatan = PencatatanAwal::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 2);
        })->count();

        $pencatatanAwal = PencatatanAwal::with('pendaftaran')
            ->whereHas('pendaftaran', function ($query) {
                $query->where('jenis_sasaran', 2);
            })
            ->paginate(10);

        return view('pencatatan.balita.index', compact('pendaftarans', 'posyandus', 'jumlahPencatatan', 'pencatatanAwal'));
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
        $validator = Validator::make($request->all(), [
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'nama_ibu' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'berat_badan_lahir' => 'required|numeric|max:250',
            'panjang_badan_lahir' => 'required|numeric|max:250',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data
        PencatatanAwal::create([
            'no_pendaftaran' => $request->no_pendaftaran,
            'nama_ibu' => $request->nama_ibu,
            'nama_ayah' => $request->nama_ayah,
            'berat_badan_lahir' => $request->berat_badan_lahir,
            'panjang_badan_lahir' => $request->panjang_badan_lahir,
            'status_balita' => 1,
        ]);

        return redirect()->route('pencatatan.balita.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pencatatan_awal = PencatatanAwal::findOrFail($id);
        $data = PencatatanAwal::with(['pendaftaran', 'pencatatanKunjungan'])
            ->findOrFail($id);

        $riwayatPemeriksaan = $data->pencatatanKunjungan;

        return view('pencatatan.balita.show', compact('data', 'riwayatPemeriksaan', 'pencatatan_awal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PencatatanAwal::findOrFail($id);
        $pendaftaran = Pendaftaran::where('jenis_sasaran', 2)->get();
        return view('pencatatan.balita.edit', compact('data', 'pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = PencatatanAwal::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'nama_ibu' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'berat_badan_lahir' => 'required|numeric|max:250',
            'panjang_badan_lahir' => 'required|numeric|max:250',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update data
        $data->update([
            'no_pendaftaran' => $request->no_pendaftaran,
            'nama_ibu' => $request->nama_ibu,
            'nama_ayah' => $request->nama_ayah,
            'berat_badan_lahir' => $request->berat_badan_lahir,
            'panjang_badan_lahir' => $request->panjang_badan_lahir,
        ]);

        return redirect()->route('pencatatan.balita.show', $data->id)->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = PencatatanAwal::findOrFail($id);
        $data->delete();

        return redirect()->route('pencatatan.balita.index')->with('success', 'Data berhasil dihapus.');
    }

    // ✅ Kunjungan untuk Balita
    public function storeKunjungan(Request $request, $id_pencatatan_awal)
    {
        // Pastikan id_pencatatan_awal valid
        $pencatatanAwal = PencatatanAwal::findOrFail($id_pencatatan_awal);

        // Validasi input
        $validatedData = $request->validate([
            'waktu_pencatatan' => 'required|date',
            'berat_badan' => 'required|numeric',
            'panjang_badan' => 'required|numeric',
            'lingkar_lengan' => 'required|numeric',
            'lingkar_kepala' => 'required|numeric',
            'asi_eksklusif' => 'required',
            'mp_asi' => 'required',
            'mt_pangan_pemulihan' => 'required',
            'catatan_kesehatan' => 'nullable|string|max:255',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        // Tambahkan id_pencatatan_awal ke data yang divalidasi
        $validatedData['id_pencatatan_awal'] = $id_pencatatan_awal;

        // Simpan data ke database
        $kunjungan = PencatatanKunjungan::create($validatedData);

        // Redirect ke halaman detail kunjungan dengan pesan sukses
        return redirect()->route('pencatatan.balita.kunjungan.show', [
            'id_pencatatan_awal' => $id_pencatatan_awal,
            'id' => $kunjungan->id,
        ])->with('success', 'Kunjungan berhasil ditambahkan.');
    }

    public function showKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($data->id_pencatatan_awal);
        $detail_kunjungan = PencatatanKunjungan::findOrFail($id);

        return view('pencatatan.balita.kunjungan.show', compact('data', 'kunjungan', 'detail_kunjungan', 'id'));
    }

    public function editKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($id_pencatatan_awal);

        return view('pencatatan.balita.kunjungan.edit', compact('data', 'kunjungan', 'id', 'id_pencatatan_awal'));
    }

    public function updateKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'waktu_pencatatan' => 'required|date',
            'berat_badan' => 'nullable|numeric',
            'panjang_badan' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'asi_eksklusif' => 'nullable',
            'mp_asi' => 'nullable',
            'mt_pangan_pemulihan' => 'nullable',
            'catatan_kesehatan' => 'nullable|string|max:255',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cari data kunjungan berdasarkan ID
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($id_pencatatan_awal);

        // Update data kunjungan dengan input yang telah divalidasi
        $data->update([
            'waktu_pencatatan' => $request->waktu_pencatatan,
            'berat_badan' => $request->berat_badan,
            'panjang_badan' => $request->panjang_badan,
            'lingkar_lengan' => $request->lingkar_lengan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'asi_eksklusif' => $request->asi_eksklusif,
            'mp_asi' => $request->mp_asi,
            'mt_pangan_pemulihan' => $request->mt_pangan_pemulihan,
            'catatan_kesehatan' => $request->catatan_kesehatan,
            'keluhan' => $request->keluhan,
            'edukasi' => $request->edukasi,
        ]);

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('pencatatan.balita.kunjungan.show', [$kunjungan->id, $data->id])
            ->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroyKunjungan($id, $id_pencatatan_kunjungan)
    {
        $kunjungan = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);
        $kunjungan->delete();

        return redirect()->route('pencatatan.balita.show', $id)
            ->with('success', 'Kunjungan berhasil dihapus.');
    }
}
