<section class="section">
    <div class="mt-1 text-white mb-4">
        <strong>Detail Data Simpan</strong>
    </div>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-6">
            <div class="card">

                <div class="card-header bg-primary text-white">
                    <h5>Detail Data</h5>
                </div>
                <div class="card-body justify-content">
                    <div class="row">
                        <div class="col-12">

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nasabah</th>
                                        <th><?= $val['nama'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Saldo Awal</th>
                                        <th><?= $val['saldo_awal'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Simpan</th>
                                        <th><?= $val['jumlah_simpan'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Saldo</th>
                                        <th><?= $val['saldo'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Biaya Admin</th>
                                        <th><?= $val['biaya_admin'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th><?= $val['tanggal'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Jam</th>
                                        <th><?= $val['jam'] ?? "" ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer mt-3 bg-secondary">
                    <a href="<?= base_url(); ?>nasabah" class="btn btn-primary float-right btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- [ sample-page ] end -->