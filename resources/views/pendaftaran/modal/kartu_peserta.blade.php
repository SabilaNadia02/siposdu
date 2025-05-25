<!-- Modal Kartu Peserta -->
<div class="modal fade" id="kartuPesertaModal" tabindex="-1" aria-labelledby="kartuPesertaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-body text-center" id="printArea">
                <h5 class="modal-title fw-bold">Kartu Peserta Posyandu</h5>
                <p style="font-size: 0.75rem; color: #777;">Harap bawa kartu ini setiap kali mengunjungi posyandu.</p>

                <h6>No Peserta:</h6>
                <h1 class="fw-bold">{{ str_pad($pendaftaran->id, 4, '0', STR_PAD_LEFT) }}</h1>
                <hr>

                <table class="table table-borderless text-start mx-auto">
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>: {{ $pendaftaran->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Lahir</strong></td>
                        <td>: {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->translatedFormat('m-d-Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>: {{ $pendaftaran->alamat }}</td>
                    </tr>
                    <tr>
                        <td><strong>Posyandu</strong></td>
                        <td>: {{ $pendaftaran->posyandus->nama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer d-print-none"> <!-- Menyembunyikan button saat cetak -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                {{-- <button type="button" class="btn text-light" style="background-color: #d63384;" onclick="printModal()"> --}}
                    {{-- Cetak --}}
                {{-- </button> --}}
            </div>
        </div>
    </div>
</div>

<!-- CSS untuk Cetak -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #printArea,
        #printArea * {
            visibility: visible;
        }

        #printArea {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            padding: 20px;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        .d-print-none {
            display: none !important;
        }
    }
</style>

<!-- Script untuk Cetak -->
<script>
    function printModal() {
        let printContents = document.getElementById('printArea').innerHTML;
        let originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload(); 
    }
</script>
