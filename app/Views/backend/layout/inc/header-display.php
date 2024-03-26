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

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class=""><a href="<?= route_to('home.user'); ?>">Home</a>
                            </li>
                            <li><a href="<?= route_to('home.user'); ?>">Jadwal Reguler</a>
                            </li>
                            <li><a href="#">Jadwal</a>
                                <ul class="sub-menu">
                                    <li><a href="<?= route_to('user.jadwal'); ?>">Reguler</a></li>
                                    <li><a href="<?= route_to('user.nonreguler'); ?>">Non Reguler</a></li>
                                    <li><a href="<?= route_to('user.uas'); ?>">UAS</a></li>
                                    <li><a href="<?= route_to('user.uts'); ?>">UTS</a></li>
                                </ul>
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