<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 1cm;
            margin-right: 1cm;
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
    <header>
        <img src="<?= $header; ?>" width="100%" height="auto" alt="Header">
    </header>
    <main>
        <br>
        <h3 align="center">
            <u>LAPORAN RiWAYAT PENGADAAN BARANG</u> <br>
        </h3>
        <table style="width: 100%;  border-collapse: collapse; border: 1px solid #000000;" border="1px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Pengadaan</th>
                    <th>Unit</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Pagu Anggaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($pengajuan == null) : ?>
                    <tr>
                        <td colspan="8" align="center">Tidak Ada Data</td>
                    </tr>
                <?php else : ?>
                    <?php
                    $i = 1;
                    foreach ($pengajuan as $u) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $u['no_surat']; ?></td>
                            <td><?= $u['pengajuan']; ?></td>
                            <td><?= $u['nama_unit']; ?></td>
                            <td><?= $u['jenis_pengajuan']; ?></td>
                            <td><?= $u['tanggal_penyerahan']; ?></td>
                            <td>
                                <?php if ($u['total_vendor'] == null) : ?>
                                    Rp. <?= number_format($u['total']); ?>
                                <?php else : ?>
                                    Rp. <?= number_format($u['total_vendor']); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= ($u['status'] == 1) ? 'Selesai' : ''; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>

        <br>
        <br>
        <br>

        <p align="right">
            Banjarbaru, <?php
                        setlocale(LC_ALL, 'id-ID', 'id_ID');
                        $formatter = IntlDateFormatter::create('id-ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Asia/Makassar', null);
                        $tgl1 = new DateTime('now');
                        $tgl = datefmt_format($formatter, $tgl1);
                        echo $tgl; ?>
            <br>
            Mengetahui, &nbsp;&nbsp;&nbsp;&nbsp;

            <br>
            <br>
            <br>
            <!-- <br> -->
            <br>
            <strong>Nama Direktur</strong>
            <br>
            Direktur&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
    </main>
    <footer>
        <img src="<?= $footer; ?>" width="100%" height="auto" alt="footer">
    </footer>
</body>

</html>