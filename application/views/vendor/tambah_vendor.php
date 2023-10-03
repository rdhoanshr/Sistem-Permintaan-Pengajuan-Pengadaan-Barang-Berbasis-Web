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
            Tambah Vendor
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url(); ?>vvendor">Data Vendor</a></li>
            <li class="active">Tambah</li>
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
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for=""> Kode </label>
                                    <input type="text" name="kode" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('kode'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> Nama </label>
                                    <input type="text" name="nama" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('nama'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> Alamat </label>
                                    <input type="text" name="alamat" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('alamat'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> No Telp </label>
                                    <input type="number" name="no_telp" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('no_telp'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> Email </label>
                                    <input type="email" name="email" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('email'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> Situs Web </label>
                                    <input type="text" name="situs_web" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('situs_web'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> Catatan </label>
                                    <input type="text" name="catatan" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('catatan'); ?></div>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('vvendor'); ?>" class="btn btn-info">Batal</a>

                            </form>
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