<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <div class="mb-3">
                <a href="<?= base_url('admin/'); ?>" class="d-inline badge badge-secondary text-white"><i class="fas fa-angle-left"> Back</i></a>&nbsp;
                <h5 class="d-inline">Edit Akun</h5>
            </div>

            <form action="<?= base_url('admin/updateuser'); ?>" method="post">
                <div class="form-group row">
                    <input type="hidden" name="id" id="id" value="<?= $akun['id']; ?>" class="form-cotrol">
                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $akun['name']; ?>" required>
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $akun['email']; ?>" required disabled>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="<?= $akun['role_id']; ?>">== <?php if ($akun['role_id'] == 1) {
                                                                            echo 'Administrator';
                                                                        } else if ($akun['role_id'] == 2) {
                                                                            echo 'User';
                                                                        } else {
                                                                            echo 'Operator';
                                                                        } ?> ==</option>

                            <option value="1">Administrator</option>
                            <option value="3">Operator</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Is Active ?</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <?php if ($akun['is_active'] == 0) {
                                echo '<input class="form-check-input" type="radio" name="is_active" id="is_ative" value="1"> Active <br>';
                                echo '<input class="form-check-input" type="radio" name="is_active" id="is_ative" value="0" checked> Disabled';
                            } else {
                                echo '<input class="form-check-input" type="radio" name="is_active" id="is_ative" value="1" checked> Active <br>';
                                echo '<input class="form-check-input" type="radio" name="is_active" id="is_ative" value="0"> Disabled';
                            } ?>
                        </div>
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