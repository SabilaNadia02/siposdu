<!-- Modal Kartu Peserta -->
<div class="modal fade" id="kartuPesertaModal" tabindex="-1" aria-labelledby="kartuPesertaLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 40%; transform: translateY(-50%); width: 500px; height: 500px;">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 class="modal-title fw-bold" id="kartuPesertaLabel">Kartu Peserta Posyandu</h5>
                <p style="font-size: 0.75rem; color: #777;">Harap bawa kartu ini setiap kali mengunjungi posyandu.</p>
                <h6>No Peserta:</h6>
                <h1 class="fw-bold">0001</h1>
                <hr>
                <table class="table table-borderless text-start">
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>: Sabila Nadia Islamia</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>: Dusun Jambean RT 2 / RW 1</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Lahir</strong></td>
                        <td>: {{ date('d-m-Y', strtotime($pendaftaran->tanggal_lahir)) }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="window.print()">Cetak</button>
            </div>
        </div>
    </div>
</div>
