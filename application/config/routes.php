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
$route['default_controller'] = 'frontpage/landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// frontpage
$route['login'] = 'frontpage/user/login';
$route['daftar'] = 'frontpage/user/daftar';
$route['testing'] = 'admin/testing';
$route['testing-front'] = 'frontpage/testing';
$route['landing/list_buku'] = 'frontpage/landing/list_buku';
$route['search'] = 'frontpage/landing/search_buku';
$route['check'] = 'frontpage/landing/checknis';

// katalog
$route['katalog'] = 'katalog/katalog';

// admin manage data user
$route['manage-user'] = 'admin/user';
$route['manage-user/add'] = 'admin/user/create';
$route['manage-user/edit'] = 'admin/user/update';
$route['manage-user/delete'] = 'admin/user/delete';
$route['manage-user/check-siswa'] = 'admin/user/checknis';
$route['manage-user/check-petugas'] = 'admin/user/checknip';
$route['manage-user/add-kelas'] = 'admin/user/addkelas';
$route['manage-user/check-kelas'] = 'admin/user/searchkelas';
$route['manage-user/delete-kelas'] = 'admin/user/deletekelas';
$route['manage-user/edit-kelas'] = 'admin/user/editkelas';

// admin manage data books
$route['manage-buku'] = 'admin/buku';
$route['manage-buku/addinfo'] = 'admin/buku/addinfo';
$route['manage-buku/additem'] = 'admin/buku/additem';
$route['manage-buku/edit'] = 'admin/buku/update';
$route['manage-buku/delete'] = 'admin/buku/delete';
$route['manage-buku/daftar_pengarang'] = 'admin/buku/daftar_pengarang';
$route['manage-buku/daftar_isbn'] = 'admin/buku/daftar_isbn';
$route['manage-buku/search'] = 'admin/buku/search';
$route['manage-buku/add-genre'] = 'admin/buku/addgenre';
$route['manage-buku/delete-genre'] = 'admin/buku/deletegenre';
$route['manage-buku/edit-genre'] = 'admin/buku/editgenre';

// admin manage data penerbit
$route['manage-penerbit'] = 'admin/penerbit';
$route['manage-penerbit/add'] = 'admin/penerbit/add';
$route['manage-penerbit/edit'] = 'admin/penerbit/update';
$route['manage-penerbit/delete'] = 'admin/penerbit/delete';

$route['manage-pengarang'] = 'admin/pengarang';
$route['manage-pengarang/edit'] = 'admin/pengarang/update';
$route['manage-pengarang/delete'] = 'admin/pengarang/delete';
$route['manage-pengarang/add'] = 'admin/pengarang/create';
$route['manage-pengarang/cek'] = 'admin/pengarang/checknama';

// admin item buku
$route['item-buku'] = 'admin/item_buku';
$route['item-buku/cek'] = 'admin/item_buku/cek_peminjaman';
$route['item-buku/add'] = 'admin/item_buku/create';
$route['item-buku/edit'] = 'admin/item_buku/edit';
$route['item-buku/delete'] = 'admin/item_buku/delete';
$route['item-buku/detail'] = 'admin/item_buku/history';
$route['item-buku/cekkode'] = 'admin/item_buku/checkid';

$route['peminjaman'] = 'admin/peminjaman';
$route['peminjaman/pinjam'] = 'admin/peminjaman/create';
$route['peminjaman/cek-siswa'] = 'admin/peminjaman/cek_nis';
$route['peminjaman/cek-ketersediaan'] = 'admin/peminjaman/cek_ketersediaan';

$route['pengembalian'] = 'admin/pengembalian';
$route['pengembalian/submit'] = 'admin/pengembalian/kembali';
$route['pengembalian/cek-siswa'] = 'admin/pengembalian/cek_nis';
$route['pengembalian/cek-tagihanbuku'] = 'admin/pengembalian/cek_tagihan';

$route['siswa'] = 'user/user';

$route['logout'] = 'admin/user/logout';