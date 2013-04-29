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

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| My Constants
|--------------------------------------------------------------------------
|
*/
define('USER_IMG_WIDTH',100);
define('USER_IMG_HEIGHT',100);
define('BTN_ADD','เพิ่มรายการ');
define('BTN_EDIT','แก้ไข');
define('BTN_DELETE','ลบ');
define('BTN_SUBMIT','ตกลง');

define('NOTICE_CONFIRM_DELETE', 'ยืนยันการลบ');
define('NOTICE_CONFIRM_LOGOUT', 'ยืนยันออกจากระบบ');
define('SAVE_DATA_COMPLATE','บันทึกข้อมูลเรียบร้อย');
define('DELETE_DATA_COMPLATE', 'ลบข้อมูลเรียร้อยแล้ว');
define('REMOVE_IMAGE_COMPLATE', 'ลบรูปภาพเรียบร้อยแล้ว');
define('LOGIN_FAIL', 'Username หรือ Password ไม่ถูกต้อง');

define('CENTRE', 1);

define("MIN_YEAR_LIST",2500);

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */