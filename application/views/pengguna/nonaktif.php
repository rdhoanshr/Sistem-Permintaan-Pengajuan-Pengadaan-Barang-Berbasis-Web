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
                    <h1>Matikan Akun Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('auth/kelola_pengguna'); ?>">Kelola Pengguna</a> </li>
                        <li class="breadcrumb-item active">Aktivasi</li>
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
                        <?php echo form_open("auth/deactivate/" . $user->id); ?>
                        <p>
                            <label for="confirm">Ya</label>
                            <input type="radio" name="confirm" value="yes" checked="checked" />

                            <label for="confirm">Tidak</label>
                            <input type="radio" name="confirm" value="no" />
                        </p>
                        <?php echo form_hidden($csrf); ?>
                        <?php echo form_hidden(['id' => $user->id]); ?>
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