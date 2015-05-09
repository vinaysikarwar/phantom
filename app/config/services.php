<?php

use Phalcon\DI\FactoryDefault,
	Phalcon\Mvc\View,
	Phalcon\Mvc\Url as UrlResolver,
	Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,
	Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter,
	Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();
$di->set('config', $config);


/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function() use ($config) {
	$url = new UrlResolver();
	$url->setBaseUri($config->application->baseUri);
	return $url;
}, true);

//Setup the view component
$di->set('view', function(){
	$view = new \Phalcon\Mvc\View();
	$view->setViewsDir('../app/views/');
	return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function() use ($config) {
	return new DbAdapter(array(
		'host' => $config->database->host,
		'username' => $config->database->username,
		'password' => $config->database->password,
		'dbname' => $config->database->dbname
	));
});
/**
 * Loading routes from the routes.php file
 */
$di->set('router', function() {
	return require __DIR__ . '/routers.php';
});
/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function() {
	return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function() {
	$session = new SessionAdapter();
	$session->start();
	return $session;
});

// Set Helper
$di->set('helpers', function(){
	return new Helpers();
});

$di->set('flash', function() {
	return new \Phalcon\Flash\Session(array(
		'error' => 'alert alert-danger',
		'success' => 'alert alert-success',
		'notice' => 'alert alert-info',
	));
}, true);
/**
 * Start the sendmail
 */
/**
* Mail service uses AmazonSES
*/
$di->set('mail', function(){
        return new Mail();
});