<?= $this->extend('backend/layout/register-layout'); ?>
<?= $this->section('content'); ?>

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Form Registrasi</h2>
    </div>
    <?php $validation = \Config\Services::validation(); ?>
    <form action="<?= route_to('admin.save'); ?>" method="POST">
        <?= csrf_field() ?>
        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('succes'); ?>
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
        <div class="form-wrap max-width-600 mx-auto">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Email Address*</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" id="username">
                </div>
            </div>
            <?php if ($validation->getError('email')): ?>
                <div class="d-block text-danger" style="margin-top:-25px;margin-bottom:15px;">
                    <?= $validation->getError('email'); ?>
                </div>
            <?php endif; ?>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Username*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" id="username">
                </div>
            </div>
            <?php if ($validation->getError('username')): ?>
                <div class="d-block text-danger" style="margin-top:-25px;margin-bottom:15px;">
                    <?= $validation->getError('username'); ?>
                </div>
            <?php endif; ?>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Password*</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="password">
                </div>
            </div>
            <?php if ($validation->getError('password')): ?>
                <div class="d-block text-danger" style="margin-top:-25px;margin-bottom:15px;">
                    <?= $validation->getError('password'); ?>
                </div>
            <?php endif; ?>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Confirm Password*</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                </div>
            </div>
            <?php if ($validation->getError('confirm_password')): ?>
                <div class="d-block text-danger" style="margin-top:-25px;margin-bottom:15px;">
                    <?= $validation->getError('confirm_password'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="form-group ml-2">
                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Register">
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>