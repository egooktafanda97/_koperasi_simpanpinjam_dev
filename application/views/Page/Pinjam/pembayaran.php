<section class="section">
    <div class="row">
        <div class="col-md-4">
            <form action="<?= base_url('Pinjam/created'); ?>" method="post" id="formmodal" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <div class="flex-space-between w-100">
                            <h5>Buat Pembayaran</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Cari Nasabah</label>
                            <select class="selectpicker form-control form-control-sm" data-live-search="true">
                                <option data-tokens="" value="">Pilih Nasabah</option>
                                <?php foreach ($pinjaman as $v) : ?>
                                    <option data-tokens="<?= $v['nama'] ?>" value="<?= $v['id_pinjaman'] ?>"><?= $v['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <!-- <div class="profile-card"></div> -->
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="form-table-pembayaran" data-toggle="tab" href="#insta">Data Pembayaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="form-pembayaran" data-toggle="tab" href="#face">Form Pembayaran</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content card-body">
                        <div id="insta" class="tab-pane form-table-pembayaran active">
                        <div class="w-100">
                        <table id="example" class="display nowrap cell-border" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">NASABAH</th>
                                    <th scope="col">KODE</th>
                                    <th scope="col">BULAN</th>
                                    <th scope="col">TAHUN</th>
                                    <th scope="col">JUMLAH TAGIHAN</th>
                                    <th scope="col">JUMLAH BAYAR</th>
                                    <th scope="col">SISA PINJAM</th>
                                    <th scope="col">TOTAL SISA PINJAM</th>
                                    <th scope="col">TUNGGAKAN</th>
                                    <th scope="col">DENDA</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">WAKTU</th>
                                    <th scope="col">STATUS</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">NASABAH</th>
                                    <th scope="col">KODE</th>
                                    <th scope="col">BULAN</th>
                                    <th scope="col">TAHUN</th>
                                    <th scope="col">JUMLAH TAGIHAN</th>
                                    <th scope="col">JUMLAH BAYAR</th>
                                    <th scope="col">SISA PINJAM</th>
                                    <th scope="col">TOTAL SISA PINJAM</th>
                                    <th scope="col">TUNGGAKAN</th>
                                    <th scope="col">DENDA</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">WAKTU</th>
                                    <th scope="col">STATUS</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1;
                                foreach ($tagihan as $val) : ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $no++ ?></td>
                                        <td><?= $val['nama'] ?? "" ?></td>
                                        <td><?= $val['kode'] ?? "" ?></td>
                                        <td><?= $val['bulan'] ?? "" ?></td>
                                        <td><?= $val['tahun'] ?? "" ?></td>
                                        <td><?= $val['jumlah_tagihan'] ?? "" ?></td>
                                        <td><?= $val['jumlah_bayar'] ?? "" ?></td>
                                        <td><?= $val['sisa_pinjam'] ?? "" ?></td>
                                        <td><?= $val['total_sisa_pinjam'] ?? "" ?></td>
                                        <td><?= $val['tunggakan'] ?? "" ?></td>
                                        <td><?= $val['denda'] ?? "" ?></td>
                                        <td><?= $val['tanggal'] ?? "" ?></td>
                                        <td><?= $val['jam'] ?? "" ?></td>
                                        <td><?= $val['status'] ?? "" ?></td>  
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                        </div>
                        <div id="face" class="tab-pane form-pembayaran">
                            <div id="input-form" class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tagihan Bulan</label>
                                        <input type="month" class="form-control form-control-sm" require>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jumlah Tagihan (Rp.)</label>
                                        <input type="text" name="jumlah_tagihan" class="form-control form-control-sm" require readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jumlah Bayar (Rp.)</label>
                                        <input type="text" name="jumlah_bayar" class="form-control form-control-sm" require>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sisa Pinjam (Rp.)</label>
                                        <input type="text" name="sisa_pinjam" class="form-control form-control-sm" require readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Total Sisa Pinjam (Rp.)</label>
                                        <input type="text" name="total_sisa_pinjam" class="form-control form-control-sm" require readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tunggakan (hari)</label>
                                        <input type="text" name="tunggakan" class="form-control form-control-sm" require value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Denda (Rp.)</label>
                                        <input type="text" name="denda" class="form-control form-control-sm" require value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="w-100">
                        <table id="example" class="display nowrap cell-border" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope=" col">No</th>
                                    <th scope="col">Nip</th>
                                    <th scope="col">Nik</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th scope=" col">No</th>
                                    <th scope="col">Nip</th>
                                    <th scope="col">Nik</th>
                                    <th scope="col">Nama</th>
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
                                foreach ($result as $val) : ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $no++ ?></td>
                                        <td><?= $val['nip'] ?? "" ?></td>
                                        <td><?= $val['nik'] ?? "" ?></td>
                                        <td><?= $val['nama'] ?? "" ?></td>
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
                    </div> -->

            </div>
        </div>
    </div>
    </div>
</section>