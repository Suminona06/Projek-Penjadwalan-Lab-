<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');





//ruangan


//barang

$routes->group('admin', static function ($routes) {

    $routes->group('', ['filter' => 'cifilter:auth'], static function ($routes) {

        //Menu
        $routes->get('home', 'AdminController::index', ['as' => 'admin.home']);
        $routes->get('logout', 'AdminController::logoutHandler', ['as' => 'admin.logout']);
        $routes->get('pengolahan_lab', 'Fasilitas::index', ['as' => 'admin.pengolahan.lab']);
        $routes->get('fasilitas', 'Fasilitas::software', ['as' => 'admin.fasilitas']);
        $routes->get('ruangan', 'Fasilitas::ruangan', ['as' => 'admin.ruangan']);
        $routes->get('barang', 'Fasilitas::barang', ['as' => 'admin.barang']);
        $routes->get('galeri', 'Fasilitas::galeri', ['as' => 'admin.galeri']);
        $routes->get('siswa', 'Siswa::index', ['as' => 'admin.siswa']);
        $routes->get('pegawai', 'Pegawai::index', ['as' => 'admin.pegawai']);
        $routes->get('jadwal', 'Jadwal::index', ['as' => 'admin.jadwal']);


        $routes->get('lab_hardware/(:segment)', 'HardwareController::detail/$1', ['as' => 'admin.lab.2']);
        $routes->get('detail_fasilitas/(:num)', 'Fasilitas::detailFasilitas/$1', ['as' => 'detail.fasilitas']);

        //pdf
        $routes->get('pdf_export/(:num)', 'PdfController::exportPDF/$1', ['as' => 'admin.export.pdf']);
        $routes->get('software_export/(:num)', 'PdfController::exportSoftware/$1', ['as' => 'software.export.pdf']);
        $routes->get('ruangan_export', 'PdfController::exportRuangan', ['as' => 'ruangan.export.pdf']);
        $routes->get('barang_export', 'PdfController::exportBarang', ['as' => 'barang.export.pdf']);
        $routes->get('jadwal_export', 'PdfController::exportJadwal', ['as' => 'jadwal.export.pdf']);

        $routes->get('data_akademik', 'Ta::index', ['as' => 'admin.data.akademik']);
        $routes->get('jurusan', 'Ta::jurusan', ['as' => 'admin.jurusan']);
        $routes->get('prodi', 'Ta::prodi', ['as' => 'admin.prodi']);
        $routes->get('unit', 'Ta::unit', ['as' => 'admin.unit']);
        $routes->get('users', 'User::index', ['as' => 'admin.users']);
        $routes->get('kritik', 'User::kritik', ['as' => 'admin.kritik']);


        //Crud Hardware
        $routes->get('add_data_lab/(:num)', 'HardwareController::add_data_lab/$1', ['as' => 'admin.add.lab']);
        $routes->post('save_data_lab', 'HardwareController::save_data_lab', ['as' => 'admin.save_data_lab']);
        $routes->get('hapus_data_lab/(:num)/(:num)', 'HardwareController::delete_data_lab/$1/$2', ['as' => 'hapus.data.lab']);
        $routes->get('edit_lab/(:num)/(:num)', 'HardwareController::edit_lab/$1/$2', ['as' => 'edit.lab']);
        $routes->post('update_lab/(:num)', 'HardwareController::update_lab/$1', ['as' => 'update.lab']);

        //Crud Software
        $routes->get('add_data_software/(:num)', 'Fasilitas::add_data_software/$1', ['as' => 'admin.data.software']);
        $routes->get('hapus_data_software/(:any)', 'Fasilitas::delete_software/$1', ['as' => 'admin.hapus.data.software']);
        $routes->get('edit_data_software/(:any)', 'Fasilitas::edit_software/$1', ['as' => 'admin.edit.data.software']);
        $routes->post('update_data_software/(:any)', 'Fasilitas::update_software/$1', ['as' => 'admin.update.data.software']);
        $routes->post('save_data_software', 'Fasilitas::save_data_software', ['as' => 'admin.save.software']);

        //Crud Barang
        $routes->get('add_data_barang', 'Fasilitas::add_data_barang', ['as' => 'admin.add.barang']);
        $routes->get('edit_data_barang/(:any)', 'Fasilitas::edit_barang/$1', ['as' => 'admin.edit.barang']);
        $routes->post('save_data_barang', 'Fasilitas::save_data_barang', ['as' => 'admin.save.data.barang']);
        $routes->post('update_data_barang/(:any)', 'Fasilitas::update_barang/$1', ['as' => 'admin.update.data.barang']);
        $routes->get('hapus_data_barang/(:any)', 'Fasilitas::delete_barang/$1', ['as' => 'admin.hapus.data.barang']);

        //Crud Ruangan
        $routes->get('add_data_ruangan', 'Fasilitas::add_data_ruangan', ['as' => 'admin.add.data.ruangan']);
        $routes->get('edit_data_ruangan/(:any)', 'Fasilitas::edit_ruangan/$1', ['as' => 'admin.edit.data.ruangan']);
        $routes->post('save_data_ruangan', 'Fasilitas::save_data_ruangan', ['as' => 'admin.save.data.ruangan']);
        $routes->get('hapus_data_ruangan/(:any)', 'Fasilitas::delete_ruangan/$1', ['as' => 'admin.hapus.data.ruangan']);
        $routes->post('update_data_ruangan/(:any)', 'Fasilitas::update_ruangan/$1', ['as' => 'admin.update.data.ruangan']);

        //Crud Galeri
        $routes->get('add_data_galeri', 'Fasilitas::add_data_galeri', ['as' => 'admin.add.data.galeri']);
        $routes->get('edit_data_galeri/(:any)', 'Fasilitas::edit_galeri/$1', ['as' => 'admin.edit.data.galeri']);
        $routes->post('save_data_galeri', 'Fasilitas::save_data_galeri', ['as' => 'admin.save.data.galeri']);
        $routes->get('hapus_data_galeri/(:any)', 'Fasilitas::delete_galeri/$1', ['as' => 'admin.hapus.data.galeri']);
        $routes->post('update_data_galeri/(:any)', 'Fasilitas::update_galeri/$1', ['as' => 'admin.update.data.galeri']);

        //Crud Siswa
        $routes->get('add_data_siswa', 'Siswa::add_data_siswa', ['as' => 'admin.add.siswa']);
        $routes->post('save_data_siswa', 'Siswa::save_data_siswa', ['as' => 'admin.save.data.siswa']);
        $routes->get('hapus_data_siswa/(:any)', 'Siswa::delete_siswa/$1', ['as' => 'admin.hapus.data.siswa']);
        $routes->get('edit_data_siswa/(:num)', 'Siswa::edit_siswa/$1', ['as' => 'admin.edit.data.siswa']);
        $routes->post('update_data_siswa/(:num)', 'Siswa::update_siswa/$1', ['as' => 'admin.update.data.siswa']);

        //Crud Pegawai
        $routes->get('add_data_pegawai', 'Pegawai::add_data_pegawai', ['as' => 'admin.add.pegawai']);
        $routes->post('save_pegawai', 'Pegawai::save_pegawai', ['as' => 'admin.save.data.pegawai']);
        $routes->get('hapus_data_pegawai/(:num)', 'Pegawai::delete_pegawai/$1', ['as' => 'admin.hapus.data.pegawai']);
        $routes->get('edit_data_pegawai/(:num)', 'Pegawai::edit_pegawai/$1', ['as' => 'admin.edit.data.pegawai']);
        $routes->post('update_data_pegawai/(:any)', 'Pegawai::update_pegawai/$1', ['as' => 'admin.update.data.pegawai']);


        //Crud Tahun Ajaran
        $routes->get('add_data_ta', 'Ta::add_data_ta', ['as' => 'admin.add_data_ta']);
        $routes->post('save_data_ta', 'Ta::save_data_ta', ['as' => 'admin.save_data_ta']);
        $routes->get('toggleStatus/(:num)', 'Ta::toggleStatus/$1', ['as' => 'admin.toggleStatus']);
        $routes->get('edit_data_ta/(:any)', 'Ta::edit_ta/$1', ['as' => 'admin.edit.ta']);
        $routes->post('update_data_ta/(:any)', 'Ta::update_ta/$1', ['as' => 'admin.update.data.ta']);
        $routes->get('hapus_data_ta/(:any)', 'Ta::delete_ta/$1', ['as' => 'admin.hapus.data.ta']);


        //Crud Jurusan
        $routes->get('add_data_jurusan', 'Ta::add_data_jurusan', ['as' => 'admin.add.jurusan']);
        $routes->post('save_data_jurusan', 'Ta::save_data_jurusan', ['as' => 'admin.save.data.jurusan']);
        $routes->get('edit_data_jurusan/(:any)', 'Ta::edit_jurusan/$1', ['as' => 'admin.edit.jurusan']);
        $routes->post('update_data_jurusan/(:any)', 'Ta::update_jurusan/$1', ['as' => 'admin.update.data.jurusan']);
        $routes->get('hapus_data_jurusan/(:any)', 'Ta::delete_jurusan/$1', ['as' => 'admin.hapus.data.jurusan']);

        //Crud Prodi
        $routes->get('add_data_prodi', 'Ta::add_data_prodi', ['as' => 'admin.add.prodi']);
        $routes->post('save_data_prodi', 'Ta::save_data_prodi', ['as' => 'admin.save.data.prodi']);
        $routes->get('edit_data_prodi/(:any)', 'Ta::edit_prodi/$1', ['as' => 'admin.edit.prodi']);
        $routes->post('update_data_prodi/(:any)', 'Ta::update_prodi/$1', ['as' => 'admin.update.data.prodi']);
        $routes->get('hapus_data_prodi/(:any)', 'Ta::delete_prodi/$1', ['as' => 'admin.hapus.data.prodi']);

        //Crud Unit
        $routes->get('add_data_unit', 'Ta::add_data_unit', ['as' => 'admin.add.unit']);
        $routes->post('save_data_unit', 'Ta::save_data_unit', ['as' => 'admin.save.data.unit']);
        $routes->get('edit_data_unit/(:any)', 'Ta::edit_unit/$1', ['as' => 'admin.edit.unit']);
        $routes->post('update_data_unit/(:any)', 'Ta::update_unit/$1', ['as' => 'admin.update.data.unit']);
        $routes->get('hapus_data_unit/(:any)', 'Ta::delete_unit/$1', ['as' => 'admin.hapus.data.unit']);

        //Crud User
        $routes->get('add_data_user', 'User::add_data_user', ['as' => 'admin.add_data_user']);
        $routes->post('save_data_user', 'User::save_data_user', ['as' => 'admin.save_data_user']);
        $routes->get('edit_data_user/(:any)', 'User::edit_user/$1', ['as' => 'admin.edit.user']);
        $routes->post('update_data_user/(:any)', 'User::update_user/$1', ['as' => 'admin.update.data.user']);
        $routes->get('hapus_data_user/(:any)', 'User::delete_user/$1', ['as' => 'admin.hapus.data.user']);

        //Jadwal
        $routes->get('hapus_data_jadwal/(:num)', 'Jadwal::delete_jadwal/$1', ['as' => 'admin.hapus.data.jadwal']);
    });



    $routes->group('', ['filter' => 'cifilter:guest'], static function ($routes) {
        //login
        $routes->get('login', 'AuthController::loginForm', ['as' => 'admin.login.form']);
        $routes->post('login', 'AuthController::loginHandler', ['as' => 'admin.login.handler']);

        //register
        $routes->get('register', 'Register::registerForm', ['as' => 'admin.register']);
        $routes->post('register', 'Register::saveForm', ['as' => 'admin.save']);
        $routes->view('home-user', 'view-users/home', ['as' => 'home.user']);

        //Jadwal Reguler
        $routes->get('jadwal-user', 'Jadwal::reguler_jadwal', ['as' => 'user.jadwal']);
        $routes->get('jadwal-add', 'Jadwal::add_jadwal', ['as' => 'user.add.jadwal']);
        $routes->post('jadwal-ajax-3', 'Jadwal::getJamByRuangan3', ['as' => 'user.ajax.jadwal-3']);
        $routes->post('jadwal-save', 'Jadwal::save_jadwal', ['as' => 'user.save.jadwal']);

        //Non reguler
        $routes->get('jadwal-nonreguler', 'Jadwal::nonReguler_jadwal', ['as' => 'user.nonreguler']);
        $routes->get('jadwal-add-nonreguler', 'Jadwal::add_nonReguler', ['as' => 'user.jadwal.nonreguler']);
        $routes->post('jadwal-save-nonreguler', 'Jadwal::save_nonReguler', ['as' => 'user.save.nonreguler']);
        $routes->post('jadwal-ajax', 'Jadwal::getJamByRuangan', ['as' => 'user.ajax.jadwal']);

        //UAS
        $routes->get('jadwal-uas', 'Jadwal::jadwal_UAS', ['as' => 'user.uas']);
        $routes->get('jadwal-add-uas', 'Jadwal::add_uas', ['as' => 'user.jadwal.uas']);
        $routes->post('jadwal-save-uas', 'Jadwal::save_uas', ['as' => 'user.save.uas']);
        $routes->post('jadwal-ajax-1', 'Jadwal::getJamByRuangan1', ['as' => 'user.ajax.jadwal-1']);

        // UTS
        $routes->get('jadwal-uts', 'Jadwal::jadwal_UTS', ['as' => 'user.uts']);
        $routes->get('jadwal-add-uts', 'Jadwal::add_uts', ['as' => 'user.jadwal.uts']);
        $routes->post('jadwal-save-uts', 'Jadwal::save_uts', ['as' => 'user.save.uts']);
        $routes->post('jadwal-ajax-2', 'Jadwal::getJamByRuangan2', ['as' => 'user.ajax.jadwal-2']);
    });
});

