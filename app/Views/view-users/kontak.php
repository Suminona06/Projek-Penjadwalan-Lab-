<?php $this->extend('backend/layout/user-layout') ?>

<?= $this->section('content'); ?>
<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">UPA-TIK</p>
                        <h1 class="subtitle">Politeknik Negeri Bandung</h1>
                        <div class="hero-btns">
                            <a href="<?= route_to('user.galeri'); ?>" class="bordered-btn">Galeri</a>
                            <a href="<?= route_to('user.kontak'); ?>" class="bordered-btn">Kontak Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
<div class="container6">
<h2 class="my-5">Kontak</h2>
</div>
<center>
    <div class="containerkk">
    <div class="containerk">
        <div class="headingk">Kontak Kami</div>
        <form action="<?= base_url('user/save_data_kritik') ?>" method="POST" class="form">
            
            <input required="" class="input" type="text" name="nama" id="nama" placeholder="Nama Lengkap">
            <input required="" class="input" type="text" name="email" id="email" placeholder="Email">
            <input required="" class="input3" type="text" name="komentar" id="komentar" placeholder="Komentar">

            <input class="login-button" type="submit">

        </form>        
    </div>
    </div>
</center>




<?= $this->endSection(); ?>