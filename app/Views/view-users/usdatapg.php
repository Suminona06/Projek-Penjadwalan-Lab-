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
<h2 class="my-5">Pegawai UPA-TIK</h2>
</div>
<section class="usdata">
    <table class=" table table-bordered table-hover my-3">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">NIP</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; // Initialize counter ?>
            <?php foreach ($pegawai as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nama']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nip']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?= $this->endSection(); ?>