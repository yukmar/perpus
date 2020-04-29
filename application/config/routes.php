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
$route['default_controller'] = 'dashboard/landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// dashboard
// login
$route['login'] = 'users/login';
$route['daftar'] = 'users/login/daftar';
$route['check'] = 'users/login/checknis';
$route['testing'] = 'admin/testing';
$route['testing-front'] = 'dashboard/testing';

// katalog
$route['search'] = 'buku/katalog/search_buku';
$route['katalog/list_buku'] = 'buku/katalog/list_buku';

// admin manage data user
$route['manage-user'] = 'users/kelola_users';
$route['manage-user/add'] = 'users/kelola_users/create';
$route['manage-user/edit'] = 'users/kelola_users/update';
$route['manage-user/delete'] = 'users/kelola_users/delete';
$route['manage-user/check-siswa'] = 'users/user/checknis';
$route['manage-user/check-petugas'] = 'users/user/checknip';
$route['manage-user/add-kelas'] = 'users/kelas/create';
$route['manage-user/check-kelas'] = 'users/kelas/searchkelas';
$route['manage-user/delete-kelas'] = 'users/kelas/delete';
$route['manage-user/edit-kelas'] = 'users/kelas/update';

// admin manage data books
$route['manage-buku'] = 'buku/buku';
$route['manage-buku/add'] = 'buku/buku/create';
$route['manage-buku/edit'] = 'buku/buku/update';
$route['manage-buku/delete'] = 'buku/buku/delete';
$route['manage-buku/daftar_isbn'] = 'buku/buku/daftar_isbn';
// genre
$route['manage-buku/add-genre'] = 'buku/genre/addgenre';
$route['manage-buku/delete-genre'] = 'buku/genre/deletegenre';
$route['manage-buku/edit-genre'] = 'buku/genre/updategenre';

$route['manage-buku/search'] = 'buku/pengarang/search_pengarang';
$route['manage-buku/daftar_pengarang'] = 'buku/pengarang/daftar_pengarang';

// admin manage data penerbit
$route['manage-penerbit'] = 'buku/penerbit';
$route['manage-penerbit/add'] = 'buku/penerbit/add';
$route['manage-penerbit/edit'] = 'buku/penerbit/update';
$route['manage-penerbit/delete'] = 'buku/penerbit/delete';

$route['manage-pengarang'] = 'buku/pengarang';
$route['manage-pengarang/add'] = 'buku/pengarang/create';
$route['manage-pengarang/edit'] = 'buku/pengarang/update';
$route['manage-pengarang/delete'] = 'buku/pengarang/delete';
$route['manage-pengarang/cek'] = 'buku/pengarang/checknama';

// admin item buku
$route['item-buku'] = 'buku/item_buku';
$route['item-buku/cek'] = 'buku/item_buku/cek_peminjaman';
$route['item-buku/add'] = 'buku/item_buku/create';
$route['item-buku/edit'] = 'buku/item_buku/update';
$route['item-buku/delete'] = 'buku/item_buku/delete';
$route['item-buku/detail'] = 'buku/item_buku/history';
$route['item-buku/cekkode'] = 'buku/item_buku/checkid';

$route['peminjaman'] = 'peminjaman/peminjaman';
$route['peminjaman/pinjam'] = 'peminjaman/peminjaman/create';
$route['peminjaman/cek-siswa'] = 'users/user/checknis';
$route['peminjaman/cek-ketersediaan'] = 'peminjaman/peminjaman/cek_ketersediaan';

$route['pengembalian'] = 'pengembalian/pengembalian';
$route['pengembalian/submit'] = 'pengembalian/pengembalian/kembali';
$route['pengembalian/cek-siswa'] = 'users/user/checknis';
$route['pengembalian/cek-tagihanbuku'] = 'pengembalian/pengembalian/cek_tagihan';

$route['siswa'] = 'users/siswa';
$route['siswa/edit'] = 'users/siswa/edit_profile';

$route['logout'] = 'users/user/logout';