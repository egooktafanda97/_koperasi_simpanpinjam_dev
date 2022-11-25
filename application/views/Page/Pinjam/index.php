<section class="section">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div class="flex-space-between w-100">
                        <h5>Tabel Nasabah</h5>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#m-crud"><i class="fa fa-plus"></i> Tambah Data</button>
                        <!-- <button class="btn btn-info trigger"><i class="fa fa-plus"></i> Tambah Data</button> -->
                    </div>


                </div>
                <div class="card-body">
                    <div class="w-100">
                        <table id="example" class="display nowrap cell-border" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope=" col">No</th>

                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th scope=" col">No</th>

                                    <th scope="col">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1;
                                foreach ($result as $val) : ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $no++ ?></td>

                                        <td>
                                            <a href="<?= base_url('nasabah/detail/') . $val['id_nasabah']; ?>" class="btn btn-success btn-sm"><i class="fa fa-list"></i></a>
                                            <button type="button" data-id="<?= $val['id_pinjaman']; ?>" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#m-crud">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm delete" data-id="<?= $val['id_pinjaman']; ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="paging-container">
                        <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- [ sample-page ] end -->
<div class="modal fade" id="m-crud" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('Pinjam/created'); ?>" method="post" id="formmodal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pinjman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-1">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Sekolah</label>
                                <select class="form-control form-control-sm" name="id_sekolah" id="id_sekolah">
                                    <option value="">Pilih Sekolah</option>
                                    <?php foreach ($sekolah as $v) : ?>
                                        <option value="<?= $v['id_sekolah'] ?>"><?= $v['nama_sekolah'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nasabah</label>
                                <select class="form-control form-control-sm" name="id_nasabah" id="id_nasabah">
                                    <option value="">Pilih Nasabah</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jumlah Pinjam</label>
                                <input type="text" class="form-control form-control-sm decimal" value="0" name="jumlah_pinjam" id="jumlah_pinjam" placeholder="Jumlah Peminjaman max 30jt">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Lama Pinjam</label>
                                <select class="form-control form-control-sm" name="lama_pinjam" id="lama_pinjam">
                                    <option value="">Pilih Lama Pinjam</option>
                                    <option value="10">10 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                    <option value="18">18 Bulan</option>
                                    <option value="24">24 Bulan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mulai Pembayaran Pinjaman</label>
                                <input type="month" class="form-control form-control-sm" name="bulan_pembayaran" id="bulan_pembayaran" require>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Selesai Pembayaran Pinjaman</label>
                                <input type="month" class="form-control form-control-sm" id="bulan_pembayaran_selesai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Bunga (%)</label>
                                <input type="text" class="form-control form-control-sm" name="bunga" id="bunga" readonly require>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Total Bunga (potong pinjaman)</label>
                                <input type="text" class="form-control form-control-sm" name="jumlah_bunga" id="jumlah_bunga" readonly require>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Biaya Admin (1%)</label>
                                <input type="text" class="form-control form-control-sm" name="admin" id="admin" readonly require>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tagihan Bulanan</label>
                                <input type="text" class="form-control form-control-sm" name="jumlah_tagihan_bulanan" id="jumlah_tagihan_bulanan" require>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Total</label>
                                <input type="text" class="form-control form-control-sm" id="total" name="total" readonly require>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Surat Permohonan</label>
                                <input type="file" class="form-control form-control-sm" id="surat_permohonan" name="surat_permohonan">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
</div>