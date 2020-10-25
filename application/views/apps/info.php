<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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

    <!-- Content Row -->
    <div class="row mb-3">

        <div class="col-xl-6 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo Keseluruhan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp ' . format_rupiah($saldo_akhir); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Setoran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp ' . format_rupiah($total_masuk); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-download fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Penarikan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp ' . format_rupiah($total_keluar); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-upload fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data Akun Sistem</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $akun_sistem; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Nasabah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $akun_nasabah; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-lock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <div class="row mb-3">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Transaksi&nbsp;
                    <a href="<?= base_url('apps/exporttrace/'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-file">&nbsp; Export PDF</i></a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="w-100">
                        <table class="table table-striped table-hover table-custom w-100 table-responsive" id="example">
                            <thead class="text-center table-active">
                                <th rowspan="2" style="width: 5%;">#</th>
                                <th rowspan="2">No. REKENING</th>
                                <th rowspan="2">NAMA</th>
                                <th rowspan="2">TANGGAL</th>
                                <th colspan="2">MUTASI Rp.</th>
                                <th rowspan="2">SALDO</th>
                                <th rowspan="2">ID</th>
                                <tr>
                                    <th>SETORAN</th>
                                    <th>PENARIKAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($trace as $t) : ?>
                                    <tr class=" <?php if ($t['setoran'] == 0) {
                                                    echo 'table-danger';
                                                } else {
                                                    echo 'table-success';
                                                } ?>">
                                        <th scope="row" class="text-center"><?= $i; ?></th>
                                        <td><?= $t['id_nasabah']; ?></td>
                                        <td><?= $t['nama']; ?></td>
                                        <td><?= date('d/m/Y', strtotime($t['tanggal'])); ?></td>
                                        <td class="text-right">
                                            <?= format_rupiah($t['setoran']); ?>
                                        </td>
                                        <td class="text-right "><?= format_rupiah($t['penarikan']); ?></td>
                                        <td class="text-right"><?= format_rupiah($t['saldo']); ?></td>
                                        <td><?= $t['id_tabungan']; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->