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
            Detail Pengajuan
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url(); ?>pengajuan">Data Pengajuan</a></li>
            <li class="active">Detail</li>
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
                                <div class="col-lg-6">

                                    <div class="form-group row">
                                        <label for="" class="col-sm-4">Kode Pengajuan</label>
                                        <div class="col-sm-8">
                                            : <?= $row['kode_pengajuan']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4">Nama Pengajuan</label>
                                        <div class="col-sm-8">
                                            : <?= $row['pengajuan']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4">Jenis Pengajuan</label>
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
                                        <label for="" class="col-sm-4">Tanggal Pengajuan</label>
                                        <div class="col-sm-8">
                                            : <?= date('d-m-Y', strtotime($row['tgl_pengajuan'])); ?>
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
                                            : <?= ($row['status'] == 0) ? 'Menunggu' : ''; ?>
                                            <?= ($row['status'] == 2) ? 'Approved Staff' : ''; ?>
                                            <?= ($row['status'] == 3) ? 'Approved Kabag' : ''; ?>
                                            <?= ($row['status'] == 4) ? 'Approved Direktur' : ''; ?>
                                            <?= ($row['status'] == 5) ? 'Dikirim ke Vendor' : ''; ?>
                                            <?= ($row['status'] == 6) ? 'Ditolak Vendor' : ''; ?>
                                            <?= ($row['status'] == 7) ? 'Dikonfirmasi Vendor' : ''; ?>
                                            <?= ($row['status'] == 8) ? 'Disetujui Vendor' : ''; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">

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
                            <?php if ($row['status'] == 6) : ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="">Rekomendasi Vendor</label>
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
                                                        <?= number_format($cek[2]); ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                </div>
                            <?php elseif ($row['status'] == 7) : ?>
                                <div class="row">
                                    <div class="col-lg-12">
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
                                                        $total = 0;
                                                        foreach ($barang as $b) :
                                                            $total += $b['harga_vendor'];
                                                        ?>
                                                            <form action="<?= base_url('pengajuan_vendor/persediaan'); ?>" class="formPersediaan" method="post">
                                                                <tr>
                                                                    <td><?= $i++; ?></td>
                                                                    <td><?= $b['nama_barang']; ?></td>
                                                                    <td><?= $b['jenis_barang']; ?></td>
                                                                    <td><?= $b['qty_vendor']; ?></td>
                                                                    <td>Rp. <?= number_format($b['harga_vendor']); ?></td>
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
                                                <h4 id="total">Rp. <?= number_format($total); ?>
                                                </h4>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <?php if ($this->ion_auth->in_group('staff')) : ?>
                                    <?php if ($row['status'] == 0) : ?>
                                        <a href="<?= base_url('pengajuan/acc_staff/' . $row['id']); ?>" class="btn btn-success acc"><i class="fa fa-check"></i> Acc</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($this->ion_auth->in_group('kabag')) : ?>
                                    <?php if ($row['status'] == 2) : ?>
                                        <form action="<?= base_url('pengajuan/acc_kabag/' . $row['id']); ?>" method="post" id="formAccKabag">
                                            <input type="hidden" name="acc_kabag" id="acc_kabag">
                                            <button type="button" class="btn btn-success" onclick="konfirm()"><i class="fa fa-check"></i> Acc</button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($this->ion_auth->in_group('direktur')) : ?>
                                    <?php if ($row['status'] == 3) : ?>
                                        <form action="<?= base_url('pengajuan/acc_direktur/' . $row['id']); ?>" method="post" id="formAccDir">
                                            <input type="hidden" name="acc_direktur" id="acc_direktur">
                                            <button type="button" class="btn btn-success" onclick="acc()"><i class="fa fa-check"></i> Acc</button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <br>
                                <a href="<?= base_url(); ?>pengajuan/surat_unit/<?= $row['id']; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-print"></i> Surat</a>
                                <?php if ($row['status'] != 0 && $row['status'] != 2) : ?>
                                    <a href="<?= base_url(); ?>pengajuan/memo_kabag/<?= $row['id']; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-print"></i> Memo Kabag</a>
                                <?php endif; ?>
                                <?php if ($row['status'] != 0 && $row['status'] != 2 && $row['status'] != 3) : ?>
                                    <a href="<?= base_url(); ?>pengajuan/memo_direktur/<?= $row['id']; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-print"></i> Memo Direktur</a>
                                <?php endif; ?>
                                <a href="<?= base_url('pengajuan'); ?>" class="btn btn-info">Kembali</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Memanggil file footer.php -->
<?php $this->load->view("layout_backoffice/footer") ?>