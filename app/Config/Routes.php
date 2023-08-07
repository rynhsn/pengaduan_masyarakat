<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('/', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'Dashboard::index');
    $routes->group('settings', function ($routes) {
        $routes->get('', 'Users::accountSettings');
        $routes->post('update', 'User::update');
    });
    $routes->group('menus',['filter' => 'permission:manage-menu'] , function ($routes) {
        $routes->get('', 'Menus::index');
        $routes->post('create', 'Menus::store');
        $routes->post('get', 'Menus::getMenu');
        $routes->put('update', 'Menus::update');
        $routes->delete('delete', 'Menus::destroy');
    });
    $routes->group('submenus',['filter' => 'permission:manage-menu'] , function ($routes) {
        $routes->get('', 'SubMenus::index');
        $routes->post('create', 'SubMenus::store');
        $routes->post('get', 'SubMenus::getSubMenu');
        $routes->put('update', 'SubMenus::update');
        $routes->delete('delete', 'SubMenus::destroy');
    });

    //users
    $routes->group('users', ['filter' => 'permission:manage-user'], function ($routes) {
        $routes->get('', 'Users::index');
        $routes->get('detail/(:num)', 'Users::detail/$1');
        $routes->post('update-role/(:num)', 'Users::updateRole/$1');
        $routes->post('update-email/(:num)', 'Users::updateEmail/$1');
        $routes->post('update-password/(:num)', 'Users::updatePassword/$1');
        $routes->post('update-profile/(:num)', 'Users::updateProfile/$1');
        $routes->post('create', 'Users::store');
        $routes->post('get', 'Users::getUser');
        $routes->post('activate', 'Users::activate');
        $routes->put('update', 'Users::update');
        $routes->delete('delete', 'Users::destroy');
    });

    //roles
    $routes->group('roles', ['filter' => 'permission:manage-permission'], function ($routes) {
        $routes->get('', 'Roles::index');
        $routes->get('detail/(:num)', 'Roles::detail/$1');
        $routes->post('create', 'Roles::store');
        $routes->get('get/(:num)', 'Roles::getRole/$1');
        $routes->put('update', 'Roles::update');
        $routes->delete('delete', 'Roles::destroy');
    });

    //permissions
    $routes->group('permissions', ['filter' => 'permission:manage-permission'], function ($routes) {
        $routes->get('', 'Permissions::index');
        $routes->post('create', 'Permissions::store');
        $routes->post('get', 'Permissions::getPermission');
        $routes->put('update', 'Permissions::update');
        $routes->delete('delete', 'Permissions::destroy');
    });

    //pengaduan
    $routes->group('pengaduan', ['filter' => 'permission:user-complaint'], function ($routes) {
        $routes->get('', 'Pengaduan::index');
        $routes->post('create', 'Pengaduan::store');
        $routes->get('status', 'Pengaduan::list/$1');
        $routes->get('edit/(:any)', 'Pengaduan::edit/$1');
        $routes->put('update', 'Pengaduan::update');
        $routes->get('delete/(:any)', 'Pengaduan::destroy/$1');
    });

    //pengaduan-masuk
    $routes->group('pengaduan-masuk', ['filter' => 'permission:manage-complaint'], function ($routes) {
        $routes->get('', 'PengaduanMasuk::index');
        $routes->get('detail/(:any)', 'PengaduanMasuk::detail/$1');
        $routes->post('update', 'PengaduanMasuk::update');
        $routes->get('riwayat', 'PengaduanMasuk::history');
        $routes->get('riwayat/detail/(:any)', 'PengaduanMasuk::historyDetail/$1');
    });

    //laporan
    $routes->group('laporan', ['filter' => 'permission:laporan'], function ($routes) {
        $routes->get('', 'Laporan::index');
        $routes->get('detail/(:any)', 'Laporan::detail/$1');
        $routes->post('create', 'Laporan::store');
        $routes->get('drop/(:any)', 'Laporan::drop/$1');
    });

    //pengaduan-riwayat
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
