<?= $this->extend('backend/layout/display-layout'); ?>

<?= $this->section('content'); ?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Lab UPA-TIK</p>
                    <h1>Jadwal Reguler Tahun <br>
                        <?= esc($thn_awal . '-' . $thn_akhir); ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php if (isset($message)): ?>
 <h4 class="mt-3">
    <marquee behavior="scroll" direction="left">
        <?= $message; ?>
    </marquee>
 </h4>
    <?php endif; ?>
<?php if (isset($jadwalData)): ?>
    <h4 class="mt-3">
        <marquee behavior="scroll" direction="left">
            <?php foreach ($jadwalData as $a): ?>
                Ruangan:
                <?= $a['nama_ruangan']; ?>
                Prodi:
                <?= $a['nama_prodi']; ?>
                Kelas:
                <?= $a['kelas']; ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php endforeach; ?>
        </marquee>
        </h4>
<?php endif; ?>
    <!-- end breadcrumb section -->


    <div id="myCarousel" class="carousel slide row" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="3"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="4"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">

            <div class="carousel-item active">
                <?= $this->include('display/jadwal/jadwalReguler', ['hari' => 'Senin']); ?>
                <div class="carousel-caption">
                    <h3>JADWAL POLBAN SENIN</h3>
                </div>
            </div>

            <div class="carousel-item">
                <?= $this->include('display/jadwal/jadwalSelasa', ['hari' => 'Selasa']); ?>
                <div class="carousel-caption">
                    <h3>JADWAL POLBAN SELASA</h3>
                </div>
            </div>

            <div class="carousel-item">
                <?= $this->include('display/jadwal/jadwalRabu', ['hari' => 'Rabu']); ?>
                <div class="carousel-caption">
                    <h3>JADWAL POLBAN RABU</h3>
                </div>
            </div>

            <div class="carousel-item">
                <?= $this->include('display/jadwal/jadwalKamis', ['hari' => 'Kamis']); ?>
                <div class="carousel-caption">
                    <h3>JADWAL POLBAN KAMIS</h3>
                </div>
            </div>

            <div class="carousel-item">
                <?= $this->include('display/jadwal/jadwalJumat', ['hari' => 'Jumat']); ?>
                <div class="carousel-caption">
                    <h3>JADWAL POLBAN JUM'AT</h3>
                </div>
            </div>

        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <?= $this->endSection(); ?>