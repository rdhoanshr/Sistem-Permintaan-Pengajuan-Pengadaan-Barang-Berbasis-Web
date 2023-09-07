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
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('pesanbaik')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('pesanbaik'); ?>
        </div>
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
                                    <div class="box">
                                        <div class="box-body">

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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                        </div>

                        <div class="form-group">
                            <?php if ($this->ion_auth->in_group('staff')) : ?>
                                <?php if ($row['status'] == 0) : ?>
                                    <a href="<?= base_url('pengajuan/acc_staff/' . $row['id']); ?>" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin Acc Pengajuan ini ?')"><i class="fa fa-check"></i> Acc</a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <a href="<?= base_url('pengajuan'); ?>" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Memanggil file footer.php -->
<?php $this->load->view("layout_backoffice/footer") ?>