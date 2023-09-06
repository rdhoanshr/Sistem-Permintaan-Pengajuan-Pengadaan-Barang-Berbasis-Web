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
            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (isset($message)) {
                        echo $message;
                    } else {
                        $this->session->flashdata('message');
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('pesanbaik')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('pesanbaik'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>auth/proses_register" method="post">
                <div class="form-group has-feedback">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-text text-danger"><?= form_error('email'); ?></div>
                <div class="form-group has-feedback">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-text text-danger"><?= form_error('username'); ?></div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-text text-danger"><?= form_error('password'); ?></div>
                <div class="form-group has-feedback">
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Ulangi Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-text text-danger"><?= form_error('password_confirm'); ?></div>
                <div class="form-group has-feedback">
                    <select name="group[]" id="group" class="form-control">
                        <option selected disabled>-- Daftar Sebagai --</option>
                        <option value="1">Unit</option>
                        <option value="5">Vendor</option>
                    </select>
                    <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
                </div>
                <div class="form-text text-danger"><?= form_error('group'); ?></div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>
            <p class="text-center">
                Sudah Memiliki Akun ? <br>
                <a href="<?= base_url(); ?>auth/login" class="text-center">Login</a>
            </p>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <?php $this->load->view('layout_auth/footer'); ?>