<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


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

        $routes->get('hapus_data_kritik/(:any)', 'User::delete_kritik/$1', ['as' => 'admin.hapus.data.kritik']);

        $routes->get('lab_hardware/(:segment)', 'HardwareController::detail/$1', ['as' => 'admin.lab.2']);
        $routes->get('detail_fasilitas/(:num)', 'Fasilitas::detailFasilitas/$1', ['as' => 'detail.fasilitas']);

        //pdf
        $routes->get('hardware_export/(:num)', 'PdfController::exportHardware/$1', ['as' => 'hardware.export.pdf']);
        $routes->get('pdf_export/(:num)', 'PdfController::exportPDF/$1', ['as' => 'admin.export.pdf']);
        $routes->get('software_export/(:num)', 'PdfController::exportSoftware/$1', ['as' => 'software.export.pdf']);
        $routes->get('ruangan_export', 'PdfController::exportRuangan', ['as' => 'ruangan.export.pdf']);
        $routes->get('barang_export', 'PdfController::exportBarang', ['as' => 'barang.export.pdf']);
        $routes->get('ta_export', 'PdfController::exportTA', ['as' => 'ta.export.pdf']);
        $routes->get('jurusan_export', 'PdfController::exportJurusan', ['as' => 'jurusan.export.pdf']);
        $routes->get('prodi_export', 'PdfController::exportProdi', ['as' => 'prodi.export.pdf']);
        $routes->get('unit_export', 'PdfController::exportUnit', ['as' => 'unit.export.pdf']);
        $routes->get('user_export', 'PdfController::exportUser', ['as' => 'user.export.pdf']);
        $routes->get('kritik_export', 'PdfController::exportKritik', ['as' => 'kritik.export.pdf']);
        $routes->get('pegawai_export', 'PdfController::exportPegawai', ['as' => 'pegawai.export.pdf']);
        $routes->get('siswa_export', 'PdfController::exportSiswa', ['as' => 'siswa.export.pdf']);


        //pdf jadwal admin
        $routes->get('jadwal_export', 'PdfController::exportJadwal', ['as' => 'jadwal.export.pdf']);
        $routes->get('jadwal_nonreguler', 'PdfController::exportJadwalNonReguler', ['as' => 'jadwal.nonreguler.pdf']);
        $routes->get('jadwal_uas', 'PdfController::exportJadwalUAS', ['as' => 'jadwal.uas.pdf']);
        $routes->get('jadwal_uts', 'PdfController::exportJadwalUTS', ['as' => 'jadwal.uts.pdf']);



        //Excel export
        $routes->get('jadwal_excel/(:segment)', 'ExcelController::index/$1', ['as' => 'export.reguler.excel']);
        $routes->get('excel_filterHari/(:segment)/(:segment)', 'ExcelController::filterHari/$1/$2', ['as' => 'export.regulerFilter.excel']);
        $routes->get('excel_filterJam/(:segment)/(:segment)', 'ExcelController::filterJam/$1/$2', ['as' => 'export.regulerJam.excel']);
        $routes->get('excel_Software/(:segment)', 'ExcelController::filterSoftware/$1', ['as' => 'export.software.excel']);
        $routes->get('excel_Hardware/(:segment)', 'ExcelController::filterHardware/$1', ['as' => 'export.hadrware.excel']);



        //Data Akademik
        $routes->get('data_akademik', 'Ta::index', ['as' => 'admin.data.akademik']);
        $routes->get('jurusan', 'Ta::jurusan', ['as' => 'admin.jurusan']);
        $routes->get('prodi', 'Ta::prodi', ['as' => 'admin.prodi']);
        $routes->get('unit', 'Ta::unit', ['as' => 'admin.unit']);
        $routes->get('users', 'User::index', ['as' => 'admin.users']);
        $routes->get('kritik', 'User::kritik', ['as' => 'admin.kritik']);

        //Crud Hardware Baru
        $routes->get('detail_fasilitas_hardware/(:num)', 'Fasilitas::detailFasilitasHardware/$1', ['as' => 'detail.fasilitas.hardware']);
        $routes->post('detail_fasilitas_hardware/(:num)', 'Fasilitas::detailFasilitasHardware/$1', ['as' => 'detail.fasilitas.hardware']);
        $routes->get('add_data_hardware/(:num)', 'Fasilitas::add_data_hardware/$1', ['as' => 'admin.data.hardware']);
        $routes->get('hapus_data_hardware/(:any)', 'Fasilitas::delete_hardware/$1', ['as' => 'admin.hapus.data.hardware']);
        $routes->get('edit_data_hardware/(:any)', 'Fasilitas::edit_hardware/$1', ['as' => 'admin.edit.data.hardware']);
        $routes->post('update_data_hardware/(:any)', 'Fasilitas::update_hardware/$1', ['as' => 'admin.update.data.hardware']);
        $routes->post('save_data_hardware', 'Fasilitas::save_data_hardware', ['as' => 'admin.save.hardware']);


        //Crud Software
        $routes->get('add_data_software/(:num)', 'Fasilitas::add_data_software/$1', ['as' => 'admin.data.software']);
        $routes->get('hapus_data_software/(:any)', 'Fasilitas::delete_software/$1', ['as' => 'admin.hapus.data.software']);
        $routes->get('edit_data_software/(:any)', 'Fasilitas::edit_software/$1', ['as' => 'admin.edit.data.software']);
        $routes->post('update_data_software/(:any)', 'Fasilitas::update_software/$1', ['as' => 'admin.update.data.software']);
        $routes->post('save_data_software', 'Fasilitas::save_data_software', ['as' => 'admin.save.software']);
        $routes->post('detail_fasilitas/(:num)', 'Fasilitas::detailFasilitas/$1', ['as' => 'detail.fasilitas']);
        //Crud Barang
        $routes->get('add_data_barang', 'Fasilitas::add_data_barang', ['as' => 'admin.add.barang']);
        $routes->get('edit_data_barang/(:any)', 'Fasilitas::edit_barang/$1', ['as' => 'admin.edit.barang']);
        $routes->post('save_data_barang', 'Fasilitas::save_data_barang', ['as' => 'admin.save.data.barang']);
        $routes->post('update_data_barang/(:any)', 'Fasilitas::update_barang/$1', ['as' => 'admin.update.data.barang']);
        $routes->get('hapus_data_barang/(:any)', 'Fasilitas::delete_barang/$1', ['as' => 'admin.hapus.data.barang']);
        $routes->post('barang', 'Fasilitas::barang', ['as' => 'admin.barang']);

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

        //Jadwal Admin Reguler
        $routes->get('hapus_data_jadwal/(:num)', 'JadwalAdmin::deleteJadwal/$1', ['as' => 'admin.hapus.data.jadwal']);
        $routes->get('jadwal', 'JadwalAdmin::index', ['as' => 'admin.jadwal']);
        $routes->post('jadwal', 'JadwalAdmin::index', ['as' => 'admin.jadwal']);
        $routes->get('jadwal-edit/(:num)', 'JadwalAdmin::edit_reguler/$1', ['as' => 'admin.jadwal.edit']);
        $routes->post('jadwal-update/(:num)', 'JadwalAdmin::update_reguler/$1', ['as' => 'admin.jadwal.update']);


        $routes->post('jadwal-ajax-admin', 'JadwalAdmin::getJamByRuangan', ['as' => 'user.ajax.jadwal.admin']);

        //Jadwal Admin Non Reguler
        $routes->get('jadwal-non-reguler', 'JadwalAdmin::jadwalNonReguler', ['as' => 'admin.jadwal.nonR']);
        $routes->post('jadwal-non-reguler', 'JadwalAdmin::jadwalNonReguler', ['as' => 'admin.jadwal.nonR']);

        //Jadwal Admin UAS
        $routes->get('jadwal-uas', 'JadwalAdmin::jadwalUAS', ['as' => 'admin.jadwal.uas']);
        $routes->post('jadwal-uas', 'JadwalAdmin::jadwalUAS', ['as' => 'admin.jadwal.uas']);

        //Jadwal Admin UTS
        $routes->get('jadwal-uts', 'JadwalAdmin::jadwalUTS', ['as' => 'admin.jadwal.uts']);
        $routes->post('jadwal-uts', 'JadwalAdmin::jadwalUTS', ['as' => 'admin.jadwal.uts']);

    });



    $routes->group('', ['filter' => 'cifilter:guest'], static function ($routes) {
        //login
        $routes->get('/', 'AuthController::loginForm', ['as' => 'admin.login.form']);
        $routes->get('login', 'AuthController::loginForm', ['as' => 'admin.login.form']);
        $routes->post('login', 'AuthController::loginHandler', ['as' => 'admin.login.handler']);
        $routes->get('forgot-password', 'AuthController::forgotForm', ['as' => 'admin.forgot.password']);
        $routes->post('forgot-password', 'AuthController::sendPasswordResetLink', ['as' => 'admin.send_password_reset_link']);
        $routes->get('password/reset/(:any)', 'AuthController::resetPassword/$1', ['as' => 'admin.reset-password']);
        $routes->post('reset-password-handler/(:any)', 'AuthController::resetPasswordHandler/$1', ['as' => 'reset-password-handler']);

        //register
        $routes->get('register', 'Register::registerForm', ['as' => 'admin.register']);
        $routes->post('register', 'Register::saveForm', ['as' => 'admin.save']);




    });
});

$routes->view('/', 'view-users/home', ['as' => 'home.user']);

$routes->group('user', static function ($routes) {

    $routes->view('home-user', 'view-users/home', ['as' => 'home.user']);
    $routes->get('usgaleri-user', 'Galeri::index', ['as' => 'user.galeri']);
    $routes->get('usdatapg-user', 'Usdatapg::index', ['as' => 'user.usdatapg']);
    $routes->get('usdatasis-user', 'Usdatasis::index', ['as' => 'user.usdatasis']);
    $routes->get('usfasilitas-user', 'Usfasilitas::index', ['as' => 'user.usfasilitas']);
    $routes->get('kontak-user', 'User::add_data_kritik', ['as' => 'user.kontak']);
    $routes->post('save_data_kritik', 'User::save_data_kritik', ['as' => 'user.save.data.kritik']);
    $routes->get('jadwal-user', 'Jadwal::reguler_jadwal', ['as' => 'user.jadwal']);
    $routes->get('jadwal-nonreguler', 'Jadwal::nonReguler_jadwal', ['as' => 'user.nonreguler']);
    $routes->get('jadwal-uas', 'Jadwal::jadwal_UAS', ['as' => 'user.uas']);
    $routes->get('jadwal-uts', 'Jadwal::jadwal_UTS', ['as' => 'user.uts']);

    $routes->group('', ['filter' => 'cifilter:login'], static function ($routes) {


        $routes->get('logout', 'AdminController::logoutUserHandler', ['as' => 'user.logout']);

        //Jadwal Reguler

        $routes->get('jadwal-add/(:num)', 'Jadwal::add_jadwal/$1', ['as' => 'user.add.jadwal']);
        $routes->post('jadwal-ajax-3', 'Jadwal::getJamByRuangan3', ['as' => 'user.ajax.jadwal-3']);
        $routes->post('jadwal-save', 'Jadwal::save_jadwal', ['as' => 'user.save.jadwal']);
        $routes->get('jadwal-prodi-reguler/(:num)', 'Jadwal::tabelReguler/$1', ['as' => 'user.reguler.jadwal']);
        $routes->get('hapus-prodi-reguler/(:num)', 'Jadwal::deleteProdiReguler/$1', ['as' => 'user.hapus.prodi']);

        //Non reguler

        $routes->get('jadwal-add-nonreguler/(:num)', 'Jadwal::add_nonReguler/$1', ['as' => 'user.jadwal.nonreguler']);
        $routes->post('jadwal-save-nonreguler', 'Jadwal::save_nonReguler', ['as' => 'user.save.nonreguler']);
        $routes->post('jadwal-ajax', 'Jadwal::getJamByRuangan', ['as' => 'user.ajax.jadwal']);
        $routes->get('jadwal-prodi-nonreguler/(:num)', 'Jadwal::tabelNonReguler/$1', ['as' => 'user.nonreguler.jadwal']);
        $routes->get('hapus-prodi-nonreguler/(:num)', 'Jadwal::deleteProdiNonReguler/$1', ['as' => 'user.hapus.prodi']);

        //UAS

        $routes->get('jadwal-add-uas/(:num)', 'Jadwal::add_uas/$1', ['as' => 'user.jadwal.uas']);
        $routes->post('jadwal-save-uas', 'Jadwal::save_uas', ['as' => 'user.save.uas']);
        $routes->post('jadwal-ajax-1', 'Jadwal::getJamByRuangan1', ['as' => 'user.ajax.jadwal-1']);
        $routes->get('jadwal-prodi-uas/(:num)', 'Jadwal::tabelUAS/$1', ['as' => 'user.uas.jadwal']);
        $routes->get('hapus-prodi-uas/(:num)', 'Jadwal::deleteProdiUAS/$1', ['as' => 'user.hapus.prodi']);

        // UTS

        $routes->get('jadwal-add-uts/(:num)', 'Jadwal::add_uts/$1', ['as' => 'user.jadwal.uts']);
        $routes->post('jadwal-save-uts', 'Jadwal::save_uts', ['as' => 'user.save.uts']);
        $routes->post('jadwal-ajax-2', 'Jadwal::getJamByRuangan2', ['as' => 'user.ajax.jadwal-2']);
        $routes->get('jadwal-prodi-uts/(:num)', 'Jadwal::tabelUTS/$1', ['as' => 'user.uts.jadwal']);
        $routes->get('hapus-prodi-uts/(:num)', 'Jadwal::deleteProdiUTS/$1', ['as' => 'user.hapus.prodi']);


        //PDF JADWAl USERS
        $routes->get('prodi-reguler/(:num)', 'PdfController::exportProdiReguler/$1', ['as' => 'reguler.export.pdf']);
        $routes->get('prodi-nonreguler/(:num)', 'PdfController::exportProdiNonReguler/$1', ['as' => 'nonreguler.export.pdf']);
        $routes->get('prodi-uas/(:num)', 'PdfController::exportProdiUAS/$1', ['as' => 'uas.export.pdf']);
        $routes->get('prodi-uts/(:num)', 'PdfController::exportProdiUTS/$1', ['as' => 'uts.export.pdf']);
        $routes->get('prodi-jadwal-reguler', 'PdfController::exportJadwalUser', ['as' => 'jadwal.reguler.export.pdf']);

        //Excel Jadwal
        $routes->get('excel_Reguler', 'ExcelController::jadwalReguler', ['as' => 'export.jadwal-reguler.excel']);

        //Pengajuan
        $routes->get('ajukan-jadwal', 'Jadwal::ajukanJadwal', ['as' => 'user.ajukan']);


    });



    $routes->group('', ['filter' => 'cifilter:coba'], static function ($routes) {
        $routes->get('login', 'AuthController::loginUserForm', ['as' => 'user.login.form']);
        $routes->post('login', 'AuthController::loginUserHandler', ['as' => 'user.login.handler']);

        $routes->get('forgot-user', 'AuthController::forgotFormUser', ['as' => 'user.forgot.password']);
        $routes->post('forgot-user', 'AuthController::sendPasswordResetLinkUser', ['as' => 'user.send_password_reset_link']);
        $routes->get('password-user/reset/(:any)', 'AuthController::resetPasswordUser/$1', ['as' => 'user.reset-password']);
        $routes->post('reset-password-handler-user/(:any)', 'AuthController::resetPasswordHandlerUser/$1', ['as' => 'user-reset-password-handler']);
    });


});

$routes->group('display', static function ($routes) {

    $routes->get('/', 'DisplayJadwal::display1', ['as' => 'home.display']);
    $routes->get('reguler', 'DisplayJadwal::regulerDisplay', ['as' => 'display.reguler']);
    $routes->get('alljadwal', 'DisplayJadwal::allJadwal', ['as' => 'display.all']);
    $routes->get('fetch-updated-jadwal', 'DisplayJadwal::fetchUpdatedJadwal', ['as' => 'display.fetchUpdatedJadwal']);


    $routes->get('hariselasa', 'DisplayJadwal::hariSelasa', ['as' => 'display.selasa']);
    $routes->get('harirabu', 'DisplayJadwal::hariRabu', ['as' => 'display.rabu']);
    $routes->get('harikamis', 'DisplayJadwal::hariKamis', ['as' => 'display.kamis']);
    $routes->get('harijumat', 'DisplayJadwal::hariJumat', ['as' => 'display.jumat']);

});
