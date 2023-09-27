<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="#">Nama</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="<?= base_url(); ?>assets/AdminLTE/#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="<?= base_url(); ?>assets/AdminLTE/#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="<?= base_url(); ?>assets/AdminLTE/javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url(); ?>assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url(); ?>assets/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/AdminLTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?= base_url() ?>assets/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= base_url() ?>assets/AdminLTE/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>assets/AdminLTE/plugins/select2/js/select2.full.min.js"></script>

<script src="<?= base_url(); ?>assets/AdminLTE/dist/js/adminlte.min.js"></script>



<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url(); ?>assets/AdminLTE/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>assets/AdminLTE/dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function() {
        $('.js-example-basic-single').select2();
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,

        })
        //Date range picker
        $('#reservation').daterangepicker()
        //Flashdata Notif 
        const flashdata = $('.flash-data').data('flashdata');
        const flashdata2 = $('.flash-data2').data('flashdata2');

        if (flashdata) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: flashdata
            })
        } else if (flashdata2) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: flashdata2
            })
        }
        $('body').on('click', '.logout', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah Anda Yakin Logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(url);
                }
            });
        });
        $('body').on('click', '.acc', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah Anda Yakin Accept?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(url);
                }
            });
        });
        $('body').on('click', '.hapus', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah Anda Yakin Menghapus?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(url);
                }
            });
        });
        //Date range picker
        $('#reservation').daterangepicker()
    });

    function konfirm() {
        (async () => {
            const {
                value: text
            } = await Swal.fire({
                title: 'Apakah Anda Yakin Accept?',
                icon: 'warning',
                text: 'Input Instruksi',
                input: 'textarea',
                inputAttributes: {
                    maxlength: 500
                },
                showCancelButton: true,
                confirmButtonText: 'Ya',
                reverseButtons: false,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Instruksi tidak boleh kosong!'
                    } else {
                        $('#acc_kabag').val(value)
                    }
                }
            })

            if (text) {
                var cttn = $('#acc_kabag').val();
                var url = $('#formAccKabag').attr('action');
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        catatan: cttn
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Di Acc!'
                            });
                            window.location.reload();
                        }
                        if (response.gagal) {
                            Swal.fire({
                                icon: 'error',
                                title: response.gagal
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" +
                            thrownError);
                    }
                });
            }
        })()
    }

    function acc() {
        (async () => {
            const {
                value: text
            } = await Swal.fire({
                title: 'Apakah Anda Yakin Accept?',
                icon: 'warning',
                text: 'Input Instruksi',
                input: 'textarea',
                inputAttributes: {
                    maxlength: 500
                },
                showCancelButton: true,
                confirmButtonText: 'Ya',
                reverseButtons: false,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Instruksi tidak boleh kosong!'
                    } else {
                        $('#acc_direktur').val(value)
                    }
                }
            })

            if (text) {
                var cttn = $('#acc_direktur').val();
                var url = $('#formAccDir').attr('action');
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        catatan: cttn
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Di Acc!'
                            });
                            window.location.reload();
                        }
                        if (response.gagal) {
                            Swal.fire({
                                icon: 'error',
                                title: response.gagal
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" +
                            thrownError);
                    }
                });
            }
        })()
    }
</script>
<script>
    // Input value unit
    if ($('#group').val() == 1) {
        $('.unit').show();
    } else {
        $('.unit').hide();
    }
    $('#group').change(function() {
        if ($('#group').val() == 1) {
            $('.unit').show();
        } else {
            $('.unit').hide();
        }
    });
    // Input value unit
    if ($('#group').val() == 5) {
        $('.vendor').show();
    } else {
        $('.vendor').hide();
    }
    $('#group').change(function() {
        if ($('#group').val() == 5) {
            $('.vendor').show();
        } else {
            $('.vendor').hide();
        }
    });
</script>
<script>
    $(document).ready(function() {
        <?php if ($this->ion_auth->in_group('unit')) : ?>
            databarang();
            detail_pengajuan();
        <?php elseif ($this->ion_auth->in_group('staff')) : ?>
            detail_pengajuan();
        <?php endif; ?>
    });

    function temp_barang() {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengajuan/temp_barang') ?>",
            data: {
                id: $('#id').val(),
                id_user: $('#id_user').val(),
                id_barang: $('#id_barang').val(),
                jumlah: $('#jumlah').val(),
                biaya: $('#biaya').val(),
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Ditambahkan!'
                    });
                    databarang();
                }
                if (response.gagal) {
                    Swal.fire({
                        icon: 'error',
                        title: response.gagal
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }


    function databarang() {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengajuan/data_barang'); ?>",
            data: {
                id_user: $('#id_user').val(),
                id: $('#id').val(),
            },
            dataType: "json",
            beforeSend: function(response) {
                $('.databarang').html('<i class="fas fa-spin fa-spinner"></i>')
            },
            success: function(response) {
                if (response.data) {
                    $('.databarang').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    function insert_detail() {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengajuan/insert_detail') ?>",
            data: {
                id: $('#id').val(),
                id_user: $('#id_user').val(),
                id_barang: $('#id_barang').val(),
                jumlah: $('#jumlah').val(),
                biaya: $('#biaya').val(),
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Ditambahkan!'
                    });
                    detail_pengajuan();
                }
                if (response.gagal) {
                    Swal.fire({
                        icon: 'error',
                        title: response.gagal
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    function detail_pengajuan() {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengajuan/detail_pengajuan'); ?>",
            data: {
                id: $('#id').val(),
            },
            dataType: "json",
            beforeSend: function(response) {
                $('.databarang').html('<i class="fas fa-spin fa-spinner"></i>')
            },
            success: function(response) {
                if (response.data) {
                    $('.databarang').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    function kirim_vendor(id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengajuan/modal_kirim'); ?>",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(response) {
                $('#modal_kirim').attr('action', response.sukses);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    $('.formPersediaan').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: $(this).serialize(this),
            dataType: "json",
            success: function(response) {
                if (response.gagal) {
                    alert(response.gagal);
                }
                if (response.data) {
                    alert(response.data);
                    $('#total').html('Rp. ' + response.total);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    });
</script>
</body>

</html>