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

    // INTERVENSI
    /**
     * Generate growth chart data for a specific child
     */
    /**
     * Generate growth chart data for a specific child
     */
    public function generateGrowthChartData($id_pencatatan_awal)
    {
        $pencatatanAwal = PencatatanAwal::with(['pendaftaran', 'pencatatanKunjungan'])
            ->findOrFail($id_pencatatan_awal);

        $birthDate = $pencatatanAwal->pendaftaran->tanggal_lahir;
        $birthWeight = $pencatatanAwal->berat_badan_lahir;
        $birthLength = $pencatatanAwal->panjang_badan_lahir;

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
            'ages' => [0]
        ];

        $birthDate = Carbon::parse($birthDate);

        // Add visit data
        foreach ($visits as $visit) {
            $visitDate = Carbon::parse($visit->waktu_pencatatan);
            $ageInMonths = $birthDate->diffInMonths($visitDate);

            $chartData['labels'][] = $visitDate->format('M Y');
            $chartData['weight'][] = $visit->berat_badan;
            $chartData['length'][] = $visit->panjang_badan;
            $chartData['headCircumference'][] = $visit->lingkar_kepala;
            $chartData['armCircumference'][] = $visit->lingkar_lengan;
            $chartData['ages'][] = $ageInMonths;
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
        $gender = $pencatatanAwal->pendaftaran->jenis_kelamin; // Assuming this field exists

        // Get WHO standard values based on age and gender
        $standardValues = $this->getWHOStandardValues($ageInMonths, $gender);

        // Calculate z-scores
        $weightZScore = $this->calculateZScore($latestVisit->berat_badan, $standardValues['medianWeight'], $standardValues['sdWeight']);
        $lengthZScore = $this->calculateZScore($latestVisit->panjang_badan, $standardValues['medianLength'], $standardValues['sdLength']);

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
                'median' => $standardValues['medianWeight'],
                'sd' => $standardValues['sdWeight']
            ],
            'length' => [
                'value' => $latestVisit->panjang_badan,
                'zScore' => $lengthZScore,
                'status' => $lengthStatus,
                'median' => $standardValues['medianLength'],
                'sd' => $standardValues['sdLength']
            ],
            'ageInMonths' => $ageInMonths,
            'recommendations' => $recommendations
        ];
    }

    /**
     * Calculate z-score
     */
    private function calculateZScore($value, $median, $sd)
    {
        if ($sd == 0)
            return 0;
        return ($value - $median) / $sd;
    }

    /**
     * Determine weight status based on z-score
     */
    private function determineWeightStatus($zScore)
    {
        if ($zScore < -3)
            return 'Sangat Kurang';
        if ($zScore < -2)
            return 'Kurang';
        if ($zScore > 2)
            return 'Lebih';
        if ($zScore > 1)
            return 'Risiko Lebih';
        return 'Normal';
    }

    /**
     * Determine length status based on z-score
     */
    private function determineLengthStatus($zScore)
    {
        if ($zScore < -3)
            return 'Sangat Pendek';
        if ($zScore < -2)
            return 'Pendek';
        if ($zScore > 2)
            return 'Tinggi';
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

    /**
     * Get WHO standard values for growth (simplified example)
     */
    private function getWHOStandardValues($ageInMonths, $gender)
    {
        // Note: In a real application, this should use actual WHO growth standards
        // This is a simplified example with dummy data

        $medianWeight = 3.2 + ($ageInMonths * 0.6);
        $sdWeight = 0.8 + ($ageInMonths * 0.05);

        $medianLength = 49.5 + ($ageInMonths * 2.5);
        $sdLength = 2.0 + ($ageInMonths * 0.1);

        return [
            'medianWeight' => $medianWeight,
            'sdWeight' => $sdWeight,
            'medianLength' => $medianLength,
            'sdLength' => $sdLength
        ];
    }
}
