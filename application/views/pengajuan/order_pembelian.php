<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Pembelian</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 1cm;
            left: 2cm;
            right: 2cm;
            height: 1cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
        }
    </style>
</head>

<body>
    <?php

    $path = realpath('\laragon\www\pengadaan\assets\img\logorsisa.png');

    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $header = 'data:image/' . $type . ';base64,' . base64_encode($data);

    ?>

    <?php

    $path = realpath('\laragon\www\pengadaan\assets\img\footer.png');


    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $footer = 'data:image/' . $type . ';base64,' . base64_encode($data);

    ?>

    <?php
    $pathttd = '/' . $row['id_user'] . '/' . $row['ttd'];
    $path = realpath('/laragon/www/pengadaan/uploads/ttd/') . $pathttd;

    $type = pathinfo($path, PATHINFO_EXTENSION);

    if (file_exists($path)) {
        $data = file_get_contents($path);
        $ttd = 'data:image/' . $type . ';base64,' . base64_encode($data);
    } else {
        $ttd = null;
    }
    ?>

    <?php
    $pathttd = '/' . $staff['id'] . '/' . $staff['ttd'];
    $path = realpath('/laragon/www/pengadaan/uploads/ttd/') . $pathttd;

    $type = pathinfo($path, PATHINFO_EXTENSION);

    if (file_exists($path)) {
        $data = file_get_contents($path);
        $ttd_staff = 'data:image/' . $type . ';base64,' . base64_encode($data);
    } else {
        $ttd_staff = null;
    }
    ?>

    <?php
    $pathttd = '/' . $kabag['id'] . '/' . $kabag['ttd'];
    $path = realpath('/laragon/www/pengadaan/uploads/ttd/') . $pathttd;

    $type = pathinfo($path, PATHINFO_EXTENSION);

    if (file_exists($path)) {
        $data = file_get_contents($path);
        $ttd_kabag = 'data:image/' . $type . ';base64,' . base64_encode($data);
    } else {
        $ttd_kabag = null;
    }
    ?>

    <?php
    $pathttd = '/' . $direktur['id'] . '/' . $direktur['ttd'];
    $path = realpath('/laragon/www/pengadaan/uploads/ttd/') . $pathttd;

    $type = pathinfo($path, PATHINFO_EXTENSION);

    if (file_exists($path)) {
        $data = file_get_contents($path);
        $ttd_direktur = 'data:image/' . $type . ';base64,' . base64_encode($data);
    } else {
        $ttd_direktur = null;
    }
    ?>
    <header>
        <table style="width: 100%; font-size:12px;">
            <tr>
                <td rowspan="4" style="width: 14%;"><img src="<?= $header; ?>" width="170px" height="auto" alt="Header"></td>
                <td style="width: 55%;">&nbsp;&nbsp;&nbsp;Jl. A.Yani Km. 17,5 Komplek Citra Graha, RT. 15, RW. 22</td>
                <td style="width: 1%;"></td>
                <td style="width: 30%;">Kepada Yth.</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;Kec. Liang Anggang, Kel. Landasan Ulin Barat</td>
                <td></td>
                <td><?= $vendor['nama']; ?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;Banjarbaru, Kalimantan Selatan</td>
                <td></td>
                <td><?= $vendor['alamat']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;Telephone: 0511 - 7945 633 / 7945 636</td>
                <td></td>
                <td><?= $vendor['no_telp']; ?></td>
                <td></td>
            </tr>
        </table>
        <hr>
    </header>
    <main>
        <br>
        <h2 align="center">
            ORDER PEMBELIAN
        </h2>

        <?= $row['kode_pengajuan']; ?>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000000;" border="1px">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NAMA BARANG</th>
                    <th>JUMLAH</th>
                    <th>HARGA SATUAN</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($detail as $d) : $i++; ?>
                    <tr>
                        <td style="text-align: center;"><?= $i; ?></td>
                        <td><?= $d['nama_barang']; ?></td>
                        <td style="text-align: center;"><?= $d['jumlah']; ?></td>
                        <td>Rp. <?= number_format($d['biaya'] / $d['jumlah'], 0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($d['biaya'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: center;">Total</td>
                    <td>Rp. <?= number_format($row['total'], 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
        </table>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center;">DIAJUKAN OLEH</td>
                <td style="text-align: center;">DISETUJUI OLEH</td>
            </tr>
        </table>
        <table align="center" style="width: 90%; border-collapse: collapse; border: 1px solid #000000; font-size:12px;" border="1px">
            <tr>
                <td style="width: 25%; text-align: center;">UNIT</td>
                <td style="width: 25%; text-align: center;">BAGIAN PENGADAAN</td>
                <td style="width: 25%; text-align: center;">KABAG</td>
                <td style="width: 25%; text-align: center;">DIREKTUR</td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <img src="<?= $ttd; ?>" alt="TTD" height="100px" width="auto"> <br>
                    <?= $row['nama_lengkap']; ?>
                </td>
                <td style="text-align: center;">
                    <img src="<?= $ttd_staff; ?>" alt="TTD" height="100px" width="auto"> <br>
                    <?= $staff['nama_lengkap']; ?>
                </td>
                <td style="text-align: center;">
                    <img src="<?= $ttd_kabag; ?>" alt="TTD" height="100px" width="auto"> <br>
                    <?= $kabag['nama_lengkap']; ?>
                </td>
                <td style="text-align: center;">
                    <img src="<?= $ttd_direktur; ?>" alt="TTD" height="100px" width="auto"> <br>
                    <?= $direktur['nama_lengkap']; ?>
                </td>
            </tr>
            <tr>
                <td>TGL. <?= date('d-m-y', strtotime($row['tgl_pengajuan'])); ?></td>
                <td>TGL. <?= date('d-m-y', strtotime($row['tgl_pengajuan'])); ?></td>
                <td>TGL. <?= date('d-m-y', strtotime($surat['tgl_persetujuan'])); ?></td>
                <td>TGL. <?= date('d-m-y', strtotime($surat['tgl_persetujuan'])); ?></td>
            </tr>
        </table>
    </main>
    <footer>
        <img src="<?= $footer; ?>" width="100%" height="auto" alt="footer">
    </footer>
</body>

</html>