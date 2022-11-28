<section class="section">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div class="flex-space-between w-100">
                        <h5>Tabel Simpan</h5>
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
                                    <th scope="col">Nasabah</th>
                                    <th scope="col">Saldo Awal</th>
                                    <th scope="col">Jumlah Simpan</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Biaya Admin</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th scope=" col">No</th>
                                    <th scope="col">Nasabah</th>
                                    <th scope="col">Saldo Awal</th>
                                    <th scope="col">Jumlah Simpan</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Biaya Admin</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
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
                                        <td><?= $val['nama'] ?? "" ?></td>
                                        <td><?= $val['saldo_awal'] ?? "" ?></td>
                                        <td><?= $val['jumlah_simpan'] ?? "" ?></td>
                                        <td><?= $val['saldo'] ?? "" ?></td>
                                        <td><?= $val['biaya_admin'] ?? "" ?></td>
                                        <td><?= $val['tanggal'] ?? "" ?></td>
                                        <td><?= $val['jam'] ?? "" ?></td>
                                        <td>
                                            <a href="<?= base_url('simpan/detail/') . $val['id_simpan']; ?>" class="btn btn-success btn-sm"><i class="fa fa-list"></i></a>
                                            <button type="button" data-id="<?= $val['id_simpan']; ?>" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#m-crud">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm delete" data-id="<?= $val['id_simpan']; ?>"><i class="fa fa-trash"></i></button>
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
    <div class="modal-dialog modal-md">
        <form action="<?= base_url('Simpan/created'); ?>" method="post" id="formmodal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                            <label for="">Nasabah</label>
                                <select class="form-control form-control-sm" id="id_nasabah" name="id_nasabah" require>
                                    <option value="">pilih</option>
                                    <?php foreach ($nasabah as $val) : ?>
                                        <option value="<?= $val['id_nasabah'] ?>"><?= $val['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Saldo Awal</label>
                                <input type="text" class="form-control form-control-sm" name="saldo_awal" id="saldo_awal" placeholder="Saldo Awal">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Jumah Simpan</label>
                                <input type="text" class="form-control form-control-sm" name="jumlah_simpan" id="jumlah_simpan" placeholder="Jumlah Simpan">
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Saldo</label>
                                <input type="text" class="form-control form-control-sm" name="saldo" id="saldo" placeholder="Saldo">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Biaya Admin</label>
                                <input type="text" class="form-control form-control-sm" id="biaya_admin" name="biaya_admin" placeholder="Biaya Admin">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal" placeholder="Tanggal">
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Jam</label>
                                <input type="time" class="form-control form-control-sm" name="jam" id="jam" placeholder="Jam">
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