<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur</title>
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

    $path = realpath('\xampp\htdocs\pengadaan\assets\img\logorsisa.png');

    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $header = 'data:image/' . $type . ';base64,' . base64_encode($data);

    ?>

    <?php

    $path = realpath('\xampp\htdocs\pengadaan\assets\img\footer.png');


    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $footer = 'data:image/' . $type . ';base64,' . base64_encode($data);

    ?>

    <?php
    $pathttd = '/' . $user_vendor['id'] . '/' . $user_vendor['ttd'];
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
        <table style="width: 100%; font-size:12px;">
            <tr>
                <td>
                    <div style="font-size: 30px; font-weight:bold">
                        <?= $vendor['nama']; ?> <br>
                    </div>
                    <?= $vendor['alamat']; ?> <br>
                    Telp : <?= $vendor['no_telp']; ?> / Email : <?= $vendor['email']; ?> <br>
                    Website : <?= $vendor['situs_web']; ?>
                </td>
                <td style="width: 30%;">
                    Tanggal : <?php
                                setlocale(LC_ALL, 'id-ID', 'id_ID');
                                $formatter = IntlDateFormatter::create('id-ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Asia/Makassar', null);
                                $tgl1 = strtotime($row['tgl_faktur']);
                                $tgl = datefmt_format($formatter, $tgl1);
                                echo $tgl; ?> <br><br>
                    Kepada Yth. <br>
                    Rumah Sakit Islam Sultan Agung <br>
                    Banjarbaru
                </td>
            </tr>
        </table>
        <hr>
    </header>
    <main>
        <br>
        <h2 align="center">
            FAKTUR
        </h2>

        No. : <?= $row['no_faktur']; ?>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000000;" border="1px">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Banyaknya</th>
                    <th>Harga Rp.</th>
                    <th>Subtotal Rp.</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($barang as $d) : $i++; ?>
                    <tr>
                        <td style="text-align: center;"><?= $i; ?></td>
                        <td><?= $d['nama_barang']; ?></td>
                        <td style="text-align: center;"><?= $d['jumlah']; ?></td>
                        <td>
                            <?php if ($row['status'] != 1) : ?>
                                <?php if ($row['status'] == 7) : ?>
                                    Rp. <?= number_format($d['harga_vendor'] / $d['qty_vendor'], 0, ',', '.') ?>
                                <?php elseif ($row['status'] == 8) : ?>
                                    Rp. <?= number_format($d['biaya'] / $d['jumlah'], 0, ',', '.') ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if ($d['qty_vendor'] != null && $d['harga_vendor'] != null) : ?>
                                    Rp. <?= number_format($d['harga_vendor'] / $d['qty_vendor'], 0, ',', '.') ?>
                                <?php else : ?>
                                    Rp. <?= number_format($d['biaya'] / $d['jumlah'], 0, ',', '.') ?>
                                <?php endif; ?>
                            <?php endif; ?>

                        </td>
                        <td>
                            <?php if ($row['status'] != 1) : ?>
                                <?php if ($row['status'] == 7) : ?>
                                    Rp. <?= number_format($d['harga_vendor'], 0, ',', '.') ?>
                                <?php elseif ($row['status'] == 8) : ?>
                                    Rp. <?= number_format($d['biaya'], 0, ',', '.') ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if ($d['qty_vendor'] != null && $d['harga_vendor'] != null) : ?>
                                    Rp. <?= number_format($d['harga_vendor'], 0, ',', '.') ?>
                                <?php else : ?>
                                    Rp. <?= number_format($d['biaya'], 0, ',', '.') ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: center;"><b>Total</b></td>
                    <?php if ($row['status'] != 1) : ?>
                        <?php if ($row['status'] == 7) : ?>
                            <td>Rp. <?= number_format($row['total_vendor'], 0, ',', '.'); ?></td>
                        <?php elseif ($row['status'] == 8) : ?>
                            <td>Rp. <?= number_format($row['total'], 0, ',', '.'); ?></td>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if ($row['total_vendor'] != null) : ?>
                            <td>Rp. <?= number_format($row['total_vendor'], 0, ',', '.'); ?></td>
                        <?php else : ?>
                            <td>Rp. <?= number_format($row['total'], 0, ',', '.'); ?></td>
                        <?php endif; ?>
                    <?php endif; ?>
                </tr>
            </tfoot>
        </table>
        <p align="right">
            Hormat Kami,
            <!-- <br> -->
            <br>
            <img src="<?= $ttd; ?>" alt="TTD" height="100px" width="auto">
            <br>
            <strong><?= $user_vendor['nama_lengkap']; ?></strong>

            <br>
            <?= $vendor['nama']; ?>
        </p>
        <br>
        <p>
            <small>Catatan : Barang yang sudah dibeli tidak bisa dikembalikan tanpa perjanjian lebih dulu</small>
        </p>
    </main>
</body>

</html>