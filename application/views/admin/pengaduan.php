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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengaduan Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_total; ?></div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengaduan Terselesaikan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_selesai; ?></div>
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
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengaduan Dalam Proses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_baru; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row statistik -->

    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger d-flex my-2">Laporan Pengaduan&nbsp;
                        <form action="<?= base_url('admin/pengaduan'); ?>" method="POST">
                            <input type="hidden" name="clear" id="clear" value="1">
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash">&nbsp; Clear History</i></button>
                        </form>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="w-100">
                        <table class="table table-striped table-hover table-custom w-100 table-responsive" id="example">
                            <thead class="text-center table-active">
                                <th style="width: 5%;">#</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>ALAMAT</>
                                <th>TELEPON</th>
                                <th>PENGADUAN</th>
                                <th>ACTION</th>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pengaduan as $p) : ?>
                                    <tr class=" <?php if ($p['status'] == 0) {
                                                    echo 'table-danger';
                                                } else {
                                                    echo 'table-success';
                                                } ?>">
                                        <th scope="row" class="text-center"><?= $i; ?></th>
                                        <td><?= $p['nama']; ?></td>
                                        <td><?= $p['email']; ?></td>
                                        <td><?= $p['alamat']; ?></td>
                                        <td><?= $p['telepon']; ?></td>
                                        <td><?= $p['jenis']; ?></td>
                                        <td class="text-center">
                                            <?php if ($p['jenis'] == 'Pembukaan Rekening') : ?>
                                                <?php if ($p['status'] == 0) : ?>
                                                    <a href="<?= base_url('admin/openrekening/') . $p['id']; ?>" class="badge badge-success">Open Rekening</a>
                                                <?php else : ?>
                                                    <span class="text-muted">Done</span>
                                                <?php endif; ?>
                                            <?php elseif ($p['jenis'] == 'Penutupan Rekening') : ?>
                                                <?php if ($p['status'] == 0) : ?>
                                                    <a href="<?= base_url('admin/droprekening/') . $p['id']; ?>" class="badge badge-danger">Close Rekening</a>
                                                <?php else : ?>
                                                    <span class="text-muted">Done</span>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if ($p['status'] == 0) : ?>
                                                    <a href="<?= base_url('admin/deleteaccount/') . $p['id']; ?>" class="badge badge-danger">Delete Account</a>
                                                <?php else : ?>
                                                    <span class="text-muted">Done</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
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
    </div><!-- end of row lap pengaduan -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->