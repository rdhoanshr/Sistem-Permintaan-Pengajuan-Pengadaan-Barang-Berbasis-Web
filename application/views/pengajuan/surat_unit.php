<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengajuan</title>
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
            top: 0cm;
            left: 0cm;
            right: 0cm;
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

    $path = realpath('\laragon\www\pengadaan\assets\img\header.png');

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
    <header>
        <img src="<?= $header; ?>" width="100%" height="auto" alt="Header">
    </header>
    <main>
        <br>
        <br>
        <br>
        <table style="width: 100%;">
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td><?= $row['kode_pengajuan']; ?></td>
                <td style="text-align: right;">Banjarbaru, <?php
                                                            setlocale(LC_ALL, 'id-ID', 'id_ID');
                                                            $formatter = IntlDateFormatter::create('id-ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Asia/Makassar', null);
                                                            $tgl1 = strtotime($row['tgl_pengajuan']);
                                                            $tgl = datefmt_format($formatter, $tgl1);
                                                            echo $tgl; ?></td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>:</td>
                <td>Pengajuan Sarana</td>
            </tr>
        </table>
        <br>
        <p style="text-align: justify;">
            Kepada Yth. <br>
            <strong>KABAG UMUM, DAKWAH & KEMITRAAN <br>
                RUMAH SAKIT SULTAN AGUNG BANJARBARU <br>
                di - <u>BANJARBARU</u>
            </strong>
        </p>
        <br>
        <p style="text-align: justify;">
            <i>Assalamu'alaikum Wr. Wb.</i> <br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;Puji Syukur kita panjatkan kehadirat Allah SWT, semoga kita selalu dalam lindungan dan mendapatkan petunjuk serta Ridho-Nya. Aamiin. <br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;Sehubungan dengan pentingnya ketersediaan alat untuk kelancaran pelayanan yang akan berlangsung maka kami mengajukan alat medis untuk pelayanan di poliklinik dengan perincian sebagai berikut :
        </p>
        <table style="width: 100%;  border-collapse: collapse; border: 1px solid #000000;" border="1px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Item</th>
                    <th>Pengajuan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($barang == null) : ?>
                    <tr>
                        <td colspan="8" align="center">Tidak Ada Data</td>
                    </tr>
                <?php else : ?>
                    <?php
                    $i = 1;
                    foreach ($barang as $u) : ?>
                        <tr>
                            <td tyle="text-align: center;"><?= $i++; ?>.</td>
                            <td><?= $u['nama_barang']; ?></td>
                            <td style="text-align: center;"><?= $u['jumlah']; ?></td>
                            <td style="text-align: center;">Rp. <?= number_format($u['biaya'] / $u['jumlah'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align: center;"><b>Total</b></td>
                        <td style="text-align: center;">Rp. <?= number_format($row['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
        <br>
        <p style="text-align: justify;">
            &nbsp;&nbsp;&nbsp;&nbsp;Demikian permohonan pengajuan ini kami sampaikan, atas perhatiannya kami haturkan terima kasih. <br><br>
            <i>Billahittaufiq wal hidayah <br>
                Wassalamu'alaikum Wr. Wb.</i>
        </p>

        <p align="left">

            Penanggung Jawab,

            <br>
            <img src="<?= $ttd; ?>" height="100px" width="auto" alt="Tanda Tangan">
            <br>

            <b><?= $row['nama_lengkap']; ?></b>
        </p>
    </main>
    <footer>
        <img src="<?= $footer; ?>" width="100%" height="auto" alt="footer">
    </footer>
</body>

</html>