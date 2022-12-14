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
                                    <th style="width: 10px !important;">#</th>
                                    <th scope=" col">No</th>
                                    <th scope="col">Nip</th>
                                    <th scope="col">Nik</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nama Sekolah</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="width: 10px !important;">#</th>
                                    <th scope=" col">No</th>
                                    <th scope="col">Nip</th>
                                    <th scope="col">Nik</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nama Sekolah</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1;
                                foreach ($result as  $val) : ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $no++ ?></td>
                                        <td><?= $val['nip'] ?? "" ?></td>
                                        <td><?= $val['nik'] ?? "" ?></td>
                                        <td><?= $val['nama'] ?? "" ?></td>
                                        <td><?= $val['nama_sekolah'] ?? "" ?></td>
                                        <td><?= $val['jabatan'] ?? "" ?></td>
                                        <td><?= $val['saldo'] ?? "" ?></td>
                                        <td><?= $val['alamat'] ?? "" ?></td>
                                        <td><?= $val['tanggal_masuk'] ?? "" ?></td>
                                        <td>
                                            <a href="<?= base_url('nasabah/detail/') . $val['id_nasabah']; ?>" class="btn btn-success btn-sm"><i class="fa fa-list"></i></a>
                                            <button type="button" data-id="<?= $val['id_nasabah']; ?>" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#m-crud">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm delete" data-id="<?= $val['id_nasabah']; ?>"><i class="fa fa-trash"></i></button>
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
        <form action="<?= base_url('nasabah/created'); ?>" method="post" id="formmodal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
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
                    </div>
                    <div class="row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Nip</label>
                                <input type="text" class="form-control form-control-sm" name="nip" id="nip" placeholder="Nip">
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Nik</label>
                                <input type="text" class="form-control form-control-sm" name="nik" id="nik" placeholder="Nik">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Nama">
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <input type="text" class="form-control form-control-sm" name="jabatan" id="jabatan" placeholder="Jabatan">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Saldo</label>
                                <input type="text" class="form-control form-control-sm" name="saldo" id="saldo" placeholder="Saldo">
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control form-control-sm" name="alamat" id="alamat" placeholder="Alamat">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="">Tanggal Masuk</label>
                                <input type="date" class="form-control form-control-sm" id="tanggal_masuk" name="tanggal_masuk" rows="3" placeholder="Tanggal Masuk">
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