<?php

return new \Phalcon\Config(array(
	'database' => array(
		'adapter'     => 'Mysql',
		'host'        => 'localhost',
		'username'    => 'root',
		'password'    => 'VinayAWS@1987',
		'dbname'      => 'phantom',
	),
	'application' => array(
		'controllersDir' => __DIR__ . '/../../app/controllers/',
		'modelsDir'      => __DIR__ . '/../../app/models/',
		'viewsDir'       => __DIR__ . '/../../app/views/',
		'helpersDir'       => __DIR__ . '/../../app/helpers/',
		'pluginsDir'     => __DIR__ . '/../../app/plugins/',
		'libraryDir'     => __DIR__ . '/../../app/library/',
		'baseUri'        => 'http://52.25.41.163/',
		'publicUrl'      => 'http://52.25.41.163/',
		'debug'          => '0',
		'cacheDir'      => '/var/www/phantom/cache/',
        'templateEngine' => 'volt',
        'templateExtension' => '.phtml',
        'templateEngineCachePath' => '/var/www/phalconcms/cache/',
	),
	'mail' => array(
                'fromName' => 'Phantom',
                'fromEmail' => '',
                'smtp' => array(
                        'server'	=> 'smtp.gmail.com',
                        'port' 		=> 465,
                        'security' => 'ssl',
                        'username' => '',
                        'password' => '',
                )
        ),
));
