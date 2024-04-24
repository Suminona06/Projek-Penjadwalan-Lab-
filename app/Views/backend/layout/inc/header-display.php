<!-- header -->
<script>
    // Fungsi untuk menampilkan jam live
    function showLiveTime() {
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();

        // Pad with zeroes if necessary
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;

        // Tampilkan waktu di elemen dengan id "live-time"
        document.getElementById("live-time").innerHTML = hours + ":" + minutes + ":" + seconds;
    }

    // Panggil fungsi showLiveTime() setiap detik
    setInterval(showLiveTime, 1000);
</script>
<div class="top-header-area" id="sticker" onload="showLiveTime()">
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

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class=""><a href="<?= route_to('home.display'); ?>">Home</a>
                            </li>
                            <li><a href="<?= route_to('display.reguler'); ?>">Jadwal Reguler</a>
                            </li>
                            <li><a href="#">Jadwal</a>
                                <ul class="sub-menu">
                                    <li><a href="<?= route_to('display.all'); ?>">Senin</a></li>
                                    <li><a href="<?= route_to('display.selasa'); ?>">Selasa</a></li>
                                    <li><a href="<?= route_to('display.rabu'); ?>">Rabu</a></li>
                                    <li><a href="<?= route_to('display.kamis'); ?>">Kamis</a></li>
                                    <li><a href="<?= route_to('display.jumat'); ?>">Jum'at</a></li>
                                </ul>
                            </li>
                            <li class="text-white h5 mt-3">
                                Jam: <span id="live-time">
                                    <?= date('H:i:s'); ?>
                                </span>
                            </li>
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
<!-- end header -->