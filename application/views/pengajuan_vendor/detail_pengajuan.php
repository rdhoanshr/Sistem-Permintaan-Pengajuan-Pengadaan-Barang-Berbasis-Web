<!-- Memanggil file header.php -->
<?php $this->load->view("layout_backoffice/header") ?>

<!-- Memanggil file navbar.php -->
<?php $this->load->view("layout_backoffice/navbar") ?>

<!-- Memanggil file sidebar.php -->
<?php $this->load->view("layout_backoffice/sidebar") ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Menampilkan notif flashdata -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="flash-data2" data-flashdata2="<?= $this->session->flashdata('message') ?>"></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('pesanbaik')) : ?>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesanbaik') ?>"></div>
    <?php endif; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= ($row['status'] == 5) ? 'Konfirmasi Pengadaan' : 'Detail Pengadaan'; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url(); ?>pengajuan_vendor">Data Pengadaan</a></li>
            <li class="active"> <?= ($row['status'] == 5) ? 'Konfirmasi' : 'Detail'; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.box -->
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4">No Surat</label>
                                                <div class="col-sm-8">
                                                    : <?= $row['no_surat']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4">Pengadaan</label>
                                                <div class="col-sm-8">
                                                    : <?= $row['pengajuan']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4">Jenis Pengadaan</label>
                                                <div class="col-sm-8">
                                                    : <?= $row['jenis_pengajuan']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4">Unit</label>
                                                <div class="col-sm-8">
                                                    : <?= $row['nama_unit']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4">Tanggal</label>
                                                <div class="col-sm-8">
                                                    : <?= date('d-m-Y', strtotime($row['tgl_persetujuan'])); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4">Keterangan</label>
                                                <div class="col-sm-8">
                                                    : <?= $row['keterangan']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4">Status</label>
                                                <div class="col-sm-8">
                                                    : <?= ($row['status'] == 1) ? 'Selesai' : ''; ?>
                                                    <?= ($row['status'] == 5) ? 'Menunggu Konfirmasi' : ''; ?>
                                                    <?= ($row['status'] == 6) ? 'Ditolak' : ''; ?>
                                                    <?= ($row['status'] == 7) ? 'Setuju' : ''; ?>
                                                    <?= ($row['status'] == 8) ? 'Setuju' : ''; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="">Barang</label>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Jenis</th>
                                                            <th>Jumlah</th>
                                                            <th>Biaya</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($barang as $b) : ?>
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $b['nama_barang']; ?></td>
                                                                <td><?= $b['jenis_barang']; ?></td>
                                                                <td><?= $b['jumlah']; ?></td>
                                                                <td><?= number_format($b['biaya'], 0, ',', '.'); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Biaya</label>
                                                <br>
                                                <label for="">
                                                    <h4>Rp. <?= number_format($row['total'], 0, ',', '.'); ?></h4>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($row['status'] == 1 || $row['status'] == 8) : ?>
                                <div class="form-group">
                                    <a href="<?= base_url('pengajuan_vendor'); ?>" class="btn btn-info">Kembali</a>
                                </div>
                            <?php endif; ?>
                            <?php if ($row['status'] == 5) : ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="">Persediaan Vendor</label>
                                                </div>
                                                <div class="persediaan_vendor">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama</th>
                                                                    <th>Jenis</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Harga</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($barang as $b) : ?>
                                                                    <form action="<?= base_url('pengajuan_vendor/persediaan'); ?>" class="formPersediaan" method="post">
                                                                        <tr>
                                                                            <td>
                                                                                <?= $i++; ?>
                                                                                <input type="hidden" name="id" value="<?= $b['id']; ?>">
                                                                            </td>
                                                                            <td>
                                                                                <?= $b['nama_barang']; ?>
                                                                                <input type="hidden" name="nama_barang" value="<?= $b['nama_barang']; ?>">
                                                                            </td>
                                                                            <td>
                                                                                <?= $b['jenis_barang']; ?>
                                                                                <input type="hidden" name="jenis_barang" value="<?= $b['jenis_barang']; ?>">
                                                                            </td>
                                                                            <td><input type="number" class="form-control" value="<?= ($b['qty_vendor'] != null) ? $b['qty_vendor'] : '0'; ?>" name="qty" id="qty" min="1" max="<?= $b['jumlah']; ?>"></td>
                                                                            <td><input type="number" class="form-control" name="harga" value="<?= ($b['harga_vendor'] != null) ? $b['harga_vendor'] : '0'; ?>" id="harga" min="1" max="<?= $b['biaya']; ?>"></td>
                                                                            <td>
                                                                                <button type="submit" class="btn btn-sm btn-primary" id="ok">OK</button>
                                                                            </td>
                                                                        </tr>
                                                                    </form>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class=" form-group">
                                                    <label for="">Total Harga</label>
                                                    <br>
                                                    <label for="">
                                                        <h4 id="total">Rp. <?= $total; ?>
                                                        </h4>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($row['status'] == 6) : ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box">
                                            <div class="box-body">
                                                <label for="">Rekomendasi</label>
                                                <table class="table">
                                                    <tr>
                                                        <td>No</td>
                                                        <td>Nama Barang</td>
                                                        <td>Qty</td>
                                                        <td>Harga</td>
                                                    </tr>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($rekom as $r) : ?>
                                                        <?php
                                                        $cek = explode(',', $r);
                                                        if (sizeof($cek) < 3) {
                                                            $cek[0] = null;
                                                            $cek[1] = null;
                                                            $cek[2] = 0;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $cek[0]; ?></td>
                                                            <td><?= $cek[1]; ?></td>
                                                            <td>
                                                                <?= number_format($cek[2], 0, ',', '.'); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="<?= base_url('pengajuan_vendor'); ?>" class="btn btn-info">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($row['status'] == 7) : ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="">Persediaan Vendor</label>
                                                </div>
                                                <div class="persediaan_vendor">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama</th>
                                                                    <th>Jenis</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($barang as $b) : ?>
                                                                    <form action="<?= base_url('pengajuan_vendor/persediaan'); ?>" class="formPersediaan" method="post">
                                                                        <tr>
                                                                            <td><?= $i++; ?></td>
                                                                            <td><?= $b['nama_barang']; ?></td>
                                                                            <td><?= $b['jenis_barang']; ?></td>
                                                                            <td><?= $b['qty_vendor']; ?></td>
                                                                            <td>Rp. <?= number_format($b['harga_vendor'], 0, ',', '.'); ?></td>
                                                                        </tr>
                                                                    </form>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class=" form-group">
                                                    <label for="">Total Harga</label>
                                                    <br>
                                                    <label for="">
                                                        <h4 id="total">Rp. <?= $total; ?>
                                                        </h4>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="<?= base_url('pengajuan_vendor'); ?>" class="btn btn-info">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($row['status'] == 5) : ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <a href="<?= base_url('pengajuan_vendor/acc/' . $row['id']); ?>" class="btn btn-success acc"><i class="fa fa-check"></i> Acc</a>
                                            <a href="<?= base_url('pengajuan_vendor/konfirmasi/' . $row['id']); ?>" class="btn btn-primary acc"><i class="fa fa-check"></i> Konfirmasi</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-ban"></i> Tolak</button>
                                            <a href="<?= base_url('pengajuan_vendor'); ?>" class="btn btn-info">Kembali</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <small class="text-danger">
                                            <ul>
                                                <li>Tekan Tombol Acc Apabila Setuju dan Tidak Ada Perubahan dari Penawaran Pengadaan Barang Di Atas</li>
                                                <li>Tekan Tombol Konfirmasi Apabila Setuju dan Terdapat Perubahan dari Penawaran Pengadaan Barang Di Atas</li>
                                                <li>Tekan Tombol Tolak Apabila Persediaan Barang Tidak Ada Atau Harga lebih dari Biaya</li>
                                            </ul>
                                        </small>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Rekomendasi
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url(); ?>pengajuan_vendor/tolak/<?= $row['id']; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Rekomendasi Ketersediaan Barang</label> <br>
                        <small class="text-danger">*Masukan Nama Barang, Jumlah, dan Total Harga yang tersedia</small>
                        <textarea name="rekomendasi" cols="30" rows="10" class="form-control" placeholder="Contoh : Kasur, 1, 200000;"></textarea>
                        <small class="text-danger">*pisahkan item dengan tanda (;)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Memanggil file footer.php -->
<?php $this->load->view("layout_backoffice/footer") ?>