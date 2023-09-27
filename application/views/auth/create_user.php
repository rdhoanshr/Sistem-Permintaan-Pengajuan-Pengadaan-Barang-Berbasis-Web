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
        <div class="flash-data2" data-flashdata="<?= $this->session->flashdata('message') ?>"></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('pesanbaik')) : ?>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesanbaik') ?>"></div>
    <?php endif; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Pengguna
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url(); ?>auth/pengguna">Pengguna</a></li>
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
                            <?php echo form_open("auth/create_user"); ?>

                            <div class="form-group">
                                <label for=""> Username </label>
                                <input type="text" name="username" class="form-control">
                                <div class="form-text text-danger"><?= form_error('username'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> <?php echo lang('create_user_email_label', 'email'); ?> </label>
                                <input type="email" name="email" class="form-control">
                                <div class="form-text text-danger"><?= form_error('email'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> Nama Lengkap </label>
                                <input type="text" name="nama_lengkap" class="form-control">
                                <div class="form-text text-danger"><?= form_error('nama_lengkap'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> <?php echo lang('create_user_password_label', 'password'); ?></label>
                                <input type="password" name="password" class="form-control">
                                <div class="form-text text-danger"><?= form_error('password'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> </label>
                                <input type="password" name="password_confirm" class="form-control">
                                <div class="form-text text-danger"><?= form_error('password_confirm'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for="">Level</label>
                                <select name="group" id="group" class="form-control">
                                    <?php foreach ($groups as $g) : ?>
                                        <option value="<?= $g->id; ?>"><?= $g->name; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="form-group unit">
                                <label for="">Unit</label>
                                <select name="unit" id="unit" class="form-control">
                                    <option selected disabled>-- Pilih Unit --</option>
                                    <?php foreach ($unit as $u) : ?>
                                        <option value="<?= $u['id_unit']; ?>"><?= $u['nama_unit']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="form-group vendor">
                                <label for="">Vendor</label>
                                <select name="vendor" id="vendor" class="form-control">
                                    <option selected disabled>-- Pilih Vendor --</option>
                                    <?php foreach ($vendor as $u) : ?>
                                        <option value="<?= $u['id']; ?>"><?= $u['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('auth/pengguna'); ?>" class="btn btn-info">Batal</a>
                            <?php echo form_close(); ?>
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