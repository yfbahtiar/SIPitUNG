<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('jenis_kelamin', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('telepon', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('alamat', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#newNasabahModal">Add New Nasabah</a>

            <div class="mb-3">
                <h5 class="d-inline">List Data Nasabah</h5>
            </div>

            <table class="table table-hover table-responsive-md w-100" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No. Rekening</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($nasabah as $n) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $n['nama']; ?></td>
                            <td><?= $n['id_nasabah']; ?></td>
                            <td><?= $n['jenis_kelamin']; ?></td>
                            <td><?= $n['telepon']; ?></td>
                            <td><?= $n['alamat']; ?></td>
                            <td>
                                <a href="<?= base_url('apps/edit/') . $n['id_nasabah']; ?>" class="badge badge-success">Edit</a>
                                <a onclick="return confirm('Are You sure to delete this...?')" href="<?= base_url('apps/delete/') . $n['id_nasabah']; ?>" class="badge badge-danger">Delete</a>
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

<!-- Add Modal -->
<div class="modal fade" id="newNasabahModal" tabindex="-1" role="dialog" aria-labelledby="newNasabahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newNasabahModalLabel">Add New Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('apps'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="name">Nama Nasabah Baru <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama...">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name" class="mb-0">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input ml-1" type="radio" value="Laki-laki" id="jenis_kelamin" name="jenis_kelamin">
                            <label class="form-check-label ml-4" for="jenis_kelamin">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input ml-1" type="radio" value="Perempuan" id="jenis_kelamin" name="jenis_kelamin">
                            <label class="form-check-label ml-4" for="jenis_kelamin">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="08123....">
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Indonesia...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>