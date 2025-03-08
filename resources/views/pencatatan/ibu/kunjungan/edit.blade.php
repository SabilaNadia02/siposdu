@extends('layouts.master')

@section('title', 'Edit Kunjungan Ibu Hamil')

@section('content')
    <main class="app-main">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5>Edit Kunjungan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pencatatan.ibu.kunjungan.update', [$id, $kunjungan->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <label for="berat_badan">Berat Badan:</label>
                        <input type="text" name="berat_badan" value="{{ old('berat_badan', $kunjungan->berat_badan) }}">
                    
                        <label for="lingkar_lengan">Lingkar Lengan:</label>
                        <input type="text" name="lingkar_lengan" value="{{ old('lingkar_lengan', $kunjungan->lingkar_lengan) }}">
                    
                        <label for="tekanan_darah_sistolik">Tekanan Darah Sistolik:</label>
                        <input type="text" name="tekanan_darah_sistolik" value="{{ old('tekanan_darah_sistolik', $kunjungan->tekanan_darah_sistolik) }}">
                    
                        <label for="tekanan_darah_diastolik">Tekanan Darah Diastolik:</label>
                        <input type="text" name="tekanan_darah_diastolik" value="{{ old('tekanan_darah_diastolik', $kunjungan->tekanan_darah_diastolik) }}">
                    
                        <label for="keluhan">Keluhan:</label>
                        <textarea name="keluhan">{{ old('keluhan', $kunjungan->keluhan) }}</textarea>
                    
                        <label for="edukasi">Edukasi:</label>
                        <textarea name="edukasi">{{ old('edukasi', $kunjungan->edukasi) }}</textarea>
                    
                        <button type="submit">Update Kunjungan</button>
                    </form>                    
                </div>
            </div>
        </div>
    </main>
@endsection
