<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <div class="mb-3">
                <a href="<?= base_url('admin/role') ?>" class="d-inline badge badge-secondary text-white"><i class="fas fa-angle-left"> Back</i></a>&nbsp;
                <h5 class="d-inline">Edit Role</h5>
            </div>

            <form action="<?= base_url('admin/updaterole'); ?>" method="post">
                <div class="form-group row">
                    <input type="hidden" name="id" id="id" value="<?= $role['id']; ?>" class="form-cotrol">
                    <label for="name" class="col-sm-2 col-form-label">Role Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $role['role']; ?>" readonly>
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->