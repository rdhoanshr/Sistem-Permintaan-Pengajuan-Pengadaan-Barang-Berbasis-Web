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
                    <h1>Edit Level Akses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('auth/kelola_pengguna'); ?>">Kelola Pengguna</a> </li>
                        <li class="breadcrumb-item active">Edit Level</li>
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
                        <?php echo form_open(current_url()); ?>

                        <div class="form-group">
                            <label for=""><?php echo lang('edit_group_name_label', 'group_name'); ?></label>
                            <?php echo form_input($group_name); ?>
                            <div class="form-text text-danger"><?= form_error('group_name'); ?></div>
                        </div>
                        <div class="form-group">
                            <label for=""> <?php echo lang('edit_group_desc_label', 'description'); ?></label>
                            <?php echo form_input($group_description); ?>
                        </div>

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