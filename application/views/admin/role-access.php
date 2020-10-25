<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">

            <?= $this->session->flashdata('message'); ?>

            <div class="mb-3">
                <a href="<?= base_url('admin/role') ?>" class="d-inline badge badge-secondary text-white"><i class="fas fa-angle-left"> Back</i></a>&nbsp;
                <h5 class="d-inline"><?= $role['role']; ?></h5>
            </div>

            <table class=" table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input toChangeRoleAccess" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                </div>
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