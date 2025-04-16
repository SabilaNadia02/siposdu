@extends('layouts.master')

@section('title', 'Detail Pemberian Imunisasi')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title">Detail Pemberian Imunisasi</h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row">
                                        <dt class="col-sm-4">Nama Peserta</dt>
                                        <dd class="col-sm-8">{{ $pemberianImunisasi->pendaftaran->nama }}</dd>
                                        
                                        <dt class="col-sm-4">Jenis Sasaran</dt>
                                        <dd class="col-sm-8">{{ ucfirst($pemberianImunisasi->pendaftaran->jenis_sasaran) }}</dd>
                                        
                                        <dt class="col-sm-4">Usia Saat Imunisasi</dt>
                                        <dd class="col-sm-8">
                                            @php
                                                $usiaBulan = Carbon::parse($pemberianImunisasi->pendaftaran->tanggal_lahir)
                                                    ->diffInMonths(Carbon::parse($pemberianImunisasi->waktu_pemberian));
                                            @endphp
                                            {{ $usiaBulan }} bulan
                                        </dd>
                                    </dl>
                                </div>
                                
                                <div class="col-md-6">
                                    <dl class="row">
                                        <dt class="col-sm-4">Jenis Imunisasi</dt>
                                        <dd class="col-sm-8">{{ $pemberianImunisasi->imunisasi->nama }}</dd>
                                        
                                        <dt class="col-sm-4">Tanggal Pemberian</dt>
                                        <dd class="col-sm-8">
                                            {{ Carbon::parse($pemberianImunisasi->waktu_pemberian)->format('d/m/Y') }}
                                        </dd>
                                        
                                        <dt class="col-sm-4">Keterangan</dt>
                                        <dd class="col-sm-8">
                                            {{ $pemberianImunisasi->keterangan ?? '-' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <a href="{{ route('pemberian.imunisasi.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
