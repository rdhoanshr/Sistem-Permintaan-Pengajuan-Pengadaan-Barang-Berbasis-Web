<!-- Memanggil file header.php -->
<?php $this->load->view("layout_backend/header.php") ?>

<!-- Memanggil file navbar.php -->
<?php $this->load->view("layout_backend/navbar.php") ?>

<!-- Memanggil file sidebar.php -->
<?php $this->load->view("layout_backend/sidebar.php") ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('auth/kelola_pengguna'); ?>">Kelola Pengguna</a> </li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <?php echo form_open("auth/create_user"); ?>

                        <div class="form-group">
                            <label for="">Fullname:</label>
                            <input type="text" name="fullname" class="form-control">
                            <div class="form-text text-danger"><?= form_error('fullname'); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="">NIK:</label>
                            <input type="text" name="nik" class="form-control">
                            <div class="form-text text-danger"><?= form_error('nik'); ?></div>
                        </div>
                        <?php
                        if ($identity_column !== 'email') {
                            echo '<p>';
                            echo lang('create_user_identity_label', 'identity');
                            echo '<br />';
                            echo form_error('identity');
                            echo form_input($identity);
                            echo '</p>';
                        }
                        ?>
                        <div class="form-group">
                            <label for=""> <?php echo lang('create_user_email_label', 'email'); ?> </label>
                            <input type="email" name="email" class="form-control">
                            <div class="form-text text-danger"><?= form_error('email'); ?></div>

                        </div>
                        <div class="form-group">
                            <label for=""> <?php echo lang('create_user_phone_label', 'phone'); ?> </label>
                            <input type="number" name="phone" class="form-control">
                            <div class="form-text text-danger"><?= form_error('phone'); ?></div>

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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('auth/kelola_pengguna'); ?>" class="btn btn-dark">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("layout_backend/footer.php") ?>