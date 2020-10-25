<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
    <?= form_error('telepon', '<small class="text-danger pl-3">', '</small>'); ?>
    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>

    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <?php if ($status == 0) : ?>
                <?php $namaNasabahBaru = $user['name']; ?>
                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengajuan Pembukaan Rekening</div>
                                <a href="" class="btn btn-success my-3" data-toggle="modal" data-target="#openRekening">Buka Rekening Saya</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Perhatian</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Pengajuan pembukaan rekening akan diproses apabila mengisi semua form yang sudah disediakan dengan benar dan valid</li>
                            <li class="list-group-item">Anda akan mendapatkan email pemberitahuan apabila pengajuan pembukaan rekening telah disetujui</li>

                        </ul>
                    </div>
                </div>
            <?php else : ?>
                <?php
                $nama = $nasabah['nama'];
                $jekel = $nasabah['jenis_kelamin'];
                $alamat = $nasabah['alamat'];
                $telepon = $nasabah['telepon'];
                ?>
                <div class="card border-left-danger shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengajuan Penutupan Rekening</div>
                                <a href="" class="btn btn-danger my-3" data-toggle="modal" data-target="#closeRekening">Tutup Rekening Saya</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Perhatian</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Setelah pengajuan penutupan rekening disetujui, Anda masih memiliki kesempatan untuk mengajukan pembukaan rekening baru</li>
                            <li class="list-group-item">Anda akan mendapatkan email pemberitahuan apabila pengajuan penutupan rekening telah disetujui</li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Non-Aktifkan Akun</div>
                            <form action="<?= base_url('tabunganku/cs'); ?>" method="POST">
                                <input type="hidden" name="name" id="name" value="<?= $user['name']; ?>">
                                <input type="hidden" name="jenis_kelamin" id="jenis_kelamin" value="Note Set">
                                <input type="hidden" name="telepon" id="telepon" value="Note Set">
                                <input type="hidden" name="email" id="email" value="<?= $user['email']; ?>">
                                <input type="hidden" name="jenis" id="jenis" value="Penghapusan Akun">
                                <input type="hidden" name="alamat" id="alamat" value="Note Set">
                                <button onclick="return confirm('Are You sure to delete Your Account..?')" type="submit" class="btn btn-warning my-3">Delete My Account</button>
                            </form>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trash fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Perhatian</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Apabila pengajuan penghapusan akun disetujui, maka Anda akan kehilangan akses login ke sistem</li>
                        <li class="list-group-item">Penghapusan akun tidak berdampak pada penutupan rekening</li>
                        <li class="list-group-item">Anda akan mendapatkan email pemberitahuan apabila pengajuan penghapusan akun telah disetujui</li>
                    </ul>
                </div>
            </div>
        </div>

    </div> <!-- end of row-->



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Add Modal -->
<div class="modal fade" id="<?php if ($status == 0) {
                                echo 'open';
                            } else {
                                echo 'close';
                            } ?>Rekening" tabindex="-1" role="dialog" aria-labelledby="<?php if ($status == 0) {
                                                                                            echo 'open';
                                                                                        } else {
                                                                                            echo 'close';
                                                                                        } ?>Rekening" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?php if ($status == 0) {
                                                echo 'open';
                                            } else {
                                                echo 'close';
                                            } ?>Rekening">Form <?php if ($status == 0) {
                                                                    echo 'Pembukaan';
                                                                } else {
                                                                    echo 'Penutupan';
                                                                } ?> Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('tabunganku/cs'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="name">Nama Pemegang Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" <?php if ($status == 1) {
                                                                                            echo 'value="';
                                                                                            echo "$nama";
                                                                                            echo '"';
                                                                                            echo ' readonly';
                                                                                        } else {
                                                                                            echo 'value="';
                                                                                            echo "$namaNasabahBaru";
                                                                                            echo '"';
                                                                                        } ?>>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name" class="mb-0">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input ml-1" type="radio" value="Laki-laki" id="jenis_kelamin" name="jenis_kelamin" <?php if ($status == 1) {
                                                                                                                                            if ($jekel == 'Laki-laki') {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                        } ?>>
                            <label class="form-check-label ml-4" for="jenis_kelamin">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input ml-1" type="radio" value="Perempuan" id="jenis_kelamin" name="jenis_kelamin" <?php if ($status == 1) {
                                                                                                                                            if ($jekel == 'Perempuan') {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                        } ?>>
                            <label class="form-check-label ml-4" for="jenis_kelamin">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $nasabah['telepon']; ?>" <?php if ($status == 1) {
                                                                                                                                    echo ' readonly';
                                                                                                                                } ?>>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                        <input type="hidden" name="jenis" id="jenis" value="<?php if ($status == 0) {
                                                                                echo 'Pembukaan';
                                                                            } else {
                                                                                echo 'Penutupan';
                                                                            } ?> Rekening">
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $nasabah['alamat']; ?>" <?php if ($status == 1) {
                                                                                                                                    echo ' readonly';
                                                                                                                                } ?>>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" <?php if ($status == 1) {
                                                                        echo ' onclick="return confirm(';
                                                                        echo "'Are You sure to close Your rekening...?')";
                                                                        echo '"';
                                                                    } ?>>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>