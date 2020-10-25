<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!-- Content Row -->
    <div class="row mb-3">

        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Akun Sistem</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $akun_sistem; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Akun Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $akun_aktif; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Akun Tidak Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $akun_non_aktif; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row statistik -->

    <div class="row mb-3">
        <div class="col-lg">
            <h5 class="d-block">Tambah Akun</h5>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newAkunModal">Add New Akun</a>

            <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('password1', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('role_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>
        </div> <!-- end col-lg akun -->
    </div> <!-- end row akun -->

    <div class="row">
        <div class="col-lg">
            <h5 class="d-block">Laporan Data Akun Sistem</h5>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="w-100">
                        <table class="table table-striped table-hover table-custom w-100 table-responsive" id="example">
                            <thead class="text-center table-active">
                                <th style="width: 5%;">#</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>ROLE AKSES</thn=>
                                <th>STATUS</th>
                                <th>TANGGAL BUAT</th>
                                <th>ACTION</th>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($akun as $a) : ?>
                                    <tr class=" <?php if ($a['is_active'] == 0) {
                                                    echo 'table-danger';
                                                } else {
                                                    echo 'table-success';
                                                } ?>">
                                        <th scope="row" class="text-center"><?= $i; ?></th>
                                        <td><?= $a['name']; ?></td>
                                        <td><?= $a['email']; ?></td>
                                        <td>
                                            <?php if ($a['role_id'] == 1) {
                                                echo 'Administrator';
                                            } else if ($a['role_id'] == 2) {
                                                echo 'User';
                                            } else {
                                                echo 'Operator';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($a['is_active'] == 0) {
                                                echo 'Disabled';
                                            } else {
                                                echo 'Active';
                                            }
                                            ?>
                                        </td>
                                        <td><?= date('d F Y', $a['date_created']); ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/edituser/') . $a['id']; ?>" class="badge badge-success">Edit</a>
                                            <a onclick="return confirm('Are You sure to delete this...?')" href="<?= base_url('admin/deleteuser/') . $a['id']; ?>" class="badge badge-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of row lap data akun -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Add Modal -->
<div class="modal fade" id="newAkunModal" tabindex="-1" role="dialog" aria-labelledby="newAkunModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAkunModalLabel">Add New Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="name">Nama Akun Baru <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Email Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email@sipitung.com">
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Repeat Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Role <span class="text-danger">*</span></label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">== Pilih Role Akses ==</option>
                            <option value="1">Administrator</option>
                            <option value="3">Operator</option>
                            <option value="2">User</option>
                        </select>
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