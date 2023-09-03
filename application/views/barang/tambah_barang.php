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
            Data Barang
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url(); ?>barang">Data Barang</a></li>
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
                                    <label for=""> Nama Barang </label>
                                    <input type="text" name="nama_barang" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('nama_barang'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> Jenis Barang </label>
                                    <input type="text" name="jenis_barang" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('jenis_barang'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> Satuan </label>
                                    <input type="text" name="satuan" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('satuan'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label for=""> Keterangan </label>
                                    <input type="text" name="keterangan" class="form-control">
                                    <div class="form-text text-danger"><?= form_error('keterangan'); ?></div>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('barang'); ?>" class="btn btn-info">Batal</a>

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