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
                  Tambah Group
            </h1>
            <ol class="breadcrumb">
                  <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="<?= base_url(); ?>auth/group">Group</a></li>
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
                                          <?php echo form_open("auth/create_group"); ?>

                                          <div class="form-group">
                                                <label for=""> Nama </label>
                                                <input type="text" name="group_name" class="form-control">
                                                <div class="form-text text-danger"><?= form_error('group_name'); ?></div>

                                          </div>
                                          <div class="form-group">
                                                <label for=""> Deskripsi </label>
                                                <input type="text" name="description" class="form-control">
                                                <div class="form-text text-danger"><?= form_error('description'); ?></div>

                                          </div>

                                          <button type="submit" class="btn btn-primary">Simpan</button>
                                          <a href="<?= base_url('auth/group'); ?>" class="btn btn-info">Batal</a>

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