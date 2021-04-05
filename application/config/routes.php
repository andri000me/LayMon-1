<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
/*
* API Routing
*/
$route['apilm'] = 'api';
$route['apilm/profile'] = 'api/profile';
$route['apilm/mobil/simpan'] = 'api/mastermobil_create';
$route['apilm/mobil/baca'] = 'api/mastermobil_read';
$route['apilm/mobil/ubah'] = 'api/mastermobil_update';
$route['apilm/supir/simpan'] = 'api/mastersupir_create';
$route['apilm/supir/baca'] = 'api/mastersupir_read';
$route['apilm/supir/ubah'] = 'api/mastersupir_update';
$route['apilm/supir/ubahuser'] = 'api/mastersupir_updateUser';
$route['apilm/pelanggan/simpan'] = 'api/masterpelanggan_create';
$route['apilm/pelanggan/baca'] = 'api/masterpelanggan_read';
$route['apilm/pelanggan/ubah'] = 'api/masterpelanggan_update';
$route['apilm/pelanggan/ubahuser'] = 'api/masterpelanggan_updateUser';
$route['apilm/user/simpan'] = 'api/masteruser_create';
$route['apilm/user/baca'] = 'api/masteruser_read';
$route['apilm/user/ubah'] = 'api/masteruser_update';
$route['apilm/pengiriman/pemetaanmap'] = 'api/pengiriman_dataMap';
$route['apilm/pengiriman/created/baca'] = 'api/pengirimanCreated_read';
$route['apilm/pengiriman/confirmed/baca'] = 'api/pengirimanConfirmed_read';
$route['apilm/pengiriman/approved/baca'] = 'api/pengirimanApproved_read';
$route['apilm/pengiriman/simpan'] = 'api/pengiriman_create';
$route['apilm/pengiriman/ubah'] = 'api/pengiriman_update';
$route['apilm/pengiriman/track/simpan'] = 'api/pengirimanTrack_create';
// Level One - Admin
$route['laymon/profile'] = 'user/profile';
$route['laymon'] = 'admin';
$route['laymon/mobil'] = 'admin/mobil_read';
$route['laymon/mobil/create'] = 'admin/mobil_create';
$route['laymon/mobil/view/(:num)'] = 'admin/mobil_update/$1';
$route['laymon/mobil/delete/(:num)'] = 'admin/mobil_delete/$1';
$route['laymon/supir'] = 'admin/supir_read';
$route['laymon/supir/create'] = 'admin/supir_create';
$route['laymon/supir/view/(:num)'] = 'admin/supir_update/$1';
$route['laymon/supir/upuser/(:num)'] = 'admin/supir_updateUser/$1';
$route['laymon/supir/delete/(:num)'] = 'admin/supir_delete/$1';
$route['laymon/pelanggan'] = 'admin/pelanggan_read';
$route['laymon/pelanggan/create'] = 'admin/pelanggan_create';
$route['laymon/pelanggan/view/(:num)'] = 'admin/pelanggan_update/$1';
$route['laymon/pelanggan/upuser/(:num)'] = 'admin/pelanggan_updateUser/$1';
$route['laymon/pelanggan/delete/(:num)'] = 'admin/pelanggan_delete/$1';
$route['laymon/user'] = 'admin/user_read';
$route['laymon/user/create'] = 'admin/user_create';
$route['laymon/user/view/(:num)'] = 'admin/user_update/$1';
$route['laymon/user/delete/(:num)'] = 'admin/user_delete/$1';
$route['laymon/user/reset/(:num)'] = 'admin/user_resetPass/$1';
$route['laymon/pengiriman/(:any)'] = 'admin/pengiriman_Data/$1';
$route['laymon/pengiriman/created/agree/(:num)'] = 'admin/pengiriman_createdApprove/$1';
$route['laymon/pengiriman/confirmed/agree/(:num)'] = 'admin/pengiriman_confirmedApprove/$1';
// Level Two - Supir
$route['supmon/profile'] = 'user/profile';
$route['supmon'] = 'supir';
$route['supmon/pengiriman/(:any)'] = 'supir/pengiriman_Data/$1';
$route['supmon/pengiriman/view/(:num)'] = 'supir/mon_edit/$1';
$route['supmon/pengiriman/delete/(:num)'] = 'supir/mon_delete/$1';
$route['supmon/monitoring/live/(:num)'] = 'supir/livemonitoring/$1';
$route['supmon/pengiriman/arrived/(:num)'] = 'supir/pengiriman_arrivedApprove/$1';
// Level Two - Pelanggan
$route['pelmon/profile'] = 'user/profile';
// Default
$route['default_controller'] = 'user/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
