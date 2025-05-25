<?php

namespace App\Http\Controllers;

use App\Models\PencatatanAwal;
use Illuminate\Http\Request;

class PencatatanGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahIbu = PencatatanAwal::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 1);
        })->count();

        $jumlahBalita = PencatatanAwal::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 2);
        })->count();

        $jumlahLansia = PencatatanAwal::whereHas('pendaftaran', function ($query) {
            $query->where('jenis_sasaran', 3);
        })->count();

        return view('pencatatan.general.index', compact('jumlahIbu', 'jumlahBalita', 'jumlahLansia'));
    }
}
