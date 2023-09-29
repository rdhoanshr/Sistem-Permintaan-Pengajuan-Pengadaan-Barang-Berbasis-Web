<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memo Direktur</title>
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

    $path = realpath('\xampp\htdocs\pengadaan\assets\img\header.png');

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
    $pathttd = '/' . $direktur['id'] . '/' . $direktur['ttd'];
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
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000000;">
            <tr>
                <td style="vertical-align: middle; padding: 5px; position: relative;">
                    <center>
                        <p>
                        <h3>
                            <u>MEMO DIREKTUR</u>
                        </h3>
                        NOMOR : <?= $row['memo_3']; ?>
                        </p>
                    </center>
                    <br>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 20%;">No. Surat</td>
                            <td style="width: 1%;">:</td>
                            <td><?= $row['kode_pengajuan']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Surat</td>
                            <td>:</td>
                            <td><?php
                                setlocale(LC_ALL, 'id-ID', 'id_ID');
                                $formatter = IntlDateFormatter::create('id-ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Asia/Makassar', null);
                                $tgl1 = strtotime($row['tgl_pengajuan']);
                                $tgl = datefmt_format($formatter, $tgl1);
                                echo $tgl; ?></td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td>Pengajuan Sarana</td>
                        </tr>
                        <tr>
                            <td>Unit</td>
                            <td>:</td>
                            <td><?= $row['nama_unit']; ?></td>
                        </tr>
                    </table>
                    <br>
                    <p>
                        <b>Instruksi :</b> <br>
                        <?= $row['catatan_3']; ?>
                    </p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p align="left">

                        Ditanda tangani oleh,

                        <br>
                        <img src="<?= $ttd; ?>" height="100px" width="auto" alt="Tanda Tangan">
                        <br>

                        <b><?= $direktur['nama_lengkap']; ?></b>
                    </p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
        </table>
    </main>
    <footer>
        <img src="<?= $footer; ?>" width="100%" height="auto" alt="footer">
    </footer>
</body>

</html>