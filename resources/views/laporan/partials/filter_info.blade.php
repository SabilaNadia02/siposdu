{{-- resources/views/laporan/partials/filter_info.blade.php --}}
<div class="filter-info">
    <p><strong>Filter Informasi:</strong></p>
    <p>Periode: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</p>
    @if (isset($posyanduName) && $posyanduName != 'Semua Posyandu')
        <p>Posyandu: {{ $posyanduName }}</p>
    @endif
    @if (isset($jenisSasaran) && $jenisSasaran != 'Semua Jenis Sasaran')
        <p>Jenis Sasaran: {{ $jenisSasaran }}</p>
    @endif
    <p>Total Data: {{ count($data) }}</p>
</div>


