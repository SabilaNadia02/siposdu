<?php

namespace App\Http\Controllers;

use App\Models\DataSkrining;
use App\Models\DetailPencatatanSkrining;
use App\Models\PencatatanSkrining;
use App\Models\Pendaftaran;
use App\Models\PertanyaanSkrining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkriningPPOKController extends Controller
{
    /**
     * Menampilkan daftar data skrining PPOK.
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::whereIn('jenis_sasaran', [3])->get();

        $skriningPPOK = PencatatanSkrining::with(['dataSkrining', 'detailPencatatanSkrining.pertanyaanSkrining.dataPertanyaan', 'pendaftaran'])
            ->whereHas('dataSkrining', function ($query) {
                $query->where('id', 2);
            })
            ->orderBy('waktu_skrining', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Hitung total dengan dan tanpa gejala dari seluruh data (bukan hanya halaman saat ini)
        $totalDenganGejala = PencatatanSkrining::whereHas('dataSkrining', function ($query) {
            $query->where('id', 2);
        })
            ->get()
            ->filter(function ($skrining) {
                return $this->hitungSkorPPOK($skrining) > 6;
            })
            ->count();

        $totalTanpaGejala = PencatatanSkrining::whereHas('dataSkrining', function ($query) {
            $query->where('id', 2);
        })
            ->get()
            ->filter(function ($skrining) {
                return $this->hitungSkorPPOK($skrining) <= 6;
            })
            ->count();

        return view('skrining.ppok.index', compact(
            'pendaftarans',
            'skriningPPOK',
            'totalDenganGejala',
            'totalTanpaGejala'
        ));
    }

    /**
     * Menghitung skor PPOK berdasarkan jawaban
     */
    private function hitungSkorPPOK($skrining)
    {
        $totalSkor = 0;

        foreach ($skrining->detailPencatatanSkrining as $detail) {
            $pertanyaanId = $detail->pertanyaanSkrining->id;
            $jawaban = $detail->hasil_skrining;
            $skor = 0;

            switch ($pertanyaanId) {
                case 5: // Jenis Kelamin
                    $skor = $jawaban == 1 ? 1 : 0; // Laki-laki = 1 poin
                    break;
                case 6: // Usia
                    if ($jawaban >= 60) {
                        $skor = 2;
                    } elseif ($jawaban >= 50) {
                        $skor = 1;
                    }
                    break;
                case 7: // Merokok
                    if ($jawaban == 3) { // 20-30 bungkus/tahun
                        $skor = 1;
                    } elseif ($jawaban == 4) { // >=30 bungkus/tahun
                        $skor = 2;
                    }
                    break;
                case 8: // Nafas pendek
                case 9: // Dahak dari paru
                case 10: // Batuk tanpa flu
                case 11: // Pemeriksaan spirometri
                    $skor = $jawaban == 1 ? 1 : 0; // Ya = 1 poin
                    break;
            }

            $totalSkor += $skor;
        }

        return $totalSkor;
    }

    /**
     * Menampilkan form untuk menambahkan skrining PPOK.
     */
    public function create()
    {
        // 
    }

    /**
     * Menyimpan hasil skrining PPOK.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'waktu_skrining' => 'required|date',
            'pertanyaan' => 'required|array|min:7',
            'pertanyaan.5' => 'required|in:1,2',
            'pertanyaan.6' => 'required|numeric',
            'pertanyaan.7' => 'required|in:1,2,3,4',
            'pertanyaan.8' => 'required|in:1,2',
            'pertanyaan.9' => 'required|in:1,2',
            'pertanyaan.10' => 'required|in:1,2',
            'pertanyaan.11' => 'required|in:1,2',
        ]);

        DB::beginTransaction();

        try {
            $skriningPPOK = DataSkrining::where('nama_skrining', 'PPOK')->firstOrFail();

            // Hitung total skor
            $totalSkor = $this->hitungSkorPPOKFromRequest($validated['pertanyaan']);

            // Simpan data utama
            $pencatatan = PencatatanSkrining::create([
                'id_skrining' => $skriningPPOK->id,
                'no_pendaftaran' => $validated['no_pendaftaran'],
                'waktu_skrining' => $validated['waktu_skrining'],
                'hasil_skrining' => ($totalSkor > 6) ? 1 : 2,
            ]);

            // Simpan detail pertanyaan
            foreach ($validated['pertanyaan'] as $idPertanyaan => $jawaban) {
                DetailPencatatanSkrining::create([
                    'id_pencatatan_skrining' => $pencatatan->id,
                    'id_pertanyaan_skrining' => $idPertanyaan,
                    'hasil_skrining' => $jawaban,
                ]);
            }

            DB::commit();
            return redirect()->route('skrining.ppok.index')->with('success', 'Data skrining PPOK berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error menyimpan skrining: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    private function hitungSkorPPOKFromRequest($jawaban)
    {
        $totalSkor = 0;

        // Jenis Kelamin (5)
        $totalSkor += ($jawaban[5] == 1) ? 1 : 0; // Laki-laki=1, Perempuan=0

        // Usia (6)
        $usia = $jawaban[6];
        if ($usia >= 60)
            $totalSkor += 2;
        elseif ($usia >= 50)
            $totalSkor += 1;

        // Merokok (7)
        if ($jawaban[7] == 3)
            $totalSkor += 1;
        elseif ($jawaban[7] == 4)
            $totalSkor += 2;

        // Pertanyaan lainnya (8-11)
        for ($i = 8; $i <= 11; $i++) {
            $totalSkor += ($jawaban[$i] == 1) ? 1 : 0;
        }

        return $totalSkor;
    }

    /**
     * Menampilkan detail skrining PPOK.
     */
    public function show(string $id)
    {
        $pencatatanSkrining = PencatatanSkrining::with('detailPencatatanSkrining.pertanyaanSkrining.dataPertanyaan')->findOrFail($id);
        $totalSkor = $this->hitungSkorPPOK($pencatatanSkrining);
        return view('skrining.PPOK.show', compact('pencatatanSkrining', 'totalSkor'));
    }

    /**
     * Menampilkan form untuk mengedit skrining PPOK.
     */
    public function edit(string $id)
    {
        $pencatatanSkrining = PencatatanSkrining::with([
            'pendaftaran',
            'detailPencatatanSkrining' => function ($query) {
                $query->whereIn('id_pertanyaan_skrining', [5, 6, 7, 8, 9, 10, 11]);
            }
        ])->findOrFail($id);

        // Pastikan waktu_skrining adalah objek Carbon
        if (!($pencatatanSkrining->waktu_skrining instanceof \Carbon\Carbon)) {
            try {
                $pencatatanSkrining->waktu_skrining = \Carbon\Carbon::parse($pencatatanSkrining->waktu_skrining);
            } catch (\Exception $e) {
                $pencatatanSkrining->waktu_skrining = now();
            }
        }

        return view('skrining.ppok.edit', compact('pencatatanSkrining'));
    }

    /**
     * Memperbarui data skrining PPOK.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'waktu_skrining' => 'required|date',
            'pertanyaan' => 'required|array|min:7',
            'pertanyaan.5' => 'required|in:1,2',
            'pertanyaan.6' => 'required|numeric',
            'pertanyaan.7' => 'required|in:1,2,3,4',
            'pertanyaan.8' => 'required|in:1,2',
            'pertanyaan.9' => 'required|in:1,2',
            'pertanyaan.10' => 'required|in:1,2',
            'pertanyaan.11' => 'required|in:1,2',
        ]);

        DB::beginTransaction();

        try {
            $pencatatanSkrining = PencatatanSkrining::findOrFail($id);

            // Hitung total skor
            $totalSkor = $this->hitungSkorPPOKFromRequest($validated['pertanyaan']);

            // Update data utama
            $pencatatanSkrining->update([
                'waktu_skrining' => $validated['waktu_skrining'],
                'hasil_skrining' => ($totalSkor > 6) ? 1 : 2,
            ]);

            // Update detail pertanyaan
            foreach ($validated['pertanyaan'] as $idPertanyaan => $jawaban) {
                DetailPencatatanSkrining::updateOrCreate(
                    [
                        'id_pencatatan_skrining' => $pencatatanSkrining->id,
                        'id_pertanyaan_skrining' => $idPertanyaan,
                    ],
                    [
                        'hasil_skrining' => $jawaban,
                    ]
                );
            }

            DB::commit();
            return redirect()->route('skrining.ppok.index')->with('success', 'Data skrining PPOK berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error memperbarui skrining PPOK: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data skrining PPOK.
     */
    public function destroy(string $id)
    {
        $pencatatanSkrining = PencatatanSkrining::findOrFail($id);
        $pencatatanSkrining->delete();

        return redirect()->route('skrining.ppok.index')->with('success', 'Data skrining PPOK berhasil dihapus!');
    }
}
