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
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('pesanbaik')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('pesanbaik'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Konfirmasi Pengadaan
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url(); ?>pengajuan_vendor">Data Pengadaan</a></li>
            <li class="active">Konfirmasi</li>
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
                                                    : <?= ($row['status'] == 5) ? 'Menunggu Konfirmasi' : ''; ?>
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
                                                                <td><?= number_format($b['biaya']); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Biaya</label>
                                                <br>
                                                <label for="">
                                                    <h4>Rp. <?= number_format($row['total']); ?></h4>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="">Persediaan Vendor</label>
                                            </div>
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
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $b['nama_barang']; ?></td>
                                                                <td><?= $b['jenis_barang']; ?></td>
                                                                <td><input type="number" class="form-control" name="qty" min="1" max="<?= $b['jumlah']; ?>"></td>
                                                                <td><input type="number" class="form-control" name="harga" min="1" max="<?= $b['biaya']; ?>"></td>
                                                                <td><button type="button" class="btn btn-sm btn-primary">OK</button></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Biaya</label>
                                                <br>
                                                <label for="">
                                                    <h4>Rp. <?= number_format($row['total']); ?></h4>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <a href="<?= base_url('pengajuan/acc_direktur/' . $row['id']); ?>" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin Acc Pengajuan ini ?')"><i class="fa fa-check"></i> Acc</a>
                                        <a href="<?= base_url('pengajuan/acc_direktur/' . $row['id']); ?>" class="btn btn-primary" onclick="return confirm('Apakah Anda Yakin Acc Pengajuan ini ?')"><i class="fa fa-check"></i> Konfirmasi</a>
                                        <a href="<?= base_url('pengajuan/acc_direktur/' . $row['id']); ?>" class="btn btn-danger"><i class="fa fa-ban"></i> Tolak</a>
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

<!-- Memanggil file footer.php -->
<?php $this->load->view("layout_backoffice/footer") ?>