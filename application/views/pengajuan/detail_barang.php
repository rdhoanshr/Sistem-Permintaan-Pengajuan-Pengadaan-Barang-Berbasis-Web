<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($barang as $b) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $b['kode_barang']; ?> - <?= $b['nama_barang']; ?></td>
                    <td><?= $b['nama_jenisbarang']; ?></td>
                    <td><?= $b['jumlah']; ?></td>
                    <td><?= number_format($b['biaya'], 0, ',', '.'); ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger" onclick="hapus_detail(<?= $b['id']; ?>,<?= $b['id_pengajuan']; ?>)"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function hapus_detail(id, id_p) {
        Swal.fire({
            title: 'Apakah Anda Yakin Menghapus?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('pengajuan/hapus_detail'); ?>",
                    data: {
                        id: id,
                        id_p: id_p
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: response.sukses
                            });
                            detail_pengajuan();
                        }
                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: response.gagal
                            });
                        }
                        if (response.gagal) {
                            Swal.fire({
                                icon: 'error',
                                title: response.gagal
                            });
                            window.location.replace('pengajuan');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" +
                            thrownError);
                    }
                });
            }
        });
    }
</script>