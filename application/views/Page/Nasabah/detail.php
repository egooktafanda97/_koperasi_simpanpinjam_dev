<section class="section">
    <div class="mt-1 text-white mb-4">
        <strong>Detail Data Nasabah</strong>
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
                                        <th>Nip</th>
                                        <th><?= $val['nip'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Nik</th>
                                        <th><?= $val['nik'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <th><?= $val['nama'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Jabatan</th>
                                        <th><?= $val['jabatan'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Saldo</th>
                                        <th><?= $val['saldo'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Alamatk</th>
                                        <th><?= $val['alamat'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Masuki</th>
                                        <th><?= $val['tanggal_masuk'] ?? "" ?></th>
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