<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <style></style>
</head>

<body>
    <h2 style="text-align: center; font-weight: bold;">BUKU TABUNGAN</h2>
    <p style="margin-top: -10px; text-align: center;">
        &copy;<?= date('Y'); ?> <strong>SIPitUNG</strong> Member of <a style="color: dodgerblue;" href="gpsbekonang.000webhostapp.com">gpsbekonang</a><br><span style="font-weight: bold;">E-mail: <span style="text-decoration: underline;">gps.bekonang@gmail.com</span> Website: <span style="text-decoration: underline;"><?= base_url(); ?></span></span>
    </p>
    </p>
    <hr style="margin-top: -15px; margin-bottom: 30px; box-shadow: 0 4px 0 1px black;">
    <table width="75%" rules="rows">
        <tr>
            <td style="width: 20%;">Nama</td>
            <td>: <?= $nasabah['nama']; ?></td>
        </tr>
        <tr>
            <td>No. Rekening</td>
            <td>: <?= $nasabah['id_nasabah']; ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>: <?= $nasabah['telepon']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $nasabah['alamat']; ?></td>
        </tr>
        <tr>
            <td>Tgl. Cetak</td>
            <td>: <?= date('d F Y'); ?></td>
        </tr>
    </table>
    <br><br>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th rowspan="2" align="center">#</th>
            <th rowspan="2">TANGGAL</th>
            <th colspan="2">MUTASI Rp.</th>
            <th rowspan="2">SALDO</th>
            <th rowspan="2" align="center">ID</th>
        <tr>
            <th>SETORAN</th>
            <th>PENARIKAN</th>
        </tr>
        </tr>
        <?php
        $i = 1;
        foreach ($tabungan as $t) : ?>
            <tr>
                <th align="center"><?= $i++; ?></th>
                <td><?= date('d/m/Y', strtotime($t['tanggal'])); ?></td>
                <td align="right">
                    <?= format_rupiah($t['setoran']); ?>
                </td>
                <td align="right"><?= format_rupiah($t['penarikan']); ?></td>
                <td align="right"><?= format_rupiah($t['saldo']); ?></td>
                <td align="center"><?= $t['id_tabungan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>