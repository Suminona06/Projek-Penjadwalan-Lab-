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
<h2 class="my-5">Galeri</h2>
</div>

<section class="usgaleri">
        <div class="container">
            <div class="secgal">
                <h1>Galeri P2T POLBAN</h1>
            </div>
            <div class="roww1">
            <?php if (!empty($galeri)) : ?>
                <?php $i = 1; // Initialize counter ?>
    <?php foreach ($galeri as $foto) : ?>
        <div class="col-md-3 col-sm-12">
            <div class="usgaleri1">

                <img src="<?= base_url('img/' . $foto['foto']); ?>" class="img-fluid" alt="">
                <p> <?= $foto['nama_ruangan']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    
<?php endif; ?>

        </div>
</section>



















<!-- <div class="wrapper">
    <div class="containerr">
        <input type="radio" name="slide" id="c1">
        <label for="c1" class="cardd">
            <img src="/assets/css/lab1-2.jpeg" alt="">
            <div class="row">
                <div class="icon">1</div>
                <div class="description">
                    <h4>LAB 1</h4>
                    <p></p>
                </div>
            </div>
        </label> -->
        <!-- <input type="radio" name="slide" id="c2">
        <label for="c2" class="cardd">
            <div class="row">
                <div class="icon">2</div>
                <div class="description">
                    <h4>LAB 3</h4>
                    <p></p>
                </div>
            </div>
        </label>
        <input type="radio" name="slide" id="c3">
        <label for="c3" class="cardd">
            <div class="row">
                <div class="icon">3</div>
                <div class="description">
                    <h4>LAB 4</h4>
                    <p></p>
                </div>
            </div>
        </label>
        <input type="radio" name="slide" id="c4">
        <label for="c4" class="cardd">
            <div class="row">
                <div class="icon">4</div>
                <div class="description">
                    <h4>LAB 5</h4>
                    <p></p>
                </div>
            </div>
        </label>
        <input type="radio" name="slide" id="c5">
        <label for="c5" class="cardd">
            <div class="row">
                <div class="icon">5</div>
                <div class="description">
                    <h4>LAB 8</h4>
                    <p></p>
                </div>
            </div>
        </label> -->
        
    <!-- </div>
</div> -->
<!-- <h1>Gallery</h1>





<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">
                Foto
            </th>
        </tr>
    </thead>
    <tbody>
       
</table> -->
<?= $this->endSection(); ?>

