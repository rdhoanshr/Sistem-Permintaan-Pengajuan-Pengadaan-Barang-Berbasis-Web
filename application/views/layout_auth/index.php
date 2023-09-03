<?php $this->load->view('layout_auth/header'); ?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!-- <a href="<?= base_url(); ?>assets/AdminLTE/index2.html"><b>Admin</b>LTE</a> -->
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">
                <img src="<?= base_url(); ?>assets/img/logo.png" alt="Logo" class="img-fluid" width="200px" height="auto">
            </p>

            <form action="<?= base_url(); ?>assets/AdminLTE/index2.html" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email / Username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <p class="text-right">
                    <a href="#">Lupa Password / Username</a>
                </p>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <br>
            <p class="text-center">
                Belum Memiliki Akun ? <br>
                <a href="register.html" class="text-center">Daftar</a>
            </p>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <?php $this->load->view('layout_auth/footer'); ?>