@extends('layouts.master')

@section('title', 'Edit Pemberian Vaksin')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Pemberian Vaksin</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data pemberian vaksin kepada peserta
                            posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pemberian.vaksin.index') }}"
                                    style="color: #d63384; font-size: 16px;">Pemberian Vaksin</a>
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

                                {{-- @dd($pemberianVaksin) --}}

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('pemberian.vaksin.update', $pemberianVaksin->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="no_pendaftaran" class="form-label">Nama Peserta <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="no_pendaftaran" disabled>
                                                @foreach ($pendaftarans as $pendaftaran)
                                                    <option value="{{ $pendaftaran->id }}"
                                                        {{ $pemberianVaksin->no_pendaftaran == $pendaftaran->id ? 'selected' : '' }}>
                                                        {{ $pendaftaran->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="waktu_pemberian" class="form-label">Waktu Pemberian <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="waktu_pemberian"
                                                value="{{ old('waktu_pemberian', \Carbon\Carbon::parse($pemberianVaksin->waktu_pemberian)->format('Y-m-d')) }}"
                                                required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Vaksin dan Dosis <span
                                                    class="text-danger">*</span></label>
                                            <div id="edit-vaksin-container">
                                                @php
                                                    $dataVaksinArray = json_decode($pemberianVaksin->data, true) ?? [];
                                                @endphp
                                                @foreach ($dataVaksinArray as $index => $data)
                                                    <div class="row g-2 mb-2 vaksin-group">
                                                        <div class="col-md-6">
                                                            <select class="form-select" name="id_vaksin[]" required>
                                                                <option value="" disabled>Pilih Vaksin</option>
                                                                @foreach ($dataVaksin as $vaksin)
                                                                    <option value="{{ $vaksin->id }}"
                                                                        {{ $data['id_vaksin'] == $vaksin->id ? 'selected' : '' }}>
                                                                        {{ $vaksin->nama }}
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
                                                                class="btn btn-sm btn-danger remove-vaksin">×</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-sm btn-secondary" id="edit-add-vaksin">+
                                                    Tambah Vaksin</button>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                                            <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan', $pemberianVaksin->keterangan) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pemberian.vaksin.index') }}"
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
            // Add vaksin field
            document.getElementById('edit-add-vaksin').addEventListener('click', function() {
                const container = document.getElementById('edit-vaksin-container');
                const newGroup = createVaksinGroup();
                container.appendChild(newGroup);
            });

            // Remove vaksin field
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-vaksin')) {
                    const groups = document.querySelectorAll('.vaksin-group');
                    if (groups.length > 1) {
                        e.target.closest('.vaksin-group').remove();
                    } else {
                        alert('Minimal harus ada satu vaksin');
                    }
                }
            });

            function createVaksinGroup() {
                const group = document.createElement('div');
                group.className = 'row g-2 mb-2 vaksin-group';
                group.innerHTML = `
                <div class="col-md-6">
                    <select class="form-select" name="id_vaksin[]" required>
                        <option value="" disabled selected>Pilih Vaksin</option>
                        @foreach ($dataVaksin as $vaksin)
                            <option value="{{ $vaksin->id }}">{{ $vaksin->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="dosis[]" placeholder="Masukkan Dosis" required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger remove-vaksin">×</button>
                </div>
            `;
                return group;
            }
        });
    </script>
@endpush
