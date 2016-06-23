<?php 
/**
 * @author Mike Curtis <mikecurtis1@gmail.com>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0
 */

//NOTE: turn off error reporting in production
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

// error & exception handling
require_once dirname(__FILE__) . '/lib/ExceptionHandler.php';
$exception_handler = new ExceptionHandler();
require_once dirname(__FILE__) . '/lib/ErrorHandler.php';
$error_handler = new ErrorHandler();

// load classes and interfaces
require_once dirname(__FILE__) . '/lib/autoloadClassMultipleDirectory.php';
spl_autoload_register('autoloadClassMultipleDirectory');

// load external user-defined functions
require_once dirname(__FILE__) . '/../functions/functions.php';

// get HTTP request values necessary to complete bootstrap
$module = null;
$module_config_suffix = null;
$module_controller_suffix = null;
$user_id = null;
if ( isset($_REQUEST['module']) ) {
    if ( preg_match("/\w{1,32}/i", $_REQUEST['module']) ) {
        $module = strtolower($_REQUEST['module']);
        $module_config_suffix = strtoupper($module);
        $module_controller_suffix = ucfirst($module);
    } else {
        throw new Exception('Module name must be 1-32 alephnumeric characters.' . basename(__FILE__) . ', LINE: ' . __LINE__);
    }
} else {
    throw new Exception('No module value given in the HTTP request. in FILE: ' . basename(__FILE__) . ', LINE: ' . __LINE__);
}
if ( isset($_REQUEST['user_id']) ) {
    $user_id = $_REQUEST['user_id'];
} else {
    throw new Exception('No user_id value given in the HTTP request. in FILE: ' . basename(__FILE__) . ', LINE: ' . __LINE__);
}

// instantiate config
$config = null;
$config = new Config($user_id, $module_config_suffix);

// instantiate HTTP request
$http_request = new HTTPRequest();

// set a session
if (session_id() === '') {
    session_start();
}

// instantiate view & controller
$view_name = 'View' . $module_controller_suffix;
$controller_name = 'Controller' . $module_controller_suffix;
if (class_exists($view_name)) {
    if ( class_exists($controller_name) ){
        $view = new $view_name($config, $http_request);
        $controller = new $controller_name($config, $http_request, $view);
    } else {
        echo 'controller exception';
        throw new Exception('Controller name is not an existing class file. in FILE: ' . basename(__FILE__) . ', LINE: ' . __LINE__);
    }
} else {
    echo 'view exception |' . $view_name . '|';
    throw new Exception('View name is not an existing class file. in FILE: ' . basename(__FILE__) . ', LINE: ' . __LINE__);
}
