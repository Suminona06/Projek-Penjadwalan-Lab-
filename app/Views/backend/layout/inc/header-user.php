<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index.html">
                            <img src="/assets/img/nav-polban.png" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <?php if (session()->has('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                            <?= session('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                id="alert"></button>
                        </div>
                    <?php endif ?>


                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class=""><a href="<?= route_to('home.user'); ?>">Home</a>
                            </li>
                            <li><a href="<?= route_to('home.user'); ?>">Profile</a>
                                <ul class="sub-menu">
                                    <li><a href="#visi">Visi & Misi</a></li>
                                    <li><a href="#struktur">Struktur</a></li>
                                    <li><a href="#layanan">Layanan</a></li>
                                    <li><a href="#prosedur">Prosedur</a></li>
                                    <li><a href="#tata-tertib">Tata Tertib</a></li>
                                    <li><a href="#">Denah</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= route_to('user.usfasilitas'); ?>">Fasilitas</a>
                            </li>
                            <li><a href="<?= route_to('user.galeri'); ?>">Galeri</a></li>
                            <li><a href="#">Jadwal</a>
                                <ul class="sub-menu">
                                    <li><a href="<?= route_to('user.jadwal'); ?>">Reguler</a></li>
                                    <li><a href="<?= route_to('user.nonreguler'); ?>">Non Reguler</a></li>
                                    <li><a href="<?= route_to('user.uas'); ?>">UAS</a></li>
                                    <li><a href="<?= route_to('user.uts'); ?>">UTS</a></li>
                                    <li><a href="<?= route_to('user.ajukan'); ?>">Pengajuan</a></li>
                                    <li><a href="<?= route_to('user.logout'); ?>">Logout</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Data</a>
                                <ul class="sub-menu">
                                    <li><a href="<?= route_to('user.usdatasis'); ?>">Siswa PKL</a></li>
                                    <li><a href="<?= route_to('user.usdatapg'); ?>">Pegawai</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= route_to('user.kontak'); ?>">Kontak</a></li>
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>

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
<!-- end header -->