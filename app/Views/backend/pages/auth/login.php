<?= $this->extend('backend/layout/auth-layout'); ?>
<?= $this->section('content'); ?>



<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Login</h2>
    </div>
    <?php $validation = \Config\Services::validation(); ?>
    <form action="<?= route_to('admin.login.handler'); ?>" method="POST">
        <?= csrf_field() ?>
        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <spance aria-hidden="true">&times;</spance>
                </button>
            </div>
        <?php endif; ?>

        <?php if (!empty(session()->getFlashdata('fail'))): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('fail'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <spance aria-hidden="true">&times;</spance>
                </button>
            </div>
        <?php endif; ?>
        <div class="input-group custom">
            <input type="text" class="form-control form-control-lg" placeholder="Username" name="login_id"
                value="<?= set_value('login_id'); ?>">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>
        <?php if ($validation->getError('login_id')): ?>
            <div class="d-block text-danger" style="margin-top:-25px;margin-bottom:15px;">
                <?= $validation->getError('login_id'); ?>
            </div>
        <?php endif; ?>
        <div class="input-group custom">
            <input type="password" class="form-control form-control-lg" placeholder="**********" name="password"
                value="<?= set_value('password'); ?>">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        <?php if ($validation->getError('password')): ?>
            <div class="d-block text-danger" style="margin-top:-25px;margin-bottom:15px;">
                <?= $validation->getError('password'); ?>
            </div>

        <?php endif; ?>
        <div class="row pb-30">
            <div class="col-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember</label>
                </div>
            </div>
            <div class="col-6">
                <div class="forgot-password">
                    <a href="forgot-password.html">Forgot Password</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <!--
                                            use code for form submit
                                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                                        -->
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login">
                </div>
                <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373"
                    style="color: rgb(112, 115, 115);">
                    OR
                </div>
                <div class="input-group mb-0">
                    <a class="btn btn-outline-primary btn-lg btn-block"
                        href="<?= route_to('admin.register'); ?>">Register To Create
                        Account</a>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>