<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- <li class="header">MAIN NAVIGATION</li> -->
            <li>
                <a href="<?= base_url(); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Pengajuan</span>
                    <span class="pull-right-container">
                    </span>
                </a>

            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th"></i> <span>Riwayat</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?= base_url(); ?>assets/AdminLTE/#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url(); ?>auth/pengguna"><i class="fa fa-circle-o"></i> Pengguna</a></li>
                    <li><a href="<?= base_url(); ?>barang"><i class="fa fa-circle-o"></i> Barang</a></li>
                    <li><a href="<?= base_url(); ?>unit"><i class="fa fa-circle-o"></i> Unit</a></li>
                    <li><a href="<?= base_url(); ?>vendor"><i class="fa fa-circle-o"></i> Vendor</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Profile</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li><a href="<?= base_url(); ?>auth/logout"><i class="fa fa-book"></i> <span>Logout</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>