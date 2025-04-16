<table class="table table-bordered">
    <thead>
        <tr>
            <th style="font-size: 15px; width: 160px">Waktu Rujukan <span
                    style="font-size: smaller; font-weight: normal;">(bulan/tanggal/tahun)</span>
            </th>
            <th style="font-size: 15px; width: 300px">Nama</th>
            <th style="font-size: 15px; width: 160px">Jenis Rujukan</th>
            <th style="font-size: 15px; width: 260px">Keterangan</th>
            <th style="font-size: 15px; width: 100px" class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rujukan as $item)
        <tr class="align-middle">
            <td>{{ $item->waktu_rujukan->format('m-d-Y') }}</td>
            <td>{{ $item->pendaftaran->nama ?? 'Data tidak tersedia' }}</td>
            <td>{{ $item->jenis_rujukan_text }}</td>
            <td>{{ $item->keterangan ?? '-' }}</td>
            <td class="text-center">
                {{-- <a href="{{ route('rujukan.show', $item->id) }}" class="btn btn-info" title="Lihat"
                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                    <i class="fas fa-eye"></i>
                </a> --}}
                <a href="{{ route('rujukan.edit', $item->id) }}" class="btn btn-warning" title="Edit"
                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('rujukan.destroy', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" title="Hapus"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada data rujukan</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $rujukan->links() }}
</div>
