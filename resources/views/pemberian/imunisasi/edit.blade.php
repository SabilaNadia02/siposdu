@extends('layouts.master')

@section('title', 'Edit Pemberian Imunisasi')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <h3 class="card-title">Edit Pemberian Imunisasi</h3>
                        </div>
                        
                        <div class="card-body">
                            <form action="{{ route('pemberian.imunisasi.update', $pemberianImunisasi->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Peserta</label>
                                        <input type="text" class="form-control" 
                                            value="{{ $pemberianImunisasi->pendaftaran->nama }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Usia Saat Pemberian</label>
                                        <input type="text" class="form-control" 
                                            value="{{ Carbon::parse($pemberianImunisasi->pendaftaran->tanggal_lahir)
                                                ->diffInMonths(Carbon::parse($pemberianImunisasi->waktu_pemberian)) }} bulan" readonly>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="data_imunisasi_id" class="form-label">Jenis Imunisasi</label>
                                        <select class="form-select" id="data_imunisasi_id" name="data_imunisasi_id" required>
                                            @foreach($dataImunisasi as $imunisasi)
                                                <option value="{{ $imunisasi->id }}" 
                                                    {{ $imunisasi->id == $pemberianImunisasi->data_imunisasi_id ? 'selected' : '' }}>
                                                    {{ $imunisasi->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="waktu_pemberian" class="form-label">Tanggal Pemberian</label>
                                        <input type="date" class="form-control" id="waktu_pemberian" 
                                            name="waktu_pemberian" 
                                            value="{{ Carbon::parse($pemberianImunisasi->waktu_pemberian)->format('Y-m-d') }}" 
                                            required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2">
                                        {{ $pemberianImunisasi->keterangan }}
                                    </textarea>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('pemberian.imunisasi.index') }}" class="btn btn-secondary me-2">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
