<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-03-10 08:27:41 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view some/view/file.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-03-10 12:07:22 --- ERROR: ErrorException [ 2048 ]: Non-static method Modmanager_Autoloader::test() should not be called statically ~ APPPATH\modules\ic_core\modmanager\init.php [ 5 ]
2011-03-10 12:08:11 --- ERROR: ErrorException [ 2048 ]: Non-static method Modmanager_Autoloader::test() should not be called statically ~ APPPATH\modules\ic_core\modmanager\init.php [ 3 ]
2011-03-10 12:08:52 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_ECHO, expecting ';' or '{' ~ APPPATH\modules\ic_core\modmanager\classes\modmanager\autoloader.php [ 7 ]
2011-03-10 14:42:29 --- ERROR: ErrorException [ 2048 ]: Non-static method Modmanager_Autoloader::test() should not be called statically ~ APPPATH\modules\ic_core\modmanager\init.php [ 4 ]
2011-03-10 14:51:51 --- ERROR: Http_Exception_404 [ 404 ]: The requested URL frontend/welcome/index/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-03-10 16:38:21 --- ERROR: ErrorException [ 1 ]: Class 'DB' not found ~ APPPATH\modules\ic_core\modmanager\classes\modmanager\loader.php [ 13 ]
2011-03-10 16:38:45 --- ERROR: ErrorException [ 2 ]: Missing argument 2 for Kohana_Database_Query_Builder_Where::where(), called in C:\xampp\htdocs\ilchcms2x\trunk\application\modules\ic_core\modmanager\classes\modmanager\loader.php on line 13 and defined ~ MODPATH\database\classes\kohana\database\query\builder\where.php [ 30 ]
2011-03-10 16:39:46 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'ilchcms2x.ic1_modmanager' doesn't exist ( SELECT `folder`, `core` FROM `ic1_modmanager` WHERE `active` = 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-03-10 16:44:32 --- ERROR: ErrorException [ 2 ]: Missing argument 1 for Kohana_Database_Result::get(), called in C:\xampp\htdocs\ilchcms2x\trunk\application\modules\ic_core\modmanager\classes\modmanager\loader.php on line 16 and defined ~ MODPATH\database\classes\kohana\database\result.php [ 182 ]
2011-03-10 17:03:40 --- ERROR: Http_Exception_404 [ 404 ]: The requested URL frontend/welcome/index/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-03-10 19:09:36 --- ERROR: ErrorException [ 2048 ]: Non-static method Kohana_Database::list_tables() should not be called statically, assuming $this from incompatible context ~ APPPATH\modules\ic_core\welcome\classes\controller\frontend\welcome\index.php [ 20 ]
2011-03-10 19:10:20 --- ERROR: ErrorException [ 1 ]: Call to undefined method DB::list_tables() ~ APPPATH\modules\ic_core\welcome\classes\controller\frontend\welcome\index.php [ 20 ]