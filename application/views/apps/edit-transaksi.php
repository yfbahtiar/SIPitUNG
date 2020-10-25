<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-sm-4 mb-3">

            <div class="mb-3">
                <a href="<?= base_url('apps/detail/' . $backToPage) ?>" class="d-inline badge badge-secondary text-white"><i class="fas fa-angle-left"> Back</i></a>&nbsp;
                <h5 class="d-inline">Edit Data Transaksi</h5>
            </div>

            <form action="<?= base_url('apps/trsupdate'); ?>" method="post">
                <div class="form-group">
                    <label for="id_tabungan">ID Transaksi</label>
                    <input type="hidden" id="id_nasabah" name="id_nasabah" value="<?= $transaksi['id_nasabah']; ?>">
                    <input type="text" class="form-control" id="id_tabungan" name="id_tabungan" value="<?= $transaksi['id_tabungan']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="transaksi">Jenis</label>
                    <input type="text" class="form-control" id="transaksi" name="transaksi" value="<?php if ($transaksi['setoran'] != 0) {
                                                                                                        echo 'Setoran';
                                                                                                    } else {
                                                                                                        echo 'Penarikan';
                                                                                                    } ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="<?php if ($transaksi['setoran'] != 0) {
                                    echo 'setoran';
                                } else {
                                    echo 'penarikan';
                                } ?>">Jumlah</label>
                    <input type="hidden" id="<?php if ($transaksi['setoran'] != 0) {
                                                    echo 'penarikan';
                                                } else {
                                                    echo 'setoran';
                                                } ?>" name="<?php if ($transaksi['setoran'] != 0) {
                                                                echo 'penarikan';
                                                            } else {
                                                                echo 'setoran';
                                                            } ?>" value="0" readonly>
                    <input name="<?php if ($transaksi['setoran'] != 0) {
                                        echo 'setoran';
                                    } else {
                                        echo 'penarikan';
                                    } ?>" type="text" class="form-control" value="<?php if ($transaksi['setoran'] != 0) {
                                                                                        echo format_rupiah($transaksi['setoran']);
                                                                                    } else {
                                                                                        echo format_rupiah($transaksi['penarikan']);
                                                                                    } ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="saldo">Saldo</label>
                    <input type="text" class="form-control" id="saldo" name="saldo" value="<?= format_rupiah($transaksi['saldo']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $transaksi['tanggal']; ?>">
                    <small class="form-text text-muted ml-1">*) Data transaksi terpilih akan berwarna hijau pada tabel</small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a onclick="return confirm('Are You sure to delete this...?')" href="<?= base_url('apps/transdelete/' . $transaksi['id_tabungan']); ?>" class="btn btn-danger">Delete</a>
                </div>

            </form>

        </div>

        <div class="col-sm-8">
            <table class="table table-hover table-responsive-md w-100" id="example">
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
                        <tr class="<?php if ($aktif == $t['id_tabungan']) {
                                        echo 'table-success';
                                    } ?>">
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
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->