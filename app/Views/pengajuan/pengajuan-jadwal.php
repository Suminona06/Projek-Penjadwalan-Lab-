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
<section class="ajujadwal">
    <div class="container">
        <div class="d-flex justify-content-center">

            <div class="conpjadwal">
                <button>
                    <a href="<?= route_to('user.reguler.jadwal', $idProdi); ?>">
                        <h2>Jadwal Reguler</h2>
                    </a>
                </button>

                <button>
                    <a href="<?= route_to('user.uas.jadwal', $idProdi); ?>">
                        <h2>Jadwal UAS</h2>
                    </a>
                </button>
            </div>

            <div class="conpjadwal">
                <button>
                    <a href="<?= route_to('user.nonreguler.jadwal', $idProdi); ?>">
                        <h2>Jadwal Non-Reguler</h2>
                    </a>
                </button>

                <button>
                    <a href="<?= route_to('user.uts.jadwal', $idProdi); ?>">
                        <h2>Jadwal UTS</h2>
                    </a>
                </button>
            </div>

        </div>
    </div>
</section>


<?= $this->endSection(); ?>