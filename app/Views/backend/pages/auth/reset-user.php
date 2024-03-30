<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="/assets1/css/styles2.css">
    <link rel="stylesheet" href="/assets1/css/bootstrap/bootstrap.min.css">

    <title>Login Prodi</title>
</head>

<body>
    <div class="login">
        <img src="/assets1/img/login-bg5.jpg" alt="image" class="login__bg">

        <?php $validation = \Config\Services::validation(); ?>
        <form action="<?= route_to('user-reset-password-handler', $token); ?>" class="login__form" method="post">
            <?= csrf_field() ?>

            <?php if (!empty (session()->getFlashdata('success'))): ?>
                <div class="alert alert-success" id="alert">
                    <?= session()->getFlashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="close">
                        <spance aria-hidden="true">&times;</spance>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (!empty (session()->getFlashdata('fail'))): ?>
                <div class="alert alert-danger" id="alert">
                    <?= session()->getFlashdata('fail'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="close">
                        <spance aria-hidden="true">&times;</spance>
                    </button>
                </div>
            <?php endif; ?>
            <h1 class="login__title">Forgot Password</h1>
            <h6 class="mb-20">
                Enter your email address to reset your password
            </h6>

            <div class="login__inputs">
                <div class="login__box">
                    <input type="password" placeholder="Password" required class="login__input" name="new_password"
                        value="<?= set_value('new_password'); ?>">
                    <i class=" ri-mail-fill"></i>
                </div>

                <?php if ($validation->getError('new_password')): ?>
                    <div class="d-block text-danger" style="margin-top:-25px;margin-bottom:15px;">
                        <?= $validation->getError('new_password'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="login__inputs">
                <div class="login__box">
                    <input type="password" placeholder="Re-Password" required class="login__input"
                        name="confirm_new_password" value="<?= set_value('confirm_new_password'); ?>">
                    <i class=" ri-mail-fill"></i>
                </div>

                <?php if ($validation->getError('confirm_new_password')): ?>
                    <div class="d-block text-danger" style="margin-top:-25px;margin-bottom:15px;">
                        <?= $validation->getError('confirm_new_password'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="login__inputs2">
                <button type="submit" class="login__button">Submit</button>
                <p class="text-center">OR</p>
                <a href="<?= route_to('user.login.form'); ?>" class="login__button text-center">Login</a>
            </div>
    </div>
    </form>
    </div>
</body>
<script src="/assets1/css/bootstrap/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil tombol close
        var closeButton = document.getElementById('alert');

        // Jika tombol close ditekan
        closeButton.addEventListener('click', function () {
            // Hilangkan pesan flash
            var flashMessage = document.getElementById('alert');
            flashMessage.style.display = 'none';
        });
    });
</script>

</html>