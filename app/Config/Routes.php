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

        //Crud Hardware
        $routes->get('lab_2_hardware(:segment)', 'HardwareController::detail/$1', ['as' => 'admin.lab.2']);
        $routes->get('add_data_lab9', 'HardwareController::add_data_lab9', ['as' => 'admin.add_data_lab9']);
        $routes->post('save_data_lab9', 'HardwareController::save_data_lab9', ['as' => 'admin.save_data_lab9']);

        $routes->get('hapus_data_lab9/(:any)', 'HardwareController::delete_data_lab9/$1', ['as' => 'hapus.add_data_lab9']);
        $routes->get('edit_lab9(:any)', 'HardwareController::edit_lab9/$1', ['as' => 'edit.lab9']);
        $routes->post('update_lab9/(:any)', 'HardwareController::update_lab9/$1', ['as' => 'update.lab9']);

        //Crud Software
        $routes->get('add_data_software', 'Fasilitas::add_data_software', ['as' => 'admin.add.data.software']);
        $routes->get('hapus_data_software/(:any)', 'Fasilitas::delete_software/$1', ['as' => 'admin.hapus.data.software']);
        $routes->get('edit_data_software/(:any)', 'Fasilitas::edit_software/$1', ['as' => 'admin.edit.data.software']);
        $routes->post('update_data_software/(:any)', 'Fasilitas::update_software/$1', ['as' => 'admin.update.data.software']);
        $routes->post('save_data_software', 'Fasilitas::save_data_software', ['as' => 'admin.save.data.software']);

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
    });



    $routes->group('', ['filter' => 'cifilter:guest'], static function ($routes) {
        $routes->get('login', 'AuthController::loginForm', ['as' => 'admin.login.form']);
        $routes->post('login', 'AuthController::loginHandler', ['as' => 'admin.login.handler']);

        //register
        $routes->get('register', 'Register::registerForm', ['as' => 'admin.register']);
        $routes->post('register', 'Register::saveForm', ['as' => 'admin.save']);
    });
});
