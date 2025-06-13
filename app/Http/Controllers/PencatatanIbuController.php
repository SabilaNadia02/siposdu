<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use App\Models\PencatatanAwal;
use App\Models\PencatatanKunjungan;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PencatatanIbuController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::where('jenis_sasaran', 1)->get();
        $posyandus = DataPosyandu::all();
        $jumlahPencatatan = PencatatanAwal::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 1);
        })->count();

        $pencatatanAwal = PencatatanAwal::with('pendaftaran')
            ->orderBy('created_at', 'DESC')
            ->whereHas('pendaftaran', function ($query) {
                $query->where('jenis_sasaran', 1);
            })
            ->paginate(100);

        return view('pencatatan.ibu.index', compact('pendaftarans', 'posyandus', 'jumlahPencatatan', 'pencatatanAwal'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'hpht' => 'required|date',
            'nama_suami' => 'nullable|string|max:255',
            'hamil_ke' => 'nullable|integer|min:1',
            'jarak_anak' => 'nullable|integer',
            'tinggi_badan' => 'nullable|numeric|',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menghitung HTP dan Usia Kehamilan jika HPHT diinput
        $hpht_date = Carbon::parse($request->hpht);
        $htp = $hpht_date->copy()->addDays(280)->toDateString();
        $usia_kehamilan = Carbon::parse($request->hpht)->diffInWeeks(Carbon::now());

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

        return redirect()->route('pencatatan.ibu.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $data = PencatatanAwal::with(['pendaftaran', 'pencatatanKunjungan'])
            ->findOrFail($id);

        // Hitung usia kehamilan saat ini 
        $hpht = Carbon::parse($data->hpht);
        $currentGestationalAge = (int) $hpht->diffInWeeks(Carbon::now());

        // Simpan ke data, tapi tidak ke database
        $data->usia_kehamilan = $currentGestationalAge;

        // Hitung usia kehamilan pada setiap kunjungan 
        $kunjungans = $data->pencatatanKunjungan->map(function ($kunjungan) use ($hpht) {
            $visitDate = Carbon::parse($kunjungan->waktu_pencatatan);
            $kunjungan->gestational_age = (int) $hpht->diffInWeeks($visitDate);
            return $kunjungan;
        });

        $riwayatPemeriksaan = $data->pencatatanKunjungan;

        return view('pencatatan.ibu.show', compact('data', 'kunjungans', 'riwayatPemeriksaan'));
    }

    public function edit($id)
    {
        // dd(request()->all());

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
            'tinggi_badan' => 'nullable|numeric|max:250',
            'usia_kehamilan' => 'nullable|integer',
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

        return redirect()->route('pencatatan.ibu.show', $data->id)->with('success', 'Data berhasil diperbarui!');
    }
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

            return redirect()->route('pencatatan.ibu.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ✅ Kunjungan untuk Ibu 

    public function storeKunjungan(Request $request, $id_pencatatan_awal)
    {
        // Pastikan id_pencatatan_awal valid
        $pencatatanAwal = PencatatanAwal::findOrFail($id_pencatatan_awal);

        // Validasi input
        $validatedData = $request->validate([
            'waktu_pencatatan' => 'required|date',
            'berat_badan' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'tekanan_darah_sistolik' => 'nullable|numeric',
            'tekanan_darah_diastolik' => 'nullable|numeric',
            'kelas_ibu_hamil' => 'nullable',
            'mt_bumil_kek' => 'nullable',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        // Tambahkan id_pencatatan_awal ke data yang divalidasi
        $validatedData['id_pencatatan_awal'] = $id_pencatatan_awal;

        // Simpan data ke database
        $kunjungan = PencatatanKunjungan::create($validatedData);

        // Redirect ke halaman show pencatatan awal dengan pesan sukses
        return redirect()->route('pencatatan.ibu.show', $id_pencatatan_awal)
            ->with('success', 'Kunjungan berhasil ditambahkan.');
    }

    public function showKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        $data = PencatatanKunjungan::findOrFail($id);
        $kunjungan = PencatatanAwal::findOrFail($data->id_pencatatan_awal);
        $detail_kunjungan = PencatatanKunjungan::findOrFail($id);

        return view('pencatatan.ibu.kunjungan.show', compact('data', 'kunjungan', 'detail_kunjungan', 'id'));
    }

    public function editKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        $data = PencatatanKunjungan::findOrFail($id);
        $pencatatanAwal = PencatatanAwal::findOrFail($id_pencatatan_awal);

        return view('pencatatan.ibu.kunjungan.edit', [
            'data' => $data,
            'pencatatanAwal' => $pencatatanAwal,
            'kunjungan' => $data
        ]);
    }

    public function updateKunjungan(Request $request, $id_pencatatan_awal, $id)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'waktu_pencatatan' => 'required|date',
            'berat_badan' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'mt_bumil_kek' => 'nullable|in:1,2',
            'kelas_ibu_hamil' => 'nullable|in:1,2',
            'tekanan_darah_sistolik' => 'nullable|integer',
            'tekanan_darah_diastolik' => 'nullable|integer',
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
            'lingkar_lengan' => $request->lingkar_lengan,
            'mt_bumil_kek' => $request->mt_bumil_kek,
            'kelas_ibu_hamil' => $request->kelas_ibu_hamil,
            'tekanan_darah_sistolik' => $request->tekanan_darah_sistolik,
            'tekanan_darah_diastolik' => $request->tekanan_darah_diastolik,
            'keluhan' => $request->keluhan,
            'edukasi' => $request->edukasi,
        ]);

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('pencatatan.ibu.show', [$kunjungan->id, $data->id])
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

            return redirect()->route('pencatatan.ibu.show', $pencatatanAwalId)
                ->with('success', 'Data Kunjungan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
