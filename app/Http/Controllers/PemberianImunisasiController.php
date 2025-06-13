<?php

namespace App\Http\Controllers;

use App\Models\DataImunisasi;
use App\Models\PemberianImunisasi;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PemberianImunisasiController extends Controller
{
    public function index()
    {
        $totalPemberian = PemberianImunisasi::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 2);
        })->count();

        $totalLaki = PemberianImunisasi::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 2)
                ->where('jenis_kelamin', 1);
        })->count();

        $totalPerempuan = PemberianImunisasi::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 2)
                ->where('jenis_kelamin', 2);
        })->count();

        // Data imunisasi untuk tabel
        $pemberianImunisasi = PemberianImunisasi::with(['pendaftaran', 'imunisasi'])
            ->whereHas('pendaftaran', function ($query) {
                $query->where('jenis_sasaran', 2);
            })
            ->orderBy('waktu_pemberian', 'desc')
            ->paginate(100);

        return view('pemberian.imunisasi.index', compact(
            'totalPemberian',
            'totalLaki',
            'totalPerempuan',
            'pemberianImunisasi'
        ));
    }

    public function create()
    {
        $pendaftaran = Pendaftaran::where('jenis_sasaran', 2)
            ->orderBy('nama', 'asc')
            ->get();

        return view('pemberian.imunisasi.create', compact('pendaftaran'));
    }

    public function getImunisasiByUsia(Request $request)
    {
        try {
            $request->validate([
                'tanggal_lahir' => 'required|date',
                'waktu_pemberian' => 'required|date',
            ]);

            $tanggalLahir = Carbon::parse($request->tanggal_lahir);
            $waktuPemberian = Carbon::parse($request->waktu_pemberian);
            $usia = $tanggalLahir->diffInMonths($waktuPemberian);

            Log::info("Fetching imunisasi for age", [
                'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
                'waktu_pemberian' => $waktuPemberian->format('Y-m-d'),
                'usia_bulan' => $usia
            ]);

            $imunisasi = DataImunisasi::where('dari_umur', '<=', $usia)
                ->where('sampai_umur', '>=', $usia)
                ->orderBy('dari_umur')
                ->get();

            if ($imunisasi->isEmpty()) {
                Log::warning("No imunisasi found for age: " . $usia . " months");
            }

            return response()->json($imunisasi);

        } catch (Exception $e) {
            Log::error("Error in getImunisasiByUsia: " . $e->getMessage());
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info('Store Request Data:', $request->all());

        $validated = $request->validate([
            'no_pendaftaran' => 'required|exists:pendaftarans,id',
            'id_imunisasi' => 'required|exists:data_imunisasis,id',
            'waktu_pemberian' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Log::info('Validated Data:', $validated);

        try {
            $created = PemberianImunisasi::create([
                'no_pendaftaran' => $validated['no_pendaftaran'],
                'id_imunisasi' => $validated['id_imunisasi'],
                'waktu_pemberian' => $validated['waktu_pemberian'],
                'keterangan' => $validated['keterangan'] ? ucfirst(strtolower($validated['keterangan'])) : null,
            ]);

            Log::info('Record Created:', $created->toArray());

            return redirect()->route('pemberian.imunisasi.index')
                ->with('success', 'Data pemberian imunisasi berhasil disimpan');
        } catch (Exception $e) {
            Log::error('Store Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pemberianImunisasi = PemberianImunisasi::with(['pendaftaran', 'imunisasi'])->findOrFail($id);
        return view('pemberian.imunisasi.show', compact('pemberianImunisasi'));
    }

    public function edit($id)
    {
        $pemberianImunisasi = PemberianImunisasi::findOrFail($id);
        $pendaftaran = Pendaftaran::where('jenis_sasaran', 2)
            ->orderBy('nama', 'asc')
            ->get();

        // Get all imunisasi for initial display
        $dataImunisasi = DataImunisasi::all();

        return view('pemberian.imunisasi.edit', compact('pemberianImunisasi', 'pendaftaran', 'dataImunisasi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_imunisasi' => 'required|exists:data_imunisasis,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $pemberianImunisasi = PemberianImunisasi::findOrFail($id);

            $pemberianImunisasi->update([
                'id_imunisasi' => $validated['id_imunisasi'],
                'keterangan' => $validated['keterangan'] ? ucfirst(strtolower($validated['keterangan'])) : null,
            ]);

            return redirect()->route('pemberian.imunisasi.index')
                ->with('success', 'Data pemberian imunisasi berhasil diperbarui');

        } catch (Exception $e) {
            Log::error('Update Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $pemberianImunisasi = PemberianImunisasi::findOrFail($id);
        $pemberianImunisasi->delete();

        return redirect()->route('pemberian.imunisasi.index')
            ->with('success', 'Data pemberian imunisasi berhasil dihapus');
    }
}
