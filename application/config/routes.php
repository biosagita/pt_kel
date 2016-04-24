<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.  
| 
*/

/* Routing untuk Backstage */
$route['backend/adminusers'] 	= "backend_adminusers/adminusers";
$route['backend/layanan'] 	= "backend_layanan/backend_layanan";
$route['backend/persyaratan-layanan'] 	= "backend_persyaratanlayanan/backend_persyaratanlayanan";
$route['backend/group-layanan'] 	= "backend_grouplayanan/backend_grouplayanan";
$route['backend/berkas-layanan'] 	= "backend_berkaslayanan/backend_berkaslayanan";
$route['backend/company-profile'] 	= "backend_companyprofile/backend_companyprofile";
$route['backend/template-sertifikat'] 	= "backend_templatesertifikat/backend_templatesertifikat";

$route['backend/report-rekap-mingguan'] 	= "backend_reportrekapmingguan/reportrekapmingguan";
$route['backend/report-izin'] 	= "backend_reportizin/reportizin";

$route['backend'] 			= "backend_adminusers/adminusers";
$route['backend/login'] 	= "backend_login/login";

$route['default_controller'] = "frontend_home/home";
$route['home'] = "frontend_home/home";

$route['daftar-tamu/lists'] = "frontend_daftartamu/daftartamu/lists";
$route['daftar-tamu/(:any)'] = "frontend_daftartamu/daftartamu/index/$1";
$route['daftar-tamu/lists_skip'] = "frontend_daftartamu/daftartamu/lists_skip";

$route['daftar-tamu-non-layanan'] = "frontend_daftartamunonlayanan/daftartamunonlayanan";
$route['daftar-tamu-non-layanan/lists'] = "frontend_daftartamunonlayanan/daftartamunonlayanan/lists";

$route['skip-daftar-tamu/(:any)'] = "frontend_daftartamu/daftartamu/skip/$1";
$route['unskip-daftar-tamu/(:any)'] = "frontend_daftartamu/daftartamu/unskip/$1";

$route['login'] 	= "frontend_login/login";
$route['logout'] 	= "frontend_logout/logout";

$route['layanan/(:any)'] = "frontend_layanan/layanan/index/$1";

$route['berkas-layanan/edit/(:any)'] = "frontend_layanan/layanan/edit/$1";
$route['berkas-layanan/form/(:any)'] = "frontend_layanan/layanan/formisian/$1";
$route['berkas-layanan/form-edit/(:any)'] = "frontend_layanan/layanan/formisianedit/$1";
$route['berkas-layanan/approved/(:any)'] = "frontend_layanan/layanan/approved/$1";
$route['berkas-layanan/reject/(:any)'] = "frontend_layanan/layanan/reject/$1";
$route['berkas-layanan/unapproved/(:any)'] = "frontend_layanan/layanan/unapproved/$1";
$route['berkas-layanan/sertifikat/(:any)'] = "frontend_layanan/layanan/sertifikat/$1";
$route['berkas-layanan/finish/(:any)'] = "frontend_layanan/layanan/finish/$1";
$route['berkas-layanan/delete/(:any)'] = "frontend_layanan/layanan/delete/$1";

$route['list-berkas-layanan/(:any)'] = "frontend_layanan/layanan/listberkaslayanan/$1";

$route['list-notif-layanan'] = "frontend_layanan/layanan/listnotiflayanan";

$route['form-isian/(:any)'] = "frontend_formisian/formisian/index/$1";

$route['report-rekap-mingguan/excel'] = "backend_reportrekapmingguan/reportrekapmingguan/export_excel";
$route['report-izin/excel'] = "backend_reportizin/reportizin/export_excel";

$route['user-layanan'] = "frontend_user/user";
$route['user-layanan/form'] = "frontend_user/user/form";
$route['user-layanan/success'] = "frontend_user/user/success";

$route['state-daftar-tamu/(:any)'] = "frontend_daftartamu/daftartamu/state_daftartamu/$1";
$route['state-berkas-layanan/(:any)'] = "frontend_daftartamu/daftartamu/state_berkaslayanan/$1";

$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */