<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if ($nasabah > 0) : ?>
                <table class="table w-75 mb-3">
                    <tr>
                        <td style="width: 15%;">Nama</td>
                        <td>: <?= $nasabah['nama']; ?>
                            <a href="<?= base_url('tabunganku/exportnasabah/') . $nasabah['id_nasabah']; ?>" class="btn btn-sm btn-outline-warning" target="_blank"><i class="fas fa-file"> Export PDF</i></a>
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 15%;">No. Rekening</td>
                        <td>: <?= $nasabah['id_nasabah']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">Telepon</td>
                        <td>: <?= $nasabah['telepon']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">Alamat</td>
                        <td>: <?= $nasabah['alamat']; ?></td>
                    </tr>
                </table>
                <table class="table table-striped table-hover table-responsive-md w-100" id="example">
                    <thead class="text-center">
                        <th>#</th>
                        <th>TANGGAL</th>
                        <th>SETORAN</th>
                        <th>PENARIKAN</th>
                        <th>SALDO</th>
                        <th>ID</th>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($tabungan as $t) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i; ?></th>
                                <td><?= date('d-F-Y', strtotime($t['tanggal'])); ?></td>
                                <td class="text-right">
                                    <?= format_rupiah($t['setoran']); ?>
                                </td>
                                <td class="text-right">
                                    <?= format_rupiah($t['penarikan']); ?>
                                </td>
                                <td class="text-right">
                                    <?= format_rupiah($t['saldo']); ?>
                                </td>
                                <td class="text-center"><?= $t['id_tabungan']; ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12 mb-3">
                        <div class="card">
                            <img src="<?= base_url('assets/img/SIPitUNG.png') ?>" class="card-img-top p-5" alt="Logo SIPitUNG">
                            <div class="card-body mx-2">
                                <p class="card-text">Sistem Informasi Pintar Menabung merupakan sebuah <i>Web Application</i> yang dibuat untuk memudahkan pengurus keuangan dalam mengelola transaksi keluar dan masuk.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="card text-center">
                            <div class="error mx-auto mt-4" data-text="404" style="width: 210px">404</div>
                            <div class="card-body">
                                <p class="card-text">Maaf, data tidak ditemukan atau rekening belum terdaftar.</p>
                            </div>
                            <div class="card-body">
                                <a href="<?= base_url('tabunganku/cs'); ?>" class="card-link">Buka Rekening Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->