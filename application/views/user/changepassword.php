<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('user/changepassword'); ?>" method="post">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <span class="input-group-text input-group-prepend" id="showPass" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0; cursor: pointer;">
                            <i class="fas fa-eye" id="toggle"></i>
                        </span>
                    </div>
                    <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="new_password1">New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                        <span class="input-group-text input-group-prepend" id="showPass1" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0; cursor: pointer;">
                            <i class="fas fa-eye" id="toggle1"></i>
                        </span>
                    </div>
                    <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="new_password2">Repeat Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                        <span class="input-group-text input-group-prepend" id="showPass2" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0; cursor: pointer;">
                            <i class="fas fa-eye" id="toggle2"></i>
                        </span>
                    </div>
                    <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->