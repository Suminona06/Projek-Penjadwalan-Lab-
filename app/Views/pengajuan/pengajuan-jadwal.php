<?= $this->extend('backend/layout/user-layout'); ?>

<?= $this->section('content'); ?>

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Pilih</span> Pengajuan</h3>
                    <p class="text-white">Silahkan pilih jadwal mana yang akan anda ajukan</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-section mt-150 mb-150 " id="visi">
    <div class="container">
        <div class="row">
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-lg-6 col-md-4 text-center">
                <a href="<?= route_to('user.add.jadwal', $idProdi); ?>">
                    <h2>1. Jadwal Reguler</h2>
                </a>
                <a href="<?= route_to('user.jadwal.nonreguler'); ?>">
                    <h2>2. Jadwal Non-Reguler</h2>
                </a>

                <a href="<?= route_to('user.jadwal.uas'); ?>">
                    <h2>3. Jadwal UAS</h2>
                </a>

                <a href="<?= route_to('user.jadwal.uts'); ?>">
                    <h2>4. Jadwal UTS</h2>
                </a>

            </div>
        </div>

    </div>
</div>


<?= $this->endSection(); ?>