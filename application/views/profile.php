<!-- Memanggil file header.php -->
<?php $this->load->view("layout_backoffice/header") ?>

<!-- Memanggil file navbar.php -->
<?php $this->load->view("layout_backoffice/navbar") ?>

<!-- Memanggil file sidebar.php -->
<?php $this->load->view("layout_backoffice/sidebar") ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Menampilkan notif flashdata -->
    <?php if ($this->session->flashdata('pesanbaik')) : ?>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesanbaik') ?>"></div>
    <?php endif; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Pengguna
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url(); ?>auth/pengguna">Pengguna</a></li>
            <li class="active">Edit</li>
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
                            <?php echo form_open_multipart(uri_string()); ?>

                            <div class="form-group">
                                <label for=""> Username </label>
                                <input type="text" name="username" class="form-control" value="<?= $user->username; ?>">
                                <div class="form-text text-danger"><?= form_error('username'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> Email </label>
                                <input type="email" name="email" class="form-control" value="<?= $user->email; ?>">
                                <div class="form-text text-danger"><?= form_error('email'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> Nama Lengkap </label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?= $user->nama_lengkap; ?>">
                                <div class="form-text text-danger"><?= form_error('nama_lengkap'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Isi Jika Password diganti">
                                <div class="form-text text-danger"><?= form_error('password'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> Ulangi Password </label>
                                <input type="password" name="password_confirm" class="form-control" placeholder="Isi Jika Password diganti">
                                <div class="form-text text-danger"><?= form_error('password_confirm'); ?></div>

                            </div>
                            <?php if ($this->ion_auth->in_group(1)) : ?>
                                <div class="form-group">
                                    <label for="">Unit</label>
                                    <select name="unit" id="unit" class="form-control js-example-basic-single" style="width: 100%;">
                                        <option selected disabled>-- Pilih Unit --</option>
                                        <?php foreach ($unit as $u) : ?>
                                            <option value="<?= $u['id_unit']; ?>" <?= ($user->id_unit == $u['id_unit']) ? 'Selected' : ''; ?>><?= $u['nama_unit']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <!-- <?php if ($this->ion_auth->in_group(5)) : ?>
                                <div class="form-group">
                                    <label for="">Vendor</label>
                                    <select name="vendor" id="vendor" class="form-control">
                                        <option selected disabled>-- Pilih Vendor --</option>
                                        <?php foreach ($vendor as $u) : ?>
                                            <option value="<?= $u['id']; ?>" <?= ($user->id_vendor == $u['id']) ? 'Selected' : ''; ?>><?= $u['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?> -->
                            <div class="form-group">
                                <label for=""> Upload Tanda Tangan </label> <br>
                                <?php if ($user->ttd != null) : ?>
                                    <img src="<?= base_url('uploads/ttd/') . $user->id . "/" . $user->ttd; ?>" width="100px" height="auto" alt="Tanda Tangan">
                                <?php endif; ?>
                                <input type="file" name="ttd" class="form-control" value="<?= $user->ttd; ?>">
                                <div class="form-text text-danger"><?= form_error('ttd'); ?></div>

                            </div>
                            <div class="form-group">
                                <label for=""> Upload Foto Profile </label> <br>
                                <?php if ($user->foto != null) : ?>
                                    <img src="<?= base_url('uploads/ttd/') . $user->id . "/" . $user->foto; ?>" width="100px" height="auto" alt="Foto Profile">
                                <?php endif; ?>
                                <input type="file" name="foto" class="form-control" value="<?= $user->foto; ?>">
                                <div class="form-text text-danger"><?= form_error('foto'); ?></div>

                            </div>

                            <?php echo form_hidden('id', $user->id); ?>
                            <?php echo form_hidden('ttd_lama', $user->ttd); ?>
                            <?php echo form_hidden('foto_lama', $user->foto); ?>
                            <?php echo form_hidden($csrf); ?>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url(); ?>" class="btn btn-info">Batal</a>
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