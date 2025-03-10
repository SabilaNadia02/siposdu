<?php

namespace App\Http\Controllers;

use App\Models\PencatatanAwal;
use App\Models\PencatatanKunjungan;
use App\Models\Pendaftaran;
use Carbon\Carbon;
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
            'no_pendaftaran' => 'required|exists:pendaftaran,no_pendaftaran',
            'hpht' => 'required|date',
            'nama_suami' => 'required|string|max:255',
            'hamil_ke' => 'required|integer|min:1',
            'jarak_anak' => 'required|string|max:255',
            'tinggi_badan' => 'required|numeric|min:100|max:250',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Hitung HTP (HPHT + 280 hari)
        $htp = Carbon::parse($request->hpht)->addDays(280)->toDateString();

        // Hitung Usia Kehamilan ((Hari Ini - HPHT) / 7)
        $usia_kehamilan = Carbon::parse($request->hpht)->diffInWeeks(now());

        // Simpan data
        PencatatanAwal::create([
            'no_pendaftaran' => $request->no_pendaftaran,
            'hpht' => $request->hpht,
            'htp' => $htp,
            'nama_suami' => $request->nama_suami,
            'hamil_ke' => $request->hamil_ke,
            'jarak_anak' => $request->jarak_anak,
            'tinggi_badan' => $request->tinggi_badan,
            'usia_kehamilan' => $usia_kehamilan,
        ]);

        return redirect()->route('pencatatan.ibu.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = PencatatanAwal::with(['pendaftaran', 'pencatatanKunjungan'])
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
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'hpht' => 'nullable|date',
            'htp' => 'nullable|date',
            'nama_suami' => 'nullable|string|max:255',
            'hamil_ke' => 'nullable|integer|min:1',
            'jarak_anak' => 'nullable|string|max:255',
            'tinggi_badan' => 'nullable|numeric|min:100|max:250',
            'usia_kehamilan' => 'nullable|integer|min:1|max:42',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah HPHT diubah oleh user
        if ($request->filled('hpht') && strtotime($request->hpht) !== false) {
            $hpht_date = Carbon::parse($request->hpht);
            $htp = $hpht_date->copy()->addDays(280)->toDateString();
            $now = Carbon::now();
            $usia_kehamilan = Carbon::parse($request->hpht)->diffInWeeks($now);
        } else {
            $htp = $request->htp;
            $usia_kehamilan = $request->usia_kehamilan;
        }

        // Ambil input awal (bisa manual dari user)
        // $htp = $request->htp;
        // $usia_kehamilan = $request->usia_kehamilan;

        // // Jika HPHT diisi, hitung otomatis HTP & Usia Kehamilan (jika user tidak mengisi manual)
        // if ($request->filled('hpht') && strtotime($request->hpht) !== false) {
        //     $hpht_date = Carbon::parse($request->hpht);

        //     // Jika user tidak mengisi HTP, hitung otomatis
        //     if (!$request->filled('htp')) {
        //         $htp = $hpht_date->copy()->addDays(280)->toDateString();
        //     }

        //     // Jika user tidak mengisi usia kehamilan, hitung otomatis
        //     if (!$request->filled('usia_kehamilan')) {
        //         $usia_kehamilan = $hpht_date->diffInWeeks(Carbon::now());
        //     }
        // }

        // // Debugging sebelum update
        // dd([
        //     'HPHT' => $request->hpht,
        //     'HTP (manual/otomatis)' => $htp,
        //     'Usia Kehamilan (manual/otomatis)' => $usia_kehamilan
        // ]);

        // Update data
        $data->update([
            'no_pendaftaran' => $request->no_pendaftaran,
            'hpht' => $request->hpht,
            'htp' => $htp,
            'nama_suami' => $request->nama_suami,
            'hamil_ke' => $request->hamil_ke,
            'jarak_anak' => $request->jarak_anak,
            'tinggi_badan' => $request->tinggi_badan,
            'usia_kehamilan' => $usia_kehamilan,
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
        $id_pencatatan_awal = $request->query('id_pencatatan_awal');
        $id_pencatatan_kunjungan = $request->query('id_pencatatan_kunjungan');

        $dataAwal = PencatatanAwal::findOrFail($id_pencatatan_awal);
        $dataKunjungan = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);
        $kunjungan = $dataAwal->pencatatanKunjungan()->paginate(10);

        return view('pencatatan.ibu.kunjungan.index', compact('dataAwal', 'dataKunjungan', 'kunjungan'));
    }

    public function createKunjungan($id)
    {
        return view('pencatatan.ibu.kunjungan.create', compact('id'));
    }

    public function storeKunjungan(Request $request, $id)
    {
        $validatedData = $request->validate([
            'waktu_kunjungan' => 'required|date',
            'berat_badan' => 'nullable|numeric|min:30|max:150',
            'lingkar_lengan' => 'nullable|numeric|min:10|max:50',
            'mt_bumil_kek' => 'nullable|in:1,2',
            'kelas_ibu_hamil' => 'nullable|in:1,2',
            'tekanan_darah_sistolik' => 'nullable|integer|min:80|max:200',
            'tekanan_darah_diastolik' => 'nullable|integer|min:50|max:150',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        $validatedData['id_pencatatan_awal'] = $id;

        $kunjungan = PencatatanKunjungan::create($validatedData);

        return redirect()->route('pencatatan.ibu.kunjungan.show', [$id, $kunjungan->id])
            ->with('success', 'Kunjungan berhasil ditambahkan.');
    }

    public function showKunjungan(Request $request, $id)
    {
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($data->id_pencatatan_awal);
        $detail_kunjungan = PencatatanKunjungan::findOrFail($id);

        return view('pencatatan.ibu.kunjungan.show', compact('data', 'kunjungan', 'detail_kunjungan', 'id'));
    }

    // public function editKunjungan(Request $request, $id)
    // {
    //     $data = PencatatanKunjungan::findOrFail($id);
    //     $kunjungan = PencatatanAwal::findOrFail($data->id_pencatatan_awal);
    //     $detail_kunjungan = PencatatanKunjungan::findOrFail($id);

    //     return view('pencatatan.ibu.kunjungan.edit', compact('data', 'kunjungan', 'detail_kunjungan', 'id'));
    // }

    public function editKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($id_pencatatan_awal);

        return view('pencatatan.ibu.kunjungan.edit', compact('data', 'kunjungan', 'id', 'id_pencatatan_awal'));
    }


    public function updateKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'waktu_pencatatan' => 'required|date',
            'berat_badan' => 'nullable|numeric|min:30|max:150',
            'lingkar_lengan' => 'nullable|numeric|min:10|max:50',
            'mt_bumil_kek' => 'nullable|in:1,2',
            'kelas_ibu_hamil' => 'nullable|in:1,2',
            'tekanan_darah_sistolik' => 'nullable|integer|min:80|max:200',
            'tekanan_darah_diastolik' => 'nullable|integer|min:50|max:150',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // dd(PencatatanKunjungan::find($id));

        // Cari data kunjungan berdasarkan ID
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($id_pencatatan_awal);

        dd((PencatatanKunjungan::find($id)));

        // Update data kunjungan dengan input yang telah divalidasi
        $data->update([
            'waktu_pencatatan' => $request->waktu_pencatatan,
            'berat_badan' => $request->berat_badan,
            'lingkar_lengan' => $request->lingkar_lengan,
            'mt_bumil_kek' => $request->mt_bumil_kek,
            'kelas_ibu_hamil' => $request->kelas_ibu_hamil,
            'tekanan_darah_sistolik' => $request->tekanan_darah_sistolik,
            'tekanan_darah_diastolik' => $request->tekanan_darah_diastolik,
            'keluhan' => $request->keluhan,
            'edukasi' => $request->edukasi,
        ]);

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('pencatatan.ibu.kunjungan.show', [$kunjungan->id, $data->id])
            ->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroyKunjungan($id, $id_pencatatan_kunjungan)
    {
        $kunjungan = PencatatanKunjungan::findOrFail($id_pencatatan_kunjungan);
        $kunjungan->delete();

        return redirect()->route('pencatatan.ibu.show', $id)
            ->with('success', 'Kunjungan berhasil dihapus.');
    }
}
