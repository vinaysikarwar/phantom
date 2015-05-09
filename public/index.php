<?php

/**
 * Versions.
 */
define('PHALCON_VERSION_REQUIRED', '2');
define('PHP_VERSION_REQUIRED', '5.4.14');

/**
 * Check phalcon framework installation.
 */
if (!extension_loaded('phalcon')) {
    printf('Install Phalcon framework %s', PHALCON_VERSION_REQUIRED);
    exit(1);
}

/**
 * Pathes.
 */
define('DS', DIRECTORY_SEPARATOR);
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(dirname(__FILE__)));
}
if (!defined('PUBLIC_PATH')) {
    define('PUBLIC_PATH', dirname(__FILE__));
}
try {

	/**
	 * Read the configuration
	 */
	$config = include __DIR__ . "/../app/config/config.php";

	/**
	 * Read auto-loader
	 */
	include __DIR__ . "/../app/config/loader.php";
	include __DIR__ . "/../app/config/routers.php";

	/**
	 * Read services
	 */
	include __DIR__ . "/../app/config/services.php";

	/**
	 * Handle the request
	 */
	$application = new \Phalcon\Mvc\Application($di);
	
	echo $application->handle()->getContent();

} catch (\Exception $e) {
	echo $e->getMessage(), '<br>';
	echo nl2br(htmlentities($e->getTraceAsString()));
} 
