<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="mb-3">
        <a href="<?= base_url('apps/tabungan') ?>" class="d-inline badge badge-secondary text-white"><i class="fas fa-angle-left"> Back</i></a>&nbsp;
        <h5 class="d-inline">Detail Nasabah</h5>
    </div>

    <table class=" table w-75">
        <tr>
            <td style="width: 15%;">Nama</td>
            <td>: <?= $nasabah['nama']; ?></td>

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

    <div class="mb-3">
        <a href="<?= base_url('apps/exportnasabah/') . $nasabah['id_nasabah']; ?>" class="btn btn-sm btn-outline-warning mb-2" target="_blank"><i class="fas fa-file"></i> Export PDF</a>
        <a onclick="return confirm('Are You sure to delete this record...?')" class="btn btn-sm btn-outline-danger mb-2" href="<?= base_url('apps/trsdelete/' . $nasabah['id_nasabah']); ?>"><i class="fas fa-trash"></i> Hapus Data Transaksi Nasabah</a>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <table class="table table-striped table-hover table-responsive-xl w-100" id="example">
        <thead class="text-center">
            <th>#</th>
            <th>TANGGAL</th>
            <th>SETORAN</th>
            <th>PENARIKAN</th>
            <th>SALDO</th>
            <th>ID</th>
            <th>OPSI</th>
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
                    <td class="text-center">
                        <a href="<?= base_url('apps/trsedit/') . $t['id_tabungan']; ?>" class="badge badge-success">Edit</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->