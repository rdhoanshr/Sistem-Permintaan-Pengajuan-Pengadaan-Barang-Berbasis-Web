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
            Kelola Pengguna
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Kelola Pengguna</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <a href="<?= base_url('auth/create_user'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                            <!-- <h3 class="box-title">DataTable with default features</h3> -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Group</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php foreach ($user->groups as $group) : ?>
                                                        <?php if ($group->name == 'admin') : ?>
                                                            <button class="btn btn-sm btn-primary"><?= $group->name; ?></button>
                                                        <?php else : ?>
                                                            <button class="btn btn-sm btn-info"><?= $group->name; ?></button>
                                                        <?php endif; ?>
                                                    <?php endforeach ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($user->active) : ?>
                                                        <button class="btn btn-sm btn-success">Aktif</button>
                                                    <?php else : ?>
                                                        <button class="btn btn-sm btn-warning btn-aktif">Non Aktif</button>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('auth/edit_user/') . $user->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= base_url('auth/delete_user/') . $user->id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus Pengguna ini ?')"><i class="fa fa-trash"></i></a>
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

<!-- Memanggil file footer.php -->
<?php $this->load->view("layout_backoffice/footer") ?>