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
            Data Pengajuan
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Pengajuan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.box -->
                    <div class="box">
                        <?php if ($this->ion_auth->in_group('unit')) : ?>
                            <div class="box-header">
                                <a href="<?= base_url('pengajuan/tambah'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        <?php endif; ?>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengajuan</th>
                                            <th>Unit</th>
                                            <th>Jenis</th>
                                            <th>Tanggal</th>
                                            <th>Biaya</th>
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
                                                <td><?= $u['pengajuan']; ?></td>
                                                <td><?= $u['nama_unit']; ?></td>
                                                <td><?= $u['jenis_pengajuan']; ?></td>
                                                <td><?= $u['tgl_pengajuan']; ?></td>
                                                <td>Rp. <?= number_format($u['total']); ?></td>
                                                <td>
                                                    <?= ($u['status'] == 0) ? '<button type="button" class="btn btn-sm btn-white">Menunggu</button>' : ''; ?>
                                                    <?= ($u['status'] == 2) ? '<button type="button" class="btn btn-sm btn-primary">Approved Staff</button>' : ''; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('pengajuan/detail/') . $u['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                    <?php if ($u['status'] == 0) : ?>
                                                        <a href="<?= base_url('pengajuan/edit/') . $u['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                        <a href="<?= base_url('pengajuan/hapus/') . $u['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus Pengajuan ini ?')"><i class="fa fa-trash"></i></a>
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

<!-- Memanggil file footer.php -->
<?php $this->load->view("layout_backoffice/footer") ?>