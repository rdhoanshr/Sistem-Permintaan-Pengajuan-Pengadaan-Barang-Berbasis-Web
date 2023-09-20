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
            Data Pengadaan
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Pengadaaan</li>
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
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Surat</th>
                                            <th>Pengadaan</th>
                                            <th>Unit</th>
                                            <th>Jenis</th>
                                            <th>Tanggal</th>
                                            <th>Pagu Anggaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($pengajuan as $u) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $u['no_surat']; ?></td>
                                                <td><?= $u['pengajuan']; ?></td>
                                                <td><?= $u['nama_unit']; ?></td>
                                                <td><?= $u['jenis_pengajuan']; ?></td>
                                                <td><?= $u['tgl_persetujuan']; ?></td>
                                                <td>Rp. <?= number_format($u['total']); ?></td>
                                                <td>
                                                    <?= ($u['status'] == 5) ? '<button type="button" class="btn btn-sm btn-white">Menunggu</button>' : ''; ?>
                                                    <?= ($u['status'] == 6) ? '<button type="button" class="btn btn-sm btn-danger">Tolak</button>' : ''; ?>
                                                    <?= ($u['status'] == 7) ? '<button type="button" class="btn btn-sm btn-info">Setuju</button>' : ''; ?>
                                                    <?= ($u['status'] == 8) ? '<button type="button" class="btn btn-sm btn-info">Setuju</button>' : ''; ?>
                                                </td>
                                                <td>
                                                    <?php if ($u['status'] == 5) : ?>
                                                        <a href="<?= base_url('pengajuan_vendor/detail/') . $u['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-sign-in"></i></a>
                                                    <?php else : ?>
                                                        <a href="<?= base_url('pengajuan_vendor/detail/') . $u['id']; ?>" class="btn btn-sm btn-white"><i class="fa fa-eye"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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
<div class="modal fade" id="kirim_vendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Kirim Dokumen Pengadaaan Ke Vendor
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="modal_kirim" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Pilih Vendor</label>
                        <select name="vendor" class="form-control">
                            <option selected disabled>-- Pilih Vendor --</option>
                            <?php foreach ($vendor as $v) : ?>
                                <option value="<?= $v['id_vendor']; ?>"><?= $v['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Memanggil file footer.php -->
<?php $this->load->view("layout_backoffice/footer") ?>