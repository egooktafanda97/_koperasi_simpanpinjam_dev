<section class="section">
    <div class="mt-1 text-white mb-4">
        <strong>Detail Data Industri</strong>
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
                                        <th>Nama Pemilik Industri</th>
                                        <th><?= $val['nama_sekolah'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>No Hp Pemilik</th>
                                        <th><?= $val['jenjang'] ?? "" ?></th>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <th><?= $val['alamat'] ?? "" ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer mt-3 bg-secondary">
                    <a href="<?= base_url(); ?>sekolah" class="btn btn-primary float-right btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- [ sample-page ] end -->