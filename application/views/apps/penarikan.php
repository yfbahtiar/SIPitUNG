<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="my-3">
                <h5>Penarikan Nasabah</h5>
            </div>

            <form action="<?= base_url('apps/penarikan') ?>" method="post" class="form-horizontal mt-5">

                <div class="box-body">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Id Nasabah</label>

                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" id="id_nasabah" name="id_nasabah" placeholder="Nomor Id Nasabah" readonly>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal">Browse</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Nama Nasabah</label>

                        <div class="col-sm-9">
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Nasabah" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Saldo</label>

                        <div class="col-sm-9">
                            <input type="text" id="saldo" name="saldo" class="form-control" placeholder="Rp." readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Jumlah Penarikan</label>

                        <div class="col-sm-9">
                            <input type="hidden" id="setoran" name="setoran" class="form-control" value="0" readonly>
                            <input name="penarikan" type="text" class="form-control" placeholder="Masukkan Jumlah" onkeyup="convertToRupiah(this);">
                            <?= form_error('penarikan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?= base_url('apps/tabungan'); ?>" class="btn btn-secondary">Back</a>
                    </div>
                </div>


            </form>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- setoranModal -->
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="setoranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="" method="post" action="<?= base_url('apps/penarikan') ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="setoranModalLabel">Choose Nasabah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-responsive-lg w-100" id="example">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No. Rekening</th>
                            <th>Jenis Kelamin</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($tabungan as $t) : ?>
                                <tr id="nasabah" data-id_nasabah="<?= $t['id_nasabah']; ?>" data-nama="<?= $t['nama']; ?>" data-saldo_awal="<?= format_rupiah($t['jumlah_setoran'] - $t['jumlah_penarikan']); ?>">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $t['nama']; ?></td>
                                    <td><?= $t['id_nasabah']; ?></td>
                                    <td><?= $t['jenis_kelamin']; ?></td>
                                    <td><?= $t['telepon']; ?></td>
                                    <td><?= $t['alamat']; ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>