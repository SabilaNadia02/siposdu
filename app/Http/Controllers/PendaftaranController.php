<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $query = Pendaftaran::orderBy('created_at', 'DESC');
    
        // Add search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%'.$search.'%')
                  ->orWhere('nik', 'like', '%'.$search.'%');
            });
        }
    
        // Filter by jenis_sasaran if provided
        if ($request->has('jenis_sasaran') && !empty($request->jenis_sasaran)) {
            $query->where('jenis_sasaran', $request->jenis_sasaran);
        }
    
        // Filter by posyandu if provided
        if ($request->has('posyandu_id') && !empty($request->posyandu_id)) {
            $query->where('posyandu_id', $request->posyandu_id);
        }
    
        // Paginate
        $pendaftaran = $query->paginate(10)->appends($request->query());
    
        // Count totals (without filters for accurate totals)
        $totalPendaftaran = Pendaftaran::count();
        $totalIbuHamil = Pendaftaran::where('jenis_sasaran', 1)->count();
        $totalBayiBalita = Pendaftaran::where('jenis_sasaran', 2)->count();
        $totalUsiaSuburLansia = Pendaftaran::where('jenis_sasaran', 3)->count();
    
        // Get posyandus data for filter dropdown
        $posyandus = DataPosyandu::all();
    
        return view('pendaftaran.index', compact(
            'pendaftaran',
            'totalPendaftaran',
            'totalIbuHamil',
            'totalBayiBalita',
            'totalUsiaSuburLansia',
            'posyandus',
        ));
    }
    // public function index(Request $request)
    // {
    //     $query = Pendaftaran::orderBy('created_at', 'DESC');

    //     // Paginate
    //     $pendaftaran = $query->paginate(10);

    //     // Count totals
    //     $totalPendaftaran = Pendaftaran::count();
    //     $totalIbuHamil = Pendaftaran::where('jenis_sasaran', 1)->count();
    //     $totalBayiBalita = Pendaftaran::where('jenis_sasaran', 2)->count();
    //     $totalUsiaSuburLansia = Pendaftaran::where('jenis_sasaran', 3)->count();

    //     // Get posyandus data
    //     $posyandus = DataPosyandu::all();

    //     return view('pendaftaran.index', compact(
    //         'pendaftaran',
    //         'totalPendaftaran',
    //         'totalIbuHamil',
    //         'totalBayiBalita',
    //         'totalUsiaSuburLansia',
    //         'posyandus',
    //     ));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'nullable|string',
            'nama' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:1,2',
            'status_perkawinan' => 'nullable|in:1,2',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'pendidikan' => 'nullable|in:1,2,3,4,5,6',
            'pekerjaan' => 'nullable|in:1,2,3,4,5,6,7',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|digits_between:10,13',
            'no_jkn' => 'nullable|digits_between:13,16',
            'jenis_sasaran' => 'nullable|in:1,2,3',
            'data_posyandu_id' => 'nullable|exists:data_posyandus,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $nama = ucwords(strtolower($request->nama));
        $tempatLahir = ucwords(strtolower($request->tempat_lahir));
        $alamat = preg_replace_callback('/\b(rt|rw)\b/i', function ($matches) {
            return strtoupper($matches[0]);
        }, ucwords(strtolower($request->alamat)));

        // Ambil ID terakhir dan tambahkan 1
        $lastId = Pendaftaran::max('id');
        $newId = $lastId ? $lastId + 1 : 1;

        // Tambahkan ID baru ke data request
        $data = $request->all();
        $data['id'] = $newId;
        $data['nama'] = $nama;
        $data['tempat_lahir'] = $tempatLahir;
        $data['alamat'] = $alamat;

        // Simpan data pendaftaran
        Pendaftaran::create($data);

        // Redirect kembali ke halaman index setelah berhasil menyimpan data
        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            abort(404);
        }

        return view('pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $posyandus = DataPosyandu::all();
        return view('pendaftaran.edit', compact('pendaftaran', 'posyandus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'nullable|string',
            'nama' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:1,2',
            'status_perkawinan' => 'nullable|in:1,2',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'pendidikan' => 'nullable|in:1,2,3,4,5,6',
            'pekerjaan' => 'nullable|in:1,2,3,4,5,6,7',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
            'no_jkn' => 'nullable|string|max:20',
            'jenis_sasaran' => 'nullable|in:1,2,3',
            'data_posyandu_id' => 'nullable|exists:data_posyandus,id',
        ]);

        // Cari data berdasarkan ID
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Proses nama, tempat lahir, dan alamat
        $nama = ucwords(strtolower($request->nama)); // Setiap kata pertama besar
        $tempatLahir = ucwords(strtolower($request->tempat_lahir)); // Setiap kata pertama besar
        $alamat = preg_replace_callback('/\b(rt|rw)\b/i', function ($matches) {
            return strtoupper($matches[0]); // Ubah "rt" dan "rw" menjadi huruf besar
        }, ucwords(strtolower($request->alamat))); // Setiap kata pertama besar, kecuali "rt" dan "rw"

        // Update data
        $pendaftaran->update([
            'nama' => $nama,
            'tempat_lahir' => $tempatLahir,
            'alamat' => $alamat,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_perkawinan' => $request->status_perkawinan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'no_hp' => $request->no_hp,
            'no_jkn' => $request->no_jkn,
            'jenis_sasaran' => $request->jenis_sasaran,
            'data_posyandu_id' => $request->data_posyandu_id,
        ]);

        // Redirect kembali ke halaman index setelah berhasil memperbarui data
        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        try {
            $pendaftaran->delete();
            return redirect()->route('pendaftaran.index')
                ->with('success', 'Data peserta berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
