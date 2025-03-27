<?php

namespace App\Http\Controllers;

use App\Models\DataSkrining;
use App\Models\DetailPencatatanSkrining;
use App\Models\PencatatanSkrining;
use App\Models\Pendaftaran;
use App\Models\PertanyaanSkrining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkriningTBCController extends Controller
{
    /**
     * Menampilkan daftar data skrining TBC.
     */
    public function index()
    {
        // Ambil data skrining TBC dari database
        $pendaftarans = Pendaftaran::whereIn('jenis_sasaran', [1, 3])->get();

        $skriningTBC = PencatatanSkrining::with(['dataSkrining', 'detailPencatatanSkrining.pertanyaanSkrining.dataPertanyaan'])
            ->whereHas('dataSkrining', function ($query) {
                $query->where('id', 1);
            })
            ->paginate(10); // Menambahkan pagination, tampilkan 10 data per halaman

        // Hitung total dengan gejala dan tanpa gejala
        $totalDenganGejala = 0;
        $totalTanpaGejala = 0;

        foreach ($skriningTBC as $skrining) {
            $jumlahYa = $skrining->detailPencatatanSkrining->where('hasil_skrining', 1)->count();
            if ($jumlahYa > 1) {
                $totalDenganGejala++;
            } else {
                $totalTanpaGejala++;
            }
        }

        return view('skrining.tbc.index', compact('pendaftarans', 'skriningTBC', 'totalDenganGejala', 'totalTanpaGejala'));
    }

    /**
     * Menampilkan form untuk menambahkan skrining TBC.
     */
    public function create()
    {
        // Ambil data pertanyaan skrining TBC
        $skriningTBC = DataSkrining::where('nama_skrining', 'TBC')->first();
        $pertanyaanSkrining = $skriningTBC->pertanyaanSkrining;

        return view('skrining.tbc.modal.tambah_skrining_tbc', compact('pertanyaanSkrining'));
    }

    /**
     * Menyimpan hasil skrining TBC.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'waktu_skrining' => 'required|date',
            'pertanyaan' => 'required|array|min:1',
            'pertanyaan.*' => 'required|in:1,2',
        ]);

        DB::beginTransaction();

        try {
            $skriningTBC = DataSkrining::where('nama_skrining', 'TBC')->firstOrFail();

            // Simpan data utama
            $pencatatan = PencatatanSkrining::create([
                'id_skrining' => $skriningTBC->id,
                'no_pendaftaran' => $validated['no_pendaftaran'],
                'waktu_skrining' => $validated['waktu_skrining'],
                'hasil_skrining' => (count(array_filter($validated['pertanyaan'], fn($j) => $j == 1)) > 1 ? 1 : 2),
            ]);

            // Debug: Tampilkan data sebelum menyimpan
            \Log::info('Data pertanyaan:', $validated['pertanyaan']);

            // Simpan detail pertanyaan
            foreach ($validated['pertanyaan'] as $idPertanyaan => $jawaban) {
                // Pastikan pertanyaan ada di database
                $pertanyaan = PertanyaanSkrining::find($idPertanyaan);

                if (!$pertanyaan) {
                    throw new \Exception("Pertanyaan dengan ID {$idPertanyaan} tidak ditemukan");
                }

                DetailPencatatanSkrining::create([
                    'id_pencatatan_skrining' => $pencatatan->id,
                    'id_pertanyaan_skrining' => $idPertanyaan,
                    'hasil_skrining' => $jawaban,
                ]);
            }

            DB::commit();

            return redirect()->route('skrining.tbc.index')
                ->with('success', 'Data berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error menyimpan skrining: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail skrining TBC.
     */
    public function show(string $id)
    {
        $pencatatanSkrining = PencatatanSkrining::with('detailPencatatanSkrining.pertanyaanSkrining.dataPertanyaan')->findOrFail($id);
        return view('skrining.tbc.show', compact('pencatatanSkrining'));
    }

    /**
     * Menampilkan form untuk mengedit skrining TBC.
     */
    public function edit(string $id)
    {
        $pencatatanSkrining = PencatatanSkrining::with('detailPencatatanSkrining.pertanyaanSkrining.dataPertanyaan')->findOrFail($id);
        $pertanyaanSkrining = $pencatatanSkrining->dataSkrining->pertanyaanSkrining;
        return view('skrining.tbc.edit', compact('pencatatanSkrining', 'pertanyaanSkrining'));
    }

    /**
     * Memperbarui data skrining TBC.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'waktu_skrining' => 'required|date',
            'pertanyaan' => 'required|array|min:1',
            'pertanyaan.*' => 'required|in:1,2', // 1 = Ya, 2 = Tidak
        ]);

        DB::beginTransaction();

        try {
            // Ambil data pencatatan skrining
            $pencatatanSkrining = PencatatanSkrining::findOrFail($id);

            // Hitung jumlah jawaban "Ya" (nilai 1)
            $jumlahYa = count(array_filter($validated['pertanyaan'], fn($j) => $j == 1));

            // Update data pencatatan skrining
            $pencatatanSkrining->update([
                'waktu_skrining' => $validated['waktu_skrining'],
                'hasil_skrining' => ($jumlahYa > 1) ? 1 : 2, // Gunakan angka seperti di store()
            ]);

            // Update detail jawaban pertanyaan
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

            return redirect()->route('skrining.tbc.index')
                ->with('success', 'Data skrining TBC berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error updating skrining: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data skrining TBC.
     */
    public function destroy(string $id)
    {
        $pencatatanSkrining = PencatatanSkrining::findOrFail($id);
        $pencatatanSkrining->delete();

        return redirect()->route('skrining.tbc.index')->with('success', 'Data skrining TBC berhasil dihapus.');
    }
}
