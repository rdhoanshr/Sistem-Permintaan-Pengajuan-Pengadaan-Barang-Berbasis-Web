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
                                                    <?= ($u['status'] == 3) ? '<button type="button" class="btn btn-sm btn-success">Approved Kabag</button>' : ''; ?>
                                                    <?= ($u['status'] == 4) ? '<button type="button" class="btn btn-sm btn-success">Approved Direktur</button>' : ''; ?>
                                                    <?= ($u['status'] == 5) ? '<button type="button" class="btn btn-sm btn-info">Dikirim ke vendor</button>' : ''; ?>
                                                    <?= ($u['status'] == 6) ? '<button type="button" class="btn btn-sm btn-danger">Ditolak Vendor</button>' : ''; ?>
                                                    <?= ($u['status'] == 7) ? '<button type="button" class="btn btn-sm btn-info">DiKonfirmasi Vendor</button>' : ''; ?>
                                                    <?= ($u['status'] == 8) ? '<button type="button" class="btn btn-sm btn-info">Di Setujui Vendor</button>' : ''; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('pengajuan/detail/') . $u['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                    <?php if ($u['status'] == 0) : ?>
                                                        <a href="<?= base_url('pengajuan/edit/') . $u['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                        <a href="<?= base_url('pengajuan/hapus/') . $u['id']; ?>" class="btn btn-sm btn-danger hapus"><i class="fa fa-trash "></i></a>
                                                    <?php endif; ?>
                                                    <?php if ($u['status'] == 4 && $this->ion_auth->in_group('staff')) : ?>
                                                        <button type="button" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#kirim_vendor" onclick="kirim_vendor(<?= $u['id']; ?>)">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <?php if ($u['status'] == 7 || $u['status'] == 8 && $this->ion_auth->in_group('staff')) : ?>
                                                        <a href="<?= base_url('pengajuan/penyerahan/') . $u['id']; ?>" class="btn btn-sm btn-success" onclick="return confirm('Kirim Barang Ke Unit ?')"><i class="fa fa-check"></i></a>

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
                        <select name="vendor" class=" form-control js-example-basic-single">
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