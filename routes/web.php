<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/6/18
 * Time: 5:08 PM
 */
$router->route('GET', '/posters', function () {
    echo '<a href="/posters/1">1. Poster</a>';
});

$router->route('GET', '/', 'App\\Controllers\TaskController::index');
$router->route('GET', '/tasks', 'App\\Controllers\TaskController::get');
$router->route('POST', '/tasks/update', 'App\\Controllers\TaskController::update');

