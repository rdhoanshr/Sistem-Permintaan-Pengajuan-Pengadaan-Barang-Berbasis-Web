<?php $this->load->view('layout_auth/header'); ?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!-- <a href="<?= base_url(); ?>assets/AdminLTE/index2.html"><b>Admin</b>LTE</a> -->
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">
                <img src="<?= base_url(); ?>assets/img/logorsisa.png" alt="Logo" class="img-fluid" width="200px" height="auto">
            </p>
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
            <form action="<?= base_url(); ?>auth/login" method="post">
                <div class="form-group has-feedback">
                    <input type="text" id="identity" name="identity" class="form-control" placeholder="Email / Username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-text text-danger"><?= form_error('identity'); ?></div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-text text-danger"><?= form_error('password'); ?></div>
                <p class="text-right">
                    <a href="<?= base_url(); ?>auth/forgot">Lupa Password</a>
                </p>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-block btn-flat">Sign</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>
            <p class="text-center ">
                Belum Memiliki Akun ? <br>
                <a href="<?= base_url(); ?>auth/register" class="text-center">Daftar</a>
            </p>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <?php $this->load->view('layout_auth/footer'); ?>