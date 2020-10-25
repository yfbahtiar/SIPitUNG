<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 input-group">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <span class="input-group-text input-group-prepend" id="showPass1" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px; border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0; cursor: pointer;">
                                        <i class="fas fa-eye" id="toggle1"></i>
                                    </span>
                                </div>
                                <div class="col-sm-6 input-group">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                    <span class="input-group-text input-group-prepend" id="showPass2" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px; border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0; cursor: pointer;">
                                        <i class="fas fa-eye" id="toggle2"></i>
                                    </span>
                                </div>
                                <?= form_error('password1', '<small class="text-danger pl-3 ml-1">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>