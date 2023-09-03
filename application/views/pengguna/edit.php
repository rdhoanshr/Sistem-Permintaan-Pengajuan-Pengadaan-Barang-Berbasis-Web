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
                    <h1>Edit Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('auth/kelola_pengguna'); ?>">Kelola Pengguna</a> </li>
                        <li class="breadcrumb-item active">Edit</li>
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
                        <?php echo form_open(uri_string()); ?>

                        <div class="form-group">
                            <label for="">Fullname:</label>
                            <?php echo form_input($fullname); ?>
                            <div class="form-text text-danger"><?= form_error('fullname'); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="">NIK:</label>
                            <?php echo form_input($nik); ?>
                            <div class="form-text text-danger"><?= form_error('nik'); ?></div>

                        </div>
                        <div class="form-group">
                            <label for=""> <?php echo lang('create_user_phone_label', 'phone'); ?> </label>
                            <?php echo form_input($phone); ?>
                            <div class="form-text text-danger"><?= form_error('phone'); ?></div>

                        </div>
                        <div class="form-group">
                            <label for=""> <?php echo lang('edit_user_password_label', 'password'); ?></label>
                            <?php echo form_input($password); ?>
                            <div class="form-text text-danger"><?= form_error('password'); ?></div>

                        </div>
                        <div class="form-group">
                            <label for=""> <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?> </label>
                            <?php echo form_input($password_confirm); ?>
                            <div class="form-text text-danger"><?= form_error('password_confirm'); ?></div>

                        </div>
                        <?php if ($this->ion_auth->is_admin()) : ?>
                            <div class="form-group">
                                <h6><?php echo lang('edit_user_groups_heading'); ?></h6>
                                <?php foreach ($groups as $group) : ?>
                                    <label class="checkbox">
                                        <input type="checkbox" class="form-control" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo (in_array($group, $currentGroups)) ? 'checked="checked"' : null; ?>>
                                        <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </label>
                                <?php endforeach ?>
                            </div>

                        <?php endif ?>

                        <?php echo form_hidden('id', $user->id); ?>
                        <?php echo form_hidden($csrf); ?>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('auth/kelola_pengguna'); ?>" class="btn btn-dark">Batal</a>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("layout_backend/footer.php") ?>