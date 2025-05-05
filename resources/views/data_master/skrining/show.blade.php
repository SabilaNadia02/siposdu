@extends('layouts.master')

@section('title', 'Detail Skrining')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Detail Skrining</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini menampilkan detail data skrining peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('data-master.skrining.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #d63384;">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <strong>Nama Skrining:</strong>
                                <p style="font-size: 1rem;">{{ $dataskrining->nama_skrining ?? '-' }}</p>
                            </div>
                            <div class="col-md-12">
                                <strong>Keterangan:</strong>
                                <p style="font-size: 1rem;">{{ $dataskrining->keterangan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
