<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
            <div class="mb-4">
                <a class="btn btn-success mr-1" href="<?= base_url('apps/setoran'); ?>">Setoran</a>
                <a class="btn btn-danger" href="<?= base_url('apps/penarikan'); ?>">Penarikan</a>
            </div>
            <table class="table table-hover table-responsive-md w-100" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No. Rekening</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($tabungan as $t) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $t['nama']; ?></td>
                            <td><?= $t['id_nasabah']; ?></td>
                            <td><?= $t['alamat']; ?></td>
                            <td><?= format_rupiah($t['jumlah_setoran'] - $t['jumlah_penarikan']); ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('apps/detail/') . $t['id_nasabah']; ?>" class="badge badge-warning">Detail</a>
                            </td>
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