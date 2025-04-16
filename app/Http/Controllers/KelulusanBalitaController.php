<?php

// app/Http/Controllers/KelulusanBalitaController.php
namespace App\Http\Controllers;

use App\Models\PencatatanAwal;
use Illuminate\Http\Request;

class KelulusanBalitaController extends Controller
{
    public function index(Request $request)
    {
        // Get filter status from request, default to 'all'
        $statusFilter = $request->get('status', 'all');

        // Count active and graduated balitas (unchanged)
        $balitaAktif = PencatatanAwal::aktif()
            ->whereHas('pendaftaran', fn($q) => $q->where('jenis_sasaran', 2))
            ->count();

        $balitaLulus = PencatatanAwal::lulus()
            ->whereHas('pendaftaran', fn($q) => $q->where('jenis_sasaran', 2))
            ->count();

        // Base query with jenis_sasaran condition
        $query = PencatatanAwal::whereHas('pendaftaran', fn($q) => $q->where('jenis_sasaran', 2))
            ->with('pendaftaran');

        // Apply status filter
        switch ($statusFilter) {
            case 'active':
                $query->aktif();
                break;
            case 'graduated':
                $query->lulus();
                break;
            default:
                // 'all' shows both statuses (1 and 2)
                $query->whereIn('status_balita', [1, 2]);
        }

        $balitas = $query->get();

        return view('kelulusan_balita.index', [
            'balitaAktif' => $balitaAktif,
            'balitaLulus' => $balitaLulus,
            'balitas' => $balitas,
            'statusFilter' => $statusFilter
        ]);
    }

    public function update(Request $request, string $id)
    {
        $balita = PencatatanAwal::findOrFail($id);

        // Additional check to ensure only eligible balitas can be graduated
        if (!$balita->isEligibleForGraduation()) {
            return redirect()->route('kelulusan-balita.index')
                ->with('error', 'Balita belum memenuhi syarat kelulusan (usia minimal 5 tahun)');
        }

        $balita->update([
            'status_balita' => PencatatanAwal::STATUS_LULUS
        ]);

        return redirect()->route('kelulusan-balita.index')
            ->with('success', 'Status balita berhasil diubah menjadi Lulus');
    }
}
