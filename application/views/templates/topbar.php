<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <?php
                // cari role
                $role = $this->session->userdata('role_id');
                ?>

                <?php if ($role != 3) : ?>
                    <?php
                    if ($role == 1) {
                        // cari pengaduan blm selesai untuk Admin
                        $count = $this->db->get_where('pengaduan', ['status' => 0])->result_array();

                        if ($count) {
                            $query = "SELECT *
                                      FROM pengaduan
                                      WHERE `status` = 0
                                      LIMIT 3
                                      ";
                            $alert = $this->db->query($query)->result_array();
                        }
                    } else {
                        $emailUserAktif = $this->session->userdata('email');

                        // cari pengaduan blm selesai untuk User
                        $count = $this->db->get_where('pengaduan', ['email' => $emailUserAktif])->result_array();

                        if ($count) {
                            $alert = $this->db->get_where('pengaduan', ['email' => $emailUserAktif])->result_array();
                        }
                    }
                    ?>
                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter" id="userAlert"></span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <?php if ($count) : ?>
                                <?php foreach ($alert as $a) : ?>
                                    <a class="dropdown-item d-flex align-items-center" <?php if ($role == 1) {
                                                                                            $url = base_url();
                                                                                            echo 'href=' . $url . 'admin/pengaduan';
                                                                                        } ?>>
                                        <div class="mr-3">
                                            <div class="icon-circle <?php if ($a['jenis'] == 'Pembukaan Rekening') {
                                                                        echo 'bg-success';
                                                                    } elseif ($a['jenis'] == 'Penutupan Rekening') {
                                                                        echo 'bg-danger';
                                                                    } else {
                                                                        echo 'bg-warning';
                                                                    } ?>">
                                                <i class="fas <?php if ($a['jenis'] == 'Rekening Ditolak') {
                                                                    echo 'fa-exclamation-triangle';
                                                                } elseif ($a['status'] == 1) {
                                                                    echo 'fa-user-check';
                                                                } elseif ($a['status'] == 0) {
                                                                    echo 'fa-user-clock';
                                                                } ?> text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?php if ($role == 1) {
                                                                                    echo $a['jenis'];
                                                                                } elseif ($role == 2) {
                                                                                    if ($a['status'] == 1) {
                                                                                        echo 'Terselesaikan';
                                                                                    } elseif ($a['status'] == 0) {
                                                                                        echo 'Dalam Proses';
                                                                                    } elseif ($a['jenis'] == 'Rekening Ditolak') {
                                                                                        echo 'Rekening Ditolak';
                                                                                    }
                                                                                } ?></div>
                                            <span class="font-weight-bold"><?php if ($role == 1) {
                                                                                echo $a['email'];
                                                                            } else {
                                                                                echo $a['jenis'];
                                                                            } ?></span>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                                <span class="dropdown-item text-center small text-gray-500" href="#">SIPitUNG &copy; <?= date('Y'); ?></span>
                            <?php else : ?>
                                <span class="dropdown-item text-center small text-gray-500" href="#">SIPitUNG &copy; <?= date('Y'); ?></span>
                            <?php endif; ?>
                        </div>
                    </li>

                <?php endif; ?>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user/edit'); ?>">
                            <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                            Edit Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url('user/changepassword'); ?>">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->