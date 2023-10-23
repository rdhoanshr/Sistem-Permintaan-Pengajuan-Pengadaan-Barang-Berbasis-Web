<?php $this->load->view('layout_backoffice/header'); ?>

<?php $this->load->view('layout_backoffice/navbar'); ?>

<?php $this->load->view('layout_backoffice/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <?php if (!$this->ion_auth->in_group(3) && !$this->ion_auth->in_group(4)) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $menunggu; ?></h3>

                            <p>Pengajuan Menunggu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <?php if ($menunggu == 0) : ?>
                            <a href="#" class="small-box-footer dashboard-kosong">More info <i class="fa fa-arrow-circle-right"></i></a>
                        <?php else : ?>
                            <a href="<?= base_url(); ?>pengajuan?param=menunggu" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $proses; ?></h3>

                        <p>Pengajuan Di Proses</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <?php if ($proses == 0) : ?>
                        <a href="#" class="small-box-footer dashboard-kosong">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <?php else : ?>
                        <a href="<?= base_url(); ?>pengajuan?param=proses" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $tinjau; ?></h3>

                        <p>Pengajuan Di Tinjau</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <?php if ($tinjau == 0) : ?>
                        <a href="#" class="small-box-footer dashboard-kosong">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <?php else : ?>
                        <a href="<?= base_url(); ?>pengajuan?param=tinjau" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $tolak; ?></h3>

                        <p>Pengajuan Di Tolak</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-ban"></i>
                    </div>
                    <?php if ($tolak == 0) : ?>
                        <a href="#" class="small-box-footer dashboard-kosong">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <?php else : ?>
                        <a href="<?= base_url(); ?>pengajuan?param=tolak" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3><?= $selesai; ?></h3>

                        <p>Pengajuan Selesai</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <?php if ($selesai == 0) : ?>
                        <a href="#" class="small-box-footer dashboard-kosong">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <?php else : ?>
                        <a href="<?= base_url(); ?>riwayat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('layout_backoffice/footer'); ?>