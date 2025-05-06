<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use App\Models\PencatatanAwal;
use App\Models\PencatatanKunjungan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PencatatanLansiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::where('jenis_sasaran', 3)->get();
        $posyandus = DataPosyandu::all();
        $jumlahPencatatan = PencatatanAwal::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 3);
        })->count();

        $pencatatanAwal = PencatatanAwal::with('pendaftaran')
            ->whereHas('pendaftaran', function ($query) {
                $query->where('jenis_sasaran', 3);
            })
            ->paginate(10);

        return view('pencatatan.lansia.index', compact('pendaftarans', 'posyandus', 'jumlahPencatatan', 'pencatatanAwal'));
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
        // Validasi data
        $validator = Validator::make($request->all(), [
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'riwayat_keluarga' => 'nullable|array',
            'riwayat_diri' => 'nullable|array',
            'perilaku_berisiko' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Konversi data ke JSON
        $riwayatKeluarga = json_encode($request->riwayat_keluarga);
        $riwayatDiri = json_encode($request->riwayat_diri);
        $perilakuBerisiko = json_encode($request->perilaku_berisiko);

        // Simpan data ke database
        PencatatanAwal::create([
            'no_pendaftaran' => $request->no_pendaftaran,
            'riwayat_keluarga' => $riwayatKeluarga,
            'riwayat_diri_sendiri' => $riwayatDiri,
            'perilaku_berisiko' => $perilakuBerisiko,
        ]);

        return redirect()->route('pencatatan.lansia.index')->with('success', 'Data berhasil ditambahkan.');
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

        return view('pencatatan.lansia.show', compact('data', 'riwayatPemeriksaan', 'pencatatan_awal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PencatatanAwal::findOrFail($id);
        $pendaftaran = Pendaftaran::where('jenis_sasaran', 3)->get();
        return view('pencatatan.lansia.edit', compact('data', 'pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'riwayat_keluarga' => 'nullable|array',
            'riwayat_diri' => 'nullable|array',
            'perilaku_berisiko' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan data yang akan diupdate
        $pencatatan = PencatatanAwal::findOrFail($id);

        // Konversi data ke JSON
        $riwayatKeluarga = json_encode($request->riwayat_keluarga);
        $riwayatDiri = json_encode($request->riwayat_diri);
        $perilakuBerisiko = json_encode($request->perilaku_berisiko);

        // Update data
        $pencatatan->update([
            'no_pendaftaran' => $request->no_pendaftaran,
            'riwayat_keluarga' => $riwayatKeluarga,
            'riwayat_diri_sendiri' => $riwayatDiri,
            'perilaku_berisiko' => $perilakuBerisiko,
        ]);

        return redirect()->route('pencatatan.lansia.show', $pencatatan->id)->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $data = PencatatanAwal::findOrFail($id);

            // Hapus semua kunjungan terkait terlebih dahulu
            $data->pencatatanKunjungan()->delete();

            // Baru hapus data utama
            $data->delete();

            DB::commit();

            return redirect()->route('pencatatan.lansia.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ✅ Kunjungan untuk Lansia
    public function storeKunjungan(Request $request, $id_pencatatan_awal)
    {
        // Pastikan id_pencatatan_awal valid
        $pencatatanAwal = PencatatanAwal::findOrFail($id_pencatatan_awal);

        // Validasi input
        $validatedData = $request->validate([
            'waktu_pencatatan' => 'required|date',
            'berat_badan' => 'nullable|numeric',
            'tekanan_darah_sistolik' => 'nullable|numeric',
            'tekanan_darah_diastolik' => 'nullable|numeric',
            'lingkar_perut' => 'nullable|numeric',
            'gula_darah' => 'nullable|numeric',
            'kolestrol' => 'nullable|numeric',
            'tes_mata_kanan' => 'nullable',
            'tes_mata_kiri' => 'nullable',
            'tes_telinga_kanan' => 'nullable',
            'tes_telinga_kiri' => 'nullable',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        // Tambahkan id_pencatatan_awal ke data yang divalidasi
        $validatedData['id_pencatatan_awal'] = $id_pencatatan_awal;

        // Simpan data ke database
        $kunjungan = PencatatanKunjungan::create($validatedData);

        // Redirect ke halaman detail kunjungan dengan pesan sukses
        return redirect()->route('pencatatan.lansia.show', $id_pencatatan_awal)->with('success', 'Kunjungan berhasil ditambahkan.');
    }

    public function showKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($data->id_pencatatan_awal);
        $detail_kunjungan = PencatatanKunjungan::findOrFail($id);

        return view('pencatatan.lansia.kunjungan.show', compact('data', 'kunjungan', 'detail_kunjungan', 'id'));
    }

    public function editKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($id_pencatatan_awal);

        return view('pencatatan.lansia.kunjungan.edit', compact('data', 'kunjungan', 'id', 'id_pencatatan_awal'));
    }

    public function updateKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'waktu_pencatatan' => 'required|date',
            'berat_badan' => 'nullable|numeric',
            'tekanan_darah_sistolik' => 'nullable|numeric',
            'tekanan_darah_diastolik' => 'nullable|numeric',
            'lingkar_perut' => 'nullable|numeric',
            'gula_darah' => 'nullable|numeric',
            'kolestrol' => 'nullable|numeric',
            'tes_mata_kanan' => 'nullable',
            'tes_mata_kiri' => 'nullable',
            'tes_telinga_kanan' => 'nullable',
            'tes_telinga_kiri' => 'nullable',
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
            'tekanan_darah_sistolik' => $request->tekanan_darah_sistolik,
            'tekanan_darah_diastolik' => $request->tekanan_darah_diastolik,
            'lingkar_perut' => $request->lingkar_perut,
            'gula_darah' => $request->gula_darah,
            'kolestrol' => $request->kolestrol,
            'tes_mata_kanan' => $request->tes_mata_kanan,
            'tes_mata_kiri' => $request->tes_mata_kiri,
            'tes_telinga_kanan' => $request->tes_telinga_kanan,
            'tes_telinga_kiri' => $request->tes_telinga_kiri,
            'keluhan' => $request->keluhan,
            'edukasi' => $request->edukasi,
        ]);

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('pencatatan.lansia.show', [$kunjungan->id, $data->id])
            ->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroyKunjungan($id_pencatatan_awal, $id)
    {
        try {
            DB::beginTransaction();

            $kunjungan = PencatatanKunjungan::findOrFail($id);
            $pencatatanAwalId = $kunjungan->id_pencatatan_awal;

            $kunjungan->delete();

            DB::commit();

            return redirect()->route('pencatatan.lansia.show', $pencatatanAwalId)
                ->with('success', 'Data Kunjungan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
