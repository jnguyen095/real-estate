<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// Custome
defined('MAX_PAGE_ITEM')		OR define('MAX_PAGE_ITEM', 20); // max page item
defined('CAT_TYPE_SALE')		OR define('CAT_TYPE_SALE', 1); // sale category
defined('ACTIVE')				OR define('ACTIVE', 1); // active
defined('HOT_PRODUCT')			OR define('HOT_PRODUCT', 1); // active
defined('INACTIVE')				OR define('INACTIVE', 0); // inactive
defined('UPDATE')				OR define('UPDATE', 'update'); // crudaction: update
defined('DELETE')				OR define('DELETE', 'delete'); // crudaction: delete
defined('REFRESH')				OR define('REFRESH', 'refresh'); // crudaction: refresh
defined('ACTIVE_POST')			OR define('ACTIVE_POST', 'active'); // crudaction: active post
defined('INACTIVE_POST')		OR define('INACTIVE_POST', 'inactive'); // crudaction: inactive post
defined('NHADAT_BAN')			OR define('NHADAT_BAN', 'NHADAT_BAN');
defined('NHADAT_CHOTHUE')		OR define('NHADAT_CHOTHUE', 'NHADAT_CHOTHUE');


// Social IDs
defined('GOOGLE_MAP_KEY')		OR define('GOOGLE_MAP_KEY', 'AIzaSyBre7NMV7Wvgg2c37G5E9NMZnKHAHv8Qs4'); // google map key
//defined('FACEBOOK_ID')			OR define('FACEBOOK_ID', '263683937369914'); // facebook id: login by facebook, share post: local
defined('FACEBOOK_ID')			OR define('FACEBOOK_ID', '339916999763026'); // facebook id: login by facebook, share post
defined('GOOGLE_ID')			OR define('GOOGLE_ID', '425783171151-utka0e2mvtbvjievajdgpkreat5162tq.apps.googleusercontent.com'); // google key: login by google: local
//defined('GOOGLE_ID')			OR define('GOOGLE_ID', '668102068187-t0edbdgdn957ahb2idfcvgccg9c8k3p0.apps.googleusercontent.com'); // google key: login by google

//defined('GOOGLE_ANALYTIC_ID')	OR define('GOOGLE_ANALYTIC_ID', 'UA-105379684-1'); // Google Analytic production
defined('GOOGLE_ANALYTIC_ID')	OR define('GOOGLE_ANALYTIC_ID', 'UA-105379684-2'); // Google Analytic local


// Category Type
defined("CATEGORY_MENU")		OR define('CATEGORY_MENU', 1); // Category will be displayed on top menu


// Product Package
defined("PRODUCT_STANDARD")		OR define('PRODUCT_STANDARD', 5); // Free product
defined("PRODUCT_VIP_0")		OR define('PRODUCT_VIP_0', 0); // Highest priority
defined("PRODUCT_VIP_1")		OR define('PRODUCT_VIP_1', 1); // 2nd priority
defined("PRODUCT_VIP_2")		OR define('PRODUCT_VIP_2', 2); // 3th priority
defined("PRODUCT_VIP_3")		OR define('PRODUCT_VIP_3', 3); // 4th priority

// Packages cost
defined("COST_STANDARD_PER_DAY")	OR define('COST_STANDARD_PER_DAY', 0); // Free product
defined("COST_VIP_0_PER_DAY")		OR define('COST_VIP_0_PER_DAY', 10000); // Highest priority
defined("COST_VIP_1_PER_DAY")		OR define('COST_VIP_1_PER_DAY', 5000); // 2nd priority
defined("COST_VIP_2_PER_DAY")		OR define('COST_VIP_2_PER_DAY', 3000); // 3th priority
defined("COST_VIP_3_PER_DAY")		OR define('COST_VIP_3_PER_DAY', 1000); // 4th priority

// Payment Type
defined("PAYMENT_DEPOSIT")		OR define('PAYMENT_DEPOSIT', 1);
defined("PAYMENT_WITHDRAW")		OR define('PAYMENT_WITHDRAW', -1);

defined("MAX_POST_PER_DAY")		OR define('MAX_POST_PER_DAY', 3);

