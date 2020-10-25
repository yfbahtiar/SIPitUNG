<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <div class="mb-3">
                <a href="<?= base_url('admin/pengaduan') ?>" class="d-inline badge badge-secondary text-white"><i class="fas fa-angle-left"> Back</i></a>&nbsp;
                <h5 class="d-inline">Pembukaan Rekening</h5>
            </div>

            <form action="<?= base_url('admin/activaterekening'); ?>" method="post">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $nasabah['nama']; ?>">
                        <input type="hidden" name="id" id="id" value="<?= $nasabah['id']; ?>">
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" value="Laki-laki" id="jenis_kelamin" name="jenis_kelamin" <?php
                                                                                                                                    if ($nasabah['jenis_kelamin'] == 'Laki-laki') {
                                                                                                                                        echo 'checked';
                                                                                                                                    }
                                                                                                                                    ?>>
                            <label class="form-check-label" for="jenis_kelamin">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" value="Perempuan" id="jenis_kelamin" name="jenis_kelamin" <?php
                                                                                                                                    if ($nasabah['jenis_kelamin'] == 'Perempuan') {
                                                                                                                                        echo 'checked';
                                                                                                                                    }
                                                                                                                                    ?>>
                            <label class="form-check-label" for="jenis_kelamin">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $nasabah['telepon']; ?>">
                        <?= form_error('telepon', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $nasabah['alamat']; ?>">
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $nasabah['email']; ?>">
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary my-1">Open This Rekening</button>
                        <button type="button" class="btn btn-danger my-1" data-toggle="modal" data-target="#rejected">Reject This Account</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Add Modal -->
<div class="modal fade" id="rejected" tabindex="-1" role="dialog" aria-labelledby="rejectedLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?= $nasabah['email']; ?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="rejectedLabel">Are You sure to reject this Account?</h5>
                <form action="<?= base_url('admin/activaterekening'); ?>" method="post">
            </div>
            <div class="modal-footer">
                <input type="hidden" id="email" name="email" value="<?= $nasabah['email']; ?>">
                <input type="hidden" id="name" name="name" value="<?= $nasabah['nama']; ?>">
                <input type="hidden" name="id" id="id" value="<?= $nasabah['id']; ?>">
                <input type="hidden" id="status" name="status" value="cmVqZWN0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
            </div>
            </form>
        </div>
    </div>
</div>