<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


define('URL_DELIMITER', '-');

define('BERKAS_LENGKAP', 1);
define('BERKAS_APPROVED', 2);
define('BERKAS_REJECT', 3);

define('ID_GROUP_PELAYANAN_UMUM', 4);
define('ID_GROUP_PELAYANAN_KESEHATAN', 1);
define('ID_GROUP_PELAYANAN_DULCAPIL', 7);

define('STATUS_DAFTARTAMU', 1);
define('STATUS_BERKASLAYANAN', 2);
define('STATUS_FORMISIAN', 3);
define('STATUS_APPROVAL', 4);
define('STATUS_CETAK', 5);

define('LAYANAN_UNCOMPLETE', 0);
define('LAYANAN_COMPLETE', 1);

define('LAYANAN_UNSKIP', 0);
define('LAYANAN_SKIP', 1);

define('TYPE_PERSYARATAN_BADANHUKUM', 1);
define('TYPE_PERSYARATAN_DIKUASAKAN', 2);
define('TYPE_PERSYARATAN_PROPOSALTEKNIS', 3);
define('TYPE_PERSYARATAN_TANAHBANGUNANSEWA', 4);

define('ID_LAYANAN_BADAN_USAHA', 36);
define('ID_LAYANAN_DOKTER_GIGI_FASILITAS', 3);
define('ID_LAYANAN_DOKTER_GIGI_PERORANGAN', 4);
define('ID_LAYANAN_DOKTER_UMUM_FASILITAS', 5);
define('ID_LAYANAN_DOKTER_UMUM_PERORANGAN', 6);
define('ID_LAYANAN_N_1', 59);
define('ID_LAYANAN_N_2', 60);
define('ID_LAYANAN_N_4', 61);
define('ID_LAYANAN_N_6', 62);

define('ID_LAYANAN_KARTU_KUNING', 11);

define('ID_LAYANAN_RETRIBUSI', 63);