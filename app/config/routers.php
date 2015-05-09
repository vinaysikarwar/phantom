<?php
/*
 * Define custom routes. File gets included in the router service definition.
 */
$router = new Phalcon\Mvc\Router();
$router->add('/confirm/{code}/{email}', array(
    'controller' => 'user_control',
    'action' => 'confirmEmail'
));
$router->add('/reset-password/{code}/{email}', array(
    'controller' => 'user_control',
    'action' => 'resetPassword'
));
$router->add('/user/address/new', array(
    'controller' => 'user',
    'action' => 'new'
));
$router->add('/user/address/edit/{id}', array(
    'controller' => 'address',
    'action' => 'edit'
));
$router->add('/user/address/', array(
    'controller' => 'address',
    'action' => 'index'
));

$router->add('/user/account/edit', array(
    'controller' => 'user',
    'action' => 'edit'
));

return $router;