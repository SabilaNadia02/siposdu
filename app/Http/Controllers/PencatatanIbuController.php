<?php

namespace App\Http\Controllers;

use App\Models\PencatatanAwal;
use App\Models\PencatatanKunjungan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PencatatanIbuController extends Controller
{
    public function index()
    {
        $jumlahPencatatan = PencatatanAwal::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 1);
        })->count();

        $pencatatanAwal = PencatatanAwal::with('pendaftaran')
            ->whereHas('pendaftaran', function ($query) {
                $query->where('jenis_sasaran', 1);
            })
            ->paginate(10);

        return view('pencatatan.ibu.index', compact('jumlahPencatatan', 'pencatatanAwal'));
    }

    public function create()
    {
        $pendaftaran = Pendaftaran::where('jenis_sasaran', 1)->get();
        return view('pencatatan.ibu.create', compact('pendaftaran'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'usia_kehamilan' => 'required|integer|min:1|max:42',
            'htp' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PencatatanAwal::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'usia_kehamilan' => $request->usia_kehamilan,
            'htp' => $request->htp,
        ]);

        return redirect()->route('pencatatan.ibu.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = PencatatanAwal::with(['pendaftaran', 'pencatatanKunjungan.detailPencatatanKunjungan'])
            ->findOrFail($id);

        $riwayatPemeriksaan = $data->pencatatanKunjungan;

        return view('pencatatan.ibu.show', compact('data', 'riwayatPemeriksaan'));
    }

    public function edit($id)
    {
        $data = PencatatanAwal::findOrFail($id);
        $pendaftaran = Pendaftaran::where('jenis_sasaran', 1)->get();
        return view('pencatatan.ibu.edit', compact('data', 'pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $data = PencatatanAwal::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'usia_kehamilan' => 'required|integer|min:1|max:42',
            'htp' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'usia_kehamilan' => $request->usia_kehamilan,
            'htp' => $request->htp,
        ]);

        return redirect()->route('pencatatan.ibu.show', $data->id)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PencatatanAwal::findOrFail($id);
        $data->delete();

        return redirect()->route('pencatatan.ibu.index')->with('success', 'Data berhasil dihapus.');
    }

    // ✅ Kunjungan untuk Ibu

    public function indexKunjungan(Request $request)
    {
        // Mengambil parameter dari query string
        $id_pencatatan_awal = $request->query('id_pencatatan_awal');
        $id_pencatatan_kunjungan = $request->query('id_pencatatan_kunjungan');

        // Mencari data
        $data = PencatatanAwal::findOrFail($id_pencatatan_awal);
        $data2 = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);
        $kunjungan = $data->pencatatanKunjungan()->paginate(10);
        $detail_kunjungan = $data->detailPencatatanKunjungan()->paginate(10);

        // Return ke view
        return view('pencatatan.ibu.kunjungan.index', compact('data', 'data2', 'kunjungan', 'detail_kunjungan'));
    }

    public function createKunjungan($id)
    {
        return view('pencatatan.ibu.kunjungan.create', compact('id'));
    }

    public function storeKunjungan(Request $request, $id)
    {
        $request->validate([
            'berat_badan' => 'nullable|numeric|min:30|max:150',
            'lingkar_lengan' => 'nullable|numeric|min:10|max:50',
            'tekanan_darah_sistolik' => 'nullable|integer|min:80|max:200',
            'tekanan_darah_diastolik' => 'nullable|integer|min:50|max:150',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        $kunjungan = PencatatanKunjungan::create([
            'pencatatan_awal_id' => $id,
            'berat_badan' => $request->berat_badan,
            'lingkar_lengan' => $request->lingkar_lengan,
            'tekanan_darah_sistolik' => $request->tekanan_darah_sistolik,
            'tekanan_darah_diastolik' => $request->tekanan_darah_diastolik,
            'keluhan' => $request->keluhan,
            'edukasi' => $request->edukasi,
        ]);

        return redirect()->route('pencatatan.ibu.kunjungan.show', [$id, $kunjungan->id])
            ->with('success', 'Kunjungan berhasil ditambahkan.');
    }

    public function showKunjungan($id, Request $request)
    {
        // $kunjungan = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);
        // $detail_kunjungan = $kunjungan->detailPencatatanKunjungan()->paginate(10);

        // return view('pencatatan.ibu.kunjungan.show', compact('awal', 'kunjungan', 'detail_kunjungan'));

        // Mengambil parameter dari query string
        $id_pencatatan_awal = $request->query('id_pencatatan_awal');
        $id_pencatatan_kunjungan = $request->query('id_pencatatan_kunjungan');

        // Mencari data
        $data = PencatatanAwal::findOrFail($id_pencatatan_awal);
        $data2 = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);
        $kunjungan = $data->pencatatanKunjungan()->paginate(10);
        $detail_kunjungan = $data2->detailPencatatanKunjungan()->paginate(10);

        // Return ke view
        return view('pencatatan.ibu.kunjungan.show', compact('data', 'data2', 'kunjungan', 'detail_kunjungan'));
    }

    public function editKunjungan($id, $id_pencatatan_kunjungan)
    {
        $kunjungan = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);

        return view('pencatatan.ibu.kunjungan.edit', compact('kunjungan', 'id'));
    }

    public function updateKunjungan(Request $request, $id, $id_pencatatan_kunjungan)
    {
        $request->validate([
            'berat_badan' => 'nullable|numeric|min:30|max:150',
            'lingkar_lengan' => 'nullable|numeric|min:10|max:50',
            'tekanan_darah_sistolik' => 'nullable|integer|min:80|max:200',
            'tekanan_darah_diastolik' => 'nullable|integer|min:50|max:150',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        $kunjungan = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);

        $kunjungan->update([
            'berat_badan' => $request->berat_badan,
            'lingkar_lengan' => $request->lingkar_lengan,
            'tekanan_darah_sistolik' => $request->tekanan_darah_sistolik,
            'tekanan_darah_diastolik' => $request->tekanan_darah_diastolik,
            'keluhan' => $request->keluhan,
            'edukasi' => $request->edukasi,
        ]);

        return redirect()->route('pencatatan.ibu.kunjungan.show', [$id, $id_pencatatan_kunjungan])
            ->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroyKunjungan($id, $id_pencatatan_kunjungan)
    {
        $kunjungan = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);
        $kunjungan->delete();

        return redirect()->route('pencatatan.ibu.kunjungan.index', $id)
            ->with('success', 'Kunjungan berhasil dihapus.');
    }
}
