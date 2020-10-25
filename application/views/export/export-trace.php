<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
</head>

<body>
    <?php
    error_reporting(0);
    foreach ($tabungan as $t) {
        $jml_masuk = $t['setoran'];
        $total_masuk = @$total_masuk + $jml_masuk;
        $jml_keluar = $t['penarikan'];
        $total_keluar = @$total_keluar + $jml_keluar;
        $saldo_akhir = $total_masuk - $total_keluar;
    }
    ?>
    <h2 style="text-align: center; font-weight: bold;">BUKU REKAMAN TRANSAKSI</h2>
    <p style="margin-top: -10px; text-align: center;">
        &copy;<?= date('Y'); ?> <strong>SIPitUNG</strong> Member of <a style="color: dodgerblue;" href="gpsbekonang.000webhostapp.com">gpsbekonang</a><br><span style="font-weight: bold;">E-mail: <span style="text-decoration: underline;">gps.bekonang@gmail.com</span> Website: <span style="text-decoration: underline;"><?= base_url(); ?></span></span>
    </p>
    <hr style="margin-top: -15px; margin-bottom: 30px; box-shadow: 0 4px 0 1px black;">
    <table width="40%" rules="rows">
        <tr style="width: 17%;">
            <td>Total Setoran</td>
            <td>: <?= 'Rp ' . format_rupiah($total_masuk); ?></td>
        </tr>
        <tr>
            <td>Total Penarikan</td>
            <td>: <?= 'Rp ' . format_rupiah($total_keluar); ?></td>
        </tr>
        <tr>
            <td>Saldo Keseluruhan</td>
            <td>: <?= 'Rp ' . format_rupiah($saldo_akhir); ?></td>
        </tr>
        <tr>
            <td>Data Akun Sistem</td>
            <td>: <?= $akun_sistem; ?></td>
        </tr>
        <tr>
            <td>Data Nasabah</td>
            <td>: <?= $akun_nasabah; ?></td>
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
            <th rowspan="2" width="5%">No. REKENING</th>
            <th rowspan="2" width="25%">NAMA</th>
            <th rowspan="2">TANGGAL</th>
            <th colspan="2">MUTASI Rp.</th>
            <th rowspan="2">SALDO</th>
            <th rowspan="2" align="center">ID</th>
        <tr>
            <th>SETORAN</th>
            <th>PENARIKAN</th>
        </tr>
        </tr>
        <?php $i = 1;
        foreach ($trace as $t) : ?>
            <tr>
                <th align="center"><?= $i++; ?></th>
                <td><?= $t['id_nasabah']; ?></td>
                <td><?= $t['nama']; ?></td>
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