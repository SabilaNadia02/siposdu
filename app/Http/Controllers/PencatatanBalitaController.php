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

        // Add this line to generate growth chart data
        $growthData = $this->generateGrowthChartData($id);

        return view('pencatatan.balita.show', compact('data', 'riwayatPemeriksaan', 'pencatatan_awal', 'growthData'));
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
        try {
            DB::beginTransaction();

            $data = PencatatanAwal::findOrFail($id);

            // Hapus semua kunjungan terkait terlebih dahulu
            $data->pencatatanKunjungan()->delete();

            // Baru hapus data utama
            $data->delete();

            DB::commit();

            return redirect()->route('pencatatan.balita.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }


    // ......................................................................................................
    // ✅ K U N J U N G A N 
    // ......................................................................................................

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
            'asi_eksklusif' => 'nullable',
            'mp_asi' => 'nullable',
            'mt_pangan_pemulihan' => 'nullable',
            'catatan_kesehatan' => 'nullable|string|max:255',
            'keluhan' => 'nullable|string|max:255',
            'edukasi' => 'nullable|string|max:255',
        ]);

        // Tambahkan id_pencatatan_awal ke data yang divalidasi
        $validatedData['id_pencatatan_awal'] = $id_pencatatan_awal;

        // Simpan data ke database
        $kunjungan = PencatatanKunjungan::create($validatedData);

        // Redirect ke halaman detail kunjungan dengan pesan sukses
        return redirect()->route('pencatatan.balita.show', $id_pencatatan_awal)->with('success', 'Kunjungan berhasil ditambahkan.');
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
        $pencatatanAwal = PencatatanAwal::findOrFail($id_pencatatan_awal);

        return view('pencatatan.balita.kunjungan.edit', [
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
        return redirect()->route('pencatatan.balita.show', [$kunjungan->id, $data->id])
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

            return redirect()->route('pencatatan.balita.show', $pencatatanAwalId)
                ->with('success', 'Data Kunjungan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ......................................................................................................
    // ✅ I N T E R V E N S I
    // ......................................................................................................

    private function getWHOStandardValues($ageInMonths, $gender, $chartType)
    {
        // Standar WHO untuk BB/U (Berat Badan menurut Umur)
        if ($chartType === 'weight-for-age') {
            if ($gender === 1) {
                // Laki-laki
                return $this->getWHOWeightForAgeBoys($ageInMonths);
            } else {
                // Perempuan
                return $this->getWHOWeightForAgeGirls($ageInMonths);
            }
        }
        // Standar WHO untuk PB/U (Panjang Badan menurut Umur)
        elseif ($chartType === 'length-for-age') {
            if ($gender === 1) {
                // Laki-laki
                return $this->getWHOLengthForAgeBoys($ageInMonths);
            } else {
                // Perempuan
                return $this->getWHOLengthForAgeGirls($ageInMonths);
            }
        }
        // Standar WHO untuk BB/PB (Berat Badan menurut Panjang Badan)
        elseif ($chartType === 'weight-for-length') {
            if ($gender === 1) {
                // Laki-laki
                return $this->getWHOWeightForLengthBoys($ageInMonths);
            } else {
                // Perempuan
                return $this->getWHOWeightForLengthGirls($ageInMonths);
            }
        }
        // Standar WHO untuk IMT/U (Indeks Massa Tubuh menurut Umur)
        elseif ($chartType === 'bmi-for-age') {
            if ($gender === 1) {
                // Laki-laki
                return $this->getWHOBMIForAgeBoys($ageInMonths);
            } else {
                // Perempuan
                return $this->getWHOBMIForAgeGirls($ageInMonths);
            }
        }
        // Standar WHO untuk LK/U (Lingkar Kepala menurut Umur)
        elseif ($chartType === 'head-circumference-for-age') {
            if ($gender === 1) {
                // Laki-laki
                return $this->getWHOHeadCircumferenceForAgeBoys($ageInMonths);
            } else {
                // Perempuan
                return $this->getWHOHeadCircumferenceForAgeGirls($ageInMonths);
            }
        }
    }

    // Method untuk standar BB/U laki-laki
    private function getWHOWeightForAgeBoys($ageInMonths)
    {
        // Data standar WHO untuk BB/U laki-laki (0-60 bulan)
        $standards = [
            // Format: [umur(bulan), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [0, 2.1, 2.5, 2.9, 3.3, 3.9, 4.4, 5.0],
            [1, 2.9, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6],
            [2, 3.8, 4.3, 4.9, 5.6, 6.3, 7.1, 8.0],
            [3, 4.4, 5.0, 5.7, 6.4, 7.2, 8.0, 9.0],
            [4, 4.9, 5.6, 6.3, 7.0, 7.8, 8.7, 9.7],
            [5, 5.3, 6.0, 6.7, 7.5, 8.3, 9.2, 10.2],
            [6, 5.7, 6.4, 7.1, 7.9, 8.7, 9.6, 10.7],
            [7, 5.9, 6.7, 7.4, 8.3, 9.2, 10.2, 11.3],
            [8, 6.2, 7.0, 7.7, 8.6, 9.6, 10.6, 11.7],
            [9, 6.4, 7.2, 8.0, 8.9, 9.9, 11.0, 12.2],
            [10, 6.6, 7.5, 8.2, 9.2, 10.2, 11.4, 12.6],
            [11, 6.8, 7.7, 8.4, 9.4, 10.5, 11.7, 13.0],
            [12, 6.9, 7.9, 8.6, 9.6, 10.7, 12.0, 13.3],
            [13, 7.1, 8.1, 8.9, 9.9, 11.0, 12.3, 13.7],
            [14, 7.2, 8.3, 9.1, 10.1, 11.3, 12.6, 14.0],
            [15, 7.4, 8.5, 9.3, 10.3, 11.5, 12.8, 14.3],
            [16, 7.5, 8.6, 9.5, 10.5, 11.7, 13.1, 14.6],
            [17, 7.7, 8.8, 9.7, 10.7, 12.0, 13.4, 14.9],
            [18, 7.8, 9.0, 9.9, 10.9, 12.2, 13.6, 15.2],
            [19, 8.0, 9.2, 10.1, 11.1, 12.4, 13.9, 15.5],
            [20, 8.1, 9.3, 10.3, 11.3, 12.6, 14.1, 15.8],
            [21, 8.2, 9.5, 10.5, 11.5, 12.8, 14.3, 16.1],
            [22, 8.4, 9.7, 10.7, 11.7, 13.0, 14.6, 16.4],
            [23, 8.5, 9.8, 10.9, 11.9, 13.2, 14.8, 16.7],
            [24, 8.6, 10.0, 11.1, 12.1, 13.4, 15.0, 17.0],
            [25, 8.8, 10.2, 11.3, 12.3, 13.6, 15.3, 17.3],
            [26, 8.9, 10.3, 11.5, 12.5, 13.8, 15.5, 17.6],
            [27, 9.0, 10.5, 11.7, 12.7, 14.0, 15.7, 17.9],
            [28, 9.2, 10.7, 11.9, 12.9, 14.2, 16.0, 18.2],
            [29, 9.3, 10.8, 12.1, 13.1, 14.4, 16.2, 18.5],
            [30, 9.4, 11.0, 12.3, 13.3, 14.6, 16.4, 18.8],
            [31, 9.6, 11.1, 12.5, 13.5, 14.8, 16.7, 19.1],
            [32, 9.7, 11.3, 12.7, 13.7, 15.0, 16.9, 19.4],
            [33, 9.8, 11.4, 12.9, 13.9, 15.2, 17.1, 19.7],
            [34, 10.0, 11.6, 13.1, 14.1, 15.4, 17.4, 20.0],
            [35, 10.1, 11.7, 13.3, 14.3, 15.6, 17.6, 20.3],
            [36, 10.2, 11.9, 13.5, 14.5, 15.8, 17.8, 20.6],
            [37, 10.4, 12.0, 13.7, 14.7, 16.0, 18.1, 20.9],
            [38, 10.5, 12.2, 13.9, 14.9, 16.2, 18.3, 21.2],
            [39, 10.6, 12.3, 14.1, 15.1, 16.4, 18.5, 21.5],
            [40, 10.8, 12.5, 14.3, 15.3, 16.6, 18.8, 21.8],
            [41, 10.9, 12.6, 14.5, 15.5, 16.8, 19.0, 22.1],
            [42, 11.0, 12.8, 14.7, 15.7, 17.0, 19.2, 22.4],
            [43, 11.2, 12.9, 14.9, 15.9, 17.2, 19.5, 22.7],
            [44, 11.3, 13.1, 15.1, 16.1, 17.4, 19.7, 23.0],
            [45, 11.4, 13.2, 15.3, 16.3, 17.6, 19.9, 23.3],
            [46, 11.6, 13.4, 15.5, 16.5, 17.8, 20.2, 23.6],
            [47, 11.7, 13.5, 15.7, 16.7, 18.0, 20.4, 23.9],
            [48, 11.8, 13.7, 15.9, 16.9, 18.2, 20.6, 24.2],
            [49, 12.0, 13.8, 16.1, 17.1, 18.4, 20.9, 24.5],
            [50, 12.1, 14.0, 16.3, 17.3, 18.6, 21.1, 24.8],
            [51, 12.2, 14.1, 16.5, 17.5, 18.8, 21.3, 25.1],
            [52, 12.4, 14.3, 16.7, 17.7, 19.0, 21.6, 25.4],
            [53, 12.5, 14.4, 16.9, 17.9, 19.2, 21.8, 25.7],
            [54, 12.6, 14.6, 17.1, 18.1, 19.4, 22.0, 26.0],
            [55, 12.8, 14.7, 17.3, 18.3, 19.6, 22.2, 26.3],
            [56, 12.9, 14.9, 17.5, 18.5, 19.8, 22.5, 26.6],
            [57, 13.0, 15.0, 17.7, 18.7, 20.0, 22.7, 26.9],
            [58, 13.2, 15.2, 17.9, 18.9, 20.2, 22.9, 27.2],
            [59, 13.3, 15.3, 18.1, 19.1, 20.4, 23.2, 27.5],
            [60, 13.4, 15.5, 18.3, 19.3, 20.6, 23.4, 27.8],
        ];

        return $this->getStandardValues($standards, $ageInMonths);
    }

    // Method untuk standar BB/U perempuan
    private function getWHOWeightForAgeGirls($ageInMonths)
    {
        // Data standar WHO untuk BB/U perempuan (0-60 bulan)
        $standards = [
            // Format: [umur(bulan), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [0, 2.0, 2.4, 2.8, 3.2, 3.7, 4.2, 4.8],
            [1, 2.7, 3.2, 3.6, 4.2, 4.8, 5.5, 6.2],
            [2, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6, 7.5],
            [3, 4.0, 4.5, 5.2, 5.8, 6.6, 7.5, 8.5],
            [4, 4.5, 5.0, 5.7, 6.3, 7.2, 8.1, 9.1],
            [5, 4.9, 5.4, 6.1, 6.7, 7.6, 8.6, 9.7],
            [6, 5.2, 5.7, 6.4, 7.0, 8.0, 9.0, 10.2],
            [7, 5.5, 6.0, 6.7, 7.3, 8.3, 9.4, 10.6],
            [8, 5.7, 6.3, 7.0, 7.6, 8.6, 9.8, 11.0],
            [9, 5.9, 6.5, 7.2, 7.9, 8.9, 10.1, 11.4],
            [10, 6.1, 6.7, 7.5, 8.1, 9.2, 10.4, 11.7],
            [11, 6.3, 6.9, 7.7, 8.3, 9.4, 10.7, 12.0],
            [12, 6.4, 7.0, 7.9, 8.5, 9.6, 10.9, 12.3],
            [13, 6.6, 7.2, 8.1, 8.7, 9.8, 11.2, 12.6],
            [14, 6.7, 7.4, 8.3, 8.9, 10.0, 11.4, 12.9],
            [15, 6.9, 7.6, 8.5, 9.1, 10.2, 11.6, 13.2],
            [16, 7.0, 7.7, 8.7, 9.3, 10.4, 11.8, 13.5],
            [17, 7.2, 7.9, 8.9, 9.5, 10.6, 12.1, 13.8],
            [18, 7.3, 8.1, 9.1, 9.7, 10.8, 12.3, 14.1],
            [19, 7.5, 8.3, 9.3, 9.9, 11.0, 12.5, 14.4],
            [20, 7.6, 8.4, 9.5, 10.1, 11.2, 12.7, 14.7],
            [21, 7.7, 8.6, 9.6, 10.2, 11.4, 12.9, 15.0],
            [22, 7.9, 8.7, 9.8, 10.4, 11.6, 13.1, 15.3],
            [23, 8.0, 8.9, 10.0, 10.6, 11.8, 13.3, 15.6],
            [24, 8.1, 9.0, 10.2, 10.8, 12.0, 13.5, 15.9],
            [25, 8.2, 9.1, 10.3, 10.9, 12.2, 13.7, 16.1],
            [26, 8.3, 9.3, 10.5, 11.1, 12.4, 13.9, 16.4],
            [27, 8.5, 9.4, 10.6, 11.3, 12.6, 14.1, 16.7],
            [28, 8.6, 9.5, 10.8, 11.4, 12.7, 14.3, 17.0],
            [29, 8.7, 9.6, 10.9, 11.6, 12.9, 14.5, 17.2],
            [30, 8.8, 9.8, 11.1, 11.8, 13.1, 14.7, 17.5],
            [31, 8.9, 9.9, 11.2, 11.9, 13.3, 14.9, 17.8],
            [32, 9.0, 10.0, 11.4, 12.1, 13.4, 15.1, 18.0],
            [33, 9.1, 10.1, 11.5, 12.2, 13.6, 15.3, 18.3],
            [34, 9.2, 10.2, 11.6, 12.4, 13.8, 15.5, 18.6],
            [35, 9.3, 10.3, 11.8, 12.5, 13.9, 15.7, 18.8],
            [36, 9.4, 10.4, 11.9, 12.7, 14.1, 15.9, 19.1],
            [37, 9.5, 10.5, 12.1, 12.8, 14.3, 16.1, 19.4],
            [38, 9.6, 10.6, 12.2, 13.0, 14.4, 16.3, 19.6],
            [39, 9.7, 10.7, 12.3, 13.1, 14.6, 16.5, 19.9],
            [40, 9.8, 10.8, 12.5, 13.3, 14.7, 16.7, 20.1],
            [41, 9.9, 10.9, 12.6, 13.4, 14.9, 16.9, 20.4],
            [42, 10.0, 11.0, 12.7, 13.5, 15.0, 17.0, 20.6],
            [43, 10.1, 11.1, 12.8, 13.7, 15.2, 17.2, 20.9],
            [44, 10.2, 11.2, 13.0, 13.8, 15.3, 17.4, 21.1],
            [45, 10.3, 11.3, 13.1, 14.0, 15.5, 17.6, 21.4],
            [46, 10.4, 11.4, 13.2, 14.1, 15.6, 17.8, 21.6],
            [47, 10.5, 11.5, 13.4, 14.2, 15.8, 18.0, 21.9],
            [48, 10.6, 11.6, 13.5, 14.4, 15.9, 18.1, 22.1],
            [49, 10.7, 11.7, 13.6, 14.5, 16.1, 18.3, 22.4],
            [50, 10.8, 11.8, 13.7, 14.6, 16.2, 18.5, 22.6],
            [51, 10.9, 11.9, 13.9, 14.8, 16.4, 18.7, 22.9],
            [52, 11.0, 12.0, 14.0, 14.9, 16.5, 18.8, 23.1],
            [53, 11.1, 12.1, 14.1, 15.0, 16.6, 19.0, 23.3],
            [54, 11.2, 12.2, 14.2, 15.2, 16.8, 19.2, 23.6],
            [55, 11.3, 12.3, 14.4, 15.3, 16.9, 19.4, 23.8],
            [56, 11.4, 12.4, 14.5, 15.4, 17.1, 19.5, 24.1],
            [57, 11.5, 12.5, 14.6, 15.6, 17.2, 19.7, 24.3],
            [58, 11.6, 12.6, 14.7, 15.7, 17.4, 19.9, 24.6],
            [59, 11.7, 12.7, 14.8, 15.8, 17.5, 20.0, 24.8],
            [60, 11.8, 12.8, 15.0, 16.0, 17.7, 20.2, 25.0],
        ];

        return $this->getStandardValues($standards, $ageInMonths);
    }

    // Method untuk standar PB/U laki-laki
    private function getWHOLengthForAgeBoys($ageInMonths)
    {
        // Data standar WHO untuk PB/U laki-laki (0-60 bulan)
        $standards = [
            // Format: [umur(bulan), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [0, 44.2, 46.1, 48.0, 49.9, 51.8, 53.7, 55.6],
            [1, 48.9, 50.8, 52.8, 54.7, 56.7, 58.6, 60.6],
            [2, 52.4, 54.4, 56.4, 58.4, 60.4, 62.4, 64.4],
            [3, 55.3, 57.3, 59.4, 61.4, 63.5, 65.5, 67.6],
            [4, 57.6, 59.7, 61.8, 63.8, 65.9, 68.0, 70.1],
            [5, 59.6, 61.7, 63.8, 65.9, 68.0, 70.1, 72.2],
            [6, 61.2, 63.3, 65.4, 67.6, 69.8, 71.9, 74.0],
            [7, 62.7, 64.8, 66.9, 69.2, 71.3, 73.5, 75.7],
            [8, 64.0, 66.2, 68.3, 70.6, 72.8, 75.0, 77.2],
            [9, 65.2, 67.5, 69.6, 72.0, 74.2, 76.4, 78.7],
            [10, 66.4, 68.7, 70.9, 73.3, 75.6, 77.8, 80.1],
            [11, 67.6, 69.9, 72.1, 74.5, 76.9, 79.2, 81.5],
            [12, 68.6, 71.0, 73.3, 75.7, 78.1, 80.5, 82.9],
            [13, 69.6, 72.0, 74.4, 76.9, 79.3, 81.7, 84.2],
            [14, 70.6, 73.0, 75.5, 78.0, 80.5, 83.0, 85.5],
            [15, 71.6, 74.0, 76.6, 79.1, 81.7, 84.2, 86.7],
            [16, 72.5, 75.0, 77.6, 80.2, 82.8, 85.4, 88.0],
            [17, 73.3, 75.8, 78.6, 81.2, 83.9, 86.6, 89.2],
            [18, 74.2, 76.7, 79.6, 82.3, 85.0, 87.8, 90.4],
            [19, 75.0, 77.5, 80.5, 83.2, 86.0, 88.9, 91.5],
            [20, 75.8, 78.3, 81.4, 84.2, 87.0, 90.0, 92.6],
            [21, 76.5, 79.1, 82.3, 85.1, 88.0, 91.0, 93.6],
            [22, 77.2, 79.8, 83.1, 86.0, 89.0, 92.0, 94.7],
            [23, 78.0, 80.6, 83.9, 86.9, 89.9, 93.0, 95.7],
            [24, 78.7, 81.3, 84.8, 87.8, 90.9, 94.0, 96.7],
            [25, 79.4, 82.0, 85.5, 88.6, 91.7, 94.9, 97.7],
            [26, 80.0, 82.7, 86.3, 89.4, 92.6, 95.8, 98.6],
            [27, 80.7, 83.3, 87.0, 90.2, 93.4, 96.7, 99.6],
            [28, 81.3, 84.0, 87.7, 91.0, 94.2, 97.5, 100.5],
            [29, 82.0, 84.6, 88.4, 91.7, 95.0, 98.3, 101.4],
            [30, 82.5, 85.2, 89.1, 92.5, 95.7, 99.2, 102.3],
            [31, 83.1, 85.8, 89.8, 93.2, 96.5, 100.0, 103.2],
            [32, 83.7, 86.4, 90.4, 93.9, 97.2, 100.7, 104.0],
            [33, 84.3, 87.0, 91.1, 94.6, 97.9, 101.5, 104.9],
            [34, 84.9, 87.6, 91.7, 95.2, 98.6, 102.2, 105.7],
            [35, 85.4, 88.2, 92.3, 95.9, 99.2, 102.9, 106.5],
            [36, 86.0, 88.7, 92.9, 96.5, 99.9, 103.6, 107.3],
            [37, 86.5, 89.3, 93.5, 97.1, 100.5, 104.3, 108.1],
            [38, 87.1, 89.9, 94.1, 97.7, 101.1, 105.0, 108.9],
            [39, 87.6, 90.4, 94.7, 98.3, 101.8, 105.6, 109.6],
            [40, 88.1, 90.9, 95.2, 98.9, 102.4, 106.3, 110.4],
            [41, 88.6, 91.4, 95.8, 99.5, 103.0, 106.9, 111.1],
            [42, 89.2, 92.0, 96.3, 100.0, 103.6, 107.5, 111.8],
            [43, 89.7, 92.5, 96.9, 100.6, 104.2, 108.2, 112.6],
            [44, 90.2, 93.0, 97.4, 101.2, 104.8, 108.8, 113.3],
            [45, 90.7, 93.5, 97.9, 101.7, 105.4, 109.4, 114.0],
            [46, 91.2, 94.0, 98.4, 102.3, 105.9, 110.0, 114.7],
            [47, 91.7, 94.5, 98.9, 102.8, 106.5, 110.6, 115.4],
            [48, 92.2, 95.0, 99.4, 103.3, 107.0, 111.2, 116.1],
            [49, 92.7, 95.5, 99.9, 103.9, 107.6, 111.8, 116.7],
            [50, 93.2, 96.0, 100.4, 104.4, 108.1, 112.4, 117.4],
            [51, 93.7, 96.4, 100.9, 104.9, 108.6, 113.0, 118.0],
            [52, 94.2, 96.9, 101.3, 105.4, 109.2, 113.5, 118.7],
            [53, 94.7, 97.4, 101.8, 105.9, 109.7, 114.1, 119.3],
            [54, 95.1, 97.9, 102.3, 106.4, 110.2, 114.6, 119.9],
            [55, 95.6, 98.4, 102.7, 106.9, 110.7, 115.2, 120.6],
            [56, 96.1, 98.8, 103.2, 107.4, 111.2, 115.7, 121.2],
            [57, 96.6, 99.3, 103.6, 107.9, 111.7, 116.2, 121.8],
            [58, 97.0, 99.8, 104.1, 108.4, 112.2, 116.8, 122.4],
            [59, 97.5, 100.2, 104.6, 108.9, 112.7, 117.3, 123.0],
            [60, 98.0, 100.7, 105.0, 109.4, 113.2, 117.8, 123.6],
        ];

        return $this->getStandardValues($standards, $ageInMonths);
    }

    // Method untuk standar PB/U perempuan
    private function getWHOLengthForAgeGirls($ageInMonths)
    {
        // Data standar WHO untuk PB/U perempuan (0-60 bulan)
        $standards = [
            // Format: [umur(bulan), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [0, 43.6, 45.4, 47.3, 49.1, 51.0, 52.9, 54.7],
            [1, 47.8, 49.8, 51.7, 53.7, 55.6, 57.6, 59.5],
            [2, 51.0, 53.0, 55.0, 57.1, 59.1, 61.1, 63.2],
            [3, 53.5, 55.6, 57.7, 59.8, 61.9, 64.0, 66.1],
            [4, 55.6, 57.8, 59.9, 62.1, 64.3, 66.4, 68.6],
            [5, 57.4, 59.6, 61.8, 64.0, 66.2, 68.5, 70.7],
            [6, 58.9, 61.2, 63.5, 65.7, 68.0, 70.3, 72.5],
            [7, 60.3, 62.7, 65.0, 67.3, 69.6, 71.9, 74.2],
            [8, 61.7, 64.0, 66.4, 68.7, 71.1, 73.5, 75.8],
            [9, 62.9, 65.3, 67.7, 70.1, 72.6, 75.0, 77.4],
            [10, 64.1, 66.5, 69.0, 71.5, 73.9, 76.4, 78.9],
            [11, 65.2, 67.7, 70.3, 72.8, 75.3, 77.8, 80.3],
            [12, 66.3, 68.9, 71.4, 74.0, 76.6, 79.2, 81.7],
            [13, 67.3, 70.0, 72.6, 75.2, 77.8, 80.5, 83.1],
            [14, 68.3, 71.0, 73.7, 76.4, 79.1, 81.7, 84.4],
            [15, 69.3, 72.0, 74.8, 77.5, 80.2, 83.0, 85.7],
            [16, 70.2, 73.0, 75.8, 78.6, 81.4, 84.2, 87.0],
            [17, 71.1, 74.0, 76.8, 79.7, 82.5, 85.4, 88.2],
            [18, 72.0, 74.9, 77.8, 80.7, 83.6, 86.5, 89.4],
            [19, 72.8, 75.8, 78.8, 81.7, 84.7, 87.6, 90.6],
            [20, 73.7, 76.7, 79.7, 82.7, 85.7, 88.7, 91.7],
            [21, 74.5, 77.5, 80.6, 83.7, 86.7, 89.8, 92.9],
            [22, 75.2, 78.4, 81.5, 84.6, 87.7, 90.8, 94.0],
            [23, 76.0, 79.2, 82.3, 85.5, 88.7, 91.9, 95.0],
            [24, 76.7, 80.0, 83.2, 86.4, 89.6, 92.9, 96.1],
            [25, 77.4, 80.7, 84.0, 87.2, 90.5, 93.9, 97.1],
            [26, 78.1, 81.5, 84.7, 88.0, 91.3, 94.8, 98.0],
            [27, 78.8, 82.2, 85.5, 88.7, 92.1, 95.7, 98.9],
            [28, 79.5, 82.9, 86.2, 89.4, 92.9, 96.6, 99.8],
            [29, 80.1, 83.6, 86.9, 90.1, 93.6, 97.4, 100.7],
            [30, 80.7, 84.3, 87.6, 90.7, 94.3, 98.2, 101.5],
            [31, 81.3, 84.9, 88.3, 91.4, 95.0, 99.0, 102.3],
            [32, 81.9, 85.6, 88.9, 92.0, 95.7, 99.7, 103.1],
            [33, 82.5, 86.2, 89.6, 92.6, 96.3, 100.4, 103.9],
            [34, 83.1, 86.8, 90.2, 93.2, 97.0, 101.1, 104.6],
            [35, 83.6, 87.4, 90.8, 93.8, 97.6, 101.8, 105.3],
            [36, 84.2, 88.0, 91.4, 94.4, 98.2, 102.4, 106.0],
            [37, 84.7, 88.6, 92.0, 95.0, 98.8, 103.1, 106.7],
            [38, 85.2, 89.1, 92.6, 95.6, 99.4, 103.7, 107.4],
            [39, 85.7, 89.7, 93.2, 96.1, 100.0, 104.3, 108.0],
            [40, 86.2, 90.2, 93.7, 96.7, 100.6, 104.9, 108.7],
            [41, 86.7, 90.7, 94.3, 97.2, 101.1, 105.5, 109.3],
            [42, 87.2, 91.2, 94.8, 97.7, 101.7, 106.1, 109.9],
            [43, 87.6, 91.7, 95.3, 98.2, 102.2, 106.6, 110.5],
            [44, 88.1, 92.2, 95.8, 98.7, 102.7, 107.2, 111.1],
            [45, 88.5, 92.7, 96.3, 99.2, 103.2, 107.7, 111.7],
            [46, 89.0, 93.1, 96.8, 99.7, 103.7, 108.2, 112.3],
            [47, 89.4, 93.6, 97.3, 100.2, 104.2, 108.7, 112.8],
            [48, 89.8, 94.0, 97.7, 100.6, 104.7, 109.2, 113.4],
            [49, 90.2, 94.5, 98.2, 101.1, 105.2, 109.7, 113.9],
            [50, 90.6, 94.9, 98.6, 101.5, 105.6, 110.2, 114.4],
            [51, 91.0, 95.3, 99.1, 101.9, 106.1, 110.7, 114.9],
            [52, 91.4, 95.7, 99.5, 102.4, 106.5, 111.2, 115.4],
            [53, 91.8, 96.1, 99.9, 102.8, 107.0, 111.6, 115.9],
            [54, 92.2, 96.5, 100.3, 103.2, 107.4, 112.1, 116.4],
            [56, 92.8, 97.2, 101.1, 103.6, 107.7, 112.4, 116.7],
            [57, 93.1, 97.5, 101.4, 103.9, 108.0, 112.7, 117.0],
            [58, 93.4, 97.8, 101.7, 104.2, 108.3, 113.0, 117.3],
            [59, 93.7, 98.1, 102.0, 104.5, 108.6, 113.3, 117.6],
            [60, 94.0, 98.4, 102.3, 104.8, 108.9, 113.6, 118.0],
        ];

        return $this->getStandardValues($standards, $ageInMonths);
    }

    // Method untuk standar BB/PB laki-laki
    private function getWHOWeightForLengthBoys($length)
    {
        // Data standar WHO untuk BB/PB laki-laki (45-110 cm)
        $standards = [
            // Format: [panjang badan(cm), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [45, 1.9, 2.1, 2.3, 2.5, 2.8, 3.1, 3.4],
            [50, 2.4, 2.7, 3.0, 3.3, 3.6, 4.0, 4.4],
            [55, 3.0, 3.3, 3.7, 4.1, 4.5, 5.0, 5.5],
            [60, 3.7, 4.1, 4.5, 5.0, 5.5, 6.1, 6.7],
            [65, 4.4, 4.9, 5.4, 5.9, 6.4, 7.0, 7.6],
            [70, 5.2, 5.8, 6.3, 6.8, 7.3, 7.9, 8.5],
            [75, 6.0, 6.6, 7.1, 7.7, 8.2, 8.8, 9.4],
            [80, 6.9, 7.5, 8.1, 8.7, 9.3, 9.9, 10.5],
            [85, 7.8, 8.4, 9.0, 9.6, 10.2, 10.8, 11.4],
            [90, 8.7, 9.3, 9.9, 10.5, 11.1, 11.7, 12.3],
            [95, 9.6, 10.2, 10.8, 11.4, 12.0, 12.6, 13.2],
            [100, 10.5, 11.1, 11.7, 12.3, 12.9, 13.5, 14.1],
            [105, 11.4, 12.0, 12.6, 13.2, 13.8, 14.4, 15.0],
            [110, 12.3, 12.9, 13.5, 14.1, 14.7, 15.3, 15.9]
        ];

        return $this->getStandardValues($standards, $length);
    }

    // Method untuk standar BB/PB perempuan
    private function getWHOWeightForLengthGirls($length)
    {
        // Data standar WHO untuk BB/PB perempuan (45-110 cm)
        $standards = [
            // Format: [panjang badan(cm), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [45, 1.8, 2.0, 2.2, 2.4, 2.7, 3.0, 3.3],
            [50, 2.3, 2.6, 2.9, 3.2, 3.5, 3.9, 4.3],
            [55, 2.9, 3.2, 3.6, 4.0, 4.4, 4.9, 5.4],
            [60, 3.5, 3.9, 4.3, 4.8, 5.3, 5.9, 6.5],
            [65, 4.2, 4.7, 5.2, 5.7, 6.2, 6.8, 7.3],
            [70, 5.0, 5.5, 6.0, 6.5, 7.0, 7.6, 8.1],
            [75, 5.8, 6.3, 6.8, 7.3, 7.8, 8.4, 8.9],
            [80, 6.6, 7.1, 7.6, 8.1, 8.6, 9.2, 9.7],
            [85, 7.4, 7.9, 8.4, 8.9, 9.4, 10.0, 10.5],
            [90, 8.2, 8.7, 9.2, 9.7, 10.2, 10.8, 11.3],
            [95, 9.0, 9.5, 10.0, 10.5, 11.0, 11.6, 12.1],
            [100, 9.8, 10.3, 10.8, 11.3, 11.8, 12.4, 12.9],
            [105, 10.6, 11.1, 11.6, 12.1, 12.6, 13.2, 13.7],
            [110, 11.4, 11.9, 12.4, 12.9, 13.4, 14.0, 14.5],
        ];

        return $this->getStandardValues($standards, $length);
    }

    // Method untuk standar IMT/U laki-laki
    private function getWHOBMIForAgeBoys($ageInMonths)
    {
        // Data standar WHO untuk IMT/U laki-laki (0-60 bulan)
        $standards = [
            // Format: [umur(bulan), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [0, 10.2, 11.1, 12.2, 13.4, 14.8, 16.3, 18.1],
            [1, 11.3, 12.2, 13.3, 14.6, 16.1, 17.8, 19.7],
            [2, 12.1, 13.1, 14.3, 15.7, 17.3, 19.1, 21.1],
            [3, 12.7, 13.8, 15.0, 16.5, 18.2, 20.1, 22.3],
            [4, 13.0, 14.2, 15.4, 16.9, 18.6, 20.5, 22.7],
            [5, 13.5, 14.7, 15.9, 17.4, 19.1, 21.0, 23.2],
            [6, 13.9, 15.1, 16.4, 17.9, 19.7, 21.6, 23.8],
            [7, 14.3, 15.5, 16.8, 18.3, 20.1, 22.1, 24.3],
            [8, 14.6, 15.8, 17.1, 18.6, 20.4, 22.4, 24.6],
            [9, 14.9, 16.1, 17.4, 18.9, 20.7, 22.7, 24.9],
            [10, 15.2, 16.4, 17.7, 19.2, 21.0, 23.1, 25.3],
            [11, 15.5, 16.7, 18.0, 19.5, 21.3, 23.4, 25.6],
            [12, 15.7, 16.9, 18.2, 19.7, 21.5, 23.6, 25.8],
            [13, 16.0, 17.2, 18.5, 20.0, 21.8, 23.9, 26.1],
            [14, 16.2, 17.4, 18.7, 20.2, 22.0, 24.1, 26.3],
            [15, 16.5, 17.7, 19.0, 20.5, 22.3, 24.4, 26.6],
            [16, 16.7, 17.9, 19.2, 20.7, 22.5, 24.6, 26.8],
            [17, 16.9, 18.1, 19.4, 20.9, 22.7, 24.8, 27.0],
            [18, 17.1, 18.3, 19.6, 21.1, 22.9, 25.0, 27.2],
            [19, 17.3, 18.5, 19.8, 21.3, 23.1, 25.2, 27.4],
            [20, 17.5, 18.7, 20.0, 21.5, 23.3, 25.4, 27.6],
            [21, 17.7, 18.9, 20.2, 21.7, 23.5, 25.6, 27.8],
            [22, 17.8, 19.0, 20.3, 21.8, 23.6, 25.7, 27.9],
            [23, 18.0, 19.2, 20.5, 22.0, 23.8, 25.9, 28.1],
            [24, 18.2, 19.4, 20.7, 22.2, 24.0, 26.1, 28.3],
            [25, 18.4, 19.6, 20.9, 22.4, 24.2, 26.3, 28.5],
            [26, 18.5, 19.7, 21.0, 22.5, 24.3, 26.4, 28.6],
            [27, 18.7, 19.9, 21.2, 22.7, 24.5, 26.6, 28.8],
            [28, 18.8, 20.0, 21.3, 22.8, 24.6, 26.7, 28.9],
            [29, 19.0, 20.2, 21.5, 23.0, 24.8, 26.9, 29.1],
            [30, 19.2, 20.4, 21.7, 23.2, 25.0, 27.1, 29.3],
            [31, 19.3, 20.5, 21.8, 23.3, 25.1, 27.2, 29.4],
            [32, 19.5, 20.7, 22.0, 23.5, 25.3, 27.4, 29.6],
            [33, 19.6, 20.8, 22.1, 23.6, 25.4, 27.5, 29.8],
            [34, 19.8, 21.0, 22.3, 23.8, 25.6, 27.7, 29.9],
            [35, 19.9, 21.1, 22.4, 23.9, 25.7, 27.8, 30.1],
            [36, 20.0, 21.2, 22.5, 24.0, 25.8, 28.0, 30.2],
            [37, 20.1, 21.3, 22.6, 24.1, 26.0, 28.1, 30.4],
            [38, 20.2, 21.4, 22.7, 24.2, 26.1, 28.3, 30.5],
            [39, 20.3, 21.5, 22.8, 24.3, 26.2, 28.4, 30.7],
            [40, 20.4, 21.6, 22.9, 24.4, 26.3, 28.5, 30.8],
            [41, 20.5, 21.7, 23.0, 24.5, 26.4, 28.6, 30.9],
            [42, 20.6, 21.8, 23.1, 24.6, 26.5, 28.7, 31.0],
            [43, 20.7, 21.9, 23.2, 24.7, 26.6, 28.8, 31.2],
            [44, 20.8, 22.0, 23.3, 24.8, 26.7, 28.9, 31.3],
            [45, 20.9, 22.1, 23.4, 24.9, 26.8, 29.0, 31.5],
            [46, 21.0, 22.2, 23.5, 25.0, 26.9, 29.1, 31.6],
            [47, 21.1, 22.3, 23.6, 25.1, 27.0, 29.2, 31.7],
            [48, 21.2, 22.4, 23.7, 25.2, 27.1, 29.3, 31.8],
            [49, 21.3, 22.5, 23.8, 25.3, 27.2, 29.4, 31.9],
            [50, 21.4, 22.6, 23.9, 25.4, 27.3, 29.5, 32.0],
            [51, 21.5, 22.7, 24.0, 25.5, 27.4, 29.6, 32.1],
            [52, 21.6, 22.8, 24.1, 25.6, 27.5, 29.7, 32.2],
            [53, 21.7, 22.9, 24.2, 25.7, 27.6, 29.8, 32.3],
            [54, 21.8, 23.0, 24.3, 25.8, 27.7, 29.9, 32.4],
            [55, 21.9, 23.1, 24.4, 25.9, 27.8, 30.0, 32.5],
            [56, 22.0, 23.2, 24.5, 26.0, 27.9, 30.1, 32.6],
            [57, 22.1, 23.3, 24.6, 26.1, 28.0, 30.2, 32.7],
            [58, 22.2, 23.4, 24.7, 26.2, 28.1, 30.3, 32.8],
            [59, 22.3, 23.5, 24.8, 26.3, 28.2, 30.4, 32.9],
            [60, 22.4, 23.6, 24.9, 26.4, 28.3, 30.5, 33.0],
        ];

        return $this->getStandardValues($standards, $ageInMonths);
    }

    // Method untuk standar IMT/U perempuan
    private function getWHOBMIForAgeGirls($ageInMonths)
    {
        // Data standar WHO untuk IMT/U perempuan (0-60 bulan)
        $standards = [
            // Format: [umur(bulan), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [0, 9.9, 10.8, 11.9, 13.1, 14.5, 16.0, 17.7],
            [1, 11.0, 11.9, 13.0, 14.3, 15.8, 17.4, 19.3],
            [2, 11.8, 12.8, 14.0, 15.4, 17.0, 18.8, 20.8],
            [3, 12.4, 13.5, 14.7, 16.2, 17.8, 19.7, 21.9],
            [4, 12.8, 13.9, 15.1, 16.6, 18.2, 20.1, 22.3],
            [5, 13.3, 14.4, 15.6, 17.1, 18.7, 20.6, 22.8],
            [6, 13.7, 14.8, 16.0, 17.5, 19.2, 21.1, 23.3],
            [7, 14.1, 15.2, 16.4, 17.9, 19.6, 21.5, 23.7],
            [8, 14.4, 15.5, 16.7, 18.2, 19.9, 21.8, 24.0],
            [9, 14.7, 15.8, 17.0, 18.5, 20.2, 22.1, 24.3],
            [10, 15.0, 16.1, 17.3, 18.8, 20.5, 22.4, 24.6],
            [11, 15.2, 16.3, 17.5, 19.0, 20.7, 22.6, 24.8],
            [12, 15.5, 16.6, 17.8, 19.3, 21.0, 22.9, 25.1],
            [13, 15.7, 16.8, 18.0, 19.5, 21.2, 23.1, 25.3],
            [14, 16.0, 17.1, 18.3, 19.8, 21.5, 23.4, 25.6],
            [15, 16.2, 17.3, 18.5, 20.0, 21.7, 23.6, 25.8],
            [16, 16.4, 17.5, 18.7, 20.2, 21.9, 23.8, 26.0],
            [17, 16.6, 17.7, 18.9, 20.4, 22.1, 24.0, 26.2],
            [18, 16.8, 17.9, 19.1, 20.6, 22.3, 24.2, 26.4],
            [19, 17.0, 18.1, 19.3, 20.8, 22.5, 24.4, 26.6],
            [20, 17.2, 18.3, 19.5, 21.0, 22.7, 24.6, 26.8],
            [21, 17.4, 18.5, 19.7, 21.2, 22.9, 24.8, 27.0],
            [22, 17.5, 18.7, 19.9, 21.3, 23.1, 25.0, 27.2],
            [23, 17.7, 18.8, 20.0, 21.5, 23.3, 25.2, 27.4],
            [24, 17.8, 18.9, 20.1, 21.7, 23.5, 25.4, 27.6],
            [25, 18.0, 19.1, 20.3, 21.8, 23.6, 25.5, 27.7],
            [26, 18.1, 19.2, 20.4, 21.9, 23.7, 25.6, 27.8],
            [27, 18.3, 19.4, 20.6, 22.1, 23.9, 25.8, 28.0],
            [28, 18.4, 19.5, 20.7, 22.2, 24.0, 25.9, 28.1],
            [29, 18.5, 19.6, 20.8, 22.3, 24.1, 26.0, 28.3],
            [30, 18.7, 19.7, 20.9, 22.4, 24.2, 26.1, 28.4],
            [31, 18.8, 19.8, 21.0, 22.5, 24.3, 26.2, 28.5],
            [32, 18.9, 19.9, 21.1, 22.6, 24.4, 26.3, 28.6],
            [33, 19.0, 20.0, 21.2, 22.7, 24.5, 26.4, 28.7],
            [34, 19.1, 20.1, 21.3, 22.8, 24.6, 26.5, 28.8],
            [35, 19.2, 20.2, 21.4, 22.9, 24.7, 26.6, 28.9],
            [36, 19.3, 20.3, 21.5, 23.0, 24.8, 26.7, 29.0],
            [37, 19.4, 20.4, 21.6, 23.1, 24.9, 26.8, 29.1],
            [38, 19.5, 20.5, 21.7, 23.2, 25.0, 26.9, 29.2],
            [39, 19.6, 20.6, 21.8, 23.3, 25.1, 27.0, 29.3],
            [40, 19.7, 20.7, 21.9, 23.4, 25.2, 27.1, 29.4],
            [41, 19.8, 20.8, 22.0, 23.5, 25.3, 27.2, 29.5],
            [42, 19.9, 20.9, 22.1, 23.6, 25.4, 27.3, 29.6],
            [43, 20.0, 21.0, 22.2, 23.7, 25.5, 27.4, 29.7],
            [44, 20.1, 21.1, 22.3, 23.8, 25.6, 27.5, 29.8],
            [45, 20.2, 21.2, 22.4, 23.9, 25.7, 27.6, 29.9],
            [46, 20.3, 21.3, 22.5, 24.0, 25.8, 27.7, 30.0],
            [47, 20.4, 21.4, 22.6, 24.1, 25.9, 27.8, 30.1],
            [48, 20.5, 21.5, 22.7, 24.2, 26.0, 28.0, 30.2],
            [49, 20.6, 21.6, 22.8, 24.3, 26.1, 28.1, 30.3],
            [50, 20.7, 21.7, 22.9, 24.4, 26.2, 28.2, 30.4],
            [51, 20.8, 21.8, 23.0, 24.5, 26.3, 28.3, 30.5],
            [52, 20.9, 21.9, 23.1, 24.6, 26.4, 28.4, 30.6],
            [53, 21.0, 22.0, 23.2, 24.7, 26.5, 28.5, 30.7],
            [54, 21.1, 22.1, 23.3, 24.8, 26.6, 28.6, 30.8],
            [55, 21.2, 22.2, 23.4, 24.9, 26.7, 28.7, 30.9],
            [56, 21.3, 22.3, 23.5, 25.0, 26.8, 28.8, 31.0],
            [57, 21.4, 22.4, 23.6, 25.1, 26.9, 28.9, 31.1],
            [58, 21.5, 22.5, 23.7, 25.2, 27.0, 29.0, 31.2],
            [59, 21.6, 22.6, 23.8, 25.3, 27.1, 29.1, 31.3],
            [60, 21.7, 22.7, 23.9, 25.4, 27.2, 29.2, 31.4],
        ];

        return $this->getStandardValues($standards, $ageInMonths);
    }

    // Method untuk standar LK/U laki-laki
    private function getWHOHeadCircumferenceForAgeBoys($ageInMonths)
    {
        // Data standar WHO untuk LK/U laki-laki (0-60 bulan)
        $standards = [
            // Format: [umur(bulan), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [0, 30.7, 31.9, 33.1, 34.5, 35.9, 37.3, 38.7],
            [1, 33.8, 35.1, 36.4, 37.9, 39.4, 40.9, 42.4],
            [2, 36.0, 37.4, 38.8, 40.4, 42.0, 43.6, 45.2],
            [3, 37.5, 38.9, 40.4, 42.0, 43.6, 45.3, 47.0],
            [4, 38.9, 40.3, 41.8, 43.3, 44.9, 46.5, 48.0],
            [5, 39.9, 41.3, 42.8, 44.3, 45.9, 47.5, 49.0],
            [6, 40.8, 42.2, 43.7, 45.2, 46.8, 48.4, 49.9],
            [7, 41.6, 43.0, 44.5, 46.0, 47.6, 49.2, 50.7],
            [8, 42.4, 43.8, 45.3, 46.8, 48.4, 50.0, 51.5],
            [9, 43.2, 44.6, 46.1, 47.6, 49.2, 50.8, 52.3],
            [10, 44.0, 45.4, 46.9, 48.4, 50.0, 51.6, 53.1],
            [11, 44.7, 46.1, 47.6, 49.1, 50.7, 52.3, 53.8],
            [12, 45.4, 46.8, 48.3, 49.8, 51.4, 53.0, 54.5],
            [13, 46.1, 47.5, 49.0, 50.5, 52.1, 53.7, 55.2],
            [14, 46.8, 48.2, 49.7, 51.2, 52.8, 54.4, 55.9],
            [15, 47.5, 48.9, 50.4, 51.9, 53.5, 55.1, 56.6],
            [16, 48.1, 49.5, 51.0, 52.5, 54.1, 55.7, 57.2],
            [17, 48.7, 50.1, 51.6, 53.1, 54.7, 56.3, 57.8],
            [18, 49.3, 50.7, 52.2, 53.7, 55.3, 56.9, 58.4],
            [19, 49.8, 51.2, 52.7, 54.2, 55.8, 57.4, 58.9],
            [20, 50.3, 51.7, 53.2, 54.7, 56.3, 57.9, 59.4],
            [21, 50.8, 52.2, 53.7, 55.2, 56.8, 58.4, 59.9],
            [22, 51.3, 52.7, 54.2, 55.7, 57.3, 58.9, 60.4],
            [23, 51.8, 53.2, 54.7, 56.2, 57.8, 59.4, 60.9],
            [24, 52.3, 53.7, 55.2, 56.7, 58.3, 59.9, 61.4],
            [25, 52.8, 54.2, 55.7, 57.2, 58.8, 60.4, 61.9],
            [26, 53.3, 54.7, 56.2, 57.7, 59.3, 60.9, 62.4],
            [27, 53.8, 55.2, 56.7, 58.2, 59.8, 61.4, 62.9],
            [28, 54.2, 55.6, 57.1, 58.6, 60.2, 61.8, 63.3],
            [29, 54.7, 56.1, 57.6, 59.1, 60.7, 62.3, 63.8],
            [30, 55.1, 56.5, 58.0, 59.5, 61.1, 62.7, 64.2],
            [31, 55.5, 56.9, 58.4, 59.9, 61.5, 63.1, 64.6],
            [32, 56.0, 57.4, 58.9, 60.4, 62.0, 63.6, 65.1],
            [33, 56.4, 57.8, 59.3, 60.8, 62.4, 64.0, 65.5],
            [34, 56.8, 58.2, 59.7, 61.2, 62.8, 64.4, 65.9],
            [35, 57.2, 58.6, 60.1, 61.6, 63.2, 64.8, 66.3],
            [36, 57.6, 59.0, 60.5, 62.0, 63.6, 65.2, 66.7],
            [37, 58.0, 59.4, 60.9, 62.4, 64.0, 65.6, 67.1],
            [38, 58.4, 59.8, 61.3, 62.8, 64.4, 66.0, 67.5],
            [39, 58.7, 60.1, 61.6, 63.1, 64.7, 66.3, 67.8],
            [40, 59.1, 60.5, 61.9, 63.4, 65.0, 66.6, 68.1],
            [41, 59.4, 60.8, 62.3, 63.8, 65.4, 67.0, 68.5],
            [42, 59.8, 61.2, 62.7, 64.2, 65.8, 67.4, 68.9],
            [43, 60.1, 61.5, 63.0, 64.5, 66.1, 67.7, 69.2],
            [44, 60.4, 61.8, 63.3, 64.8, 66.4, 68.0, 69.5],
            [45, 60.7, 62.1, 63.6, 65.1, 66.7, 68.3, 69.8],
            [46, 61.0, 62.4, 63.9, 65.4, 67.0, 68.6, 70.1],
            [47, 61.3, 62.7, 64.2, 65.7, 67.3, 68.9, 70.4],
            [48, 61.6, 63.0, 64.5, 66.0, 67.6, 69.2, 70.7],
            [49, 61.9, 63.3, 64.8, 66.3, 67.9, 69.5, 71.0],
            [50, 62.2, 63.6, 65.1, 66.6, 68.2, 69.8, 71.3],
            [51, 62.5, 63.9, 65.4, 66.9, 68.5, 70.1, 71.6],
            [52, 62.8, 64.2, 65.7, 67.2, 68.8, 70.4, 71.9],
            [53, 63.1, 64.5, 65.9, 67.4, 69.0, 70.6, 72.1],
            [54, 63.3, 64.7, 66.2, 67.7, 69.3, 70.9, 72.4],
            [55, 63.6, 65.0, 66.5, 68.0, 69.6, 71.2, 72.7],
            [56, 63.9, 65.3, 66.8, 68.3, 69.9, 71.5, 73.0],
            [57, 64.2, 65.6, 67.1, 68.6, 70.2, 71.8, 73.3],
            [58, 64.5, 65.9, 67.4, 68.9, 70.5, 72.1, 73.6],
            [59, 64.7, 66.1, 67.6, 69.1, 70.7, 72.3, 73.8],
            [60, 65.0, 66.4, 67.9, 69.4, 71.0, 72.6, 74.1],
        ];

        return $this->getStandardValues($standards, $ageInMonths);
    }

    // Method untuk standar LK/U perempuan
    private function getWHOHeadCircumferenceForAgeGirls($ageInMonths)
    {
        // Data standar WHO untuk LK/U perempuan (0-60 bulan)
        $standards = [
            // Format: [umur(bulan), -3SD, -2SD, -1SD, median, +1SD, +2SD, +3SD]
            [0, 30.1, 31.3, 32.5, 33.9, 35.3, 36.7, 38.1],
            [1, 33.2, 34.5, 35.8, 37.3, 38.7, 40.2, 41.7],
            [2, 35.4, 36.8, 38.2, 39.7, 41.2, 42.7, 44.2],
            [3, 36.9, 38.3, 39.8, 41.4, 43.0, 44.6, 46.1],
            [4, 37.2, 38.7, 40.2, 41.8, 43.3, 44.9, 46.4],
            [5, 37.5, 39.0, 40.5, 42.1, 43.7, 45.2, 46.7],
            [6, 37.8, 39.3, 40.8, 42.4, 44.0, 45.5, 47.0],
            [7, 38.0, 39.5, 41.0, 42.6, 44.2, 45.7, 47.2],
            [8, 38.2, 39.7, 41.2, 42.8, 44.4, 45.9, 47.4],
            [9, 38.4, 39.9, 41.4, 43.0, 44.6, 46.1, 47.6],
            [10, 38.6, 40.1, 41.6, 43.2, 44.8, 46.3, 47.8],
            [11, 38.8, 40.3, 41.8, 43.4, 45.0, 46.5, 48.0],
            [12, 39.0, 40.5, 42.0, 43.6, 45.2, 46.7, 48.2],
            [13, 39.2, 40.7, 42.2, 43.8, 45.4, 46.9, 48.4],
            [14, 39.4, 40.9, 42.4, 44.0, 45.6, 47.1, 48.6],
            [15, 39.6, 41.1, 42.6, 44.2, 45.8, 47.3, 48.8],
            [16, 39.8, 41.3, 42.8, 44.4, 46.0, 47.5, 49.0],
            [17, 40.0, 41.5, 43.0, 44.6, 46.2, 47.7, 49.2],
            [18, 40.2, 41.7, 43.2, 44.8, 46.4, 47.9, 49.4],
            [19, 40.3, 41.8, 43.3, 44.9, 46.5, 48.0, 49.5],
            [20, 40.5, 42.0, 43.5, 45.1, 46.7, 48.2, 49.7],
            [21, 40.7, 42.2, 43.7, 45.3, 46.9, 48.4, 49.9],
            [22, 40.9, 42.3, 43.8, 45.4, 47.0, 48.5, 50.0],
            [23, 41.1, 42.5, 44.0, 45.6, 47.2, 48.7, 50.2],
            [24, 41.3, 42.7, 44.2, 45.8, 47.4, 48.9, 50.4],
            [25, 41.5, 42.9, 44.4, 46.0, 47.6, 49.1, 50.6],
            [26, 41.7, 43.1, 44.6, 46.2, 47.8, 49.3, 50.8],
            [27, 41.9, 43.3, 44.8, 46.4, 48.0, 49.5, 51.0],
            [28, 42.1, 43.5, 45.0, 46.6, 48.2, 49.7, 51.2],
            [29, 42.3, 43.7, 45.2, 46.8, 48.4, 49.9, 51.4],
            [30, 42.5, 43.9, 45.4, 47.0, 48.6, 50.1, 51.6],
            [31, 42.7, 44.1, 45.6, 47.2, 48.8, 50.3, 51.8],
            [32, 42.9, 44.3, 45.8, 47.4, 49.0, 50.5, 52.0],
            [33, 43.1, 44.5, 46.0, 47.6, 49.2, 50.7, 52.2],
            [34, 43.3, 44.7, 46.2, 47.8, 49.4, 50.9, 52.4],
            [35, 43.5, 44.9, 46.4, 48.0, 49.6, 51.1, 52.6],
            [36, 43.7, 45.1, 46.6, 48.2, 49.8, 51.3, 52.8],
            [37, 43.9, 45.3, 46.8, 48.4, 50.0, 51.5, 53.0],
            [38, 44.1, 45.5, 47.0, 48.6, 50.2, 51.7, 53.2],
            [39, 44.3, 45.7, 47.2, 48.8, 50.4, 51.9, 53.4],
            [40, 44.5, 45.9, 47.4, 49.0, 50.6, 52.1, 53.6],
            [41, 44.7, 46.1, 47.6, 49.2, 51.0, 52.5, 54.0],
            [42, 44.9, 46.3, 47.8, 49.4, 51.2, 52.7, 54.2],
            [43, 45.1, 46.5, 48.0, 49.6, 51.4, 52.9, 54.4],
            [44, 45.3, 46.7, 48.2, 49.8, 51.6, 53.1, 54.6],
            [45, 45.5, 46.9, 48.4, 50.0, 51.8, 53.3, 54.8],
            [46, 45.7, 47.1, 48.6, 50.2, 52.0, 53.5, 55.0],
            [47, 45.9, 47.3, 48.8, 50.4, 52.2, 53.7, 55.2],
            [48, 46.1, 47.5, 49.0, 50.6, 52.4, 53.9, 55.4],
            [49, 46.3, 47.7, 49.2, 50.8, 52.6, 54.1, 55.6],
            [50, 46.5, 47.9, 49.4, 51.0, 52.8, 54.3, 55.8],
            [51, 46.7, 48.1, 49.6, 51.2, 53.0, 54.5, 56.0],
            [52, 46.9, 48.3, 49.8, 51.4, 53.2, 54.7, 56.2],
            [53, 47.1, 48.5, 50.0, 51.6, 53.4, 54.9, 56.4],
            [54, 47.3, 48.7, 50.2, 51.8, 53.6, 55.1, 56.6],
            [55, 47.5, 48.9, 50.4, 52.0, 53.8, 55.3, 56.8],
            [56, 47.7, 49.1, 50.6, 52.2, 54.0, 55.5, 57.0],
            [57, 47.9, 49.3, 50.8, 52.4, 54.2, 55.7, 57.2],
            [58, 48.1, 49.5, 51.0, 52.6, 54.4, 55.9, 57.4],
            [59, 48.3, 49.7, 51.2, 52.8, 54.6, 56.1, 57.6],
            [60, 48.5, 49.9, 51.4, 53.0, 54.8, 56.3, 57.8],
        ];

        return $this->getStandardValues($standards, $ageInMonths);
    }

    // Method helper untuk mendapatkan nilai standar berdasarkan usia
    private function getStandardValues($standards, $value)
    {
        // Cari standar yang sesuai dengan usia/panjang badan
        foreach ($standards as $standard) {
            if ($standard[0] >= $value) {
                return [
                    '-3SD' => $standard[1],
                    '-2SD' => $standard[2],
                    '-1SD' => $standard[3],
                    'median' => $standard[4],
                    '+1SD' => $standard[5],
                    '+2SD' => $standard[6],
                    '+3SD' => $standard[7]
                ];
            }
        }

        // Jika tidak ditemukan, kembalikan standar terakhir
        $last = end($standards);
        return [
            '-3SD' => $last[1],
            '-2SD' => $last[2],
            '-1SD' => $last[3],
            'median' => $last[4],
            '+1SD' => $last[5],
            '+2SD' => $last[6],
            '+3SD' => $last[7]
        ];
    }

    // Modifikasi method generateGrowthChartData untuk menambahkan data standar
    public function generateGrowthChartData($id_pencatatan_awal)
    {
        $pencatatanAwal = PencatatanAwal::with(['pendaftaran', 'pencatatanKunjungan'])
            ->findOrFail($id_pencatatan_awal);

        $birthDate = $pencatatanAwal->pendaftaran->tanggal_lahir;
        $birthWeight = $pencatatanAwal->berat_badan_lahir;
        $birthLength = $pencatatanAwal->panjang_badan_lahir;
        $gender = $pencatatanAwal->pendaftaran->jenis_kelamin;

        // Get all visits sorted by date
        $visits = $pencatatanAwal->pencatatanKunjungan()
            ->orderBy('waktu_pencatatan', 'asc')
            ->get();

        // Prepare data for chart
        $chartData = [
            'labels' => ['Lahir'],
            'weight' => [$birthWeight],
            'length' => [$birthLength],
            'headCircumference' => [null],
            'armCircumference' => [null],
            'bmi' => [null],
            'ages' => [0],
            'gender' => $gender,
            'standards' => [
                'weightForAge' => [$this->getWHOStandardValues(0, $gender, 'weight-for-age')],
                'lengthForAge' => [$this->getWHOStandardValues(0, $gender, 'length-for-age')],
                'weightForLength' => [$this->getWHOStandardValues($birthLength, $gender, 'weight-for-length')],
                'bmiForAge' => [$this->getWHOStandardValues(0, $gender, 'bmi-for-age')],
                'headCircumferenceForAge' => [$this->getWHOStandardValues(0, $gender, 'head-circumference-for-age')]
            ]
        ];

        $birthDate = Carbon::parse($birthDate);

        // Add visit data
        foreach ($visits as $visit) {
            $visitDate = Carbon::parse($visit->waktu_pencatatan);
            $ageInMonths = $birthDate->diffInMonths($visitDate);

            // Hitung IMT jika data tersedia
            $bmi = null;
            if ($visit->berat_badan && $visit->panjang_badan) {
                $heightInM = $visit->panjang_badan / 100;
                $bmi = $visit->berat_badan / ($heightInM * $heightInM);
            }

            $chartData['labels'][] = $visitDate->format('M Y');
            $chartData['weight'][] = $visit->berat_badan;
            $chartData['length'][] = $visit->panjang_badan;
            $chartData['headCircumference'][] = $visit->lingkar_kepala;
            $chartData['armCircumference'][] = $visit->lingkar_lengan;
            $chartData['bmi'][] = $bmi;
            $chartData['ages'][] = $ageInMonths;

            // Tambahkan standar untuk setiap kunjungan
            $chartData['standards']['weightForAge'][] = $this->getWHOStandardValues($ageInMonths, $gender, 'weight-for-age');
            $chartData['standards']['lengthForAge'][] = $this->getWHOStandardValues($ageInMonths, $gender, 'length-for-age');
            $chartData['standards']['weightForLength'][] = $this->getWHOStandardValues($visit->panjang_badan, $gender, 'weight-for-length');
            $chartData['standards']['bmiForAge'][] = $this->getWHOStandardValues($ageInMonths, $gender, 'bmi-for-age');
            $chartData['standards']['headCircumferenceForAge'][] = $this->getWHOStandardValues($ageInMonths, $gender, 'head-circumference-for-age');
        }

        // Calculate growth status and recommendations
        $latestVisit = $visits->last();
        $analysis = $latestVisit ? $this->analyzeGrowthStatus($pencatatanAwal, $latestVisit) : null;

        return [
            'chartData' => $chartData,
            'analysis' => $analysis,
            'birthData' => [
                'weight' => $birthWeight,
                'length' => $birthLength,
                'date' => $birthDate->format('Y-m-d')
            ],
            'latestData' => $latestVisit ? [
                'weight' => $latestVisit->berat_badan,
                'length' => $latestVisit->panjang_badan,
                'headCircumference' => $latestVisit->lingkar_kepala,
                'armCircumference' => $latestVisit->lingkar_lengan,
                'bmi' => $bmi,
                'date' => $latestVisit->waktu_pencatatan,
                'ageInMonths' => $birthDate->diffInMonths(Carbon::parse($latestVisit->waktu_pencatatan))
            ] : null
        ];
    }

    /**
     * Analyze growth status and provide recommendations
     */
    private function analyzeGrowthStatus($pencatatanAwal, $latestVisit)
    {
        if (!$latestVisit) {
            return null;
        }

        $birthDate = Carbon::parse($pencatatanAwal->pendaftaran->tanggal_lahir);
        $visitDate = Carbon::parse($latestVisit->waktu_pencatatan);
        $ageInMonths = $birthDate->diffInMonths($visitDate);
        $gender = $pencatatanAwal->pendaftaran->jenis_kelamin; 

        // Get WHO standard values for weight and length
        $weightStandard = $this->getWHOStandardValues($ageInMonths, $gender, 'weight-for-age');
        $lengthStandard = $this->getWHOStandardValues($ageInMonths, $gender, 'length-for-age');

        // Calculate standard deviation (SD) from the WHO standards
        // SD can be calculated as (median - (-1SD)) or (+1SD - median)
        $weightSD = ($weightStandard['+1SD'] - $weightStandard['median']);
        $lengthSD = ($lengthStandard['+1SD'] - $lengthStandard['median']);

        // Calculate z-scores
        $weightZScore = $this->calculateZScore($latestVisit->berat_badan, $weightStandard['median'], $weightSD);
        $lengthZScore = $this->calculateZScore($latestVisit->panjang_badan, $lengthStandard['median'], $lengthSD);

        // Determine status
        $weightStatus = $this->determineWeightStatus($weightZScore);
        $lengthStatus = $this->determineLengthStatus($lengthZScore);

        // Generate recommendations
        $recommendations = $this->generateRecommendations($weightStatus, $lengthStatus, $ageInMonths, $latestVisit);

        return [
            'weight' => [
                'value' => $latestVisit->berat_badan,
                'zScore' => $weightZScore,
                'status' => $weightStatus,
                'median' => $weightStandard['median'],
                'sd' => $weightSD
            ],
            'length' => [
                'value' => $latestVisit->panjang_badan,
                'zScore' => $lengthZScore,
                'status' => $lengthStatus,
                'median' => $lengthStandard['median'],
                'sd' => $lengthSD
            ],
            'ageInMonths' => $ageInMonths,
            'recommendations' => $recommendations
        ];
    }

    // Helper method to calculate SD from WHO standards
    private function getSD($standardValues)
    {
        // Calculate SD as (median - (-1SD)) or (+1SD - median)
        return $standardValues['median'] - $standardValues['-1SD'];
    }

    /**
     * Calculate z-score
     */
    private function calculateZScore($value, $median, $sd)
    {
        if ($sd == 0) {
            return 0;
        }
        return ($value - $median) / $sd;
    }

    /**
     * Determine weight status based on z-score
     */
    private function determineWeightStatus($zScore)
    {
        if ($zScore < -3) {
            return 'Sangat Kurang';
        }
        if ($zScore < -2) {
            return 'Kurang';
        }
        if ($zScore > 2) {
            return 'Lebih';
        }
        if ($zScore > 1) {
            return 'Risiko Lebih';
        }
        return 'Normal';
    }

    /**
     * Determine length status based on z-score
     */
    private function determineLengthStatus($zScore)
    {
        if ($zScore < -3) {
            return 'Sangat Pendek';
        }
        if ($zScore < -2) {
            return 'Pendek';
        }
        if ($zScore > 2) {
            return 'Tinggi';
        }
        return 'Normal';
    }

    /**
     * Generate nutrition and intervention recommendations
     */
    private function generateRecommendations($weightStatus, $lengthStatus, $ageInMonths, $visit)
    {
        $recommendations = [];

        // General recommendations based on age
        if ($ageInMonths < 6) {
            $recommendations[] = "ASI eksklusif hingga 6 bulan";
        } elseif ($ageInMonths < 24) {
            $recommendations[] = "Pemberian MP-ASI yang tepat dan cukup";
            if ($visit->asi_eksklusif == 2) {
                $recommendations[] = "Teruskan pemberian ASI hingga 2 tahun";
            }
        }

        // Weight-specific recommendations
        if (in_array($weightStatus, ['Sangat Kurang', 'Kurang'])) {
            $recommendations[] = "Perbaikan asupan makanan dengan meningkatkan frekuensi dan kualitas MP-ASI";
            $recommendations[] = "Pemantauan berat badan setiap bulan";
            if ($weightStatus == 'Sangat Kurang') {
                $recommendations[] = "Rujuk ke puskesmas/fasilitas kesehatan untuk evaluasi lebih lanjut";
            }
        } elseif ($weightStatus == 'Lebih') {
            $recommendations[] = "Pengaturan asupan makanan sesuai kebutuhan";
            $recommendations[] = "Peningkatan aktivitas fisik sesuai usia";
        }

        // Length-specific recommendations
        if (in_array($lengthStatus, ['Sangat Pendek', 'Pendek'])) {
            $recommendations[] = "Perbaikan asupan protein dan zat gizi mikro (zat besi, zinc, vitamin A)";
            $recommendations[] = "Pemantauan pertumbuhan secara berkala";
            if ($lengthStatus == 'Sangat Pendek') {
                $recommendations[] = "Rujuk ke puskesmas/fasilitas kesehatan untuk evaluasi lebih lanjut";
            }
        }

        // Additional recommendations based on visit data
        if ($visit->mp_asi == 2 && $ageInMonths >= 6) {
            $recommendations[] = "Mulai perkenalkan MP-ASI dengan tekstur dan gizi yang sesuai usia";
        }

        return array_unique($recommendations);
    }
}
