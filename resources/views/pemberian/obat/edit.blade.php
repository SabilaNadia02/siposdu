@extends('layouts.master')

@section('title', 'Edit Pemberian Obat')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Pemberian Obat</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data pemberian obat kepada peserta
                            posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pemberian.obat.index') }}"
                                    style="color: #d63384; font-size: 16px;">Pemberian Obat</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8" style="border-radius: 0px">
                        <div class="card" style="border-top: 3px solid #d63384; border-radius: 0px">
                            <div class="card-body" style="border-radius: 0px">

                                {{-- @dd($pemberianObat) --}}

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('pemberian.obat.update', $pemberianObat->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="no_pendaftaran" class="form-label">Nama Peserta <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="no_pendaftaran" disabled>
                                                @foreach ($pendaftarans as $pendaftaran)
                                                    <option value="{{ $pendaftaran->id }}"
                                                        {{ $pemberianObat->no_pendaftaran == $pendaftaran->id ? 'selected' : '' }}>
                                                        {{ $pendaftaran->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="waktu_pemberian" class="form-label">Waktu Pemberian <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="waktu_pemberian"
                                                value="{{ old('waktu_pemberian', \Carbon\Carbon::parse($pemberianObat->waktu_pemberian)->format('Y-m-d')) }}"
                                                required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Obat dan Dosis <span
                                                    class="text-danger">*</span></label>
                                            <div id="edit-obat-container">
                                                @php
                                                    $dataObatArray = json_decode($pemberianObat->data, true) ?? [];
                                                @endphp
                                                @foreach ($dataObatArray as $index => $data)
                                                    <div class="row g-2 mb-2 obat-group">
                                                        <div class="col-md-6">
                                                            <select class="form-select" name="id_obat[]" required>
                                                                <option value="" disabled>Pilih Obat</option>
                                                                @foreach ($dataObat as $obat)
                                                                    <option value="{{ $obat->id }}"
                                                                        {{ $data['id_obat'] == $obat->id ? 'selected' : '' }}>
                                                                        {{ $obat->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" name="dosis[]"
                                                                placeholder="Masukkan Dosis"
                                                                value="{{ $data['dosis'] ?? '' }}" required>
                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-end">
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger remove-obat">×</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-sm btn-secondary" id="edit-add-obat">+
                                                    Tambah Obat</button>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                                            <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan', $pemberianObat->keterangan) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pemberian.obat.index') }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light"
                                            style="background-color: #d63384;">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add obat field
            document.getElementById('edit-add-obat').addEventListener('click', function() {
                const container = document.getElementById('edit-obat-container');
                const newGroup = createObatGroup();
                container.appendChild(newGroup);
            });

            // Remove obat field
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-obat')) {
                    const groups = document.querySelectorAll('.obat-group');
                    if (groups.length > 1) {
                        e.target.closest('.obat-group').remove();
                    } else {
                        alert('Minimal harus ada satu obat');
                    }
                }
            });

            function createObatGroup() {
                const group = document.createElement('div');
                group.className = 'row g-2 mb-2 obat-group';
                group.innerHTML = `
                <div class="col-md-6">
                    <select class="form-select" name="id_obat[]" required>
                        <option value="" disabled selected>Pilih Obat</option>
                        @foreach ($dataObat as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="dosis[]" placeholder="Masukkan Dosis" required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger remove-obat">×</button>
                </div>
            `;
                return group;
            }
        });
    </script>
@endpush
