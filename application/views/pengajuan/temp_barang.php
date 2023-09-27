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
                    <td><?= $b['nama_barang']; ?></td>
                    <td><?= $b['jenis_barang']; ?></td>
                    <td><?= $b['jumlah']; ?></td>
                    <td><?= number_format($b['biaya']); ?></td>
                    <td>
                        <a href="<?= base_url('pengajuan/hapus_barang/') . $b['id']; ?>" class="btn btn-sm btn-danger hapus"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>